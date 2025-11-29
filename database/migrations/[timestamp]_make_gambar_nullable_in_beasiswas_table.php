<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            // Ubah kolom gambar menjadi nullable jika sudah ada
            if (Schema::hasColumn('beasiswas', 'gambar')) {
                $table->string('gambar')->nullable()->change();
            } else {
                // Tambahkan kolom gambar jika belum ada
                $table->string('gambar')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            if (Schema::hasColumn('beasiswas', 'gambar')) {
                $table->string('gambar')->nullable(false)->change();
            }
        });
    }
};
