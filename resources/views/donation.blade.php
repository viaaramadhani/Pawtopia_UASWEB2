@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl shadow-lg p-8 mb-10 text-center text-white">
            <h1 class="text-4xl font-bold mb-4">Dukung Misi Kami</h1>
            <p class="text-xl max-w-3xl mx-auto">Donasi Anda membantu kami menyediakan tempat tinggal, makanan, dan
                perawatan medis untuk kucing yang membutuhkan</p>
        </div>

        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Why Donate -->
            <div class="md:col-span-2">
                <h2 class="text-2xl font-bold text-pink-600 mb-6">Mengapa Dukungan Anda Penting</h2>

                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <p class="text-gray-700 mb-4">Setiap donasi, sekecil apapun, membuat perbedaan besar dalam kehidupan
                        kucing yang kami rawat. Kontribusi Anda yang murah hati membantu kami:</p>

                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-pink-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Menyediakan makanan bergizi dan air bersih</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-pink-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Menanggung biaya kesehatan, termasuk pemeriksaan rutin, vaksinasi,
                                dan perawatan darurat</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-pink-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Memelihara fasilitas penampungan untuk memastikan lingkungan yang
                                aman dan nyaman</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-pink-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Mendanai program sterilisasi untuk membantu mengendalikan populasi
                                kucing</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-pink-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Mendukung program edukasi masyarakat tentang kepemilikan hewan
                                peliharaan yang bertanggung jawab</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-pink-600 mb-4">Bagaimana Kami Menggunakan Donasi Anda</h3>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-pink-50 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold text-pink-600 mb-1">70%</div>
                            <p class="text-sm text-gray-700">Perawatan Kucing Langsung</p>
                        </div>
                        <div class="bg-pink-50 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold text-pink-600 mb-1">15%</div>
                            <p class="text-sm text-gray-700">Pemeliharaan Fasilitas</p>
                        </div>
                        <div class="bg-pink-50 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold text-pink-600 mb-1">10%</div>
                            <p class="text-sm text-gray-700">Program Edukasi</p>
                        </div>
                        <div class="bg-pink-50 rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold text-pink-600 mb-1">5%</div>
                            <p class="text-sm text-gray-700">Biaya Administratif</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Donation Form -->
            <div>
                <h2 class="text-2xl font-bold text-pink-600 mb-6">Berikan Donasi</h2>

                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject" value="Donasi Baru">

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-pink-700 mb-1">Nama Anda</label>
                            <input type="text" name="name" id="name" required
                                class="w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-pink-700 mb-1">Alamat Email</label>
                            <input type="email" name="email" id="email" required
                                class="w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pink-700 mb-1">Jumlah Donasi</label>
                            <div class="grid grid-cols-3 gap-2 mb-2">
                                <button type="button"
                                    class="amount-btn py-2 border-2 border-pink-300 rounded-md hover:bg-pink-100"
                                    data-amount="50000">Rp 50rb</button>
                                <button type="button"
                                    class="amount-btn py-2 border-2 border-pink-300 rounded-md hover:bg-pink-100"
                                    data-amount="100000">Rp 100rb</button>
                                <button type="button"
                                    class="amount-btn py-2 border-2 border-pink-300 rounded-md hover:bg-pink-100"
                                    data-amount="250000">Rp 250rb</button>
                                <button type="button"
                                    class="amount-btn py-2 border-2 border-pink-300 rounded-md hover:bg-pink-100"
                                    data-amount="500000">Rp 500rb</button>
                                <button type="button"
                                    class="amount-btn py-2 border-2 border-pink-300 rounded-md hover:bg-pink-100"
                                    data-amount="1000000">Rp 1jt</button>
                                <button type="button"
                                    class="amount-btn py-2 border-2 border-pink-300 rounded-md hover:bg-pink-100"
                                    data-amount="2500000">Rp 2,5jt</button>
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                                <input type="number" name="amount" id="amount" required min="1000"
                                    class="w-full px-4 py-2 pl-10 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pink-700 mb-1">Metode Pembayaran</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="credit_card" checked
                                        class="h-4 w-4 text-pink-600">
                                    <span class="ml-2 text-gray-700">Kartu Kredit</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="bank_transfer"
                                        class="h-4 w-4 text-pink-600">
                                    <span class="ml-2 text-gray-700">Transfer Bank</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="e_wallet"
                                        class="h-4 w-4 text-pink-600">
                                    <span class="ml-2 text-gray-700">E-Wallet</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-pink-700 mb-1">Pesan
                                (Opsional)</label>
                            <textarea name="message" id="message" rows="3"
                                class="w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-md font-medium">
                            Donasi Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Donation Impact Stories -->
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-pink-600 mb-6 text-center">Donasi Anda Membuat Perbedaan</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/kucing-terlantar.jpg') }}" alt="Kisah Dampak" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Kisah Luna</h3>
                        <p class="text-gray-600 text-sm mb-4">Luna ditemukan terlantar dan terluka parah. Berkat donasi,
                            kami dapat memberikan operasi darurat dan rehabilitasi. Kini, Luna bahagia dan sehat di rumah
                            barunya.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/impact1.webp') }}" alt="Kisah Dampak" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Misi Penyelamatan</h3>
                        <p class="text-gray-600 text-sm mb-4">Ketika kami menemukan koloni lebih dari 30 kucing yang hidup
                            dalam kondisi tidak aman, donasi Anda membiayai operasi penyelamatan besar, perawatan kesehatan,
                            dan upaya penempatan ulang.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/impact2.jpg') }}" alt="Kisah Dampak" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Perluasan Tempat Penampungan</h3>
                        <p class="text-gray-600 text-sm mb-4">Pada tahun 2023, donasi yang murah hati memungkinkan kami
                            untuk memperluas fasilitas, sehingga kami dapat menyelamatkan dan merawat 50% lebih banyak
                            kucing dibanding tahun sebelumnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const amountBtns = document.querySelectorAll('.amount-btn');
            const amountInput = document.getElementById('amount');

            amountBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const amount = this.getAttribute('data-amount');
                    amountInput.value = amount;

                    // Remove active class from all buttons
                    amountBtns.forEach(b => b.classList.remove('bg-pink-100', 'border-pink-500'));

                    // Add active class to clicked button
                    this.classList.add('bg-pink-100', 'border-pink-500');
                });
            });
        });
    </script>
@endsection