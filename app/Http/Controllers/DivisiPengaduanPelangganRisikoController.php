<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarRisiko;

class DivisiUmumRisikoController extends Controller
{
    private function checkRole()
    {
        if (auth()->user()->role !== 'divisi_pengaduan_pelanggan') {
            abort(403, 'Akses ditolak');
        }
    }

    public function index()
    {
        $this->checkRole();

        $risiko = DaftarRisiko::where('unit_nama', 'Divisi Pengaduan Pelanggan')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('divisi_pengaduan_pelanggan_risiko.daftar_risiko', compact('risiko'));
    }

    public function create()
    {
        $this->checkRole();
        return view('divisi_pengaduan_pelanggan_risiko.tambah_risiko');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required',
            'tujuan' => 'required',
            'pernyataan_risiko' => 'required',
            'dampak' => 'required',
            'pengendalian_uraian' => 'required',
            'id_risiko' => 'required|array|min:1',
            'sebab' => 'required',
            'uc_c' => 'required',
        ], [
            'required' => ':attribute wajib diisi!',
            'id_risiko.required' => 'Pilih minimal satu jenis risiko!',
        ]);

        DaftarRisiko::create([
            'unit_nama' => 'Divisi Pengaduan Pelanggan',
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tujuan' => $validated['tujuan'],
            'id_risiko' => implode(', ', $validated['id_risiko']),
            'pernyataan_risiko' => $validated['pernyataan_risiko'],
            'dampak' => $validated['dampak'],
            'pengendalian_uraian' => $validated['pengendalian_uraian'],
            'sebab' => $validated['sebab'],
            'uc_c' => $validated['uc_c'],
            'desain_a' => $request->has('desain_a'),
            'desain_t' => $request->has('desain_t'),
            'efektivitas_te' => $request->has('efektivitas_te'),
            'efektivitas_ke' => $request->has('efektivitas_ke'),
            'efektivitas_e' => $request->has('efektivitas_e'),
        ]);

        return redirect()
            ->route('divisi_pengaduan_pelanggan.risiko.index')
            ->with('success', 'Data risiko berhasil ditambahkan');
    }

    public function edit($id)
    {
        $this->checkRole();
        $risiko = DaftarRisiko::findOrFail($id);
        return view('divisi_pengaduan_pelanggan_risiko.edit_risiko', compact('risiko'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required',
            'tujuan' => 'required',
            'pernyataan_risiko' => 'required',
            'dampak' => 'required',
            'pengendalian_uraian' => 'required',
            'id_risiko' => 'required|array|min:1',
            'sebab' => 'required',
            'uc_c' => 'required',
        ], [
            'required' => ':attribute wajib diisi!',
            'id_risiko.required' => 'Pilih minimal satu jenis risiko!',
        ]);

        $risiko = DaftarRisiko::findOrFail($id);

        $risiko->update([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tujuan' => $validated['tujuan'],
            'id_risiko' => implode(', ', $validated['id_risiko']),
            'pernyataan_risiko' => $validated['pernyataan_risiko'],
            'dampak' => $validated['dampak'],
            'pengendalian_uraian' => $validated['pengendalian_uraian'],
            'sebab' => $validated['sebab'],
            'uc_c' => $validated['uc_c'],
            'desain_a' => $request->has('desain_a'),
            'desain_t' => $request->has('desain_t'),
            'efektivitas_te' => $request->has('efektivitas_te'),
            'efektivitas_ke' => $request->has('efektivitas_ke'),
            'efektivitas_e' => $request->has('efektivitas_e'),
        ]);

        return redirect()
            ->route('divisi_pengaduan_pelanggan.risiko.index')
            ->with('success', 'Data risiko berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->checkRole();
        $risiko = DaftarRisiko::findOrFail($id);
        $risiko->delete();

        return redirect()
            ->route('divisi_pengaduan_pelanggan.risiko.index')
            ->with('success', 'Data risiko berhasil dihapus');
    }
}