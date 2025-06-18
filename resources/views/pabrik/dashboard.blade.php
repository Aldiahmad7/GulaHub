@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8 bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center">
                    <div class="bg-indigo-100 p-3 rounded-xl mr-4 transition-all duration-300 hover:bg-indigo-200">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Dashboard Pabrik</h1>
                        <p class="text-gray-600 mt-1">Selamat datang, {{ $pabrik->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
            <!-- Total Rencana Giling -->
            <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-3 rounded-xl mr-4 transition-all duration-300 hover:bg-purple-200">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Rencana Giling</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalRencanaGiling }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Rencana Giling -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6 transition-all duration-300 hover:shadow-md">
            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Rencana Giling Terbaru</h2>
                        <p class="text-sm text-gray-500 mt-1">Daftar rencana giling yang telah diajukan</p>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                    </svg>
                                    Kebutuhan Giling (Ton)
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Tanggal
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Status
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($rencanaGilingTerbaru as $giling)
                        <tr class="hover:bg-gray-50 transition-all duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-2 h-8 bg-gradient-to-b from-purple-400 to-purple-600 rounded-full mr-3 opacity-60 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">{{ $giling->kebutuhan_giling }}</span>
                                        <span class="text-xs text-gray-500 ml-1">ton</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($giling->tanggal)->translatedFormat('d F Y') }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($giling->tanggal)->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full transition-all duration-200
                                    @if($giling->status == 'Disetujui')
                                        bg-green-100 text-green-800 border border-green-200 hover:bg-green-200
                                    @elseif($giling->status == 'Ditolak')
                                        bg-red-100 text-red-800 border border-red-200 hover:bg-red-200
                                    @else
                                        bg-yellow-100 text-yellow-800 border border-yellow-200 hover:bg-yellow-200
                                    @endif">
                                    @if($giling->status == 'Disetujui')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($giling->status == 'Ditolak')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    {{ $giling->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
