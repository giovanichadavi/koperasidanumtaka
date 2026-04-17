<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarRisiko extends Model
{
    // Memastikan model menggunakan tabel yang benar
    protected $table = 'daftar_risiko';

    /**
     * Jika di database kamu TIDAK ADA kolom created_at dan updated_at, 
     * biarkan ini false. Tapi jika ada, ubah ke true.
     */
    public $timestamps = true; 

    // Mengizinkan pengisian massal untuk semua kolom yang diperlukan
    protected $fillable = [
        'unit_nama',
        'nama_kegiatan',
        'tujuan',
        'id_risiko',
        'pernyataan_risiko',
        'sebab',
        'dampak',
        'uc_c',
        'pengendalian_uraian',
        'desain_a',
        'desain_t',
        'efektivitas_te',
        'efektivitas_ke',
        'efektivitas_e',
        'user_creator',
        'user_updater',
    ];

    /**
     * Tip: Jika kamu ingin memastikan user_creator selalu terisi otomatis 
     * tanpa perlu menulisnya berkali-kali di Controller, 
     * kita bisa menggunakan 'Model Events' di sini.
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->user_creator = auth()->user()->name;
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->user_updater = auth()->user()->name;
            }
        });
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}