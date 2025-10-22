<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KatalogModels;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    //for show home landing
    public function katalog()
    {
        return view('/katalog');
    }

    public function detail_katalog()
    {
        return view('/detail_katalog');
    }

    public function index()
    {
        // Ambil semua data dari tabel katalog_pkk
        $katalog = KatalogModels::orderBy('created_at', 'desc')->get();

        // Kembalikan ke view (contoh: resources/views/katalog/index.blade.php)
        return view('pkk.katalog', compact('katalog'));
    }

    public function store_pkk(Request $request)
    {
        // 1️⃣ Validasi data input
        $validated = $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'stok'             => 'required|integer|min:0',
            'harga'            => 'required|numeric|min:0',
            'kategori'         => 'required|string|max:255',
            'kategori_lainnya' => 'nullable|string|max:255',
            'nama_penjual'     => 'required|string|max:255',
            'kontak_penjual'   => 'required|string|max:30',
            'alamat_penjual'   => 'required|string|max:255',
            'foto'             => 'required|image|mimes:jpg,jpeg,png|max:2048',

            'link_whatsapp'    => 'nullable|url',
            'link_instagram'   => 'nullable|url',
            'link_tiktok'      => 'nullable|url',
            'link_tokopedia'   => 'nullable|url',
            'link_shopee'      => 'nullable|url',
            'link_facebook'    => 'nullable|url',
        ]);

        // 2️⃣ Tentukan kategori final (jika "Lainnya" maka ambil input kategori_lainnya)
        $kategoriFinal = $validated['kategori'] === 'Lainnya' && !empty($validated['kategori_lainnya'])
            ? $validated['kategori_lainnya']
            : $validated['kategori'];

        // 3️⃣ Simpan foto ke storage/public/katalog
        $fotoPath = $request->file('foto')->store('katalog', 'public');

        // 4️⃣ Simpan data ke database
        KatalogModels::create([
            'nama_produk'    => $validated['nama_produk'],
            'deskripsi'      => $validated['deskripsi'],
            'stok'           => $validated['stok'],
            'harga'          => $validated['harga'],
            'kategori'       => $kategoriFinal,
            'foto'           => $fotoPath,
            'nama_penjual'   => $validated['nama_penjual'],
            'kontak_penjual' => $validated['kontak_penjual'],
            'alamat_penjual' => $validated['alamat_penjual'],

            // Link sosial media & e-commerce
            'link_whatsapp'  => $validated['link_whatsapp'] ?? null,
            'link_instagram' => $validated['link_instagram'] ?? null,
            'link_tiktok'    => $validated['link_tiktok'] ?? null,
            'link_tokopedia' => $validated['link_tokopedia'] ?? null,
            'link_shopee'    => $validated['link_shopee'] ?? null,
            'link_facebook'  => $validated['link_facebook'] ?? null,

            // Status default
            'status_stock'   => 'tersedia',
            'status'         => 'aktif',
        ]);

        // 5️⃣ Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }


    public function update_pkk(Request $request, $id)
    {
        // 1️⃣ Validasi input
        $validated = $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'stok'             => 'required|integer|min:0',
            'harga'            => 'required|numeric|min:0',
            'kategori'         => 'required|string|max:255',
            'kategori_lainnya' => 'nullable|string|max:255',
            'nama_penjual'     => 'required|string|max:255',
            'kontak_penjual'   => 'required|string|max:30',
            'alamat_penjual'   => 'required|string|max:255',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'link_whatsapp'    => 'nullable|url',
            'link_instagram'   => 'nullable|url',
            'link_tiktok'      => 'nullable|url',
            'link_tokopedia'   => 'nullable|url',
            'link_shopee'      => 'nullable|url',
            'link_facebook'    => 'nullable|url',
        ]);

        // 2️⃣ Ambil data katalog berdasarkan ID
        $katalog = KatalogModels::findOrFail($id);

        // 3️⃣ Tentukan kategori akhir
        $kategoriFinal = $validated['kategori'] === 'Lainnya' && !empty($validated['kategori_lainnya'])
            ? $validated['kategori_lainnya']
            : $validated['kategori'];

        // 4️⃣ Jika ada foto baru, hapus foto lama dan simpan yang baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama (jika ada)
            if ($katalog->foto && Storage::exists('public/' . $katalog->foto)) {
                Storage::delete('public/' . $katalog->foto);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('katalog', 'public');
            $katalog->foto = $fotoPath;
        }

        // 5️⃣ Update semua kolom
        $katalog->update([
            'nama_produk'    => $validated['nama_produk'],
            'deskripsi'      => $validated['deskripsi'],
            'stok'           => $validated['stok'],
            'harga'          => $validated['harga'],
            'kategori'       => $kategoriFinal,
            'nama_penjual'   => $validated['nama_penjual'],
            'kontak_penjual' => $validated['kontak_penjual'],
            'alamat_penjual' => $validated['alamat_penjual'],
            'link_whatsapp'  => $validated['link_whatsapp'] ?? null,
            'link_instagram' => $validated['link_instagram'] ?? null,
            'link_tiktok'    => $validated['link_tiktok'] ?? null,
            'link_tokopedia' => $validated['link_tokopedia'] ?? null,
            'link_shopee'    => $validated['link_shopee'] ?? null,
            'link_facebook'  => $validated['link_facebook'] ?? null,
        ]);

        // 6️⃣ Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data katalog berhasil diperbarui!');
    }

    public function destroy_pkk($id)
    {
        // 🔍 Cari data katalog berdasarkan ID
        $katalog = KatalogModels::findOrFail($id);

        // 🗑️ Hapus foto lama dari storage (jika ada)
        if ($katalog->foto && Storage::disk('public')->exists($katalog->foto)) {
            Storage::disk('public')->delete($katalog->foto);
        }

        // ❌ Hapus data dari database
        $katalog->delete();

        // ✅ Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data katalog berhasil dihapus!');
    }
}
