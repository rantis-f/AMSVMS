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
        Schema::create('verifikasinda', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedInteger('site_id');
            $table->foreign('site_id')->references('id_site')->on('site')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('tipe_jaringan_id', 10);
            $table->foreign('tipe_jaringan_id')->references('kode_tipejaringan')->on('tipejaringan')->onDelete('cascade');         
            $table->date('tanggal_verifikasi')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('masaberlaku')->nullable(); 
            $table->string('file_path')->nullable();
            $table->text('signature')->nullable();
            $table->unsignedBigInteger('signed_by')->nullable();
            $table->foreign('signed_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasinda');
    }
};
