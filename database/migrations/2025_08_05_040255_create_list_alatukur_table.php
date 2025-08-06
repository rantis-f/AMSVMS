<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listalatukur', function (Blueprint $table) {
$table->id('id_alatukur');
            $table->string('kode_region', 10)->nullable();
            $table->string('kode_alatukur', 10)->nullable();
            $table->string('kode_brand', 10)->nullable();
            $table->string('type', 50)->nullable();
            $table->string('serialnumber', 50)->nullable();
            $table->string('alatukur_ke', 10)->nullable();
            $table->integer('tahunperolehan')->nullable();
            $table->string('kondisi', 20)->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('milik')->nullable();

            $table->foreign('kode_region')->references('kode_region')->on('region')->onDelete('set null');
            $table->foreign('kode_alatukur')->references('kode_alatukur')->on('jenisalatukur')->onDelete('set null');
            $table->foreign('kode_brand')->references('kode_brand')->on('brandalatukur')->onDelete('set null');
            $table->foreign('milik')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listalatukur');
    }
};
