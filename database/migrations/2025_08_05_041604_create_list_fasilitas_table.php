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
        Schema::create('listfasilitas', function (Blueprint $table) {
            $table->increments('id_fasilitas');
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

            $table->foreign('kode_region')->references('kode_region')->on('region')->onDelete('set null');
            $table->foreign('kode_site')->references('kode_site')->on('site')->onDelete('set null');
            $table->foreign('no_rack')->references('no_rack')->on('rack')->onDelete('set null');
            $table->foreign('kode_fasilitas')->references('kode_fasilitas')->on('jenisfasilitas')->onDelete('set null');
            $table->foreign('kode_brand')->references('kode_brand')->on('brandfasilitas')->onDelete('set null');
            $table->foreign('milik')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listfasilitas');
    }
};
