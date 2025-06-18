@extends('layouts.app')

@section('content')
    <section class="pt-20 pb-16 bg-gradient-to-br from-green-50 to-green-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-green-600 mb-6">
                    GulaHub
                </h1>
                <p class="text-xl md:text-2xl text-green-700 mb-8 max-w-3xl mx-auto">
                    Platform Digital untuk Mempermudah Distribusi antara Petani Tebu dan Pabrik Gula
                </p>
                <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto">
                    Menghubungkan petani tebu dengan pabrik gula melalui sistem yang terintegrasi, transparan, dan efisien untuk meningkatkan produktivitas industri gula Indonesia.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('registerPetani') }}" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                        Daftar sebagai Petani
                    </a>
                    <a href="{{ route('registerPabrik') }}" class="bg-white hover:bg-gray-50 text-green-600 border-2 border-green-600 px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                        Daftar sebagai Pabrik
                    </a>
                </div>
            </div>
        </div>
    </section>

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
                    <p class="text-gray-600">Nikmati proses kerja sama antara petani dan pabrik dengan sistem yang terhubung langsung, tanpa perantara dan tanpa ribet.</p>
                </div>

                <div class="text-center p-6 rounded-lg border border-green-100 hover:shadow-lg transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Dashboard Lengkap</h3>
                    <p class="text-gray-600">Pantau semua aktivitas, data pengajuan, dan riwayat kerja sama dalam satu tampilan yang mudah dipahami dan selalu up-to-date</p>
                </div>

                <div class="text-center p-6 rounded-lg border border-green-100 hover:shadow-lg transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Sistem Terpercaya</h3>
                    <p class="text-gray-600">Keamanan data dan transparansi informasi menjadi prioritas kami, agar seluruh proses berjalan adil dan sesuai kesepakatan.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-green-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Bergabunglah dengan GulaHub Sekarang
            </h2>
            <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">
                Mulai digitalisasi distribusi tebu Anda dan tingkatkan efisiensi kerjasama antara petani dan pabrik gula.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('registerPetani') }}" class="bg-white hover:bg-gray-100 text-green-600 px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                    <i class="fas fa-seedling mr-2"></i>
                    Daftar sebagai Petani
                </a>
                <a href="{{ route('registerPabrik') }}" class="bg-green-700 hover:bg-green-800 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                    <i class="fas fa-industry mr-2"></i>
                    Daftar sebagai Pabrik
                </a>
            </div>
        </div>
    </section>
@endsection
