<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use Illuminate\Support\Facades\Log;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Achievement::all();
        return view('admin.prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas_jabatan' => 'required|string|max:255',
            'kejuaraan' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        Achievement::create($request->all());

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(Achievement $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, Achievement $prestasi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas_jabatan' => 'required|string|max:255',
            'kejuaraan' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $prestasi->update($request->all());

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diupdate.');
    }

    public function destroy(Achievement $prestasi)
    {
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
