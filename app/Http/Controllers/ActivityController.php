<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivitypkkModels;
use App\Models\Activ_FotopkkModels;
use App\Models\ActivitykatarModels;
use App\Models\Activ_FotokatarModels;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role')->only('load'); // atau ->except(...) atau langsung di route
    // }

    public function activity_RW()
    {
        return view('/ketua_rw/activity');
    }

    public function index()
    {
        $activities = ActivitypkkModels::with('dokumentasi')->latest()->get();
        $fotoList = Activ_FotopkkModels::latest()->get();

        return view('pkk.activitypkk', compact('activities', 'fotoList'));
    }

    public function store_ft(Request $request)
    {
        $request->validate([
            'fotopkk' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        // Simpan file ke storage/app/public/fotopkk
        $path = $request->file('fotopkk')->store('fotopkk', 'public');

        // Simpan ke database
        Activ_FotopkkModels::create([
            'fotopkk' => $path,
            'caption' => $request->caption,
        ]);

        return redirect()->back()->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function store_pkk(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'kategori_lainnya' => 'nullable|string|max:100', // Untuk kategori custom
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'required|string',
            'lokasi' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'tanggal_acara' => 'nullable|date',
            'fotopkk' => 'nullable|array', // Menerima array ID foto
            'fotopkk.*' => 'exists:activity_fotopkk,id' // Memastikan semua ID foto ada di tabel foto
        ]);
        $kategoriFinal = $validatedData['kategori'];
        if ($kategoriFinal === 'Lainnya' && !empty($validatedData['kategori_lainnya'])) {
            $kategoriFinal = $validatedData['kategori_lainnya'];
        }

        $tanggal_acara_final = null;
        if ($validatedData['status'] === 'published') {
            if (!empty($validatedData['tanggal_acara'])) {
                $tanggal_acara_final = Carbon::parse($validatedData['tanggal_acara'])->format('Y-m-d H:i:s');
            } else {
                $tanggal_acara_final = now();
            }
        }
        DB::beginTransaction();

        try {
            $activity = ActivitypkkModels::create([
                'judul' => $validatedData['judul'],
                'kategori' => $kategoriFinal, // Gunakan nilai kategori yang sudah diproses
                'deskripsi' => $validatedData['deskripsi'],
                'penyelenggara' => $validatedData['penyelenggara'],
                'lokasi' => $validatedData['lokasi'],
                'status' => $validatedData['status'],
                'tanggal_acara' => $tanggal_acara_final, // Gunakan nilai tanggal yang sudah diproses
            ]);

            if (!empty($validatedData['fotopkk'])) {
                $fotoIds = $validatedData['fotopkk'];
                $activity->dokumentasi()->attach($fotoIds);
            }
            DB::commit();

            return redirect()->back()->with('success', 'Aktivitas PKK berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error saving PKK Activity: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function update_pkk(Request $request, $id)
    {
        // 1. Validasi semua input dari form
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'kategori_lainnya' => 'nullable|string|max:100', // Untuk kategori custom
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'required|string',
            'lokasi' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'tanggal_acara' => 'nullable|date',
            'fotopkk' => 'nullable|array', // Menerima array ID foto
            'fotopkk.*' => 'exists:activity_fotopkk,id' // Memastikan semua ID foto ada
        ]);

        // 2. Proses Logika Kustom (Kategori)
        $kategoriFinal = $validatedData['kategori'];
        if ($kategoriFinal === 'Lainnya' && !empty($validatedData['kategori_lainnya'])) {
            $kategoriFinal = $validatedData['kategori_lainnya'];
        }

        // 3. Proses Logika Kustom (Tanggal Acara)
        $tanggal_acara_final = null;
        if ($validatedData['status'] === 'published') {
            if (!empty($validatedData['tanggal_acara'])) {
                $tanggal_acara_final = Carbon::parse($validatedData['tanggal_acara'])->format('Y-m-d H:i:s');
            } else {
                $tanggal_acara_final = null;
            }
        }

        DB::beginTransaction();

        try {
            $activity = ActivitypkkModels::findOrFail($id);
            $activity->update([
                'judul' => $validatedData['judul'],
                'kategori' => $kategoriFinal,
                'deskripsi' => $validatedData['deskripsi'],
                'penyelenggara' => $validatedData['penyelenggara'],
                'lokasi' => $validatedData['lokasi'],
                'status' => $validatedData['status'],
                'tanggal_acara' => $tanggal_acara_final,
            ]);

            if (isset($validatedData['fotopkk'])) {
                $activity->dokumentasi()->sync($validatedData['fotopkk']);
            }
            DB::commit();

            return redirect()->back()->with('success', 'Aktivitas PKK berhasil diperbarui!');
        } catch (\Exception $e) {
            // 9. Jika terjadi error, batalkan semua (rollback)
            DB::rollBack();

            // Catat error untuk debugging
            Log::error('Error updating PKK Activity (ID: ' . $id . '): ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy_pkk($id)
    {
        // 1. Mulai Transaksi Database
        DB::beginTransaction();

        try {
            // 2. Temukan data aktivitas yang akan dihapus
            $activity = ActivitypkkModels::findOrFail($id);
            $activity->dokumentasi()->detach();
            $activity->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Aktivitas "' . $activity->judul . '" berhasil dihapus.');
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Error deleting PKK Activity (ID: ' . $id . '): ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    //katar
     public function indexkatar()
    {
        $activities = ActivitykatarModels::with('dokumentasi')->latest()->get();
        $fotoList = Activ_FotokatarModels::latest()->get();

        return view('katar.activitykatar', compact('activities', 'fotoList'));
    }

    public function store_kft(Request $request)
    {
        $request->validate([
            'fotokatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        // Simpan file ke storage/app/public/fotopkk
        $path = $request->file('fotokatar')->store('fotokatar', 'public');

        // Simpan ke database
        Activ_FotokatarModels::create([
            'fotokatar' => $path,
            'caption' => $request->caption,
        ]);

        return redirect()->back()->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function store_katar(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'kategori_lainnya' => 'nullable|string|max:100', // Untuk kategori custom
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'required|string',
            'lokasi' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'tanggal_acara' => 'nullable|date',
            'fotokatar' => 'nullable|array', // Menerima array ID foto
            'fotokatar.*' => 'exists:activity_fotokatar,id' // Memastikan semua ID foto ada di tabel foto
        ]);
        $kategoriFinal = $validatedData['kategori'];
        if ($kategoriFinal === 'Lainnya' && !empty($validatedData['kategori_lainnya'])) {
            $kategoriFinal = $validatedData['kategori_lainnya'];
        }

        $tanggal_acara_final = null;
        if ($validatedData['status'] === 'published') {
            if (!empty($validatedData['tanggal_acara'])) {
                $tanggal_acara_final = Carbon::parse($validatedData['tanggal_acara'])->format('Y-m-d H:i:s');
            } else {
                $tanggal_acara_final = now();
            }
        }
        DB::beginTransaction();

        try {
            $activity = ActivitykatarModels::create([
                'judul' => $validatedData['judul'],
                'kategori' => $kategoriFinal, // Gunakan nilai kategori yang sudah diproses
                'deskripsi' => $validatedData['deskripsi'],
                'penyelenggara' => $validatedData['penyelenggara'],
                'lokasi' => $validatedData['lokasi'],
                'status' => $validatedData['status'],
                'tanggal_acara' => $tanggal_acara_final, // Gunakan nilai tanggal yang sudah diproses
            ]);

            if (!empty($validatedData['fotokatar'])) {
                $fotoIds = $validatedData['fotokatar'];
                $activity->dokumentasi()->attach($fotoIds);
            }
            DB::commit();

            return redirect()->back()->with('success', 'Aktivitas Katar berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Error saving Katar Activity: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            dd($e->getMessage());
        }
    }

    public function update_katar(Request $request, $id)
    {
        // 1. Validasi semua input dari form
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'kategori_lainnya' => 'nullable|string|max:100', // Untuk kategori custom
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'required|string',
            'lokasi' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'tanggal_acara' => 'nullable|date',
            'fotokatar' => 'nullable|array', // Menerima array ID foto
            'fotokatar.*' => 'exists:activity_fotokatar,id' // Memastikan semua ID foto ada
        ]);

        // 2. Proses Logika Kustom (Kategori)
        $kategoriFinal = $validatedData['kategori'];
        if ($kategoriFinal === 'Lainnya' && !empty($validatedData['kategori_lainnya'])) {
            $kategoriFinal = $validatedData['kategori_lainnya'];
        }

        // 3. Proses Logika Kustom (Tanggal Acara)
        $tanggal_acara_final = null;
        if ($validatedData['status'] === 'published') {
            if (!empty($validatedData['tanggal_acara'])) {
                $tanggal_acara_final = Carbon::parse($validatedData['tanggal_acara'])->format('Y-m-d H:i:s');
            } else {
                $tanggal_acara_final = null;
            }
        }

        DB::beginTransaction();

        try {
            $activity = ActivitykatarModels::findOrFail($id);
            $activity->update([
                'judul' => $validatedData['judul'],
                'kategori' => $kategoriFinal,
                'deskripsi' => $validatedData['deskripsi'],
                'penyelenggara' => $validatedData['penyelenggara'],
                'lokasi' => $validatedData['lokasi'],
                'status' => $validatedData['status'],
                'tanggal_acara' => $tanggal_acara_final,
            ]);

            if (isset($validatedData['fotokatar'])) {
                $activity->dokumentasi()->sync($validatedData['fotokatar']);
            }
            DB::commit();

            return redirect()->back()->with('success', 'Aktivitas Katar berhasil diperbarui!');
        } catch (\Exception $e) {
            // 9. Jika terjadi error, batalkan semua (rollback)
            DB::rollBack();

            // Catat error untuk debugging
            Log::error('Error updating Katar Activity (ID: ' . $id . '): ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy_katar($id)
    {
        // 1. Mulai Transaksi Database
        DB::beginTransaction();

        try {
            // 2. Temukan data aktivitas yang akan dihapus
            $activity = ActivitykatarModels::findOrFail($id);
            $activity->dokumentasi()->detach();
            $activity->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Aktivitas "' . $activity->judul . '" berhasil dihapus.');
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Error deleting Katar Activity (ID: ' . $id . '): ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
