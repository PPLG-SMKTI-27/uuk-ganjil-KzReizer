<h1 style="text-align: center; margin-bottom: 30px;">📝 Register</h1>
<form method="POST" action="index.php?page=register&action=auth_register">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
  </div>
  <div class="form-group">
    <label for="role">Role</label>
    <select id="role" name="role" required>
      <option value="">-- Pilih Role --</option>
      <option value="siswa">Siswa</option>
      <option value="guru">Guru</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 20px;">Register</button>
</form>
<div style="text-align: center; margin-top: 20px; color: #7f8c8d;">
  Sudah punya akun? <a href="index.php?page=login" style="color: #667eea; text-decoration: none; font-weight: bold;">Login di sini</a>
</div>
