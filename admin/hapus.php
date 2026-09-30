<?php

require '../includes/auth.php';
require '../config/database.php';
require '../includes/flash.php';

// Ambil ID buku dari URL
$id = (int) ($_GET['id'] ?? 0);

// Ambil nama file gambar berdasarkan ID buku
$stmt = $conn->prepare(
    'SELECT gambar FROM produk WHERE id = ?'
);

$stmt->bind_param('i', $id);
$stmt->execute();

$buku = $stmt->get_result()->fetch_assoc();

// Jika data buku ditemukan
if ($buku) {

    // Hapus data buku dari database
    $delete = $conn->prepare(
        'DELETE FROM produk WHERE id = ?'
    );

    $delete->bind_param('i', $id);
    $delete->execute();

    // Hapus file cover dari folder uploads/produk
    if (
        !empty($buku['gambar']) &&
        is_file(
            __DIR__ . '/../uploads/produk/' . $buku['gambar']
        )
    ) {
        @unlink(
            __DIR__ . '/../uploads/produk/' . $buku['gambar']
        );
    }

    // Tampilkan pesan berhasil
    set_flash(
        'success',
        'Buku berhasil dihapus.'
    );
}

// Kembali ke halaman daftar buku
header('Location: produk.php');
exit;

?>
