<?php
$rooms = [
    [
        'name' => 'Arunika Garden Suite',
        'type' => 'SUITE · PEMANDANGAN TAMAN',
        'price' => '1.850.000',
        'image' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Kamar suite elegan dengan tempat tidur king',
        'features' => ['King bed', 'Balkon pribadi', 'Sarapan untuk 2'],
        'icon' => 'bi-flower1',
    ],
    [
        'name' => 'Serenity Ocean Room',
        'type' => 'DELUXE · PEMANDANGAN LAUT',
        'price' => '2.450.000',
        'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Kamar deluxe bernuansa hangat dan minimalis',
        'features' => ['King bed', 'Ocean view', 'Bathtub'],
        'icon' => 'bi-water',
    ],
    [
        'name' => 'The Arunika Residence',
        'type' => 'VILLA · PRIVATE POOL',
        'price' => '4.200.000',
        'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=85',
        'alt' => 'Interior villa mewah dengan desain kontemporer',
        'features' => ['2 kamar tidur', 'Private pool', 'Butler service'],
        'icon' => 'bi-house-heart',
    ],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Temukan ketenangan dan kemewahan yang personal di Hotel Arunika. Pesan kamar dan rencanakan pengalaman menginap istimewa Anda.">
    <title>Hotel Arunika — Ruang untuk Menemukan Ketenangan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main>
        <section class="hero-section">
            <img class="hero-image" src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=2200&q=90" alt="Resor tropis mewah dengan kolam renang dan pemandangan hijau">
            <div class="hero-shade"></div>
            <div class="container hero-content">
                <p class="eyebrow hero-eyebrow"><span></span> A SANCTUARY OF SERENITY <span></span></p>
                <h1>Temukan ruang<br>untuk <em>kembali.</em></h1>
                <p class="hero-copy">Sebuah jeda yang Anda butuhkan. Nikmati ketenangan, keramahan hangat, dan keindahan yang terasa begitu personal.</p>
                <a class="btn btn-gold hero-cta" href="#kamar">Jelajahi pengalaman <i class="bi bi-arrow-up-right"></i></a>
            </div>
            <div class="hero-caption"><span>01</span> &nbsp; BALI, INDONESIA</div>
            <div class="hero-scroll"><span></span> SCROLL TO EXPLORE</div>
        </section>

        <section class="booking-wrap" aria-label="Cari kamar">
            <div class="container">
                <form class="booking-search" action="rooms.php" method="get">
                    <div class="booking-field">
                        <label for="check-in"><i class="bi bi-calendar3"></i> CHECK-IN</label>
                        <input id="check-in" name="check_in" type="date" required>
                    </div>
                    <div class="booking-divider"></div>
                    <div class="booking-field">
                        <label for="check-out"><i class="bi bi-calendar3"></i> CHECK-OUT</label>
                        <input id="check-out" name="check_out" type="date" required>
                    </div>
                    <div class="booking-divider"></div>
                    <div class="booking-field guest-field">
                        <label for="guests"><i class="bi bi-person"></i> TAMU</label>
                        <select id="guests" name="guests" aria-label="Jumlah tamu">
                            <option value="1">1 Tamu</option>
                            <option value="2" selected>2 Tamu</option>
                            <option value="3">3 Tamu</option>
                            <option value="4">4 Tamu</option>
                            <option value="5">5+ Tamu</option>
                        </select>
                    </div>
                    <button class="btn btn-dark booking-submit" type="submit">Cari kamar <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>
        </section>

        <section class="section-space rooms-section" id="kamar">
            <div class="container">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow text-gold">PILIHAN UNTUK ANDA</p>
                        <h2>Ruang untuk <em>beristirahat.</em></h2>
                    </div>
                    <a class="text-link d-none d-md-inline-flex" href="rooms.php">Lihat semua kamar <i class="bi bi-arrow-up-right"></i></a>
                </div>
                <div class="row g-4">
                    <?php foreach ($rooms as $room): ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="room-card">
                                <a class="room-image-wrap" href="room-detail.php" aria-label="Lihat <?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?>">
                                    <img src="<?= htmlspecialchars($room['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($room['alt'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy">
                                    <span class="room-tag">PILIHAN ARUNIKA</span>
                                </a>
                                <div class="room-card-body">
                                    <p class="room-type"><?= htmlspecialchars($room['type'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <div class="room-title-row">
                                        <h3><?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                                        <i class="bi <?= htmlspecialchars($room['icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
                                    </div>
                                    <div class="room-features">
                                        <?php foreach ($room['features'] as $feature): ?>
                                            <span><?= htmlspecialchars($feature, ENT_QUOTES, 'UTF-8') ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="room-card-bottom">
                                        <p><strong>Rp <?= htmlspecialchars($room['price'], ENT_QUOTES, 'UTF-8') ?></strong> <span>/ malam</span></p>
                                        <a href="room-detail.php" aria-label="Pesan <?= htmlspecialchars($room['name'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-arrow-up-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="text-link mobile-all-rooms" href="rooms.php">Jelajahi semua kamar <i class="bi bi-arrow-up-right"></i></a>
            </div>
        </section>

        <section class="experience-section section-space" id="pengalaman">
            <div class="container">
                <div class="section-heading centered-heading">
                    <p class="eyebrow text-gold">LEBIH DARI SEKADAR MENGINAP</p>
                    <h2>Setiap momen punya <em>ceritanya.</em></h2>
                    <p class="section-intro">Biarkan hari berjalan lebih perlahan. Temukan hal-hal kecil yang membuat perjalanan Anda terasa istimewa.</p>
                </div>
                <div class="row g-3 experience-grid">
                    <div class="col-12 col-md-6 col-lg-3">
                        <article class="experience-card experience-card-tall">
                            <img src="https://images.unsplash.com/photo-1530789253388-582c481c54b0?auto=format&fit=crop&w=900&q=85" alt="Kolam renang tenang di antara taman tropis" loading="lazy">
                            <div><span>01 / WATER</span><h3>Ritme yang tenang</h3><p>Kolam renang infinity untuk menyambut pagi.</p></div>
                        </article>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <article class="experience-card">
                            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=900&q=85" alt="Ruang spa dengan suasana relaksasi" loading="lazy">
                            <div><span>02 / WELLNESS</span><h3>Rawat diri sejenak</h3><p>Ritual spa untuk tubuh dan pikiran.</p></div>
                        </article>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <article class="experience-card">
                            <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=900&q=85" alt="Hidangan yang disajikan dengan indah" loading="lazy">
                            <div><span>03 / DINING</span><h3>Rasa yang dikenang</h3><p>Bahan lokal, diracik dengan sepenuh hati.</p></div>
                        </article>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <article class="experience-card experience-card-tall">
                            <img src="https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=900&q=85" alt="Pemandangan pantai tropis saat matahari terbenam" loading="lazy">
                            <div><span>04 / DISCOVER</span><h3>Jelajahi sekitar</h3><p>Temukan pesona Bali dari sudut yang berbeda.</p></div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="story-section" id="tentang">
            <div class="story-image">
                <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1300&q=85" alt="Interior lounge elegan dengan material alami" loading="lazy">
                <div class="story-image-label"><span>DESIGNED TO FEEL LIKE YOURS</span></div>
            </div>
            <div class="story-copy">
                <p class="eyebrow text-gold">FILOSOFI ARUNIKA</p>
                <h2>Kemewahan yang terasa <em>seperti rumah.</em></h2>
                <p>Di Arunika, kemewahan bukan tentang berlebih. Ia hadir dalam detail yang dipikirkan dengan cermat, ruang yang memberi napas, dan keramahan yang tulus.</p>
                <p>Terinspirasi dari hangatnya cahaya pagi, kami menciptakan tempat untuk berhenti sejenak dan kembali menemukan diri.</p>
                <a class="text-link" href="rooms.php">Temukan kisah kami <i class="bi bi-arrow-up-right"></i></a>
                <div class="story-stat"><strong>12</strong><span>tahun menghadirkan<br>pengalaman bermakna</span></div>
            </div>
        </section>

        <section class="quote-section section-space">
            <div class="container">
                <p class="eyebrow">KATA MEREKA</p>
                <i class="bi bi-quote quote-mark"></i>
                <blockquote>“Rasanya seperti menemukan tempat yang selalu ingin saya datangi kembali. Setiap detailnya begitu hangat dan penuh perhatian.”</blockquote>
                <div class="quote-author">
                    <span class="quote-avatar">AS</span>
                    <div><strong>Aditya & Sari</strong><span>Menginap selama 4 malam · Jakarta</span></div>
                </div>
                <div class="quote-pagination"><span class="active"></span><span></span><span></span></div>
            </div>
        </section>

        <section class="closing-section">
            <div class="container closing-content">
                <p class="eyebrow">YOUR MOMENT STARTS HERE</p>
                <h2>Waktunya memberi ruang<br>untuk <em>diri sendiri.</em></h2>
                <a class="btn btn-gold" href="#check-in">Rencanakan kunjungan <i class="bi bi-arrow-up-right"></i></a>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>