@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-400 to-green-600 p-6 text-white text-center">
                <div class="w-20 h-20 mx-auto bg-white rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold mb-2">Permintaan Adopsi Terkirim!</h1>
                <p class="text-white/80">Terima kasih telah mengajukan permintaan adopsi untuk {{ $cat->name }}</p>
            </div>

            <div class="p-6">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-md">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-green-700 font-medium">Permintaan adopsi Anda telah dikirim ke admin!</p>
                            <p class="text-green-600 text-sm">Admin akan meninjau permintaan Anda segera.</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-lg font-medium text-gray-800 mb-4">Langkah Selanjutnya:</h2>

                <ul class="space-y-3 mb-6">
                    <li class="flex">
                        <div
                            class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-pink-100 text-pink-500 mr-3">
                            1</div>
                        <div>
                            <p class="text-gray-700">Admin akan meninjau permintaan adopsi Anda dalam 1-3 hari kerja</p>
                        </div>
                    </li>
                    <li class="flex">
                        <div
                            class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-pink-100 text-pink-500 mr-3">
                            2</div>
                        <div>
                            <p class="text-gray-700">Anda akan menerima notifikasi saat permintaan adopsi disetujui atau
                                ditolak</p>
                        </div>
                    </li>
                    <li class="flex">
                        <div
                            class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-pink-100 text-pink-500 mr-3">
                            3</div>
                        <div>
                            <p class="text-gray-700">Anda dapat memeriksa status adopsi di halaman dashboard Anda</p>
                        </div>
                    </li>
                </ul>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('user.dashboard') }}"
                        class="bg-pink-500 hover:bg-pink-600 text-white py-3 px-6 rounded-lg text-center font-medium flex-1">
                        Kembali ke Dashboard
                    </a>
                    <a href="{{ route('cats.index') }}"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-6 rounded-lg text-center font-medium flex-1">
                        Lihat Kucing Lainnya
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection