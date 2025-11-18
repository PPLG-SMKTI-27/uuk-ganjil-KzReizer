<h1 style="text-align: center; margin-bottom: 30px;">🔐 Login</h1>
<form method="POST" action="index.php?page=login&action=auth_login">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 20px;">Login</button>
</form>
<div style="text-align: center; margin-top: 20px; color: #7f8c8d;">
  Belum punya akun? <a href="index.php?page=register" style="color: #667eea; text-decoration: none; font-weight: bold;">Daftar di sini</a>
</div>
