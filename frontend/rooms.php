<?php
$rooms = [
    [
        'id' => 1,
        'name' => 'Standard Room',
        'type' => 'Standard Room',
        'description' => 'Ruang nyaman bernuansa hangat untuk beristirahat setelah hari yang panjang.',
        'capacity' => 2,
        'price' => 950000,
        'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Kamar standard dengan tempat tidur nyaman dan interior hangat',
        'features' => ['Queen bed', 'Wi-Fi', 'Sarapan'],
        'icon' => 'bi-door-open',
    ],
    [
        'id' => 2,
        'name' => 'Deluxe Room',
        'type' => 'Deluxe Room',
        'description' => 'Kamar luas dengan sentuhan elegan dan fasilitas untuk pengalaman menginap istimewa.',
        'capacity' => 2,
        'price' => 1450000,
        'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Kamar deluxe dengan desain modern dan tempat tidur king',
        'features' => ['King bed', 'Balkon', 'Bathtub'],
        'icon' => 'bi-stars',
    ],
    [
        'id' => 3,
        'name' => 'Superior Room',
        'type' => 'Superior Room',
        'description' => 'Pilihan tenang dengan desain kontemporer dan pemandangan taman tropis.',
        'capacity' => 2,
        'price' => 1250000,
        'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Interior superior room dengan material alami dan warna netral',
        'features' => ['King bed', 'Pemandangan taman', 'Lounge'],
        'icon' => 'bi-flower1',
    ],
    [
        'id' => 4,
        'name' => 'Family Room',
        'type' => 'Family Room',
        'description' => 'Ruang lega dengan area tidur tambahan, ideal untuk menikmati waktu bersama keluarga.',
        'capacity' => 4,
        'price' => 2100000,
        'image' => 'https://images.unsplash.com/photo-1564078516393-cf04bd966897?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Kamar keluarga luas dengan dua tempat tidur',
        'features' => ['2 queen bed', 'Area keluarga', 'Sarapan untuk 4'],
        'icon' => 'bi-people',
    ],
    [
        'id' => 5,
        'name' => 'Executive Suite',
        'type' => 'Executive Suite',
        'description' => 'Suite dengan ruang duduk privat dan detail mewah untuk kenyamanan lebih.',
        'capacity' => 3,
        'price' => 3250000,
        'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Executive suite dengan ruang duduk dan dekorasi elegan',
        'features' => ['King bed', 'Ruang duduk', 'Butler service'],
        'icon' => 'bi-gem',
    ],
    [
        'id' => 6,
        'name' => 'Presidential Suite',
        'type' => 'Presidential Suite',
        'description' => 'Pengalaman menginap paling istimewa dengan ruang luas dan layanan personal.',
        'capacity' => 5,
        'price' => 6800000,
        'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Presidential suite mewah dengan interior lapang dan elegan',
        'features' => ['2 kamar tidur', 'Private lounge', 'Kolam privat'],
        'icon' => 'bi-house-heart',
    ],
];

$roomTypes = array_column($rooms, 'type');
$typeFilter = isset($_GET['type']) && is_string($_GET['type']) ? $_GET['type'] : '';
if (!in_array($typeFilter, $roomTypes, true)) {
    $typeFilter = '';
}

$rawMinPrice = isset($_GET['min_price']) && is_string($_GET['min_price']) ? $_GET['min_price'] : '';
$rawMaxPrice = isset($_GET['max_price']) && is_string($_GET['max_price']) ? $_GET['max_price'] : '';
$minPrice = $rawMinPrice !== '' && ctype_digit($rawMinPrice) ? (int) $rawMinPrice : null;
$maxPrice = $rawMaxPrice !== '' && ctype_digit($rawMaxPrice) ? (int) $rawMaxPrice : null;

$rawGuests = isset($_GET['guests']) && is_string($_GET['guests']) ? $_GET['guests'] : '';
$guests = ctype_digit($rawGuests) && (int) $rawGuests >= 1 && (int) $rawGuests <= 5
    ? (int) $rawGuests
    : 1;
$sort = isset($_GET['sort']) && is_string($_GET['sort']) ? $_GET['sort'] : '';
if (!in_array($sort, ['price_asc', 'price_desc'], true)) {
    $sort = '';
}

$checkIn = isset($_GET['check_in']) && is_string($_GET['check_in']) ? $_GET['check_in'] : '';
$checkOut = isset($_GET['check_out']) && is_string($_GET['check_out']) ? $_GET['check_out'] : '';

$filteredRooms = array_filter($rooms, function ($room) use ($typeFilter, $minPrice, $maxPrice, $guests) {
    if ($typeFilter !== '' && $room['type'] !== $typeFilter) {
        return false;
    }
    if ($minPrice !== null && $room['price'] < $minPrice) {
        return false;
    }
    if ($maxPrice !== null && $room['price'] > $maxPrice) {
        return false;
    }
    return $room['capacity'] >= $guests;
});

if ($sort === 'price_asc') {
    usort($filteredRooms, function ($first, $second) {
        return $first['price'] <=> $second['price'];
    });
} elseif ($sort === 'price_desc') {
    usort($filteredRooms, function ($first, $second) {
        return $second['price'] <=> $first['price'];
    });
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Jelajahi pilihan kamar dan suite Hotel Arunika. Temukan ruang yang tepat untuk pengalaman menginap Anda di Bali.">
    <title>Kamar & Suite — Hotel Arunika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .rooms-hero {
            position: relative;
            display: flex;
            min-height: 370px;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(90deg, rgba(28, 27, 23, .78), rgba(28, 27, 23, .32)), url("https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=2000&q=85") center 52% / cover;
            color: #fff;
        }
        .rooms-hero-content { position: relative; padding-top: 85px; padding-bottom: 45px; }
        .rooms-hero .eyebrow { color: #d8c292; }
        .rooms-hero h1 { margin-bottom: 13px; font-family: var(--font-display); font-size: clamp(38px, 5vw, 58px); font-weight: 400; }
        .rooms-hero h1 em { color: #d2b982; font-weight: 400; }
        .rooms-hero p:last-child { max-width: 520px; margin-bottom: 0; color: rgba(255,255,255,.78); font-size: 13px; line-height: 1.8; }
        .rooms-listing { padding: 48px 0 90px; background: var(--arunika-cream); }
        .rooms-filter { margin-bottom: 42px; padding: 25px; background: #fff; box-shadow: 0 12px 36px rgba(48,39,26,.06); }
        .rooms-filter label { display: block; margin-bottom: 8px; color: var(--arunika-muted); font-size: 9px; font-weight: 600; letter-spacing: 1px; }
        .rooms-filter .form-control, .rooms-filter .form-select { min-height: 43px; border-color: var(--arunika-line); border-radius: 0; color: var(--arunika-ink); font-family: var(--font-body); font-size: 11px; }
        .rooms-filter .form-control:focus, .rooms-filter .form-select:focus { border-color: var(--arunika-gold); box-shadow: 0 0 0 .15rem rgba(182,154,103,.15); }
        .rooms-filter-actions { display: flex; align-items: end; gap: 10px; }
        .rooms-filter-submit { min-height: 43px; padding: 0 18px; border: 0; border-radius: 0; background: var(--arunika-ink); color: #fff; font-size: 10px; white-space: nowrap; }
        .rooms-filter-submit:hover { background: var(--arunika-brown); color: #fff; }
        .rooms-reset { min-height: 43px; display: inline-flex; align-items: center; padding: 0 10px; color: var(--arunika-muted); font-size: 10px; white-space: nowrap; }
        .rooms-results-heading { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin-bottom: 25px; }
        .rooms-results-heading .eyebrow { margin-bottom: 8px; }
        .rooms-results-heading h2 { margin: 0; font-family: var(--font-display); font-size: clamp(27px, 3vw, 36px); font-weight: 400; }
        .rooms-results-heading h2 em { color: var(--arunika-gold-dark); }
        .rooms-count { margin: 0 0 4px; color: var(--arunika-muted); font-size: 10px; }
        .rooms-page .room-card { display: flex; flex-direction: column; }
        .rooms-page .room-card-body { display: flex; flex: 1; flex-direction: column; }
        .room-description { min-height: 40px; margin: 11px 0 0; color: var(--arunika-muted); font-size: 10px; line-height: 1.7; }
        .room-capacity { margin: 13px 0 0; color: var(--arunika-muted); font-size: 9px; }
        .room-capacity i { margin-right: 5px; color: var(--arunika-gold-dark); }
        .rooms-page .room-features { margin-top: 11px; }
        .rooms-page .room-card-bottom { margin-top: auto; }
        .room-detail-link { display: inline-flex; align-items: center; gap: 8px; color: var(--arunika-ink); font-size: 9px; font-weight: 600; }
        .room-detail-link i { color: var(--arunika-gold-dark); }
        .rooms-page .room-card-bottom > .room-detail-link { width: auto; height: auto; border: 0; background: transparent; }
        .rooms-page .room-card-bottom > .room-detail-link:hover { border: 0; background: transparent; color: var(--arunika-gold-dark); }
        .rooms-empty { padding: 55px 20px; background: #fff; text-align: center; }
        .rooms-empty i { display: block; margin-bottom: 12px; color: var(--arunika-gold-dark); font-size: 28px; }
        .rooms-empty h3 { font-family: var(--font-display); font-size: 24px; font-weight: 400; }
        .rooms-empty p { margin-bottom: 0; color: var(--arunika-muted); font-size: 11px; }
        @media (max-width: 767.98px) {
            .rooms-hero { min-height: 340px; }
            .rooms-hero-content { padding-top: 105px; padding-bottom: 38px; }
            .rooms-listing { padding: 35px 0 65px; }
            .rooms-filter { margin-bottom: 32px; padding: 19px; }
            .rooms-results-heading { align-items: flex-start; flex-direction: column; gap: 8px; }
        }
    </style>
</head>
<body class="rooms-page">
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main>
        <section class="rooms-hero">
            <div class="container rooms-hero-content">
                <p class="eyebrow">KAMAR & SUITE · HOTEL ARUNIKA</p>
                <h1>Temukan kamar<br><em>untuk Anda.</em></h1>
                <p>Setiap ruang dirancang untuk memberi jeda yang terasa personal. Pilih kenyamanan yang paling sesuai dengan perjalanan Anda.</p>
            </div>
        </section>

        <section class="rooms-listing" aria-label="Daftar dan filter kamar">
            <div class="container">
                <form class="rooms-filter" action="rooms.php" method="get">
                    <div class="row g-3 align-items-end">
                        <div class="col-6 col-lg-2">
                            <label for="check-in"><i class="bi bi-calendar3"></i> CHECK-IN</label>
                            <input class="form-control" id="check-in" name="check_in" type="date" value="<?= htmlspecialchars($checkIn, ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="col-6 col-lg-2">
                            <label for="check-out"><i class="bi bi-calendar3"></i> CHECK-OUT</label>
                            <input class="form-control" id="check-out" name="check_out" type="date" value="<?= htmlspecialchars($checkOut, ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="col-6 col-lg-2">
                            <label for="guests"><i class="bi bi-person"></i> JUMLAH TAMU</label>
                            <select class="form-select" id="guests" name="guests">
                                <?php for ($guestOption = 1; $guestOption <= 5; $guestOption++): ?>
                                    <option value="<?= $guestOption ?>" <?= $guests === $guestOption ? 'selected' : '' ?>><?= $guestOption === 5 ? '5+ Tamu' : $guestOption . ' Tamu' ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-6 col-lg-2">
                            <label for="type">TIPE KAMAR</label>
                            <select class="form-select" id="type" name="type">
                                <option value="">Semua tipe</option>
                                <?php foreach ($roomTypes as $roomType): ?>
                                    <option value="<?= htmlspecialchars($roomType, ENT_QUOTES, 'UTF-8') ?>" <?= $typeFilter === $roomType ? 'selected' : '' ?>><?= htmlspecialchars($roomType, ENT_QUOTES, 'UTF-8') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-6 col-lg-2">
                            <label for="min-price">HARGA MINIMUM (RP)</label>
                            <input class="form-control" id="min-price" name="min_price" type="number" min="0" step="50000" placeholder="Tanpa batas" value="<?= $minPrice !== null ? $minPrice : '' ?>">
                        </div>
                        <div class="col-6 col-lg-2">
                            <label for="max-price">HARGA MAKSIMUM (RP)</label>
                            <input class="form-control" id="max-price" name="max_price" type="number" min="0" step="50000" placeholder="Tanpa batas" value="<?= $maxPrice !== null ? $maxPrice : '' ?>">
                        </div>
                        <div class="col-6 col-lg-3">
                            <label for="sort">URUTKAN HARGA</label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="">Pilihan kami</option>
                                <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Termurah</option>
                                <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Termahal</option>
                            </select>
                        </div>
                        <div class="col-6 col-lg-9">
                            <div class="rooms-filter-actions">
                                <button class="btn rooms-filter-submit" type="submit">Cari kamar <i class="bi bi-arrow-right"></i></button>
                                <a class="rooms-reset" href="rooms.php">Atur ulang</a>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="rooms-results-heading">
                    <div>
                        <p class="eyebrow text-gold">PILIHAN UNTUK ANDA</p>
                        <h2>Ruang untuk <em>beristirahat.</em></h2>
                    </div>
                    <p class="rooms-count"><?= count($filteredRooms) ?> kamar ditemukan</p>
                </div>

                <?php if ($filteredRooms): ?>
                    <div class="row g-4">
                        <?php foreach ($filteredRooms as $room): ?>
                            <div class="col-md-6 col-lg-4">
                                <article class="room-card">
                                    <a class="room-image-wrap" href="room-detail.php?id=<?= $room['id'] ?>" aria-label="Lihat <?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?>">
                                        <img src="<?= htmlspecialchars($room['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($room['alt'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy">
                                        <span class="room-tag">PILIHAN ARUNIKA</span>
                                    </a>
                                    <div class="room-card-body">
                                        <p class="room-type"><?= htmlspecialchars($room['type'], ENT_QUOTES, 'UTF-8') ?></p>
                                        <div class="room-title-row">
                                            <h3><?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                                            <i class="bi <?= htmlspecialchars($room['icon'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                                        </div>
                                        <p class="room-description"><?= htmlspecialchars($room['description'], ENT_QUOTES, 'UTF-8') ?></p>
                                        <p class="room-capacity"><i class="bi bi-person"></i> Hingga <?= $room['capacity'] ?> tamu</p>
                                        <div class="room-features">
                                            <?php foreach ($room['features'] as $feature): ?>
                                                <span><?= htmlspecialchars($feature, ENT_QUOTES, 'UTF-8') ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="room-card-bottom">
                                            <p><strong>Rp <?= number_format($room['price'], 0, ',', '.') ?></strong> <span>/ malam</span></p>
                                            <a class="room-detail-link" href="room-detail.php?id=<?= $room['id'] ?>">Lihat Detail <i class="bi bi-arrow-up-right"></i></a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="rooms-empty">
                        <i class="bi bi-search" aria-hidden="true"></i>
                        <h3>Kamar belum ditemukan</h3>
                        <p>Coba sesuaikan tipe kamar, jumlah tamu, atau kisaran harga Anda.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>