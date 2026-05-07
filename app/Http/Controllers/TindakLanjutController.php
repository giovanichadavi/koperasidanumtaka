<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarRisiko; // Pastikan nama Model Anda benar
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TindakLanjutController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mengambil daftar unit kerja unik untuk dropdown filter
        $units = DaftarRisiko::select('unit_nama')->distinct()->pluck('unit_nama');

        // 2. Menangkap filter dari request
        $activeUnit = $request->unit;
        $search = $request->search;

        // 3. Query data (Hanya data yang sudah ditindaklanjuti)
        $risiko = DaftarRisiko::whereNotNull('keputusan_penanganan') // Filter data sudah ditindaklanjuti
            ->when($activeUnit, function ($query, $activeUnit) {
                return $query->where('unit_nama', $activeUnit);
            })
            ->when($search, function ($query, $search) {
                return $query->where('id_risiko', 'like', "%{$search}%")
                             ->orWhere('nama_kegiatan', 'like', "%{$search}%");
            })
            ->paginate(10);

        // 4. Kirim semua variabel ke view
        return view('tindak_lanjut.daftar_tindak_lanjut', compact('units', 'risiko', 'activeUnit'));
    }

    public function update(Request $request, $id)
{
    // Validasi Input
    $request->validate([
        'tanggal_pelaksanaan' => 'required|date',
        'foto_dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $risiko = DaftarRisiko::findOrFail($id);

    // Update Tanggal
    $risiko->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;

    // Proses Upload Foto jika ada
    if ($request->hasFile('foto_dokumentasi')) {
        // Hapus foto lama jika ada
        if ($risiko->foto_dokumentasi) {
            Storage::disk('public')->delete($risiko->foto_dokumentasi);
        }

        // Simpan foto baru ke folder 'public/dokumentasi'
        $path = $request->file('foto_dokumentasi')->store('dokumentasi', 'public');
        $risiko->foto_dokumentasi = $path;
    }

    $risiko->save();

    return redirect()->back()->with('success', 'Dokumentasi tindak lanjut berhasil diperbarui!');
}
}