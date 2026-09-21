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
        Schema::create('earthquakes', function (Blueprint $table) {
            $table->id();
            $table->string('tgl');             // Tanggal kejadian
            $table->string('jam');             // Jam kejadian
            $table->dateTime('datetime');      // Gabungan tgl & jam untuk sorting
            $table->string('coordinates');     // Lintang, Bujur
            $table->string('magnitude');
            $table->string('kedalaman');
            $table->string('wilayah');
            $table->string('potensi');
            $table->string('dirasakan')->nullable();
            $table->string('shakemap')->nullable(); // Nama file gambar dr BMKG
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earthquakes');
    }
};
