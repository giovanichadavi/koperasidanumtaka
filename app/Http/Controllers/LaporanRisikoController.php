<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DaftarRisiko;
use App\Models\Unit;
use App\Models\Kegiatan;


class LaporanRisikoController extends Controller
{
    public function index()
    {
        $risiko = DaftarRisiko::with(['unit','kegiatan'])->get();
        return view('laporan.daftar_risiko', compact('risiko'));
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
    ]);

    DaftarRisiko::create([
        'unit_nama' => $validated['unit_nama'],
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