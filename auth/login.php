<?php

session_start();
if (isset($_SESSION['admin_id'])) {
    header('Location: ../admin/index.php');
    exit;
}


$error = $_SESSION['login_error'] ?? '';

unset($_SESSION['login_error']);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Login Admin — BookNest</title>

    <link
        rel="stylesheet"
        href="../assets/style.css"
    >

</head>

<body>

    <div class="login-wrap">

        <div class="login-card">

            <!-- Logo -->
            <div class="brand">
                BOOK<span>NEST</span>
            </div>

            <!-- Judul -->
            <h1>Login Admin</h1>

            <p class="muted">
                Kelola katalog Buku.
            </p>

            <!-- Pesan Error -->
            <?php if ($error): ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>

            <!-- Form Login -->
            <form
                method="post"
                action="proses_login.php"
            >

                <!-- Username -->
                <div class="field">

                    <label>Username</label>

                    <input
                        class="form-control"
                        type="text"
                        name="username"
                        required
                    >

                </div>

                <!-- Password -->
                <div class="field">

                    <label>Password</label>

                    <input
                        class="form-control"
                        type="password"
                        name="password"
                        required
                    >

                </div>

                <!-- Tombol Login -->
                <button
                    class="btn"
                    type="submit"
                >
                    Masuk
                </button>

            </form>

            <!-- Kembali ke Website -->
            <p style="margin-top: 20px;">

                <a
                    class="muted"
                    href="../index.php"
                >
                    ← Kembali ke website
                </a>

            </p>

        </div>

    </div>

</body>

</html>