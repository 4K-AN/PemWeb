<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Ubah kolom gambar menjadi nullable
        \DB::statement('ALTER TABLE `beasiswas` MODIFY `gambar` VARCHAR(255) NULL');
    }

    public function down()
    {
        \DB::statement('ALTER TABLE `beasiswas` MODIFY `gambar` VARCHAR(255) NOT NULL');
    }
};
