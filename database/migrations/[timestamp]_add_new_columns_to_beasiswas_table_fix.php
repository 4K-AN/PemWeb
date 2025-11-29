<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            // Tambahkan kolom tanpa after (akan ditambahkan di akhir tabel)
            if (!Schema::hasColumn('beasiswas', 'jenis_beasiswa')) {
                $table->string('jenis_beasiswa')->nullable();
            }
            if (!Schema::hasColumn('beasiswas', 'jenjang')) {
                $table->string('jenjang')->nullable();
            }
            if (!Schema::hasColumn('beasiswas', 'benefit_biaya_kuliah')) {
                $table->boolean('benefit_biaya_kuliah')->default(false);
            }
            if (!Schema::hasColumn('beasiswas', 'benefit_biaya_hidup')) {
                $table->boolean('benefit_biaya_hidup')->default(false);
            }
            if (!Schema::hasColumn('beasiswas', 'benefit_tiket_pesawat')) {
                $table->boolean('benefit_tiket_pesawat')->default(false);
            }
            if (!Schema::hasColumn('beasiswas', 'benefit_asuransi')) {
                $table->boolean('benefit_asuransi')->default(false);
            }
        });
    }

    public function down()
    {
        Schema::table('beasiswas', function (Blueprint $table) {
            $columns = [
                'jenis_beasiswa',
                'jenjang',
                'benefit_biaya_kuliah',
                'benefit_biaya_hidup',
                'benefit_tiket_pesawat',
                'benefit_asuransi'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('beasiswas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
