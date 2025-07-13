<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$uploadDir = '../public/uploads/';
$message = "";

// Buat folder jika belum ada
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Upload gambar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['gambar'])) {
    $filename = basename($_FILES['gambar']['name']);
    $target = $uploadDir . $filename;
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $allowed)) {
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $message = "<div class='alert alert-success'>Foto berhasil diunggah.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Gagal mengunggah foto.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Format tidak didukung.</div>";
    }
}

// Hapus gambar
if (isset($_GET['hapus'])) {
    $hapusFile = $uploadDir . basename($_GET['hapus']);
    if (file_exists($hapusFile)) {
        unlink($hapusFile);
        $message = "<div class='alert alert-success'>Foto berhasil dihapus.</div>";
    } else {
        $message = "<div class='alert alert-danger'>File tidak ditemukan.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3 class="mb-4">📸 Kelola Galeri</h3>

    <?= $message ?>

    <!-- Form upload -->
    <form method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="input-group">
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
            <button class="btn btn-primary" type="submit">Upload</button>
        </div>
    </form>

    <!-- Tampilkan foto -->
    <div class="row">
        <?php
        $files = glob($uploadDir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        if ($files) {
            foreach ($files as $file) {
                $fileName = basename($file);
                echo '<div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="' . $uploadDir . $fileName . '" class="card-img-top" alt="Foto">
                            <div class="card-body text-center">
                                <a href="?hapus=' . $fileName . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin hapus foto ini?\')">Hapus</a>
                            </div>
                        </div>
                      </div>';
            }
        } else {
            echo "<p class='text-center'>Belum ada foto di galeri.</p>";
        }
        ?>
    </div>

    <div class="mt-3">
        <a href="dashboard.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Dashboard</a>
    </div>
</div>
</body>
</html>
