<?php
// Lokasi file penyimpanan ucapan
$filename = "../data/ucapan.txt";

// Cek dan buat folder jika belum ada
if (!file_exists(dirname($filename))) {
    mkdir(dirname($filename), 0777, true); // buat folder 'data' jika tidak ada
}

$success = false;

// Proses form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama'], $_POST['pesan'])) {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $pesan = htmlspecialchars(trim($_POST['pesan']));
    $tanggal = date("Y-m-d H:i:s");

    // Format penyimpanan: tanggal|nama|pesan
    $baris = "$tanggal|$nama|$pesan" . PHP_EOL;
    file_put_contents($filename, $baris, FILE_APPEND | LOCK_EX);

    $success = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Ucapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">📝 Kirim Ucapan</h2>

    <?php if ($success): ?>
        <div class="alert alert-success">Ucapan berhasil dikirim!</div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Anda:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="pesan" class="form-label">Ucapan:</label>
            <textarea class="form-control" id="pesan" name="pesan" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>

    <!-- Tombol kembali ke index -->
    <div class="mt-4 text-center">
        <a href="index.php" class="btn btn-secondary">⬅ Kembali ke Halaman Utama</a>
    </div>
</div>
</body>
</html>
