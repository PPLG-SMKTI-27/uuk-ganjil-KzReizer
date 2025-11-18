<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
  public function login() {
    include __DIR__ . '/../views/auth/login.php';
  }

  public function register() {
    include __DIR__ . '/../views/auth/register.php';
  }

  public function auth_login() {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $model = new UserModel();
    $user = $model->findByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      header('Location: index.php?page=home');
    } else {
      echo "Login gagal. Username atau password salah.";
    }
  }

  public function auth_register() {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'] ?? 'siswa'; // Default: siswa

    // Validasi role
    $allowed_roles = ['admin', 'siswa', 'guru'];
    if (!in_array($role, $allowed_roles)) {
      echo "Role tidak valid. Pilih: admin, siswa, atau guru.";
      return;
    }

    $model = new UserModel();

    $existingUser = $model->findByUsername($username);
    if ($existingUser) {
    echo "Username sudah digunakan. Silakan pilih username lain.";
    return;
  }


    $result = $model->insert($username, $password, $role);

    if ($result) {
      header('Location: index.php?page=login');
    } else {
      echo "Register gagal. Username mungkin sudah digunakan.";
    }
  }

  public function logout() {
    session_destroy();
    header('Location: index.php?page=login');
  }
}