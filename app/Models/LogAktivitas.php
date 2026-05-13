<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'nama_user',
        'role_user',
        'aksi',
        'unit_terkait',
        'keterangan',
    ];

    // Relasi ke User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
