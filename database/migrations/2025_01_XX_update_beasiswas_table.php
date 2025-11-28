<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            if (!Schema::hasColumn('beasiswas', 'kategori')) {
                $table->string('kategori')->after('deskripsi')->nullable(); // S1, S2, S3, dll
            }
            if (!Schema::hasColumn('beasiswas', 'negara')) {
                $table->string('negara')->after('kategori')->default('Indonesia');
            }
            if (!Schema::hasColumn('beasiswas', 'deadline')) {
                $table->date('deadline')->after('negara')->nullable();
            }
            if (!Schema::hasColumn('beasiswas', 'is_active')) {
                $table->boolean('is_active')->after('deadline')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'negara', 'deadline', 'is_active']);
        });
    }
};
