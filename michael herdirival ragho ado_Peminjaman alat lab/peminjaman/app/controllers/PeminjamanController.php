<?php
require_once __DIR__ . '/../models/PeminjamanModel.php';
require_once __DIR__ . '/../models/AlatModel.php';

class PeminjamanController {
  private $modelPeminjaman;
  private $modelAlat;

  public function __construct() {
    $this->modelPeminjaman = new PeminjamanModel();
    $this->modelAlat = new AlatModel();
  }

  public function getAllPeminjaman() {
    return $this->modelPeminjaman->getAll();
  }

  public function getAllAlat() {
    return $this->modelAlat->getAll();
  }

  public function index() {
    $peminjaman = $this->modelPeminjaman->getAll();
    include __DIR__ . '/../views/peminjaman/index.php';
  }

  public function create() {
    $alat = $this->modelAlat->getAll();
    include __DIR__ . '/../views/peminjaman/create.php';
  }

  public function store() {
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
      die("Error: Anda harus login terlebih dahulu");
    }

    $user_id = $_SESSION['user']['id'];
    $alat_id = isset($_POST['alat_id']) ? $_POST['alat_id'] : 0;
    $tanggal_pinjam = isset($_POST['tanggal_pinjam']) ? $_POST['tanggal_pinjam'] : '';
    $status = 'pending';

    if (!$alat_id || !$tanggal_pinjam) {
      die("Error: Alat dan tanggal pinjam harus diisi");
    }

    $this->modelPeminjaman->insert($user_id, $alat_id, $tanggal_pinjam, $status);
    header('Location: index.php?page=peminjaman');
    exit;
  }

  public function returnItem($id) {
    // User request to return item, update status to request_return
    $result = $this->modelPeminjaman->requestReturn($id);
    if ($result) {
      header('Location: index.php?page=peminjaman');
    } else {
      // Handle error, e.g., item not found or not in 'disetujui' status
      echo "Error: Gagal mengajukan pengembalian atau status tidak sesuai.";
    }
    exit;
  }

  public function getApprovalList() {
    return $this->modelPeminjaman->getPendingPeminjaman();
  }

  public function approveRequest($id) {
    $this->modelPeminjaman->updateStatus($id, 'disetujui');
    header('Location: index.php?page=peminjaman&action=approval');
  }

  public function rejectRequest($id) {
    $this->modelPeminjaman->updateStatus($id, 'ditolak');
    header('Location: index.php?page=peminjaman&action=approval');
  }

  public function getPendingReturns() {
    return $this->modelPeminjaman->getPendingReturns();
  }

  public function approveReturn($id) {
    $this->modelPeminjaman->approveReturn($id);
    header('Location: index.php?page=peminjaman&action=check_return');
  }

  public function rejectReturn($id) {
    $this->modelPeminjaman->rejectReturn($id);
    header('Location: index.php?page=peminjaman&action=check_return');
  }
}
?>
