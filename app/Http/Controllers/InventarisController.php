<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\InventariskatarModels;
use App\Models\RiwayatinventarisModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = InventariskatarModels::with([
            'riwayatTerakhir',
            'riwayat' => function ($query) {
                $query->orderBy('tanggal_transaksi', 'desc');
            }
        ])
            ->orderBy('nama_barang', 'asc')
            ->get();

        return view('katar.inventaris', [
            'inventaris' => $inventaris
        ]);
    }

    public function store_ktrinven(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:50|unique:inventariskatar,kode_barang',
            'kategori' => 'required|string',
            'kategori_lainnya' => 'nullable|string|max:100',
            'satuan' => 'required|string',
            'satuan_lainnya' => 'nullable|string|max:50',
            'kondisi' => 'required|string',
            'kondisi_lainnya' => 'nullable|string|max:50',
            'lokasi_penyimpanan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_perolehan' => 'nullable|date',
            'jumlah_awal' => 'required|integer|min:0', // Validasi untuk stok awal
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan barang. Periksa kembali isian Anda.');
        }

        // 2. Gunakan Transaction (jika 1 gagal, semua gagal)
        try {
            DB::transaction(function () use ($request) {

                // 3. Handle data 'Lainnya' dari form
                $kategori = ($request->kategori == 'Lainnya') ? $request->kategori_lainnya : $request->kategori;
                $satuan = ($request->satuan == 'Lainnya') ? $request->satuan_lainnya : $request->satuan;
                $kondisi = ($request->kondisi == 'Lainnya') ? $request->kondisi_lainnya : $request->kondisi;

                // 4. Handle Upload Gambar
                $pathGambar = null;
                if ($request->hasFile('gambar')) {
                    // Simpan di 'storage/app/public/inventaris'
                    // Pastikan Anda sudah menjalankan `php artisan storage:link`
                    $pathGambar = $request->file('gambar')->store('inventaris', 'public');
                }

                // 5. Simpan data ke tabel 'inventariskatar'
                $barangBaru = InventariskatarModels::create([
                    'nama_barang' => $request->nama_barang,
                    'kode_barang' => $request->kode_barang,
                    'kategori' => $kategori,
                    'satuan' => $satuan,
                    'kondisi' => $kondisi,
                    'deskripsi' => $request->deskripsi,
                    'lokasi_penyimpanan' => $request->lokasi_penyimpanan,
                    'gambar' => $pathGambar,
                    'tanggal_perolehan' => $request->tanggal_perolehan,
                ]);

                // 6. Simpan stok awal ke tabel 'riwayat_inventaris'
                $barangBaru->riwayat()->create([
                    'tipe_transaksi' => 'Masuk',
                    'jumlah' => $request->jumlah_awal,
                    'keterangan' => 'Stok awal / Pendaftaran barang',
                    'penanggung_jawab' => Auth::user()->name ?? 'Sistem', // Ambil nama user yg login
                    'tanggal_transaksi' => $request->tanggal_perolehan ?? now(),
                ]);
            });
        } catch (\Exception $e) {
            // Jika terjadi error (misal: kode barang duplikat)
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }

        // 7. Redirect jika sukses
        return redirect()->back()->with('success', 'Inventaris baru berhasil ditambahkan!');
    }

    public function store_ktriwaya(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'inventaris_id' => 'required|integer|exists:inventariskatar,id',
            'tipe_transaksi' => 'required|in:Masuk,Keluar,Penyesuaian', // Sesuaikan dengan ENUM
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:100',
            'tanggal_transaksi' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal mencatat riwayat. Periksa kembali isian Anda.');
        }

        // 2. (PENTING) Cek stok jika tipe 'Keluar'
        if ($request->tipe_transaksi == 'Keluar') {
            $barang = InventariskatarModels::find($request->inventaris_id);
            $stokSaatIni = $barang->stok_akhir; // Memanggil accessor 'stok_akhir'

            if ($request->jumlah > $stokSaatIni) {
                // Jika jumlah keluar > stok, kembalikan error
                return redirect()->back()
                    ->with('error', "Stok tidak mencukupi! Stok '{$barang->nama_barang}' saat ini hanya: {$stokSaatIni}.")
                    ->withInput();
            }
        }

        // 3. Simpan data ke tabel 'riwayat_inventaris'
        try {
            RiwayatinventarisModels::create([
                'inventaris_id' => $request->inventaris_id,
                'tipe_transaksi' => $request->tipe_transaksi,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
                'penanggung_jawab' => $request->penanggung_jawab,
                'tanggal_transaksi' => $request->tanggal_transaksi ?? now(),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }

        // 4. Redirect jika sukses
        return redirect()->back()->with('success', 'Riwayat transaksi berhasil dicatat!');
    }

    public function update_katar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => [
                'required',
                'string',
                'max:50',
                Rule::unique('inventariskatar', 'kode_barang')->ignore($id)
            ],
            'kategori' => 'required|string',
            'kategori_lainnya' => 'nullable|string|max:100',
            'satuan' => 'required|string',
            'satuan_lainnya' => 'nullable|string|max:50',
            'kondisi' => 'required|string',
            'kondisi_lainnya' => 'nullable|string|max:50',
            'lokasi_penyimpanan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_perolehan' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal update barang. Periksa kembali isian Anda.');
        }

        $inventaris = InventariskatarModels::find($id);
        if (!$inventaris) {
            return redirect()->back()->with('error', 'Data inventaris tidak ditemukan.');
        }

        try {
            $kategori = ($request->kategori == 'Lainnya') ? $request->kategori_lainnya : $request->kategori;
            $satuan = ($request->satuan == 'Lainnya') ? $request->satuan_lainnya : $request->satuan;
            $kondisi = ($request->kondisi == 'Lainnya') ? $request->kondisi_lainnya : $request->kondisi;

            $dataToUpdate = [
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'kategori' => $kategori,
                'satuan' => $satuan,
                'kondisi' => $kondisi,
                'deskripsi' => $request->deskripsi,
                'lokasi_penyimpanan' => $request->lokasi_penyimpanan,
                'tanggal_perolehan' => $request->tanggal_perolehan,
            ];

            // Handle Upload Gambar (Hanya jika ada file baru)
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($inventaris->gambar) {
                    Storage::disk('public')->delete($inventaris->gambar);
                }

                // Simpan gambar baru
                $pathGambar = $request->file('gambar')->store('inventaris', 'public');
                $dataToUpdate['gambar'] = $pathGambar;
            }

            $inventaris->update($dataToUpdate);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }

        return redirect()->back()->with('success', 'Data inventaris berhasil diperbarui!');
    }

    public function destroy_katar($id)
    {
        $inventaris = InventariskatarModels::find($id);

        if (!$inventaris) {
            return redirect()->back()->with('error', 'Data inventaris tidak ditemukan.');
        }

        try {
            if ($inventaris->gambar) {
                Storage::disk('public')->delete($inventaris->gambar);
            }
            $inventaris->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', "Barang '{$inventaris->nama_barang}' dan semua riwayatnya berhasil dihapus.");
    }
}
