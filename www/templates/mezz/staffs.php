<?php
$staff_active = 'active';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="/assets/scripts/jquery.min.js"></script>
    <title><?= $config['hotelName'] ?>: <?= $lang["TittleHader1"] ?></title>
</head>

<body class="container">
    <script src="/assets/scripts/page-load.js"></script>
    <div class="page-content">
        <?php
        if (!isset($_SESSION['id'])) {
            include('auth/login.php');
        } else {
            include('auth/logged.php');
        }
        ?>
        <?php include_once("includes/menu.php"); ?>
        <div class="page-content-collider" style="background-color: transparent;">
            <div class="page-content-max-width" style="flex-direction: column;align-items: flex-start;">
                <div class="page-content-collider-item">
                    <div class="page-content-collider-content staffs">
                        <div class="staffs-grid">
                            <?php
                            $getRanks = $dbh->prepare("SELECT id,name,badge_code,title FROM permissions_groups WHERE id in (25, 20, 19, 16, 14, 13, 12, 11) ORDER BY id DESC");
                            $getRanks->execute();
                            while ($Ranks = $getRanks->fetch()) {
                                $badgeCode = filter($Ranks['badge_code']);
                                echo '
                                <div class="staff-card">
                                    <div class="staff-card-header">
                                        <div class="staff-card-header-icon">
                                            <img src="' . $config['BadgeURL'] . '' . $badgeCode . '.gif" alt="' . $Ranks['name'] . '" onerror="this.src=\'/assets/images/staffs/ADM.png\'">
                                        </div>
                                        <h2 class="staff-card-title">' . $Ranks['name'] . '</h2>
                                    </div>
                                    <div class="staff-card-members">';
                                
                                $getMembers = $dbh->prepare("SELECT id,username,motto,look,online,tarea,pais FROM users WHERE rank = :ranid");
                                $getMembers->bindParam(':ranid', $Ranks['id']);
                                $getMembers->execute();
                                
                                if ($getMembers->RowCount() > 0) {
                                    while ($member = $getMembers->fetch()) {
                                        $username = filter($member['username']);
                                        $motto = filter($member['motto']);
                                        $look = filter($member['look']);
                                        $online = filter($member['online']);
                                        $tarea = isset($member['tarea']) ? filter($member['tarea']) : '';
                                        $pais = isset($member['pais']) ? filter($member['pais']) : '';
                                        $statusClass = ($online == 1) ? 'online' : 'offline';
                                        $statusText = ($online == 1) ? 'Online' : 'Offline';
                                        
                                        // Construir HTML para tarea y país si están configurados
                                        $extraInfo = '';
                                        if (!empty($tarea)) {
                                            $extraInfo .= '<div class="staff-member-extra">
                                                <span class="extra-icon">💼</span>
                                                <span class="extra-text">' . $tarea . '</span>
                                            </div>';
                                        }
                                        if (!empty($pais)) {
                                            // Asumimos que $pais contiene el código ISO (ej: ES, MX, AR)
                                            $flagUrl = 'https://flagcdn.com/20x15/' . strtolower($pais) . '.png';
                                            $extraInfo .= '<div class="staff-member-extra">
                                                <img src="' . $flagUrl . '" alt="' . $pais . '" class="extra-flag" style="width: 16px; height: 12px; object-fit: cover; border-radius: 2px;">
                                                <span class="extra-text">' . $pais . '</span>
                                            </div>';
                                        }
                                        
                                        echo '
                                        <div class="staff-member">
                                            <div class="staff-member-avatar">
                                                <img src="' . $config['AvatarURL'] . '' . $look . '&action=std&direction=2&head_direction=3&gesture=sml&headonly=0&size=l" alt="' . $username . '">
                                            </div>
                                            <div class="staff-member-info">
                                                <a href="/profile/' . $username . '" class="staff-member-name">' . $username . '</a>
                                                <p class="staff-member-motto">' . $motto . '</p>
                                                ' . $extraInfo . '
                                            </div>
                                            <div class="staff-member-right">
                                                <div class="staff-member-badge">
                                                    <img src="' . $config['BadgeURL'] . '' . $badgeCode . '.gif" alt="Badge" onerror="this.src=\'/assets/images/staffs/ADM.png\'">
                                                </div>
                                                <div class="staff-member-status ' . $statusClass . '">
                                                    <span class="status-dot"></span>
                                                    <span class="status-text">' . $statusText . '</span>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<div class="staff-card-empty">
                                        <span class="empty-icon">👤</span>
                                        <p>No hay miembros en este rango</p>
                                    </div>';
                                }
                                echo '</div></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="/assets/scripts/app.js" defer></script>
</body>

</html>