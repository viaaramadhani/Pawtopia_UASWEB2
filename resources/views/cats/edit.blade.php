@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold text-pink-600 mb-6">Edit Kucing: {{ $cat->name }}</h1>

                <form action="{{ route('cats.update', $cat) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kucing</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $cat->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="ras" class="block text-sm font-medium text-gray-700 mb-1">Ras</label>
                        <input type="text" name="ras" id="ras" value="{{ old('ras', $cat->ras) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika kucing kampung</p>
                        @error('ras')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Usia (tahun)</label>
                            <input type="number" name="age" id="age" min="0" step="0.1" value="{{ old('age', $cat->age) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required>
                            @error('age')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="gender" id="gender"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                                required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="jantan" {{ (old('gender', $cat->gender) == 'jantan') ? 'selected' : '' }}>
                                    Jantan</option>
                                <option value="betina" {{ (old('gender', $cat->gender) == 'betina') ? 'selected' : '' }}>
                                    Betina</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Field kategori baru -->
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category" id="category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500"
                            required>
                            <option value="">Pilih Kategori</option>
                            <option value="kitten" {{ (old('category') == 'kitten' || (!old('category') && $cat->age < 1)) ? 'selected' : '' }}>Anak Kucing (< 1 tahun)</option>
                            <option value="adult" {{ (old('category') == 'adult' || (!old('category') && $cat->age >= 1)) ? 'selected' : '' }}>Kucing Dewasa (≥ 1 tahun)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Kategori akan otomatis menyesuaikan usia yang dimasukkan</p>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">{{ old('description', $cat->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                        @if($cat->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $cat->photo) }}" alt="{{ $cat->name }}"
                                    class="w-32 h-32 object-cover rounded-md">
                                <p class="text-sm text-gray-500 mt-1">Foto saat ini. Unggah yang baru untuk mengganti.</p>
                            </div>
                        @endif
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                        @error('photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-md font-medium">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('cats.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md font-medium">
                            Kembali
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