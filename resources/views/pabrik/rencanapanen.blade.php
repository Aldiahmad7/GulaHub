@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 bg-white rounded-xl shadow-sm p-6 transition-all duration-300 hover:shadow-md">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Rencana Panen</h1>
                    <div class="flex items-center mt-2">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3 text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $petani->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $petani->alamat }}</p>
                        </div>
                    </div>
                </div>

                <form method="GET" action="{{ route('pabrik.rencanapanen', $petani->id) }}" class="flex items-center">
                    <label for="tahun" class="mr-2 text-sm font-medium text-gray-700">Tahun:</label>
                    <div class="relative">
                        <select id="tahun" name="tahun" onchange="this.form.submit()"
                                class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300">
                            @for ($year = now()->year; $year <= now()->year + 5; $year++)
                                <option value="{{ $year }}" {{ $year == $tahunDipilih ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @php
                $bulanList = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
            @endphp

            @foreach ($bulanList as $i => $bulan)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="p-4 border-b">
                    <h3 class="font-semibold text-lg text-gray-800 flex justify-between items-center">
                        {{ $bulan }}
                        @if(isset($dataPerBulan[$bulan]))
                            <span class="text-sm font-normal bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                {{ count($dataPerBulan[$bulan]) }} jadwal
                            </span>
                        @endif
                    </h3>
                </div>

                <div class="p-4">
                    @if (isset($dataPerBulan[$bulan]) && count($dataPerBulan[$bulan]) > 0)
                        <div class="space-y-2">
                            @foreach ($dataPerBulan[$bulan] as $item)
                            <div class="grid grid-cols-12 gap-2 items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="col-span-2 text-center">
                                    <div class="bg-blue-50 text-blue-600 rounded-lg py-1 text-sm font-medium">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <p class="text-sm font-medium text-gray-800">{{ $item->jenis_tebu }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->total_panen }} Ton</p>
                                </div>
                                <div class="col-span-4 text-right">
                                    @if($item->status == 'Disetujui')
                                        <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">{{ $item->status }}</span>
                                    @elseif($item->status == 'Menunggu')
                                        <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ $item->status }}</span>
                                    @else
                                        <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-800">{{ $item->status }}</span>
                                    @endif
                                </div>
                                <div class="col-span-12 mt-2">
                                    <button onclick="openModal('modal-{{ $item->id }}')"
                                            class="w-full py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded transition-colors">
                                        Detail & Aksi
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Belum ada jadwal panen</p>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modals -->
@foreach ($dataPerBulan as $bulan => $items)
    @foreach ($items as $item)
    <div id="modal-{{ $item->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="closeModal('modal-{{ $item->id }}')">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Rencana Panen</h3>
                            <div class="mt-4 space-y-3">
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-sm font-medium text-gray-500">Tanggal</span>
                                    <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-sm font-medium text-gray-500">Jenis Tebu</span>
                                    <span class="text-sm text-gray-900">{{ $item->jenis_tebu }}</span>
                                </div>
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-sm font-medium text-gray-500">Estimasi Panen</span>
                                    <span class="text-sm text-gray-900">{{ $item->total_panen }} Ton</span>
                                </div>
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-sm font-medium text-gray-500">Status</span>
                                    @if($item->status == 'Disetujui')
                                        <span class="text-sm text-green-600">{{ $item->status }}</span>
                                    @elseif($item->status == 'Menunggu')
                                        <span class="text-sm text-yellow-600">{{ $item->status }}</span>
                                    @else
                                        <span class="text-sm text-gray-600">{{ $item->status }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form method="POST" action="{{ route('pabrik.ajukan', $item->id) }}" class="w-full">
                        @csrf
                        <input type="hidden" name="tanggal" id="modalTanggalInput">
                        <input type="hidden" name="petani_id" value="{{ $petani->id }}">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-300">
                            Ajukan ke Petani
                        </button>
                    </form>
                    <button type="button" onclick="closeModal('modal-{{ $item->id }}')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-300">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endforeach

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
            const modals = document.querySelectorAll('.fixed.inset-0.z-50');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });
        }
    }
</script>
@endsection
