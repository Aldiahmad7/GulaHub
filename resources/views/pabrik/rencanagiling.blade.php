@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-20">
    <h3 class="text-xl font-semibold mb-4">Rencana Giling: {{ $tahunDipilih }}</h3>

    <!-- Filter Tahun -->
    <form method="GET" action="{{ route('pabrik.rencanagiling') }}" class="mb-4">
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
        <button type="button" class="w-full px-4 py-2 text-left font-semibold bg-gray-200" onclick="toggleCollapse('collapse{{ $i }}')">
            {{ $bulan }}
        </button>
        <div id="collapse{{ $i }}" class="p-4 hidden">
            @if (isset($dataPerBulan[$bulan]) && count($dataPerBulan[$bulan]) > 0)
                @foreach ($dataPerBulan[$bulan] as $item)
                <div class="bg-gray-100 border p-3 rounded mb-3 flex justify-between items-center cursor-pointer" onclick="document.getElementById('modalEdit{{ $item->id }}').showModal()">
                    <div>
                        <span class="font-medium">Tanggal {{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                    </div>
                    <span class="text-sm bg-gray-400 text-white px-2 py-1 rounded">{{ $item->status }}</span>
                </div>

                <!-- Modal Edit -->
                <dialog id="modalEdit{{ $item->id }}" class="rounded-lg w-full max-w-md">
                    <form method="POST" action="{{ route('pabrik.rencanagilingupdate', $item->id) }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <h3 class="text-lg font-semibold">Edit Data Giling</h3>
                        <div>
                            <label class="block text-sm font-medium">Kebutuhan Giling</label>
                            <input type="text" name="kebutuhan_giling" value="{{ $item->kebutuhan_giling }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="flex justify-between pt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </form>
                    <form method="POST" action="{{ route('pabrik.rencanagilingdestroy', $item->id) }}" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                    </form>
                        </div>
                </dialog>
                @endforeach
            @else
                <p class="text-gray-500">Belum ada data</p>
            @endif

            <!-- Tombol Tambah -->
            <button onclick="document.getElementById('modalTambah').showModal()" class="w-full border-2 border-dashed border-gray-400 text-center py-2 mt-2 rounded text-gray-700 hover:bg-gray-100">
                <strong>+</strong> Tambah
            </button>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal Tambah -->
<dialog id="modalTambah" class="rounded-lg w-full max-w-md">
    <form method="POST" action="{{ route('pabrik.rencanagilingstore') }}" class="space-y-4">
        @csrf
        <h3 class="text-lg font-semibold">Tambah Rencana Giling</h3>
        <div>
            <label class="block text-sm font-medium">Kebutuhan Hiling</label>
            <input type="text" name="kebutuhan_giling" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium">Tanggal</label>
            <input type="date" name="tanggal" required class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex justify-end gap-2 pt-4">
            <button type="button" onclick="document.getElementById('modalTambah').close()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-sm rounded">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded">Simpan</button>
        </div>
    </form>
</dialog>

<script>
    function toggleCollapse(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
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
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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
