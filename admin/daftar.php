<?php
include '../config/database.php';

if (isset($_POST['submit'])) {
    $nama      = $_POST['nama'];
    $alamat    = $_POST['alamat'];
    $email     = $_POST['email'];
    $no_wa     = $_POST['no_wa'];
    $kehadiran = $_POST['kehadiran'];

    $stmt = $conn->prepare("INSERT INTO tamu (nama, alamat, email, no_wa, kehadiran, waktu_daftar) VALUES (?, ?, ?, ?, ?, NOW())");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssss", $nama, $alamat, $email, $no_wa, $kehadiran); // HANYA 5 parameter

    if ($stmt->execute()) {
        echo "<script>alert('Terima kasih atas konfirmasi Anda!'); window.location='index.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Gagal menyimpan data tamu: " . $stmt->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">📄 Daftar Tamu Undangan</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>No. WA</th>
                    <th>Kehadiran</th>
                    <th>Waktu Daftar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM tamu ORDER BY waktu_daftar DESC");

                if (!$result) {
                    echo "<tr><td colspan='8' class='text-danger'>Query error: " . $conn->error . "</td></tr>";
                } elseif ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$no}</td>
                            <td>" . htmlspecialchars($row['nama']) . "</td>
                            <td>" . htmlspecialchars($row['alamat']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['no_wa']) . "</td>
                            <td>" . htmlspecialchars($row['kehadiran']) . "</td>
                            <td>" . date('d-m-Y H:i', strtotime($row['waktu_daftar'])) . "</td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Belum ada tamu yang mengisi.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-3">
        <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
    </div>
</div>
</body>
</html>