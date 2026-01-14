<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DaftarRisiko;

class DivisiUmumRisikoController extends Controller
{
    private function checkRole()
    {
        if (auth()->user()->role !== 'divisi_umum') {
            abort(403, 'Akses ditolak');
        }
    }

    public function index()
    {
        $this->checkRole();
        return view('divisi_umum_risiko.daftar_risiko');
    }

    public function create()
    {
        $this->checkRole();
        return view('divisi_umum_risiko.tambah_risiko');
    }


    public function store(Request $request)
    {
        DaftarRisiko::create([
            'unit_nama' => 'Divisi Umum',
            'pernyataan_risiko' => $request->pernyataan_risiko,
            'sebab' => $request->sebab,
            'dampak' => $request->dampak,
        ]);

        return redirect()->back()->with('success','Data berhasil disimpan');
    }
}
