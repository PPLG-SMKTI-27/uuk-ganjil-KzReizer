<?php
require_once __DIR__ . '/../../config/database.php';

class PeminjamanModel {
  private $conn;

  public function __construct() {
    global $conn;
    $this->conn = $conn;
  }

  public function getAll() {
    $query = "SELECT p.*, u.username, a.nama FROM peminjaman p 
              JOIN users u ON p.user_id = u.id 
              JOIN alat a ON p.alat_id = a.id";
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function getById($id) {
    $query = "SELECT p.*, u.username, a.nama FROM peminjaman p 
              JOIN users u ON p.user_id = u.id 
              JOIN alat a ON p.alat_id = a.id 
              WHERE p.id = ?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
  }

  public function insert($user_id, $alat_id, $tanggal_pinjam, $status = 'pending') {
    $query = "INSERT INTO peminjaman (user_id, alat_id, tanggal_pinjam, status) 
              VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "iiss", $user_id, $alat_id, $tanggal_pinjam, $status);
    return mysqli_stmt_execute($stmt);
  }

  public function update($id, $status) {
    $query = "UPDATE peminjaman SET status=? WHERE id=?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    return mysqli_stmt_execute($stmt);
  }

  public function returnItem($id) {
    $tanggal_kembali = date('Y-m-d');
    $query = "UPDATE peminjaman SET status='dikembalikan', tanggal_kembali=? WHERE id=?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $tanggal_kembali, $id);
    return mysqli_stmt_execute($stmt);
  }

  public function delete($id) {
    $query = "DELETE FROM peminjaman WHERE id=?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
  }

  public function getByUserId($user_id) {
    $query = "SELECT p.*, u.username, a.nama FROM peminjaman p 
              JOIN users u ON p.user_id = u.id 
              JOIN alat a ON p.alat_id = a.id 
              WHERE p.user_id = ?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function getPendingPeminjaman() {
    $query = "SELECT p.*, u.username, a.nama FROM peminjaman p 
              JOIN users u ON p.user_id = u.id 
              JOIN alat a ON p.alat_id = a.id 
              WHERE p.status = 'pending'
              ORDER BY p.id DESC";
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function updateStatus($id, $status) {
    $query = "UPDATE peminjaman SET status=? WHERE id=?";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    return mysqli_stmt_execute($stmt);
  }

  public function requestReturn($id) {
    $query = "UPDATE peminjaman SET status='request_return' WHERE id=? AND status='disetujui'";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
  }

  public function getPendingReturns() {
    $query = "SELECT p.*, u.username, a.nama FROM peminjaman p 
              JOIN users u ON p.user_id = u.id 
              JOIN alat a ON p.alat_id = a.id 
              WHERE p.status = 'request_return'
              ORDER BY p.id DESC";
    $result = mysqli_query($this->conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function approveReturn($id) {
    $tanggal_kembali = date('Y-m-d');
    $query = "UPDATE peminjaman SET status='dikembalikan', tanggal_kembali=? WHERE id=? AND status='request_return'";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $tanggal_kembali, $id);
    return mysqli_stmt_execute($stmt);
  }

  public function rejectReturn($id) {
    $query = "UPDATE peminjaman SET status='disetujui' WHERE id=? AND status='request_return'";
    $stmt = mysqli_prepare($this->conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
  }
}
?>
