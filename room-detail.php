<?php
session_start();
$rooms = [
    1 => [
        'name' => 'Arunika Garden Suite',
        'type' => 'SUITE · PEMANDANGAN TAMAN',
        'price' => 1850000,
        'capacity' => 2,
        'beds' => '1 Queen Bed',
        'size' => '28 m²',
        'description' => 'Nikmati suasana tenang di Arunika Garden Suite, ruang nyaman dengan sentuhan material alami dan pencahayaan hangat. Tata ruang yang efisien, tempat tidur berkualitas, serta fasilitas modern menjadikannya pilihan tepat untuk beristirahat dan memulai hari baru di Bali.',
        'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1400&q=85',
        'gallery' => [
            ['image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Detail tempat tidur dan pencahayaan kamar'],
            ['image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Detail interior dengan material alami'],
            ['image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Area duduk kamar dengan desain elegan'],
        ],
        'facilities' => ['Wi-Fi berkecepatan tinggi', 'AC dengan kontrol individual', 'Smart TV', 'Brankas pribadi', 'Kamar mandi dengan shower', 'Perlengkapan mandi', 'Air mineral harian', 'Sarapan untuk 2 tamu'],
    ],
    2 => [
        'name' => 'Serenity Ocean Room',
        'type' => 'DELUXE · PEMANDANGAN LAUT',
        'price' => 2450000,
        'capacity' => 2,
        'beds' => '1 King Bed',
        'size' => '36 m²',
        'description' => 'Serenity Ocean Room memadukan ruang yang lebih lapang dengan detail kontemporer dan suasana yang menenangkan. Nikmati balkon pribadi, kamar mandi dengan bathtub, dan tempat tidur king yang dirancang untuk membuat setiap waktu istirahat terasa istimewa.',
        'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1400&q=85',
        'gallery' => [
            ['image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Detail tempat tidur dan pencahayaan kamar'],
            ['image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Ruang kamar deluxe dengan warna hangat'],
            ['image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Interior elegan dengan area duduk'],
        ],
        'facilities' => ['Wi-Fi berkecepatan tinggi', 'AC dengan kontrol individual', 'Smart TV', 'Balkon pribadi', 'Bathtub dan shower', 'Perlengkapan mandi premium', 'Brankas pribadi', 'Sarapan untuk 2 tamu'],
    ],
    3 => [
        'name' => 'The Arunika Residence',
        'type' => 'VILLA · PRIVATE POOL',
        'price' => 4200000,
        'capacity' => 2,
        'beds' => '1 King Bed',
        'size' => '32 m²',
        'description' => 'The Arunika Residence menghadirkan suasana yang lapang dengan pemandangan taman tropis yang asri. Desain kontemporer, area lounge yang nyaman, dan fasilitas pilihan memberi Anda ruang untuk beristirahat dengan lebih leluasa.',
        'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1400&q=85',
        'gallery' => [
            ['image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Interior The Arunika Residence bernuansa alami'],
            ['image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Area lounge di dalam kamar'],
            ['image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Tempat tidur king yang nyaman'],
        ],
        'facilities' => ['Wi-Fi berkecepatan tinggi', 'AC dengan kontrol individual', 'Smart TV', 'Pemandangan taman', 'Area lounge', 'Kamar mandi dengan shower', 'Brankas pribadi', 'Sarapan untuk 2 tamu'],
    ],
    4 => [
        'name' => 'Family Room',
        'type' => 'FAMILY ROOM',
        'price' => 2100000,
        'capacity' => 4,
        'beds' => '2 Queen Beds',
        'size' => '52 m²',
        'description' => 'Family Room dirancang agar keluarga dapat menikmati waktu bersama dengan nyaman. Ruang yang luas, dua tempat tidur queen, dan area keluarga memberi keleluasaan bagi seluruh anggota keluarga untuk beristirahat maupun berkumpul.',
        'image' => 'https://images.unsplash.com/photo-1564078516393-cf04bd966897?auto=format&fit=crop&w=1400&q=85',
        'gallery' => [
            ['image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Family Room dengan detail tempat tidur'],
            ['image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Area keluarga dengan interior yang hangat'],
            ['image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Ruang keluarga yang luas dan nyaman'],
        ],
        'facilities' => ['Wi-Fi berkecepatan tinggi', 'AC dengan kontrol individual', 'Smart TV', 'Area keluarga', 'Kamar mandi dengan shower', 'Perlengkapan mandi', 'Brankas pribadi', 'Sarapan untuk 4 tamu'],
    ],
    5 => [
        'name' => 'Executive Suite',
        'type' => 'EXECUTIVE SUITE',
        'price' => 3250000,
        'capacity' => 3,
        'beds' => '1 King Bed dan 1 Sofa Bed',
        'size' => '68 m²',
        'description' => 'Executive Suite menawarkan ruang tidur privat yang terhubung dengan ruang duduk elegan. Nikmati fasilitas premium, layanan personal, dan ruang yang mendukung waktu istirahat maupun momen bekerja selama perjalanan.',
        'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1400&q=85',
        'gallery' => [
            ['image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Ruang duduk elegan Executive Suite'],
            ['image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Interior suite dengan material alami'],
            ['image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Tempat tidur king di dalam suite'],
        ],
        'facilities' => ['Wi-Fi berkecepatan tinggi', 'Ruang duduk terpisah', 'Sofa bed', 'Smart TV', 'Bathtub dan shower', 'Perlengkapan mandi premium', 'Butler service', 'Sarapan untuk 2 tamu'],
    ],
    6 => [
        'name' => 'Presidential Suite',
        'type' => 'PRESIDENTIAL SUITE',
        'price' => 6800000,
        'capacity' => 5,
        'beds' => '2 King Beds',
        'size' => '125 m²',
        'description' => 'Presidential Suite adalah ruang privat paling istimewa di Hotel Arunika. Dua kamar tidur, lounge pribadi, dan kolam renang privat menghadirkan pengalaman menginap penuh keleluasaan, ditemani layanan personal untuk setiap kebutuhan Anda.',
        'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1400&q=85',
        'gallery' => [
            ['image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Ruang lounge luas Presidential Suite'],
            ['image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Salah satu kamar tidur Presidential Suite'],
            ['image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=85', 'alt' => 'Detail desain interior suite'],
        ],
        'facilities' => ['Wi-Fi berkecepatan tinggi', '2 kamar tidur', 'Private lounge', 'Kolam renang privat', 'Butler service', 'Bathtub dan shower', 'Perlengkapan mandi premium', 'Sarapan untuk 4 tamu'],
    ],
];

$hasRoomId = array_key_exists('id', $_GET);
$rawRoomId = isset($_GET['id']) && is_string($_GET['id']) ? $_GET['id'] : '';
$roomId = !$hasRoomId ? 1 : (ctype_digit($rawRoomId) ? (int) $rawRoomId : 0);
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

$checkIn = isset($_GET['check_in']) && is_string($_GET['check_in']) ? $_GET['check_in'] : '';
$checkOut = isset($_GET['check_out']) && is_string($_GET['check_out']) ? $_GET['check_out'] : '';
$rawGuests = isset($_GET['guests']) && is_string($_GET['guests']) ? $_GET['guests'] : '';
$guestCount = $rawGuests === '' ? 2 : (ctype_digit($rawGuests) ? (int) $rawGuests : 0);
$errors = [];
$nights = 0;
$totalPrice = 0;
$checkInDate = $checkIn !== '' ? $parseDate($checkIn) : null;
$checkOutDate = $checkOut !== '' ? $parseDate($checkOut) : null;
$bookRequested = isset($_GET['book']) && $_GET['book'] === '1';

if ($room !== null) {
    if ($guestCount < 1 || $guestCount > $room['capacity']) {
        $errors[] = 'Jumlah tamu harus antara 1 dan ' . $room['capacity'] . ' orang untuk kamar ini.';
        $guestCount = min(2, $room['capacity']);
    }

    if ($checkIn === '' && $checkOut === '') {
        if ($bookRequested) {
            $errors[] = 'Pilih tanggal check-in dan check-out untuk melanjutkan pemesanan.';
        }
    } elseif ($checkIn === '' || $checkOut === '') {
        $errors[] = 'Lengkapi tanggal check-in dan check-out.';
    } elseif ($checkInDate === null || $checkOutDate === null) {
        $errors[] = 'Tanggal yang dipilih tidak valid.';
    } elseif ($checkInDate < $today) {
        $errors[] = 'Tanggal check-in tidak boleh sebelum hari ini.';
    } elseif ($checkOutDate <= $checkInDate) {
        $errors[] = 'Tanggal check-out harus setelah tanggal check-in.';
    } else {
        $nights = (int) $checkInDate->diff($checkOutDate)->days;
        $totalPrice = $nights * $room['price'];
    }

    if ($bookRequested && !$errors && $nights > 0) {
        $bookingUrl = 'booking.php?' . http_build_query([
            'room_id' => $roomId,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => $guestCount,
        ]);
        header('Location: ' . $bookingUrl);
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $room !== null ? 'Detail ' . htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') . ' di Hotel Arunika, Bali. Lihat fasilitas dan pilih tanggal menginap Anda.' : 'Kamar tidak ditemukan di Hotel Arunika.' ?>">
    <title><?= $room !== null ? htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') . ' — Hotel Arunika' : 'Kamar Tidak Ditemukan — Hotel Arunika' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .detail-intro {
            position: relative;
            overflow: hidden;
            padding: 145px 0 42px;
            background-color: #36332e;
            background-position: center 50%;
            background-size: cover;
            color: #fff;
        }
        .detail-intro::before { position: absolute; inset: 0; background: linear-gradient(90deg, rgba(25,24,21,.78), rgba(25,24,21,.38)); content: ""; }
        .detail-intro .container { position: relative; }
        .detail-breadcrumb { margin-bottom: 25px; color: rgba(255,255,255,.72); font-size: 10px; }
        .detail-breadcrumb a:hover { color: #d8c292; }
        .detail-breadcrumb i { margin: 0 8px; color: #d8c292; }
        .detail-type { margin-bottom: 9px; color: #d8c292; font-size: 9px; font-weight: 600; letter-spacing: 2px; }
        .detail-intro h1 { margin: 0; font-family: var(--font-display); font-size: clamp(38px, 5vw, 58px); font-weight: 400; }
        .detail-main { padding: 38px 0 90px; background: var(--arunika-cream); }
        .detail-gallery { display: grid; grid-template-columns: 1.65fr 1fr; gap: 12px; margin-bottom: 42px; }
        .detail-gallery-main, .detail-gallery-side a { display: block; overflow: hidden; background: #d8d1c5; }
        .detail-gallery-main { min-height: 430px; }
        .detail-gallery-main img, .detail-gallery-side img { width: 100%; height: 100%; object-fit: cover; transition: transform .45s ease; }
        .detail-gallery a:hover img { transform: scale(1.035); }
        .detail-gallery-side { display: grid; grid-template-rows: repeat(3, 1fr); gap: 12px; min-height: 430px; }
        .detail-content { color: var(--arunika-ink); }
        .detail-description { margin: 17px 0 28px; color: var(--arunika-muted); font-size: 12px; line-height: 1.9; }
        .detail-facts { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 36px; }
        .detail-fact { padding: 18px; border: 1px solid var(--arunika-line); background: rgba(255,255,255,.65); }
        .detail-fact i { display: block; margin-bottom: 10px; color: var(--arunika-gold-dark); font-size: 18px; }
        .detail-fact span, .detail-fact strong { display: block; }
        .detail-fact span { margin-bottom: 4px; color: var(--arunika-muted); font-size: 9px; }
        .detail-fact strong { font-size: 11px; font-weight: 600; }
        .detail-section-title { margin-bottom: 17px; font-family: var(--font-display); font-size: 26px; font-weight: 400; }
        .detail-facilities { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 13px 20px; margin: 0; padding: 0; list-style: none; }
        .detail-facilities li { display: flex; align-items: flex-start; gap: 10px; color: var(--arunika-muted); font-size: 10px; line-height: 1.6; }
        .detail-facilities i { color: var(--arunika-gold-dark); }
        .booking-card { position: sticky; top: 24px; padding: 25px; background: #fff; box-shadow: 0 12px 36px rgba(48,39,26,.07); }
        .booking-card-label { margin-bottom: 5px; color: var(--arunika-muted); font-size: 9px; }
        .booking-card-price { margin-bottom: 20px; font-family: var(--font-display); font-size: 28px; }
        .booking-card-price span { color: var(--arunika-muted); font-family: var(--font-body); font-size: 10px; }
        .booking-card .form-label { margin-bottom: 7px; color: var(--arunika-muted); font-size: 9px; font-weight: 600; letter-spacing: .7px; }
        .booking-card .form-control, .booking-card .form-select { min-height: 43px; border-color: var(--arunika-line); border-radius: 0; font-size: 11px; }
        .booking-card .form-control:focus, .booking-card .form-select:focus { border-color: var(--arunika-gold); box-shadow: 0 0 0 .15rem rgba(182,154,103,.15); }
        .detail-errors { margin-bottom: 17px; padding: 12px 14px; border-left: 2px solid #a34a3d; background: #fbf1ef; color: #7d332b; font-size: 10px; }
        .detail-errors ul { margin: 0; padding-left: 16px; }
        .detail-errors li + li { margin-top: 5px; }
        .booking-total { display: flex; justify-content: space-between; gap: 10px; margin: 17px 0 14px; padding-top: 14px; border-top: 1px solid var(--arunika-line); font-size: 10px; }
        .booking-total strong { text-align: right; font-weight: 600; }
        .booking-summary { margin: -5px 0 16px; color: var(--arunika-muted); font-size: 9px; line-height: 1.6; }
        .booking-submit { width: 100%; min-height: 47px; border: 0; border-radius: 0; background: var(--arunika-ink); color: #fff; font-size: 10px; }
        .booking-submit:hover { background: var(--arunika-brown); color: #fff; }
        .booking-submit i { margin-left: 8px; }
        .booking-note { margin: 13px 0 0; color: var(--arunika-muted); font-size: 9px; line-height: 1.6; text-align: center; }
        .room-not-found { min-height: 54vh; padding: 170px 20px 70px; background: var(--arunika-cream); text-align: center; }
        .room-not-found h1 { margin-bottom: 12px; font-family: var(--font-display); font-size: 38px; font-weight: 400; }
        .room-not-found p { margin-bottom: 22px; color: var(--arunika-muted); font-size: 12px; }
        @media (max-width: 991.98px) {
            .detail-gallery { grid-template-columns: 1.3fr 1fr; }
            .detail-gallery-main, .detail-gallery-side { min-height: 350px; }
            .booking-card { position: static; margin-top: 32px; }
        }
        @media (max-width: 767.98px) {
            .detail-intro { padding: 125px 0 32px; }
            .detail-main { padding: 25px 0 65px; }
            .detail-gallery { grid-template-columns: 1fr; gap: 9px; margin-bottom: 30px; }
            .detail-gallery-main { min-height: 280px; }
            .detail-gallery-side { min-height: 0; grid-template-columns: repeat(2, 1fr); grid-template-rows: 130px 130px; gap: 9px; }
            .detail-gallery-side a:first-child { grid-column: 1 / -1; }
            .detail-facts { gap: 8px; }
            .detail-fact { padding: 13px 10px; }
            .detail-fact strong { font-size: 10px; }
            .detail-facilities { gap: 12px; }
            .booking-card { margin-top: 28px; padding: 21px; }
        }
        @media (max-width: 420px) {
            .detail-facilities { grid-template-columns: 1fr; }
            .detail-fact span { font-size: 8px; }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <?php if ($room === null): ?>
        <main class="room-not-found">
            <h1>Kamar tidak ditemukan</h1>
            <p>ID kamar tidak valid atau kamar yang Anda cari tidak tersedia.</p>
            <a class="btn btn-gold" href="rooms.php">Kembali ke daftar kamar <i class="bi bi-arrow-right"></i></a>
        </main>
    <?php else: ?>
        <main>
            <section class="detail-intro" style="background-image: linear-gradient(90deg, rgba(25,24,21,.78), rgba(25,24,21,.38)), url('<?= htmlspecialchars($room['image'], ENT_QUOTES, 'UTF-8') ?>')">
                <div class="container">
                    <nav class="detail-breadcrumb" aria-label="Breadcrumb">
                        <a href="index.php">Beranda</a><i class="bi bi-chevron-right"></i><a href="rooms.php">Kamar & Suite</a><i class="bi bi-chevron-right"></i><?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?>
                    </nav>
                    <p class="detail-type"><?= htmlspecialchars($room['type'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h1><?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?></h1>
                </div>
            </section>

            <section class="detail-main">
                <div class="container">
                    <div class="detail-gallery" aria-label="Foto <?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?>">
                        <a class="detail-gallery-main" href="<?= htmlspecialchars($room['image'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">
                            <img src="<?= htmlspecialchars($room['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Foto utama <?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?>">
                        </a>
                        <div class="detail-gallery-side">
                            <?php foreach ($room['gallery'] as $photo): ?>
                                <a href="<?= htmlspecialchars($photo['image'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">
                                    <img src="<?= htmlspecialchars($photo['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($photo['alt'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="detail-content">
                                <p class="eyebrow text-gold">RUANG UNTUK BERISTIRAHAT</p>
                                <h2 class="detail-section-title">Kenyamanan yang terasa personal.</h2>
                                <p class="detail-description"><?= htmlspecialchars($room['description'], ENT_QUOTES, 'UTF-8') ?></p>

                                <div class="detail-facts" aria-label="Informasi kamar">
                                    <div class="detail-fact"><i class="bi bi-people"></i><span>KAPASITAS MAKSIMAL</span><strong><?= $room['capacity'] ?> Tamu</strong></div>
                                    <div class="detail-fact"><i class="bi bi-moon-stars"></i><span>INFORMASI TEMPAT TIDUR</span><strong><?= htmlspecialchars($room['beds'], ENT_QUOTES, 'UTF-8') ?></strong></div>
                                    <div class="detail-fact"><i class="bi bi-aspect-ratio"></i><span>UKURAN KAMAR</span><strong><?= htmlspecialchars($room['size'], ENT_QUOTES, 'UTF-8') ?></strong></div>
                                </div>

                                <h2 class="detail-section-title">Fasilitas kamar</h2>
                                <ul class="detail-facilities">
                                    <?php foreach ($room['facilities'] as $facility): ?>
                                        <li><i class="bi bi-check2" aria-hidden="true"></i><span><?= htmlspecialchars($facility, ENT_QUOTES, 'UTF-8') ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <aside class="booking-card" aria-label="Form pemesanan kamar">
                                <p class="booking-card-label">Harga mulai dari</p>
                                <p class="booking-card-price">Rp <?= number_format($room['price'], 0, ',', '.') ?> <span>/ malam</span></p>
                                <p class="small text-muted mb-3">Check-in pukul <strong>14.00 WITA</strong><br>Check-out pukul <strong>12.00 WITA</strong></p>

                                <?php if ($errors): ?>
                                    <div class="detail-errors" role="alert">
                                        <ul>
                                            <?php foreach ($errors as $error): ?>
                                                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <form id="room-booking-form" action="room-detail.php" method="get" data-price="<?= $room['price'] ?>">
                                    <input type="hidden" name="id" value="<?= $roomId ?>">
                                    <div class="mb-3">
                                        <label class="form-label" for="check-in">CHECK-IN</label>
                                        <input class="form-control" id="check-in" name="check_in" type="date" min="<?= $today->format('Y-m-d') ?>" value="<?= htmlspecialchars($checkIn, ENT_QUOTES, 'UTF-8') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="check-out">CHECK-OUT</label>
                                        <input class="form-control" id="check-out" name="check_out" type="date" min="<?= $today->format('Y-m-d') ?>" value="<?= htmlspecialchars($checkOut, ENT_QUOTES, 'UTF-8') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="guests">JUMLAH TAMU</label>
                                        <select class="form-select" id="guests" name="guests">
                                            <?php for ($guestOption = 1; $guestOption <= $room['capacity']; $guestOption++): ?>
                                                <option value="<?= $guestOption ?>" <?= $guestCount === $guestOption ? 'selected' : '' ?>><?= $guestOption ?> Tamu</option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="booking-total">
                                        <span>Estimasi total</span>
                                        <strong id="booking-total"><?= $nights > 0 ? 'Rp ' . number_format($totalPrice, 0, ',', '.') : 'Pilih tanggal' ?></strong>
                                    </div>
                                    <p class="booking-summary" id="booking-summary" aria-live="polite"><?= $nights > 0 ? $nights . ' malam × Rp ' . number_format($room['price'], 0, ',', '.') . ' per malam' : 'Pilih tanggal check-in dan check-out untuk melihat estimasi biaya.' ?></p>
                                    <button class="btn booking-submit" type="submit" name="book" value="1">Pesan Kamar <i class="bi bi-arrow-right"></i></button>
                                    <p class="booking-note">Anda dapat meninjau detail pemesanan sebelum konfirmasi.</p>
                                </form>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    <?php endif; ?>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('room-booking-form');
            if (!form) {
                return;
            }

            var checkIn = document.getElementById('check-in');
            var checkOut = document.getElementById('check-out');
            var guests = document.getElementById('guests');
            var total = document.getElementById('booking-total');
            var summary = document.getElementById('booking-summary');
            var pricePerNight = Number(form.dataset.price);
            var formatter = new Intl.NumberFormat('id-ID');

            function updateSummary() {
                checkOut.min = checkIn.value || checkIn.min;
                checkOut.setCustomValidity('');

                if (!checkIn.value || !checkOut.value) {
                    total.textContent = 'Pilih tanggal';
                    summary.textContent = 'Pilih tanggal check-in dan check-out untuk melihat estimasi biaya.';
                    return;
                }

                var start = new Date(checkIn.value + 'T00:00:00');
                var end = new Date(checkOut.value + 'T00:00:00');
                var nights = Math.round((end - start) / 86400000);
                if (nights < 1) {
                    checkOut.setCustomValidity('Tanggal check-out harus setelah tanggal check-in.');
                    total.textContent = 'Tanggal tidak valid';
                    summary.textContent = 'Tanggal check-out harus setelah tanggal check-in.';
                    return;
                }

                total.textContent = 'Rp ' + formatter.format(pricePerNight * nights);
                summary.textContent = nights + ' malam × Rp ' + formatter.format(pricePerNight) + ' per malam · ' + guests.value + ' tamu';
            }

            checkIn.addEventListener('change', updateSummary);
            checkOut.addEventListener('change', updateSummary);
            guests.addEventListener('change', updateSummary);
            updateSummary();
        });
    </script>
</body>
</html>