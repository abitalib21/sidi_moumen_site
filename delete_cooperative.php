<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$csvFile = "data/cooperatives.csv";

// التأكد من أن المعرف موجود
$id = isset($_GET['id']) ? (int)$_GET['id'] : -1;

// تحميل البيانات
$rows = [];
$headers = [];
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    $headers = fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== FALSE) {
        $rows[] = $data;
    }
    fclose($handle);
}

// التحقق من صلاحية المعرف
if ($id < 0 || $id >= count($rows)) {
    echo "تعاونية غير موجودة.";
    exit;
}

// حذف التعاونية
unset($rows[$id]);
$rows = array_values($rows); // إعادة ترتيب الفهارس

// حفظ الملف من جديد
if (($fp = fopen($csvFile, 'w')) !== FALSE) {
    fputcsv($fp, $headers);
    foreach ($rows as $row) {
        fputcsv($fp, $row);
    }
    fclose($fp);
}

header("Location: dashboard_cooperatives.php");
exit;
