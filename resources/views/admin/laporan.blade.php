@extends('layouts.adm')

@section('content')
<div class="ml-64 p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="mb-2 bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md">
            <h1 class="text-2xl font-bold text-gray-800">Laporan Rencana dan Persetujuan</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar rencana dan persetujuan antara pabrik dan petani</p>
        </div>

        <div class="mb-6 flex border-b border-gray-200">
            <button id="tabGilingPabrik" class="tab-button active py-2 px-4 font-medium text-sm border-b-2 border-blue-500 text-blue-600 focus:outline-none">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Rencana Giling Pabrik
            </button>
            <button id="tabPanenPetani" class="tab-button py-2 px-4 font-medium text-sm text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Rencana Panen Petani
            </button>
            <button id="tabPersetujuanGiling" class="tab-button py-2 px-4 font-medium text-sm text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Persetujuan Pabrik
            </button>
            <button id="tabPersetujuanPanen" class="tab-button py-2 px-4 font-medium text-sm text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Persetujuan Petani
            </button>
        </div>

        <!-- Tab Contents -->
        <div id="gilingPabrikContent" class="tab-content">
            <div class="mb-12 bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-5 border-b bg-blue-50">
                    <h2 class="text-xl font-semibold text-blue-800 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Rencana Giling yang Dibuat Pabrik
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pabrik Pengaju</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kebutuhan Giling</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($rencanaGilings as $rencana)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $rencana->pabrik->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $rencana->kebutuhan_giling }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $rencana->tanggal }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($rencana->status == 'Disetujui')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">{{ $rencana->status }}</span>
                                    @elseif($rencana->status == 'Ditolak')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">{{ $rencana->status }}</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ $rencana->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-2">Tidak ada data pengajuan giling</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="panenPetaniContent" class="tab-content hidden">
            <div class="mb-12 bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-5 border-b bg-green-50">
                    <h2 class="text-xl font-semibold text-green-800 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Rencana Panen yang Dibuat Petani
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani Pengaju</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Tebu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Panen</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($rencanaPanens as $rencana)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $rencana->petani->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $rencana->jenis_tebu }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $rencana->total_panen }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $rencana->tanggal }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($rencana->status == 'Disetujui')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">{{ $rencana->status }}</span>
                                    @elseif($rencana->status == 'Ditolak')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">{{ $rencana->status }}</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ $rencana->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-2">Tidak ada data pengajuan panen</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="persetujuanGilingContent" class="tab-content hidden">
            <div class="mb-12 bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-5 border-b bg-purple-50">
                    <h2 class="text-xl font-semibold text-purple-800 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Persetujuan Pabrik terhadap Pengajuan Petani
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pabrik</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kebutuhan Giling</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Diajukan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($persetujuanGiling as $persetujuan)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $persetujuan->rencanaGiling->pabrik->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $persetujuan->petani->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $persetujuan->rencanaGiling->kebutuhan_giling }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $persetujuan->tanggal_diajukan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($persetujuan->status == 'Disetujui')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">{{ $persetujuan->status }}</span>
                                    @elseif($persetujuan->status == 'Ditolak')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">{{ $persetujuan->status }}</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ $persetujuan->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $persetujuan->catatan_penolakan ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-2">Tidak ada data persetujuan giling</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="persetujuanPanenContent" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-5 border-b bg-orange-50">
                    <h2 class="text-xl font-semibold text-orange-800 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Persetujuan Petani terhadap Pengajuan Pabrik
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pabrik</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Tebu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Panen</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Diajukan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($persetujuanPanen as $persetujuan)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $persetujuan->rencanaPanen->petani->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $persetujuan->pabrik->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $persetujuan->rencanaPanen->jenis_tebu }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $persetujuan->rencanaPanen->total_panen }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $persetujuan->tanggal_diajukan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($persetujuan->status == 'Disetujui')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">{{ $persetujuan->status }}</span>
                                    @elseif($persetujuan->status == 'Ditolak')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">{{ $persetujuan->status }}</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ $persetujuan->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $persetujuan->catatan_penolakan ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-2">Tidak ada data persetujuan panen</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = {
        'tabGilingPabrik': 'gilingPabrikContent',
        'tabPanenPetani': 'panenPetaniContent',
        'tabPersetujuanGiling': 'persetujuanGilingContent',
        'tabPersetujuanPanen': 'persetujuanPanenContent'
    };

    document.getElementById('gilingPabrikContent').classList.remove('hidden');
    document.getElementById('tabGilingPabrik').classList.add('active', 'border-blue-500', 'text-blue-600');

    Object.keys(tabs).forEach(tabId => {
        const tab = document.getElementById(tabId);
        tab.addEventListener('click', function() {
            Object.keys(tabs).forEach(key => {
                document.getElementById(key).classList.remove('active', 'border-blue-500', 'text-blue-600');
                document.getElementById(key).classList.add('text-gray-500');
                document.getElementById(tabs[key]).classList.add('hidden');
            });

            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            this.classList.remove('text-gray-500');
            document.getElementById(tabs[tabId]).classList.remove('hidden');
        });
    });
});
</script>

<style>
.tab-button {
    transition: all 0.3s ease;
    position: relative;
    bottom: -1px;
}

.tab-button.active {
    border-bottom-width: 2px;
    border-bottom-style: solid;
}

.tab-content {
    transition: opacity 0.3s ease;
}
</style>
@endsection
