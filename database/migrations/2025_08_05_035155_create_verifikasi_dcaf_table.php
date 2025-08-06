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
        Schema::create('verifikasidcaf', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('verifikasi_nda_id')->constrained('verifikasinda')->onDelete('cascade');
            $table->string('file_path')->nullable();
            $table->string('status')->default('pending'); 
            $table->text('catatan')->nullable();
            $table->timestamp('masaberlaku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasidcaf');
    }
};
