<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarRisiko extends Model
{
    protected $table = 'daftar_risiko';
    public $timestamps = false;
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
        ];



    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}