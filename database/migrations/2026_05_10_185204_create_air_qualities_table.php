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
        Schema::create('air_qualities', function (Blueprint $table) {
            $table->id();
            $table->string('station_name');
            $table->integer('aqi_value'); 
            $table->string('pm25')->nullable();             // Konsentrasi PM2.5
            $table->string('category');           // Baik, Sedang, Tidak Sehat, dsb
            $table->dateTime('measured_at');      // Waktu pengukuran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_qualities');
    }
};
