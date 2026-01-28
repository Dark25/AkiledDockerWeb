<?php
define('BRAIN_CMS', 1);
include_once __DIR__ . '/../global.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'No ID provided']);
    exit;
}

$idpage = (int)$_GET['id'];
$questions = $dbh->prepare("SELECT q.question AS message, q.time, q.user AS username, u.look FROM cms_reports_newquestion q LEFT JOIN users u ON u.username = q.user WHERE q.report_id = :id");
$questions->execute([':id' => $idpage]);
$replies = $dbh->prepare("SELECT r.reply AS message, r.time, r.staff AS username, u.look FROM cms_reportsreply r LEFT JOIN users u ON u.username = r.staff WHERE r.report_id = :id");
$replies->execute([':id' => $idpage]);

$messages = [];
foreach ($questions->fetchAll() as $q) {
    $q['role'] = 'user';
    $q['look'] = $q['look'] ?: 'hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-91';
    $messages[] = $q;
}
foreach ($replies->fetchAll() as $r) {
    $r['role'] = 'staff';
    $r['look'] = $r['look'] ?: 'hr-115-42.hd-190-1.ch-210-66.lg-285-82.sh-290-91';
    $messages[] = $r;
}
usort($messages, fn($a, $b) => $a['time'] <=> $b['time']);

echo json_encode([
    'messages' => $messages,
    'lookUrl' => $config['lookUrl']
]);
