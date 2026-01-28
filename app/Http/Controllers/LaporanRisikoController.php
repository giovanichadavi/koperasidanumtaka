<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarRisiko;
use App\Models\Unit;
use App\Models\Kegiatan;

class LaporanRisikoController extends Controller
{
    public function index(Request $request)
    {
        $units = DaftarRisiko::select('unit_nama')
            ->distinct()
            ->orderBy('unit_nama')
            ->pluck('unit_nama');

        $activeUnit = $request->get('unit', $units->first());

        $risiko = DaftarRisiko::where('unit_nama', $activeUnit)
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('laporan.daftar_risiko', compact(
            'units',
            'activeUnit',
            'risiko'
        ));
    }

    public function create()
    {
        $units = Unit::all();
        $kegiatan = Kegiatan::all();

        return view('laporan.tambah_risiko', compact('units','kegiatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_nama' => 'required',
            'nama_kegiatan' => 'required',
            'tujuan' => 'required',
            'id_risiko' => 'required|array|min:1',
            'pernyataan_risiko' => 'required',
            'sebab' => 'required',
            'dampak' => 'required',
            'uc_c' => 'required',
            'pengendalian_uraian' => 'required',
            'desain_a' => 'required',
            'desain_t' => 'required',
            'efektivitas_te' => 'required',
            'efektivitas_ke' => 'required',
            'efektivitas_e' => 'required',
        ]);

        DaftarRisiko::create([
            'unit_nama' => $validated['unit_nama'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tujuan' => $validated['tujuan'],
            'id_risiko' => implode(', ', $validated['id_risiko']),
            'pernyataan_risiko' => $validated['pernyataan_risiko'],
            'sebab' => $validated['sebab'],
            'dampak' => $validated['dampak'],
            'uc_c' => $validated['uc_c'],
            'pengendalian_uraian' => $validated['pengendalian_uraian'],
            'desain_a' => $validated['desain_a'],
            'desain_t' => $validated['desain_'],
            'efektivitas_te' => $validated['efektivitas_te'],
            'efektivitas_ke' => $validated['efektivitas_ke'],
            'efektivitas_e' => $validated['efektivitas_e'],
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    // ✅ INI YANG KAMU BELUM ADA
public function tindakLanjut(Request $request)
{
    $request->validate([
        'risiko_ids' => 'required|array|min:1'
    ]);

    // Ambil satu ID (karena form tindak lanjut per risiko)
    $id = $request->risiko_ids[0];

    // PINDAH HALAMAN ke form tindak lanjut
    return redirect()->route('laporan.risiko.tindak_lanjut.form', $id);
}

    // kalau mau lanjut ke form detail tindak lanjut
    public function formTindakLanjut($id)
{
    $risiko = DaftarRisiko::findOrFail($id);
    return view('laporan.tindak_lanjut', compact('risiko'));
}
    public function simpanTindakLanjut(Request $request, $id)
{
    $request->validate([
        'dampak' => 'required|integer|min:1|max:5',
        'probabilitas' => 'required|integer|min:1|max:5',
        'uraian_pengendalian' => 'required',
        'jadwal_pengendalian' => 'required|date',
        'penanggung_jawab' => 'required'
    ]);

    $nilai = $request->dampak * $request->probabilitas;

    // tentukan level
    if (in_array($nilai, [1,2,3,5,7,8])) {
        $level = 'Rendah';
    } elseif (in_array($nilai, [4,10,11,13,20])) {
        $level = 'Moderat';
    } elseif (in_array($nilai, [6,12,14,16,17,21])) {
        $level = 'Tinggi';
    } else {
        $level = 'Ekstrim';
    }

    DaftarRisiko::where('id', $id)->update([
        'dampak' => $request->dampak,
        'probabilitas' => $request->probabilitas,
        'nilai_risiko' => $nilai,
        'level_risiko' => $level,
        'uraian_pengendalian' => $request->uraian_pengendalian,
        'jadwal_pengendalian' => $request->jadwal_pengendalian,
        'penanggung_jawab' => $request->penanggung_jawab,
        'status' => 'ditindaklanjuti'
    ]);

    return redirect()->back()->with('success','Tindak lanjut berhasil disimpan');
}
}