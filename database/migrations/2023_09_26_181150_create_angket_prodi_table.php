<?php

use App\Models\Angket;
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
        Schema::create('angket_prodi', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Angket::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Prodi::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angket_prodi');
    }
};
