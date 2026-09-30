<?php
require '../includes/auth.php';
require '../config/database.php';
require '../includes/flash.php';

$aksi = $_POST['aksi'] ?? '';
$id = (int) ($_POST['id'] ?? 0);

$nama = trim($_POST['nama'] ?? '');
$penulis = trim($_POST['penulis'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$harga = (float) ($_POST['harga'] ?? 0);
$stok = (int) ($_POST['stok'] ?? 0);
$penerbit = trim($_POST['penerbit'] ?? '');
$tahun = (int) ($_POST['tahun_terbit'] ?? 0);
$isbn = trim($_POST['isbn'] ?? '');

$gambar_lama = '';

/* =========================================================
   AMBIL GAMBAR LAMA SAAT EDIT
   ========================================================= */

if ($aksi === 'edit') {
    $stmt = $conn->prepare('SELECT gambar FROM produk WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    $gambar_lama = $data['gambar'] ?? '';
}

$gambar = $gambar_lama;

/* =========================================================
   UPLOAD GAMBAR
   Nama file dibuat berdasarkan judul buku
   ========================================================= */

if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    $mime = mime_content_type($_FILES['gambar']['tmp_name']);

    if (isset($allowed[$mime])) {
        /* Buat nama file dari judul buku */
        $nama_file = strtolower($nama);
        $nama_file = preg_replace('/[^a-z0-9]+/i', '-', $nama_file);
        $nama_file = trim($nama_file, '-');

        /* Jika judul kosong, gunakan nama default */
        if ($nama_file === '') {
            $nama_file = 'cover-buku';
        }

        $ekstensi = $allowed[$mime];
        $nama_asli = $nama_file;
        $nomor = 1;

        /* Cek agar nama file tidak bertabrakan */
        while (is_file(__DIR__ . '/../uploads/produk/' . $nama_file . '.' . $ekstensi)) {
            $nama_file = $nama_asli . '-' . $nomor;
            $nomor++;
        }

        $gambar = $nama_file . '.' . $ekstensi;
        $upload_path = __DIR__ . '/../uploads/produk/' . $gambar;

        /* Pindahkan file ke folder uploads/produk */
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_path)) {
            /* Hapus gambar lama jika sedang edit */
            if ($gambar_lama && is_file(__DIR__ . '/../uploads/produk/' . $gambar_lama)) {
                @unlink(__DIR__ . '/../uploads/produk/' . $gambar_lama);
            }
        } else {
            $gambar = $gambar_lama;
        }
    }
}

/* =========================================================
   TAMBAH BUKU
   ========================================================= */

if ($aksi === 'tambah') {
    $stmt = $conn->prepare(
        'INSERT INTO produk (
            nama,
            penulis,
            kategori,
            deskripsi,
            harga,
            stok,
            penerbit,
            tahun_terbit,
            isbn,
            gambar
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );

    $stmt->bind_param(
        'ssssdiisss',
        $nama,
        $penulis,
        $kategori,
        $deskripsi,
        $harga,
        $stok,
        $penerbit,
        $tahun,
        $isbn,
        $gambar
    );

    $stmt->execute();

    set_flash('success', 'Buku berhasil ditambahkan.');
}

/* =========================================================
   EDIT BUKU
   ========================================================= */

elseif ($aksi === 'edit') {
    $stmt = $conn->prepare(
        'UPDATE produk SET
            nama = ?,
            penulis = ?,
            kategori = ?,
            deskripsi = ?,
            harga = ?,
            stok = ?,
            penerbit = ?,
            tahun_terbit = ?,
            isbn = ?,
            gambar = ?
        WHERE id = ?'
    );

    $stmt->bind_param(
        'ssssdiisssi',
        $nama,
        $penulis,
        $kategori,
        $deskripsi,
        $harga,
        $stok,
        $penerbit,
        $tahun,
        $isbn,
        $gambar,
        $id
    );

    $stmt->execute();

    set_flash('success', 'Data buku berhasil diperbarui.');
}

/* =========================================================
   KEMBALI KE HALAMAN KELOLA BUKU
   ========================================================= */

header('Location: produk.php');
exit;
?>