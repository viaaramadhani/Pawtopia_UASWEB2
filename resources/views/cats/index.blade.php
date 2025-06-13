@extends('layouts.app')

@section('content')
  <div class="container mx-auto p-6">
    <!-- Hero Section with Admin Controls - Updated with pink-only gradient -->
    <div class="bg-gradient-to-r from-pink-400 to-pink-600 rounded-xl shadow-lg p-8 mb-8 text-center text-white relative">
    <h1 class="text-3xl md:text-4xl font-bold mb-4">
      {{ auth()->user()->role === 'admin' ? 'Kelola Data Kucing' : 'Temukan Teman Berbulu Anda' }}
    </h1>
    <p class="text-lg md:text-xl max-w-3xl mx-auto mb-6">
      @if(auth()->user()->role === 'admin')
      Tambah, edit, dan kelola data kucing yang tersedia untuk adopsi
    @else
      Beragam kucing menggemaskan yang siap untuk diadopsi dan membawa kebahagiaan ke rumah Anda
    @endif
    </p>

    @if(auth()->user()->role === 'admin')
    <div class="mb-8">
      <a href="{{ route('cats.create') }}"
      class="inline-flex items-center bg-white text-pink-600 px-6 py-3 rounded-lg font-medium hover:bg-pink-100 transition shadow-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd"
      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
      clip-rule="evenodd" />
      </svg>
      Tambah Kucing Baru
      </a>
    </div>
    @endif

    <!-- Enhanced Search & Filter with better contrast -->
    <div class="max-w-3xl mx-auto mt-8 relative">
      <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl shadow-lg">
      <form action="{{ route('cats.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1 relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-pink-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
          fill="currentColor">
          <path fill-rule="evenodd"
            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
            clip-rule="evenodd" />
          </svg>
        </div>
        <input type="text" name="search" placeholder="Cari berdasarkan nama, ras, dll."
          value="{{ request('search') }}"
          class="w-full pl-10 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-700 bg-white/90 shadow-md border border-white/50">
        </div>
        <div class="flex gap-2">
        <select name="gender"
          class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-700 bg-white/90 shadow-md border border-white/50">
          <option value="">Semua Jenis Kelamin</option>
          <option value="jantan" {{ request('gender') == 'jantan' ? 'selected' : '' }}>Jantan</option>
          <option value="betina" {{ request('gender') == 'betina' ? 'selected' : '' }}>Betina</option>
        </select>
        <button type="submit"
          class="bg-white text-pink-600 px-6 py-3 rounded-lg font-medium hover:bg-pink-100 transition shadow-md flex items-center border border-white/50">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
          <path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z" />
          <path fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z"
            clip-rule="evenodd" />
          </svg>
          Cari
        </button>
        </div>
      </form>
      </div>
    </div>
    </div>

    <!-- Cat Statistics Dashboard - UPDATED FOR REAL-TIME DATA -->
    @if(auth()->user()->role === 'admin')
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold text-pink-600 mb-6 text-center">Statistik Kucing</h2>

    <!-- Stats Overview Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-pink-50 p-4 rounded-lg border border-pink-100 flex items-center">
      <div class="h-12 w-12 rounded-full bg-pink-500 flex items-center justify-center mr-4">
      <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
      </svg>
      </div>
      <div>
      <p class="text-sm font-medium text-gray-500">Total Kucing</p>
      <p class="text-2xl font-bold text-gray-800">{{ $allCats->count() }}</p>
      </div>
      </div>

      <div class="bg-pink-50 p-4 rounded-lg border border-pink-100 flex items-center">
      <div class="h-12 w-12 rounded-full bg-blue-500 flex items-center justify-center mr-4">
      <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
      </div>
      <div>
      <p class="text-sm font-medium text-gray-500">Kucing Jantan</p>
      <p class="text-2xl font-bold text-gray-800">{{ $allCats->where('gender', 'jantan')->count() }}</p>
      </div>
      </div>

      <div class="bg-pink-50 p-4 rounded-lg border border-pink-100 flex items-center">
      <div class="h-12 w-12 rounded-full bg-pink-400 flex items-center justify-center mr-4">
      <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
      </div>
      <div>
      <p class="text-sm font-medium text-gray-500">Kucing Betina</p>
      <p class="text-2xl font-bold text-gray-800">{{ $allCats->where('gender', 'betina')->count() }}</p>
      </div>
      </div>

      <div class="bg-pink-50 p-4 rounded-lg border border-pink-100 flex items-center">
      <div class="h-12 w-12 rounded-full bg-green-500 flex items-center justify-center mr-4">
      <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      </div>
      <div>
      <p class="text-sm font-medium text-gray-500">Tersedia Adopsi</p>
      <p class="text-2xl font-bold text-gray-800">{{ $allCats->where('status', 'available')->count() }}</p>
      </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
      <!-- Chart 1: Cat Distribution by Gender -->
      <div class="bg-pink-50 p-6 rounded-lg shadow-sm border border-pink-100">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Jenis Kelamin</h3>
      <div class="h-64">
      <canvas id="genderChart"></canvas>
      </div>
      </div>

      <!-- Chart 2: Cat Distribution by Age -->
      <div class="bg-pink-50 p-6 rounded-lg shadow-sm border border-pink-100">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Umur</h3>
      <div class="h-64">
      <canvas id="ageChart"></canvas>
      </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Chart 3: Popular Cat Breeds -->
      <div class="bg-pink-50 p-6 rounded-lg shadow-sm border border-pink-100">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Ras Kucing Terpopuler</h3>
      <div class="h-64">
      <canvas id="breedChart"></canvas>
      </div>
      </div>

      <!-- Chart 4: Adoption Status -->
      <div class="bg-pink-50 p-6 rounded-lg shadow-sm border border-pink-100">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Adopsi</h3>
      <div class="h-64">
      <canvas id="adoptionChart"></canvas>
      </div>
      </div>
    </div>
    </div>
    @endif

    <!-- Filter Tags - with active state (unchanged) -->
    <div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('cats.index') }}"
      class="px-4 py-2 {{ !request('age') && !request('gender') ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full text-sm hover:bg-pink-600 hover:text-white transition">
      Semua Kucing
    </a>
    <a href="{{ route('cats.index', ['age' => 'kitten']) }}"
      class="px-4 py-2 {{ request('age') == 'kitten' ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full text-sm hover:bg-pink-600 hover:text-white transition">
      Anak Kucing
    </a>
    <a href="{{ route('cats.index', ['age' => 'adult']) }}"
      class="px-4 py-2 {{ request('age') == 'adult' ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full text-sm hover:bg-pink-600 hover:text-white transition">
      Kucing Dewasa
    </a>
    <a href="{{ route('cats.index', ['gender' => 'jantan']) }}"
      class="px-4 py-2 {{ request('gender') == 'jantan' ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full text-sm hover:bg-pink-600 hover:text-white transition">
      Jantan
    </a>
    <a href="{{ route('cats.index', ['gender' => 'betina']) }}"
      class="px-4 py-2 {{ request('gender') == 'betina' ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-700' }} rounded-full text-sm hover:bg-pink-600 hover:text-white transition">
      Betina
    </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow">
    {{ session('success') }}
    </div>
    @endif

    @if(isset($search) && $search)
    <div class="mb-6 bg-pink-50 p-4 rounded-lg border border-pink-200 flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd"
      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
      clip-rule="evenodd" />
    </svg>
    <h2 class="text-gray-700">Hasil pencarian untuk: <span class="font-semibold text-pink-600">{{ $search }}</span></h2>
    </div>
    @endif

    <!-- Admin Table View - Enhanced with pink accents -->
    @if(auth()->user()->role === 'admin')
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8 border border-pink-100">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-pink-100">
      <thead class="bg-pink-50">
      <tr>
      <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Foto</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Nama</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Ras</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Usia</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Jenis Kelamin
      </th>
      <th class="px-6 py-3 text-left text-xs font-medium text-pink-600 uppercase tracking-wider">Aksi</th>
      </tr>
      </thead>
      <tbody class="bg-white divide-y divide-pink-50">
      @forelse($cats as $cat)
      <tr class="hover:bg-pink-50">
      <td class="px-6 py-4 whitespace-nowrap">
      <div class="flex-shrink-0 h-10 w-10">
      @if($cat->photo)
      <img class="h-10 w-10 rounded-full object-cover border border-pink-200"
      src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}">
      @else
      <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-400">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
      </path>
      </svg>
      </div>
      @endif
      </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm font-medium text-gray-900">{{ $cat->name }}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-500">{{ $cat->ras ?? 'Kampung' }}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-500">{{ $cat->age }} tahun</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
      <span
      class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $cat->gender === 'jantan' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
      {{ ucfirst($cat->gender) }}
      </span>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
      <div class="flex space-x-2">
      <a href="{{ route('cats.show', $cat) }}" class="text-pink-600 hover:text-pink-900 flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
      <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
      <path fill-rule="evenodd"
        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
        clip-rule="evenodd" />
      </svg>
      Lihat
      </a>
      <a href="{{ route('cats.edit', $cat) }}" class="text-pink-600 hover:text-pink-900 flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
      <path
        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
      </svg>
      Edit
      </a>
      <form class="inline-block" action="{{ route('cats.destroy', $cat) }}" method="POST"
      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kucing ini?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="text-pink-600 hover:text-pink-900 flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
        fill="currentColor">
        <path fill-rule="evenodd"
        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
        clip-rule="evenodd" />
      </svg>
      Hapus
      </button>
      </form>
      </div>
      </td>
      </tr>
      @empty
      <tr>
      <td colspan="6" class="px-6 py-10 text-center text-gray-500">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-pink-300 mb-3" fill="none"
      viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
      </svg>
      <p class="text-lg font-medium">Tidak ada data kucing yang ditemukan</p>
      <p class="text-sm mt-1">Mulai tambahkan kucing baru untuk ditampilkan di sini</p>
      </td>
      </tr>
      @endforelse
      </tbody>
      </table>
    </div>
    </div>
    @else
    <!-- User Grid View (unchanged) -->
    @if($cats->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
    @foreach($cats as $cat)
    <div
      class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:shadow-lg hover:-translate-y-1">
      @if($cat->photo)
      <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}" class="w-full h-56 object-cover">
    @else
      <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
      <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
      </path>
      </svg>
      </div>
    @endif

      <div class="p-5">
      <div class="flex justify-between items-start mb-2">
      <h3 class="text-xl font-bold text-gray-800">{{ $cat->name }}</h3>
      <span
      class="text-xs px-2 py-1 bg-{{ $cat->gender === 'jantan' ? 'blue' : 'pink' }}-100 text-{{ $cat->gender === 'jantan' ? 'blue' : 'pink' }}-800 rounded-full">
      {{ ucfirst($cat->gender) }}
      </span>
      </div>

      <div class="flex items-center text-gray-600 text-sm mb-4">
      <span class="mr-3">{{ $cat->age }} tahun</span>
      <span class="mr-3">•</span>
      <span>{{ $cat->ras ?? 'Kampung' }}</span>
      </div>

      <p class="text-gray-600 text-sm mb-4 line-clamp-2">
      {{ $cat->description ?? 'Kucing yang ramah dan penuh kasih sayang, siap untuk diadopsi dan menemukan keluarga baru.' }}
      </p>

      <div class="flex justify-between items-center mt-4">
      <span class="text-xs px-2 py-1 bg-pink-100 text-pink-800 rounded-full">{{ $cat->ras ?? 'Kampung' }}</span>
      <a href="{{ route('apply.adoption', $cat->id) }}"
      class="text-white bg-pink-500 px-3 py-1 rounded-md text-sm hover:bg-pink-600">Adopsi</a>
      </div>
      </div>
    </div>
    @endforeach
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-10 text-center">
    <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Kucing Ditemukan</h3>
    <p class="text-gray-500 mb-6">Maaf, tidak ada kucing yang sesuai dengan kriteria pencarian Anda.</p>
    <a href="{{ route('cats.index') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-md">
      Lihat Semua Kucing
    </a>
    </div>
    @endif
    @endif

    <!-- Pagination -->
    <div class="mt-8">
    @if(method_exists($cats, 'links'))
    {{ $cats->links() }}
    @endif
    </div>

    <!-- Adoption Info (unchanged) -->
    @if(auth()->user()->role !== 'admin')
    <div class="bg-gray-50 rounded-lg p-6 mt-12">
    <div class="max-w-4xl mx-auto">
      <h2 class="text-2xl font-bold text-pink-600 mb-6 text-center">Mengapa Mengadopsi dari Pawtopia?</h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-md">
      <div class="w-12 h-12 bg-pink-100 text-pink-500 rounded-full flex items-center justify-center mb-4 mx-auto">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
        </path>
      </div>
      <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Kesehatan Terjamin</h3>
      <p class="text-gray-600 text-center">Semua kucing kami telah divaksinasi, diperiksa oleh dokter hewan, dan
      siap untuk rumah baru mereka.</p>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md">
      <div class="w-12 h-12 bg-pink-100 text-pink-500 rounded-full flex items-center justify-center mb-4 mx-auto">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
        </path>
      </svg>
      </div>
      <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Dukungan Berkelanjutan</h3>
      <p class="text-gray-600 text-center">Kami memberikan konsultasi dan tips perawatan setelah adopsi untuk
      memastikan transisi yang mulus.</p>
      </div>

      <div class="bg-white p-6 rounded-lg shadow-md">
      <div class="w-12 h-12 bg-pink-100 text-pink-500 rounded-full flex items-center justify-center mb-4 mx-auto">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
        </path>
      </svg>
      </div>
      <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Selamatkan Nyawa</h3>
      <p class="text-gray-600 text-center">Dengan mengadopsi, Anda memberikan kesempatan kedua bagi kucing dan
      membuka ruang untuk menyelamatkan kucing lainnya.</p>
      </div>
      </div>
    </div>
    </div>
    @endif
  </div>

  <!-- Updated Chart.js initialization with dynamic data -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Only initialize charts if admin
    @if(auth()->user()->role === 'admin')

    // Create arrays from PHP data for charts
    const allCats = @json($allCats ?? []);
    const adoptions = @json($adoptions ?? []);

    // Calculate gender stats dynamically
    const maleCount = allCats.filter(cat => cat.gender === 'jantan').length;
    const femaleCount = allCats.filter(cat => cat.gender === 'betina').length;

    // Calculate age stats dynamically
    const kittenCount = allCats.filter(cat => cat.age < 1).length;
    const youngCount = allCats.filter(cat => cat.age >= 1 && cat.age < 3).length;
    const adultCount = allCats.filter(cat => cat.age >= 3 && cat.age < 7).length;
    const seniorCount = allCats.filter(cat => cat.age >= 7).length;

    // Calculate breed stats dynamically
    const breedCounts = {};
    allCats.forEach(cat => {
      const breed = cat.ras || 'Kampung';
      breedCounts[breed] = (breedCounts[breed] || 0) + 1;
    });

    // Get top breeds (max 6)
    const topBreeds = Object.entries(breedCounts)
      .sort((a, b) => b[1] - a[1])
      .slice(0, 5);

    // Handle "other" breeds
    const otherBreedsCount = allCats.length - topBreeds.reduce((sum, breed) => sum + breed[1], 0);
    if (otherBreedsCount > 0) {
      topBreeds.push(['Lainnya', otherBreedsCount]);
    }

    // Improved adoption status calculation that checks actual adoptions
    // Get counts by adoption status
    const adoptedCatIds = new Set(adoptions.filter(a => a.status === 'approved').map(a => a.cat_id));
    const pendingCatIds = new Set(adoptions.filter(a => a.status === 'pending').map(a => a.cat_id));

    // Count cats in each status category
    const availableCount = allCats.filter(cat => !adoptedCatIds.has(cat.id) && !pendingCatIds.has(cat.id)).length;
    const adoptedCount = adoptedCatIds.size;
    const pendingCount = pendingCatIds.size;
    const unavailableCount = allCats.filter(cat => cat.status === 'unavailable' || cat.status === 'sick').length;

    // Gender Distribution Chart
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
      type: 'pie',
      data: {
      labels: ['Jantan', 'Betina'],
      datasets: [{
      data: [maleCount, femaleCount],
      backgroundColor: [
      'rgba(59, 130, 246, 0.7)',  // blue for male
      'rgba(236, 72, 153, 0.7)'   // pink for female
      ],
      borderColor: [
      'rgba(59, 130, 246, 1)',
      'rgba(236, 72, 153, 1)'
      ],
      borderWidth: 1
      }]
      },
      options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
      legend: {
      position: 'bottom'
      }
      }
      }
    });

    // Age Distribution Chart
    const ageCtx = document.getElementById('ageChart').getContext('2d');
    new Chart(ageCtx, {
      type: 'bar',
      data: {
      labels: ['< 1 tahun', '1-3 tahun', '3-7 tahun', '> 7 tahun'],
      datasets: [{
      label: 'Jumlah Kucing',
      data: [kittenCount, youngCount, adultCount, seniorCount],
      backgroundColor: [
      'rgba(249, 168, 212, 0.7)', // pink-300
      'rgba(244, 114, 182, 0.7)', // pink-400
      'rgba(236, 72, 153, 0.7)',  // pink-500
      'rgba(219, 39, 119, 0.7)'   // pink-600
      ],
      borderColor: [
      'rgba(249, 168, 212, 1)',
      'rgba(244, 114, 182, 1)',
      'rgba(236, 72, 153, 1)',
      'rgba(219, 39, 119, 1)'
      ],
      borderWidth: 1
      }]
      },
      options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
      y: {
      beginAtZero: true,
      ticks: {
        precision: 0
      }
      }
      },
      plugins: {
      legend: {
      display: false
      }
      }
      }
    });

    // Breed Distribution Chart
    const breedCtx = document.getElementById('breedChart').getContext('2d');
    new Chart(breedCtx, {
      type: 'doughnut',
      data: {
      labels: topBreeds.map(breed => breed[0]),
      datasets: [{
      data: topBreeds.map(breed => breed[1]),
      backgroundColor: [
      'rgba(249, 168, 212, 0.7)', // pink-300
      'rgba(244, 114, 182, 0.7)', // pink-400
      'rgba(236, 72, 153, 0.7)',  // pink-500
      'rgba(219, 39, 119, 0.7)',  // pink-600
      'rgba(190, 24, 93, 0.7)',   // pink-700
      'rgba(157, 23, 77, 0.7)'    // pink-800
      ],
      borderColor: [
      'rgba(249, 168, 212, 1)',
      'rgba(244, 114, 182, 1)',
      'rgba(236, 72, 153, 1)',
      'rgba(219, 39, 119, 1)',
      'rgba(190, 24, 93, 1)',
      'rgba(157, 23, 77, 1)'
      ],
      borderWidth: 1
      }]
      },
      options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
      legend: {
      position: 'right',
      labels: {
        boxWidth: 15
      }
      }
      }
      }
    });

    // Adoption Status Chart
    const adoptionCtx = document.getElementById('adoptionChart').getContext('2d');
    new Chart(adoptionCtx, {
      type: 'bar',
      data: {
      labels: ['Tersedia', 'Diadopsi', 'Dalam Proses', 'Tidak Tersedia'],
      datasets: [{
      label: 'Status',
      data: [availableCount, adoptedCount, pendingCount, unavailableCount],
      backgroundColor: [
      'rgba(16, 185, 129, 0.7)',  // green-500
      'rgba(236, 72, 153, 0.7)',  // pink-500
      'rgba(245, 158, 11, 0.7)',  // amber-500
      'rgba(107, 114, 128, 0.7)'  // gray-500
      ],
      borderColor: [
      'rgba(16, 185, 129, 1)',
      'rgba(236, 72, 153, 1)',
      'rgba(245, 158, 11, 1)',
      'rgba(107, 114, 128, 1)'
      ],
      borderWidth: 1
      }]
      },
      options: {
      responsive: true,
      maintainAspectRatio: false,
      indexAxis: 'y',
      scales: {
      x: {
      beginAtZero: true,
      ticks: {
        precision: 0
      }
      }
      },
      plugins: {
      legend: {
      display: false
      }
      }
      }
    });
    @endif
    });
  </script>
@endsection