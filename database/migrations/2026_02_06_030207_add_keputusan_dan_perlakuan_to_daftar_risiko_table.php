<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('daftar_risiko', function (Blueprint $table) {
            $table->string('keputusan_penanganan')->nullable()->after('level_risiko');
            $table->string('perlakuan_risiko')->nullable()->after('keputusan_penanganan');
        });
    }

    public function down()
    {
        Schema::table('daftar_risiko', function (Blueprint $table) {
            $table->dropColumn('keputusan_penanganan');
            $table->dropColumn('perlakuan_risiko');
        });
    }
};