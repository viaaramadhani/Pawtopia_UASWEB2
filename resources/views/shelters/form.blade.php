@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
  <div class="flex justify-center mb-6">
    <h1 class="text-2xl font-bold text-pink-600">
      {{ isset($shelter) ? 'Edit Shelter' : 'Tambah Shelter' }}
    </h1>
  </div>

  <div class="flex justify-center">
    <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-lg">
      <form action="{{ isset($shelter) ? route('shelters.update', $shelter) : route('shelters.store') }}" method="POST">
        @csrf
        @if(isset($shelter)) @method('PUT') @endif

        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-pink-700">Nama Shelter</label>
          <input type="text" name="name" id="name" value="{{ old('name', $shelter->name ?? '') }}" 
            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
          @error('name')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="location" class="block text-sm font-medium text-pink-700">Lokasi</label>
          <input type="text" name="location" id="location" value="{{ old('location', $shelter->location ?? '') }}" 
            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
          @error('location')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="contact" class="block text-sm font-medium text-pink-700">Kontak</label>
          <input type="text" name="contact" id="contact" value="{{ old('contact', $shelter->contact ?? '') }}" 
            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
          @error('contact')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

      <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-pink-700">Deskripsi</label>
          <textarea name="description" id="description" 
                    class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">{{ old('description', $shelter->description ?? '') }}</textarea>
          @error('description')
              <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
      </div>

        <div class="flex gap-4">
          <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white py-2 w-full rounded-md">
            {{ isset($shelter) ? 'Update Shelter' : 'Simpan Shelter' }}
          </button>
          <a href="{{ route('shelters.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 w-full text-center rounded-md">
            Cancel
          </a>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection