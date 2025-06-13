@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
  <div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-4">{{ $shelter->name }}</h1>

    <p class="text-gray-600 mb-2">
      <i class="fas fa-map-marker-alt"></i> 
      {{ $shelter->location }}
    </p>
=
    <p class="text-gray-700 mb-4">
      Kontak: {{ $shelter->contact ?? 'Tidak tersedia' }}
    </p>

    <div class="text-gray-800 mb-4">
      <strong>Deskripsi:</strong> 
      {{ $shelter->description ?? 'Deskripsi tidak tersedia.' }}
    </div>

    <div class="flex justify-start space-x-2">
      <!-- Tombol Edit -->
      <a href="{{ route('shelters.edit', $shelter) }}">
        <x-button class="bg-yellow-400 hover:bg-yellow-500 text-black">
          Edit
        </x-button>
      </a>
      
      <form action="{{ route('shelters.destroy', $shelter) }}" method="POST" onsubmit="return confirm('Yakin hapus shelter ini?');" class="inline">
        @csrf
        @method('DELETE')
        <x-button class="bg-red-500 hover:bg-red-600 text-white">
          Hapus
        </x-button>
      </form>
    </div>
  </div>
</div>
@endsection