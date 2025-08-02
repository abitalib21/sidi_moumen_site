<?php include 'header.php'; ?>

<?php
$csvFile = 'clients.csv';
$clients = [];

if (file_exists($csvFile)) {
    $handle = fopen($csvFile, 'r');
    while (($data = fgetcsv($handle)) !== FALSE) {
        $clients[] = $data;
    }
    fclose($handle);
}
?>

<div class="main-content">
    <h2>لوحة التحكم - العملاء</h2>

    <a href="add_client.php" class="btn add">➕ إضافة عميل جديد</a>

    <table>
        <thead>
            <tr>
                <th>رقم</th>
                <th>الاسم الكامل</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>نوع الحساب</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($clients) > 0): ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client[0]) ?></td>
                        <td><?= htmlspecialchars($client[1]) ?></td>
                        <td><?= htmlspecialchars($client[2]) ?></td>
                        <td><?= htmlspecialchars($client[3]) ?></td>
                        <td><?= htmlspecialchars($client[4]) ?></td>
                        <td>
                            <a href="edit_client.php?id=<?= $client[0] ?>" class="btn edit">✏️ تعديل</a>
                            <a href="delete_client.php?id=<?= $client[0] ?>" class="btn delete" onclick="return confirm('هل أنت متأكد من الحذف؟');">🗑️ حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">لا توجد عملاء مسجلين حالياً.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
