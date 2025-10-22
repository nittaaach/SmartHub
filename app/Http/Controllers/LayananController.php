<?php

namespace App\Http\Controllers;

use App\Models\LayananModels;
use App\Models\SyaratLayananModels;
use App\Models\Template_suratModels;
use App\Models\TemplateSuratModels;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    //for show home landing
    public function detaillayanan()
    {
        return view('/detaillayanan');
    }
    
    public function layanan()
<<<<<<< HEAD
=======
    {
        return view('/layanan');
    }
    //for show home landing
    public function index()
>>>>>>> 018bda0b5020705f1fc1e487aa84c67a8e111594
    {
        $layanan = LayananModels::with(['syarat_layanan', 'template_surat'])->get();
        $syarat_layanan = SyaratLayananModels::all();
        $template_surat = TemplateSuratModels::all();

        return view('ketua_rw.layanan', compact('layanan', 'syarat_layanan', 'template_surat'));
    }

    public function store_rw(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status_aktif' => 'required|boolean',
            'id_syarat' => 'required|exists:syarat_layanan,id',
            'id_template' => 'required|exists:template_surat,id',
        ]);

        LayananModels::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'status_aktif' => $request->status_aktif,
            'id_syarat' => $request->id_syarat,
            'id_template' => $request->id_template,
        ]);

        return redirect()->back()->with('success', 'Data layanan berhasil ditambahkan!');
    }

    public function store_st(Request $request)
    {
        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'lembaran' => 'nullable|string|max:50',
            'jenis_berkas' => 'required|boolean',
            'status' => 'required|boolean',
            'nama_template' => 'required|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan ke syarat_layanan
        $syarat = SyaratLayananModels::create([
            'nama_dokumen' => $validated['nama_dokumen'],
            'lembaran' => $validated['lembaran'],
            'jenis_berkas' => $validated['jenis_berkas'],
            'status' => $validated['status'],
        ]);

        // Simpan file template jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('template_surat', 'public');
        }

        // Simpan ke template_surat
        TemplateSuratModels::create([
            'id_syarat' => $syarat->id,
            'nama_template' => $validated['nama_template'],
            'file' => $filePath,
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update_rw(Request $request, $id)
    {
        $layanan = LayananModels::findOrFail($id);

        // --- Update layanan utama ---
        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'status_aktif' => $request->status_aktif,
        ]);

        // --- Update syarat_layanan (jika ada) ---
        if ($layanan->syarat_layanan()->exists()) {
            $layanan->syarat_layanan()->update([
                'nama_dokumen' => $request->nama_dokumen,
                'lembaran' => $request->lembaran,
                'jenis_berkas' => $request->jenis_berkas,
            ]);
        }

        // --- Update template surat (jika ada) ---
        if ($layanan->template_surat()->exists()) {
            $template = $layanan->template_surat()->first();

            // kalau upload file baru
            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('templates', 'public');
                $template->update(['file' => $path]);
            }

            $template->update([
                'nama_template' => $request->nama_template,
                'keterangan' => $request->keterangan,
                'status_aktif' => $request->status_aktif_template,
            ]);
        }

        return redirect()->back()->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy_rw($id)
    {
        $layanan = LayananModels::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus.');
    }

    public function showLayanan()
    {
        return view('/layanan');
    }
}
