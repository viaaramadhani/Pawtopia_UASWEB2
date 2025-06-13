@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl shadow-lg p-8 mb-10 text-center text-white">
            <h1 class="text-4xl font-bold mb-4">Tentang Pawtopia</h1>
            <p class="text-xl max-w-3xl mx-auto">Berdedikasi untuk menemukan rumah penuh kasih bagi kucing yang membutuhkan
                sejak 2023</p>
        </div>

        <!-- Our Story -->
        <div class="max-w-4xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-pink-600 mb-6 text-center">Kisah Kami</h2>

            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="prose prose-pink max-w-none">
                    <p class="mb-4">Pawtopia didirikan pada tahun 2023 oleh sekelompok pecinta kucing yang melihat kebutuhan
                        di komunitas mereka. Dengan meningkatnya jumlah kucing liar dan terlantar, kami memutuskan untuk
                        menciptakan tempat di mana hewan-hewan ini bisa menerima perawatan, kasih sayang, dan akhirnya
                        menemukan rumah mereka selamanya.</p>

                    <p class="mb-4">Apa yang dimulai sebagai tempat penampungan kecil dengan hanya beberapa kucing telah
                        berkembang menjadi pusat adopsi yang komprehensif, merawat puluhan kucing setiap saat dan berhasil
                        menempatkan ratusan kucing di rumah yang penuh kasih sayang.</p>

                    <p>Tim kami terdiri dari dokter hewan, spesialis perawatan hewan, dan relawan berdedikasi yang bekerja
                        tanpa lelah untuk memastikan setiap kucing yang datang ke tempat kami menerima perhatian dan
                        perawatan yang mereka butuhkan. Kami percaya bahwa setiap kucing berhak mendapatkan kesempatan untuk
                        hidup bahagia, terlepas dari latar belakang atau status kesehatan mereka.</p>
                </div>
            </div>
        </div>

        <!-- Our Mission -->
        <div class="max-w-4xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-pink-600 mb-6 text-center">Misi Kami</h2>

            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="md:w-1/2">
                        <img src="{{ asset('storage/logo pawtopia.jpg') }}" alt="Our Mission"
                            class="rounded-lg shadow-md w-full">
                    </div>
                    <div class="md:w-1/2">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Yang Kami Perjuangkan</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Menyediakan tempat penampungan dan perawatan untuk kucing terlantar</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Menemukan rumah yang bertanggung jawab dan penuh kasih sayang</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Mengedukasi masyarakat tentang kepemilikan hewan peliharaan yang bertanggung
                                    jawab</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Mempromosikan program sterilisasi untuk mengurangi populasi kucing liar</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Team -->
        <div class="max-w-4xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-pink-600 mb-6 text-center">Tim Kami</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/via2.png') }}" alt="Team Member" class="w-full h-80 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">dr. Octavia R.</h3>
                        <p class="text-pink-600 mb-2">Pendiri & Dokter Hewan</p>
                        <p class="text-gray-600 text-sm">Dengan pengalaman lebih dari 15 tahun di bidang kedokteran hewan,
                            dr. Octavia memastikan semua kucing kami mendapatkan perawatan medis terbaik.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/dokter2.jpg') }}" alt="Team Member" class="w-full h-80 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Mark</h3>
                        <p class="text-pink-600 mb-2">Koordinator Adopsi</p>
                        <p class="text-gray-600 text-sm">Mark bekerja tanpa kenal lelah untuk mencocokkan kucing kami
                            dengan rumah sempurna mereka, memastikan proses adopsi berjalan lancar.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/dokter1.jpg') }}" alt="Team Member" class="w-full h-80 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Ramadhani Via</h3>
                        <p class="text-pink-600 mb-2">Spesialis Perawatan Hewan</p>
                        <p class="text-gray-600 text-sm">Via mengawasi perawatan harian kucing kami, memastikan mereka
                            sehat, bahagia, dan bersosialisasi dengan baik sambil menunggu adopsi.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Us Section -->
        <div class="max-w-4xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-pink-600 mb-6 text-center">Hubungi Kami</h2>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
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
                    
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                        <p class="text-yellow-700 text-sm flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>
                                <strong>Perhatian:</strong> Sistem kontak sedang dalam pengembangan. Saat ini, pesan belum dapat dikirim ke admin. Silakan hubungi kami melalui email <a href="mailto:admin@pawtopia.com" class="text-pink-600 underline">admin@pawtopia.com</a> untuk pertanyaan mendesak.
                            </span>
                        </p>
                    </div>
                    
                    <p class="text-gray-500 text-sm mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pesan Anda akan dikirim ke admin Pawtopia dan akan segera ditanggapi.
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection