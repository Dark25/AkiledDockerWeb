<?php
if (!defined('BRAIN_CMS')) {
    die();
}

class GeoIPHelper {
    public static function getCountryCounts() {
        global $dbh, $emuUse, $config;
        
        // Detect correct IP column
        $ipColumn = 'ip_last';
        if (isset($emuUse['ip_last'])) {
            $ipColumn = $emuUse['ip_last'];
        } else if (isset($config['hotelEmu']) && $config['hotelEmu'] == 'arcturus') {
            $ipColumn = 'ip_current';
        }
        
        // 1. Get unique IPs and their counts
        // For development, we might have only local IPs. 
        $stmt = $dbh->prepare("SELECT $ipColumn as ip, COUNT(*) as count FROM users WHERE $ipColumn != '' GROUP BY $ipColumn ORDER BY count DESC LIMIT 500");
        $stmt->execute();
        $ipData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($ipData)) {
            return [];
        }

        // 2. Filter out local IPs for API lookup but keep track if we only have local
        $externalIps = [];
        $localCount = 0;
        foreach ($ipData as $row) {
            $ip = $row['ip'];
            if ($ip == '127.0.0.1' || $ip == '::1' || strpos($ip, '192.168.') === 0) {
                $localCount += (int)$row['count'];
            } else {
                $externalIps[] = $row;
            }
        }
        
        $results = [];
        if (empty($externalIps)) {
            // Fallback for local development: Show a few sample countries if only local IPs exist
            return [
                'ES' => ['name' => 'Local (Demo: España)', 'count' => $localCount, 'code' => 'es'],
                'MX' => ['name' => 'Local (Demo: México)', 'count' => 0, 'code' => 'mx']
            ];
        }

        $uniqueIps = array_column($externalIps, 'ip');
        
        // 3. Simple cache in session to avoid over-calling API
        if (!isset($_SESSION['geoip_cache'])) {
            $_SESSION['geoip_cache'] = [];
        }
        
        $results = [];
        $ipsToLookup = [];
        
        foreach ($uniqueIps as $ip) {
            if (isset($_SESSION['geoip_cache'][$ip])) {
                $results[$ip] = $_SESSION['geoip_cache'][$ip];
            } else {
                $ipsToLookup[] = $ip;
            }
        }
        
        // 4. Batch lookup (max 100 per call for ip-api.com)
        if (!empty($ipsToLookup)) {
            $chunks = array_chunk($ipsToLookup, 100);
            foreach ($chunks as $chunk) {
                $response = self::batchLookup($chunk);
                if ($response) {
                    foreach ($response as $item) {
                        if (isset($item['query']) && isset($item['countryCode'])) {
                            $_SESSION['geoip_cache'][$item['query']] = [
                                'countryCode' => $item['countryCode'],
                                'country' => $item['country']
                            ];
                            $results[$item['query']] = $_SESSION['geoip_cache'][$item['query']];
                        }
                    }
                }
            }
        }
        
        // 5. Aggregate by country
        $countryCounts = [];
        foreach ($externalIps as $row) {
            $ip = $row['ip'];
            $count = (int)$row['count'];
            
            if (isset($results[$ip])) {
                $cc = $results[$ip]['countryCode'];
                $countryName = $results[$ip]['country'];
                
                if (!isset($countryCounts[$cc])) {
                    $countryCounts[$cc] = [
                        'name' => $countryName,
                        'count' => 0,
                        'code' => strtolower($cc)
                    ];
                }
                $countryCounts[$cc]['count'] += $count;
            }
        }
        
        uasort($countryCounts, function($a, $b) {
            return $b['count'] <=> $a['count'];
        });
        
        return $countryCounts;
    }
    
    private static function batchLookup($ips) {
        $url = 'http://ip-api.com/batch?fields=query,country,countryCode';
        $data = json_encode(array_map(function($ip) { return ['query' => $ip]; }, $ips));
        
        // Try CURL first
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $result = curl_exec($ch);
            curl_close($ch);
            
            if ($result) {
                return json_decode($result, true);
            }
        }
        
        // Fallback to stream context
        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => $data,
                'timeout' => 5
            ]
        ];
        
        $context  = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);
        
        if ($result === FALSE) {
            return null;
        }
        
        return json_decode($result, true);
    }
}
?>
