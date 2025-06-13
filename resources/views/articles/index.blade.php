@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl shadow-lg p-8 mb-10 text-center text-white">
            <h1 class="text-4xl font-bold mb-4">Artikel Pawtopia</h1>
            <p class="text-xl max-w-3xl mx-auto">Tips, saran, dan kisah menarik tentang teman kucing kita</p>
        </div>

        <div class="max-w-6xl mx-auto">
            <!-- Categories and Search -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-lg font-medium text-gray-700 mb-2">Kategori</h2>
                    <div class="flex flex-wrap gap-2">
                        <a href="#"
                            class="px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-sm hover:bg-pink-200">Semua</a>
                        @foreach($categories as $category)
                            <a href="#"
                                class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200">{{ $category }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="w-full md:w-1/3">
                    <div class="relative">
                        <input type="text" placeholder="Cari artikel..."
                            class="w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <button class="absolute right-3 top-2.5 text-pink-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Featured Article - Understanding Cat Language -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <img src="{{ asset('storage/kenalikucing.webp') }}" alt="Memahami Bahasa Kucing"
                            class="w-full h-64 md:h-full object-cover">
                    </div>
                    <div class="md:w-1/2 p-6 md:p-8">
                        <span class="inline-block px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-sm mb-4">Perilaku
                            Kucing</span>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Memahami Bahasa Kucing: Panduan Lengkap</h2>
                        <p class="text-gray-600 mb-6">Pelajari berbagai gerakan, suara, dan ekspresi kucing serta artinya.
                            Mengetahui cara kucing berkomunikasi akan membantu Anda memahami kebutuhan dan perasaan si
                            berbulu kesayangan.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                            <a href="{{ route('articles.show', 'memahami-bahasa-kucing') }}"
                                class="inline-block bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-pink-600 transition">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Header for External Articles -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-pink-600">Artikel Terkini</h2>
                <p class="text-gray-600">Berita dan informasi terbaru dari berbagai sumber tentang dunia kucing</p>
            </div>

            <!-- External Articles from Google News -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
                <!-- Example Article 1 from Google -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,f_auto,q_auto:best,w_640/v1634025439/01jgpcr3em7haqhpfhbmn32sr6.jpg"
                        alt="Fakta Menarik Kucing Oranye" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs mb-3">Fakta
                            Kucing</span>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">7 Fakta Menarik Kucing yang Jarang
                            Diketahui</h3>
                        <p class="text-gray-600 text-sm mb-4">Kucing adalah hewan peliharaan yang paling banyak digemari di dunia. Namun, kebanyakan orang tidak tahu fakta unik tentang kucing..</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">08 Nov 2023</span>
                            <a href="https://kumparan.com/seputar-hobi/7-fakta-unik-tentang-kucing-yang-jarang-diketahui-24EWR6Q0aRa"
                                target="_blank" class="inline-flex items-center text-pink-500 font-medium hover:underline">
                                <span>Baca di Sumber</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Example Article 2 from Google -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://www.vice.com/wp-content/uploads/sites/2/2022/10/1666645359420-gettyimages-1426455227.jpeg?resize=1536,1023"
                        alt="Kucing Memahami Ucapan Manusia" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs mb-3">Riset
                            Terbaru</span>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Penelitian: Kucing Mampu Memahami Ucapan
                            Pemiliknya</h3>
                        <p class="text-gray-600 text-sm mb-4">Penelitian terbaru mengungkapkan bahwa kucing dapat mengenali
                            suara pemiliknya dan memahami kata-kata yang sering diucapkan...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">19 Okt 2023</span>
                            <a href="https://www.vice.com/id/article/kucing-memahami-saat-diajak-ngobrol-manusia-menurut-penelitian-universite-paris-nanterre/"
                                target="_blank" class="inline-flex items-center text-pink-500 font-medium hover:underline">
                                <span>Baca di Sumber</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Example Article 3 from Google -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://res.cloudinary.com/dk0z4ums3/image/upload/v1715325180/attached_image/tak-hanya-mengusir-sepi-inilah-8-manfaat-memelihara-kucing-untuk-kesehatan-0-alodokter.jpg"
                        alt="Kucing dan Kesehatan Mental" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span
                            class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs mb-3">Kesehatan</span>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Memelihara Kucing Bisa Tingkatkan Kesehatan
                            Mental, Ini Buktinya</h3>
                        <p class="text-gray-600 text-sm mb-4">Kucing tak hanya menggemaskan, tetapi kehadiran mereka juga
                            terbukti dapat meningkatkan kesehatan mental pemiliknya...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">27 Jul 2023</span>
                            <a href="https://telemed.ihc.id/artikel-detail-978-Memelihara-Kucing-Dapat-Mengurangi-Stres-dan-Kecemasan-Manusia,-Benarkah.html"
                                target="_blank" class="inline-flex items-center text-pink-500 font-medium hover:underline">
                                <span>Baca di Sumber</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection