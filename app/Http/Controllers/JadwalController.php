<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalpkkModels;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
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
        // 1. Validasi Input
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

        // Jika validasi gagal, kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui data, periksa kembali isian Anda.');
        }

        // 2. Cari Data Jadwal
        try {
            $jadwal = JadwalpkkModels::findOrFail($id); // <-- Sesuaikan nama model
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data jadwal tidak ditemukan.');
        }

        // 3. Logika untuk Kategori "Lainnya"
        $kategori = $request->input('kategori');
        if ($kategori === 'Lainnya') {
            // Ambil dari input 'kategori_lainnya' jika "Lainnya" dipilih
            $kategori = $request->input('kategori_lainnya');
        }

        // 4. Logika untuk Target Peserta "Lainnya"
        $target_peserta = $request->input('target_peserta');
        if ($target_peserta === 'Lainnya') {
            // Ambil dari input 'target_lainnya' jika "Lainnya" dipilih
            $target_peserta = $request->input('target_lainnya');
        }

        // 5. Logika untuk Tanggal Tunda
        $tanggal_tunda = $request->input('tanggal_tunda');
        if ($request->input('status') !== 'Ditunda') {
            // Hapus tanggal_tunda jika status BUKAN "Ditunda"
            $tanggal_tunda = null;
        }

        // 6. Update Data ke Database
        try {
            $jadwal->update([
                'nama_kegiatan'   => $request->input('nama_kegiatan'),
                'kategori'        => $kategori, // Gunakan variabel yang sudah diproses
                'target_peserta'  => $target_peserta, // Gunakan variabel yang sudah diproses
                'deskripsi'       => $request->input('deskripsi'),
                'tanggal_mulai'   => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'lokasi'          => $request->input('lokasi'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'status'          => $request->input('status'),
                'tanggal_tunda'   => $tanggal_tunda, // Gunakan variabel yang sudah diproses
                'catatan'         => $request->input('catatan'),
            ]);

            // 7. Redirect dengan Pesan Sukses
            return redirect()->back()->with('success', 'Jadwal kegiatan berhasil diperbarui!');
        } catch (\Exception $e) {
            // Tangani jika ada error saat update database
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
}
