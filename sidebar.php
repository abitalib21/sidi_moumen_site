<div class="sidebar">
    <h2>لوحة التحكم</h2>
    <ul>
        <li><a href="admin_dashboard.php">🏠 الرئيسية</a></li>
        <li><a href="dashboard_cooperatives.php">👥 التعاونيات</a></li>
        <li><a href="dashboard_products.php">📦 المنتجات</a></li>
        <li><a href="dashboard_clients.php">👤 العملاء</a></li>
        <li><a href="dashboard_training.php">🎓 التكوين</a></li>
        <li><a href="stats_products.php">📊 إحصائيات المنتجات</a></li>
        <li><a href="stats_clients.php">📈 إحصائيات العملاء</a></li>
        <li><a href="logout.php">🚪 تسجيل الخروج</a></li>
    </ul>
</div>

<style>
    .sidebar {
        width: 220px;
        background-color: #007B5E;
        color: white;
        height: 100vh;
        position: fixed;
        right: 0;
        top: 0;
        padding-top: 20px;
        box-shadow: -2px 0 6px rgba(0,0,0,0.1);
    }
    .sidebar h2 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(255,255,255,0.3);
        padding-bottom: 10px;
    }
    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }
    .sidebar ul li {
        margin: 15px 0;
        text-align: right;
        padding: 0 15px;
    }
    .sidebar ul li a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        display: block;
        transition: background 0.3s;
    }
    .sidebar ul li a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        padding-right: 10px;
    }

    body {
        margin-right: 220px; /* Space for sidebar */
    }
</style>
