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
        Schema::create('historijaringan', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('id_jaringan')->nullable();
            $table->string('kode_region', 10)->nullable();
            $table->string('kode_tipejaringan', 10)->nullable();
            $table->string('segmen', 20)->nullable();
            $table->string('jartatup_jartaplok', 20)->nullable();
            $table->string('mainlink_backuplink', 20)->nullable();
            $table->string('panjang', 20)->nullable();
            $table->string('panjang_drawing', 20)->nullable();
            $table->string('jumlah_core', 20)->nullable();
            $table->string('jenis_kabel', 20)->nullable();
            $table->string('tipe_kabel', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('kode_site_insan', 10)->nullable();
            $table->string('dci_eqx', 20)->nullable();
            $table->string('travelling_time', 20)->nullable();
            $table->string('verification_time', 20)->nullable();
            $table->string('restoration_time', 20)->nullable();
            $table->string('total_corrective_time', 20)->nullable();
            $table->unsignedBigInteger('milik')->nullable();
            $table->text('histori')->nullable();
            $table->timestamp('tanggal_perubahan')->now();

            $table->foreign('id_jaringan')->references('id_jaringan')->on('listjaringan')->onDelete('cascade');
            $table->foreign('kode_region')->references('kode_region')->on('region')->onDelete('cascade');
            $table->foreign('kode_tipejaringan')->references('kode_tipejaringan')->on('tipejaringan')->onDelete('cascade');
            $table->foreign('milik')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historijaringan');
    }
};
