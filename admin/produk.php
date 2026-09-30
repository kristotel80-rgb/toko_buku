<?php

// Tandai bahwa halaman ini adalah halaman admin
$admin_page = true;

// Load file yang diperlukan
require '../includes/auth.php';
require '../config/database.php';
require '../includes/flash.php';

$page_title = 'Kelola Buku';

/*
|--------------------------------------------------------------------------
| Pencarian Buku
|--------------------------------------------------------------------------
*/

// Ambil keyword pencarian dari URL
$q = trim($_GET['q'] ?? '');

// Jika ada keyword pencarian
if ($q !== '') {

    // Cari berdasarkan judul atau penulis
    $stmt = $conn->prepare(
        'SELECT * FROM produk
         WHERE nama LIKE ?
         OR penulis LIKE ?
         ORDER BY id DESC'
    );

    $keyword = "%$q%";

    $stmt->bind_param(
        'ss',
        $keyword,
        $keyword
    );

    $stmt->execute();

    $res = $stmt->get_result();

} else {

    // Jika tidak ada pencarian, tampilkan semua buku
    $res = $conn->query(
        'SELECT * FROM produk ORDER BY id DESC'
    );
}

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

                <h1>Kelola Buku</h1>
            </div>

            <!-- Tombol Tambah Buku -->
            <a class="btn" href="tambah.php">
                + Tambah Buku
            </a>

        </div>

        <!-- Notifikasi -->
        <?php show_flash(); ?>

        <!-- Form Pencarian -->
        <form
            class="search"
            style="margin-bottom: 20px;"
        >
            <input
                type="text"
                name="q"
                value="<?= htmlspecialchars($q) ?>"
                placeholder="Cari judul atau penulis..."
            >

            <button type="submit">
                Cari
            </button>
        </form>

        <!-- Tabel Buku -->
        <table class="admin-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $no = 1;

                while ($b = $res->fetch_assoc()):
                ?>

                    <tr>

                        <!-- Nomor -->
                        <td>
                            <?= $no++ ?>
                        </td>

                        <!-- Cover -->
                        <td>

                            <?php if ($b['gambar']): ?>

                                <img
                                    class="admin-cover"
                                    src="../uploads/produk/<?= htmlspecialchars($b['gambar']) ?>"
                                    alt="Cover <?= htmlspecialchars($b['nama']) ?>"
                                >

                            <?php else: ?>

                                <div class="admin-cover"></div>

                            <?php endif; ?>

                        </td>

                        <!-- Judul -->
                        <td>
                            <strong>
                                <?= htmlspecialchars($b['nama']) ?>
                            </strong>
                        </td>

                        <!-- Penulis -->
                        <td>
                            <?= htmlspecialchars($b['penulis']) ?>
                        </td>

                        <!-- Kategori -->
                        <td>
                            <?= htmlspecialchars($b['kategori']) ?>
                        </td>

                        <!-- Harga -->
                        <td>
                            Rp<?= number_format(
                                $b['harga'],
                                0,
                                ',',
                                '.'
                            ) ?>
                        </td>

                        <!-- Stok -->
                        <td>
                            <?= $b['stok'] ?>
                        </td>

                        <!-- Aksi -->
                        <td>

                            <div class="actions">

                                <!-- Edit -->
                                <a
                                    class="small-btn edit"
                                    href="edit.php?id=<?= $b['id'] ?>"
                                >
                                    Edit
                                </a>

                                <!-- Hapus -->
                                <a
                                    class="small-btn delete"
                                    href="hapus.php?id=<?= $b['id'] ?>"
                                    onclick="return confirm('Hapus buku ini?')"
                                >
                                    Hapus
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>
</section>
