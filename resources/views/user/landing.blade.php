@extends('layouts.app')

@section('content')
    <!-- Simplified Hero Section with Pink Theme -->
    <section id="Landing-page" class="relative bg-cover bg-center h-screen text-white flex items-center justify-center"
        style="background-image: linear-gradient(rgba(236, 72, 153, 0.8), rgba(147, 51, 234, 0.8)), url('{{ asset('img/hero-section.webp') }}');">

        <!-- Main Content - Simplified -->
        <div class="bg-black/40 p-8 rounded-xl text-center max-w-md">
            <!-- Cat Icon - Simple -->
            <div class="w-16 h-16 mx-auto mb-5">
                <svg class="w-full h-full text-pink-300" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12,8L10.67,8.09C9.81,7.07 7.4,4.5 5,4.5C5,4.5 3.03,7.46 4.96,11.41C4.41,12.24 4.07,12.67 4,13.66L2.07,13.95L2.28,14.93L4.04,14.67L4.18,15.38L2.61,16.32L3.08,17.21L4.53,16.32C5.68,18.76 8.59,20 12,20C15.41,20 18.32,18.76 19.47,16.32L20.92,17.21L21.39,16.32L19.82,15.38L19.96,14.67L21.72,14.93L21.93,13.95L20,13.66C19.93,12.67 19.59,12.24 19.04,11.41C20.97,7.46 19,4.5 19,4.5C16.6,4.5 14.19,7.07 13.33,8.09L12,8Z" />
                </svg>
            </div>

            <!-- Title - Simple -->
            <h1 class="text-4xl font-bold text-white mb-3">
                Welcome to <span class="text-pink-300">Pawtopia</span>
            </h1>

            <p class="text-lg text-white/90 mb-8">
                Temukan teman berbulu kesayangan untuk keluarga Anda
            </p>

            <!-- Single Dashboard Button -->
            <a href="{{ route('user.dashboard') }}"
                class="bg-pink-500 text-white py-3 px-8 rounded-lg shadow-lg hover:bg-pink-600 transition duration-300 inline-flex items-center justify-center font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
                Ke Bagian Cats
            </a>
        </div>
    </section>

    <!-- Features Section with improved spacing -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16">
                <span class="block h-1 w-20 bg-pink-400 rounded-full mx-auto mb-4"></span>
                <h2 class="text-base text-pink-600 font-semibold tracking-wide uppercase">Temukan Sahabat Berbulu</h2>
                <p class="mt-2 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                    Mengapa Adopsi di Pawtopia?
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Kami menawarkan pengalaman adopsi yang mudah dan bermakna untuk Anda dan kucing baru Anda.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <!-- Feature Card 1 -->
                    <div
                        class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                        <div
                            class="flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-pink-100 to-pink-200 text-pink-600 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl leading-6 font-bold text-gray-900 mb-3">Proses Sederhana</h3>
                        <p class="text-base text-gray-500">
                            Proses adopsi yang cepat dan mudah, dengan panduan di setiap langkah untuk memastikan pengalaman
                            yang lancar.
                        </p>
                    </div>

                    <!-- Feature Card 2 -->
                    <div
                        class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                        <div
                            class="flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-pink-100 to-pink-200 text-pink-600 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl leading-6 font-bold text-gray-900 mb-3">Kucing Sehat</h3>
                        <p class="text-base text-gray-500">
                            Semua kucing kami sudah divaksin, disteril, dan diperiksa kesehatannya oleh dokter hewan
                            profesional.
                        </p>
                    </div>

                    <!-- Feature Card 3 -->
                    <div
                        class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                        <div
                            class="flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-pink-100 to-pink-200 text-pink-600 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl leading-6 font-bold text-gray-900 mb-3">Dukungan Setelah Adopsi</h3>
                        <p class="text-base text-gray-500">
                            Kami mendukung Anda dengan saran dan bantuan bahkan setelah adopsi selesai untuk memastikan
                            kebahagiaan kucing.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Adoptions Section with improved spacing -->
    <section class="py-24 bg-gradient-to-b from-white to-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16">
                <span class="block h-1 w-20 bg-pink-400 rounded-full mx-auto mb-4"></span>
                <h2 class="text-base text-pink-600 font-semibold tracking-wide uppercase">Kisah Sukses</h2>
                <p class="mt-2 text-4xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                    Adopsi Terbaru
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Melihat kucing-kucing yang telah menemukan rumah baru yang penuh kasih sayang.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($recentAdoptions as $adoption)
                    <div
                        class="bg-white overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                        <div class="relative h-56">
                            @if($adoption->cat->photo)
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    src="{{ asset('storage/' . $adoption->cat->photo) }}" alt="{{ $adoption->cat->name }}">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                                    <svg class="h-24 w-24 text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute top-0 right-0 bg-gradient-to-l from-green-500 to-green-600 text-white px-4 py-2 m-3 rounded-full text-sm font-bold shadow-lg">
                                Diadopsi
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 group-hover:text-pink-600 transition-colors">
                                {{ $adoption->cat->name }}</h3>
                            <p class="mt-2 text-gray-600 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($adoption->adopted_at)->format('d M Y') }}
                            </p>
                            <div class="mt-6 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gradient-to-r from-pink-100 to-pink-200 text-pink-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $adoption->cat->gender == 'male' ? 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z' }}" />
                                    </svg>
                                    {{ $adoption->cat->gender == 'male' ? 'Jantan' : 'Betina' }}
                                </span>
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    {{ $adoption->cat->ras ?? 'Kampung' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection