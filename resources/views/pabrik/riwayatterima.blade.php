@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-16 max-w-6xl">
    <h3 class="text-3xl font-semibold mb-8 mt-6 text-center text-gray-800">Riwayat Permintaan Petani</h3>

    <!-- Filter Tahun -->
    <form method="GET" action="{{ route('pabrik.riwayatterima') }}" class="mb-6 flex mt-6 items-center space-x-4">
        <select name="tahun" id="tahun" onchange="this.form.submit()"
            class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Tahun</option>
            @foreach (range(date('Y'), 2024) as $year)
                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Tabel Riwayat -->
    <div class="overflow-x-auto shadow-lg rounded-lg">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-6 text-left text-gray-700 font-medium border-b border-gray-300">Nama Petani</th>
                    <th class="py-3 px-6 text-left text-gray-700 font-medium border-b border-gray-300">Tanggal Rencana</th>
                    <th class="py-3 px-6 text-center text-gray-700 font-medium border-b border-gray-300">Status</th>
                    <th class="py-3 px-6 text-left text-gray-700 font-medium border-b border-gray-300">Tanggal Diajukan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 border-b border-gray-200">{{ $item->nama_petani }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">
                            {{ \Carbon\Carbon::parse($item->tanggal_rencana)->translatedFormat('d F Y') }}
                        </td>
                        <td class="py-4 px-6 border-b border-gray-200 text-center">
                            @if($item->status === 'Disetujui')
                                <span class="inline-block px-3 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">
                                    {{ $item->status }}
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">
                                    {{ $item->status }}
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 border-b border-gray-200">
                            {{ \Carbon\Carbon::parse($item->tanggal_diajukan)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500 italic">Tidak ada riwayat ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
