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
    $validated = $request->validate([
        'nama_kegiatan' => 'required',
        'tujuan' => 'required',
        'id_risiko' => 'required|array|min:1',
        'pernyataan_risiko' => 'required',
        'sebab' => 'required',
        'dampak' => 'required',
    ]);

    DaftarRisiko::create([
        'nama_kegiatan' => $validated['nama_kegiatan'],
        'tujuan' => $validated['tujuan'],
        'id_risiko' => implode(', ', $validated['id_risiko']),
        'pernyataan_risiko' => $validated['pernyataan_risiko'],
        'sebab' => $validated['sebab'],
        'dampak' => $validated['dampak'],
    ]);

    return redirect()->back()->with('success', 'Data berhasil disimpan');
}
}
