@extends('layout.app')

@section('title', 'Edit Asisten')
@section('page-title', 'Edit Asisten')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">

    <h2 class="text-xl font-semibold text-gray-700 mb-6">Edit Data Asisten</h2>

    {{-- Pesan validasi error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form edit --}}
    <form action="{{ route('asisten.update', $asisten->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_asisten" class="block text-sm font-medium text-gray-700 mb-2">Nama Asisten</label>
            <input type="text" id="nama_asisten" name="nama_asisten"
                   value="{{ old('nama_asisten', $asisten->nama_asisten) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Masukkan nama asisten" required>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('kelolaasisten') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection
