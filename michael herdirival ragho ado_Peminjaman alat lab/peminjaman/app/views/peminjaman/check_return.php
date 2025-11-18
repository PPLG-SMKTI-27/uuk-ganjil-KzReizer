<div class="header">
  <h1>🔍 Cek Pengembalian Alat</h1>
  <p style="color: #7f8c8d; font-size: 14px;">Validasi pengembalian alat dari user</p>
</div>

<?php if (empty($pendingReturns)): ?>
  <div class="no-data">
    <p>✓ Semua pengembalian sudah divalidasi!</p>
  </div>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>User</th>
        <th>Alat</th>
        <th>Tanggal Pinjam</th>
        <th>Status Alat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($pendingReturns as $item): ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo htmlspecialchars($item['username']); ?></td>
          <td><?php echo htmlspecialchars($item['nama']); ?></td>
          <td><?php echo date('d/m/Y', strtotime($item['tanggal_pinjam'])); ?></td>
          <td>
            <span class="status-badge status-requestreturn">
              ⏳ Request Kembali
            </span>
          </td>
          <td>
            <a href="index.php?page=peminjaman&action=approve_return&id=<?php echo $item['id']; ?>" class="btn btn-success" style="font-size: 12px; padding: 6px 12px;">✓ Terima</a>
            <a href="index.php?page=peminjaman&action=reject_return&id=<?php echo $item['id']; ?>" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px; margin-left: 5px;">✗ Tolak</a>
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

.status-requestreturn {
  background: #fff3cd;
  color: #856404;
}
</style>
