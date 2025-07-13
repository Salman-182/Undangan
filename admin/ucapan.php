<?php
// Set zona waktu Indonesia Tengah (WITA)
date_default_timezone_set('Asia/Makassar');

// Fungsi untuk format tanggal tetap dengan WITA
function formatTanggalTetap($jam = '00:00:00') {
    $tanggal = "2025-07-14";
    $timestamp = strtotime("$tanggal $jam");
    
    $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    $namaHari = $hari[date('w', $timestamp)];
    $namaBulan = $bulan[date('n', $timestamp) - 1];
    $tgl = date('j', $timestamp);
    $tahun = date('Y', $timestamp);
    $jamFormatted = date('H:i', $timestamp);

    return "$namaHari, $tgl $namaBulan $tahun - $jamFormatted WITA";
}

// Lokasi file ucapan
$filename = "../data/ucapan.txt";

// Ambil semua ucapan jika file ada
$ucapan = [];
if (file_exists($filename)) {
    $baris = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($baris as $line) {
        [$tanggal, $nama, $pesan] = explode("|", $line);

        // Ambil jam dari tanggal asli
        $jam = date('H:i:s', strtotime($tanggal));

        $ucapan[] = [
            'jam' => $jam,
            'nama' => $nama,
            'pesan' => $pesan
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Ucapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">📋 Laporan Ucapan</h2>

    <?php if (empty($ucapan)): ?>
        <div class="alert alert-info">Belum ada ucapan.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Ucapan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ucapan as $row): ?>
                    <tr>
                        <td><?= formatTanggalTetap($row['jam']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['pesan']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="dashboard.php" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>
</div>
</body>
</html>
