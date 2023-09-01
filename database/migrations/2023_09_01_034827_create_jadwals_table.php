<?php

use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\Ruang;
use App\Models\TahunAjaran;
use App\Models\User;
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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Prodi::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TahunAjaran::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Kelas::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Matakuliah::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Ruang::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamp('tanggal')->nullable();
            $table->string('time', 100)->nullable();
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
        Schema::dropIfExists('jadwals');
    }
};
