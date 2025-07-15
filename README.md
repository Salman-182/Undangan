# LINK YOUTUBE
`
* https://youtu.be/TkZuXfE1tNU?si=HTCLpu_MqZHwy9id
``

# 📦 Undangan Pernikahan Digital - Dokumentasi Aplikasi

## 1.  Cara Instalasi Aplikasi

### 1.1 Persyaratan Sistem

* PHP versi 7.4 atau lebih tinggi (tested on PHP 8.3.19)
* MySQL/MariaDB
* Web server seperti Apache atau Nginx
* phpMyAdmin (opsional, untuk import database)

### 1.2 Langkah-Langkah Instalasi

#### a. Siapkan Hosting

* Gunakan CPanel/InfinityFree/VPS
* Buat satu direktori di `public_html/` (misalnya: `undangan/`)

#### b. Upload File Aplikasi

* Upload semua file dari `php.zip` ke direktori tujuan (gunakan File Manager atau FTP)

#### c. Buat Database

* Masuk ke CPanel > MySQL Database
* Buat database dan user, lalu catat:

  * DB\_NAME
  * DB\_USER
  * DB\_PASS

#### d. Import Struktur Database

* Buka phpMyAdmin
* Pilih database yang dibuat
* Import semua file SQL berikut secara berurutan:

  1. `admin.sql`
  2. `pengaturan_web.sql`
  3. `lokasi.sql`
  4. `acara.sql`
  5. `bank.sql`
  6. `tamu.sql`
  7. `kehadiran.sql`
  8. `ucapan.sql`
  9. `galeri.sql`
  10. `transaksi_gift.sql`

#### e. Konfigurasi Database

Edit file `config/database.php` sesuai kredensial database kamu:

```<?php
$host = "sql309.infinityfree.com";
$user = "if0_39465072";
$pass = "Aku31573";
$dbname = "if0_39465072_UndanganSalman";
```

#### f. Selesai

Akses web undangan kamu via browser:

```
UndanganSalman.ct.ws
```

---

## 2. 🧱 Struktur Database

### Tabel dan Relasi

| Tabel            | Deskripsi                              | Relasi                                            |
| ---------------- | -------------------------------------- | ------------------------------------------------- |
| `admin`          | Data admin login                       | -                                                 |
| `pengaturan_web` | Nama mempelai, warna tema, musik       | -                                                 |
| `lokasi`         | Tempat acara, alamat, link Google Maps | `acara.lokasi_id`                                 |
| `acara`          | Nama acara, tanggal, jam               | relasi ke `lokasi`                                |
| `bank`           | Rekening penerima hadiah               | `transaksi_gift.bank_id`                          |
| `tamu`           | Buku tamu (nama, email, WA)            | relasi ke `kehadiran`, `ucapan`, `transaksi_gift` |
| `kehadiran`      | Status konfirmasi kehadiran tamu       | FK ke `tamu.id`                                   |
| `ucapan`         | Ucapan dari tamu                       | FK ke `tamu.id`                                   |
| `galeri`         | Foto-foto kenangan                     | -                                                 |
| `transaksi_gift` | Donasi dari tamu ke rekening mempelai  | FK ke `tamu.id`, `bank.id`                        |

> Diagram ERD visual bisa dibuat dengan tools seperti dbdiagram.io atau Draw\.io (sesuai skema di atas).

---

## 3. 💡 Panduan Penggunaan Aplikasi

### 3.1 Login Admin

* Buka halaman login admin (contoh: `admin/login.php`)
* Masukkan username dan password dari tabel `admin`

### 3.2 Fitur Utama

#### 🧍 Buku Tamu

* Tamu mengisi form nama, alamat, WA, email, dan kehadiran
* Data tersimpan ke tabel `tamu`

#### 📝 Kirim Ucapan

* Tamu mengirimkan ucapan di halaman `ucapan.php`
* Disimpan ke tabel `ucapan`

#### 🎁 Kirim Hadiah

* Tamu memilih bank tujuan dan metode transfer
* Mengisi nama dan nominal gift
* Data masuk ke tabel `transaksi_gift`

#### 📸 Galeri Foto

* Gambar ditampilkan dari folder `uploads/`
* Admin bisa upload manual via FTP atau buat panel admin

#### ⚙️ Pengaturan Web

* Melihat daftar tamu, ucapan, gift masuk
* Edit pengaturan nama mempelai, lokasi, jadwal

---

## 📂 Struktur File (Contoh)

```
/config/
  database.php
/uploads/
  foto1.jpg, ...
/index.php
/gift.php
/ucapan.php
/admin/
  login.php, dashboard.php
