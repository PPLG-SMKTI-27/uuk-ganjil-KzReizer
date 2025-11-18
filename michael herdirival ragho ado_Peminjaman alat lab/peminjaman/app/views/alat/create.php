<h1>➕ Tambah Alat</h1>

<form method="POST" action="index.php?page=alat&action=create">
  <div class="form-group">
    <label for="nama">Nama Alat</label>
    <input type="text" id="nama" name="nama" required>
  </div>
  <div class="form-group">
    <label for="kategori">Kategori</label>
    <input type="text" id="kategori" name="kategori" required>
  </div>
  <div class="form-group">
    <label for="stok">Stok</label>
    <input type="number" id="stok" name="stok" min="0" required>
  </div>
  <div class="form-group">
    <label for="kondisi">Kondisi</label>
    <select id="kondisi" name="kondisi" required>
      <option value="">-- Pilih Kondisi --</option>
      <option value="baik">Baik</option>
      <option value="rusak_ringan">Rusak Ringan</option>
      <option value="rusak_berat">Rusak Berat</option>
    </select>
  </div>
  <div class="button-group">
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="index.php?page=alat" class="btn btn-secondary">Batal</a>
  </div>
</form>
