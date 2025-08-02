<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("معرف الطلب غير محدد.");
}

$id = $_GET['id'];
$csvFile = 'trainings.csv';
$updatedRequests = [];

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($data[0] != $id) {
            $updatedRequests[] = $data;
        }
    }
    fclose($handle);
}

if (($handle = fopen($csvFile, 'w')) !== FALSE) {
    foreach ($updatedRequests as $row) {
        fputcsv($handle, $row);
    }
    fclose($handle);
}

header("Location: dashboard_trainings.php?deleted=1");
exit();
?>
