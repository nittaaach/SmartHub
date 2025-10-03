<?php

namespace App\Http\Controllers;

use App\Models\DataDiriModels;
use App\Models\StrukturalModels;
use Illuminate\Http\Request;

class ManagementPenggunaController extends Controller
{
    public function index()
    {
        $struktural = StrukturalModels::with('datadiri')->get();
        return view('ketua_rw.management_pengguna', compact('struktural'));
    }

    // Form tambah
    public function create()
    {
        $datadiri = DataDiriModels::all(); // supaya bisa pilih orang
        return view('struktural.create', compact('datadiri'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_datadiri' => 'required|exists:datadiri,id',
            'jabatan' => 'required|string|max:100',
            'tingkatan' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('struktural', 'public');
        }

        StrukturalModels::create($data);

        return redirect()->route('struktural.index')->with('success', 'Data berhasil ditambahkan');
    }

    // Form edit
    public function edit($id)
    {
        $struktural = StrukturalModels::findOrFail($id);
        $datadiri = DataDiriModels::all();
        return view('struktural.edit', compact('struktural', 'datadiri'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_datadiri' => 'required|exists:datadiri,id',
            'jabatan' => 'required|string|max:100',
            'tingkatan' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $struktural = StrukturalModels::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('struktural', 'public');
        }

        $struktural->update($data);

        return redirect()->route('struktural.index')->with('success', 'Data berhasil diperbarui');
    }

    // Hapus data
    public function destroy($id)
    {
        $struktural = StrukturalModels::findOrFail($id);
        $struktural->delete();

        return redirect()->route('struktural.index')->with('success', 'Data berhasil dihapus');
    }
}
