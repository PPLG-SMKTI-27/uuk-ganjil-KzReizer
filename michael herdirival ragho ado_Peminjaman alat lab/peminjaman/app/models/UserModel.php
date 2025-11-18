<?php
class UserModel {
  public function findByUsername($username) {
    global $conn;
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
  }

  public function insert($username, $password, $role) {
    global $conn;
    $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);
    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
      return false;
    }
    return true;
  }
}