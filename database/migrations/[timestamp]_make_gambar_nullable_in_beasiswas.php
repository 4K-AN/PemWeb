<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            $table->string('gambar')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            $table->string('gambar')->nullable(false)->change();
        });
    }
};
