@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <div class="mb-8">
                <a href="{{ route('articles') }}" class="text-pink-500 hover:underline flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Artikel
                </a>

                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $article['title'] }}</h1>

                <div class="flex items-center text-gray-500 text-sm mb-6">
                    <span class="mr-4">{{ \Carbon\Carbon::parse($article['date'])->format('d F Y') }}</span>
                    <span class="mr-4">|</span>
                    <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full">{{ $article['category'] }}</span>
                </div>

                <div class="w-full h-72 md:h-96 mb-8">
                    @if(isset($article['external_url']))
                        <!-- Display external image directly if from external source -->
                        <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}"
                            class="w-full h-full object-cover rounded-lg shadow-md">
                    @else
                        <!-- Fixed image path - remove concatenation that was causing problems -->
                        <img src="{{ asset('storage/kenalikucing.webp') }}" alt="{{ $article['title'] }}"
                            class="w-full h-full object-cover rounded-lg shadow-md">
                    @endif
                </div>
            </div>

            <!-- Article Content -->
            <div class="bg-white rounded-lg shadow-md p-6 md:p-8 mb-10">
                <div class="prose prose-pink max-w-none">
                    {!! $article['content'] !!}
                </div>

                <div class="mt-8 border-t pt-6">
                    <p class="text-gray-600 italic">Ditulis oleh {{ $article['author'] }}</p>
                </div>

                <!-- External Article Link (if applicable) -->
                @if(isset($article['external_url']))
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-gray-700 mb-2">Artikel ini diambil dari sumber eksternal.</p>
                        <a href="{{ $article['external_url'] }}" target="_blank"
                            class="inline-flex items-center text-pink-600 font-medium hover:text-pink-700">
                            Baca artikel asli di sumbernya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Share -->
            <div class="bg-gray-50 rounded-lg p-6 mb-10">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Bagikan Artikel Ini</h3>
                <div class="flex space-x-4">
                    <a href="#" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                        </svg>
                    </a>
                    <a href="#" class="bg-blue-400 text-white p-2 rounded-full hover:bg-blue-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="#" class="bg-green-500 text-white p-2 rounded-full hover:bg-green-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.5 3.5L12 12l-1-1-7-7L2.5 5.5l8 8-8 8 1.5 1.5 7-7 1-1 8 8 1.5-1.5-8-8 8-8z"
                                transform="rotate(45 12 12)"></path>
                        </svg>
                    </a>
                    <a href="#" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1 17.5c-2.267 0-4.135-1.343-4.135-3.001 0-1.656 1.868-3.001 4.135-3.001s4.135 1.344 4.135 3.001c0 1.657-1.868 3.001-4.135 3.001zm7-11a1.5 1.5 0 11-3.001.001 1.5 1.5 0 013.001-.001z" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection