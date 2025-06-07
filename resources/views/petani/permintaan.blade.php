@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all duration-300 hover:shadow-md">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Permintaan dari Pabrik</h2>
                    <p class="text-sm text-gray-500 mt-1">Daftar permintaan jadwal panen dari pabrik</p>
                </div>
            </div>
        </div>

        @forelse ($rencanaDenganPengajuan as $rencana)
            <div class="bg-white rounded-xl shadow-sm mb-8 overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-md">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Rencana Giling</h3>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($rencana->tanggal)->translatedFormat('d F Y') }}
                                    <span class="ml-2 text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">
                                        {{ count($rencana->pengaju) }} Pengaju
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($rencana->pengaju as $pabrik)
                            <div class="bg-gray-50 rounded-lg p-5 border border-gray-200 transition-all duration-300 hover:shadow-sm">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl flex items-center justify-center text-white font-medium">
                                            {{ substr($pabrik->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="text-gray-900 font-medium">{{ $pabrik->name }}</h4>
                                            <div class="flex items-center space-x-2 mt-1">
                                                <span class="text-xs text-gray-500">Status:</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @if($pabrik->pivot->status == 'Disetujui')
                                                        bg-green-100 text-green-800
                                                    @elseif($pabrik->pivot->status == 'Ditolak')
                                                        bg-red-100 text-red-800
                                                    @else
                                                        bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    @if($pabrik->pivot->status == 'Disetujui')
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @elseif($pabrik->pivot->status == 'Ditolak')
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                    {{ $pabrik->pivot->status }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('petani.konfirmasi', [$rencana->id, $pabrik->id]) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="Disetujui">
                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Setujui
                                            </button>
                                        </form>

                                        <button type="button"
                                            onclick="openTolakModal({{ $rencana->id }}, {{ $pabrik->id }})"
                                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tolak
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 opacity-0 animate-fadeIn">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-md mx-auto transition-all duration-300 hover:shadow-md">
                    <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1 transition-all duration-300">Belum Ada Permintaan</h3>
                    <p class="text-gray-500 text-sm transition-all duration-300">Belum ada permintaan dari pabrik saat ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Tolak -->
<div id="tolakModal" class="fixed z-50 inset-0 overflow-y-auto hidden bg-black bg-opacity-40">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Catatan Penolakan</h3>
            <form id="formTolak" method="POST">
                @csrf
                <input type="hidden" name="status" value="Ditolak">
                <textarea name="catatan_penolakan" rows="4" required class="w-full border border-gray-300 rounded-md p-2 mb-4" placeholder="Tulis alasan penolakan..."></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeTolakModal()" class="px-4 py-2 bg-gray-200 rounded-md">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openTolakModal(rencanaId, pabrikId) {
    const form = document.getElementById('formTolak');
    form.action = `/petani/konfirmasi/${rencanaId}/${pabrikId}`;
    document.getElementById('tolakModal').classList.remove('hidden');
}

function closeTolakModal() {
    document.getElementById('tolakModal').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
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

.animate-fadeIn {
    animation: fadeIn 0.5s ease forwards;
}
</style>
@endsection
