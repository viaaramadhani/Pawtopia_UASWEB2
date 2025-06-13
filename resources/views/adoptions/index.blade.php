@extends('layouts.app')

@section('content')
  <div class="container mx-auto p-6">
    <!-- Hero Section - Modified to remove "Tambah" button -->
    <div class="bg-gradient-to-r from-pink-400 to-pink-600 rounded-xl shadow-lg p-8 mb-8 text-center text-white relative">
    <h1 class="text-3xl md:text-4xl font-bold mb-4">Manajemen Permintaan Adopsi</h1>
    <p class="text-lg md:text-xl max-w-3xl mx-auto mb-6">
      Kelola status permintaan adopsi kucing di Pawtopia
    </p>

    <!-- Enhanced Search & Filter with better visual indicators -->
    <div class="max-w-3xl mx-auto mt-8 relative">
      <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl shadow-lg">
      <form action="{{ route('adoptions.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1 relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-pink-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
          fill="currentColor">
          <path fill-rule="evenodd"
            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
            clip-rule="evenodd" />
          </svg>
        </div>
        <input type="text" name="search" placeholder="Cari berdasarkan nama kucing atau pengadopsi..."
          value="{{ request('search') }}"
          class="w-full pl-10 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-700 bg-white/90 shadow-md border border-white/50">
        </div>

        <div class="flex gap-2">
        <select name="status"
          class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-700 bg-white/90 shadow-md border border-white/50"
          onchange="this.form.submit()">
          <option value="">Semua Status</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu ({{ $pendingCount
      }})</option>
          <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui ({{ $approvedCount
      }})</option>
          <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak ({{ $rejectedCount
      }})</option>
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

        @if(request('search') || request('status'))
      <a href="{{ route('adoptions.index') }}"
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

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow flex items-center">
    <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Active Filter Indicators -->
    @if(request('search') || request('status'))
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

      @if(request('status'))
      <span class="bg-white px-3 py-1 rounded-full text-sm font-medium 
      {{ request('status') == 'pending' ? 'text-yellow-600' :
      (request('status') == 'approved' ? 'text-green-600' : 'text-red-600') }} flex items-center">
      Status:
      {{ request('status') == 'pending' ? 'Menunggu' :
      (request('status') == 'approved' ? 'Disetujui' : 'Ditolak') }}
      </span>
    @endif
      </div>
    </div>

    <a href="{{ route('adoptions.index') }}"
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

    <!-- Status Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <a href="{{ route('adoptions.index', ['status' => 'pending']) }}" class="block">
      <div
      class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-400 hover:shadow-lg transition {{ request('status') == 'pending' ? 'ring-2 ring-yellow-400' : '' }}">
      <div class="flex justify-between items-center">
        <div>
        <p class="text-sm text-gray-500">Menunggu Persetujuan</p>
        <p class="text-2xl font-bold text-gray-800">{{ $pendingCount }}</p>
        </div>
        <div class="p-3 bg-yellow-100 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        </div>
      </div>
      </div>
    </a>

    <a href="{{ route('adoptions.index', ['status' => 'approved']) }}" class="block">
      <div
      class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-400 hover:shadow-lg transition {{ request('status') == 'approved' ? 'ring-2 ring-green-400' : '' }}">
      <div class="flex justify-between items-center">
        <div>
        <p class="text-sm text-gray-500">Permintaan Disetujui</p>
        <p class="text-2xl font-bold text-gray-800">{{ $approvedCount }}</p>
        </div>
        <div class="p-3 bg-green-100 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        </div>
      </div>
      </div>
    </a>

    <a href="{{ route('adoptions.index', ['status' => 'rejected']) }}" class="block">
      <div
      class="bg-white rounded-lg shadow-md p-4 border-l-4 border-red-400 hover:shadow-lg transition {{ request('status') == 'rejected' ? 'ring-2 ring-red-400' : '' }}">
      <div class="flex justify-between items-center">
        <div>
        <p class="text-sm text-gray-500">Permintaan Ditolak</p>
        <p class="text-2xl font-bold text-gray-800">{{ $rejectedCount }}</p>
        </div>
        <div class="p-3 bg-red-100 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        </div>
      </div>
      </div>
    </a>
    </div>

    <!-- Add this near the top of the page, after the search form -->
    @if($pendingCount > 0)
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-md">
    <div class="flex">
      <div class="flex-shrink-0">
      <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd"
      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
      clip-rule="evenodd" />
      </svg>
      </div>
      <div class="ml-3">
      <p class="text-sm text-yellow-700">
      Ada {{ $pendingCount }} permintaan adopsi yang memerlukan persetujuan Anda.
      <a href="{{ route('adoptions.index', ['status' => 'pending']) }}"
      class="font-medium underline text-yellow-700 hover:text-yellow-600">
      Tinjau sekarang
      </a>
      </p>
      </div>
    </div>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-pink-500 text-white">
        <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Foto Kucing</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Informasi Kucing
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Pengadopsi</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
        <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($adoptions as $adoption)
      <tr class="hover:bg-pink-50">
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex-shrink-0 h-14 w-14">
        @if($adoption->cat->photo)
      <img class="h-14 w-14 rounded-full object-cover border-2 border-pink-200"
      src="{{ asset('storage/' . $adoption->cat->photo) }}" alt="{{ $adoption->cat->name }}">
      @else
      <div class="h-14 w-14 rounded-full bg-pink-100 flex items-center justify-center text-pink-400">
      <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
      </path>
      </svg>
      </div>
      @endif
        </div>
      </td>
      <td class="px-6 py-4">
        <div class="text-sm font-medium text-gray-900">{{ $adoption->cat->name }}</div>
        <div class="text-sm text-gray-500">{{ $adoption->cat->gender == 'jantan' ? 'Jantan' : 'Betina' }},
        {{ $adoption->cat->age }} tahun
        </div>
        <div class="text-sm text-gray-500">{{ $adoption->cat->ras ?? 'Kampung' }}</div>
      </td>
      <td class="px-6 py-4">
        <div class="text-sm font-medium text-gray-900">{{ $adoption->adopter_name }}</div>
        <div class="text-sm text-gray-500">{{ $adoption->adopter_phone }}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        {{ \Carbon\Carbon::parse($adoption->adopted_at)->format('d M Y') }}
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        @if($adoption->status == 'approved')
      <span
      class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
      <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
      Disetujui
      </span>
      @elseif($adoption->status == 'rejected')
      <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
      <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
      Ditolak
      </span>
      @else
      <span
      class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
      <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      Menunggu
      </span>
      @endif
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
        <div class="flex justify-center space-x-2">
        <a href="{{ route('adoptions.show', $adoption) }}"
        class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 hover:bg-indigo-200 px-3 py-1 rounded flex items-center">
        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        Detail
        </a>

        @if($adoption->status == 'pending')
      <form action="{{ route('adoptions.update', $adoption) }}" method="POST" class="inline-block">
      @csrf
      @method('PUT')
      <input type="hidden" name="status" value="approved">
      <button type="submit"
      class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 px-3 py-1 rounded flex items-center">
      <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
      Setujui
      </button>
      </form>

      <form action="{{ route('adoptions.update', $adoption) }}" method="POST" class="inline-block">
      @csrf
      @method('PUT')
      <input type="hidden" name="status" value="rejected">
      <button type="submit"
      class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-3 py-1 rounded flex items-center">
      <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
      Tolak
      </button>
      </form>
      @endif

        <form action="{{ route('adoptions.destroy', $adoption) }}" method="POST"
        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data adopsi ini?');" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit"
        class="text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded flex items-center">
        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-pink-300 mb-4" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <p class="text-lg font-medium">Belum ada permintaan adopsi</p>
        <p class="text-sm mt-1">Saat ini tidak ada data permintaan adopsi</p>
      </td>
      </tr>
      @endforelse
      </tbody>
      </table>
    </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
    @if(method_exists($adoptions, 'links'))
    {{ $adoptions->links() }}
    @endif
    </div>
  </div>

  <!-- Add a script to make the filter more responsive -->
  <script>
    // Auto-submit the form when the status dropdown changes
    document.addEventListener('DOMContentLoaded', function () {
    const statusSelect = document.querySelector('select[name="status"]');
    if (statusSelect) {
      statusSelect.addEventListener('change', function () {
      this.form.submit();
      });
    }
    });
  </script>
@endsection