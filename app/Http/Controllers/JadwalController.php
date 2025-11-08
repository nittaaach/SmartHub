<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalpkkModels;
use Illuminate\Validation\Rule;
use App\Models\JadwalkatarModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{

    //for jadwal pkk
    public function indexpkk()
    {
        $jadwals = JadwalpkkModels::orderBy('tanggal_mulai', 'desc')->paginate(10);
        return view('pkk.jadwalpkk', [
            'jadwals' => $jadwals
        ]);
    }
    public function store_pkk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'kategori' => 'required|string',
            'kategori_lainnya' => 'nullable|string|max:255|required_if:kategori,Lainnya',
            'target_peserta' => 'required|string',
            'target_lainnya' => 'nullable|string|max:255|required_if:target_peserta,Lainnya',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:150',
            'status' => 'required|string',
            'tanggal_tunda' => 'nullable|date|required_if:status,Ditunda',
            'catatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error_modal', 'AddjadwalModal');
        }

        $kategoriValue = $request->input('kategori');
        if ($kategoriValue == 'Lainnya') {
            $kategoriValue = $request->input('kategori_lainnya');
        }

        $targetPesertaValue = $request->input('target_peserta');
        if ($targetPesertaValue == 'Lainnya') {
            $targetPesertaValue = $request->input('target_lainnya');
        }

        $tanggalTundaValue = null;
        if ($request->input('status') == 'Ditunda') {
            $tanggalTundaValue = $request->input('tanggal_tunda');
        }

        DB::beginTransaction();
        try {
            JadwalpkkModels::create([
                'nama_kegiatan' => $request->input('nama_kegiatan'),
                'kategori' => $kategoriValue,
                'target_peserta' => $targetPesertaValue,
                'deskripsi' => $request->input('deskripsi'),
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'lokasi' => $request->input('lokasi'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'status' => $request->input('status'),
                'tanggal_tunda' => $tanggalTundaValue,
                'catatan' => $request->input('catatan'),
            ]);

            DB::commit();

            return redirect()->route('pkk.jadwalpkk')
                ->with('success', 'Jadwal kegiatan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan jadwal PKK: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan. Data gagal disimpan.')
                ->withInput();
        }
    }
    public function update_pkk(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan'   => 'required|string|max:255',
            'kategori'        => 'required|string|max:255',
            'kategori_lainnya' => 'nullable|string|max:255',
            'target_peserta'  => 'required|string|max:255',
            'target_lainnya'  => 'nullable|string|max:255',
            'deskripsi'       => 'required|string',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi'          => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'status'          => ['required', Rule::in(['Terjadwal', 'Berlangsung', 'Selesai', 'Dibatalkan', 'Ditunda'])],
            'tanggal_tunda'   => 'required_if:status,Ditunda|nullable|date',
            'catatan'         => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui data, periksa kembali isian Anda.');
        }

        try {
            $jadwal = JadwalpkkModels::findOrFail($id); 
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data jadwal tidak ditemukan.');
        }

        $kategori = $request->input('kategori');
        if ($kategori === 'Lainnya') {
            $kategori = $request->input('kategori_lainnya');
        }

        $target_peserta = $request->input('target_peserta');
        if ($target_peserta === 'Lainnya') {
            $target_peserta = $request->input('target_lainnya');
        }

        $tanggal_tunda = $request->input('tanggal_tunda');
        if ($request->input('status') !== 'Ditunda') {
            $tanggal_tunda = null;
        }

        try {
            $jadwal->update([
                'nama_kegiatan'   => $request->input('nama_kegiatan'),
                'kategori'        => $kategori, 
                'target_peserta'  => $target_peserta, 
                'deskripsi'       => $request->input('deskripsi'),
                'tanggal_mulai'   => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'lokasi'          => $request->input('lokasi'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'status'          => $request->input('status'),
                'tanggal_tunda'   => $tanggal_tunda, 
                'catatan'         => $request->input('catatan'),
            ]);

            return redirect()->back()->with('success', 'Jadwal kegiatan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
    public function destroy_pkk($id)
    {
        try {
            $jadwal = JadwalpkkModels::findOrFail($id);
            $jadwal->delete();

            return redirect()->back()->with('success', 'Jadwal kegiatan berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data jadwal tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    //for jadwal katar
    public function indexkatar()
    {       
        $jadwals = JadwalkatarModels::orderBy('tanggal_mulai', 'desc')->paginate(10);
        return view('katar.jadwalkatar', [
            'jadwals' => $jadwals
        ]);
    }

    public function store_katar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'kategori' => 'required|string',
            'kategori_lainnya' => 'nullable|string|max:255|required_if:kategori,Lainnya',
            'target_peserta' => 'required|string',
            'target_lainnya' => 'nullable|string|max:255|required_if:target_peserta,Lainnya',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:150',
            'status' => 'required|string',
            'tanggal_tunda' => 'nullable|date|required_if:status,Ditunda',
            'catatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error_modal', 'AddjadwalModal');
        }

        $kategoriValue = $request->input('kategori');
        if ($kategoriValue == 'Lainnya') {
            $kategoriValue = $request->input('kategori_lainnya');
        }

        $targetPesertaValue = $request->input('target_peserta');
        if ($targetPesertaValue == 'Lainnya') {
            $targetPesertaValue = $request->input('target_lainnya');
        }

        $tanggalTundaValue = null;
        if ($request->input('status') == 'Ditunda') {
            $tanggalTundaValue = $request->input('tanggal_tunda');
        }

        DB::beginTransaction();
        try {
            JadwalkatarModels::create([
                'nama_kegiatan' => $request->input('nama_kegiatan'),
                'kategori' => $kategoriValue,
                'target_peserta' => $targetPesertaValue,
                'deskripsi' => $request->input('deskripsi'),
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'lokasi' => $request->input('lokasi'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'status' => $request->input('status'),
                'tanggal_tunda' => $tanggalTundaValue,
                'catatan' => $request->input('catatan'),
            ]);

            DB::commit();

            return redirect()->route('katar.jadwalkatar')
                ->with('success', 'Jadwal kegiatan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan jadwal PKK: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan. Data gagal disimpan.')
                ->withInput();
        }
    }

    public function update_katar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan'   => 'required|string|max:255',
            'kategori'        => 'required|string|max:255',
            'kategori_lainnya' => 'nullable|string|max:255',
            'target_peserta'  => 'required|string|max:255',
            'target_lainnya'  => 'nullable|string|max:255',
            'deskripsi'       => 'required|string',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi'          => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'status'          => ['required', Rule::in(['Terjadwal', 'Berlangsung', 'Selesai', 'Dibatalkan', 'Ditunda'])],
            'tanggal_tunda'   => 'required_if:status,Ditunda|nullable|date',
            'catatan'         => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui data, periksa kembali isian Anda.');
        }

        try {
            $jadwal = JadwalkatarModels::findOrFail($id); 
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data jadwal tidak ditemukan.');
        }

        $kategori = $request->input('kategori');
        if ($kategori === 'Lainnya') {
            $kategori = $request->input('kategori_lainnya');
        }

        $target_peserta = $request->input('target_peserta');
        if ($target_peserta === 'Lainnya') {
            $target_peserta = $request->input('target_lainnya');
        }

        $tanggal_tunda = $request->input('tanggal_tunda');
        if ($request->input('status') !== 'Ditunda') {
            $tanggal_tunda = null;
        }

        try {
            $jadwal->update([
                'nama_kegiatan'   => $request->input('nama_kegiatan'),
                'kategori'        => $kategori, 
                'target_peserta'  => $target_peserta, 
                'deskripsi'       => $request->input('deskripsi'),
                'tanggal_mulai'   => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'lokasi'          => $request->input('lokasi'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'status'          => $request->input('status'),
                'tanggal_tunda'   => $tanggal_tunda, 
                'catatan'         => $request->input('catatan'),
            ]);

            return redirect()->back()->with('success', 'Jadwal kegiatan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy_katar($id)
    {
        try {
            $jadwal = JadwalkatarModels::findOrFail($id);
            $jadwal->delete();

            return redirect()->back()->with('success', 'Jadwal kegiatan berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data jadwal tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
