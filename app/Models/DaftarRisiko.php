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
        'id_risiko',
        'pernyataan_risiko',
        'sebab',
        'dampak'
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