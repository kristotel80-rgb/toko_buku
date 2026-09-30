<?php

session_start();

// Koneksi ke database
require '../config/database.php';

/*
|--------------------------------------------------------------------------
| Ambil Data dari Form Login
|--------------------------------------------------------------------------
*/

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

/*
|--------------------------------------------------------------------------
| Cari Admin Berdasarkan Username
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare(
    'SELECT *
     FROM admin
     WHERE username = ?
     LIMIT 1'
);

$stmt->bind_param(
    's',
    $username
);

$stmt->execute();

$admin = $stmt->get_result()->fetch_assoc();

/*
|--------------------------------------------------------------------------
| Verifikasi Login
|--------------------------------------------------------------------------
*/

if (
    $admin &&
    password_verify(
        $password,
        $admin['password']
    )
) {

    // Simpan data admin ke session
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_username'] = $admin['username'];

    // Login berhasil → masuk dashboard
    header('Location: ../admin/index.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Login Gagal
|--------------------------------------------------------------------------
*/

$_SESSION['login_error'] = 'Username atau password salah.';

header('Location: login.php');
exit;

?>