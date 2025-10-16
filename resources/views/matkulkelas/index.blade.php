@extends('layout.app')

@section('title', 'Kelola Matkul Kelas')
@section('page-title', 'Kelola Mata Kuliah Kelas')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    
    {{-- Header dan tombol tambah --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Mata Kuliah Kelas</h2>
        <a href="{{ route('matkulkelas.tambah') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Data
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Jika data kosong --}}
    @if ($matkulkelass->isEmpty())
        <p class="text-gray-500 text-center py-6">Belum ada data mata kuliah kelas.</p>
    @else
        {{-- Tabel Data --}}
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
    <tr class="bg-gray-100 text-gray-700 text-left">
        <th class="border border-gray-200 px-4 py-2 text-center">No</th>
        <th class="border border-gray-200 px-4 py-2">Mata Kuliah</th>
        <th class="border border-gray-200 px-4 py-2">Kelas</th>
        <th class="border border-gray-200 px-4 py-2">Dosen</th>
        <th class="border border-gray-200 px-4 py-2">Asisten</th>
        <th class="border border-gray-200 px-4 py-2">Asisten 2</th>
        <th class="border border-gray-200 px-4 py-2">Lab</th>
        <th class="border border-gray-200 px-4 py-2">Hari</th>
        <th class="border border-gray-200 px-4 py-2">Jam</th>
        <th class="border border-gray-200 px-4 py-2 text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach ($matkulkelass as $index => $item)
        <tr class="hover:bg-gray-50">
            <td class="border border-gray-200 px-4 py-2 text-center">{{ $index + 1 }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $item->matkul->nama_matkul ?? '-' }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $item->kelas->nama_kelas ?? '-' }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $item->dosen->nama_dosen ?? '-' }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $item->asisten->nama_asisten ?? '-' }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $item->asisten2->nama_asisten ?? '-' }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $item->lab }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $item->hari }}</td>
            <td class="border border-gray-200 px-4 py-2">{{ $item->jam }}</td>
            <td class="border border-gray-200 px-4 py-2 text-center space-x-2">
                <a href="{{ route('matkulkelas.edit', $item->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">Edit</a>
                <form action="{{ route('matkulkelas.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

        </table>
    @endif

</div>
@endsection
