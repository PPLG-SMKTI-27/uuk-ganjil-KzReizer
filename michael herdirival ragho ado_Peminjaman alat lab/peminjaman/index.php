<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Auto-load controllers
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/AlatController.php';
require_once __DIR__ . '/app/controllers/PeminjamanController.php';

// Get page parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Routing dengan switch case
switch ($page) {
  case 'login':
    if ($action === 'auth_login') {
      $controller = new AuthController();
      $controller->auth_login();
    } else {
      $title = 'Login';
      $auth = true;
      $content = __DIR__ . '/app/views/auth/login.php';
      include __DIR__ . '/app/views/layout/master.php';
    }
    break;

  case 'register':
    if ($action === 'auth_register') {
      $controller = new AuthController();
      $controller->auth_register();
    } else {
      $title = 'Register';
      $auth = true;
      $content = __DIR__ . '/app/views/auth/register.php';
      include __DIR__ . '/app/views/layout/master.php';
    }
    break;

  case 'logout':
    $controller = new AuthController();
    $controller->logout();
    break;

  case 'alat':
    if (!isset($_SESSION['user'])) {
      header('Location: index.php?page=login');
      exit;
    }
    // Only admin can access CRUD operations
    if ($action !== '' && $_SESSION['user']['role'] !== 'admin') {
      header('Location: index.php?page=alat');
      exit;
    }
    $controller = new AlatController();
    switch ($action) {
      case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $controller->store();
        } else {
          $title = 'Tambah Alat';
          $content = __DIR__ . '/app/views/alat/create.php';
        }
        break;
      case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $controller->update();
        } else {
          $title = 'Edit Alat';
          $alat = $controller->getAlat($_GET['id'] ?? 0);
          $content = __DIR__ . '/app/views/alat/edit.php';
        }
        break;
      case 'delete':
        $controller->delete();
        break;
      default:
        $title = 'Data Alat';
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        if ($search) {
          $alat = $controller->searchAlat($search);
        } else {
          $alat = $controller->getAllAlat();
        }
        $content = __DIR__ . '/app/views/alat/index.php';
    }
    if (isset($content)) {
      include __DIR__ . '/app/views/layout/master.php';
    }
    break;

  case 'peminjaman':
    if (!isset($_SESSION['user'])) {
      header('Location: index.php?page=login');
      exit;
    }
    $controller = new PeminjamanController();
    if ($action === 'create') {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->store();
      } else {
        $title = 'Ajukan Peminjaman';
        $alat = $controller->getAllAlat();
        $content = __DIR__ . '/app/views/peminjaman/create.php';
      }
    } elseif ($action === 'return') {
      $id = $_GET['id'] ?? 0;
      $controller->returnItem($id);
    } elseif ($action === 'approval') {
      // Admin only - approval page
      if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: index.php?page=peminjaman');
        exit;
      }
      $title = 'Persetujuan Peminjaman';
      $approvalList = $controller->getApprovalList();
      $content = __DIR__ . '/app/views/peminjaman/approval.php';
    } elseif ($action === 'approve') {
      // Admin only - approve request
      if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: index.php?page=peminjaman');
        exit;
      }
      $id = $_GET['id'] ?? 0;
      $controller->approveRequest($id);
    } elseif ($action === 'reject') {
      // Admin only - reject request
      if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: index.php?page=peminjaman');
        exit;
      }
      $id = $_GET['id'] ?? 0;
      $controller->rejectRequest($id);
    } elseif ($action === 'check_return') {
      // Admin only - check pending returns
      if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: index.php?page=peminjaman');
        exit;
      }
      $title = 'Cek Pengembalian Alat';
      $pendingReturns = $controller->getPendingReturns();
      $content = __DIR__ . '/app/views/peminjaman/check_return.php';
    } elseif ($action === 'approve_return') {
      // Admin only - approve return
      if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: index.php?page=peminjaman');
        exit;
      }
      $id = $_GET['id'] ?? 0;
      $controller->approveReturn($id);
    } elseif ($action === 'reject_return') {
      // Admin only - reject return
      if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: index.php?page=peminjaman');
        exit;
      }
      $id = $_GET['id'] ?? 0;
      $controller->rejectReturn($id);
    } else {
      $title = 'Peminjaman';
      $peminjaman = $controller->getAllPeminjaman();
      $content = __DIR__ . '/app/views/peminjaman/index.php';
    }
    if (isset($content)) {
      include __DIR__ . '/app/views/layout/master.php';
    }
    break;

  default:
    // Home page or landing
    if (!isset($_SESSION['user'])) {
      // Show landing page
      $title = 'Sistem Peminjaman Alat';
      $auth = true;
      $content = __DIR__ . '/app/views/landing.php';
      include __DIR__ . '/app/views/layout/master.php';
    } else {
      // Show home dashboard
      $title = 'Home';
      $page = 'home';
      $content = __DIR__ . '/app/views/home.php';
      include __DIR__ . '/app/views/layout/master.php';
    }
}
?>
