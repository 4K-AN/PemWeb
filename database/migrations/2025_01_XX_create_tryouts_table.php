<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tryouts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tryout');
            $table->text('deskripsi');
            $table->string('penyelenggara');
            $table->string('kategori'); // UTBK, SBMPTN, Mandiri, dll
            $table->date('tanggal_pelaksanaan');
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('lokasi')->nullable(); // Online/Offline
            $table->decimal('biaya', 10, 2)->default(0);
            $table->string('link_pendaftaran')->nullable();
            $table->date('deadline_pendaftaran')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tryouts');
    }
};
