<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include '../config/database.php';

$query = "SELECT * FROM transaksi_gift ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Gift</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3 class="mb-4">Daftar Transaksi Gift</h3>
        <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                    <th>Pesan</th>
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
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">Belum ada data gift.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
