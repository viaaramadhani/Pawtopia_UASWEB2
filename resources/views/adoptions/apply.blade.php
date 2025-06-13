@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h1 class="text-2xl font-bold text-pink-600 mb-6">Adopsi {{ $cat->name }}</h1>

                <div class="flex flex-col md:flex-row mb-8">
                    <div class="w-full md:w-1/3 mb-4 md:mb-0 md:pr-4">
                        @if($cat->photo)
                            <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}"
                                class="w-full h-48 object-cover rounded-lg">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="text-gray-400">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>

                    <div class="w-full md:w-2/3">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Nama</h3>
                                <p class="text-lg font-medium">{{ $cat->name }}</p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Usia</h3>
                                <p class="text-lg font-medium">{{ $cat->age }} tahun</p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Jenis Kelamin</h3>
                                <p class="text-lg font-medium">{{ $cat->gender == 'male' ? 'Jantan' : 'Betina' }}</p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Ras</h3>
                                <p class="text-lg font-medium">{{ $cat->ras ?? 'Kampung' }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-sm font-medium text-gray-500">Deskripsi</h3>
                            <p class="text-gray-700">{{ $cat->description ?? 'Tidak ada deskripsi tersedia.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fix the form action to use the correct route and method -->
            <form action="{{ route('submit.adoption', $cat->id) }}" method="POST">
                @csrf

                <div class="bg-pink-50 rounded-lg p-4 mb-6">
                    <h2 class="text-lg font-medium text-pink-700 mb-2">Formulir Adopsi</h2>
                    <p class="text-sm text-gray-600">Mohon berikan informasi berikut untuk membantu kami memproses
                        permintaan adopsi Anda.</p>
                </div>

                <!-- Hidden fields for user data -->
                <input type="hidden" name="adopter_name" value="{{ auth()->user()->name }}">
                <input type="hidden" name="adopter_email" value="{{ auth()->user()->email }}">

                <div class="mb-4">
                    <label for="adopter_phone" class="block text-sm font-medium text-pink-700">Nomor Telepon</label>
                    <input type="text" name="adopter_phone" id="adopter_phone" value="{{ old('adopter_phone') }}"
                        class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                        required>
                    @error('adopter_phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="adopter_address" class="block text-sm font-medium text-pink-700">Alamat</label>
                    <textarea name="adopter_address" id="adopter_address" rows="3"
                        class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                        required>{{ old('adopter_address') }}</textarea>
                    @error('adopter_address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="adopter_description" class="block text-sm font-medium text-gray-700 mb-1">
                        Keterangan Pengadopsi
                    </label>
                    <textarea id="adopter_description" name="adopter_description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500">{{ old('adopter_description') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Berikan informasi tentang pengalaman Anda dengan hewan
                        peliharaan dan situasi tempat tinggal Anda.</p>

                    @error('adopter_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="adopter_instagram" class="block text-sm font-medium text-pink-700">Username Instagram
                        (Opsional)</label>
                    <input type="text" name="adopter_instagram" id="adopter_instagram"
                        value="{{ old('adopter_instagram') }}"
                        class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                    @error('adopter_instagram')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="terms_agreement" required
                            class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Saya menyetujui <a href="#"
                                class="text-pink-600 hover:underline">syarat dan ketentuan</a> adopsi kucing dari
                            Pawtopia</span>
                    </label>
                    @error('terms_agreement')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Add this near the bottom of the form before the submit button -->
                <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-medium text-blue-700 mb-2">Sebelum mengirim permintaan:</h3>
                    <ul class="list-disc pl-5 space-y-1 text-sm text-blue-700">
                        <li>Pastikan data yang Anda masukkan sudah benar</li>
                        <li>Adopsi akan diproses oleh tim kami dalam 1-3 hari kerja</li>
                        <li>Anda dapat melihat status permintaan adopsi di dashboard Anda</li>
                    </ul>
                </div>

                <div class="flex gap-4">
                    <button type="submit" id="submitBtn"
                        class="bg-pink-500 hover:bg-pink-600 text-white py-2 px-6 rounded-md font-medium flex items-center">
                        <span>Kirim Permintaan Adopsi</span>
                        <svg id="loadingIcon" class="ml-2 h-4 w-4 animate-spin hidden" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                    <a href="{{ route('cats.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-md font-medium">
                        Batal
                    </a>
                </div>
            </form>

            <!-- Replace the process section with a simpler confirmation message -->
            <div class="bg-blue-50 rounded-lg p-5 mb-6 border border-blue-200">
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-blue-500 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="font-medium text-blue-700 mb-1">Tentang Permintaan Adopsi</h3>
                        <p class="text-sm text-blue-600">Setelah mengirim permintaan, admin kami akan segera menerima
                            notifikasi dan meninjau pengajuan Anda dalam 1-3 hari kerja. Status permintaan dapat dilihat di
                            dashboard Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this JavaScript at the bottom of the page -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submitBtn');
            const loadingIcon = document.getElementById('loadingIcon');

            form.addEventListener('submit', function () {
                // Show loading indicator
                submitBtn.disabled = true;
                loadingIcon.classList.remove('hidden');
                submitBtn.querySelector('span').innerText = 'Mengirim...';

                // Allow the form to submit
                return true;
            });
        });
    </script>
@endsection