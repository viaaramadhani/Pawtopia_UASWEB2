@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
  <div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-4">{{ $adoption->cat->name }}</h1>
    <p class="text-gray-600 mb-2"><strong>Adopter:</strong> {{ $adoption->adopter_name }}</p>
    <p class="text-gray-600 mb-2"><strong>Tanggal Adopsi:</strong> {{ \Carbon\Carbon::parse($adoption->adopted_at)->format('d-m-Y') }}</p>
    
    <div class="text-gray-800 mb-4">
      <strong>Deskripsi Kucing:</strong> 
      {{ $adoption->cat->description ?? 'Deskripsi tidak tersedia.' }}
    </div>

    <div class="text-gray-800 mb-4">
      <strong>Deskripsi Pengadopsi:</strong> 
      {{ $adoption->adopter_description ?? 'Deskripsi tidak tersedia.' }}
    </div>

    <div class="text-gray-800 mb-4">
      <strong>Instagram Pengadopsi:</strong> 
      {{ $adoption->adopter_instagram ?? 'Username Instagram tidak tersedia.' }}
    </div>

    <a href="{{ route('adoptions.index') }}">
      <x-button class="bg-blue-400 hover:bg-blue-500 text-white">Kembali ke Daftar Adopsi</x-button>
    </a>
  </div>
</div>
@endsection
