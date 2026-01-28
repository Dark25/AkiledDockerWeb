<?php
define('BRAIN_CMS', 1);
include_once __DIR__ . '/../global.php';

header('Content-Type: application/json');

// Habilitar reporte de errores para depuración (solo se verá si el JSON falla)
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar en el output para no romper JSON

if (isset($_POST['postreply'])) {
    if (!empty($_POST['reply']) && isset($_POST['report_id'])) {
        try {
            $postNews = $dbh->prepare("
                INSERT INTO cms_reportsreply(report_id,reply,staff,time)
                VALUES
                (
                    :report_id,
                    :reply, 
                    :staff,
                    :time
                )
            ");
            $postNews->bindValue(':report_id', $_POST['report_id'], PDO::PARAM_INT);
            $postNews->bindValue(':reply', $_POST['reply']);
            $postNews->bindValue(':staff', User::userData('username'));
            $postNews->bindValue(':time', time());
            
            if ($postNews->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                $errorInfo = $postNews->errorInfo();
                echo json_encode(['status' => 'error', 'message' => 'DB Error: ' . $errorInfo[2]]);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()]);
        }
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan campos: reply o report_id']);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
