@extends('layout.app')

@section('title', 'Kelola Dosen')
@section('page-title', 'Kelola Dosen')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Dosen</h2>
        <a href="{{ route('dosen.tambah') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Dosen
        </a>
    </div>

    {{-- Tampilkan pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100 text-gray-700 text-left">
                <th class="border border-gray-200 px-4 py-2 w-16">No</th>
                <th class="border border-gray-200 px-4 py-2">Nama Dosen</th>
                <th class="border border-gray-200 px-4 py-2 text-center w-48">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dosens as $index => $dosen)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-200 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $dosen->nama_dosen }}</td>
                    <td class="border border-gray-200 px-4 py-2 text-center space-x-2">
                        <a href="{{ route('dosen.edit', $dosen->id) }}" 
                           class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">Edit</a>
                        
                        <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus dosen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">Belum ada data dosen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
