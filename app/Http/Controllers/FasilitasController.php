<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\FasilitasModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = FasilitasModels::all();
        return view('ketua_rw.fasilitas', compact('fasilitas'));
    }

    // Simpan data baru
    public function store_rw(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'lokasi_rt' => 'required|string|max:50',
            'condition' => 'nullable|string|max:50',
            'gambar' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        // Cek duplikat
        if (FasilitasModels::where('name', $request->name)->exists()) {
            return redirect()->back()->with('error', 'Nama fasilitas sudah ada, silakan gunakan nama lain.');
        }

        $gambar = $request->file('gambar')->store('gambar', 'public');

        FasilitasModels::create([
            'name' => $request->name,
            'kategori' => $request->kategori,
            'alamat' => $request->alamat,
            'lokasi_rt' => $request->lokasi_rt,
            'condition' => $request->condition ?? 'Baik',
            'gambar' => $gambar // ✅ simpan path-nya di database
        ]);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    // Update data
    public function update_rw(Request $request, $id)
    {
        $fasilitas = FasilitasModels::findOrFail($id);

        // Validasi input (tanpa mewajibkan gambar)
        $request->validate([
            'name' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'lokasi_rt' => 'required|string|max:50',
            'condition' => 'nullable|string|max:50',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Default: gunakan gambar lama
        $gambar = $fasilitas->gambar;

        // Jika ada file baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($gambar && Storage::exists('public/' . $gambar)) {
                Storage::delete('public/' . $gambar);
            }

            // Simpan gambar baru
            $gambar = $request->file('gambar')->store('gambar', 'public');
        }

        // Update data
        $fasilitas->update([
            'name' => $request->name,
            'kategori' => $request->kategori,
            'alamat' => $request->alamat,
            'lokasi_rt' => $request->lokasi_rt,
            'condition' => $request->condition,
            'gambar' => $gambar
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy_rw($id)
    {
        $fasilitas = FasilitasModels::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($fasilitas->gambar && Storage::exists('public/' . $fasilitas->gambar)) {
            Storage::delete('public/' . $fasilitas->gambar);
        }

        // Hapus data dari database
        $fasilitas->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
=======

class FasilitasController extends Controller
{
    //
    public function fasilitas()
    {
        return view('/fasilitas');
>>>>>>> bada
    }
}
