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
        $table->tinyInteger('dampak')->nullable();
        $table->tinyInteger('probabilitas')->nullable();
        $table->integer('nilai_risiko')->nullable();
        $table->string('level_risiko')->nullable();
        $table->text('uraian_pengendalian')->nullable();
        $table->date('jadwal_pengendalian')->nullable();
        $table->string('penanggung_jawab')->nullable();
        $table->string('status')->default('baru');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_risiko', function (Blueprint $table) {
            //
        });
    }
};
