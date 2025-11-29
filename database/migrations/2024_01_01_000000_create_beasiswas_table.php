<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('universitas');
            $table->string('jenis_beasiswa', 100)->nullable();
            $table->string('kategori')->nullable();
            $table->string('negara');
            $table->string('status', 50)->nullable();
            $table->date('deadline')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('link_pendaftaran')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswas');
    }
};
