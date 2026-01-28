<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daftar_risiko', function (Blueprint $table) {

            // UC / C
            $table->enum('uc_c', ['UC', 'C'])
                  ->nullable()
                  ->after('sebab');

            // Pengendalian
            $table->text('pengendalian_uraian')
                  ->nullable()
                  ->after('dampak');

            // Desain
            $table->string('desain_a', 50)
                  ->nullable()
                  ->after('pengendalian_uraian');

            $table->string('desain_t', 50)
                  ->nullable()
                  ->after('desain_a');

            // Efektivitas (checkbox)
            $table->boolean('efektivitas_te')
                  ->default(false)
                  ->after('desain_t');

            $table->boolean('efektivitas_ke')
                  ->default(false)
                  ->after('efektivitas_te');

            $table->boolean('efektivitas_e')
                  ->default(false)
                  ->after('efektivitas_ke');
        });
    }

    public function down(): void
    {
        Schema::table('daftar_risiko', function (Blueprint $table) {
            $table->dropColumn([
                'uc_c',
                'pengendalian_uraian',
                'desain_a',
                'desain_t',
                'efektivitas_te',
                'efektivitas_ke',
                'efektivitas_e',
            ]);
        });
    }
};