<?php
session_start();
require_once __DIR__ . '/includes/auth-flow.php';
$redirect = arunikaResolveBookingRedirect(isset($_GET['redirect']) ? $_GET['redirect'] : null);
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Buat akun Hotel Arunika dan mulai rencanakan pengalaman menginap istimewa Anda.">
    <title>Buat Akun Baru — Hotel Arunika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/auth.css" rel="stylesheet">
</head>
<body class="auth-page">
    <main class="auth-layout auth-layout-register">
        <section class="auth-panel" aria-labelledby="auth-title">
            <div class="auth-content">
                <a class="arunika-brand auth-brand" href="index.php" aria-label="Hotel Arunika — Beranda">
                    <span class="brand-mark">A</span>
                    <span class="brand-wordmark">HOTEL <strong>ARUNIKA</strong><small>BALI · INDONESIA</small></span>
                </a>

                <div class="auth-heading">
                    <p class="eyebrow text-gold">MULAI PERJALANAN ANDA</p>
                    <h1 id="auth-title">Buat Akun Baru</h1>
                    <p>Daftar untuk menikmati pengalaman menginap yang lebih personal.</p>
                </div>

                <?php if ($error != ''): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>

                <form class="auth-form" id="register-form" action="register-process.php" method="post">
                    <?php if ($redirect !== ''): ?>
                        <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8') ?>">
                    <?php endif; ?>
                    <div class="auth-field">
                        <label for="full-name">Nama lengkap</label>
                        <input class="form-control" id="full-name" name="full_name" type="text" autocomplete="name" minlength="2" placeholder="Nama lengkap Anda" required>
                    </div>
                    <div class="auth-field">
                        <label for="email">Alamat email</label>
                        <input class="form-control" id="email" name="email" type="email" autocomplete="email" placeholder="nama@email.com" required>
                    </div>
                    <div class="auth-field">
                        <label for="phone">Nomor telepon</label>
                        <input class="form-control" id="phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" pattern="[0-9+() -]{8,20}" title="Masukkan nomor telepon yang valid." placeholder="+62 812 3456 7890" required>
                    </div>
                    <div class="auth-field">
                        <label for="password">Password</label>
                        <div class="password-field">
                            <input class="form-control" id="password" name="password" type="password" autocomplete="new-password" minlength="8" placeholder="Minimal 8 karakter" required>
                            <button class="password-toggle" type="button" data-password-toggle="password" aria-label="Tampilkan password" aria-pressed="false">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="auth-field">
                        <label for="confirm-password">Konfirmasi password</label>
                        <div class="password-field">
                            <input class="form-control" id="confirm-password" name="confirm_password" type="password" autocomplete="new-password" minlength="8" placeholder="Ulangi password" required>
                            <button class="password-toggle" type="button" data-password-toggle="confirm-password" aria-label="Tampilkan konfirmasi password" aria-pressed="false">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <label class="auth-consent">
                        <input class="form-check-input" name="terms_agreed" type="checkbox" value="1" required>
                        <span>Saya menyetujui syarat dan ketentuan Hotel Arunika.</span>
                    </label>
                    <button class="btn auth-submit" type="submit">Buat Akun <i class="bi bi-arrow-right" aria-hidden="true"></i></button>
                </form>

                <p class="auth-switch">Sudah memiliki akun? <a href="login.php<?= $redirect !== '' ? '?redirect=' . rawurlencode($redirect) : '' ?>">Masuk di sini</a></p>
                <a class="auth-home-link" href="index.php"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Beranda</a>
            </div>
        </section>

        <aside class="auth-visual auth-visual-register" aria-label="Suasana resor Hotel Arunika">
            <div class="auth-visual-shade"></div>
            <div class="auth-visual-caption">
                <span class="eyebrow">A SANCTUARY OF SERENITY</span>
                <p>Setiap perjalanan<br>dimulai dari <em>satu jeda.</em></p>
                <span class="auth-caption-location">UBUD, BALI · INDONESIA</span>
            </div>
        </aside>
    </main>
    <script src="assets/js/auth.js" defer></script>
</body>
</html>