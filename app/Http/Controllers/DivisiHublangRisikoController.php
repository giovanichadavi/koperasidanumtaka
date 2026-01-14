<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarRisiko;

class DivisiHublangRisikoController extends Controller
{
    private function checkRole()
    {
        if (auth()->user()->role !== 'divisi_hublang') {
            abort(403, 'Akses ditolak');
        }
    }

    // ======================
    // 1️⃣ DAFTAR RISIKO
    // ======================
    public function index()
    {
        $this->checkRole();

        $risiko = DaftarRisiko::where('unit_nama', 'Divisi Hublang')->get();

        return view('divisi_hublang_risiko.daftar_risiko', compact('risiko'));
    }

    // ======================
    // 2️⃣ TAMBAH RISIKO
    // ======================
    public function create()
    {
        $this->checkRole();
        return view('divisi_Hublang_risiko.tambah_risiko');
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
            'unit_nama' => 'Divisi Hublang',
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tujuan' => $validated['tujuan'],
            'id_risiko' => implode(', ', $validated['id_risiko']),
            'pernyataan_risiko' => $validated['pernyataan_risiko'],
            'sebab' => $validated['sebab'],
            'dampak' => $validated['dampak'],
        ]);

        return redirect()
            ->route('divisi_hublang.risiko.index')
            ->with('success', 'Data risiko berhasil ditambahkan');
    }

    // ======================
    // 3️⃣ EDIT RISIKO
    // ======================
    public function edit($id)
    {
        $this->checkRole();

        $risiko = DaftarRisiko::findOrFail($id);

        return view('divisi_hublang_risiko.edit_risiko', compact('risiko'));
    }

    public function update(Request $request, $id)
    {
        $this->checkRole();

        $validated = $request->validate([
            'nama_kegiatan' => 'required',
            'tujuan' => 'required',
            'id_risiko' => 'required|array|min:1',
            'pernyataan_risiko' => 'required',
            'sebab' => 'required',
            'dampak' => 'required',
        ]);

        $risiko = DaftarRisiko::findOrFail($id);

        $risiko->update([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tujuan' => $validated['tujuan'],
            'id_risiko' => implode(', ', $validated['id_risiko']),
            'pernyataan_risiko' => $validated['pernyataan_risiko'],
            'sebab' => $validated['sebab'],
            'dampak' => $validated['dampak'],
        ]);

        return redirect()
            ->route('divisi_hublang.risiko.index')
            ->with('success', 'Data risiko berhasil diperbarui');
    }

    // ======================
    // 4️⃣ HAPUS RISIKO
    // ======================
    public function destroy($id)
    {
        $this->checkRole();

        $risiko = DaftarRisiko::findOrFail($id);
        $risiko->delete();

        return redirect()
            ->route('divisi_hublang.risiko.index')
            ->with('success', 'Data risiko berhasil dihapus');
    }
}