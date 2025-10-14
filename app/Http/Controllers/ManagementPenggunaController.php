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
            'role' => 'required|exists:drole,id',
            'notelp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

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

        // 3. Simpan ke tabel role
        RoleModels::create([
            'id_users' => $user->id,
            'id_datadiri' => $datadiri->id,
            'id_drole' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_rw(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'notelp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'role' => 'required|exists:drole,id',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $user->update($userData);


        // Hanya update password kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();


        // 2️⃣ Update ke tabel datadiri
        $datadiri = DataDiriModels::where('id_users', $user->id)->first();
        if ($datadiri) {
            $datadiri->update([
                'name' => $request->name,
                'email' => $request->email,
                'notelp' => $request->notelp,
                'alamat' => $request->alamat,
            ]);
        }

        // 3️⃣ Update ke tabel role
        DB::table('role')
            ->where('id_users', $user->id)
            // Tambahkan kondisi lain jika ada lebih dari satu baris per user di tabel role
            ->update([
                'id_drole' => $request->role,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    public function destroy_rw($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('role')->where('id_users', $id)->delete();
        DB::table('datadiri')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
