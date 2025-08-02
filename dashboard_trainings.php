<?php include 'header.php'; ?>

<?php
$dataFile = 'trainings.csv';
$trainingRequests = [];

if (file_exists($dataFile)) {
    $file = fopen($dataFile, 'r');
    while (($line = fgetcsv($file)) !== false) {
        $trainingRequests[] = $line;
    }
    fclose($file);
}
?>

<div class="main-content">
    <h2>لوحة التحكم - طلبات التكوين</h2>

    <table>
        <thead>
            <tr>
                <th>رقم</th>
                <th>الاسم</th>
                <th>رقم الهاتف</th>
                <th>نوع التكوين</th>
                <th>تاريخ الطلب</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trainingRequests as $request): ?>
                <tr>
                    <td><?= htmlspecialchars($request[0]) ?></td>
                    <td><?= htmlspecialchars($request[1]) ?></td>
                    <td><?= htmlspecialchars($request[2]) ?></td>
                    <td><?= htmlspecialchars($request[3]) ?></td>
                    <td><?= htmlspecialchars($request[4]) ?></td>
                    <td>
                        <a href="delete_training.php?id=<?= $request[0] ?>" class="btn delete" onclick="return confirm('هل أنت متأكد من الحذف؟')">🗑️ حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (count($trainingRequests) === 0): ?>
                <tr><td colspan="6">لا توجد طلبات تكوين حالياً.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
