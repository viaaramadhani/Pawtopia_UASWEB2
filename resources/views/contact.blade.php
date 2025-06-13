@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-pink-400 to-purple-500 rounded-xl shadow-lg p-8 mb-12 text-center text-white">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Hubungi Kami</h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto">
                Punya pertanyaan atau ingin tahu lebih banyak tentang Pawtopia? Hubungi kami!
            </p>
        </div>

        <div class="max-w-4xl mx-auto mb-16">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    <!-- Contact info -->
                    <div class="lg:col-span-1 bg-pink-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-pink-600 mb-4">Informasi Kontak</h3>

                        <div class="mb-6">
                            <div class="flex items-start mb-3">
                                <div class="p-2 bg-pink-100 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-700">Alamat</h4>
                                    <p class="text-sm text-gray-600">Jl. Pawsitif No. 123, Kucing District, Kota Meong</p>
                                </div>
                            </div>

                            <div class="flex items-start mb-3">
                                <div class="p-2 bg-pink-100 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-700">Telepon</h4>
                                    <p class="text-sm text-gray-600">+62 812-3456-7890</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-2 bg-pink-100 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-700">Email</h4>
                                    <p class="text-sm text-gray-600">info@pawtopia.com</p>
                                </div>
                            </div>
                        </div>

                        <h3 class="text-xl font-semibold text-pink-600 mb-4">Jam Operasional</h3>
                        <div class="text-sm text-gray-600">
                            <p class="mb-1">Senin - Jumat: 09:00 - 17:00</p>
                            <p class="mb-1">Sabtu: 09:00 - 15:00</p>
                            <p>Minggu: Tutup</p>
                        </div>
                    </div>

                    <!-- Contact form -->
                    <div class="lg:col-span-2">
                        <h3 class="text-xl font-semibold text-pink-600 mb-4">Kirim Pesan</h3>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                                @error('subject')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                                <textarea name="message" id="message" rows="5" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-md font-medium transition">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection