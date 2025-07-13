<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$file = "../data/pengaturan.json";
$message = "";

// Ambil data lama jika ada
$data = [
    'mempelai_pria' => '',
    'mempelai_wanita' => '',
    'tanggal' => '',
    'lokasi' => '',
    'sambutan' => ''
];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $data = json_decode($json, true);
}

// Simpan data baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'mempelai_pria' => $_POST['mempelai_pria'],
        'mempelai_wanita' => $_POST['mempelai_wanita'],
        'tanggal' => $_POST['tanggal'],
        'lokasi' => $_POST['lokasi'],
        'sambutan' => $_POST['sambutan']
    ];

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    $message = "<div class='alert alert-success'>Pengaturan berhasil disimpan.</div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengaturan Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">⚙️ Edit Pengaturan Web</h3>

    <?= $message ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Mempelai Pria</label>
            <input type="text" name="mempelai_pria" class="form-control" required value="<?= htmlspecialchars($data['mempelai_pria']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Mempelai Wanita</label>
            <input type="text" name="mempelai_wanita" class="form-control" required value="<?= htmlspecialchars($data['mempelai_wanita']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Pernikahan</label>
            <input type="date" name="tanggal" class="form-control" required value="<?= htmlspecialchars($data['tanggal']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi Acara</label>
            <input type="text" name="lokasi" class="form-control" required value="<?= htmlspecialchars($data['lokasi']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Pesan Sambutan</label>
            <textarea name="sambutan" class="form-control" rows="4" required><?= htmlspecialchars($data['sambutan']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        <a href="dashboard.php" class="btn btn-secondary">← Kembali</a>
    </form>
</div>
</body>
</html>
