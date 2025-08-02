<?php include 'header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - سوق سيدي مومن التعاوني</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #2d3436;
            color: white;
            padding: 15px;
            position: sticky;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 22px;
            text-align: center;
            width: 100%;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 30px 0;
        }

        .nav-links a {
            background-color: #0984e3;
            color: white;
            padding: 15px 25px;
            margin: 10px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .nav-links a:hover {
            background-color: #74b9ff;
        }

        .logout {
            position: absolute;
            left: 15px;
            top: 15px;
        }

        .logout a {
            color: #d63031;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logout">
        <a href="logout.php">تسجيل الخروج</a>
    </div>
    <h1>لوحة تحكم المسؤول</h1>
</div>

<div class="nav-links">
    <a href="dashboard_cooperatives.php">إدارة التعاونيات</a>
    <a href="dashboard_clients.php">إدارة العملاء</a>
    <a href="dashboard_products.php">إدارة المنتجات</a>
    <a href="dashboard_gallery.php">معرض الصور والفيديو</a>
    <a href="dashboard_stats.php">إحصائيات المنصة</a>
</div>

</body>
</html>
