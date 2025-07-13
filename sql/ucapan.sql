CREATE TABLE ucapan (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    tamu_id INT(11),
    isi TEXT,
    waktu_kirim DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tamu_id) REFERENCES tamu(id)
);