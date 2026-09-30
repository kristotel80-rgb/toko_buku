<?php

session_start();

// Cek apakah admin sudah login
if (empty($_SESSION['admin_id'])) {

    // Jika belum login, arahkan ke halaman login
    header('Location: ../auth/login.php');
    exit;
}

?>