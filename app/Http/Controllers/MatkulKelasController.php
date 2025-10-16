<?php

namespace App\Http\Controllers;

use App\Models\MatkulKelas;
use App\Models\Matkul;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Asisten;
use Illuminate\Http\Request;

class MatkulKelasController extends Controller
{
    public function index()
    {
        $matkulkelass = MatkulKelas::with(['matkul', 'kelas', 'dosen', 'asisten'])->get();
        return view('matkulkelas.index', compact('matkulkelass'));
    }

    public function create()
    {
        $matkuls = Matkul::all();
        $kelass = Kelas::all();
        $dosens = Dosen::all();
        $asistens = Asisten::all();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('matkulkelas.tambah', compact('matkuls', 'kelass', 'dosens', 'asistens', 'hariList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matkul_id' => 'required|exists:matkuls,id',
            'kelas_id' => 'required|exists:kelass,id',
            'dosen_id' => 'required|exists:dosens,id',
            'asisten_id' => 'required|exists:asistens,id',
            'asisten2_id' => 'nullable|exists:asistens,id',
            'lab' => 'required|string|max:255',
            'hari' => 'required|string|max:20',
            'jam' => 'required|string|max:20',
        ]);

        MatkulKelas::create($request->all());
        return redirect()->route('matkulkelas.index')->with('success', 'Data matkul kelas berhasil ditambahkan.');
    }

    public function edit(MatkulKelas $matkulkelas)
    {
        $matkuls = Matkul::all();
        $kelass = Kelas::all();
        $dosens = Dosen::all();
        $asistens = Asisten::all();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('matkulkelas.edit', compact('matkulkelas', 'matkuls', 'kelass', 'dosens', 'asistens', 'hariList'));
    }

    public function update(Request $request, MatkulKelas $matkulkelas)
    {
        $request->validate([
            'matkul_id' => 'required|exists:matkuls,id',
            'kelas_id' => 'required|exists:kelass,id',
            'dosen_id' => 'required|exists:dosens,id',
            'asisten_id' => 'required|exists:asistens,id',
            'asisten2_id' => 'nullable|exists:asistens,id',
            'lab' => 'required|string|max:255',
            'hari' => 'required|string|max:20',
            'jam' => 'required|string|max:20',
        ]);

        $matkulkelas->update($request->all());
        return redirect()->route('matkulkelas.index')->with('success', 'Data matkul kelas berhasil diperbarui.');
    }

    public function destroy(MatkulKelas $matkulkelas)
    {
        $matkulkelas->delete();
        return redirect()->route('matkulkelas.index')->with('success', 'Data matkul kelas berhasil dihapus.');
    }
}
