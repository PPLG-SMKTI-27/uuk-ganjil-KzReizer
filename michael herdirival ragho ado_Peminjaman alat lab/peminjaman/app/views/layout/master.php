<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($title) ? $title : 'Sistem Peminjaman Alat'; ?></title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
    }
    .sidebar {
      width: 250px;
      background: #2c3e50;
      color: white;
      padding: 30px 0;
      position: fixed;
      height: 100vh;
      overflow-y: auto;
    }
    .sidebar-header {
      padding: 0 20px 30px;
      border-bottom: 1px solid #34495e;
      margin-bottom: 20px;
    }
    .sidebar-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .sidebar-subtitle {
      font-size: 12px;
      color: #bdc3c7;
    }
    .user-info {
      padding: 0 20px 20px;
      border-bottom: 1px solid #34495e;
      margin-bottom: 20px;
    }
    .user-name {
      font-weight: bold;
      margin-bottom: 3px;
    }
    .user-role {
      font-size: 12px;
      color: #bdc3c7;
    }
    .nav-menu {
      list-style: none;
    }
    .nav-menu li {
      margin: 0;
    }
    .nav-menu a {
      display: block;
      padding: 12px 20px;
      color: #ecf0f1;
      text-decoration: none;
      transition: all 0.3s;
      border-left: 3px solid transparent;
    }
    .nav-menu a:hover {
      background: #34495e;
      border-left-color: #667eea;
    }
    .nav-menu a.active {
      background: #667eea;
      border-left-color: #667eea;
      color: white;
    }
    .logout-btn {
      margin: 20px;
      padding: 10px 15px;
      background: #e74c3c;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: calc(100% - 40px);
      text-align: center;
      transition: background 0.3s;
    }
    .logout-btn:hover {
      background: #c0392b;
    }
    .main-content {
      margin-left: 250px;
      flex: 1;
      padding: 30px;
    }
    .container {
      background: white;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }
    h1 {
      color: #2c3e50;
      font-size: 28px;
    }
    .btn {
      padding: 10px 20px;
      background: #667eea;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s;
      display: inline-block;
    }
    .btn:hover {
      background: #764ba2;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .btn-danger {
      background: #e74c3c;
    }
    .btn-danger:hover {
      background: #c0392b;
    }
    .btn-edit {
      background: #f39c12;
    }
    .btn-edit:hover {
      background: #d68910;
    }
    .btn-secondary {
      background: #95a5a6;
    }
    .btn-secondary:hover {
      background: #7f8c8d;
    }
    .btn-success {
      background: #27ae60;
    }
    .btn-success:hover {
      background: #229954;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      color: #2c3e50;
      font-weight: bold;
    }
    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="date"],
    input[type="number"],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #bdc3c7;
      border-radius: 5px;
      font-size: 16px;
      transition: border-color 0.3s;
      font-family: inherit;
    }
    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th {
      background: #667eea;
      color: white;
      padding: 15px;
      text-align: left;
      font-weight: bold;
    }
    td {
      padding: 12px 15px;
      border-bottom: 1px solid #ecf0f1;
    }
    tr:hover {
      background: #f8f9fa;
    }
    .status-badge {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: bold;
    }
    .status-pending {
      background: #fff3cd;
      color: #856404;
    }
    .status-disetujui {
      background: #d4edda;
      color: #155724;
    }
    .status-ditolak {
      background: #f8d7da;
      color: #721c24;
    }
    .status-dikembalikan {
      background: #d4edda;
      color: #155724;
    }
    .status-requestreturn {
      background: #fff3cd;
      color: #856404;
    }
    .action-buttons {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }
    .action-buttons .btn {
      padding: 8px 12px;
      font-size: 13px;
      margin: 0;
    }
    .no-data {
      text-align: center;
      padding: 50px;
      color: #7f8c8d;
    }
    .button-group {
      display: flex;
      gap: 10px;
      margin-top: 30px;
    }
    .button-group .btn {
      flex: 1;
    }
    .back-link {
      display: inline-block;
      margin-bottom: 20px;
      color: #667eea;
      text-decoration: none;
    }
    .back-link:hover {
      text-decoration: underline;
    }
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .main-content {
        margin-left: 0;
        padding: 15px;
      }
      .container {
        padding: 15px;
      }
      h1 {
        font-size: 22px;
      }
      .header {
        flex-direction: column;
        gap: 15px;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar (hidden in auth mode) -->
  <?php if (!(isset($auth) && $auth)): ?>
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="sidebar-title">🏛️ PEMINJAMAN</div>
      <div class="sidebar-subtitle">Sistem Alat Lab</div>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
      <div class="user-info">
        <div class="user-name"><?php echo htmlspecialchars($_SESSION['user']['username']); ?></div>
        <div class="user-role"><?php echo ucfirst($_SESSION['user']['role']); ?></div>
      </div>

      <ul class="nav-menu">
        <li><a href="index.php?page=home" <?php echo (isset($page) && $page === 'home') ? 'class="active"' : ''; ?>>🏠 Home</a></li>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
          <li><a href="index.php?page=alat" <?php echo (isset($page) && $page === 'alat') ? 'class="active"' : ''; ?>>📦 Data Alat</a></li>
          <li><a href="index.php?page=peminjaman&action=approval" <?php echo (isset($page) && $page === 'peminjaman' && isset($_GET['action']) && $_GET['action'] === 'approval') ? 'class="active"' : ''; ?>>✓ Persetujuan</a></li>
          <li><a href="index.php?page=peminjaman&action=check_return" <?php echo (isset($page) && $page === 'peminjaman' && isset($_GET['action']) && $_GET['action'] === 'check_return') ? 'class="active"' : ''; ?>>🔍 Cek Pengembalian</a></li>
        <?php endif; ?>
        <li><a href="index.php?page=peminjaman" <?php echo (isset($page) && $page === 'peminjaman' && (!isset($_GET['action']) || ($_GET['action'] !== 'approval' && $_GET['action'] !== 'check_return'))) ? 'class="active"' : ''; ?>>📋 Peminjaman</a></li>
      </ul>

      <form method="GET" action="index.php" style="padding: 0 20px;">
        <input type="hidden" name="page" value="logout">
        <button type="submit" class="logout-btn">🚪 Logout</button>
      </form>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <style>
    <?php if (isset($auth) && $auth): ?>
      .sidebar { display: none !important; }
      .main-content { margin-left: 0; padding: 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
      .container { max-width: 900px; width: 100%; background: white; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); padding: 50px; }
    <?php endif; ?>
  </style>

  <!-- Main Content -->
  <div class="main-content">
    <div class="container">
      <?php 
        // Include content file
        if (isset($content)) {
          include $content;
        }
      ?>
    </div>
  </div>
</body>
</html>
