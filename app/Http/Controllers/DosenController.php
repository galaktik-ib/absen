<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Menampilkan semua data dosen
     */
    public function index()
    {
        $dosens = Dosen::all();
        return view('dosen.index', compact('dosens'));
    }

    /**
     * Menampilkan form tambah dosen
     */
    public function create()
    {
        return view('dosen.tambah');
    }

    /**
     * Menyimpan data dosen baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
        ]);

        Dosen::create([
            'nama_dosen' => $request->nama_dosen,
        ]);

        return redirect()->route('keloladosen')->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit dosen
     */
    public function edit(Dosen $dosen)
    {
        return view('Dosen.edit', compact('dosen'));
    }

    /**
     * Memperbarui data dosen di database
     */
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
        ]);

        $dosen->update([
            'nama_dosen' => $request->nama_dosen,
        ]);

        return redirect()->route('keloladosen')->with('success', 'Dosen berhasil diperbarui.');
    }

    /**
     * Menghapus data dosen dari database
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('keloladosen')->with('success', 'Dosen berhasil dihapus.');
    }
}
