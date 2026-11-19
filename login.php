<?php
session_start();
require_once __DIR__ . '/includes/auth-flow.php';
$redirect = arunikaResolveBookingRedirect(isset($_GET['redirect']) ? $_GET['redirect'] : null);
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

$sukses = '';
if (isset($_SESSION['sukses'])) {
    $sukses = $_SESSION['sukses'];
    unset($_SESSION['sukses']);
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Masuk ke akun Hotel Arunika untuk melanjutkan pengalaman menginap Anda.">
    <title>Masuk ke Akun — Hotel Arunika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/auth.css" rel="stylesheet">
</head>
<body class="auth-page">
    <main class="auth-layout">
        <section class="auth-panel" aria-labelledby="auth-title">
            <div class="auth-content">
                <a class="arunika-brand auth-brand" href="index.php" aria-label="Hotel Arunika — Beranda">
                    <span class="brand-mark">A</span>
                    <span class="brand-wordmark">HOTEL <strong>ARUNIKA</strong><small>BALI · INDONESIA</small></span>
                </a>

                <div class="auth-heading">
                    <p class="eyebrow text-gold">SELAMAT DATANG KEMBALI</p>
                    <h1 id="auth-title">Masuk ke Akun</h1>
                    <p>Masuk untuk melanjutkan perjalanan Anda bersama kami.</p>
                </div>
                <?php if ($sukses != ''): ?>
                    <div class="alert alert-success" role="alert"><?= htmlspecialchars($sukses, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <?php if ($error != ''): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <form class="auth-form" action="login-process.php" method="post">
                    <?php if ($redirect !== ''): ?>
                        <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8') ?>">
                    <?php endif; ?>
                    <div class="auth-field">
                        <label for="email">Alamat email</label>
                        <input class="form-control" id="email" name="email" type="email" autocomplete="email" placeholder="nama@email.com" required>
                    </div>
                    <div class="auth-field">
                        <label for="password">Password</label>
                        <div class="password-field">
                            <input class="form-control" id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan password" required>
                            <button class="password-toggle" type="button" data-password-toggle="password" aria-label="Tampilkan password" aria-pressed="false">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn auth-submit" type="submit">Masuk <i class="bi bi-arrow-right" aria-hidden="true"></i></button>
                </form>

                <p class="auth-switch">Belum memiliki akun? <a href="register.php<?= $redirect !== '' ? '?redirect=' . rawurlencode($redirect) : '' ?>">Buat akun baru</a></p>
                <a class="auth-home-link" href="index.php"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Beranda</a>
            </div>
        </section>

        <aside class="auth-visual auth-visual-login" aria-label="Suasana resor Hotel Arunika">
            <div class="auth-visual-shade"></div>
            <div class="auth-visual-caption">
                <span class="eyebrow">A SANCTUARY OF SERENITY</span>
                <p>Temukan ruang<br>untuk <em>kembali.</em></p>
                <span class="auth-caption-location">UBUD, BALI · INDONESIA</span>
            </div>
        </aside>
    </main>
    <script src="assets/js/auth.js" defer></script>
</body>
</html>