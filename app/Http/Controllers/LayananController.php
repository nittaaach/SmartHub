<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananModels;
use Illuminate\Support\Facades\DB;
use App\Models\SyaratLayananModels;
use App\Models\TemplateSuratModels;
use App\Models\Template_suratModels;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
{
    //for show home landing
    public function detaillayanan()
    {
        return view('/detaillayanan');
    }

    public function layanan()
    {
        return view('/layanan');
    }
    //for show home landing
    public function index()
    {
        $layanan = LayananModels::with(['syaratLayanans'])->get();
        $syarat_layanan = SyaratLayananModels::all();
        // $template_surat = TemplateSuratModels::all();

        return view('ketua_rw.layanan', compact('layanan', 'syarat_layanan'));
    }

    public function store_rw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status_aktif' => 'required|in:0,1',
            'id_syarat' => 'required|array',
            'id_syarat.*' => 'exists:syarat_layanan,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $layanan = new LayananModels();
            $layanan->nama_layanan = $request->nama_layanan;
            $layanan->deskripsi = $request->deskripsi;
            $layanan->status_aktif = $request->status_aktif;
            $layanan->save();
            $layanan->syaratLayanans()->attach($request->id_syarat);

            DB::commit();
            return redirect()->back()->with('success', 'Layanan baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }

    public function store_st(Request $request)
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
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status_aktif' => 'required|boolean',
            'id_syarat' => 'required|array',
            'id_syarat.*' => 'exists:syarat_layanan,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $layanan = LayananModels::findOrFail($id);
            $layanan->update([
                'nama_layanan' => $request->nama_layanan,
                'deskripsi' => $request->deskripsi,
                'status_aktif' => $request->status_aktif,
            ]);

            $layanan->syaratLayanans()->sync($request->id_syarat);

            DB::commit();
            return redirect()->back()->with('success', 'Layanan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
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
