<?php include 'header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>صفحة التكوين - لوحة التحكم</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>
    <?php include("navbar.php"); ?>
    <div class="container">
        <h1 class="page-title">صفحة التكوينات</h1>

        <p>في هذه الصفحة، يمكنك إضافة أو عرض التكوينات المتوفرة لفائدة التعاونيات والحرفيين في سيدي مومن.</p>

        <div class="training-section">
            <h2>نماذج من التكوينات القادمة:</h2>
            <ul>
                <li>📚 تكوين في التسويق الرقمي (15 غشت 2025)</li>
                <li>🎨 ورشة تصميم المنتجات التقليدية (20 شتنبر 2025)</li>
                <li>💻 دورة في أساسيات الإعلاميات (5 أكتوبر 2025)</li>
            </ul>
        </div>

        <div class="add-training">
            <h2>إضافة تكوين جديد:</h2>
            <form method="POST" action="#">
                <label for="title">عنوان التكوين:</label>
                <input type="text" name="title" id="title" required>

                <label for="date">تاريخ التكوين:</label>
                <input type="date" name="date" id="date" required>

                <label for="desc">وصف التكوين:</label>
                <textarea name="desc" id="desc" rows="4" required></textarea>

                <button type="submit">إضافة التكوين</button>
            </form>
        </div>
    </div>
</body>
</html>
