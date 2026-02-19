<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AkunController extends Controller
{
    public function index()
    {
        return view('akun.index');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'password_lama.required' => 'Password lama wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }
}