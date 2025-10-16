@extends('layout.app')

@section('title', 'Tambah Asisten')
@section('page-title', 'Tambah Asisten')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 max-w-xl mx-auto mt-6">

    {{-- Judul --}}
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
        Tambah Asisten Baru
    </h2>

    {{-- Alert jika ada error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-300 rounded-lg p-4 mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Asisten --}}
    <form action="{{ route('asisten.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="nama_asisten" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Asisten
            </label>
            <input
                type="text"
                name="nama_asisten"
                id="nama_asisten"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                placeholder="Masukkan nama asisten"
                value="{{ old('nama_asisten') }}"
                required
            >
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('kelolaasisten') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
