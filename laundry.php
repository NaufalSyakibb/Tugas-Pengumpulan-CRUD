<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budi Bengkel Maintenance</title>
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header & Navigasi -->
    <header class="container">
        <div class="nav-card">
            <!-- Baris Atas Header -->
            <div class="nav-top">
                <!-- Logo & Brand Name -->
                <a href="#" class="brand-logo">
                    <div class="logo-bars">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar bar-rotated"></span>
                    </div>
                    <span class="brand-title">
                        Budi Bengkel <span>| Maintenance</span>
                    </span>
                </a>

                <!-- Tombol Aksi Utama -->
                <button onclick="tambahMitra()" class="btn-primary">
                    <i class="fa-solid fa-plus"></i> Tambah Mitra
                </button>
            </div>

            <!-- Baris Menu Navigasi -->
            <nav class="nav-menu">
                <a href="#dashboard" class="nav-link active">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
                <a href="#mitra" class="nav-link">
                    <i class="fa-solid fa-handshake"></i> Mitra Perawatan
                </a>
                <a href="#lokasi" class="nav-link">
                    <i class="fa-solid fa-location-dot"></i> Lokasi Mitra
                </a>
                <a href="#layanan" class="nav-link">
                    <i class="fa-solid fa-list-check"></i> Jenis Layanan
                </a>
            </nav>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="container">
        
        <!-- Tagline / Headline -->
        <div>
            <div class="badge-wrapper">
                <span class="badge">
                    <span class="dot"></span>
                    Sistem Pengelolaan Mitra Bengkel
                </span>
            </div>
            <h1 class="hero-title">
                Budi Maintenance.
            </h1>
            <p class="hero-desc">
                Pengelolaan data bengkel langganan mitra perawatan, lokasi cabang, kontak penanggung jawab, dan pemantauan jenis layanan secara terpusat.
            </p>
        </div>

        <!-- Cards Statistik -->
        <section class="stats-grid">
            <!-- Card 1 -->
            <div class="stat-card">
                <div>
                    <p class="stat-label">Total Mitra Aktif</p>
                    <p class="stat-value" id="mitra-count">0</p>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-building-user"></i>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="stat-card">
                <div>
                    <p class="stat-label">Cabang & Lokasi</p>
                    <p class="stat-value" id="lokasi-count">0 Kota</p>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="stat-card">
                <div>
                    <p class="stat-label">Jenis Layanan</p>
                    <p class="stat-value" id="layanan-count">0 Paket</p>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-gears"></i>
                </div>
            </div>
        </section>

        <!-- Tabel Data Mitra -->
        <section class="table-card">
            <div class="table-header">
                <div>
                    <h2 class="table-title">Daftar Mitra Perawatan Bengkel</h2>
                    <p class="table-subtitle">Menampilkan data jaringan mitra perbaikan dan perawatan kendaraan.</p>
                </div>
                <button onclick="syncData()" class="btn-secondary">
                    <i class="fa-solid fa-rotate-right"></i> Refresh Data
                </button>
            </div>

            <!-- Container Tabel Responsive -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kota</th>
                            <th>Nama Mitra</th>
                            <th>Alamat</th>
                            <th>Layanan Utama</th>
                            <th>Kontak</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="mitra-table-body">
                        <!-- Data dirender oleh script.js -->
                    </tbody>
                </table>
            </div>
        </section>


        <?php
include 'koneksi.php';

// Proses Create (Simpan Data)
if (isset($_POST['submit_booking'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
    $telepon  = mysqli_real_escape_string($conn, $_POST['telepon']);
    $cabang   = mysqli_real_escape_string($conn, $_POST['cabang']);
    $layanan  = mysqli_real_escape_string($conn, $_POST['layanan']);
    $tanggal  = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $waktu    = mysqli_real_escape_string($conn, $_POST['waktu']);
    $catatan  = mysqli_real_escape_string($conn, $_POST['catatan']);

    $query = "INSERT INTO bookings (nama_pelanggan, telepon, cabang, layanan, tanggal, waktu, catatan) 
              VALUES ('$nama', '$telepon', '$cabang', '$layanan', '$tanggal', '$waktu', '$catatan')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Booking berhasil dikonfirmasi!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan booking!');</script>";
    }
}
?>


        <!-- Section Form Booking Maintenance -->
        <section class="booking-card" id="booking">
            <div class="booking-header">
                <span class="badge">
                    <span class="dot"></span>
                    Reservasi Layanan
                </span>
                <h2 class="table-title" style="margin-top: 0.5rem;">Form Booking Maintenance</h2>
                <p class="table-subtitle">Pilih cabang bengkel mitra terdekat dan tentukan jadwal perawatan kendaraan Anda.</p>
            </div>

            <form id="booking-form" onsubmit="handleBooking(event)" class="booking-form">
                <div class="form-grid">
                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama_pelanggan" class="form-label">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" id="nama_pelanggan" name="nama_pelanggan" placeholder="Contoh: Ahmad Subagja" required class="form-input">
                    </div>

                    <!-- Nomor Telepon / WhatsApp -->
                    <div class="form-group">
                        <label for="telepon" class="form-label">Nomor WhatsApp <span class="required">*</span></label>
                        <input type="tel" id="telepon" name="telepon" placeholder="Contoh: 081234567890" required class="form-input">
                    </div>

                    <!-- Pilih Cabang/Lokasi -->
                    <div class="form-group">
                        <label for="cabang" class="form-label">Pilih Cabang Bengkel <span class="required">*</span></label>
                        <select id="cabang" name="cabang" required class="form-select">
                            <option value="" disabled selected>-- Pilih Lokasi Cabang --</option>
                            <option value="jakarta-selatan">Budi Bengkel - Jakarta Selatan (Fatmawati)</option>
                            <option value="jakarta-barat">Budi Bengkel - Jakarta Barat (Kebon Jeruk)</option>
                            <option value="bandung-kota">Budi Bengkel - Bandung (Soekarno Hatta)</option>
                            <option value="surabaya-timur">Budi Bengkel - Surabaya (Gubeng)</option>
                            <option value="medan-kota">Budi Bengkel - Medan (Gatot Subroto)</option>
                        </select>
                    </div>

                    <!-- Pilih Jenis Layanan -->
                    <div class="form-group">
                        <label for="layanan" class="form-label">Jenis Layanan <span class="required">*</span></label>
                        <select id="layanan" name="layanan" required class="form-select">
                            <option value="" disabled selected>-- Pilih Paket Layanan --</option>
                            <option value="servis-rutin">Servis Rutin / Ganti Oli</option>
                            <option value="tune-up">Tune Up & Diagnostic Engine</option>
                            <option value="sporing-balancing">Spooring & Balancing Velg</option>
                            <option value="servis-ac">Perawatan & Clean AC</option>
                            <option value="overhaul">General Overhaul / Perbaikan Berat</option>
                        </select>
                    </div>

                    <!-- Tanggal Booking -->
                    <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal Kedatangan <span class="required">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" required class="form-input">
                    </div>

                    <!-- Waktu / Jam Booking -->
                    <div class="form-group">
                        <label for="waktu" class="form-label">Jam Kedatangan <span class="required">*</span></label>
                        <select id="waktu" name="waktu" required class="form-select">
                            <option value="" disabled selected>-- Pilih Jam --</option>
                            <option value="08:00">08:00 WIB</option>
                            <option value="10:00">10:00 WIB</option>
                            <option value="13:00">13:00 WIB</option>
                            <option value="15:00">15:00 WIB</option>
                        </select>
                    </div>
                </div>

                <!-- Catatan / Kendala Kendaraan -->
                <div class="form-group" style="margin-top: 1rem;">
                    <label for="catatan" class="form-label">Detail Kendaraan / Catatan Keluhan</label>
                    <textarea id="catatan" name="catatan" rows="3" placeholder="Contoh: Toyota Avanza 2020 (B 1234 ABC) - Mesin agak bergetar saat idle..." class="form-textarea"></textarea>
                </div>

                <!-- Button Submit -->
                <div class="form-actions">
                    <button type="submit" class="btn-primary btn-submit">
                        <i class="fa-solid fa-calendar-check"></i> Konfirmasi Booking
                    </button>
                </div>
            </form>
        </section>
        <!-- Section Tim / Penanggung Jawab -->
        <section class="team-section">
            <h2 class="section-title">Tim Penanggung Jawab Wilayah</h2>
            <div class="team-grid">
                <!-- Person 1 -->
                <div class="team-card">
                    <div class="portrait-wrapper">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=600" alt="Kepala Area DKI" class="portrait-bw" />
                    </div>
                    <h3 class="team-name">Budi Santoso</h3>
                    <p class="team-role">Head of Operations</p>
                </div>
                <!-- Person 2 -->
                <div class="team-card">
                    <div class="portrait-wrapper">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=600" alt="Supervisor Bandung" class="portrait-bw" />
                    </div>
                    <h3 class="team-name">Erik Pratama</h3>
                    <p class="team-role">Area Manager Jawa Barat</p>
                </div>
                <!-- Person 3 -->
                <div class="team-card">
                    <div class="portrait-wrapper">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=600" alt="Supervisor Surabaya" class="portrait-bw" />
                    </div>
                    <h3 class="team-name">Gagan Hidayat</h3>
                    <p class="team-role">Area Manager Jawa Timur</p>
                </div>
                <!-- Person 4 -->
                <div class="team-card">
                    <div class="portrait-wrapper">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=600" alt="Coordinator" class="portrait-bw" />
                    </div>
                    <h3 class="team-name">Siti Rahma</h3>
                    <p class="team-role">Mitra Relations Lead</p>
                </div>
            </div>
        </section>
    </main>

    

    <!-- Footer -->
    <footer class="container">
        <p>© <span id="year"></span> Budi Bengkel Maintenance System. All rights reserved.</p>
        <div class="footer-links">
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Syarat & Ketentuan</a>
            <a href="#">Pusat Bantuan</a>
        </div>
    </footer>

    <!-- Script JavaScript Client-Side -->
    <script src="script.js"></script>
</body>
</html>