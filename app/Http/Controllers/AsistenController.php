<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use Illuminate\Http\Request;

class AsistenController extends Controller
{
    public function index()
    {
        $asistens = Asisten::all();
        return view('asisten.index', compact('asistens'));
    }

    public function create()
    {
        return view('asisten.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_asisten' => 'required|string|max:255',
        ]);

        Asisten::create([
            'nama_asisten' => $request->nama_asisten,
        ]);

        return redirect()->route('kelolaasisten')->with('success', 'Asisten berhasil ditambahkan.');
    }

    public function edit(Asisten $asisten)
    {
        return view('asisten.edit', compact('asisten'));
    }

    public function update(Request $request, Asisten $asisten)
    {
        $request->validate([
            'nama_asisten' => 'required|string|max:255',
        ]);

        $asisten->update([
            'nama_asisten' => $request->nama_asisten,
        ]);

        return redirect()->route('kelolaasisten')->with('success', 'Asisten berhasil diperbarui.');
    }

    public function destroy(Asisten $asisten)
    {
        $asisten->delete();

        return redirect()->route('kelolaasisten')->with('success', 'Asisten berhasil dihapus.');
    }
}
