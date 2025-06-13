@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-center mb-6">
            <h1 class="text-3xl font-bold text-pink-600">Tambah Kucing</h1>
        </div>

        <div class="flex justify-center">
            <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-lg">
                <form action="{{ route('cats.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-pink-700">Nama Kucing</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                            required>
                        @error('name')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="ras" class="block text-sm font-medium text-pink-700">Ras Kucing</label>
                        <input type="text" name="ras" id="ras"
                            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika kucing kampung</p>
                        @error('ras')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="age" class="block text-sm font-medium text-pink-700">Umur Kucing (tahun)</label>
                            <input type="number" name="age" id="age"
                                class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required>
                            @error('age')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-pink-700">Jenis Kelamin</label>
                            <select name="gender" id="gender"
                                class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                                <option value="jantan">Jantan</option>
                                <option value="betina">Betina</option>
                            </select>
                            @error('gender')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-pink-700">Kategori</label>
                        <select name="category" id="category"
                            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                            <option value="kitten">Anak Kucing (< 1 tahun)</option>
                            <option value="adult">Kucing Dewasa (≥ 1 tahun)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Kategori akan otomatis menyesuaikan usia yang dimasukkan</p>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-pink-700">Deskripsi Kucing</label>
                        <textarea name="description" id="description"
                            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                            rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="photo" class="block text-sm font-medium text-pink-700">Foto Kucing</label>
                        <input type="file" name="photo" id="photo"
                            class="mt-1 block w-full px-4 py-2 border-2 border-pink-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                        @error('photo')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <button type="submit"
                            class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-md font-medium">
                            Simpan
                        </button>

                        <a href="{{ route('cats.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md font-medium">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Script untuk otomatis memilih kategori berdasarkan usia
        document.getElementById('age').addEventListener('change', function () {
            const age = parseFloat(this.value);
            const categorySelect = document.getElementById('category');

            if (age < 1) {
                categorySelect.value = 'kitten';
            } else {
                categorySelect.value = 'adult';
            }
        });

        // Script untuk memperbarui usia berdasarkan kategori yang dipilih
        document.getElementById('category').addEventListener('change', function () {
            const category = this.value;
            const ageInput = document.getElementById('age');

            if (category === 'kitten' && parseFloat(ageInput.value) >= 1) {
                ageInput.value = '0.5'; // Default untuk anak kucing
            } else if (category === 'adult' && parseFloat(ageInput.value) < 1) {
                ageInput.value = '1'; // Default untuk kucing dewasa
            }
        });
    </script>
@endsection