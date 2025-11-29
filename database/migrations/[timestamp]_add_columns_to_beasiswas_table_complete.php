<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            // Tambahkan kolom yang diperlukan jika belum ada
            if (!Schema::hasColumn('beasiswas', 'jenis_beasiswa')) {
                $table->string('jenis_beasiswa')->nullable();
            }
            if (!Schema::hasColumn('beasiswas', 'jenjang')) {
                $table->string('jenjang')->nullable();
            }
            if (!Schema::hasColumn('beasiswas', 'gambar')) {
                $table->string('gambar')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            $columns = ['jenis_beasiswa', 'jenjang', 'gambar'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('beasiswas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
