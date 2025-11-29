<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            // Tambahkan kolom jika belum ada
            if (!Schema::hasColumn('beasiswas', 'jenis_beasiswa')) {
                $table->string('jenis_beasiswa', 100)->nullable();
            }
            if (!Schema::hasColumn('beasiswas', 'jenjang')) {
                $table->string('jenjang', 50)->nullable();
            }
            if (!Schema::hasColumn('beasiswas', 'gambar')) {
                $table->string('gambar')->nullable();
            }

            // Ubah kolom yang sudah ada menjadi nullable dan perbesar ukurannya
            if (Schema::hasColumn('beasiswas', 'status')) {
                $table->string('status', 50)->nullable()->change();
            }
            if (Schema::hasColumn('beasiswas', 'ipk_minimal')) {
                $table->decimal('ipk_minimal', 3, 2)->nullable()->change();
            }
        });
    }

    public function down()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            $columns = ['jenis_beasiswa', 'jenjang'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('beasiswas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
