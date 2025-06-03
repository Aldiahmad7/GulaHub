@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-20">
    <!-- Judul Center -->
    <h2 class="text-2xl font-semibold mb-8 text-center">Pilih Petani untuk Melihat Jadwal Panen</h2>

    <!-- Grid Petani -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($petanis as $petani)
        <a href="{{ route('pabrik.rencanapanen', $petani->id) }}" class="block text-center text-gray-800 hover:text-blue-600 transition">
            <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition cursor-pointer">
                <h5 class="text-lg font-semibold">{{ $petani->name }}</h5>
                <p class="text-sm text-gray-500">{{ $petani->alamat }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
