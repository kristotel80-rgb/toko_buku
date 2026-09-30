<?php

// Koneksi ke database
require '../config/database.php';

$username = 'admin';
$password = 'admin123';

$hash = password_hash(
    $password,
    PASSWORD_DEFAULT
);


$stmt = $conn->prepare(
    'INSERT INTO admin (username, password)
     VALUES (?, ?)
     ON DUPLICATE KEY UPDATE
     password = VALUES(password)'
);

$stmt->bind_param(
    'ss',
    $username,
    $hash
);

$stmt->execute();

echo '
    Admin berhasil dibuat/diperbarui.<br>
    Username: admin<br>
    Password: admin123<br><br>
    Demi keamanan, hapus file buat_admin.php
    setelah digunakan.
';

?>