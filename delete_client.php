<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("معرف العميل غير محدد.");
}

$id = $_GET['id'];
$csvFile = 'clients.csv';
$updatedClients = [];

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($data[0] != $id) {
            $updatedClients[] = $data;
        }
    }
    fclose($handle);
}

if (($handle = fopen($csvFile, 'w')) !== FALSE) {
    foreach ($updatedClients as $row) {
        fputcsv($handle, $row);
    }
    fclose($handle);
}

header("Location: dashboard_clients.php?deleted=1");
exit();
?>
