@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-20">
    <!-- Judul Center -->
    <h2 class="text-2xl font-semibold mb-8 text-center">Pilih Pabrik untuk Melihat Jadwal Giling</h2>

    <!-- Grid Petani -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($pabriks as $pabrik)
        <a href="{{ route('petani.rencanagiling', $pabrik->id) }}" class="block text-center text-gray-800 hover:text-blue-600 transition">
            <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition cursor-pointer">
                <h5 class="text-lg font-semibold">{{ $pabrik->name }}</h5>
                <p class="text-sm text-gray-500">{{ $pabrik->alamat }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
