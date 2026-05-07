<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarRisiko;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class TindakLanjutKegiatanController extends Controller
{
    // 1. Menampilkan Daftar di Web
    public function index(Request $request)
    {
        $units = DaftarRisiko::select('unit_nama')->distinct()->pluck('unit_nama');
        $activeUnit = $request->unit;
        $search = $request->search;

        $risiko = DaftarRisiko::whereNotNull('keputusan_penanganan')
            ->when($activeUnit, function ($query, $activeUnit) {
                return $query->where('unit_nama', $activeUnit);
            })
            ->when($search, function ($query, $search) {
                return $query->where('nama_kegiatan', 'like', "%{$search}%")
                             ->orWhere('id_risiko', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tindak_lanjut.daftar_tindak_lanjut', compact('units', 'risiko', 'activeUnit'));
    }

    // 2. Update Tanggal dan Foto (Aksi Tombol)
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pelaksanaan' => 'required|date',
            'foto_dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $risiko = DaftarRisiko::findOrFail($id);
        $risiko->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;

        if ($request->hasFile('foto_dokumentasi')) {
            if ($risiko->foto_dokumentasi) {
                Storage::disk('public')->delete($risiko->foto_dokumentasi);
            }
            $path = $request->file('foto_dokumentasi')->store('dokumentasi', 'public');
            $risiko->foto_dokumentasi = $path;
        }

        $risiko->save();
        return redirect()->back()->with('success', 'Data kegiatan berhasil diperbarui!');
    }

    // 3. Export PDF
    public function exportPdf(Request $request)
{
    $unit = $request->unit;
    $search = $request->search;

    $query = \App\Models\DaftarRisiko::query();

    // Filter agar hanya data tindak lanjut yang muncul
    $query->whereNotNull('keputusan_penanganan');

    if ($unit) $query->where('unit_nama', $unit);
    if ($search) {
        $query->where('nama_kegiatan', 'like', "%$search%");
    }

    $risiko = $query->orderBy('created_at', 'desc')->get();

    // Memanggil file: resources/views/tindak_lanjut/tindak_lanjut_pdf.blade.php
    $pdf = \Pdf::loadView('tindak_lanjut.tindak_lanjut_pdf', compact('risiko', 'unit'))
              ->setPaper([0, 0, 935, 1247], 'landscape');

    return $pdf->download('laporan_tindak_lanjut.pdf');
}
}