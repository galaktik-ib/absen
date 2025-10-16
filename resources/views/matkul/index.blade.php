@extends('layout.app')

@section('title', 'Kelola Matkul')
@section('page-title', 'Kelola Mata Kuliah')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Mata Kuliah</h2>
        <a href="{{ route('matkul.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Matkul
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100 text-gray-700 text-left">
                <th class="border border-gray-200 px-4 py-2">No</th>
                <th class="border border-gray-200 px-4 py-2">Nama Mata Kuliah</th>
                <th class="border border-gray-200 px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matkuls as $index => $matkul)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-200 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $matkul->nama_matkul }}</td>
                    <td class="border border-gray-200 px-4 py-2 text-center space-x-2">
                        <a href="{{ route('matkul.edit', $matkul->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">Edit</a>
                        <form action="{{ route('matkul.destroy', $matkul->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">Belum ada data mata kuliah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
