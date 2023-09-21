<?php

use App\Models\Prodi;
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
            // $table->foreignIdFor(Prodi::class)->nullable()->constrained()->cascadeOnDelete();
            $table->json('prodi')->nullable();
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
