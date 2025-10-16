@extends('layout.app')

@section('title', 'Kelola Asisten')
@section('page-title', 'Kelola Asisten')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Asisten</h2>
        <a href="{{ route('asisten.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Asisten
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 border border-green-300 rounded-lg p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100 text-gray-700 text-left">
                <th class="border border-gray-200 px-4 py-2 w-16 text-center">No</th>
                <th class="border border-gray-200 px-4 py-2">Nama Asisten</th>
                <th class="border border-gray-200 px-4 py-2 text-center w-40">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($asistens as $index => $asisten)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-200 px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $asisten->nama_asisten }}</td>
                    <td class="border border-gray-200 px-4 py-2 text-center space-x-2">
                        <a href="{{ route('asisten.edit', $asisten->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">Edit</a>
                        <form action="{{ route('asisten.destroy', $asisten->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus asisten ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">
                        Belum ada data asisten.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
