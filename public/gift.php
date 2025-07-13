<?php
include '../config/database.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nominal = $_POST['nominal'];
    $metode = $_POST['metode'];
    $pesan = $_POST['pesan'];

    $stmt = $conn->prepare("INSERT INTO transaksi_gift (nama_pengirim, nominal, metode, pesan) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sdss", $nama, $nominal, $metode, $pesan);

    if ($stmt->execute()) {
        echo "<script>alert('Terima kasih atas hadiah yang diberikan!'); location.href='index.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menyimpan data.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Hadiah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fffaf7; font-family: sans-serif; color: #5e504a;">

<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #b0886a;">🎁 Kirim Hadiah</h2>

    <form method="POST" class="shadow p-4 rounded bg-white">
        <div class="mb-3">
            <label class="form-label">Nama Pengirim</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nominal (Rp)</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Transfer BCA">Transfer BCA</option>
                <option value="Transfer Mandiri">Transfer Mandiri</option>
                <option value="QRIS">QRIS</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Pesan / Doa</label>
            <textarea name="pesan" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Kirim Hadiah</button>
    </form>

    <div class="text-end mt-3">
        <a href="index.php" class="btn btn-outline-secondary">⬅️ Kembali</a>
    </div>
</div>

</body>
</html>
