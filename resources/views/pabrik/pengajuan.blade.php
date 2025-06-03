@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-16 max-w-5xl">
    <h2 class="text-3xl font-semibold mb-4 mt-6 text-center text-gray-800">Ajuan Saya ke Petani</h2>

    <!-- Filter Tahun -->
    <form method="GET" action="{{ route('pabrik.ajuan') }}" class="mb-6">
        <select name="tahun" id="tahun" onchange="this.form.submit()"
            class="border rounded px-3 py-2 shadow-sm px-4 py-2 focus:ring focus:ring-blue-200">
            <option value="">Semua Tahun</option>
            @foreach (range(date('Y'), 2024) as $year)
                <option value="{{ $year }}" {{ (request('tahun') == $year) ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
    </form>

    @if($ajuanSaya->isEmpty())
        <div class="text-center text-gray-500 italic">
            Belum ada ajuan yang dikirim.
        </div>
    @else
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-gray-700 font-medium border-b">Nama Petani</th>
                        <th class="py-3 px-6 text-left text-gray-700 font-medium border-b">Tanggal Rencana</th>
                        <th class="py-3 px-6 text-center text-gray-700 font-medium border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ajuanSaya as $ajuan)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 border-b border-gray-200">{{ $ajuan->nama_petani }}</td>
                            <td class="py-4 px-6 border-b border-gray-200">
                                {{ \Carbon\Carbon::parse($ajuan->tanggal_rencana)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-center border-b border-gray-200">
                                @if($ajuan->status === 'Disetujui')
                                    <span class="inline-block px-3 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">
                                        {{ $ajuan->status }}
                                    </span>
                                @elseif($ajuan->status === 'Ditolak')
                                    <span class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">
                                        {{ $ajuan->status }}
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 text-sm font-semibold text-gray-800 bg-gray-200 rounded-full">
                                        {{ $ajuan->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
