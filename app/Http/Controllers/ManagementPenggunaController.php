<?php

namespace App\Http\Controllers;

use App\Models\DataDiriModels;
use App\Models\StrukturalModels;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementPenggunaController extends Controller
{
    public function index()
    {
        $management = User::all();
        return view('ketua_rw.management_pengguna', compact('management'));
    }

    public function store_rw(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'perempuan' => 'required',
            'created_at' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'created_at' => $request->created_at
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_rw(Request $request, $id)
    {
        $ktprw12 = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'created_at' => 'required',
        ]);

        $ktprw12->update([
            'name' => $request->name,
            'email' => $request->laki_laki,
            'password' => $request->password,
            'created_at' => $request->created_at
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $management = User::findOrFail($id);
        $management->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
