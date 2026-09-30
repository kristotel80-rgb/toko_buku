<?php

$admin_page = true;

require '../includes/auth.php';
require '../config/database.php';

// Ambil ID buku dari URL
$id = (int) ($_GET['id'] ?? 0);

// Ambil data buku berdasarkan ID
$stmt = $conn->prepare(
    'SELECT * FROM produk WHERE id = ?'
);

$stmt->bind_param('i', $id);
$stmt->execute();

$b = $stmt->get_result()->fetch_assoc();

// Cek apakah buku ditemukan
if (!$b) {
    die('Buku tidak ditemukan.');
}

$page_title = 'Edit Buku';

include '../includes/header.php';

?>

<section class="admin-shell">
    <div class="container">

        <!-- Header Halaman -->
        <div class="admin-top">
            <div>
                <div class="eyebrow">Catalog</div>
                <h1>Edit Buku</h1>
            </div>

            <a href="produk.php">← Kembali</a>
        </div>

        <!-- Form Edit Buku -->
        <div class="form-card">
            <form
                method="post"
                action="proses_produk.php"
                enctype="multipart/form-data"
            >

                <!-- Data untuk proses edit -->
                <input
                    type="hidden"
                    name="aksi"
                    value="edit"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?= $b['id'] ?>"
                >

                <!-- Form Input Buku -->
                <?php include 'form.php'; ?>

                <!-- Tombol Simpan -->
                <button
                    class="btn"
                    type="submit"
                >
                    Simpan Perubahan
                </button>

            </form>
        </div>

    </div>
</section>
