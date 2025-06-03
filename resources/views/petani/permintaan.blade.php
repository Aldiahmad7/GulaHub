@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-20 max-w-3xl">
    <h3 class="text-2xl font-semibold mb-8 text-center text-gray-800">Permintaan Pabrik</h3>

    @forelse ($rencanaDenganPengajuan as $rencana)
        <div class="border border-gray-300 rounded-lg shadow-sm mb-6 hover:shadow-md transition-shadow duration-300">
            <div class="bg-gray-100 px-5 py-3 rounded-t-lg flex justify-between items-center">
                <span class="font-medium text-gray-700">
                    Rencana: {{ \Carbon\Carbon::parse($rencana->tanggal)->translatedFormat('d F Y') }}
                </span>
            </div>
            <div class="p-5 space-y-6">
                @foreach ($rencana->pengaju as $pabrik)
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <div>
                            <p class="text-gray-900 font-semibold">{{ $pabrik->name }}</p>
                            <p class="text-sm text-gray-500 mt-1">Status: <em>{{ $pabrik->pivot->status }}</em></p>
                        </div>
                        <form method="POST" action="{{ route('petani.konfirmasi', [$rencana->id, $pabrik->id]) }}" class="mt-4 sm:mt-0">
                            @csrf
                            <input type="hidden" name="status" value="Disetujui">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md text-sm font-medium transition">
                                Setujui
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500 mt-10">Belum ada permintaan yang diterima.</p>
    @endforelse
</div>
@endsection
