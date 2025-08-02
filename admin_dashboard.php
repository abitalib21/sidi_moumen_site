<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .dashboard {
            padding: 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            text-align: center;
        }
        .card a {
            color: #007B5E;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="dashboard">
    <div class="card"><a href="dashboard_cooperatives.php">إدارة التعاونيات</a></div>
    <div class="card"><a href="dashboard_products.php">إدارة المنتجات</a></div>
    <div class="card"><a href="dashboard_clients.php">إدارة العملاء</a></div>
    <div class="card"><a href="dashboard_training.php">طلبات التكوين</a></div>
    <div class="card"><a href="stats_products.php">إحصائيات المنتجات</a></div>
    <div class="card"><a href="stats_clients.php">إحصائيات العملاء</a></div>
</div>

</body>
</html>
