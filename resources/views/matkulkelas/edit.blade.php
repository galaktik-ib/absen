@extends('layout.app')

@section('title', 'Edit Matkul Kelas')
@section('page-title', 'Edit Data Mata Kuliah Kelas')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">

    {{-- Header --}}
    <h2 class="text-lg font-semibold text-gray-700 mb-4">Form Edit Mata Kuliah Kelas</h2>

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('matkulkelas.update', $matkulkelas->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Dropdown Mata Kuliah --}}
        <div>
            <label for="matkul_id" class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah</label>
            <select name="matkul_id" id="matkul_id" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($matkuls as $matkul)
                    <option value="{{ $matkul->id }}" 
                        {{ old('matkul_id', $matkulkelas->matkul_id) == $matkul->id ? 'selected' : '' }}>
                        {{ $matkul->nama_matkul }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown Kelas --}}
        <div>
            <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
            <select name="kelas_id" id="kelas_id" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelass as $kelas)
                    <option value="{{ $kelas->id }}" 
                        {{ old('kelas_id', $matkulkelas->kelas_id) == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown Dosen --}}
        <div>
            <label for="dosen_id" class="block text-sm font-medium text-gray-700 mb-1">Dosen</label>
            <select name="dosen_id" id="dosen_id" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" 
                        {{ old('dosen_id', $matkulkelas->dosen_id) == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->nama_dosen }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown Asisten --}}
        <div>
            <label for="asisten_id" class="block text-sm font-medium text-gray-700 mb-1">Asisten</label>
            <select name="asisten_id" id="asisten_id" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                <option value="">-- Pilih Asisten --</option>
                @foreach ($asistens as $asisten)
                    <option value="{{ $asisten->id }}" 
                        {{ old('asisten_id', $matkulkelas->asisten_id) == $asisten->id ? 'selected' : '' }}>
                        {{ $asisten->nama_asisten }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="asisten2_id" class="block text-gray-700 font-medium mb-1">Asisten 2 (Opsional)</label>
            <select name="asisten2_id" id="asisten2_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Asisten 2 (opsional) --</option>
                @foreach ($asistens as $asisten)
                    <option value="{{ $asisten->id }}" {{ $matkulkelas->asisten2_id == $asisten->id ? 'selected' : '' }}>
                        {{ $asisten->nama_asisten }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Dropdown Hari Kuliah --}}
<div>
    <label for="hari" class="block text-sm font-medium text-gray-700 mb-1">Hari Kuliah</label>
    <select name="hari" id="hari" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
        <option value="">-- Pilih Hari --</option>
        @foreach ($hariList as $h)
            <option value="{{ $h }}" {{ old('hari', $matkulkelas->hari ?? '') == $h ? 'selected' : '' }}>
                {{ $h }}
            </option>
        @endforeach
    </select>
</div>

{{-- Dropdown Jam Kuliah --}}
<div>
    <label for="jam" class="block text-sm font-medium text-gray-700 mb-1">Jam Kuliah</label>
    <select name="jam" id="jam" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
        <option value="">-- Pilih Jam --</option>
        <option value="08:00-09:40" {{ old('jam') == '08:00-09:40' ? 'selected' : '' }}>08:00-09:40 (Pagi)</option>
                <option value="09:40-11:20" {{ old('jam') == '09:40-11:20' ? 'selected' : '' }}>09:40-11:20 (Pagi)</option>
                <option value="11:20-13:00" {{ old('jam') == '11:20-13:00' ? 'selected' : '' }}>11:20-13:00 (Pagi)</option>
                <option value="13:40-15:20" {{ old('jam') == '13:40-15:20' ? 'selected' : '' }}>13:40-15:20 (Pagi)</option>
                <option value="15:20-17:00" {{ old('jam') == '15:20-17:00' ? 'selected' : '' }}>15:20-17:00 (Pagi)</option>
                <option value="18:40-20:00" {{ old('jam') == '18:40-20:00' ? 'selected' : '' }}>18:40-20:00 (Malam)</option>
                <option value="20:00-21:20" {{ old('jam') == '20:00-21:20' ? 'selected' : '' }}>20:00-21:20 (Malam)</option>
                <option value="21:20-22:40" {{ old('jam') == '21:20-22:40' ? 'selected' : '' }}>21:20-22:40 (Malam)</option>
                <option value="08:00-09:20" {{ old('jam') == '08:00-09:20' ? 'selected' : '' }}>08:00-09:20 (Pegawai)</option>
                <option value="09:20-10:40" {{ old('jam') == '09:20-10:40' ? 'selected' : '' }}>09:20-10:40 (Pegawai)</option>
                <option value="10:40-12:00" {{ old('jam') == '10:40-12:00' ? 'selected' : '' }}>10:40-12:00 (Pegawai)</option>
                <option value="12:00-13:20" {{ old('jam') == '12:00-13:20' ? 'selected' : '' }}>12:00-13:20 (Pegawai)</option>
                <option value="13:20-14:40" {{ old('jam') == '13:20-14:40' ? 'selected' : '' }}>13:20-14:40 (Pegawai)</option>
                <option value="14:40-16:00" {{ old('jam') == '14:40-16:00' ? 'selected' : '' }}>14:40-16:00 (Pegawai)</option>
                <option value="16:00-17:20" {{ old('jam') == '16:00-17:20' ? 'selected' : '' }}>16:00-17:20 (Pegawai)</option>
                <option value="17:20-18:40" {{ old('jam') == '17:20-18:40' ? 'selected' : '' }}>17:20-18:40 (Pegawai)</option>
    </select>
</div>


        {{-- Input Lab --}}
        <div>
            <label for="lab" class="block text-sm font-medium text-gray-700 mb-1">Lab</label>
            <input type="text" name="lab" id="lab" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200" 
                   placeholder="Masukkan nama lab" 
                   value="{{ old('lab', $matkulkelas->lab) }}" required>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-2 pt-4">
            <a href="{{ route('matkulkelas.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                Batal
            </a>
            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Update
            </button>
        </div>

    </form>
</div>
@endsection
