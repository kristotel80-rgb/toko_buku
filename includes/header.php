<?php

// Memulai session jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tentukan apakah halaman saat ini adalah halaman admin
$is_admin_page = isset($admin_page);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        <?= isset($page_title)
            ? htmlspecialchars($page_title) . ' — '
            : ''
        ?>
        BookNest
    </title>

    <link
        rel="stylesheet"
        href="<?= $is_admin_page
            ? '../assets/style.css'
            : 'assets/style.css'
        ?>"
    >

</head>

<body>

<header class="site-header">

    <div class="container nav-wrap">

        <!-- Logo -->
        <a
            class="brand"
            href="<?= $is_admin_page
                ? '../index.php'
                : 'index.php'
            ?>"
        >
            BOOK<span>NEST</span>
        </a>


        <!-- =================================================
             NAVBAR
             ================================================= -->

        <nav>

            <?php if ($is_admin_page): ?>
                <a href="index.php">
                    Dashboard
                </a>
                <a href="produk.php">
                    Buku
                </a>
                <a href="../index.php">
                    Website
                </a>
                <a href="logout.php">
                    Logout
                </a>
            <?php else: ?>

                <!-- ==============================
                     NAVBAR WEBSITE PUBLIK
                     ============================== -->

                <a href="index.php">
                    Beranda
                </a>

                <a href="produk.php">
                    Buku
                </a>

                <a href="tentang.php">
                    Tentang
                </a>

            <?php endif; ?>

        </nav>

    </div>

</header>

<main>