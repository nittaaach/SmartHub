<?php

namespace App\Http\Controllers;

use App\Models\BaganModels;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DataDiriModels;
use App\Models\StrukturalModels;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule; // (Mungkin tidak perlu, tapi bagus untuk ada)


class StrukturalController extends Controller
{
    public function index()
    {
        $datadiri = DataDiriModels::all();
        $struktural = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'RW') // hanya ambil yang tingkatan = RW
            ->get();

        return view('ketua_rw.struktural', compact('datadiri', 'struktural'));
    }

    public function indexbagan()
    {
        $bagan = BaganModels::latest()->get();

        return view('ketua_rw.bagan', compact('bagan'));
    }

    public function indexrt()
    {
        $datadiri = DataDiriModels::all();
        $strukturalrt = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'RT') // hanya ambil yang tingkatan = RW
            ->get();

        return view('ketua_rw.strukturalrt', compact('datadiri', 'strukturalrt'));
    }

    public function indexpkk()
    {
        $datadiri = DataDiriModels::all();
        $strukturalpkk = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'PKK')
            ->get();

        return view('ketua_rw.strukturalpkk', compact('datadiri', 'strukturalpkk'));
    }

    public function strukturpkk()
    {
        $datadiri = DataDiriModels::all();
        $struktural = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'PKK')
            ->get();

        return view('pkk.struktural', compact('datadiri', 'struktural'));
    }

    public function indexkatar()
    {
        $datadiri = DataDiriModels::all();
        $strukturalkatar = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'KATAR') // hanya ambil yang tingkatan = RW
            ->get();

        return view('ketua_rw.strukturalkatar', compact('datadiri', 'strukturalkatar'));
    }

    public function strukturkatar()
    {
        $datadiri = DataDiriModels::all();
        $struktural = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'KATAR')
            ->get();

        return view('katar.struktural', compact('datadiri', 'struktural'));
    }

    //view
    public function struktural()
    {
        $datadiri = DataDiriModels::all();

        $rw = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'RW')
            ->whereIn('jabatan', ['Ketua RW', 'Wakil Ketua RW', 'Sekretaris', 'Bendahara'])
            ->get();

        $pkk = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'PKK')
            ->whereIn('jabatan', ['Ketua PKK', 'Wakil Ketua PKK', 'Sekretaris', 'Bendahara'])
            ->get();

        $katar = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'KATAR')
            ->whereIn('jabatan', ['Ketua KATAR', 'Wakil Ketua KATAR', 'Sekretaris', 'Bendahara'])
            ->get();

        return view('struktural', compact('datadiri', 'rw', 'pkk', 'katar'));
    }

    public function rw()
    {
        $datadiri = DataDiriModels::all();

        // Daftar jabatan BPH
        $jabatanBPH = ['Ketua RW', 'Wakil Ketua RW', 'Sekretaris', 'Bendahara'];

        // Ambil data RW hanya untuk BPH
        $bph = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'RW')
            ->whereIn('jabatan', $jabatanBPH)
            ->get();

        // Ambil data RW selain BPH
        $anggotaLain = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'RW')
            ->whereNotIn('jabatan', $jabatanBPH)
            ->get();

        $bagan = BaganModels::where('tingkatan', 'Rukun Warga')->latest()->get();

        // Tidak mengubah nama variabel lama biar tetap kompatibel
        $strukturalrw = $bph;

        return view('rw', compact('datadiri', 'strukturalrw', 'anggotaLain', 'bagan'));
    }

    public function katar()
    {
        $datadiri = DataDiriModels::all();

        // Daftar jabatan BPH
        $jabatanBPH = ['Ketua KATAR', 'Wakil Ketua KATAR', 'Sekretaris', 'Bendahara'];

        // Ambil data RW hanya untuk BPH
        $bph = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'KATAR')
            ->whereIn('jabatan', $jabatanBPH)
            ->get();

        // Ambil data RW selain BPH
        $anggotaLain = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'KATAR')
            ->whereNotIn('jabatan', $jabatanBPH)
            ->get();

        $bagan = BaganModels::where('tingkatan', 'Karang Taruna')->latest()->get();
        

        // Tidak mengubah nama variabel lama biar tetap kompatibel
        $strukturalkatar = $bph;

        return view('katar', compact('datadiri', 'strukturalkatar', 'anggotaLain', 'bagan'));
    }

    public function pkk()
    {
        $datadiri = DataDiriModels::all();

        // Daftar jabatan BPH
        $jabatanBPH = ['Ketua PKK', 'Wakil Ketua PKK', 'Sekretaris', 'Bendahara'];

        // Ambil data PKK hanya untuk BPH
        $bph = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'PKK')
            ->whereIn('jabatan', $jabatanBPH)
            ->get();

        // Ambil data PKK selain BPH
        $anggotaLain = StrukturalModels::with('datadiri')
            ->where('tingkatan', 'PKK')
            ->whereNotIn('jabatan', $jabatanBPH)
            ->get();
        
        $bagan = BaganModels::where('tingkatan', 'PKK Anyelir')->latest()->get();
        

        // Tidak mengubah nama variabel lama biar tetap kompatibel
        $strukturalpkk = $bph;

        return view('pkk', compact('datadiri', 'strukturalpkk', 'anggotaLain', 'bagan'));
    }

    //crud struktural
    public function store_rw(Request $request)
    {
        $baseRules = [
            'jabatan' => 'required|string|max:255',
            'tingkatan' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
        if ($request->boolean('is_new_user')) {
            $userRules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:datadiri,email',
                'notelp' => 'required|string|max:20',
                'alamat' => 'required|string',
            ];
        } else {
            $userRules = [
                'id_datadiri' => 'required|exists:datadiri,id',
            ];
        }

        $request->validate(array_merge($baseRules, $userRules));
        $path = null;
        $id_datadiri_final = null;

        DB::beginTransaction();
        try {
            $path = $request->file('gambar')->store('struktural', 'public');
            if ($request->boolean('is_new_user')) {
                $datadiri = DataDiriModels::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'notelp' => $request->notelp,
                    'alamat' => $request->alamat,
                    'id_users' => null,
                ]);
                $id_datadiri_final = $datadiri->id;
            } else {
                $id_datadiri_final = $request->id_datadiri;
            }
            StrukturalModels::create([
                'id_datadiri' => $id_datadiri_final,
                'jabatan' => $request->jabatan,
                'tingkatan' => $request->tingkatan,
                'gambar' => $path,
            ]);
            DB::commit();

            return redirect()->back()->with('success', 'Data struktural berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function update_rw(Request $request, $id)
    {
        $struktural = StrukturalModels::with('datadiri')->findOrFail($id);
        $datadiri = $struktural->datadiri;
        if (!$datadiri) {
            return redirect()->back()->with('error', 'Data diri tidak ditemukan untuk struktural ini.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('datadiri')->ignore($datadiri->id),
            ],
            'notelp' => 'required|string|max:20',
            'alamat' => 'required|string',

            'jabatan' => 'required|string|max:255',
            'tingkatan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $datadiri->update([
                'name' => $request->name,
                'email' => $request->email,
                'notelp' => $request->notelp,
                'alamat' => $request->alamat,
            ]);

            $strukturalData = [
                'jabatan' => $request->jabatan,
                'tingkatan' => $request->tingkatan,
            ];

            if ($request->hasFile('gambar')) {
                if ($struktural->gambar) {
                    Storage::disk('public')->delete($struktural->gambar);
                }
                $strukturalData['gambar'] = $request->file('gambar')->store('struktural', 'public');
            }
            $struktural->update($strukturalData);

            DB::commit();

            return redirect()->back()->with('success', 'Data struktural berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->hasFile('gambar') && isset($strukturalData['gambar'])) {
                Storage::disk('public')->delete($strukturalData['gambar']);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
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

    public function store_bagan(Request $request)
    {
        $request->validate([
            'fotobagan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tingkatan' => 'required|string',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $path = $request->file('fotobagan')->store('fotobagan', 'public');

        BaganModels::create([
            'fotobagan' => $path,
            'deskripsi'   => $request->deskripsi,
            'tingkatan' => $request->tingkatan,
        ]);

        return redirect()->back()->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function update_bagan(Request $request, $id)
    {
        $request->validate([
            'fotobagan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tingkatan' => 'required|string',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $foto = BaganModels::findOrFail($id);

        $data = [
            'tingkatan' => $request->tingkatan,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('fotobagan')) {
            Storage::disk('public')->delete($foto->fotobagan);
            $path = $request->file('fotobagan')->store('fotobagan', 'public');
            $data['fotobagan'] = $path;
        }

        $foto->update($data);

        return redirect()->back()->with('success', 'Data bagan berhasil diperbarui.');
    }

    public function destroy_bagan($id)
    {
        $foto = BaganModels::findOrFail($id);
        Storage::disk('public')->delete($foto->fotobagan);
        $foto->delete();

        return redirect()->back()->with('success', 'Foto Bagan Berhasil Dihapus.');
    }
}