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
        Schema::table('angkets', function (Blueprint $table) {
            $table->enum('kondisi', ['sebelum_lihat_nilai', 'setelah_login'])->nullable();
            $table->json('kondisi_detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('angkets', function (Blueprint $table) {
            //
        });
    }
};
