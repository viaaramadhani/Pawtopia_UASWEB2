@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-pink-500 to-pink-600 p-6 text-white text-center">
                <div class="w-20 h-20 mx-auto bg-white rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold mb-2">Permintaan Adopsi Terkirim!</h1>
                <p class="text-white/80">Terima kasih telah mengajukan permintaan adopsi untuk {{ $cat->name }}.</p>
            </div>

            <div class="p-8">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow">
                    <p class="font-medium">Permintaan adopsi Anda telah berhasil dikirim!</p>
                    <p>Admin akan segera menerima notifikasi dan meninjau permintaan Anda.</p>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 mb-3">Langkah Selanjutnya:</h2>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-700">Admin kami telah menerima permintaan Anda dan akan meninjau dalam 1-3
                            hari
                            kerja</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-700">Anda dapat memantau status permintaan adopsi di
                            <a href="{{ route('user.dashboard') }}"
                                class="text-pink-600 font-medium hover:underline">halaman dashboard</a> Anda</span>
                    </li>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row sm:justify-center gap-4 p-6 bg-gray-50 border-t border-gray-200">
                <a href="{{ route('user.dashboard') }}"
                    class="bg-pink-500 hover:bg-pink-600 text-white py-3 px-6 rounded-lg font-medium transition shadow-md flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Lihat Status di Dashboard
                </a>

                <a href="{{ route('cats.index') }}"
                    class="border border-gray-300 bg-white hover:bg-gray-100 text-gray-800 py-3 px-6 rounded-lg font-medium transition shadow-md flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd" />
                    </svg>
                    Lihat Kucing Lainnya
                </a>
            </div>
        </div>
    </div>
@endsection