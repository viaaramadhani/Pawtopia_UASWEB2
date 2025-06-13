@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-md">

        @if($cat->photo)
        <div class="mb-6 text-center">
            <img src="{{ asset('storage/'.$cat->photo) }}" alt="Foto Kucing" class="w-48 h-48 object-cover rounded-full mx-auto shadow-md">
        </div>
        @endif

        <div class="text-center mb-6">
            <h2 class="text-3xl font-semibold text-pink-600">{{ $cat->name }}</h2>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-semibold text-pink-600 mb-2">Detail Kucing</h3>
            <div class="space-y-2 text-sm text-gray-700">
                <p><strong class="font-medium">Ras:</strong> {{ $cat->ras ?? '-' }}</p>
                <p><strong class="font-medium">Gender:</strong> {{ ucfirst($cat->gender) ?? '-' }}</p>
                <p><strong class="font-medium">Umur:</strong> {{ $cat->age }} tahun</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-semibold text-pink-600 mb-2">Deskripsi</h3>
            <p class="text-sm text-gray-700">{{ $cat->description ?? 'Tidak ada deskripsi' }}</p>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('cats.index') }}">
                <x-button class="bg-pink-400 hover:bg-pink-500 text-white px-6 py-2 rounded-md transition duration-200">
                    Kembali
                </x-button>
            </a>
        </div>
    </div>
</div>
@endsection