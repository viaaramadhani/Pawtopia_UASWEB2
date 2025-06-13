<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Pawtopia') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Add Alpine.js for dropdown functionality -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Add custom styles -->
    <style>
        /* Navbar hover effect */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #ec4899;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Footer pattern */
        .footer-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f9a8d4' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="bg-pink-50 font-sans antialiased">

    <!-- Enhanced Navbar -->
    <header class="bg-gradient-to-r from-white to-pink-50 shadow-md sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 py-3 flex flex-wrap justify-between items-center">
            <!-- Logo Section with Animation -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <img src="{{ asset('storage/logo pawtopia.jpg') }}" alt="Pawtopia Logo"
                    class="h-12 w-12 rounded-full shadow-md transform group-hover:scale-105 transition-transform duration-300">
                <span
                    class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-pink-400 bg-clip-text text-transparent">
                    Pawtopia
                </span>
            </a>

            <!-- Enhanced Navigation Links -->
            <nav class="flex items-center space-x-8 text-pink-600 text-md font-medium">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('cats.index') }}" class="nav-link hover:text-pink-400 transition">Cats</a>
                        <a href="{{ route('adoptions.index') }}" class="nav-link hover:text-pink-400 transition">Adopsi</a>
                        <a href="{{ route('shelters.index') }}" class="nav-link hover:text-pink-400 transition">Shelters</a>
                        <a href="{{ route('admin.contacts.index') }}" class="nav-link hover:text-pink-400 transition">Pesan</a>
                    @else
                        <a href="{{ route('cats.index') }}" class="nav-link hover:text-pink-400 transition">Cats</a>
                        <a href="{{ route('about') }}" class="nav-link hover:text-pink-400 transition">Tentang Kami</a>
                        <a href="{{ route('donation') }}" class="nav-link hover:text-pink-400 transition">Donasi</a>
                        <a href="{{ route('articles') }}" class="nav-link hover:text-pink-400 transition">Artikel</a>
                    @endif

                    <!-- Enhanced User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button"
                            class="flex items-center px-4 py-2 rounded-full bg-pink-50 border border-pink-100 hover:bg-pink-100 transition">
                            <span class="mr-1 font-medium">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-white rounded-xl shadow-lg py-1 ring-1 ring-black ring-opacity-5">
                            <a href="{{ route('profile.show') }}"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-pink-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                View Profile
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-red-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="nav-link hover:text-pink-400 transition">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition shadow-sm">Register</a>
                @endguest
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 mb-20 flex-1">
        @yield('content')
    </main>

    <!-- Enhanced Professional Footer -->
    <footer class="bg-white border-t border-pink-100">
        <!-- Main Footer Content -->
        <div class="footer-pattern max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Logo and About -->
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center mb-6">
                        <img src="{{ asset('storage/logo pawtopia.jpg') }}" alt="Pawtopia Logo"
                            class="h-12 w-12 rounded-full shadow-lg mr-3">
                        <span
                            class="text-2xl font-bold bg-gradient-to-r from-pink-500 to-pink-400 bg-clip-text text-transparent">Pawtopia</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                        Menyatukan kucing dengan keluarga yang penuh kasih sayang sejak 2023. Kami percaya setiap kucing
                        layak mendapatkan rumah yang penuh cinta.
                    </p>
                    <!-- Social Media Icons -->
                    <div class="flex space-x-4 mt-6">
                        <a href="https://www.instagram.com/_pawtopiaa/profilecard/?igsh=MWl2d3B6amh2b2FjMQ=="
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-50 text-pink-500 hover:bg-pink-500 hover:text-white transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/_pawtopiaa/profilecard/?igsh=MWl2d3B6amh2b2FjMQ=="
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-50 text-pink-500 hover:bg-pink-500 hover:text-white transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/_pawtopiaa/profilecard/?igsh=MWl2d3B6amh2b2FjMQ=="
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-50 text-pink-500 hover:bg-pink-500 hover:text-white transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links with Enhanced Design -->
                <div class="col-span-1">
                    <h3 class="text-sm font-bold uppercase tracking-wider mb-5 flex items-center text-gray-800">
                        <span class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </span>
                        Jelajahi
                    </h3>
                    <ul class="space-y-3 pl-10">
                        <li>
                            <a href="{{ route('cats.index') }}"
                                class="text-gray-500 hover:text-pink-500 transition flex items-center">
                                <span class="h-1.5 w-1.5 bg-pink-300 rounded-full mr-2"></span>
                                Kucing
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}"
                                class="text-gray-500 hover:text-pink-500 transition flex items-center">
                                <span class="h-1.5 w-1.5 bg-pink-300 rounded-full mr-2"></span>
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('donation') }}"
                                class="text-gray-500 hover:text-pink-500 transition flex items-center">
                                <span class="h-1.5 w-1.5 bg-pink-300 rounded-full mr-2"></span>
                                Donasi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('articles') }}"
                                class="text-gray-500 hover:text-pink-500 transition flex items-center">
                                <span class="h-1.5 w-1.5 bg-pink-300 rounded-full mr-2"></span>
                                Artikel
                            </a>
                        </li>

                    </ul>
                </div>

                <!-- Resources with Enhanced Design -->
                <div class="col-span-1">
                    <h3 class="text-sm font-bold uppercase tracking-wider mb-5 flex items-center text-gray-800">
                        <span class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </span>
                        Sumber Daya
                    </h3>
                    <ul class="space-y-3 pl-10">
                        <li>
                            <a href="#" class="text-gray-500 hover:text-pink-500 transition flex items-center">
                                <span class="h-1.5 w-1.5 bg-pink-300 rounded-full mr-2"></span>
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a href="https://www.whiskasindonesia.com/kesehatan-and-perawatan/bayi-kucing/mempertimbangkan-memiliki-anak-kucing/ingin-mengadopsi-kucing-pelajari-bagaimana-cara-merawat-kucing" class="text-gray-500 hover:text-pink-500 transition flex items-center">
                                <span class="h-1.5 w-1.5 bg-pink-300 rounded-full mr-2"></span>
                                Panduan Adopsi
                            </a>
                        </li>
                        <li>
                            <a href="https://www.alodokter.com/8-cara-merawat-kucing-agar-tubuhnya-sehat" class="text-gray-500 hover:text-pink-500 transition flex items-center">
                                <span class="h-1.5 w-1.5 bg-pink-300 rounded-full mr-2"></span>
                                Tips Perawatan
                            </a>
                        </li>
                        <li>
                            <a href="https://id.iams.asia/cat/cat-articles/kitten-and-cat-adoption-basics" class="text-gray-500 hover:text-pink-500 transition flex items-center">
                                <span class="h-1.5 w-1.5 bg-pink-300 rounded-full mr-2"></span>
                                Kebijakan Privasi
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact with Enhanced Design -->
                <div class="col-span-1">
                    <h3 class="text-sm font-bold uppercase tracking-wider mb-5 flex items-center text-gray-800">
                        <span class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        Kontak
                    </h3>
                    <ul class="space-y-4 pl-10">
                        <li class="flex items-start group">
                            <div
                                class="flex-shrink-0 bg-pink-50 rounded-full p-1.5 mr-3 group-hover:bg-pink-100 transition-colors">
                                <svg class="h-4 w-4 text-pink-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-600">Palu, Sulawesi Tengah</span>
                        </li>
                        <li class="flex items-start group">
                            <div
                                class="flex-shrink-0 bg-pink-50 rounded-full p-1.5 mr-3 group-hover:bg-pink-100 transition-colors">
                                <svg class="h-4 w-4 text-pink-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-gray-600">info@pawtopia.com</span>
                        </li>
                        <li class="flex items-start group">
                            <div
                                class="flex-shrink-0 bg-pink-50 rounded-full p-1.5 mr-3 group-hover:bg-pink-100 transition-colors">
                                <svg class="h-4 w-4 text-pink-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-gray-600">+62 853-4543-1662</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="border-t border-pink-100 py-6">
            <div
                class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-400 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    © {{ date('Y') }} Pawtopia. Hak Cipta Dilindungi.
                </div>
                <div class="mt-4 md:mt-0">
                    <span>Dikembangkan dengan <span class="text-pink-500">♥</span> oleh <span
                            class="text-pink-500 font-medium">Octavia Ramadhani_F55123015</span></span>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>