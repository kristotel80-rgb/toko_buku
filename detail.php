<?php

// Koneksi ke database
require 'config/database.php';

/*
|--------------------------------------------------------------------------
| Ambil ID Buku
|--------------------------------------------------------------------------
*/

$id = (int) ($_GET['id'] ?? 0);

/*
|--------------------------------------------------------------------------
| Ambil Data Buku
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare(
    'SELECT * FROM produk WHERE id = ?'
);

$stmt->bind_param(
    'i',
    $id
);

$stmt->execute();

$buku = $stmt->get_result()->fetch_assoc();

/*
|--------------------------------------------------------------------------
| Cek Apakah Buku Ditemukan
|--------------------------------------------------------------------------
*/

if (!$buku) {
    http_response_code(404);
    die('Buku tidak ditemukan.');
}

/*
|--------------------------------------------------------------------------
| Judul Halaman
|--------------------------------------------------------------------------
*/

$page_title = $buku['nama'];

// Header
include 'includes/header.php';

?>

<section class="detail">

    <!-- =====================================================
         COVER BUKU
         ===================================================== -->

    <div class="detail-cover">

        <?php if ($buku['gambar']): ?>

            <img
                style="width: 72%; height: 440px; object-fit: cover;"
                src="uploads/produk/<?= htmlspecialchars($buku['gambar']) ?>"
                alt="<?= htmlspecialchars($buku['nama']) ?>"
            >

        <?php else: ?>

            <!-- Placeholder jika buku tidak memiliki cover -->
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


    <!-- =====================================================
         INFORMASI BUKU
         ===================================================== -->

    <div>

        <!-- Kategori -->
        <span class="badge">
            <?= htmlspecialchars($buku['kategori']) ?>
        </span>


        <!-- Judul Buku -->
        <h1>
            <?= htmlspecialchars($buku['nama']) ?>
        </h1>


        <!-- Penulis -->
        <p class="muted">
            oleh <?= htmlspecialchars($buku['penulis']) ?>
        </p>


        <!-- Harga -->
        <div class="price">
            Rp<?= number_format(
                $buku['harga'],
                0,
                ',',
                '.'
            ) ?>
        </div>


        <!-- Deskripsi -->
        <p>
            <?= nl2br(
                htmlspecialchars($buku['deskripsi'])
            ) ?>
        </p>


        <!-- =================================================
             TOMBOL PEMBELIAN
             ================================================= -->

        <?php if ($buku['stok'] > 0): ?>

            <a
                class="btn"
                href="https://wa.me/?text=<?= urlencode(
                    'Halo BookNest, saya ingin membeli buku '
                    . $buku['nama']
                ) ?>"
            >
                Pesan via WhatsApp
            </a>

        <?php else: ?>

            <span class="badge">
                Stok habis
            </span>

        <?php endif; ?>


        <!-- =================================================
             SPESIFIKASI BUKU
             ================================================= -->

        <div class="specs">

            <!-- Penerbit -->
            <div>

                <small class="muted">
                    Penerbit
                </small>

                <br>

                <?= htmlspecialchars(
                    $buku['penerbit'] ?: '-'
                ) ?>

            </div>


            <!-- Tahun Terbit -->
            <div>

                <small class="muted">
                    Tahun Terbit
                </small>

                <br>

                <?= htmlspecialchars(
                    $buku['tahun_terbit'] ?: '-'
                ) ?>

            </div>


            <!-- ISBN -->
            <div>

                <small class="muted">
                    ISBN
                </small>

                <br>

                <?= htmlspecialchars(
                    $buku['isbn'] ?: '-'
                ) ?>

            </div>


            <!-- Stok -->
            <div>

                <small class="muted">
                    Stok
                </small>

                <br>

                <?= (int) $buku['stok'] ?> buku

            </div>

        </div>

    </div>

</section>


<?php

// Footer
include 'includes/footer.php';

?>