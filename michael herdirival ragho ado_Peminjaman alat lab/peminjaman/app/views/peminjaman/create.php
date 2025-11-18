<h1>📋 Ajukan Peminjaman</h1>

<form method="POST" action="index.php?page=peminjaman&action=create">
  <div class="form-group">
    <label for="alat_id">Alat</label>
    <select id="alat_id" name="alat_id" required>
      <option value="">-- Pilih Alat --</option>
      <?php foreach ($alat as $item): ?>
        <option value="<?php echo $item['id']; ?>">
          <?php echo htmlspecialchars($item['nama']); ?> (Stok: <?php echo $item['stok']; ?>)
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="tanggal_pinjam">Tanggal Pinjam</label>
    <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" required>
  </div>
  <div class="button-group">
    <button type="submit" class="btn btn-success">Ajukan</button>
    <a href="index.php?page=peminjaman" class="btn btn-secondary">Batal</a>
  </div>
</form>