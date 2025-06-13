@extends('layouts.app')

@section('content')
  <div class="container mx-auto p-6">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-pink-400 to-pink-600 rounded-xl shadow-lg p-8 mb-8 text-center text-white relative">
    <h1 class="text-3xl md:text-4xl font-bold mb-4">Tempat Penampungan Kucing</h1>
    <p class="text-lg md:text-xl max-w-3xl mx-auto mb-6">
      Temukan tempat penampungan kucing terdekat dan berikan dukungan
    </p>

    <!-- Search & Filter -->
    <div class="max-w-3xl mx-auto mt-8 relative">
      <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl shadow-lg">
      <form action="{{ route('shelters.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1 relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-pink-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
          fill="currentColor">
          <path fill-rule="evenodd"
            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
            clip-rule="evenodd" />
          </svg>
        </div>
        <input type="text" name="search" placeholder="Cari berdasarkan nama atau lokasi..."
          value="{{ request('search') }}"
          class="w-full pl-10 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-700 bg-white/90 shadow-md border border-white/50">
        </div>
        <div class="flex gap-2">
        <select name="location"
          class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-700 bg-white/90 shadow-md border border-white/50"
          onchange="this.form.submit()">
          <option value="">Semua Lokasi</option>
          @foreach($locations as $location)
        <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
        {{ $location }}
        </option>
      @endforeach
        </select>
        <button type="submit"
          class="bg-white text-pink-600 px-6 py-3 rounded-lg font-medium hover:bg-pink-100 transition shadow-md flex items-center border border-white/50">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
            clip-rule="evenodd" />
          </svg>
          Cari
        </button>

        @if(request('search') || request('location'))
      <a href="{{ route('shelters.index') }}"
        class="bg-red-500 text-white px-4 py-3 rounded-lg font-medium hover:bg-red-600 transition shadow-md flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
        clip-rule="evenodd" />
        </svg>
        Reset
      </a>
      @endif
        </div>
      </form>
      </div>
    </div>
    </div>

    <!-- Active Filter Indicators -->
    @if(request('search') || request('location'))
    <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 mb-6 flex items-center justify-between">
    <div class="flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500 mr-2" viewBox="0 0 20 20"
      fill="currentColor">
      <path fill-rule="evenodd"
      d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
      clip-rule="evenodd" />
      </svg>
      <span class="text-pink-700 font-medium">Filter aktif:</span>

      <div class="ml-4 flex flex-wrap gap-2">
      @if(request('search'))
      <span class="bg-white px-3 py-1 rounded-full text-sm font-medium text-pink-600 flex items-center">
      Pencarian: "{{ request('search') }}"
      </span>
    @endif

      @if(request('location'))
      <span class="bg-white px-3 py-1 rounded-full text-sm font-medium text-pink-600 flex items-center">
      Lokasi: {{ request('location') }}
      </span>
    @endif
      </div>
    </div>

    <a href="{{ route('shelters.index') }}"
      class="text-pink-600 hover:text-pink-800 text-sm font-medium flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd"
      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
      clip-rule="evenodd" />
      </svg>
      Hapus Filter
    </a>
    </div>
    @endif

    <!-- Shelters Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @forelse($shelters as $shelter)
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border border-gray-100">
      <div class="h-48 overflow-hidden">
      @if(isset($shelter->image))
      <img src="{{ asset('storage/' . $shelter->image) }}" alt="{{ $shelter->name }}"
      class="w-full h-full object-cover">
    @else
      <div class="w-full h-full bg-pink-100 flex items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-pink-300" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
      </svg>
      </div>
    @endif
      </div>

      <div class="p-6">
      <div class="flex items-start justify-between mb-2">
      <h3 class="text-xl font-bold text-gray-800">{{ $shelter->name }}</h3>
      <span class="bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded-full">{{ $shelter->location }}</span>
      </div>

      <div class="mb-4">
      <div class="flex items-start text-gray-600 mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500 mr-2 mt-0.5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
      <span class="text-sm">{{ $shelter->location }}</span>
      </div>

      <div class="flex items-start text-gray-600 mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500 mr-2 mt-0.5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
      </svg>
      <span class="text-sm">{{ $shelter->contact ?? 'Tidak tersedia' }}</span>
      </div>
      </div>

      <p class="text-gray-600 text-sm mb-4 line-clamp-3">
      {{ $shelter->description ?? 'Tidak ada deskripsi tersedia.' }}
      </p>

      <div class="flex justify-end items-center">
      <a href="{{ route('shelters.show', $shelter) }}"
      class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium">
      Lihat Detail
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
      </a>
      </div>
      </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-lg shadow-md p-10 text-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-pink-300 mx-auto mb-4" fill="none"
      viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
      </svg>
      <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Tempat Penampungan Ditemukan</h3>
      <p class="text-gray-500 mb-6">Maaf, tidak ada tempat penampungan yang sesuai dengan kriteria pencarian Anda.</p>
      <a href="{{ route('shelters.index') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-md">
      Lihat Semua Shelter
      </a>
    </div>
    @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
    @if(method_exists($shelters, 'links'))
    {{ $shelters->links() }}
    @endif
    </div>
  </div>
  </div>
  </div>
  </div>
@endsection