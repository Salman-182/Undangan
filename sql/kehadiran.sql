CREATE TABLE kehadiran (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    tamu_id INT(11),
    status ENUM('Hadir', 'Tidak Hadir', 'Belum Konfirmasi') DEFAULT 'Belum Konfirmasi',
    kehadiran VARCHAR(20),
    waktu_konfirmasi DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tamu_id) REFERENCES tamu(id)
);