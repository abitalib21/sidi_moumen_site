<!-- admin_cooperatives.php -->
<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إدارة التعاونيات</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background-color: #f5f5f5;
    }
    .main-content {
      margin-right: 220px;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background-color: #2e3b4e;
      color: white;
    }
  </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-content">
  <h2>إدارة التعاونيات</h2>

  <table>
    <thead>
      <tr>
        <th>اسم التعاونية</th>
        <th>نوع النشاط</th>
        <th>العنوان</th>
        <th>الهاتف</th>
        <th>البريد الإلكتروني</th>
        <th>تاريخ التسجيل</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $filename = 'cooperatives.csv';
      if (file_exists($filename)) {
          $rows = array_map('str_getcsv', file($filename));
          foreach ($rows as $index => $row) {
              echo "<tr>";
              for ($i = 0; $i < count($row); $i++) {
                  echo "<td>" . htmlspecialchars($row[$i]) . "</td>";
              }
              echo "<td>
                      <a href='edit_cooperative.php?id=$index'>تعديل</a> |
                      <a href='delete_cooperative.php?id=$index' onclick=\"return confirm('هل أنت متأكد من الحذف؟');\">حذف</a>
                    </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='7'>لا توجد بيانات</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
