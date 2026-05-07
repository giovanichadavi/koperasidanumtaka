<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('daftar_risiko', function (Blueprint $table) {
        // Menambahkan kolom setelah penanggung_jawab
        $table->date('tanggal_pelaksanaan')->nullable()->after('penanggung_jawab');
        $table->string('foto_dokumentasi')->nullable()->after('tanggal_pelaksanaan');
    });
}

public function down()
{
    Schema::table('daftar_risiko', function (Blueprint $table) {
        $table->dropColumn(['tanggal_pelaksanaan', 'foto_dokumentasi']);
    });
}
};
