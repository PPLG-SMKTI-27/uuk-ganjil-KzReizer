<h1>✏️ Edit Alat</h1>

<form method="POST" action="index.php?page=alat&action=edit">
  <input type="hidden" name="id" value="<?php echo $alat['id']; ?>">
  <div class="form-group">
    <label for="nama">Nama Alat</label>
    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($alat['nama']); ?>" required>
  </div>
  <div class="form-group">
    <label for="kategori">Kategori</label>
    <input type="text" id="kategori" name="kategori" value="<?php echo htmlspecialchars($alat['kategori']); ?>" required>
  </div>
  <div class="form-group">
    <label for="stok">Stok</label>
    <input type="number" id="stok" name="stok" value="<?php echo $alat['stok']; ?>" min="0" required>
  </div>
  <div class="form-group">
    <label for="kondisi">Kondisi</label>
    <select id="kondisi" name="kondisi" required>
      <option value="">-- Pilih Kondisi --</option>
      <option value="baik" <?php if ($alat['kondisi'] === 'baik') echo 'selected'; ?>>Baik</option>
      <option value="rusak_ringan" <?php if ($alat['kondisi'] === 'rusak_ringan') echo 'selected'; ?>>Rusak Ringan</option>
      <option value="rusak_berat" <?php if ($alat['kondisi'] === 'rusak_berat') echo 'selected'; ?>>Rusak Berat</option>
    </select>
  </div>
  <div class="button-group">
    <button type="submit" class="btn btn-success">Update</button>
    <a href="index.php?page=alat" class="btn btn-secondary">Batal</a>
  </div>
</form>