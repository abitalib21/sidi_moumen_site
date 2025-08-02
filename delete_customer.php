<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $filename = 'data/customers.csv';
    $updatedCustomers = [];

    // قراءة البيانات
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            if ($data[0] != $id) {
                $updatedCustomers[] = $data;
            }
        }
        fclose($handle);
    }

    // إعادة كتابة الملف بدون العميل المحذوف
    if (($handle = fopen($filename, 'w')) !== FALSE) {
        foreach ($updatedCustomers as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}

// إعادة التوجيه إلى صفحة عرض العملاء
header("Location: dashboard_customers.php");
exit();
