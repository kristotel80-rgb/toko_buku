CREATE DATABASE IF NOT EXISTS db_booknest CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_booknest;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS produk;
CREATE TABLE admin (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE produk (id INT AUTO_INCREMENT PRIMARY KEY, nama VARCHAR(150) NOT NULL, penulis VARCHAR(120) NOT NULL, kategori VARCHAR(80) NOT NULL, deskripsi TEXT, harga DECIMAL(12,2) NOT NULL DEFAULT 0, stok INT NOT NULL DEFAULT 0, penerbit VARCHAR(120), tahun_terbit YEAR NULL, isbn VARCHAR(30), gambar VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);
INSERT INTO admin(username,password) VALUES ('admin','$2y$12$EHBspauf9pxy7hS9tybD8.htZb9SQZM.Hhpp7lBbWCe9l1.rFQF/i');
INSERT INTO produk(nama,penulis,kategori,deskripsi,harga,stok,penerbit,tahun_terbit,isbn,gambar) VALUES
('Dark Matter','Blake Crouch','Thriller','Sebuah thriller fiksi ilmiah tentang pilihan hidup, kemungkinan dunia lain, dan perjalanan seorang pria untuk kembali kepada keluarganya.',125000,12,'Crown',2016,'9781101884258',''),
('Piranesi','Susanna Clarke','Fantasy','Novel misteri dan fantasi tentang sebuah rumah tak berujung, patung-patung, laut pasang, dan rahasia identitas.',145000,8,'Bloomsbury',2020,'9781526622440',''),
('Atomic Habits','James Clear','Self Improvement','Panduan praktis membangun kebiasaan baik melalui perubahan kecil yang konsisten.',119000,15,'Avery',2018,'9780735211292',''),
('Golden Son','Pierce Brown','Science Fiction','Kelanjutan perjalanan Darrow dalam dunia penuh konflik, strategi, dan perjuangan kelas.',155000,7,'Del Rey',2015,'9780345539829',''),
('Srivijaya','Herald van der Linde','Sejarah','Bacaan mengenai sejarah dan peran Sriwijaya dalam perkembangan kawasan Asia Tenggara.',139000,9,'HarperCollins',2026,'',''),
('Pareidolia','Tere Liye','Novel','Novel Indonesia dengan kisah dan karakter yang mengajak pembaca melihat makna dari hal-hal yang tampak sederhana.',98000,10,'Gramedia',2026,'',''),
('Seporsi Mie Ayam Sebelum Mati','Brian Khrisna','Novel','Kisah reflektif dengan humor dan emosi yang dekat dengan kehidupan sehari-hari.',99000,11,'Gramedia',2025,'',''),
('The Let Them Theory','Mel Robbins','Self Improvement','Gagasan tentang melepaskan kebutuhan mengendalikan orang lain dan memusatkan perhatian pada hal yang dapat kita kendalikan.',135000,14,'Hay House',2024,'9781401971366','');
