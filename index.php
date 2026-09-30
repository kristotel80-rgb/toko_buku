<?php

// Koneksi database
require 'config/database.php';

/*
|--------------------------------------------------------------------------
| Pengaturan Halaman
|--------------------------------------------------------------------------
*/

$page_title = 'Beranda';

/*
|--------------------------------------------------------------------------
| Ambil 4 Buku Terbaru
|--------------------------------------------------------------------------
*/

$result = $conn->query(
    'SELECT * FROM produk
     ORDER BY id DESC
     LIMIT 4'
);

$books = [];

while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

// Header
include 'includes/header.php';

?>


<!-- =========================================================
     HERO SECTION
     ========================================================= -->

<section class="hero">

    <div class="container hero-grid">

        <div>

            <div class="eyebrow">
                Bookstore · Curated Collection
            </div>

            <h1>
                Temukan cerita berikutnya.
            </h1>

            <p>
                Koleksi buku pilihan untuk menemani setiap perjalanan,
                dari novel yang sedang banyak dicari hingga buku
                pengembangan diri.
            </p>

            <a
                class="btn"
                href="produk.php"
            >
                Jelajahi Buku
            </a>

        </div>


        <!-- Ilustrasi Hero -->

        <div class="hero-art">

            <div class="book-stack">

                <small>
                    BOOKNEST
                </small>

                <strong>
                    READ.<br>
                    FEEL.<br>
                    GROW.
                </strong>

                <small>
                    EST. 2026
                </small>

            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     BUKU TERBARU / SEDANG BANYAK DICARI
     ========================================================= -->

<section class="section">

    <div class="container">

        <div class="section-head">

            <div>

                <div class="eyebrow">
                    Curated for you
                </div>

                <h2>
                    Sedang Banyak Dicari
                </h2>

            </div>

            <a href="produk.php">
                Lihat semua →
            </a>

        </div>


        <!-- Daftar Buku -->

        <div class="books-grid">

            <?php foreach ($books as $buku): ?>

                <a
                    class="book-card"
                    href="detail.php?id=<?= $buku['id'] ?>"
                >

                    <!-- Cover Buku -->

                    <div class="cover">

                        <?php if ($buku['gambar']): ?>

                            <img
                                src="uploads/produk/<?= htmlspecialchars($buku['gambar']) ?>"
                                alt="<?= htmlspecialchars($buku['nama']) ?>"
                            >

                        <?php else: ?>

                            <div class="cover-placeholder">

                                <small>
                                    <?= htmlspecialchars($buku['kategori']) ?>
                                </small>

                                <b>
                                    <?= htmlspecialchars($buku['nama']) ?>
                                </b>

                                <small>
                                    <?= htmlspecialchars($buku['penulis']) ?>
                                </small>

                            </div>

                        <?php endif; ?>

                    </div>


                    <!-- Informasi Buku -->

                    <div class="book-info">

                        <h3>
                            <?= htmlspecialchars($buku['nama']) ?>
                        </h3>

                        <div class="author">
                            <?= htmlspecialchars($buku['penulis']) ?>
                        </div>

                        <div class="price">
                            Rp<?= number_format(
                                $buku['harga'],
                                0,
                                ',',
                                '.'
                            ) ?>
                        </div>

                    </div>

                </a>

            <?php endforeach; ?>

        </div>

    </div>

</section>



<!-- =========================================================
     KATEGORI BUKU
     ========================================================= -->

<section
    class="section"
    style="padding-top: 10px;"
>

    <div class="container">

        <div class="section-head">

            <div>

                <div class="eyebrow">
                    Explore
                </div>

                <h2>
                    Temukan berdasarkan minat
                </h2>

            </div>

        </div>


        <div class="categories">

            <!-- Novel -->

            <a
                class="category"
                href="produk.php?kategori=Novel"
            >

                <h3>
                    Novel
                </h3>

                <span class="muted">
                    Cerita untuk dibaca perlahan.
                </span>

            </a>


            <!-- Self Improvement -->

            <a
                class="category"
                href="produk.php?kategori=Self Improvement"
            >

                <h3>
                    Self Improvement
                </h3>

                <span class="muted">
                    Ide untuk tumbuh setiap hari.
                </span>

            </a>


            <!-- Fantasy & Mystery -->

            <a
                class="category"
                href="produk.php?kategori=Fantasy"
            >

                <h3>
                    Fantasy & Mystery
                </h3>

                <span class="muted">
                    Dunia lain, misteri baru.
                </span>

            </a>

        </div>

    </div>

</section>



<!-- =========================================================
     CALL TO ACTION
     ========================================================= -->

<section class="cta">

    <h2>
        Satu buku bisa mengubah cara kamu melihat dunia.
    </h2>

    <a
        class="btn"
        href="produk.php"
    >
        Temukan Buku
    </a>

</section>



<?php

// Footer
include 'includes/footer.php';

?>