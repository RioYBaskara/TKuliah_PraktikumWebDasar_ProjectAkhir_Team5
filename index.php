<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$reservasiUrl = $isLoggedIn ? 'reservasi.php' : 'login.php?redirect=reservasi.php';

$userName = isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama'], ENT_QUOTES, 'UTF-8') : '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Reservasi Tiket Wisata Benteng Vredeburg</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0f3d3e;
            --primary-dark: #092829;
            --secondary: #d9a441;
            --soft-bg: #f7f5f0;
            --text-dark: #1f2933;
            --text-muted: #6b7280;
            --border-soft: #e5e7eb;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text-dark);
            background-color: #ffffff;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-soft);
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.4px;
        }

        .nav-link {
            font-weight: 500;
            color: #374151;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
        }

        .btn-primary-custom {
            background-color: var(--primary);
            color: #ffffff;
            border: 1px solid var(--primary);
            border-radius: 999px;
            padding: 10px 22px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-outline-custom {
            border: 1px solid var(--primary);
            color: var(--primary);
            border-radius: 999px;
            padding: 10px 22px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary);
            color: #ffffff;
        }

        .hero-section {
            min-height: 92vh;
            display: flex;
            align-items: center;
            background:
                linear-gradient(120deg, rgba(9, 40, 41, 0.92), rgba(15, 61, 62, 0.78)),
                url("assets/img/hero-vredeburg.jpg");
            background-size: cover;
            background-position: center;
            color: #ffffff;
            padding-top: 90px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::after {
            content: "";
            position: absolute;
            right: -140px;
            bottom: -140px;
            width: 420px;
            height: 420px;
            background-color: rgba(217, 164, 65, 0.18);
            border-radius: 50%;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .hero-title {
            font-size: clamp(38px, 6vw, 72px);
            line-height: 1.04;
            letter-spacing: -1.8px;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .hero-desc {
            color: rgba(255, 255, 255, 0.84);
            font-size: 18px;
            line-height: 1.8;
            max-width: 680px;
        }

        .hero-card {
            background-color: rgba(255, 255, 255, 0.96);
            color: var(--text-dark);
            border-radius: 28px;
            padding: 26px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.25);
            position: relative;
            z-index: 2;
        }

        .quota-card {
            border: 1px solid var(--border-soft);
            border-radius: 22px;
            padding: 22px;
            background-color: #ffffff;
            box-shadow: 0 18px 40px rgba(15, 61, 62, 0.08);
        }

        .quota-number {
            font-size: 42px;
            font-weight: 900;
            color: var(--primary);
            letter-spacing: -1px;
        }

        .quota-label {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .section-padding {
            padding: 90px 0;
        }

        .section-soft {
            background-color: var(--soft-bg);
        }

        .section-title {
            font-weight: 900;
            letter-spacing: -0.9px;
            color: var(--primary-dark);
            margin-bottom: 12px;
        }

        .section-subtitle {
            color: var(--text-muted);
            max-width: 720px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .feature-card {
            height: 100%;
            background-color: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 24px;
            padding: 28px;
            transition: 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 45px rgba(15, 61, 62, 0.1);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background-color: rgba(15, 61, 62, 0.1);
            color: var(--primary);
            font-size: 24px;
            margin-bottom: 18px;
        }

        .gallery-card {
            border: 0;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 18px 42px rgba(17, 24, 39, 0.08);
        }

        .gallery-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: 0.3s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.04);
        }

        .rule-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .rule-list li {
            display: flex;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border-soft);
        }

        .rule-list li:last-child {
            border-bottom: 0;
        }

        .rule-list i {
            color: var(--primary);
            font-size: 20px;
            flex-shrink: 0;
        }

        .step-item {
            position: relative;
            padding-left: 72px;
            margin-bottom: 28px;
        }

        .step-number {
            position: absolute;
            left: 0;
            top: 0;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background-color: var(--primary);
            color: #ffffff;
            font-weight: 800;
        }

        .cta-section {
            background:
                linear-gradient(120deg, rgba(15, 61, 62, 0.96), rgba(9, 40, 41, 0.96));
            color: #ffffff;
            border-radius: 34px;
            padding: 58px 34px;
        }

        .footer {
            background-color: var(--primary-dark);
            color: rgba(255, 255, 255, 0.78);
            padding: 42px 0;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.78);
            text-decoration: none;
        }

        .footer a:hover {
            color: #ffffff;
        }

        .badge-status {
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 700;
        }

        .badge-open {
            background-color: rgba(22, 163, 74, 0.12);
            color: #15803d;
        }

        .badge-limited {
            background-color: rgba(217, 164, 65, 0.16);
            color: #9a6b05;
        }

        .badge-full {
            background-color: rgba(220, 38, 38, 0.12);
            color: #b91c1c;
        }

        @media (max-width: 991.98px) {
            .hero-section {
                padding: 120px 0 70px;
                min-height: auto;
            }

            .hero-card {
                margin-top: 36px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-bank2"></i>
            Benteng Vredeburg
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link active" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sejarah">Sejarah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#galeri">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#aturan">Aturan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#alur">Alur Reservasi</a>
                </li>

                <?php if ($isLoggedIn): ?>
                    <li class="nav-item ms-lg-3">
                        <a href="dashboard.php" class="btn btn-outline-custom">
                            Dashboard
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a href="login.php" class="btn btn-outline-custom">
                            Login
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a href="<?= $reservasiUrl; ?>" class="btn btn-primary-custom">
                        Reservasi Sekarang
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="beranda" class="hero-section">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-badge">
                    <i class="bi bi-clock-history"></i>
                    Reservasi real-time dengan kuota 50 orang per jam
                </div>

                <h1 class="hero-title">
                    Reservasi Tiket Wisata Benteng Vredeburg Lebih Cepat dan Teratur
                </h1>

                <p class="hero-desc">
                    Sistem reservasi berbasis web untuk membantu pengunjung memesan tiket secara transparan,
                    melihat ketersediaan kuota, dan mendapatkan informasi kunjungan sebelum datang ke museum.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                    <a href="<?= $reservasiUrl; ?>" class="btn btn-primary-custom">
                        <i class="bi bi-ticket-perforated me-2"></i>
                        Reservasi Sekarang
                    </a>
                    <a href="#aturan" class="btn btn-outline-light rounded-pill px-4 py-2 fw-bold">
                        Lihat Aturan Kunjungan
                    </a>
                </div>

                <?php if ($isLoggedIn): ?>
                    <p class="mt-4 mb-0 text-white-50">
                        Selamat datang, <?= $userName; ?>. Anda dapat melihat reservasi melalui dashboard.
                    </p>
                <?php else: ?>
                    <p class="mt-4 mb-0 text-white-50">
                        Belum punya akun? Daftar terlebih dahulu agar dapat melakukan reservasi tiket.
                    </p>
                <?php endif; ?>
            </div>

            <div class="col-lg-5">
                <div class="hero-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">Cek Kuota Hari Ini</h5>
                            <p class="text-muted mb-0 small">
                                Data diperbarui otomatis melalui AJAX.
                            </p>
                        </div>
                        <span id="quotaStatus" class="badge-status badge-open">
                            Memuat
                        </span>
                    </div>

                    <div class="quota-card mb-3">
                        <p class="quota-label">Sisa kuota tersedia</p>
                        <div class="quota-number">
                            <span id="remainingQuota">-</span>
                        </div>
                        <p class="text-muted mb-0">
                            dari <span id="totalQuota">-</span> kuota kunjungan hari ini
                        </p>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="quota-card">
                                <p class="quota-label">Sudah dipesan</p>
                                <h4 class="fw-bold mb-0" id="bookedQuota">-</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="quota-card">
                                <p class="quota-label">Batas per jam</p>
                                <h4 class="fw-bold mb-0">50</h4>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="<?= $reservasiUrl; ?>" class="btn btn-primary-custom w-100">
                            Pilih Jadwal Kunjungan
                        </a>
                    </div>

                    <p class="text-muted small mt-3 mb-0">
                        Jika pembayaran belum dikonfirmasi dalam 2 jam, reservasi dapat dibatalkan otomatis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding section-soft">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Layanan Utama Sistem</h2>
            <p class="section-subtitle">
                Sistem ini membantu pengunjung dan admin mengelola proses reservasi secara rapi,
                terukur, dan mudah dipantau.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h5 class="fw-bold">Login dan Register</h5>
                    <p class="text-muted mb-0">
                        Pengunjung wajib memiliki akun sebelum membuat reservasi tiket.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-broadcast"></i>
                    </div>
                    <h5 class="fw-bold">Live Quota Check</h5>
                    <p class="text-muted mb-0">
                        Kuota kunjungan dicek secara real-time menggunakan AJAX.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h5 class="fw-bold">Konfirmasi WhatsApp</h5>
                    <p class="text-muted mb-0">
                        Pembayaran dilakukan manual melalui WhatsApp untuk kemudahan operasional.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h5 class="fw-bold">Dashboard Admin</h5>
                    <p class="text-muted mb-0">
                        Admin dapat melihat grafik penjualan, validasi pembayaran, dan riwayat reservasi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="sejarah" class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="assets/img/sejarah-vredeburg.jpg" class="img-fluid rounded-5 shadow" alt="Benteng Vredeburg">
            </div>

            <div class="col-lg-6">
                <span class="text-uppercase fw-bold text-muted small">Sejarah Singkat</span>
                <h2 class="section-title mt-2">
                    Benteng Vredeburg sebagai Ruang Edukasi Sejarah
                </h2>
                <p class="text-muted lh-lg">
                    Benteng Vredeburg merupakan salah satu destinasi wisata sejarah yang memiliki nilai edukasi tinggi.
                    Museum ini menjadi ruang pembelajaran tentang perjalanan sejarah, perjuangan, dan perkembangan
                    masyarakat pada masa lalu.
                </p>
                <p class="text-muted lh-lg">
                    Melalui sistem reservasi digital, proses kunjungan dapat dibuat lebih tertib. Pembatasan kuota
                    membantu menjaga kenyamanan pengunjung serta mendukung pelestarian kawasan cagar budaya.
                </p>

                <div class="row g-3 mt-3">
                    <div class="col-sm-6">
                        <div class="quota-card">
                            <h4 class="fw-bold text-success mb-1">50</h4>
                            <p class="text-muted mb-0">Maksimal pengunjung per jam</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="quota-card">
                            <h4 class="fw-bold text-success mb-1">2 Jam</h4>
                            <p class="text-muted mb-0">Batas konfirmasi pembayaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="galeri" class="section-padding section-soft">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Galeri Wisata</h2>
            <p class="section-subtitle">
                Beberapa area dan suasana kunjungan yang dapat dinikmati oleh pengunjung museum.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card gallery-card">
                    <img src="assets/img/galeri-1.jpg" alt="Area Museum">
                    <div class="card-body">
                        <h5 class="fw-bold">Area Museum</h5>
                        <p class="text-muted mb-0">
                            Ruang edukasi sejarah dengan alur kunjungan yang tertata.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card gallery-card">
                    <img src="assets/img/galeri-2.jpg" alt="Bangunan Bersejarah">
                    <div class="card-body">
                        <h5 class="fw-bold">Bangunan Bersejarah</h5>
                        <p class="text-muted mb-0">
                            Kawasan cagar budaya yang perlu dijaga kenyamanan dan kelestariannya.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card gallery-card">
                    <img src="assets/img/galeri-3.jpg" alt="Kunjungan Edukatif">
                    <div class="card-body">
                        <h5 class="fw-bold">Kunjungan Edukatif</h5>
                        <p class="text-muted mb-0">
                            Cocok untuk pengunjung umum, pelajar, komunitas, dan rombongan kecil.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-muted text-center small mt-4 mb-0">
            Ganti gambar pada folder assets/img sesuai dokumentasi museum yang tersedia.
        </p>
    </div>
</section>

<section id="aturan" class="section-padding">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5">
                <span class="text-uppercase fw-bold text-muted small">Aturan Kunjungan</span>
                <h2 class="section-title mt-2">
                    Ketentuan Sebelum Melakukan Reservasi
                </h2>
                <p class="text-muted lh-lg">
                    Setiap pengunjung wajib mengikuti aturan kunjungan agar proses masuk museum berjalan tertib,
                    aman, dan sesuai kapasitas yang tersedia.
                </p>

                <a href="<?= $reservasiUrl; ?>" class="btn btn-primary-custom mt-3">
                    Buat Reservasi
                </a>
            </div>

            <div class="col-lg-7">
                <div class="quota-card">
                    <ul class="rule-list">
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Kuota maksimal 50 orang per jam</h6>
                                <p class="text-muted mb-0">
                                    Sistem akan menolak reservasi jika kuota pada jam tersebut sudah penuh.
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Reservasi wajib menggunakan akun</h6>
                                <p class="text-muted mb-0">
                                    Pengguna harus login atau register sebelum memilih jadwal kunjungan.
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Pembayaran dikonfirmasi melalui WhatsApp</h6>
                                <p class="text-muted mb-0">
                                    Setelah reservasi dibuat, pengguna diarahkan untuk melakukan konfirmasi pembayaran.
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Batas konfirmasi 2 jam</h6>
                                <p class="text-muted mb-0">
                                    Reservasi yang tidak dikonfirmasi dalam 2 jam dapat dibatalkan otomatis oleh sistem.
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Datang sesuai jadwal</h6>
                                <p class="text-muted mb-0">
                                    Pengunjung disarankan datang sesuai jam reservasi agar tidak mengganggu kuota sesi lain.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="alur" class="section-padding section-soft">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Alur Reservasi Pengunjung</h2>
            <p class="section-subtitle">
                Alur dibuat sederhana agar pengunjung dapat memesan tiket tanpa proses yang rumit.
            </p>
        </div>

        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <h5 class="fw-bold">Lihat informasi kunjungan</h5>
                    <p class="text-muted mb-0">
                        Pengunjung melihat galeri, sejarah singkat, aturan kunjungan, dan informasi kuota.
                    </p>
                </div>

                <div class="step-item">
                    <div class="step-number">2</div>
                    <h5 class="fw-bold">Klik Reservasi Sekarang</h5>
                    <p class="text-muted mb-0">
                        Jika belum login, pengguna diarahkan ke halaman login atau register terlebih dahulu.
                    </p>
                </div>

                <div class="step-item">
                    <div class="step-number">3</div>
                    <h5 class="fw-bold">Pilih tanggal dan jam kunjungan</h5>
                    <p class="text-muted mb-0">
                        Sistem melakukan pengecekan kuota secara real-time menggunakan AJAX.
                    </p>
                </div>

                <div class="step-item">
                    <div class="step-number">4</div>
                    <h5 class="fw-bold">Konfirmasi pembayaran</h5>
                    <p class="text-muted mb-0">
                        Pengguna mengirim bukti pembayaran melalui WhatsApp dan menunggu validasi admin.
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="quota-card">
                    <h4 class="fw-bold mb-3">Status Reservasi yang Akan Dilihat User</h4>

                    <div class="d-flex align-items-center gap-3 p-3 rounded-4 border mb-3">
                        <div class="feature-icon mb-0">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Menunggu Pembayaran</h6>
                            <p class="text-muted mb-0 small">
                                Reservasi sudah dibuat, tetapi pembayaran belum dikonfirmasi.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 p-3 rounded-4 border mb-3">
                        <div class="feature-icon mb-0">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Menunggu Validasi Admin</h6>
                            <p class="text-muted mb-0 small">
                                Bukti pembayaran sudah dikirim dan sedang diperiksa admin.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 p-3 rounded-4 border">
                        <div class="feature-icon mb-0">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Reservasi Disetujui</h6>
                            <p class="text-muted mb-0 small">
                                Tiket valid dan dapat digunakan sesuai jadwal kunjungan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="cta-section text-center">
            <h2 class="fw-bold mb-3">
                Siap Berkunjung ke Benteng Vredeburg?
            </h2>
            <p class="mx-auto mb-4" style="max-width: 680px; color: rgba(255,255,255,0.82);">
                Buat reservasi lebih awal untuk memastikan jadwal kunjungan masih tersedia.
                Sistem akan membantu mengecek kuota secara cepat dan transparan.
            </p>

            <a href="<?= $reservasiUrl; ?>" class="btn btn-light rounded-pill px-4 py-2 fw-bold">
                <i class="bi bi-ticket-detailed me-2"></i>
                Reservasi Sekarang
            </a>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <h5 class="text-white fw-bold mb-3">
                    Sistem Reservasi Tiket Wisata Benteng Vredeburg
                </h5>
                <p class="mb-0">
                    Aplikasi reservasi berbasis web untuk mendukung proses kunjungan museum yang lebih tertib,
                    transparan, dan mudah dikelola.
                </p>
            </div>

            <div class="col-lg-3">
                <h6 class="text-white fw-bold mb-3">Menu</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="#sejarah">Sejarah</a>
                    <a href="#galeri">Galeri</a>
                    <a href="#aturan">Aturan Kunjungan</a>
                    <a href="#alur">Alur Reservasi</a>
                </div>
            </div>

            <div class="col-lg-4">
                <h6 class="text-white fw-bold mb-3">Kontak</h6>
                <p class="mb-2">
                    <i class="bi bi-geo-alt me-2"></i>
                    Yogyakarta, Indonesia
                </p>
                <p class="mb-2">
                    <i class="bi bi-whatsapp me-2"></i>
                    08xx-xxxx-xxxx
                </p>
                <p class="mb-0">
                    <i class="bi bi-envelope me-2"></i>
                    admin@vredeburg-reservasi.test
                </p>
            </div>
        </div>

        <hr class="border-light opacity-25 my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
            <p class="mb-0 small">
                &copy; <?= date('Y'); ?> Sistem Reservasi Benteng Vredeburg.
            </p>
            <p class="mb-0 small">
                Dibangun dengan PHP, MySQL, AJAX, dan Bootstrap 5.3.
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadTodayQuota();
    });

    function loadTodayQuota() {
        const remainingQuota = document.getElementById('remainingQuota');
        const totalQuota = document.getElementById('totalQuota');
        const bookedQuota = document.getElementById('bookedQuota');
        const quotaStatus = document.getElementById('quotaStatus');

        fetch('ajax/check_quota.php', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    throw new Error('Data kuota tidak tersedia');
                }

                const remaining = Number(data.remaining || 0);
                const total = Number(data.total || 0);
                const booked = Number(data.booked || 0);

                remainingQuota.textContent = remaining;
                totalQuota.textContent = total;
                bookedQuota.textContent = booked;

                quotaStatus.classList.remove('badge-open', 'badge-limited', 'badge-full');

                if (remaining <= 0) {
                    quotaStatus.textContent = 'Penuh';
                    quotaStatus.classList.add('badge-full');
                } else if (remaining <= 50) {
                    quotaStatus.textContent = 'Terbatas';
                    quotaStatus.classList.add('badge-limited');
                } else {
                    quotaStatus.textContent = 'Tersedia';
                    quotaStatus.classList.add('badge-open');
                }
            })
            .catch(() => {
                remainingQuota.textContent = '250';
                totalQuota.textContent = '400';
                bookedQuota.textContent = '150';

                quotaStatus.textContent = 'Demo';
                quotaStatus.classList.remove('badge-open', 'badge-limited', 'badge-full');
                quotaStatus.classList.add('badge-limited');
            });
    }
</script>

</body>
</html>