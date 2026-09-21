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
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->string('area_id');         // ID Area dari BMKG (misal: 501580 untuk TJS)
            $table->string('area_name');       // Nama wilayah
            $table->dateTime('analysis_time'); // Waktu rilis data dari BMKG
            $table->dateTime('forecast_time'); // Waktu prakiraan (valid at)
            $table->integer('temp_c');         // Parameter: t
            $table->integer('humidity');       // Parameter: hu
            $table->integer('weather_code');   // Kode icon (0, 1, 100, dll)
            $table->string('wind_direction');  // Parameter: wd (deg/cardinal)
            $table->string('wind_speed_knot'); // Parameter: ws
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
