@extends('layouts.adm')

@section('content')
<div class="ml-64 p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-sm text-gray-500 mt-1">Selamat datang di panel administrasi</p>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Pengguna -->
            <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:scale-105">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Pabrik -->
            <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:scale-105">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500">Akun Pabrik</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $pabrikCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Petani -->
            <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:scale-105">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500">Akun Petani</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $petaniCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Pengajuan -->
            <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:scale-105">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500">Total Pengajuan</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalPengajuan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Aktivitas Terbaru</h2>
                    <p class="text-gray-600 mt-1">Pantau aktivitas sistem terkini</p>
                </div>
                <div class="text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="space-y-4">
                @forelse ($recentPengajuan->take(5) as $pengajuan)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $pengajuan->jenis }}</p>
                            <p class="text-xs text-gray-500">oleh {{ $pengajuan->pengaju }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if($pengajuan->status == 'Disetujui')
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                {{ $pengajuan->status }}
                            </span>
                        @elseif($pengajuan->status == 'Ditolak')
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                {{ $pengajuan->status }}
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                {{ $pengajuan->status }}
                            </span>
                        @endif
                        <span class="text-xs text-gray-400 ml-3">{{ $pengajuan->tanggal }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500">Belum ada aktivitas terbaru</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
