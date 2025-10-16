<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DataDiriModels;
use App\Models\StrukturalModels;
use Illuminate\Routing\Controller;

class StrukturalController extends Controller
{
    public function index()
    {
        $datadiri = DataDiriModels::all();
        $struktural = StrukturalModels::with('datadiri')->get();

        return view('ketua_rw.struktural', compact('datadiri', 'struktural'));
    }

    // Simpan data
    public function store_rw(Request $request)
    {
        $request->validate([
            'id_datadiri' => 'required|exists:datadiri,id',
            'jabatan' => 'required|string|max:255',
            'tingkatan' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar
        $path = $request->file('gambar')->store('struktural', 'public');

        // Simpan data ke tabel struktural
        StrukturalModels::create([
            'id_datadiri' => $request->id_datadiri,
            'jabatan' => $request->jabatan,
            'tingkatan' => $request->tingkatan,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Data struktural berhasil ditambahkan!');
    }


    public function update_rw(Request $request, $id)
    {
        $struktural = StrukturalModels::findOrFail($id);

        $request->validate([
            'id_datadiri' => 'required|exists:datadiri,id',
            'jabatan' => 'required|string|max:255',
            'tingkatan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada file gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage jika ada
            if ($struktural->gambar && Storage::disk('public')->exists($struktural->gambar)) {
                Storage::disk('public')->delete($struktural->gambar);
            }

            // Upload gambar baru
            $path = $request->file('gambar')->store('struktural', 'public');
        } else {
            // Kalau tidak ada file baru, gunakan gambar lama
            $path = $struktural->gambar;
        }

        // Update data struktural
        $struktural->update([
            'id_datadiri' => $request->id_datadiri,
            'jabatan' => $request->jabatan,
            'tingkatan' => $request->tingkatan,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Data struktural berhasil diperbarui!');
    }

    // Hapus data
    public function destroy_rw($id)
    {
        $struktural = StrukturalModels::findOrFail($id);

        if ($struktural->gambar && Storage::disk('public')->exists($struktural->gambar)) {
            Storage::disk('public')->delete($struktural->gambar);
        }

        $struktural->delete();
        return redirect()->back()->with('success', 'Data struktural berhasil dihapus!');
    }
=======
use Illuminate\Http\Request;

class StrukturalController extends Controller
{
    //view
    public function struktural()
    {
        return view('/struktural');
    }

    public function rw()
    {
        return view('/rw');
    }

    public function katar()
    {
        return view('/katar');
    }

    public function pkk()
    {
        return view('/pkk');
    }

    
>>>>>>> bada
}
