<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Menampilkan semua data mata kuliah
     */
    public function index()
    {
        $matkuls = Matkul::all();
        return view('matkul.index', compact('matkuls'));
    }

    /**
     * Menampilkan form tambah mata kuliah
     */
    public function create()
    {
        return view('matkul.tambah');
    }

    /**
     * Menyimpan data mata kuliah baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
          
        ]);

        Matkul::create([
            'nama_matkul' => $request->nama_matkul,
           
        ]);

        return redirect()->route('kelolamatkul')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit mata kuliah
     */
    public function edit(Matkul $matkul)
    {
        return view('matkul.edit', compact('matkul'));
    }

    /**
     * Memperbarui data mata kuliah di database
     */
    public function update(Request $request, Matkul $matkul)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            
        ]);

        $matkul->update([
            'nama_matkul' => $request->nama_matkul,
           
        ]);

        return redirect()->route('kelolamatkul')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    /**
     * Menghapus data mata kuliah dari database
     */
    public function destroy(Matkul $matkul)
    {
        $matkul->delete();

        return redirect()->route('kelolamatkul')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
