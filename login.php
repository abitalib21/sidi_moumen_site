<?php
session_start();

$errMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // بيانات الدخول الثابتة
    $validUser = 'admin';
    $validPass = 'admin123';

    if ($username === $validUser && $password === $validPass) {
        $_SESSION['logged_in'] = true;
        header('Location: clients_stats.php');
        exit();
    } else {
        $errMsg = 'اسم المستخدم أو كلمة المرور غير صحيحة';
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 320px;
        }
        h2 {
            margin-bottom: 20px;
            color: #004085;
            text-align: center;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 12px 0;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .error {
            color: #dc3545;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<form method="post" action="login.php">
    <h2>تسجيل الدخول</h2>
    <?php if ($errMsg): ?>
        <div class="error"><?= htmlspecialchars($errMsg) ?></div>
    <?php endif; ?>
    <input type="text" name="username" placeholder="اسم المستخدم" required autofocus />
    <input type="password" name="password" placeholder="كلمة المرور" required />
    <button type="submit">دخول</button>
</form>

</body>
</html>
