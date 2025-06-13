@extends('layouts.app')
@section('content')

<div class="container mx-auto p-6">
  @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
      {{ session('success') }}
    </div>
  @endif

  <div class="flex justify-center mb-6">
    <h1 class="text-2xl font-bold text-pink-600">
      {{ isset($cat) ? 'Edit Kucing' : 'Tambah Kucing' }}
    </h1>
  </div>

  <div class="flex justify-center">
    <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-lg">
      <form action="{{ isset($cat) ? route('cats.update', $cat) : route('cats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($cat))
          @method('PUT')
        @endif

        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-pink-700">Nama Kucing</label>
          <input 
            type="text" 
            name="name" 
            id="name" 
            value="{{ old('name', $cat->name ?? '') }}" 
            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" 
            required
          >
          @error('name')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="ras" class="block text-sm font-medium text-pink-700">Ras</label>
          <input 
            type="text" 
            name="ras" 
            id="ras" 
            value="{{ old('ras', $cat->ras ?? '') }}" 
            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
          >
          @error('ras')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="age" class="block text-sm font-medium text-pink-700">Umur</label>
          <input 
            type="number" 
            name="age" 
            id="age" 
            value="{{ old('age', $cat->age ?? '') }}" 
            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" 
            required
          >
          @error('age')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="gender" class="block text-sm font-medium text-pink-700">Gender</label>
          <select name="gender" id="gender" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
            <option value="">Pilih Gender</option>
            <option value="jantan" {{ old('gender', $cat->gender ?? '') == 'jantan' ? 'selected' : '' }}>Jantan</option>
            <option value="betina" {{ old('gender', $cat->gender ?? '') == 'betina' ? 'selected' : '' }}>Betina</option>
          </select>
          @error('gender')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-pink-700">Deskripsi Kucing</label>
          <textarea 
            name="description" 
            id="description" 
            rows="4" 
            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
          >{{ old('description', $cat->description ?? '') }}</textarea>
          @error('description')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="photo" class="block text-sm font-medium text-pink-700">Foto Kucing</label>
          <input 
            type="file" 
            name="photo" 
            id="photo" 
            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
          >
          @error('photo')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="flex gap-4">
          <button 
            type="submit" 
            class="bg-pink-500 hover:bg-pink-600 text-white py-2 w-full rounded-md"
          >
            {{ isset($cat) ? 'Update Kucing' : 'Simpan Kucing' }}
          </button>
          <a 
            href="{{ route('cats.index') }}" 
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 w-full text-center rounded-md"
          >
            Cancel
          </a>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
