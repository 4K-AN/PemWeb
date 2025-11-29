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
        });

        // Modify kolom yang sudah ada untuk memastikan nullable dan size yang benar
        Schema::table('beasiswas', function (Blueprint $table) {
            // Gunakan raw SQL untuk modify kolom yang sudah ada
            \DB::statement('ALTER TABLE `beasiswas` MODIFY `gambar` VARCHAR(255) NULL');
            \DB::statement('ALTER TABLE `beasiswas` MODIFY `status` VARCHAR(50) NULL');
            \DB::statement('ALTER TABLE `beasiswas` MODIFY `jenjang` VARCHAR(50) NULL');
            \DB::statement('ALTER TABLE `beasiswas` MODIFY `ipk_minimal` DECIMAL(3,2) NULL');
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
