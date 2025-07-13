CREATE TABLE transaksi_gift (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama_pengirim VARCHAR(30) NOT NULL,
    metode VARCHAR(20) NOT NULL,
    tamu_id INT(11),
    bank_id INT(11),
    nominal DECIMAL(12,2),
    pesan TEXT,
    FOREIGN KEY (tamu_id) REFERENCES tamu(id),
    FOREIGN KEY (bank_id) REFERENCES bank(id)
);