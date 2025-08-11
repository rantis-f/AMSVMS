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
        Schema::create('historifasilitas', function (Blueprint $table) {
            $table->increments('id_histori');
            $table->integer('id_fasilitas')->nullable();
            $table->string('kode_region', 10)->nullable();
            $table->string('kode_site', 10)->nullable();
            $table->string('no_rack', 10)->nullable();
            $table->string('kode_fasilitas', 10)->nullable();
            $table->integer('fasilitas_ke')->nullable();
            $table->string('kode_brand', 10)->nullable();
            $table->string('type', 20)->nullable();
            $table->string('serialnumber', 25)->nullable();
            $table->integer('jml_fasilitas')->nullable();
            $table->string('status', 20)->nullable();
            $table->integer('uawal')->nullable();
            $table->integer('uakhir')->nullable();
            $table->unsignedBigInteger('milik')->nullable();
            $table->text('histori');
            $table->timestamp('tanggal_perubahan')->now();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historifasilitas');
    }
};
