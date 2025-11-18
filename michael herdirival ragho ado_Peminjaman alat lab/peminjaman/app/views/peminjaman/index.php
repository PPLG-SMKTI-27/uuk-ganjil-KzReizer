<div class="header">
  <h1>📋 Peminjaman Saya</h1>
  <a href="index.php?page=peminjaman&action=create" class="btn btn-success">+ Ajukan Peminjaman</a>
</div>

<?php 
// Filter hanya peminjaman user saat ini
$my_peminjaman = array_filter($peminjaman, function($item) {
  return (int)$item['user_id'] === (int)$_SESSION['user']['id'];
});
?>

<?php if (empty($my_peminjaman)): ?>
  <div class="no-data">
    <p>Belum ada data peminjaman. <a href="index.php?page=peminjaman&action=create">Ajukan peminjaman sekarang</a></p>
  </div>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Alat</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($my_peminjaman as $item): ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo htmlspecialchars($item['nama']); ?></td>
          <td><?php echo date('d/m/Y', strtotime($item['tanggal_pinjam'])); ?></td>
          <td><?php echo $item['tanggal_kembali'] ? date('d/m/Y', strtotime($item['tanggal_kembali'])) : '-'; ?></td>
          <td>
            <span class="status-badge status-<?php echo str_replace('_', '', $item['status']); ?>">
              <?php echo ucfirst(str_replace('_', ' ', $item['status'])); ?>
            </span>
          </td>
          <td>
            <?php if ($item['status'] === 'disetujui'): ?>
              <a href="index.php?page=peminjaman&action=return&id=<?php echo $item['id']; ?>" class="btn btn-success" style="font-size: 12px; padding: 6px 12px;">📤 Request Kembalikan</a>
            <?php elseif ($item['status'] === 'request_return'): ?>
              <span style="color: #f39c12; font-size: 12px;">⏳ Menunggu Konfirmasi</span>
            <?php elseif ($item['status'] === 'dikembalikan'): ?>
              <span style="color: #27ae60; font-size: 12px;">✓ Selesai</span>
            <?php else: ?>
              <span style="color: #95a5a6; font-size: 12px;">-</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>