<?php
// Data berikut hanya contoh tampilan dan belum terhubung ke database.
$stats = [
    [
        'label' => 'Jumlah Kamar',
        'value' => '28',
        'note' => 'Kamar terdaftar',
        'icon' => 'bi-door-open',
    ],
    [
        'label' => 'Pemesanan',
        'value' => '142',
        'note' => 'Sepanjang bulan ini',
        'icon' => 'bi-calendar2-check',
    ],
    [
        'label' => 'Pengguna',
        'value' => '386',
        'note' => 'Pelanggan terdaftar',
        'icon' => 'bi-people',
    ],
    [
        'label' => 'Pendapatan',
        'value' => 'Rp 86.450.000',
        'note' => 'Pendapatan simulasi',
        'icon' => 'bi-wallet2',
    ],
];

$latestBookings = [
    [
        'code' => 'AR-26018',
        'guest' => 'Ayu Lestari',
        'room' => 'Arunika Garden Suite',
        'date' => '20 Nov 2026',
        'amount' => 'Rp 3.700.000',
        'status' => 'Dikonfirmasi',
        'statusClass' => 'status-confirmed',
    ],
    [
        'code' => 'AR-26017',
        'guest' => 'Rizky Pratama',
        'room' => 'Serenity Ocean Room',
        'date' => '21 Nov 2026',
        'amount' => 'Rp 4.900.000',
        'status' => 'Menunggu',
        'statusClass' => 'status-pending',
    ],
    [
        'code' => 'AR-26016',
        'guest' => 'Made Wijaya',
        'room' => 'Family Room',
        'date' => '22 Nov 2026',
        'amount' => 'Rp 4.200.000',
        'status' => 'Dikonfirmasi',
        'statusClass' => 'status-confirmed',
    ],
    [
        'code' => 'AR-26015',
        'guest' => 'Nadia Putri',
        'room' => 'The Arunika Residence',
        'date' => '24 Nov 2026',
        'amount' => 'Rp 8.400.000',
        'status' => 'Menunggu',
        'statusClass' => 'status-pending',
    ],
    [
        'code' => 'AR-26014',
        'guest' => 'Bima Santoso',
        'room' => 'Executive Suite',
        'date' => '25 Nov 2026',
        'amount' => 'Rp 6.500.000',
        'status' => 'Selesai',
        'statusClass' => 'status-complete',
    ],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dashboard admin Hotel Arunika.">
    <title>Dashboard Admin — Hotel Arunika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body { min-width: 320px; background: var(--arunika-cream); }
        .admin-layout { min-height: 100vh; }
        .admin-sidebar { --bs-offcanvas-width: 270px; background: var(--arunika-ink); color: #fff; }
        .admin-sidebar .offcanvas-header { padding: 22px 20px; border-bottom: 1px solid rgba(255,255,255,.1); }
        .admin-sidebar .offcanvas-body { display: flex; flex-direction: column; padding: 22px 16px; }
        .admin-brand { display: flex; align-items: center; gap: 11px; color: #fff; }
        .admin-brand:hover { color: #fff; }
        .admin-brand-mark { display: grid; width: 39px; height: 39px; flex: 0 0 39px; place-items: center; border: 1px solid var(--arunika-gold); border-radius: 50%; color: #d3b77f; font-family: var(--font-display); font-size: 23px; }
        .admin-brand-name { display: block; font-size: 10px; letter-spacing: 2px; line-height: 1.5; }
        .admin-brand-name strong { font-size: 14px; letter-spacing: 2.5px; }
        .admin-brand-name small { display: block; color: rgba(255,255,255,.55); font-size: 8px; letter-spacing: 1.8px; }
        .admin-nav-label { margin: 22px 11px 10px; color: rgba(255,255,255,.45); font-size: 9px; font-weight: 600; letter-spacing: 1.5px; }
        .admin-nav { display: grid; gap: 5px; }
        .admin-nav-link { display: flex; align-items: center; gap: 12px; min-height: 45px; padding: 11px 13px; border-radius: 3px; color: rgba(255,255,255,.72); font-size: 12px; transition: background .2s ease, color .2s ease; }
        .admin-nav-link i { width: 18px; color: #d0b77f; font-size: 15px; text-align: center; }
        .admin-nav-link:hover, .admin-nav-link.active { background: rgba(182,154,103,.18); color: #fff; }
        .admin-nav-link.active { box-shadow: inset 2px 0 var(--arunika-gold); }
        .admin-sidebar-bottom { margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,.1); }
        .admin-sidebar-bottom .admin-nav-link { color: rgba(255,255,255,.58); }
        .admin-main { min-width: 0; flex: 1; }
        .admin-topbar { position: sticky; z-index: 5; top: 0; display: flex; min-height: 74px; align-items: center; justify-content: space-between; gap: 18px; padding: 12px clamp(18px, 3vw, 36px); border-bottom: 1px solid var(--arunika-line); background: rgba(255,255,255,.96); }
        .admin-topbar-left { display: flex; align-items: center; gap: 14px; }
        .admin-menu-button { display: grid; width: 40px; height: 40px; place-items: center; border: 1px solid var(--arunika-line); border-radius: 0; color: var(--arunika-ink); }
        .admin-menu-button:hover { border-color: var(--arunika-gold); color: var(--arunika-gold-dark); }
        .admin-topbar-title { margin: 0; color: var(--arunika-muted); font-size: 11px; font-weight: 500; }
        .admin-profile { display: flex; align-items: center; gap: 10px; }
        .admin-avatar { display: grid; width: 38px; height: 38px; place-items: center; border-radius: 50%; background: #eee8dc; color: var(--arunika-brown); font-family: var(--font-display); font-size: 16px; }
        .admin-profile-name { color: var(--arunika-ink); font-size: 11px; font-weight: 600; }
        .admin-profile-role { display: block; margin-top: 2px; color: var(--arunika-muted); font-size: 9px; }
        .admin-content { width: min(100%, 1500px); margin: 0 auto; padding: clamp(22px, 3vw, 38px); }
        .admin-page-heading { display: flex; align-items: end; justify-content: space-between; gap: 16px; margin-bottom: 25px; }
        .admin-eyebrow { margin-bottom: 7px; color: var(--arunika-gold-dark); font-size: 9px; font-weight: 600; letter-spacing: 1.6px; }
        .admin-page-heading h1 { margin: 0; font-family: var(--font-display); font-size: clamp(28px, 3vw, 36px); font-weight: 400; }
        .admin-page-date { color: var(--arunika-muted); font-size: 11px; }
        .admin-stat-card { position: relative; min-height: 150px; height: 100%; padding: 21px; border: 1px solid var(--arunika-line); background: #fff; }
        .admin-stat-top { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; }
        .admin-stat-label { margin: 0; color: var(--arunika-muted); font-size: 11px; }
        .admin-stat-icon { display: grid; width: 38px; height: 38px; place-items: center; border-radius: 50%; background: #f3efe6; color: var(--arunika-gold-dark); font-size: 17px; }
        .admin-stat-value { margin: 0 0 5px; color: var(--arunika-ink); font-family: var(--font-display); font-size: clamp(22px, 2.2vw, 29px); line-height: 1.2; }
        .admin-stat-value-compact { font-size: clamp(18px, 1.65vw, 22px); white-space: nowrap; }
        .admin-stat-note { margin: 0; color: var(--arunika-muted); font-size: 9px; }
        .admin-panel { margin-top: 30px; border: 1px solid var(--arunika-line); background: #fff; }
        .admin-panel-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 20px 22px; border-bottom: 1px solid var(--arunika-line); }
        .admin-panel-header h2 { margin: 0; font-family: var(--font-display); font-size: 21px; font-weight: 400; }
        .admin-panel-header p { margin: 5px 0 0; color: var(--arunika-muted); font-size: 10px; }
        .admin-view-all { color: var(--arunika-gold-dark); font-size: 10px; font-weight: 600; white-space: nowrap; }
        .admin-view-all:hover { color: var(--arunika-brown); }
        .admin-table-wrap { padding: 0 20px 8px; }
        .admin-table { min-width: 740px; margin-bottom: 0; vertical-align: middle; }
        .admin-table thead th { padding: 14px 12px; border-bottom-color: var(--arunika-line); color: var(--arunika-muted); font-size: 9px; font-weight: 600; letter-spacing: .8px; white-space: nowrap; }
        .admin-table tbody td { padding: 15px 12px; border-bottom-color: #f0ede7; color: var(--arunika-ink); font-size: 10px; }
        .admin-table tbody tr:last-child td { border-bottom: 0; }
        .booking-code { color: var(--arunika-gold-dark); font-weight: 600; }
        .booking-guest { font-weight: 600; }
        .booking-room, .booking-date { color: var(--arunika-muted) !important; }
        .booking-status { display: inline-block; padding: 5px 9px; border-radius: 2px; font-size: 9px; font-weight: 600; white-space: nowrap; }
        .status-confirmed { background: #edf2e8; color: #5e7548; }
        .status-pending { background: #f7f0df; color: #8c6b2e; }
        .status-complete { background: #eeeae4; color: #71695d; }
        .admin-footer { padding: 24px 0 4px; color: var(--arunika-muted); font-size: 9px; text-align: center; }
        @media (min-width: 992px) {
            .admin-layout { display: flex; }
            .admin-sidebar.offcanvas-lg { position: sticky; top: 0; flex: 0 0 270px; width: 270px !important; height: 100vh; visibility: visible; background-color: var(--arunika-ink) !important; transform: none; }
            .admin-sidebar .offcanvas-header { display: flex; }
            .admin-sidebar .offcanvas-body { height: calc(100vh - 84px); overflow-y: auto; }
        }
        @media (max-width: 575.98px) {
            .admin-topbar { min-height: 64px; }
            .admin-profile-name, .admin-profile-role { display: none; }
            .admin-page-heading { align-items: start; flex-direction: column; }
            .admin-panel-header { align-items: start; padding: 17px; }
            .admin-table-wrap { padding-right: 12px; padding-left: 12px; }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
            <div class="offcanvas-header">
                <a class="admin-brand" href="dashboard.php">
                    <span class="admin-brand-mark">A</span>
                    <span class="admin-brand-name">HOTEL <strong>ARUNIKA</strong><small>ADMIN PANEL</small></span>
                </a>
                <button class="btn-close btn-close-white d-lg-none" type="button" data-bs-dismiss="offcanvas" aria-label="Tutup menu"></button>
            </div>
            <div class="offcanvas-body">
                <p class="admin-nav-label" id="adminSidebarLabel">MENU UTAMA</p>
                <nav class="admin-nav" aria-label="Navigasi admin">
                    <a class="admin-nav-link active" href="dashboard.php" aria-current="page"><i class="bi bi-grid-1x2" aria-hidden="true"></i>Dashboard</a>
                    <a class="admin-nav-link" href="rooms.php"><i class="bi bi-door-open" aria-hidden="true"></i>Kelola Kamar</a>
                    <a class="admin-nav-link" href="bookings.php"><i class="bi bi-calendar2-check" aria-hidden="true"></i>Pemesanan</a>
                    <a class="admin-nav-link" href="#"><i class="bi bi-people" aria-hidden="true"></i>Pengguna</a>
                </nav>
                <div class="admin-sidebar-bottom">
                    <a class="admin-nav-link" href="#"><i class="bi bi-box-arrow-left" aria-hidden="true"></i>Logout</a>
                </div>
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button class="btn admin-menu-button d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar" aria-label="Buka menu admin">
                        <i class="bi bi-list" aria-hidden="true"></i>
                    </button>
                    <p class="admin-topbar-title mb-0">Panel Administrasi</p>
                </div>
                <div class="admin-profile">
                    <span class="admin-avatar" aria-hidden="true">A</span>
                    <span><span class="admin-profile-name">Administrator</span><small class="admin-profile-role">Hotel Arunika</small></span>
                </div>
            </header>

            <main class="admin-content">
                <div class="admin-page-heading">
                    <div>
                        <p class="admin-eyebrow">RINGKASAN HOTEL</p>
                        <h1>Dashboard</h1>
                    </div>
                    <span class="admin-page-date"><i class="bi bi-calendar3 me-1" aria-hidden="true"></i>Data simulasi</span>
                </div>

                <section aria-label="Statistik hotel">
                    <div class="row g-3 g-xl-4">
                        <?php foreach ($stats as $stat): ?>
                            <div class="col-sm-6 col-xl-3">
                                <article class="admin-stat-card">
                                    <div class="admin-stat-top">
                                        <p class="admin-stat-label"><?= htmlspecialchars($stat['label'], ENT_QUOTES, 'UTF-8') ?></p>
                                        <span class="admin-stat-icon"><i class="bi <?= htmlspecialchars($stat['icon'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i></span>
                                    </div>
                                    <p class="admin-stat-value<?= $stat['label'] === 'Pendapatan' ? ' admin-stat-value-compact' : '' ?>"><?= htmlspecialchars($stat['value'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <p class="admin-stat-note"><?= htmlspecialchars($stat['note'], ENT_QUOTES, 'UTF-8') ?></p>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="admin-panel" aria-labelledby="latest-bookings-title">
                    <div class="admin-panel-header">
                        <div>
                            <h2 id="latest-bookings-title">Pemesanan Terbaru</h2>
                            <p>Daftar pemesanan terbaru (data simulasi)</p>
                        </div>
                        <a class="admin-view-all" href="bookings.php">Lihat semua <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i></a>
                    </div>
                    <div class="admin-table-wrap">
                        <div class="table-responsive">
                            <table class="table admin-table">
                                <thead>
                                    <tr>
                                        <th scope="col">KODE</th>
                                        <th scope="col">PELANGGAN</th>
                                        <th scope="col">KAMAR</th>
                                        <th scope="col">CHECK-IN</th>
                                        <th scope="col">TOTAL</th>
                                        <th scope="col">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($latestBookings as $booking): ?>
                                        <tr>
                                            <td class="booking-code"><?= htmlspecialchars($booking['code'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="booking-guest"><?= htmlspecialchars($booking['guest'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="booking-room"><?= htmlspecialchars($booking['room'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="booking-date"><?= htmlspecialchars($booking['date'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($booking['amount'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><span class="booking-status <?= htmlspecialchars($booking['statusClass'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($booking['status'], ENT_QUOTES, 'UTF-8') ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <footer class="admin-footer">© 2026 Hotel Arunika · Dashboard admin untuk tampilan</footer>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>