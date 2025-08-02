<?php include 'header.php'; ?>

<?php
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $training_type = htmlspecialchars(trim($_POST["training_type"]));
    $date = date("Y-m-d");

    if (!empty($name) && !empty($phone) && !empty($training_type)) {
        $file = 'trainings.csv';
        $lastId = 0;

        if (file_exists($file)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (!empty($lines)) {
                $lastLine = explode(',', end($lines));
                $lastId = (int)$lastLine[0];
            }
        }

        $newId = $lastId + 1;
        $entry = [$newId, $name, $phone, $training_type, $date];

        $fp = fopen($file, 'a');
        fputcsv($fp, $entry);
        fclose($fp);

        $success = true;
    }
}
?>

<div class="main-content">
    <h2>طلب المشاركة في دورة تكوينية</h2>

    <?php if ($success): ?>
        <p class="success">✅ تم إرسال الطلب بنجاح! سنقوم بالتواصل معك قريبًا.</p>
    <?php endif; ?>

    <form method="POST">
        <label for="name">الاسم الكامل:</label>
        <input type="text" name="name" id="name" required>

        <label for="phone">رقم الهاتف:</label>
        <input type="text" name="phone" id="phone" required>

        <label for="training_type">نوع التكوين المطلوب:</label>
        <input type="text" name="training_type" id="training_type" required>

        <button type="submit">إرسال الطلب</button>
    </form>
</div>

<?php include 'footer.php'; ?>
