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
        Schema::table('matakuliahs', function (Blueprint $table) {
            $table->foreignIdFor(Prodi::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('sks', 100)->nullable();
            $table->string('semester', 100)->nullable();
            $table->enum('kategori', ['wajib', 'pilihan'])->nullable()->default('wajib');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matakuliahs', function (Blueprint $table) {
            //
        });
    }
};
