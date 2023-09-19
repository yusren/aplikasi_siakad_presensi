<?php

use App\Models\Matakuliah;
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
            $table->json('prodi')->nullable();
            $table->foreignIdFor(Matakuliah::class)->nullable()->constrained()->cascadeOnDelete();
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
