<?php

namespace App\Http\Controllers;

// use Log;
use App\Models\User;
use App\Models\RoleModels;
use App\Models\DroleModels;
use Illuminate\Http\Request;
use App\Models\DataDiriModels;
use App\Models\StrukturalModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ManagementPenggunaController extends Controller
{
    public function index()
    {
        // $management = User::leftJoin('datadiri', 'datadiri.id_users', '=', 'users.id')
        //     ->leftJoin('role', 'role.id_users', '=', 'users.id')
        //     ->leftJoin('drole', 'drole.id', '=', 'role.id_drole')
        //     ->select(
        //         'users.id',
        //         'users.email',
        //         'users.password',
        //         'users.created_at',
        //         'datadiri.name',
        //         'datadiri.notelp',
        //         'datadiri.alamat',
        //         'role.id_drole',
        //         'drole.role'
        //     )
        //     ->get();

        $datadiri = DataDiriModels::all();
        $struktural = StrukturalModels::all();
        $drole = DroleModels::all();
        // $management = User::with(['datadiri', 'userRolePivot.drole'])->get();
        $management = User::with(['datadiri', 'userRolePivot.drole'])->withoutTrashed()->get();

        return view('ketua_rw.management_pengguna', compact('management', 'datadiri', 'struktural', 'drole'));
    }

    public function store_rw(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'nullable|exists:drole,id', // role tidak wajib
            'notelp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        // 1. Simpan ke tabel users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        // 2. Simpan ke tabel datadiri
        $datadiri = DataDiriModels::create([
            'id_users' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'alamat' => $request->alamat,
        ]);

        // 3. Simpan ke tabel role hanya jika diisi
        if ($request->filled('role')) {
            RoleModels::create([
                'id_users' => $user->id,
                'id_datadiri' => $datadiri->id,
                'id_drole' => $request->role,
            ]);
        }

        return redirect()->back()->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    public function update_rw(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'nullable|exists:drole,id',
            'notelp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);

        $datadiri = DataDiriModels::where('id_users', $id)->first();
        if ($datadiri) {
            $datadiri->update([
                'name' => $request->name,
                'email' => $request->email,
                'notelp' => $request->notelp,
                'alamat' => $request->alamat,
            ]);
        }

        // Update atau tambahkan role jika diisi
        if ($request->filled('role')) {
            $existingRole = RoleModels::where('id_users', $id)->first();

            if ($existingRole) {
                $existingRole->update([
                    'id_drole' => $request->role,
                ]);
            } else {
                RoleModels::create([
                    'id_users' => $user->id,
                    'id_datadiri' => $datadiri->id,
                    'id_drole' => $request->role,
                ]);
            }
        }

        // Jika role tidak diisi dan sebelumnya ada, biarkan tetap atau bisa hapus tergantung kebutuhan:
        // RoleModels::where('id_users', $id)->delete();

        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy_rw($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('role')->where('id_users', $id)->delete();
        DB::table('datadiri')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
