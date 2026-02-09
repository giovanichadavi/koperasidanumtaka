<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarRisiko;
use App\Models\Unit;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanRisikoController extends Controller
{
    // ==============================
    // DAFTAR RISIKO (AWAL)
    // ==============================
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

    // ==============================
    // FORM TAMBAH RISIKO
    // ==============================
    public function create()
    {
        $units = Unit::all();
        $kegiatan = Kegiatan::all();

        return view('laporan.tambah_risiko', compact('units','kegiatan'));
    }

    // ==============================
    // SIMPAN RISIKO BARU
    // ==============================
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
            'desain_t' => $validated['desain_t'],
            'efektivitas_te' => $validated['efektivitas_te'],
            'efektivitas_ke' => $validated['efektivitas_ke'],
            'efektivitas_e' => $validated['efektivitas_e'],
            'status' => null
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    // ==============================
    // PROSES KLIK "TINDAK LANJUT"
    // ==============================
    public function tindakLanjut(Request $request)
    {
        $request->validate([
            'risiko_ids' => 'required|array|min:1'
        ]);

        $id = $request->risiko_ids[0];

        return redirect()->route('laporan.risiko.tindaklanjut.form', $id);
    }

    // ==============================
    // FORM TINDAK LANJUT
    // ==============================
    public function formTindakLanjut($id, Request $request)
    {
    $risiko = DaftarRisiko::findOrFail($id);
    $unit = $request->unit; // simpan unit aktif
    return view('laporan.tindak_lanjut', compact('risiko','unit'));
    }

    // ==============================
    // SIMPAN TINDAK LANJUT
    // ==============================
public function simpanTindakLanjut(Request $request, $id)
{
    $request->validate([
        'dampak_risiko' => 'required|integer|min:1|max:5',
        'probabilitas' => 'required|integer|min:1|max:5',
        'rencana_pengendalian' => 'required',
        'jadwal_pengendalian' => 'required|date',
        'penanggung_jawab' => 'required|array|min:1'
    ]);

    $matrix = [
        1 => [1=>1, 2=>3, 3=>5, 4=>8, 5=>20],
        2 => [1=>2, 2=>7, 3=>11, 4=>13, 5=>21],
        3 => [1=>4, 2=>10, 3=>14, 4=>17, 5=>22],
        4 => [1=>6, 2=>12, 3=>16, 4=>19, 5=>24],
        5 => [1=>9, 2=>15, 3=>18, 4=>23, 5=>25],
    ];

    $nilai = $matrix[$request->dampak_risiko][$request->probabilitas];

    if (in_array($nilai, [1,2,3,5,7,8])) {
        $level = 'Rendah';
        $warna = 'success';
    } elseif (in_array($nilai, [4,10,11,13,20])) {
        $level = 'Moderat';
        $warna = 'warning';
    } elseif (in_array($nilai, [6,12,14,16,17,21])) {
        $level = 'Tinggi';
        $warna = 'orange';
    } else {
        $level = 'Ekstrim';
        $warna = 'danger';
    }

    DaftarRisiko::where('id', $id)->update([
        'probabilitas' => $request->probabilitas,
        'dampak_risiko' => $request->dampak_risiko,
        'nilai_risiko' => $nilai,
        'tingkat_risiko' => $nilai,
        'level_risiko' => $level,
        'warna_risiko' => $warna,
        'rencana_pengendalian' => $request->rencana_pengendalian,
        'jadwal_pengendalian' => $request->jadwal_pengendalian,
        'penanggung_jawab' => implode(', ', $request->penanggung_jawab),
        'status' => 'ditindaklanjuti'
    ]);


    return redirect()->route('laporan.daftar_risiko.index', [
        'unit' => $request->unit
    ])->with('success','Tindak lanjut berhasil disimpan');
    }
public function exportPdf(Request $request)
{
    $unit = $request->unit;
    $page = $request->page ?? 1;

    $risiko = DaftarRisiko::where('unit_nama', $unit)
        ->orderBy('created_at','desc')
        ->paginate(5, ['*'], 'page', $page);

    $pdf = Pdf::loadView('laporan.daftar_risiko_pdf', compact('risiko','unit'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('laporan_risiko_'.$unit.'_halaman_'.$page.'.pdf');
}
public function hapus($id)
{
    DaftarRisiko::findOrFail($id)->delete();

    return redirect()->back()->with('success','Data risiko berhasil dihapus');
}
}