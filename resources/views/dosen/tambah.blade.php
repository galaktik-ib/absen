@extends('layout.app')

@section('title', 'Tambah Dosen')
@section('page-title', 'Tambah Dosen')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Form Tambah Dosen</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dosen.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="nama_dosen" class="block text-gray-700 font-medium mb-1">Nama Dosen</label>
            <input 
                type="text" 
                name="nama_dosen" 
                id="nama_dosen" 
                value="{{ old('nama_dosen') }}"
                placeholder="Masukkan nama dosen" 
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
            >
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('keloladosen') }}" 
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                Batal
            </a>
            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
