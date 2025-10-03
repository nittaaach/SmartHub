<?php

namespace App\Http\Controllers;

use App\Models\KtpModels;
use App\Models\NonktpModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatistikController extends Controller
{
    public function index()
    {
        $data_ktp = KtpModels::all();
        $data_nonktp = NonktpModels::all();

        return view('ketua_rw.statispend', compact('data_ktp', 'data_nonktp'));
    }


    public function store_ktp(Request $request)
    {
        $request->validate([
            'rt' => 'required',
            'laki_laki' => 'required',
            'perempuan' => 'required',
            'jumlah_kk' => 'required',
        ]);

        KtpModels::create([
            'rt' => $request->rt,
            'laki_laki' => $request->laki_laki,
            'perempuan' => $request->perempuan,
            'jumlah_kk' => $request->jumlah_kk
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_ktp(Request $request, $id)
    {
        $ktprw12 = KtpModels::findOrFail($id);

        $request->validate([
            'rt' => 'required',
            'laki_laki' => 'required',
            'perempuan' => 'required',
            'jumlah_kk' => 'required',
        ]);

        $ktprw12->update([
            'rt' => $request->rt,
            'laki_laki' => $request->laki_laki,
            'perempuan' => $request->perempuan,
            'jumlah_kk' => $request->jumlah_kk
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    public function store_nonktp(Request $request)
    {
        $request->validate([
            'rt' => 'required',
            'laki_laki' => 'required',
            'perempuan' => 'required',
            'jumlah_kk' => 'required',
        ]);

        NonktpModels::create([
            'rt' => $request->rt,
            'laki_laki' => $request->laki_laki,
            'perempuan' => $request->perempuan,
            'jumlah_kk' => $request->jumlah_kk
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_nonktp(Request $request, $id)
    {
        $ktprw12 = NonktpModels::findOrFail($id);

        $request->validate([
            'rt' => 'required',
            'laki_laki' => 'required',
            'perempuan' => 'required',
            'jumlah_kk' => 'required',
        ]);

        $ktprw12->update([
            'rt' => $request->rt,
            'laki_laki' => $request->laki_laki,
            'perempuan' => $request->perempuan,
            'jumlah_kk' => $request->jumlah_kk
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }
}
