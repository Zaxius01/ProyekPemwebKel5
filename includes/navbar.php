<nav class="navbar navbar-expand-lg arunika-navbar" aria-label="Navigasi utama">
    <div class="container">
        <a class="navbar-brand arunika-brand" href="index.php" aria-label="Hotel Arunika — Beranda">
            <span class="brand-mark">A</span>
            <span class="brand-wordmark">HOTEL <strong>ARUNIKA</strong><small>BALI · INDONESIA</small></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#arunikaNavigation" aria-controls="arunikaNavigation" aria-expanded="false" aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="arunikaNavigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="rooms.php">Kamar & Suite</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#pengalaman">Pengalaman</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#tentang">Tentang kami</a></li>
            </ul>
            <div class="navbar-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="nav-login">Halo, <?= htmlspecialchars($_SESSION['full_name'], ENT_QUOTES, 'UTF-8') ?></span>
                <a class="nav-login" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-login" href="login.php">Masuk</a>
                 <a class="nav-login" href="register.php">Daftar</a>
            <?php endif; ?>
                <a class="btn btn-nav-book" href="rooms.php">Pesan sekarang <i class="bi bi-arrow-up-right"></i></a>
            </div>
        </div>
    </div>
</nav>