@extends('layout.app')

@section('title', 'Dashboard')
@section('page-title', 'Selamat Datang di Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-2">Kelola Matkul</h2>
    <p class="text-gray-500 text-sm">Tambah, ubah, atau hapus data mata kuliah.</p>
  </div>

  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-2">Kelola Asisten</h2>
    <p class="text-gray-500 text-sm">Atur data asisten pengajar per kelas.</p>
  </div>

  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-2">Kelola Dosen</h2>
    <p class="text-gray-500 text-sm">Lihat dan kelola data dosen pengajar.</p>
  </div>

  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-2">Kelola Matkul Kelas</h2>
    <p class="text-gray-500 text-sm">Hubungkan kelas, matkul, dosen, dan asisten.</p>
  </div>

  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-2">Kelola Absen</h2>
    <p class="text-gray-500 text-sm">Pantau dan kelola absensi per pertemuan.</p>
  </div>

</div>
@endsection
