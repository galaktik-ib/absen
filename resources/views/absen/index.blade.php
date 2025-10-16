@extends('layout.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Kelola Absen</h1>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('absen.cetak') }}" method="GET" class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Mata Kuliah & Kelas</label>
                <select name="matkul_kelas_id" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih Mata Kuliah dan Kelas --</option>
                    @foreach ($matkulKelass as $mk)
                        <option value="{{ $mk->id }}">
                            {{ $mk->matkul->nama_matkul }} - {{ $mk->kelas->nama_kelas }} ({{ $mk->dosen->nama_dosen }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Bulan</label>
                <input type="month" name="bulan" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Cetak Absen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
