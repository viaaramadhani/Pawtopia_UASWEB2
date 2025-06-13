@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Success Message -->
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

        <!-- Hero Banner -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl shadow-lg p-8 mb-8 text-white">
            <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-lg opacity-90">Temukan teman kucing yang sempurna untuk Anda di Pawtopia.</p>
            <div class="mt-6">
                <a href="{{ route('cats.index') }}"
                    class="bg-white text-pink-600 px-6 py-2 rounded-full font-medium hover:bg-pink-100 transition">
                    Lihat Kucing
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-pink-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-pink-100 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Kucing</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_cats'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Cats Section - Simplified for easier adoption -->
        <div class="mb-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-pink-600">Kucing Tersedia untuk Adopsi</h2>
                <a href="{{ route('cats.index') }}" class="text-pink-500 hover:underline">Lihat Semua</a>
            </div>

            @if(isset($featuredCats) && $featuredCats->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($featuredCats as $cat)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105 relative flex flex-col h-full">
                            @if($cat->photo)
                                <div class="w-full h-56 bg-gray-100 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}"
                                        class="max-h-56 max-w-full object-contain">
                                </div>
                            @else
                                <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">Tidak ada gambar</span>
                                </div>
                            @endif
                            
                            <div class="p-4 flex-grow flex flex-col">
                                <div class="flex-grow">
                                    <h3 class="text-lg font-semibold text-pink-600 line-clamp-1">{{ $cat->name }}</h3>
                                    <p class="text-sm text-gray-600 mb-3">
                                        {{ $cat->gender == 'jantan' ? 'Jantan' : 'Betina' }}, {{ $cat->age }} tahun
                                    </p>
                                    <span class="text-xs px-2 py-1 bg-pink-100 text-pink-800 rounded-full inline-block mb-3">{{ $cat->ras ?? 'Kampung' }}</span>
                                </div>
                                
                                <div class="mt-auto">
                                    <a href="{{ route('user.adopt', $cat->id) }}"
                                        class="text-white bg-pink-500 px-4 py-2 rounded-md text-sm hover:bg-pink-600 font-medium shadow-sm flex items-center justify-center w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        Adopsi Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-100 rounded-lg p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Kucing Tersedia</h3>
                    <p class="text-gray-500 mb-4">Saat ini belum ada kucing yang tersedia untuk diadopsi.</p>
                    <p class="text-gray-500">Silakan cek kembali nanti untuk melihat kucing baru yang tersedia.</p>
                </div>
            @endif
        </div>

        <!-- Your Adoptions - Simplified status display -->
        @if(isset($userAdoptions) && $userAdoptions->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold text-pink-600 mb-4">Permintaan Adopsi Anda</h2>
                
                <div class="space-y-4">
                    @foreach($userAdoptions as $adoption)
                        <div class="border rounded-lg overflow-hidden">
                            <div class="flex items-center border-b p-4 bg-gray-50">
                                <div class="flex-shrink-0 h-12 w-12 mr-4">
                                    @if($adoption->cat && $adoption->cat->photo)
                                        <img class="h-12 w-12 rounded-full object-cover" 
                                            src="{{ asset('storage/' . $adoption->cat->photo) }}" 
                                            alt="{{ $adoption->cat->name }}">
                                    @else
                                        <div class="h-12 w-12 rounded-full bg-pink-100 flex items-center justify-center">
                                            <span class="text-pink-500 font-medium">{{ $adoption->cat ? substr($adoption->cat->name, 0, 1) : 'C' }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $adoption->cat ? $adoption->cat->name : 'Kucing tidak tersedia' }}</h3>
                                    <p class="text-sm text-gray-500">Diajukan pada {{ \Carbon\Carbon::parse($adoption->adopted_at)->format('d M Y') }}</p>
                                </div>
                                
                                <div class="ml-auto">
                                    @if($adoption->status == 'approved')
                                        <span class="px-3 py-1 inline-flex text-sm font-medium rounded-full bg-green-100 text-green-800">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Disetujui
                                        </span>
                                    @elseif($adoption->status == 'rejected')
                                        <span class="px-3 py-1 inline-flex text-sm font-medium rounded-full bg-red-100 text-red-800">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            <svg class="animate-pulse h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            Sedang Diproses
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="p-4">
                                @if($adoption->status == 'approved')
                                    <div class="flex justify-between items-center">
                                        <p class="text-green-700">Selamat! Permintaan adopsi Anda telah disetujui.</p>
                                        <a href="{{ route('adoption.certificate', $adoption->id) }}" 
                                           class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            Unduh Sertifikat
                                        </a>
                                    </div>
                                @elseif($adoption->status == 'rejected')
                                    <p class="text-red-700">Maaf, permintaan adopsi Anda tidak disetujui. Silakan coba kucing lain yang tersedia.</p>
                                @else
                                    <p class="text-yellow-700">Admin kami sedang meninjau permintaan adopsi Anda. Kami akan memberi tahu Anda segera setelah keputusan dibuat.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Simplified Notifications Section -->
        @if(isset($notifications) && $notifications->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold text-pink-600 mb-4">Notifikasi</h2>
                
                <div class="space-y-3">
                    @foreach($notifications as $notification)
                        <div class="p-4 border rounded-lg {{ $notification->read_at ? 'bg-gray-50' : 'bg-blue-50 border-blue-200' }}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-medium {{ $notification->read_at ? 'text-gray-700' : 'text-blue-700' }}">
                                        {{ $notification->data['title'] }}
                                    </h3>
                                    <p class="text-sm {{ $notification->read_at ? 'text-gray-600' : 'text-blue-600' }}">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <span class="text-xs text-gray-500">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                @if(!$notification->read_at)
                                    <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                                            Tandai telah dibaca
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection