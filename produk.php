<?php

// Koneksi database
require 'config/database.php';

/*
|--------------------------------------------------------------------------
| Pengaturan Halaman
|--------------------------------------------------------------------------
*/

$page_title = 'Koleksi Buku';


/*
|--------------------------------------------------------------------------
| Ambil Parameter Pencarian & Kategori
|--------------------------------------------------------------------------
*/

$q = trim($_GET['q'] ?? '');
$kategori = trim($_GET['kategori'] ?? '');


/*
|--------------------------------------------------------------------------
| Query Buku
|--------------------------------------------------------------------------
*/

$sql = 'SELECT * FROM produk WHERE 1=1';

$types = '';
$params = [];


/*
|--------------------------------------------------------------------------
| Filter Pencarian
|--------------------------------------------------------------------------
*/

if ($q !== '') {

    $sql .= '
        AND (
            nama LIKE ?
            OR penulis LIKE ?
            OR penerbit LIKE ?
        )
    ';

    $keyword = "%$q%";

    $params = [
        $keyword,
        $keyword,
        $keyword
    ];

    $types = 'sss';
}


/*
|--------------------------------------------------------------------------
| Filter Kategori
|--------------------------------------------------------------------------
*/

if ($kategori !== '') {

    $sql .= ' AND kategori = ?';

    $params[] = $kategori;
    $types .= 's';
}


/*
|--------------------------------------------------------------------------
| Urutkan Buku Terbaru
|--------------------------------------------------------------------------
*/

$sql .= ' ORDER BY id DESC';


/*
|--------------------------------------------------------------------------
| Jalankan Query
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare($sql);

if ($types !== '') {

    $stmt->bind_param(
        $types,
        ...$params
    );

}

$stmt->execute();

$res = $stmt->get_result();


/*
|--------------------------------------------------------------------------
| Ambil Semua Kategori
|--------------------------------------------------------------------------
*/

$cats = [];

$category_result = $conn->query(
    'SELECT DISTINCT kategori
     FROM produk
     ORDER BY kategori'
);

while ($category = $category_result->fetch_assoc()) {

    $cats[] = $category['kategori'];

}


/*
|--------------------------------------------------------------------------
| Header
|--------------------------------------------------------------------------
*/

include 'includes/header.php';

?>


<!-- =========================================================
     PAGE HERO
     ========================================================= -->

<section class="page-hero">

    <div class="container">

        <div class="eyebrow">
            BookNest Collection
        </div>

        <h1>
            Koleksi Buku
        </h1>

        <p class="muted">
            Temukan buku berdasarkan judul,
            penulis, atau kategori.
        </p>


        <!-- =================================================
             FORM PENCARIAN
             ================================================= -->

        <form class="search">

            <input
                type="text"
                name="q"
                value="<?= htmlspecialchars($q) ?>"
                placeholder="Cari judul buku atau penulis..."
            >

            <button type="submit">
                Cari
            </button>

        </form>


        <!-- =================================================
             FILTER KATEGORI
             ================================================= -->

        <div class="filter">

            <!-- Semua Buku -->

            <a
                class="<?= $kategori === '' ? 'active' : '' ?>"
                href="produk.php<?= $q
                    ? '?q=' . urlencode($q)
                    : ''
                ?>"
            >
                Semua
            </a>


            <!-- Daftar Kategori -->

            <?php foreach ($cats as $category): ?>

                <a
                    class="<?= $kategori === $category
                        ? 'active'
                        : ''
                    ?>"
                    href="produk.php?kategori=<?= urlencode($category) ?><?= $q
                        ? '&q=' . urlencode($q)
                        : ''
                    ?>"
                >
                    <?= htmlspecialchars($category) ?>
                </a>

            <?php endforeach; ?>

        </div>

    </div>

</section>



<!-- =========================================================
     DAFTAR BUKU
     ========================================================= -->

<section class="section">

    <div class="container">

        <div class="books-grid">

            <?php if ($res->num_rows): ?>

                <?php while ($buku = $res->fetch_assoc()): ?>

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

                            <span class="badge">
                                <?= htmlspecialchars($buku['kategori']) ?>
                            </span>

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

                <?php endwhile; ?>

            <?php else: ?>

                <!-- Tidak Ada Buku -->

                <div
                    class="empty"
                    style="grid-column: 1 / -1;"
                >
                    Buku yang kamu cari belum ditemukan.
                </div>

            <?php endif; ?>

        </div>

    </div>

</section>



<?php

// Footer
include 'includes/footer.php';

?>