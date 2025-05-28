<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GulaHub</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-seedling text-green-600 text-2xl mr-2"></i>
                        <span class="text-2xl font-bold text-green-700">GulaHub</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition duration-300">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-20 pb-16 bg-gradient-to-br from-green-50 to-green-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-green-800 mb-6">
                    GulaHub
                </h1>
                <p class="text-xl md:text-2xl text-green-700 mb-8 max-w-3xl mx-auto">
                    Platform Digital untuk Mempermudah Distribusi Tebu dari Petani ke Pabrik Gula
                </p>
                <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto">
                    Menghubungkan petani tebu dengan pabrik gula melalui sistem yang terintegrasi, transparan, dan efisien untuk meningkatkan produktivitas industri gula Indonesia.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                        Daftar sebagai Petani
                    </a>
                    <a href="#" class="bg-white hover:bg-gray-50 text-green-600 border-2 border-green-600 px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                        Daftar sebagai Pabrik
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Overview -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih GulaHub?
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Platform yang dirancang khusus untuk kebutuhan industri gula Indonesia dengan fitur lengkap dan mudah digunakan.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-lg border border-green-100 hover:shadow-lg transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Kolaborasi Mudah</h3>
                    <p class="text-gray-600">Menghubungkan petani dan pabrik secara langsung untuk transaksi yang lebih efisien dan transparan.</p>
                </div>

                <div class="text-center p-6 rounded-lg border border-green-100 hover:shadow-lg transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Dashboard Lengkap</h3>
                    <p class="text-gray-600">Monitoring real-time dengan statistik dan grafik untuk memantau performa dan riwayat transaksi.</p>
                </div>

                <div class="text-center p-6 rounded-lg border border-green-100 hover:shadow-lg transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Sistem Terpercaya</h3>
                    <p class="text-gray-600">Dilengkapi dengan sistem admin untuk verifikasi dan menjaga kualitas pengguna platform.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features for Farmers -->
    <section class="py-16 bg-green-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-6">
                        Fitur untuk Petani
                    </h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Kelola hasil panen tebu Anda dengan mudah dan hubungkan langsung dengan pabrik gula terdekat.
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-calendar-alt text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Manajemen Rencana Panen</h3>
                                <p class="text-gray-600">Input, ubah, dan hapus rencana panen dengan detail jenis tebu, total panen, dan tanggal panen.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-paper-plane text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Permintaan Setor Tebu</h3>
                                <p class="text-gray-600">Terima atau tolak permintaan dari pabrik untuk setor tebu hasil panen Anda.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-clock text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Jadwal Giling & Riwayat</h3>
                                <p class="text-gray-600">Lihat jadwal giling pabrik dan riwayat lengkap setor tebu yang sukses maupun gagal.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <div class="bg-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-tractor text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-center text-gray-900 mb-4">Dashboard Petani</h3>
                    <p class="text-center text-gray-600 mb-6">Pantau statistik panen dan permintaan setor tebu dalam satu dashboard yang komprehensif.</p>
                    {{-- <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Total Panen Bulan Ini</span>
                            <span class="text-sm font-semibold text-green-600">15.5 Ton</span>
                        </div>
                        <div class="w-full bg-green-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 78%"></div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Features for Factory -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="bg-green-50 p-8 rounded-2xl">
                    <div class="bg-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-industry text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-center text-gray-900 mb-4">Dashboard Pabrik</h3>
                    <p class="text-center text-gray-600 mb-6">Kelola kebutuhan tebu dan jadwal giling dengan sistem yang terintegrasi.</p>
                    {{-- <div class="space-y-4">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Kebutuhan Tebu Hari Ini</span>
                                <span class="text-sm font-semibold text-green-600">45 Ton</span>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Petani Terdaftar</span>
                                <span class="text-sm font-semibold text-green-600">127 Petani</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-6">
                        Fitur untuk Pabrik
                    </h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Optimalisasi kebutuhan tebu dengan koneksi langsung ke petani untuk supply chain yang efisien.
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-cogs text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Manajemen Jadwal Giling</h3>
                                <p class="text-gray-600">Atur jadwal giling dengan detail kebutuhan tebu dan tanggal operasional pabrik.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check-circle text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Penerimaan Tebu</h3>
                                <p class="text-gray-600">Terima atau tolak petani yang ingin setor tebu sesuai dengan kapasitas dan kebutuhan pabrik.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-history text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Monitoring & Riwayat</h3>
                                <p class="text-gray-600">Pantau jadwal panen petani dan lihat riwayat penerimaan tebu untuk evaluasi kinerja.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-green-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Bergabunglah dengan GulaHub Sekarang
            </h2>
            <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">
                Mulai digitalisasi distribusi tebu Anda dan tingkatkan efisiensi kerjasama antara petani dan pabrik gula.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-white hover:bg-gray-100 text-green-600 px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                    <i class="fas fa-seedling mr-2"></i>
                    Daftar sebagai Petani
                </a>
                <a href="#" class="bg-green-700 hover:bg-green-800 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                    <i class="fas fa-industry mr-2"></i>
                    Daftar sebagai Pabrik
                </a>
            </div>
        </div>
    </section>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-xl');
            } else {
                navbar.classList.remove('shadow-xl');
            }
        });
    </script>
</body>
</html>
