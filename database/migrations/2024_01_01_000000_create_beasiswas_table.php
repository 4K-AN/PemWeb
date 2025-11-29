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
            $table->string('kategori')->nullable(); // Kolom kategori ditambahkan
            $table->string('negara');
            $table->string('status', 50)->nullable();
            $table->date('deadline')->nullable();
            $table->decimal('ipk_minimal', 3, 2)->nullable();
            $table->string('jurusan')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswas');
    }
};
