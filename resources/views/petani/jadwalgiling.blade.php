@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 bg-white rounded-xl shadow-sm p-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="md:w-1/3">
                    <h2 class="text-2xl font-bold text-gray-800">Jadwal Giling Pabrik</h2>
                    <p class="text-sm text-gray-500 mt-1">Pilih pabrik untuk melihat jadwal giling</p>
                </div>
                <div class="md:w-2/3">
                    <div class="relative max-w-md ml-auto">
                        <input type="text" id="searchPabrik" placeholder="Cari nama pabrik..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5" id="pabrikGrid">
            @foreach($pabriks as $pabrik)
            <a href="{{ route('petani.rencanagiling', $pabrik->id) }}"
               class="block group transform transition-all duration-300 hover:-translate-y-1 opacity-0 animate-fadeIn"
               style="animation-delay: {{ $loop->index * 0.1 }}s">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 h-full hover:shadow-md transition-all duration-300">

                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-3 text-green-600 transition-all duration-300 group-hover:bg-green-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-800 truncate transition-colors duration-300 group-hover:text-green-700">
                                {{ $pabrik->name }}
                            </h3>
                            <p class="text-sm text-gray-500 truncate">
                                <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ Str::limit($pabrik->alamat, 25) }}
                            </p>
                        </div>
                    </div>

                    @php
                        $currentYear = now()->year;
                        $gilingSchedules = $pabrik->rencanaGiling()
                            ->whereYear('tanggal', $currentYear)
                            ->orderBy('tanggal')
                            ->get()
                            ->groupBy(function($date) {
                                return \Carbon\Carbon::parse($date->tanggal)->format('F');
                            });
                        $totalSchedules = $gilingSchedules->flatten()->count();
                    @endphp

                    <div class="mb-3">
                        @if($totalSchedules > 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 transition-all duration-300 group-hover:bg-green-200">
                                Aktif ({{ $totalSchedules }} jadwal)
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 transition-all duration-300 group-hover:bg-gray-200">
                                Belum ada jadwal
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        @if($totalSchedules > 0)
                            <div class="bg-gray-50 p-2 rounded-lg transition-all duration-300 group-hover:bg-gray-100">
                                <p class="text-xs font-medium text-gray-600 mb-1">Jadwal per Bulan:</p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($gilingSchedules as $month => $schedules)
                                        <span class="text-xs bg-white px-2 py-0.5 rounded-md text-gray-600 border border-gray-200 transition-all duration-300 group-hover:border-gray-300">
                                            {{ substr($month, 0, 3) }} ({{ $schedules->count() }})
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4 bg-gray-50 rounded-lg transition-all duration-300 group-hover:bg-gray-100">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2 transition-all duration-300 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-xs text-gray-500 transition-all duration-300 group-hover:text-gray-600">Belum ada jadwal giling</p>
                            </div>
                        @endif
                    </div>

                    <div class="pt-3 border-t border-gray-100 text-center">
                        <span class="inline-flex items-center text-sm text-green-600 font-medium transition-all duration-300 group-hover:text-green-700">
                            Lihat jadwal
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        @if($pabriks->isEmpty())
        <div class="text-center py-12 opacity-0 animate-fadeIn">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-md mx-auto transition-all duration-300 hover:shadow-md">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-800 mb-1 transition-all duration-300">Belum Ada Pabrik</h3>
                <p class="text-gray-500 text-sm transition-all duration-300">Tidak ada data pabrik yang tersedia saat ini.</p>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchPabrik');
    const pabrikCards = document.querySelectorAll('#pabrikGrid > a');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let visibleCount = 0;

        pabrikCards.forEach((card, index) => {
            const pabrikName = card.querySelector('h3').textContent.toLowerCase();
            const pabrikAddress = card.querySelector('p').textContent.toLowerCase();
            const isVisible = pabrikName.includes(searchTerm) || pabrikAddress.includes(searchTerm);

            if (isVisible) {
                visibleCount++;
                card.style.display = 'block';
                card.style.animation = `fadeIn 0.3s ease ${index * 0.05}s forwards`;
            } else {
                card.style.animation = 'fadeOut 0.3s ease forwards';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });

        const emptyState = document.querySelector('.text-center.py-12');
        if (emptyState) {
            if (visibleCount === 0 && searchTerm !== '') {
                emptyState.querySelector('h3').textContent = 'Pabrik tidak ditemukan';
                emptyState.querySelector('p').textContent = 'Tidak ada pabrik yang sesuai dengan pencarian Anda';
                emptyState.style.display = 'block';
                emptyState.style.animation = 'fadeIn 0.3s ease forwards';
            } else {
                emptyState.style.display = 'none';
            }
        }
    });

    setTimeout(() => {
        document.querySelectorAll('.animate-fadeIn').forEach(el => {
            el.style.opacity = '1';
        });
    }, 100);
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(10px); }
}

.animate-fadeIn {
    animation: fadeIn 0.5s ease forwards;
}

.transition-all {
    transition-property: all;
}

.group:hover .transition-transform {
    transform: translateY(-1.5px);
}
</style>
@endsection
