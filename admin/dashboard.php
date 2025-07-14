<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; font-family: sans-serif;">
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>👋 Selamat datang, <?= htmlspecialchars($_SESSION['admin_name']) ?></h3>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="row g-3">
        <!-- Data Tamu -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill display-4 text-primary"></i>
                    <h5 class="card-title mt-2">Data Tamu</h5>
                    <a href="daftar.php" class="btn btn-outline-primary btn-sm mt-2">Lihat Tamu</a>
                </div>
            </div>
        </div>

        <!-- Ucapan Tamu -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-chat-dots-fill display-4 text-warning"></i>
                    <h5 class="card-title mt-2">Ucapan Tamu</h5>
                    <a href="ucapan.php" class="btn btn-outline-warning btn-sm mt-2">Lihat Ucapan</a>
                </div>
            </div>
        </div>

        <!-- Galeri -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-card-image display-4 text-info"></i>
                    <h5 class="card-title mt-2">Galeri</h5>
                    <a href="galeri.php" class="btn btn-outline-info btn-sm mt-2">Kelola Galeri</a>
                </div>
            </div>
        </div>

        <!-- Transaksi Gift -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-gift-fill display-4 text-success"></i>
                    <h5 class="card-title mt-2">Transaksi Gift</h5>
                    <a href="gift_transaksi.php" class="btn btn-outline-success btn-sm mt-2">Lihat Transaksi</a>
                </div>
            </div>
        </div>

        <!-- Pengaturan Web -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-gear-fill display-4 text-secondary"></i>
                    <h5 class="card-title mt-2">Pengaturan Web</h5>
                    <a href="pengaturan.php" class="btn btn-outline-secondary btn-sm mt-2">Edit Pengaturan</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
