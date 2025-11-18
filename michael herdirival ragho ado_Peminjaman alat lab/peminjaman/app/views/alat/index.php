<div class="header">
  <h1>📦 Data Alat</h1>
  <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <a href="index.php?page=alat&action=create" class="btn btn-success">+ Tambah Alat</a>
  <?php endif; ?>
</div>

<form method="GET" action="index.php?page=alat" style="margin-bottom: 20px;">
  <div style="display: flex; gap: 10px;">
    <input type="text" name="search" placeholder="Cari nama atau kategori alat..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="flex: 1; padding: 10px; border: 1px solid #bdc3c7; border-radius: 5px; font-size: 14px;">
    <button type="submit" class="btn btn-success" style="padding: 10px 20px;">🔍 Cari</button>
    <?php if (isset($_GET['search']) && $_GET['search'] !== ''): ?>
      <a href="index.php?page=alat" class="btn btn-secondary" style="padding: 10px 20px; text-decoration: none; display: flex; align-items: center;">✕ Reset</a>
    <?php endif; ?>
  </div>
</form>

<?php if (empty($alat)): ?>
  <div class="no-data">
    <p>Belum ada data alat.</p>
  </div>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Alat</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Kondisi</th>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
          <th>Aksi</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($alat as $item): ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo htmlspecialchars($item['nama']); ?></td>
          <td><?php echo htmlspecialchars($item['kategori']); ?></td>
          <td><?php echo $item['stok']; ?></td>
          <td><?php echo htmlspecialchars($item['kondisi']); ?></td>
          <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <td>
              <div class="action-buttons">
                <a href="index.php?page=alat&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="index.php?page=alat&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
              </div>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
