<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tryouts')) {
            Schema::create('tryouts', function (Blueprint $table) {
                $table->id();
                $table->string('nama_tryout');
                $table->text('deskripsi')->nullable();
                $table->string('penyelenggara');
                $table->string('kategori');
                $table->date('tanggal_pelaksanaan');
                $table->time('waktu_mulai')->nullable();
                $table->time('waktu_selesai')->nullable();
                $table->string('lokasi');
                $table->decimal('biaya', 10, 2)->default(0);
                $table->string('link_pendaftaran')->nullable();
                $table->date('deadline_pendaftaran')->nullable();
                $table->boolean('dengan_pembahasan')->default(false)->comment('Apakah tryout menyediakan pembahasan soal');
                $table->boolean('dengan_sertifikat')->default(false)->comment('Apakah tryout menyediakan sertifikat');
                $table->boolean('dengan_ranking')->default(false)->comment('Apakah tryout menyediakan ranking nasional');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('tryouts');
    }
};
