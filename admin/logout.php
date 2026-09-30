<?php

// Memulai session
session_start();

// Menghapus seluruh data session
session_unset();

// Menghancurkan session
session_destroy();

// Arahkan kembali ke halaman login
header('Location: ../auth/login.php');
exit;

?>