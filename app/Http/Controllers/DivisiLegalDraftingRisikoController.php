<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarRisiko;
use Carbon\Carbon; // Tambahkan ini

class DivisiLegalDraftingRisikoController extends Controller
{
    private function checkRole()
    {
        if (auth()->user()->role !== 'divisi_legal_drafting') {
            abort(403, 'Akses ditolak');
        }
    }

    public function index()
    {
        $this->checkRole();

        // MENGAMBIL DATA UNTUK NOTIFIKASI FEEDBACK ADMIN
        $alerts = DaftarRisiko::where('unit_nama', 'Divisi Legal Drafting')
            ->whereNotNull('feedback_admin')
            ->where('feedback_admin', '!=', '')
            ->get();

        $risiko = DaftarRisiko::where('unit_nama', 'Divisi Legal Drafting')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Tambahkan 'alerts' ke dalam compact
        return view('divisi_legal_drafting_risiko.daftar_risiko', compact('risiko', 'alerts'));
    }

    public function create()
    {
        $this->checkRole();
        return view('divisi_legal_drafting_risiko.tambah_risiko');
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

        $risiko = new DaftarRisiko();
        $risiko->unit_nama = 'Divisi Legal Drafting';
        $risiko->nama_kegiatan = $validated['nama_kegiatan'];
        $risiko->tujuan = $validated['tujuan'];
        $risiko->id_risiko = implode(', ', $validated['id_risiko']);
        $risiko->pernyataan_risiko = $validated['pernyataan_risiko'];
        $risiko->dampak = $validated['dampak'];
        $risiko->pengendalian_uraian = $validated['pengendalian_uraian'];
        $risiko->sebab = $validated['sebab'];
        $risiko->uc_c = $validated['uc_c'];
        $risiko->desain_a = $request->has('desain_a');
        $risiko->desain_t = $request->has('desain_t');
        $risiko->efektivitas_te = $request->has('efektivitas_te');
        $risiko->efektivitas_ke = $request->has('efektivitas_ke');
        $risiko->efektivitas_e = $request->has('efektivitas_e');
        
        $risiko->user_creator = auth()->user()->name; 

        $risiko->save();

        return redirect()
            ->route('divisi_legal_drafting.risiko.index')
            ->with('success', 'Data risiko berhasil ditambahkan oleh ' . auth()->user()->name);
    }

    public function edit($id)
    {
        $this->checkRole();
        $risiko = DaftarRisiko::findOrFail($id);
        return view('divisi_legal_drafting_risiko.edit_risiko', compact('risiko'));
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

        $risiko->nama_kegiatan = $validated['nama_kegiatan'];
        $risiko->tujuan = $validated['tujuan'];
        $risiko->id_risiko = implode(', ', $validated['id_risiko']);
        $risiko->pernyataan_risiko = $validated['pernyataan_risiko'];
        $risiko->dampak = $validated['dampak'];
        $risiko->pengendalian_uraian = $validated['pengendalian_uraian'];
        $risiko->sebab = $validated['sebab'];
        $risiko->uc_c = $validated['uc_c'];
        $risiko->desain_a = $request->has('desain_a');
        $risiko->desain_t = $request->has('desain_t');
        $risiko->efektivitas_te = $request->has('efektivitas_te');
        $risiko->efektivitas_ke = $request->has('efektivitas_ke');
        $risiko->efektivitas_e = $request->has('efektivitas_e');
        
        $risiko->user_updater = auth()->user()->name;

        // LANGKAH NO 2: Menghapus feedback agar notifikasi hilang setelah diperbaiki
        $risiko->feedback_admin = null;

        $risiko->save();

        return redirect()
            ->route('divisi_legal_drafting.risiko.index')
            ->with('success', 'Data risiko berhasil diperbarui dan feedback admin telah diselesaikan.');
    }

    public function destroy($id)
    {
        $this->checkRole();
        $risiko = DaftarRisiko::findOrFail($id);
        $risiko->delete();

        return redirect()
            ->route('divisi_legal_drafting.risiko.index')
            ->with('success', 'Data risiko berhasil dihapus');
    }
}