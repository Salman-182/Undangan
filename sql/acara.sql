CREATE TABLE acara (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama_acara VARCHAR(100),
    tanggal DATE,
    waktu_mulai TIME,
    waktu_selesai TIME,
    lokasi_id INT(11),
    FOREIGN KEY (lokasi_id) REFERENCES lokasi(id)
);
