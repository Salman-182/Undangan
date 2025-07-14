<?php
include '../config/database.php';

// Data akun baru
$username = "admin";
$password = "admin123";
$nama = "Admin Undangan";
$hash = password_hash($password, PASSWORD_DEFAULT);

// Tambahkan admin baru
$stmt = $conn->prepare("INSERT INTO admin (username, password, nama_lengkap) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hash, $nama);

if ($stmt->execute()) {
    echo "✅ Admin berhasil direset.<br>";
    echo "Username: <strong>$username</strong><br>";
    echo "Password: <strong>$password</strong>";
} else {
    echo "❌ Gagal reset admin: " . $stmt->error;
}
?>
