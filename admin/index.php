<?php

// Tandai bahwa halaman ini adalah halaman admin
$admin_page = true;

// Load file yang diperlukan
require '../includes/auth.php';
require '../config/database.php';
require '../includes/flash.php';

$page_title = 'Dashboard';

/*
|--------------------------------------------------------------------------
| Statistik Dashboard
|--------------------------------------------------------------------------
*/

// Total jumlah buku
$query_total = $conn->query(
    'SELECT COUNT(*) AS c FROM produk'
);

$total = $query_total->fetch_assoc()['c'];

// Total seluruh stok buku
$query_stock = $conn->query(
    'SELECT COALESCE(SUM(stok), 0) AS c FROM produk'
);

$stock = $query_stock->fetch_assoc()['c'];

// Total kategori buku
$query_categories = $conn->query(
    'SELECT COUNT(DISTINCT kategori) AS c FROM produk'
);

$cats = $query_categories->fetch_assoc()['c'];

// Header
include '../includes/header.php';

?>

<section class="admin-shell">
    <div class="container">

        <!-- Header Dashboard -->
        <div class="admin-top">

            <div>
                <div class="eyebrow">
                    BookNest Admin
                </div>

                <h1>Dashboard</h1>

                <p class="muted">
                    Selamat datang,
                    <?= htmlspecialchars($_SESSION['admin_username']) ?>.
                </p>
            </div>

        </div>

        <!-- Notifikasi -->
        <?php show_flash(); ?>

        <!-- Statistik -->
        <div class="stats">

            <!-- Total Buku -->
            <div class="stat">
                <small>Total Buku</small>

                <strong>
                    <?= $total ?>
                </strong>
            </div>

            <!-- Total Kategori -->
            <div class="stat">
                <small>Kategori</small>

                <strong>
                    <?= $cats ?>
                </strong>
            </div>

            <!-- Total Stok -->
            <div class="stat">
                <small>Total Stok</small>

                <strong>
                    <?= $stock ?>
                </strong>
            </div>

        </div>

        <!-- Manajemen Katalog -->
        <div class="form-card">

            <h2>Manajemen Katalog</h2>

            <p class="muted">
                Kelola judul, penulis, harga, stok,
                dan informasi buku.
            </p>

            <a class="btn" href="produk.php">
                Kelola Buku
            </a>

        </div>

    </div>
</section>

