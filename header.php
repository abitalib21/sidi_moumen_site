<?php
session_start();

// حماية الصفحات التي تحتاج تسجيل دخول
// استبدل 'admin_logged_in' حسب ما تستخدمه في جلسة تسجيل الدخول
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>سوق سيدي مومن التعاوني</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header>
        <img src="logo.png" alt="شعار رابطة جمعيات سيدي مومن" class="header-logo" />
        <nav>
            <a href="dashboard_products.php" class="btn">المنتجات</a>
            <a href="dashboard_clients.php" class="btn">العملاء</a>
            <a href="dashboard_trainings.php" class="btn">طلبات التكوين</a>
            <a href="logout.php" class="btn">تسجيل الخروج</a>
        </nav>
    </header>
