<?php

use App\Models\Jadwal;
use App\Models\Krs;
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
        Schema::create('jadwal_krs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Jadwal::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Krs::class)->nullable()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('jadwal_krs');
    }
};
