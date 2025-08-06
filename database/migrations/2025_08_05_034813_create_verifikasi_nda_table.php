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
        Schema::create('verifikasi_nda', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('site_id');
            $table->foreign('site_id')->references('id_site')->on('site')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('tipe_jaringan_id', 10);
            $table->foreign('tipe_jaringan_id')->references('kode_tipejaringan')->on('tipejaringan')->onDelete('cascade');
            $table->date('tanggal_verifikasi');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_nda');
    }
};
