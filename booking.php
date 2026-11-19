<?php
session_start();
require_once __DIR__ . '/includes/auth-flow.php';

if (empty($_SESSION['user_id'])) {
    $bookingUrl = arunikaBuildBookingUrl($_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET);
    $_SESSION['pending_booking'] = arunikaNormalizeBookingData($_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET);
    header('Location: login.php?redirect=' . rawurlencode($bookingUrl));
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header('Location: admin/dashboard.php');
        exit;
    }

    http_response_code(403);
    exit('Akses pemesanan hanya tersedia untuk akun customer.');
}

// Data kamar ini hanya untuk tampilan dan nantinya diganti dengan data dari backend.
$rooms = [
    1 => [
        'name' => 'Arunika Garden Suite',
        'type' => 'SUITE · PEMANDANGAN TAMAN',
        'price' => 1850000,
        'capacity' => 2,
        'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=85',
    ],
    2 => [
        'name' => 'Serenity Ocean Room',
        'type' => 'DELUXE · PEMANDANGAN LAUT',
        'price' => 2450000,
        'capacity' => 2,
        'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85',
    ],
    3 => [
        'name' => 'The Arunika Residence',
        'type' => 'VILLA · PRIVATE POOL',
        'price' => 4200000,
        'capacity' => 2,
        'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=85',
    ],
    4 => [
        'name' => 'Family Room',
        'type' => 'Family Room',
        'price' => 2100000,
        'capacity' => 4,
        'image' => 'https://images.unsplash.com/photo-1564078516393-cf04bd966897?auto=format&fit=crop&w=1000&q=85',
    ],
    5 => [
        'name' => 'Executive Suite',
        'type' => 'Executive Suite',
        'price' => 3250000,
        'capacity' => 3,
        'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1000&q=85',
    ],
    6 => [
        'name' => 'Presidential Suite',
        'type' => 'Presidential Suite',
        'price' => 6800000,
        'capacity' => 5,
        'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1000&q=85',
    ],
];

$roomId = isset($_POST['room_id']) ? (int) $_POST['room_id'] : 0;
if ($roomId === 0 && isset($_GET['room_id'])) {
    $roomId = (int) $_GET['room_id'];
}
$room = isset($rooms[$roomId]) ? $rooms[$roomId] : null;

$checkIn = '';
if (isset($_POST['check_in'])) {
    $checkIn = $_POST['check_in'];
} elseif (isset($_GET['check_in'])) {
    $checkIn = $_GET['check_in'];
}

$checkOut = '';
if (isset($_POST['check_out'])) {
    $checkOut = $_POST['check_out'];
} elseif (isset($_GET['check_out'])) {
    $checkOut = $_GET['check_out'];
}

$guestCount = 0;
if (isset($_POST['guests'])) {
    $guestCount = (int) $_POST['guests'];
} elseif (isset($_GET['guests'])) {
    $guestCount = (int) $_GET['guests'];
}

$nights = 0;
$checkInTime = strtotime($checkIn);
$checkOutTime = strtotime($checkOut);
if ($checkInTime !== false && $checkOutTime !== false && $checkOutTime > $checkInTime) {
    $nights = (int) (($checkOutTime - $checkInTime) / 86400);
}

$totalPrice = $room !== null ? $nights * $room['price'] : 0;

$fullName = isset($_POST['full_name']) ? $_POST['full_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'bank_transfer';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lengkapi detail pemesanan kamar di Hotel Arunika.">
    <title>Pemesanan Kamar — Hotel Arunika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .booking-hero {
            position: relative;
            display: flex;
            min-height: 300px;
            align-items: end;
            overflow: hidden;
            background: linear-gradient(90deg, rgba(28,27,23,.82), rgba(28,27,23,.4)), url("https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=2000&q=85") center 52% / cover;
            color: #fff;
        }
        .booking-hero-content { position: relative; padding-top: 125px; padding-bottom: 38px; }
        .booking-hero .eyebrow { margin-bottom: 10px; color: #d8c292; }
        .booking-hero h1 { margin: 0; font-family: var(--font-display); font-size: clamp(36px, 5vw, 52px); font-weight: 400; }
        .booking-page-main { min-height: 450px; padding: 48px 0 85px; background: var(--arunika-cream); }
        .booking-layout { align-items: start; }
        .booking-form-card, .booking-summary-card { background: #fff; box-shadow: 0 12px 36px rgba(48,39,26,.06); }
        .booking-form-card { padding: clamp(22px, 4vw, 38px); }
        .booking-summary-card { position: sticky; top: 24px; overflow: hidden; }
        .booking-room-image { display: block; width: 100%; height: 220px; object-fit: cover; }
        .booking-summary-body { padding: 23px; }
        .booking-room-type { margin-bottom: 7px; color: var(--arunika-gold-dark); font-size: 8px; font-weight: 600; letter-spacing: 1.6px; }
        .booking-room-name { margin-bottom: 19px; font-family: var(--font-display); font-size: 24px; font-weight: 400; }
        .booking-section-title { margin: 0 0 22px; font-family: var(--font-display); font-size: 25px; font-weight: 400; }
        .booking-section-copy { margin: -12px 0 24px; color: var(--arunika-muted); font-size: 11px; line-height: 1.7; }
        .booking-form-label { margin-bottom: 7px; color: var(--arunika-muted); font-size: 9px; font-weight: 600; letter-spacing: .8px; }
        .booking-form-control { min-height: 45px; border-color: var(--arunika-line); border-radius: 0; color: var(--arunika-ink); font-size: 11px; }
        .booking-form-control:focus { border-color: var(--arunika-gold); box-shadow: 0 0 0 .15rem rgba(182,154,103,.15); }
        .booking-error-list { margin-bottom: 23px; padding: 14px 17px; border-left: 2px solid #a34a3d; background: #fbf1ef; color: #7d332b; font-size: 10px; }
        .booking-error-list ul { margin: 0; padding-left: 17px; }
        .booking-error-list li + li { margin-top: 6px; }
        .booking-data-row { display: flex; justify-content: space-between; gap: 16px; padding: 11px 0; border-bottom: 1px solid var(--arunika-line); font-size: 10px; }
        .booking-data-row span:first-child { color: var(--arunika-muted); }
        .booking-data-row strong { text-align: right; font-weight: 600; }
        .booking-total-row { display: flex; justify-content: space-between; gap: 16px; margin-top: 17px; padding-top: 16px; border-top: 1px solid var(--arunika-line); font-size: 11px; }
        .booking-total-row strong { color: var(--arunika-gold-dark); font-size: 16px; font-weight: 600; text-align: right; }
        .booking-change-link { display: inline-flex; margin-top: 15px; color: var(--arunika-muted); font-size: 9px; }
        .booking-change-link:hover { color: var(--arunika-gold-dark); }
        .booking-payment-options { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        .booking-payment-option { position: relative; display: block; height: 100%; cursor: pointer; }
        .booking-payment-option input { position: absolute; top: 15px; right: 15px; accent-color: var(--arunika-gold-dark); }
        .booking-payment-option > span { display: block; height: 100%; min-height: 112px; padding: 18px; border: 1px solid var(--arunika-line); transition: border-color .2s ease, background .2s ease; }
        .booking-payment-option input:checked + span { border-color: var(--arunika-gold-dark); background: #fbf9f4; }
        .booking-payment-option i { display: block; margin-bottom: 11px; color: var(--arunika-gold-dark); font-size: 18px; }
        .booking-payment-option strong, .booking-payment-option small { display: block; }
        .booking-payment-option strong { padding-right: 20px; font-size: 10px; font-weight: 600; }
        .booking-payment-option small { margin-top: 5px; color: var(--arunika-muted); font-size: 9px; line-height: 1.5; }
        .booking-confirm-button { width: 100%; min-height: 49px; margin-top: 27px; border: 0; border-radius: 0; background: var(--arunika-ink); color: #fff; font-size: 10px; }
        .booking-confirm-button:hover { background: var(--arunika-brown); color: #fff; }
        .booking-confirm-button i { margin-left: 9px; }
        .booking-disclaimer { margin: 13px 0 0; color: var(--arunika-muted); font-size: 9px; line-height: 1.6; text-align: center; }
        .booking-success { padding: 38px; border-top: 2px solid #80966b; background: #fff; box-shadow: 0 12px 36px rgba(48,39,26,.06); }
        .booking-success-icon { display: grid; width: 48px; height: 48px; margin-bottom: 20px; place-items: center; border-radius: 50%; background: #eef3e9; color: #60794c; font-size: 22px; }
        .booking-success h2 { margin-bottom: 10px; font-family: var(--font-display); font-size: 32px; font-weight: 400; }
        .booking-success > p { max-width: 580px; color: var(--arunika-muted); font-size: 11px; line-height: 1.8; }
        .booking-success .booking-data-row { max-width: 560px; }
        .booking-invalid { padding: 42px 25px; background: #fff; text-align: center; }
        .booking-invalid i { display: block; margin-bottom: 12px; color: var(--arunika-gold-dark); font-size: 30px; }
        .booking-invalid h1 { margin-bottom: 10px; font-family: var(--font-display); font-size: 32px; font-weight: 400; }
        .booking-invalid p { margin-bottom: 21px; color: var(--arunika-muted); font-size: 11px; }
        @media (max-width: 991.98px) {
            .booking-summary-card { position: static; margin-top: 28px; }
            .booking-room-image { height: 260px; }
        }
        @media (max-width: 575.98px) {
            .booking-hero { min-height: 260px; }
            .booking-hero-content { padding-top: 115px; padding-bottom: 30px; }
            .booking-page-main { padding: 30px 0 60px; }
            .booking-form-card { padding: 22px 18px; }
            .booking-payment-options { grid-template-columns: 1fr; }
            .booking-success { padding: 25px 20px; }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <?php if ($room === null): ?>
        <main class="booking-page-main">
            <div class="container">
                <section class="booking-invalid">
                    <i class="bi bi-door-closed" aria-hidden="true"></i>
                    <h1>Kamar tidak ditemukan</h1>
                    <p>ID kamar tidak valid. Silakan pilih kamar dari daftar yang tersedia.</p>
                    <a class="btn btn-gold" href="rooms.php">Kembali ke daftar kamar <i class="bi bi-arrow-right"></i></a>
                </section>
            </div>
        </main>
    <?php else: ?>
        <header class="booking-hero">
            <div class="container booking-hero-content">
                <p class="eyebrow">HOTEL ARUNIKA · BALI</p>
                <h1>Selesaikan pemesanan.</h1>
            </div>
        </header>

        <main class="booking-page-main">
            <div class="container">
                    <div class="row g-4 booking-layout">
                        <div class="col-lg-7">
                            <section class="booking-form-card" aria-labelledby="booking-form-title">
                                <p class="eyebrow text-gold">DETAIL PEMESANAN</p>
                                <h2 class="booking-section-title" id="booking-form-title">Data pemesan</h2>
                                <p class="booking-section-copy">Lengkapi informasi berikut untuk melanjutkan permintaan pemesanan kamar.</p>

                                <form action="booking.php" method="post">
                                    <input type="hidden" name="room_id" value="<?= $roomId ?>">
                                    <input type="hidden" name="check_in" value="<?= htmlspecialchars($checkIn, ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="check_out" value="<?= htmlspecialchars($checkOut, ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="guests" value="<?= $guestCount ?>">

                                    <div class="mb-3">
                                        <label class="form-label booking-form-label" for="full-name">NAMA LENGKAP</label>
                                        <input class="form-control booking-form-control" id="full-name" name="full_name" type="text" maxlength="120" autocomplete="name" value="<?= htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8') ?>" required>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label booking-form-label" for="email">EMAIL</label>
                                            <input class="form-control booking-form-control" id="email" name="email" type="email" maxlength="254" autocomplete="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label booking-form-label" for="phone">NOMOR TELEPON</label>
                                            <input class="form-control booking-form-control" id="phone" name="phone" type="tel" maxlength="24" pattern="[+0-9() .-]{8,24}" autocomplete="tel" value="<?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?>" required>
                                        </div>
                                    </div>

                                    <fieldset class="mt-4">
                                        <legend class="form-label booking-form-label mb-2">METODE PEMBAYARAN</legend>
                                        <div class="booking-payment-options">
                                            <label class="booking-payment-option">
                                                <input type="radio" name="payment_method" value="bank_transfer" <?= $paymentMethod === 'bank_transfer' ? 'checked' : '' ?> required>
                                                <span><i class="bi bi-bank"></i><strong>Transfer bank</strong><small>Instruksi pembayaran ditampilkan setelah konfirmasi.</small></span>
                                            </label>
                                            <label class="booking-payment-option">
                                                <input type="radio" name="payment_method" value="pay_at_hotel" <?= $paymentMethod === 'pay_at_hotel' ? 'checked' : '' ?> required>
                                                <span><i class="bi bi-building"></i><strong>Bayar di hotel</strong><small>Lakukan pembayaran saat check-in di hotel.</small></span>
                                            </label>
                                        </div>
                                    </fieldset>

                                    <button class="btn booking-confirm-button" type="submit">Konfirmasi Pemesanan <i class="bi bi-arrow-right"></i></button>
                                    <p class="booking-disclaimer">Dengan melanjutkan, Anda menyetujui detail tanggal, jumlah tamu, dan total pemesanan di samping.</p>
                                </form>
                            </section>
                        </div>

                        <div class="col-lg-5">
                            <aside class="booking-summary-card" aria-label="Ringkasan pemesanan">
                                <img class="booking-room-image" src="<?= htmlspecialchars($room['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?>" fetchpriority="high">
                                <div class="booking-summary-body">
                                    <p class="booking-room-type"><?= htmlspecialchars($room['type'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <h2 class="booking-room-name"><?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?></h2>
                                    <div class="booking-data-row"><span>Check-in</span><strong><?= $checkInTime !== false ? date('d/m/Y', $checkInTime) : '—' ?></strong></div>
                                    <div class="booking-data-row"><span>Waktu check-in</span><strong>14.00 WITA</strong></div>
                                    <div class="booking-data-row"><span>Check-out</span><strong><?= $checkOutTime !== false ? date('d/m/Y', $checkOutTime) : '—' ?></strong></div>
                                    <div class="booking-data-row"><span>Waktu check-out</span><strong>12.00 WITA</strong></div>
                                    <div class="booking-data-row"><span>Jumlah malam</span><strong><?= $nights > 0 ? $nights : '—' ?></strong></div>
                                    <div class="booking-data-row"><span>Jumlah tamu</span><strong><?= $guestCount ?> orang</strong></div>
                                    <div class="booking-data-row"><span>Harga per malam</span><strong>Rp <?= number_format($room['price'], 0, ',', '.') ?></strong></div>
                                    <div class="booking-total-row"><span>Total harga</span><strong><?= $nights > 0 ? 'Rp ' . number_format($totalPrice, 0, ',', '.') : '—' ?></strong></div>
                                    <a class="booking-change-link" href="room-detail.php?id=<?= $roomId ?>&amp;check_in=<?= urlencode($checkIn) ?>&amp;check_out=<?= urlencode($checkOut) ?>&amp;guests=<?= $guestCount ?>">Ubah tanggal atau jumlah tamu</a>
                                </div>
                            </aside>
                        </div>
                    </div>
            </div>
        </main>
    <?php endif; ?>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>