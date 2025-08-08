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
        Schema::table('rack', function (Blueprint $table) {
            $table->unsignedInteger('id_fasilitas')->nullable()->after('u');
            $table->unsignedInteger('id_perangkat')->nullable()->after('id_fasilitas');

            $table->timestamps();
            $table->foreign('id_fasilitas')->references('id_fasilitas')->on('listfasilitas')->onDelete('cascade');
            $table->foreign('id_perangkat')->references('id_perangkat')->on('listperangkat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rack', function (Blueprint $table) {
            $table->dropForeign(['id_fasilitas']);
            $table->dropForeign(['id_perangkat']);     
    
            $table->dropColumn(['id_fasilitas', 'id_perangkat', 'created_at', 'updated_at']);
        });
    }
};
