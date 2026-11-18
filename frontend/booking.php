<?php
$rooms = [
    1 => [
        'name' => 'Standard Room',
        'type' => 'Standard Room',
        'price' => 950000,
        'capacity' => 2,
        'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=85',
    ],
    2 => [
        'name' => 'Deluxe Room',
        'type' => 'Deluxe Room',
        'price' => 1450000,
        'capacity' => 2,
        'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85',
    ],
    3 => [
        'name' => 'Superior Room',
        'type' => 'Superior Room',
        'price' => 1250000,
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

$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
$requestData = $isPost ? $_POST : $_GET;
$rawRoomId = isset($requestData['room_id']) && is_string($requestData['room_id']) ? $requestData['room_id'] : '';
$roomId = ctype_digit($rawRoomId) ? (int) $rawRoomId : 0;
$room = isset($rooms[$roomId]) ? $rooms[$roomId] : null;

if ($room === null) {
    http_response_code(404);
}

$today = new DateTimeImmutable('today');
$parseDate = static function ($value) {
    if (!is_string($value) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        return null;
    }

    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value);
    $errors = DateTimeImmutable::getLastErrors();
    if (!$date || ($errors !== false && ($errors['warning_count'] > 0 || $errors['error_count'] > 0)) || $date->format('Y-m-d') !== $value) {
        return null;
    }

    return $date;
};

$checkIn = isset($requestData['check_in']) && is_string($requestData['check_in']) ? $requestData['check_in'] : '';
$checkOut = isset($requestData['check_out']) && is_string($requestData['check_out']) ? $requestData['check_out'] : '';
$rawGuests = isset($requestData['guests']) && is_string($requestData['guests']) ? $requestData['guests'] : '';
$guestCount = ctype_digit($rawGuests) ? (int) $rawGuests : 0;
$checkInDate = $parseDate($checkIn);
$checkOutDate = $parseDate($checkOut);
$changeBookingUrl = 'room-detail.php?' . http_build_query([
    'id' => $roomId,
    'check_in' => $checkIn,
    'check_out' => $checkOut,
    'guests' => $guestCount,
]);
$nights = 0;
$totalPrice = 0;
$errors = [];
$confirmed = false;

$fullName = $isPost && isset($_POST['full_name']) && is_string($_POST['full_name']) ? trim($_POST['full_name']) : '';
$email = $isPost && isset($_POST['email']) && is_string($_POST['email']) ? trim($_POST['email']) : '';
$phone = $isPost && isset($_POST['phone']) && is_string($_POST['phone']) ? trim($_POST['phone']) : '';
$paymentMethod = $isPost && isset($_POST['payment_method']) && is_string($_POST['payment_method'])
    ? $_POST['payment_method']
    : 'bank_transfer';

if ($room !== null) {
    if ($checkInDate === null || $checkOutDate === null) {
        $errors[] = 'Tanggal check-in dan check-out wajib diisi dengan tanggal yang valid.';
    } elseif ($checkInDate < $today) {
        $errors[] = 'Tanggal check-in tidak boleh sebelum hari ini.';
    } elseif ($checkOutDate <= $checkInDate) {
        $errors[] = 'Tanggal check-out harus setelah tanggal check-in.';
    } else {
        $nights = (int) $checkInDate->diff($checkOutDate)->days;
        $totalPrice = $nights * $room['price'];
    }

    if ($guestCount < 1 || $guestCount > $room['capacity']) {
        $errors[] = 'Jumlah tamu harus antara 1 dan ' . $room['capacity'] . ' orang untuk kamar ini.';
        $guestCount = 0;
    }

    if ($isPost) {
        $nameLength = preg_match_all('/./us', $fullName, $nameCharacters);
        if ($fullName === '' || $nameLength === false || $nameLength > 120 || preg_match('/[\r\n]/', $fullName)) {
            $errors[] = 'Masukkan nama lengkap yang valid (maksimal 120 karakter).';
        }
        if (strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Masukkan alamat email yang valid.';
        }

        $phoneDigits = preg_replace('/\D/', '', $phone);
        if (!preg_match('/^\+?[0-9\s().-]{8,24}$/', $phone) || strlen($phoneDigits) < 8 || strlen($phoneDigits) > 15) {
            $errors[] = 'Masukkan nomor telepon yang valid.';
        }
        if (!in_array($paymentMethod, ['bank_transfer', 'pay_at_hotel'], true)) {
            $errors[] = 'Pilih metode pembayaran yang tersedia.';
        }

        if (!$errors) {
            $confirmed = true;
        } else {
            http_response_code(422);
        }
    }
}

$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lengkapi detail pemesanan kamar di Hotel Arunika.">
    <title><?= $confirmed ? 'Pemesanan Dikonfirmasi' : 'Pemesanan Kamar' ?> — Hotel Arunika</title>
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
                <h1><?= $confirmed ? 'Pemesanan Anda' : 'Selesaikan pemesanan.' ?></h1>
            </div>
        </header>

        <main class="booking-page-main">
            <div class="container">
                <?php if ($confirmed): ?>
                    <section class="booking-success" aria-labelledby="booking-success-title">
                        <span class="booking-success-icon"><i class="bi bi-check2" aria-hidden="true"></i></span>
                        <h2 id="booking-success-title">Pemesanan berhasil dikonfirmasi</h2>
                        <p>Data pemesanan demo Anda sudah tervalidasi. Informasi ini belum disimpan ke database.</p>
                        <div class="booking-data-row"><span>Nama pemesan</span><strong><?= $escape($fullName) ?></strong></div>
                        <div class="booking-data-row"><span>Email</span><strong><?= $escape($email) ?></strong></div>
                        <div class="booking-data-row"><span>Nomor telepon</span><strong><?= $escape($phone) ?></strong></div>
                        <div class="booking-data-row"><span>Metode pembayaran</span><strong><?= $paymentMethod === 'bank_transfer' ? 'Transfer bank' : 'Bayar di hotel' ?></strong></div>
                        <div class="booking-data-row"><span>Kamar</span><strong><?= $escape($room['name']) ?></strong></div>
                        <div class="booking-data-row"><span>Tanggal menginap</span><strong><?= $checkInDate->format('d/m/Y') ?> — <?= $checkOutDate->format('d/m/Y') ?></strong></div>
                        <div class="booking-data-row"><span>Durasi & tamu</span><strong><?= $nights ?> malam · <?= $guestCount ?> tamu</strong></div>
                        <div class="booking-total-row"><span>Total pembayaran</span><strong>Rp <?= number_format($totalPrice, 0, ',', '.') ?></strong></div>
                        <a class="text-link mt-4" href="rooms.php">Jelajahi kamar lainnya <i class="bi bi-arrow-up-right"></i></a>
                    </section>
                <?php else: ?>
                    <div class="row g-4 booking-layout">
                        <div class="col-lg-7">
                            <section class="booking-form-card" aria-labelledby="booking-form-title">
                                <p class="eyebrow text-gold">DETAIL PEMESANAN</p>
                                <h2 class="booking-section-title" id="booking-form-title">Data pemesan</h2>
                                <p class="booking-section-copy">Lengkapi informasi berikut untuk melanjutkan permintaan pemesanan kamar.</p>

                                <?php if ($errors): ?>
                                    <div class="booking-error-list" role="alert">
                                        <ul>
                                            <?php foreach ($errors as $error): ?>
                                                <li><?= $escape($error) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <form action="booking.php" method="post">
                                    <input type="hidden" name="room_id" value="<?= $roomId ?>">
                                    <input type="hidden" name="check_in" value="<?= $escape($checkIn) ?>">
                                    <input type="hidden" name="check_out" value="<?= $escape($checkOut) ?>">
                                    <input type="hidden" name="guests" value="<?= $guestCount ?>">

                                    <div class="mb-3">
                                        <label class="form-label booking-form-label" for="full-name">NAMA LENGKAP</label>
                                        <input class="form-control booking-form-control" id="full-name" name="full_name" type="text" maxlength="120" autocomplete="name" value="<?= $escape($fullName) ?>" required>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label booking-form-label" for="email">EMAIL</label>
                                            <input class="form-control booking-form-control" id="email" name="email" type="email" maxlength="254" autocomplete="email" value="<?= $escape($email) ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label booking-form-label" for="phone">NOMOR TELEPON</label>
                                            <input class="form-control booking-form-control" id="phone" name="phone" type="tel" maxlength="24" pattern="[+0-9() .-]{8,24}" autocomplete="tel" value="<?= $escape($phone) ?>" required>
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
                                <img class="booking-room-image" src="<?= $escape($room['image']) ?>" alt="<?= $escape($room['name']) ?>" fetchpriority="high">
                                <div class="booking-summary-body">
                                    <p class="booking-room-type"><?= $escape($room['type']) ?></p>
                                    <h2 class="booking-room-name"><?= $escape($room['name']) ?></h2>
                                    <div class="booking-data-row"><span>Check-in</span><strong><?= $checkInDate ? $checkInDate->format('d/m/Y') : $escape($checkIn) ?></strong></div>
                                    <div class="booking-data-row"><span>Check-out</span><strong><?= $checkOutDate ? $checkOutDate->format('d/m/Y') : $escape($checkOut) ?></strong></div>
                                    <div class="booking-data-row"><span>Jumlah malam</span><strong><?= $nights > 0 ? $nights : '—' ?></strong></div>
                                    <div class="booking-data-row"><span>Jumlah tamu</span><strong><?= $guestCount ?> orang</strong></div>
                                    <div class="booking-data-row"><span>Harga per malam</span><strong>Rp <?= number_format($room['price'], 0, ',', '.') ?></strong></div>
                                    <div class="booking-total-row"><span>Total harga</span><strong><?= $nights > 0 ? 'Rp ' . number_format($totalPrice, 0, ',', '.') : '—' ?></strong></div>
                                    <a class="booking-change-link" href="<?= $escape($changeBookingUrl) ?>">Ubah tanggal atau jumlah tamu</a>
                                </div>
                            </aside>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    <?php endif; ?>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>