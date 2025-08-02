<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("معرف المنتج غير محدد.");
}

$id = $_GET['id'];
$csvFile = 'products.csv';
$updatedProducts = [];

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($data[0] != $id) {
            $updatedProducts[] = $data;
        }
    }
    fclose($handle);
}

if (($handle = fopen($csvFile, 'w')) !== FALSE) {
    foreach ($updatedProducts as $row) {
        fputcsv($handle, $row);
    }
    fclose($handle);
}

header("Location: dashboard_products.php?deleted=1");
exit();
?>
