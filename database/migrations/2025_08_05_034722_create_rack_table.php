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
        Schema::create('rack', function (Blueprint $table) {
            $table->string('no_rack', 10)->primary();
            $table->string('kode_region', 10)->nullable();
            $table->string('kode_site', 10);
            $table->integer('u_total');
            $table->unsignedBigInteger('milik')->nullable();

            $table->foreign('kode_region')->references('kode_region')->on('region')->onDelete('cascade');
            $table->foreign('kode_site')->references('kode_site')->on('site')->onDelete('cascade');
            $table->foreign('milik')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rack');
    }
};
