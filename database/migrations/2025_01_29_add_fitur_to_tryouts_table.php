<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tryouts', function (Blueprint $table) {
            // Tambah kolom fitur untuk tryout
            if (!Schema::hasColumn('tryouts', 'dengan_pembahasan')) {
                $table->boolean('dengan_pembahasan')->default(false)->after('biaya')
                    ->comment('Apakah tryout menyediakan pembahasan soal');
            }
            if (!Schema::hasColumn('tryouts', 'dengan_sertifikat')) {
                $table->boolean('dengan_sertifikat')->default(false)->after('dengan_pembahasan')
                    ->comment('Apakah tryout memberikan sertifikat');
            }
            if (!Schema::hasColumn('tryouts', 'dengan_ranking')) {
                $table->boolean('dengan_ranking')->default(false)->after('dengan_sertifikat')
                    ->comment('Apakah tryout menampilkan ranking peserta');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tryouts', function (Blueprint $table) {
            $table->dropColumn(['dengan_pembahasan', 'dengan_sertifikat', 'dengan_ranking']);
        });
    }
};
