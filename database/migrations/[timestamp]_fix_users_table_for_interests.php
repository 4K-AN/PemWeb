<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom interests_talents tanpa 'after'
            if (!Schema::hasColumn('users', 'interests_talents')) {
                $table->text('interests_talents')->nullable()->comment('Deskripsi minat dan bakat siswa');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'interests_talents')) {
                $table->dropColumn('interests_talents');
            }
        });
    }
};
