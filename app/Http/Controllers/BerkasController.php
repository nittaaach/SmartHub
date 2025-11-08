<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananModels;
use App\Models\SyaratLayananModels;
use App\Models\TemplateSuratModels;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function index()
    {
        // Ambil semua data syarat layanan beserta relasinya (template surat)
        $syarat_layanan = SyaratLayananModels::with('template_surat')
            ->orderBy('id', 'desc')
            ->get();

        // Ambil semua layanan untuk dropdown di modal "Tambah Berkas"
        $layanan = LayananModels::orderBy('nama_layanan', 'asc')->get();

        // Kirim ke view
        return view('ketua_rw.berkas', compact('syarat_layanan', 'layanan'));
    }


    public function store_rw(Request $request)
    // {
    //     $validated = $request->validate([
    //         'nama_dokumen' => 'required|string|max:255',
    //         'lembaran' => 'nullable|string|max:50',
    //         'jenis_berkas' => 'required|boolean',
    //         'status' => 'required|boolean',
    //         'nama_template' => 'required|string|max:100',
    //         'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    //         'keterangan' => 'nullable|string',
    //     ]);

    //     // Simpan ke syarat_layanan
    //     $syarat = SyaratLayananModels::create([
    //         'nama_dokumen' => $validated['nama_dokumen'],
    //         'lembaran' => $validated['lembaran'],
    //         'jenis_berkas' => $validated['jenis_berkas'],
    //         'status' => $validated['status'],
    //     ]);

    //     // Simpan file template jika ada
    //     $filePath = null;
    //     if ($request->hasFile('file')) {
    //         $filePath = $request->file('file')->store('template_surat', 'public');
    //     }

    //     // Simpan ke template_surat
    //     TemplateSuratModels::create([
    //         'id_syarat' => $syarat->id,
    //         'nama_template' => $validated['nama_template'],
    //         'file' => $filePath,
    //         'keterangan' => $validated['keterangan'] ?? null,
    //     ]);

    //     return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    // }
    {
        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'lembaran' => 'nullable|string|max:50',
            'jenis_berkas' => 'required|boolean',
            'status' => 'required|boolean',
            'nama_template' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $syarat = SyaratLayananModels::create([
            'nama_dokumen' => $validated['nama_dokumen'],
            'lembaran' => $validated['lembaran'],
            'jenis_berkas' => $validated['jenis_berkas'],
            'status' => $validated['status'],
        ]);

        if ($request->filled('nama_template')) {

            $filePath = null;
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('template_surat', 'public');
            }

            TemplateSuratModels::create([
                'id_syarat' => $syarat->id,
                'nama_template' => $validated['nama_template'],
                'file' => $filePath,
                'keterangan' => $validated['keterangan'] ?? null,
            ]);
        }
        return redirect()->back()->with('success', 'Data syarat layanan berhasil ditambahkan!');
    }

    public function update_rw(Request $request, $id)
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

        // ambil data syarat berdasarkan id
        $syarat = SyaratLayananModels::findOrFail($id);

        // update syarat_layanan
        $syarat->update([
            'nama_dokumen' => $validated['nama_dokumen'],
            'lembaran' => $validated['lembaran'],
            'jenis_berkas' => $validated['jenis_berkas'],
            'status' => $validated['status'],
        ]);

        // ambil template terkait
        $template = $syarat->template_surat()->first();

        // kalau template belum ada (misal sebelumnya kosong)
        if (!$template) {
            $template = new TemplateSuratModels();
            $template->id_syarat = $syarat->id;
        }

        // kalau upload file baru
        if ($request->hasFile('file')) {
            // hapus file lama (kalau ada)
            if ($template->file && Storage::disk('public')->exists($template->file)) {
                Storage::disk('public')->delete($template->file);
            }

            $filePath = $request->file('file')->store('template_surat', 'public');
            $template->file = $filePath;
        }

        // update data lainnya
        $template->nama_template = $validated['nama_template'];
        $template->keterangan = $validated['keterangan'] ?? null;
        // $template->status = $validated['status'];

        $template->save();

        return redirect()->back()->with('success', 'Data berkas berhasil diperbarui!');
    }

    public function destroy_rw($id)
    {
        $syarat = SyaratLayananModels::findOrFail($id);

        // Hapus file template jika ada
        $template = $syarat->template_surat()->first();
        if ($template && $template->file && Storage::disk('public')->exists($template->file)) {
            Storage::disk('public')->delete($template->file);
        }

        // Hapus syarat (relasi template akan terhapus otomatis karena onDelete cascade)
        $syarat->delete();

        return redirect()->back()->with('success', 'Data berkas berhasil dihapus!');
    }
}
