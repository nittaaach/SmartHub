<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DataDiriModels;
use App\Models\StrukturalModels;
use Illuminate\Routing\Controller;

class StrukturalController extends Controller
{
    public function index()
    {
        $struktural = StrukturalModels::with('datadiri')->get();
        return view('ketua_rw.struktural', compact('struktural'));
    }

    // Form tambah
    public function create()
    {
        $datadiri = DataDiriModels::all(); // supaya bisa pilih orang
        return view('struktural.create', compact('datadiri'));
    }

    // Simpan data baru
    public function store_rw(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|exists:users,email', // email harus ada di tabel users
            'notelp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'jabatan' => 'required|string',
            'tingkatan' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil user dari tabel users
        $user = User::where('email', $request->email)->first();

        // Simpan ke tabel datadiri
        $datadiri = DataDiriModels::create([
            'id_users' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'alamat' => $request->alamat,
        ]);

        // Upload gambar
        $path = $request->file('gambar')->store('pengguna', 'public');

        // Simpan ke tabel struktural
        StrukturalModels::create([
            'id_datadiri' => $datadiri->id,
            'jabatan' => $request->jabatan,
            'tingkatan' => $request->tingkatan,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
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
