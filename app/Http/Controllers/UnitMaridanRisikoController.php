<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarRisiko;

class UnitMaridanRisikoController extends Controller
{
    private function checkRole()
    {
        if (auth()->user()->role !== 'unit_maridan') {
            abort(403, 'Akses ditolak');
        }
    }

    // ======================
    // 1️⃣ DAFTAR RISIKO
    // ======================
    public function index()
    {
        $this->checkRole();

        $risiko = DaftarRisiko::where('unit_nama', 'Unit Maridan')
        ->orderBy('created_at', 'desc')
                ->paginate(5);

        return view('unit_maridan_risiko.daftar_risiko', compact('risiko'));
    }

    // ======================
    // 2️⃣ TAMBAH RISIKO
    // ======================
    public function create()
    {
        $this->checkRole();
        return view('unit_maridan_risiko.tambah_risiko');
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
        'uc_c' => 'required',
        'pengendalian_uraian' => 'required',
    ]);

    DaftarRisiko::create([
        'unit_nama' => 'Unit Maridan',
        'nama_kegiatan' => $validated['nama_kegiatan'],
        'tujuan' => $validated['tujuan'],
        'id_risiko' => implode(', ', $validated['id_risiko']),
        'pernyataan_risiko' => $validated['pernyataan_risiko'],
        'sebab' => $validated['sebab'],
        'dampak' => $validated['dampak'],
        'uc_c' => $validated['uc_c'],
        'pengendalian_uraian' => $validated['pengendalian_uraian'],

        'desain_a' => $request->has('desain_a'),
        'desain_t' => $request->has('desain_t'),
        'efektivitas_te' => $request->has('efektivitas_te'),
        'efektivitas_ke' => $request->has('efektivitas_ke'),
        'efektivitas_e' => $request->has('efektivitas_e'),
    ]);

    return redirect()
        ->route('unit_maridan.risiko.index')
        ->with('success', 'Data risiko berhasil ditambahkan');
}

    // ======================
    // 3️⃣ EDIT RISIKO
    // ======================
    public function edit($id)
    {
        $this->checkRole();

        $risiko = DaftarRisiko::findOrFail($id);

        return view('unit_maridan_risiko.edit_risiko', compact('risiko'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama_kegiatan' => 'required',
        'tujuan' => 'required',
        'id_risiko' => 'required|array|min:1',
        'pernyataan_risiko' => 'required',
        'sebab' => 'required',
        'dampak' => 'required',
        'uc_c' => 'required',
        'pengendalian_uraian' => 'required',
    ]);

    $risiko = DaftarRisiko::findOrFail($id);

    $risiko->update([
        'nama_kegiatan' => $validated['nama_kegiatan'],
        'tujuan' => $validated['tujuan'],
        'id_risiko' => implode(', ', $validated['id_risiko']),
        'pernyataan_risiko' => $validated['pernyataan_risiko'],
        'sebab' => $validated['sebab'],
        'dampak' => $validated['dampak'],
        'uc_c' => $validated['uc_c'],
        'pengendalian_uraian' => $validated['pengendalian_uraian'],

        'desain_a' => $request->has('desain_a'),
        'desain_t' => $request->has('desain_t'),
        'efektivitas_te' => $request->has('efektivitas_te'),
        'efektivitas_ke' => $request->has('efektivitas_ke'),
        'efektivitas_e' => $request->has('efektivitas_e'),
    ]);

    return redirect()
        ->route('unit_maridan.risiko.index')
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
            ->route('unit_maridan.risiko.index')
            ->with('success', 'Data risiko berhasil dihapus');
    }
}