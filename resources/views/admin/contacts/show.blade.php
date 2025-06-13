@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.contacts.index') }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md mr-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
            <h1 class="text-2xl font-bold text-pink-600">Detail Pesan</h1>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="border-b pb-4 mb-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-semibold">{{ $contact->subject }}</h2>
                    <span class="text-sm text-gray-500">{{ $contact->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-700 font-medium mr-2">Dari:</span>
                    <span>{{ $contact->name }} &lt;{{ $contact->email }}&gt;</span>
                </div>
            </div>

            <div class="prose max-w-none">
                <p class="whitespace-pre-line">{{ $contact->message }}</p>
            </div>

            <div class="mt-8 flex justify-between">
                
                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md flex items-center"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection