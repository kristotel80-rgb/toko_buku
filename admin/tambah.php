<?php

// Tandai bahwa halaman ini adalah halaman admin
$admin_page = true;

// Cek autentikasi admin
require '../includes/auth.php';

$page_title = 'Tambah Buku';

// Header
include '../includes/header.php';

?>

<section class="admin-shell">
    <div class="container">

        <!-- Header Halaman -->
        <div class="admin-top">

            <div>
                <div class="eyebrow">
                    Catalog
                </div>

                <h1>Tambah Buku</h1>
            </div>

            <!-- Tombol Kembali -->
            <a href="produk.php">
                ← Kembali
            </a>

        </div>

        <!-- Form Tambah Buku -->
        <div class="form-card">

            <form
                method="post"
                action="proses_produk.php"
                enctype="multipart/form-data"
            >

                <!-- Menentukan aksi yang dilakukan -->
                <input
                    type="hidden"
                    name="aksi"
                    value="tambah"
                >

                <!-- Form Input Buku -->
                <?php include 'form.php'; ?>

                <!-- Tombol Simpan -->
                <button
                    class="btn"
                    type="submit"
                >
                    Simpan Buku
                </button>

            </form>

        </div>

    </div>
</section>

