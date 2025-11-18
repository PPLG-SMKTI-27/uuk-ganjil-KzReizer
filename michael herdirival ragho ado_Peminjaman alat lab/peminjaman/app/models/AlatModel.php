<?php
require_once __DIR__ . '/../../config/database.php';

class AlatModel {
  private $conn;

  public function __construct() {
    global $conn;
    $this->conn = $conn;
  }

  public function getAll() {
    $query = "SELECT * FROM alat";
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function search($keyword) {
    $query = "SELECT * FROM alat WHERE nama LIKE ? OR kategori LIKE ?";
    $stmt = mysqli_prepare($this->conn, $query);
    $searchKeyword = '%' . $keyword . '%';
    mysqli_stmt_bind_param($stmt, "ss", $searchKeyword, $searchKeyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function getById($id) {
    $query = "SELECT * FROM alat WHERE id = ?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
  }

  public function insert($nama, $kategori, $stok, $kondisi) {
    $query = "INSERT INTO alat (nama, kategori, stok, kondisi) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "ssis", $nama, $kategori, $stok, $kondisi);
    return mysqli_stmt_execute($stmt);
  }

  public function update($id, $nama, $kategori, $stok, $kondisi) {
    $query = "UPDATE alat SET nama=?, kategori=?, stok=?, kondisi=? WHERE id=?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "ssisi", $nama, $kategori, $stok, $kondisi, $id);
    return mysqli_stmt_execute($stmt);
  }

  public function delete($id) {
    $query = "DELETE FROM alat WHERE id=?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
  }
}
?>
