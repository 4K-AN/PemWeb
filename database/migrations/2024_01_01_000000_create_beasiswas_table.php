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
            $table->string('jurusan');
            $table->string('universitas');
            $table->enum('status', ['Dalam Negeri', 'Luar Negeri']);
            $table->enum('jenjang', ['S1', 'S2', 'S3']);
            $table->decimal('ipk_minimal', 3, 2);
            $table->text('deskripsi');
            $table->string('gambar');
            $table->boolean('is_popular')->default(false);
            $table->date('deadline');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswas');
    }
};