<?php

namespace App\Observers;

use App\Models\DaftarRisiko;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

class DaftarRisikoObserver
{
    private function simpanLog($model, $aksi, $keterangan) {
        if (Auth::check()) {
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'nama_user' => Auth::user()->name,
                'role_user' => Auth::user()->role,
                'aksi' => $aksi,
                'unit_terkait' => $model->unit_nama,
                'keterangan' => $keterangan
            ]);
        }
    }

    public function created(DaftarRisiko $model) {
        $this->simpanLog($model, 'Tambah Data', "Menambahkan risiko baru: {$model->pernyataan_risiko}");
    }

    public function updated(DaftarRisiko $model) {
        $aksi = 'Update Data';
        $desc = "Memperbarui data : {$model->nama_kegiatan}";

        if ($model->isDirty('status') && $model->status == 'ditindaklanjuti') {
            $aksi = 'Tindak Lanjut';
            $desc = "Melakukan tindak lanjut pada risiko: {$model->pernyataan_risiko}";
        }

        if ($model->isDirty('foto_dokumentasi')) {
            $aksi = 'Upload Dokumentasi';
            $desc = "Mengunggah foto dokumentasi kegiatan untuk unit {$model->unit_nama}";
        }

        $this->simpanLog($model, $aksi, $desc);
    }

    public function deleted(DaftarRisiko $model) {
        $this->simpanLog($model, 'Hapus Data', "Menghapus data risiko dari unit: {$model->unit_nama}");
    }
}