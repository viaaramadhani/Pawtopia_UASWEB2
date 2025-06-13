@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
  <div class="flex justify-center mb-6">
    <h1 class="text-2xl font-bold text-pink-600">{{ isset($adoption) ? 'Edit Adopsi' : 'Tambah Adopsi' }}</h1>
  </div>

  <div class="flex justify-center">
    <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-lg">
    <form action="{{ isset($adoption) ? route('adoptions.update', $adoption->id) : route('adoptions.store') }}" method="POST">
      @csrf
      @if(isset($adoption))
        @method('PUT')
      @endif

        <div class="mb-4">
          <label for="cat_id" class="block text-sm font-medium text-pink-700">Pilih Kucing</label>
          <select name="cat_id" id="cat_id" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
            @foreach($cats as $cat)
              <option value="{{ $cat->id }}" @if(old('cat_id', $adoption->cat_id ?? '') == $cat->id) selected 
                @endif>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          @error('cat_id')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="adopted_at" class="block text-sm font-medium text-pink-700">Tanggal Adopsi</label>
          <input type="date" name="adopted_at" id="adopted_at" value="{{ old('adopted_at', isset($adoption) ? \Carbon\Carbon::parse($adoption->adopted_at)->format('Y-m-d') : '') }}" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
          @error('adopted_at')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="adopter_name" class="block text-sm font-medium text-pink-700">Nama Pengadopsi</label>
          <input type="text" name="adopter_name" id="adopter_name" value="{{ old('adopter_name', $adoption->adopter_name ?? '') }}" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" required placeholder="Masukkan nama pengadopsi">
          @error('adopter_name')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="adopter_description" class="block text-sm font-medium text-pink-700">Deskripsi Pengadopsi</label>
          <textarea name="adopter_description" id="adopter_description" rows="4" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" required placeholder="Ceritakan tentang pengadopsi...">{{ old('adopter_description', $adoption->adopter_description ?? '') }}</textarea>
          @error('adopter_description')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="adopter_instagram" class="block text-sm font-medium text-pink-700">Username Instagram</label>
          <input type="text" name="adopter_instagram" id="adopter_instagram" value="{{ old('adopter_instagram', $adoption->adopter_instagram ?? '') }}" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" required placeholder="@username">
          @error('adopter_instagram')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="adopter_phone" class="block text-sm font-medium text-pink-700">Nomor Telepon</label>
          <input type="text" name="adopter_phone" id="adopter_phone" value="{{ old('adopter_phone', $adoption->adopter_phone ?? '') }}" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" required placeholder="08xxxxxxxxxx">
          @error('adopter_phone')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="adopter_address" class="block text-sm font-medium text-pink-700">Alamat</label>
          <textarea name="adopter_address" id="adopter_address" rows="3" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" required placeholder="Alamat lengkap pengadopsi...">{{ old('adopter_address', $adoption->adopter_address ?? '') }}</textarea>
          @error('adopter_address')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="status" class="block text-sm font-medium text-pink-700">Status Adopsi</label>
          <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
            <option value="pending" {{ old('status', $adoption->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ old('status', $adoption->status ?? '') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ old('status', $adoption->status ?? '') == 'rejected' ? 'selected' : '' }}>Rejected</option>
          </select>
          @error('status')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="flex gap-4">
          <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white py-2 w-full rounded-md">
            {{ isset($adoption) ? 'Update Adopsi' : 'Simpan Adopsi' }}
          </button>
          <a href="{{ route('adoptions.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 w-full text-center rounded-md">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
