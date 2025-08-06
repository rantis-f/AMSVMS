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
        Schema::create('perlengkapan_vms', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('site_id');
            $table->foreign('site_id')->references('id_site')->on('site')->onDelete('cascade');
            $table->string('nama_perlengkapan');
            $table->string('merek')->nullable();
            $table->string('tipe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perlengkapan_vms');
    }
};
