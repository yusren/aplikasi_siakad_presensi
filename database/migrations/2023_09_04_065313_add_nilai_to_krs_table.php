<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->string('nilai_tugas', 100)->nullable()->default(0);
            $table->string('nilai_uts', 100)->nullable()->default(0);
            $table->string('nilai_uas', 100)->nullable()->default(0);
            $table->string('nilai_keaktifan', 100)->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('krs', function (Blueprint $table) {
            //
        });
    }
};
