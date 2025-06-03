@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-20">
    <h3 class="text-xl font-semibold mb-4">Rencana Panen - {{ $petani->name }} ({{ $tahunDipilih }})</h3>

    <!-- Filter Tahun -->
    <form method="GET" action="{{ route('pabrik.rencanapanen', $petani->id) }}" class="mb-4">
        <select class="border rounded px-3 py-2" name="tahun" onchange="this.form.submit()">
            @for ($year = now()->year; $year <= now()->year + 5; $year++)
                <option value="{{ $year }}" {{ $year == $tahunDipilih ? 'selected' : '' }}>{{ $year }}</option>
            @endfor
        </select>
    </form>

    <!-- Accordion per Bulan -->
    @php
        $bulanList = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
    @endphp

    @foreach ($bulanList as $i => $bulan)
    <div class="border rounded mb-4">
        <button type="button" class="w-full px-4 py-2 text-left font-semibold bg-gray-100 hover:bg-gray-200 transition"
            onclick="toggleCollapse('collapse{{ $i }}')">
            {{ $bulan }}
        </button>
        <div id="collapse{{ $i }}" class="p-4 hidden">
            @if (isset($dataPerBulan[$bulan]) && count($dataPerBulan[$bulan]) > 0)
                @foreach ($dataPerBulan[$bulan] as $item)
                <!-- Item -->
                <button onclick="document.getElementById('modalDetail{{ $item->id }}').showModal()" class="w-full text-left">
                    <div class="border p-3 mb-2 rounded bg-gray-50 hover:bg-gray-100 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 10V5h2v5H9zm0 2h2v2H9v-2z" />
                            </svg>
                            <span>Tanggal {{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                        </div>
                        <span class="bg-gray-400 text-white px-2 py-1 rounded text-sm">{{ $item->status }}</span>
                    </div>
                </button>

                <!-- Modal Detail -->
                <dialog id="modalDetail{{ $item->id }}" class="rounded-lg p-6 w-full max-w-md backdrop:bg-black/50">
                    <div class="bg-white rounded shadow p-4">
                        <h3 class="text-lg font-semibold mb-4">Detail Rencana Panen</h3>
                        <p><strong>Jenis Tebu:</strong> {{ $item->jenis_tebu }}</p>
                        <p><strong>Total Panen:</strong> {{ $item->total_panen }} Ton</p>
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>

                        <form method="POST" action="{{ route('pabrik.ajukan', $item->id) }}" class="mt-6 text-center">
                            @csrf
                            <input type="hidden" name="tanggal" value="{{ $item->tanggal }}">
                            <input type="hidden" name="petani_id" value="{{ $petani->id }}">
                            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Ajukan ke Petani</button>
                        </form>

                        <div class="mt-4 text-center">
                            <button onclick="document.getElementById('modalDetail{{ $item->id }}').close()" class="mt-2 text-gray-600 underline">Tutup</button>
                        </div>
                    </div>
                </dialog>
                @endforeach
            @else
                <p class="text-gray-500">Belum ada data</p>
            @endif
        </div>
    </div>
    @endforeach
</div>

<script>
    function toggleCollapse(id) {
        const el = document.getElementById(id);
        el.classList.toggle('hidden');
    }
</script>
<style>
dialog {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border: none;
  padding: 1.5rem;
  background-color: white;
  border-radius: 0.5rem;
  max-width: 90vw;
  width: 400px;
  z-index: 1000;
}
dialog::backdrop {
  background: rgba(0,0,0,0.4);
}
</style>
@endsection
