<?php
include '../config/database.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_wa = $_POST['no_wa'];
    $kehadiran = $_POST['kehadiran'];

    $stmt = $conn->prepare("INSERT INTO tamu (nama, alamat, email, no_wa, kehadiran) VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssss", $nama, $alamat, $email, $no_wa, $kehadiran);

    if ($stmt->execute()) {
        echo "<script>alert('Terima kasih atas konfirmasi Anda!'); location.href='index.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Gagal menyimpan data tamu.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Undangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">📖 Buku Tamu Pernikahan</h2>
    <form action="" method="POST" class="shadow p-4 bg-white rounded">
        <div class="mb-3">
            <label class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">No. WhatsApp</label>
            <input type="text" name="no_wa" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Kehadiran <span class="text-danger">*</span></label>
            <select name="kehadiran" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Hadir">Hadir</option>
                <option value="Tidak Hadir">Tidak Hadir</option>
            </select>
        </div>
        <button class="btn btn-success" type="submit" name="submit">Kirim</button>
    </form>
   <div class="container mt-4">
  <div class="row">
    <div class="col text-start">
      <a href="ucapan.php" class="btn btn-outline-primary">
        📝 Kirim Ucapan
      </a>
    </div>
    <div class="col text-end">
      <a href="gift.php" class="btn btn-outline-primary">
        🎁 Kirim Hadiah
      </a>
    </div>
  </div>
</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu, Gift & Ucapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Quicksand&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fffaf7;
            font-family: 'Quicksand', sans-serif;
            color: #5e504a;
        }

        h2 {
            font-family: 'Great Vibes', cursive;
            font-size: 3rem;
            text-align: center;
            color: #b0886a;
            margin-bottom: 30px;
        }

        .section {
            padding: 60px 0;
        }

        .shadow-box {
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 40px;
        }

        .galeri-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 6px 16px rgba(224, 207, 193, 0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
        }

        .galeri-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 30px rgba(176, 136, 106, 0.3);
        }

        .galeri-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .no-photos {
            text-align: center;
            font-style: italic;
            color: #a09790;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<div class="container galeri-section">
    <h2>📸 Galeri Kenangan</h2>
    <div class="row">
        <?php
        $dir = "uploads/";
        $files = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        if ($files) {
            foreach ($files as $file) {
                echo '<div class="col-md-3 col-sm-6 mb-4">
                        <div class="galeri-card">
                            <img src="' . $file . '" alt="Foto Galeri">
                        </div>
                      </div>';
            }
        } else {
            echo "<p class='no-photos'>Belum ada foto galeri yang ditambahkan.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
