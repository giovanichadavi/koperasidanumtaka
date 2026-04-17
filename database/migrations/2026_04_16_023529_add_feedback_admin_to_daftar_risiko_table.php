<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('daftar_risiko', function (Illuminate\Database\Schema\Blueprint $table) {
        // Menambahkan kolom feedback_admin setelah kolom pengendalian_uraian
        $table->text('feedback_admin')->nullable()->after('pengendalian_uraian');
    });
}

public function down(): void
{
    Schema::table('daftar_risiko', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->dropColumn('feedback_admin');
    });
}
};
