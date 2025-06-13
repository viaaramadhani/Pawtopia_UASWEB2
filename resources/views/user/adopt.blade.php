@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header with cat info -->
            <div class="bg-gradient-to-r from-pink-400 to-pink-600 p-6 text-white">
                <h1 class="text-2xl font-bold mb-2">Adopsi {{ $cat->name }}</h1>
                <p class="opacity-90">Isi formulir sederhana ini untuk mengadopsi kucing kesayangan Anda</p>
            </div>

            <!-- Cat details and form -->
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <!-- Cat photo -->
                    <div class="w-full md:w-1/3">
                        @if($cat->photo)
                            <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}"
                                class="w-full h-48 object-cover rounded-lg shadow">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-lg shadow">
                                <span class="text-gray-400">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>

                    <!-- Cat information -->
                    <div class="w-full md:w-2/3">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Nama</h3>
                                <p class="font-medium">{{ $cat->name }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Usia</h3>
                                <p class="font-medium">{{ $cat->age }} tahun</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Jenis Kelamin</h3>
                                <p class="font-medium">{{ $cat->gender == 'jantan' ? 'Jantan' : 'Betina' }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Ras</h3>
                                <p class="font-medium">{{ $cat->ras ?? 'Kampung' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Simplified adoption form -->
                <form action="{{ route('user.adopt.submit', $cat->id) }}" method="POST" id="adoptionForm">
                    @csrf

                    <div class="bg-pink-50 p-4 rounded-lg mb-6">
                        <div class="font-medium text-pink-700 mb-2">Informasi Pengadopsi</div>
                        <p class="text-sm text-gray-600">Data berikut sudah terisi otomatis dari profil Anda</p>
                    </div>

                    <!-- User info (pre-filled, read-only) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" value="{{ auth()->user()->name }}" readonly
                                class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" readonly
                                class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-500">
                        </div>
                    </div>

                    <!-- Required additional info -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="phone" name="phone" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat <span
                                class="text-red-500">*</span></label>
                        <textarea id="address" name="address" rows="2" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500"></textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Alasan Adopsi <span
                                class="text-red-500">*</span></label>
                        <textarea id="reason" name="reason" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500"
                            placeholder="Ceritakan alasan Anda ingin mengadopsi kucing ini..."></textarea>
                        @error('reason')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="agreement" required
                                class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">Saya menyetujui untuk merawat kucing ini dengan baik
                                dan bertanggung jawab</span>
                        </label>
                        @error('agreement')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form actions -->
                    <div class="flex justify-between">
                        <a href="{{ route('user.dashboard') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md">
                            Kembali
                        </a>
                        <button type="submit" id="submitButton"
                            class="bg-pink-500 hover:bg-pink-600 text-white py-2 px-6 rounded-md font-medium flex items-center">
                            <span>Kirim Permintaan Adopsi</span>
                            <svg id="loadingIcon" class="ml-2 h-4 w-4 animate-spin hidden"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('adoptionForm');
            const submitButton = document.getElementById('submitButton');
            const loadingIcon = document.getElementById('loadingIcon');

            form.addEventListener('submit', function () {
                // Disable button and show loading state
                submitButton.disabled = true;
                loadingIcon.classList.remove('hidden');
                submitButton.querySelector('span').innerText = 'Mengirim...';
            });
        });
    </script>
@endsection