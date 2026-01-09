<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['admin','user','divisi_umum','divisi_hublang',
        'divisi_kepegawaian','divisi humas','divisi hukum','divisi_perencanaan_anggaran','divisi_pembukuan,
        divisi_kas_penagihan','unit_lawe_lawe','unit_sepaku','unit_waru','unit_sotek','unit_maridan','unit_babulu',
        'divisi_laboratorium'])
                    ->paginate(5); 
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status'=> $request->status,
            

        ]);

        return redirect()->route('users.index')
            ->with('success','Admin berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required'
        ]);

        $data = $request->only('name','email','role');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success','Admin berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success','Admin berhasil dihapus');
    }
    public function toggleStatus($id)
    {
    $user = User::findOrFail($id);

    $user->status = $user->status == 'aktif'
        ? 'tidak_aktif'
        : 'aktif';

    $user->save();

    return back()->with('success', 'Status user berhasil diubah');
    }
}
