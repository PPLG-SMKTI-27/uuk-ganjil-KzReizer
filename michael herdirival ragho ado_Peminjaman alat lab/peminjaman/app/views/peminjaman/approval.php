<div class="header">
  <h1>✓ Persetujuan Peminjaman</h1>
  <p style="color: #7f8c8d; font-size: 14px;">Daftar permintaan peminjaman yang menunggu persetujuan</p>
</div>

<?php if (empty($approvalList)): ?>
  <div class="no-data">
    <p>✓ Semua permintaan sudah diproses!</p>
  </div>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>User</th>
        <th>Alat</th>
        <th>Tanggal Pinjam</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($approvalList as $item): ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo htmlspecialchars($item['username']); ?></td>
          <td><?php echo htmlspecialchars($item['nama']); ?></td>
          <td><?php echo date('d/m/Y', strtotime($item['tanggal_pinjam'])); ?></td>
          <td>
            <span class="status-badge status-pending">
              Menunggu
            </span>
          </td>
          <td>
            <a href="index.php?page=peminjaman&action=approve&id=<?php echo $item['id']; ?>" class="btn btn-success" style="font-size: 12px; padding: 6px 12px;">✓ Setujui</a>
            <a href="index.php?page=peminjaman&action=reject&id=<?php echo $item['id']; ?>" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px; margin-left: 5px;">✗ Tolak</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<style>
.btn-danger {
  background-color: #e74c3c;
  color: white;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
  transition: background-color 0.3s;
}

.btn-danger:hover {
  background-color: #c0392b;
}
</style>
