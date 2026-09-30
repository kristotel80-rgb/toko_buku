<?php

// Nilai default jika data buku belum tersedia
$b = $b ?? [
    'nama'        => '',
    'penulis'     => '',
    'kategori'    => 'Novel',
    'deskripsi'   => '',
    'harga'       => '',
    'stok'        => '',
    'penerbit'    => '',
    'tahun_terbit'=> '',
    'isbn'        => '',
    'gambar'      => ''
];

?>

<div class="form-grid">

    <!-- Judul Buku -->
    <div class="field">
        <label>Judul Buku *</label>

        <input
            class="form-control"
            type="text"
            name="nama"
            required
            value="<?= htmlspecialchars($b['nama']) ?>"
        >
    </div>

    <!-- Penulis -->
    <div class="field">
        <label>Penulis *</label>

        <input
            class="form-control"
            type="text"
            name="penulis"
            required
            value="<?= htmlspecialchars($b['penulis']) ?>"
        >
    </div>

    <!-- Kategori -->
    <div class="field">
        <label>Kategori *</label>

        <input
            class="form-control"
            type="text"
            name="kategori"
            required
            value="<?= htmlspecialchars($b['kategori']) ?>"
            placeholder="Novel, Fantasy, Self Improvement..."
        >
    </div>

    <!-- Harga -->
    <div class="field">
        <label>Harga *</label>

        <input
            class="form-control"
            type="number"
            name="harga"
            min="0"
            required
            value="<?= htmlspecialchars($b['harga']) ?>"
        >
    </div>

    <!-- Stok -->
    <div class="field">
        <label>Stok *</label>

        <input
            class="form-control"
            type="number"
            name="stok"
            min="0"
            required
            value="<?= htmlspecialchars($b['stok']) ?>"
        >
    </div>

    <!-- Penerbit -->
    <div class="field">
        <label>Penerbit</label>

        <input
            class="form-control"
            type="text"
            name="penerbit"
            value="<?= htmlspecialchars($b['penerbit']) ?>"
        >
    </div>

    <!-- Tahun Terbit -->
    <div class="field">
        <label>Tahun Terbit</label>

        <input
            class="form-control"
            type="number"
            name="tahun_terbit"
            value="<?= htmlspecialchars($b['tahun_terbit']) ?>"
        >
    </div>

    <!-- ISBN -->
    <div class="field">
        <label>ISBN</label>

        <input
            class="form-control"
            type="text"
            name="isbn"
            value="<?= htmlspecialchars($b['isbn']) ?>"
        >
    </div>

    <!-- Deskripsi / Sinopsis -->
    <div class="field full">
        <label>Deskripsi / Sinopsis</label>

        <textarea
            class="form-control textarea"
            name="deskripsi"
        ><?= htmlspecialchars($b['deskripsi']) ?></textarea>
    </div>

    <!-- Cover Buku -->
    <div class="field full">
        <label>Ganti Gambar</label>
        <input class="form-control" type="file" name="gambar" accept="image/jpeg,image/png,image/webp">
    </div>
    
</div>