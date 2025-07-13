<?php
include '../config/database.php'; // pastikan path benar

// Ambil data dari tabel transaksi_gift
$query = "SELECT * FROM transaksi_gift ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Hadiah - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Daftar Hadiah yang Dikirim</h2>
    <table class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Pengirim</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Pesan / Ucapan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_pengirim']) ?></td>
                        <td>Rp<?= number_format($row['nominal'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['metode']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['pesan'])) ?></td>
                        <td><?= $row['created_at'] ?? '-' ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">Belum ada hadiah yang dikirim.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>