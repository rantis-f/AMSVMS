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
        Schema::create('site', function (Blueprint $table) {
            $table->increments('id_site');
            $table->string('kode_site', 10)->unique();
            $table->string('nama_site', 50);
            $table->string('jenis_site', 50)->nullable();
            $table->string('kode_region', 10);
            $table->foreign('kode_region')->references('kode_region')->on('region')->onDelete('cascade');
            $table->integer('jml_rack')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site');
    }
};
