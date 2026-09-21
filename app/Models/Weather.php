<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = 'weathers'; // Pastikan nama tabel sesuai
    protected $fillable = [
        'area_id', 
        'area_name', 
        'analysis_time', 
        'forecast_time', 
        'temp_c', 
        'humidity', 
        'weather_code', 
        'wind_direction', 
        'wind_speed_knot'
    ];

    /**
     * Accessor untuk deskripsi cuaca berdasarkan kode
     */
    public function getWeatherDescAttribute()
    {
        $codes = [
            0 => 'Cerah', 1 => 'Cerah Berawan', 2 => 'Cerah Berawan', 3 => 'Berawan', 
            4 => 'Berawan Tebal', 5 => 'Udara Kabur', 10 => 'Asap', 45 => 'Kabut', 
            60 => 'Hujan Ringan', 61 => 'Hujan Sedang', 63 => 'Hujan Lebat',
            80 => 'Hujan Lokal', 95 => 'Hujan Petir', 97 => 'Hujan Petir'
        ];

        return $codes[(int)$this->weather_code] ?? 'Tidak Diketahui';
    }

    public function getWeatherIconAttribute()
    {
        $iconMap = [
            0 => 'cerah', 1 => 'cerah berawan', 2 => 'cerah berawan', 3 => 'berawan', 
            4 => 'berawan tebal', 5 => 'udara kabur', 10 => 'asap', 45 => 'kabut', 
            60 => 'hujan ringan', 61 => 'hujan sedang', 63 => 'hujan lebat',
            80 => 'hujan lokal', 95 => 'hujan petir', 97 => 'hujan petir'
        ];

        $hour = \Carbon\Carbon::parse($this->forecast_time)->format('H');
        $suffix = ($hour >= 18 || $hour < 06) ? '-pm' : '-am';
        
        $name = $iconMap[(int)$this->weather_code] ?? 'berawan';
        $fullName = $name . $suffix;

        return "https://api-apps.bmkg.go.id/storage/icon/cuaca/" . rawurlencode($fullName) . ".svg";
    }
}