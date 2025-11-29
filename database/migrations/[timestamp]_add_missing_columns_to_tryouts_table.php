<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tryouts', function (Blueprint $table) {
            if (!Schema::hasColumn('tryouts', 'dengan_pembahasan')) {
                $table->boolean('dengan_pembahasan')->default(false);
            }
            if (!Schema::hasColumn('tryouts', 'dengan_sertifikat')) {
                $table->boolean('dengan_sertifikat')->default(false);
            }
            if (!Schema::hasColumn('tryouts', 'dengan_ranking')) {
                $table->boolean('dengan_ranking')->default(false);
            }
        });
    }

    public function down()
    {
        Schema::table('tryouts', function (Blueprint $table) {
            if (Schema::hasColumn('tryouts', 'dengan_pembahasan')) {
                $table->dropColumn('dengan_pembahasan');
            }
            if (Schema::hasColumn('tryouts', 'dengan_sertifikat')) {
                $table->dropColumn('dengan_sertifikat');
            }
            if (Schema::hasColumn('tryouts', 'dengan_ranking')) {
                $table->dropColumn('dengan_ranking');
            }
        });
    }
};
