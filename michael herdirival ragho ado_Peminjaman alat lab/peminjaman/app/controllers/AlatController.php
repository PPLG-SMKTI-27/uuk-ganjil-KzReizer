<?php
require_once __DIR__ . '/../models/AlatModel.php';

class AlatController {
  private $model;

  public function __construct() {
    $this->model = new AlatModel();
  }

  private function checkAdmin() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
      header('Location: index.php?page=peminjaman&error=unauthorized');
      exit;
    }
  }

  public function getAllAlat() {
    return $this->model->getAll();
  }

  public function searchAlat($keyword) {
    return $this->model->search($keyword);
  }

  public function getAlat($id) {
    return $this->model->getById($id);
  }

  public function index() {
    $alat = $this->model->getAll();
    include __DIR__ . '/../views/alat/index.php';
  }

  public function create() {
    $this->checkAdmin();
    include __DIR__ . '/../views/alat/create.php';
  }

  public function store() {
    $this->checkAdmin();
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $kondisi = $_POST['kondisi'];

    $this->model->insert($nama, $kategori, $stok, $kondisi);
    header('Location: index.php?page=alat');
  }

  public function edit() {
    $this->checkAdmin();
    $id = $_GET['id'];
    $alat = $this->model->getById($id);
    include __DIR__ . '/../views/alat/edit.php';
  }

  public function update() {
    $this->checkAdmin();
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $kondisi = $_POST['kondisi'];

    $this->model->update($id, $nama, $kategori, $stok, $kondisi);
    header('Location: index.php?page=alat');
  }

  public function delete() {
    $this->checkAdmin();
    $id = $_GET['id'];
    $this->model->delete($id);
    header('Location: index.php?page=alat');
  }
}
?>
