<?php

namespace App\Http\Controllers;

use App\Models\Earthquake;
use App\Models\AirQuality;
use App\Models\WeatherWarning;
use App\Models\Berita;
use App\Models\Buletin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\Pool;

class PublicController extends Controller
{
    // --- FITUR 1: API-First untuk Prakiraan Cuaca ---
    private function getPrakiraanApi(string $search): ?array
    {
        $wilayahKaltara = [
            // === KABUPATEN BULUNGAN ===
            'Tanjung Selor, Bulungan'         => '65.01.05.1002',
            'Tanjung Palas, Bulungan'         => '65.01.01.1002',
            'Tanjung Palas Barat, Bulungan'   => '65.01.02.2001',
            'Tanjung Palas Utara, Bulungan'   => '65.01.03.2001',
            'Tanjung Palas Timur, Bulungan'   => '65.01.04.2001',
            'Tanjung Palas Tengah, Bulungan'  => '65.01.06.2001',
            'Bunyu, Bulungan'                 => '65.01.10.2001',
            'Peso, Bulungan'                  => '65.01.07.2001',
            'Peso Hilir (Ilir), Bulungan'     => '65.01.08.2001',
            'Sekatak, Bulungan'               => '65.01.09.2001',
            // === KOTA TARAKAN ===
            'Tarakan Barat, Tarakan'          => '65.71.01.1001',
            'Tarakan Tengah, Tarakan'         => '65.71.02.1001',
            'Tarakan Timur, Tarakan'          => '65.71.03.1002',
            'Tarakan Utara, Tarakan'          => '65.71.04.1001',
            // === KABUPATEN MALINAU ===
            'Malinau Kota, Malinau'           => '65.02.02.2001',
            'Malinau Selatan, Malinau'        => '65.02.06.2001',
            'Malinau Selatan Hulu, Malinau'   => '65.02.14.2001',
            'Malinau Selatan Hilir, Malinau'  => '65.02.13.2001',
            'Malinau Utara, Malinau'          => '65.02.07.2002',
            'Malinau Barat, Malinau'          => '65.02.08.2001',
            'Bahau Hulu, Malinau'             => '65.02.11.2001',
            'Kayan Hilir, Malinau'            => '65.02.04.2001',
            'Kayan Hulu, Malinau'             => '65.02.05.2001',
            'Kayan Selatan, Malinau'          => '65.02.10.2001',
            'Mentarang, Malinau'              => '65.02.01.2001',
            'Mentarang Hulu, Malinau'         => '65.02.12.2001',
            'Pujungan, Malinau'               => '65.02.03.2001',
            'Sungai Boh, Malinau'             => '65.02.09.2001',
            'Sungai Tubu, Malinau'            => '65.02.15.2001',
            // === KABUPATEN NUNUKAN ===
            'Nunukan, Nunukan'                => '65.03.02.2004',
            'Nunukan Selatan, Nunukan'        => '65.03.09.1001',
            'Sebatik, Nunukan'                => '65.03.01.2001',
            'Sebatik Barat, Nunukan'          => '65.03.08.2001',
            'Sebatik Tengah, Nunukan'         => '65.03.12.2001',
            'Sebatik Utara, Nunukan'          => '65.03.11.2001',
            'Sebatik Timur, Nunukan'          => '65.03.10.2001',
            'Lumbis, Nunukan'                 => '65.03.04.2001',
            'Lumbis Ogong, Nunukan'           => '65.03.15.2001',
            'Lumbis Pansiangan, Nunukan'      => '65.03.20.2001',
            'Lumbis Hulu, Nunukan'            => '65.03.21.2001',
            'Sebuku, Nunukan'                 => '65.03.06.2001',
            'Sembakung, Nunukan'              => '65.03.03.2001',
            'Sembakung Atulai, Nunukan'       => '65.03.16.2001',
            'Sei Menggaris, Nunukan'          => '65.03.13.2001',
            'Krayan Selatan, Nunukan'         => '65.03.07.2001',
            'Krayan Tengah, Nunukan'          => '65.03.17.2001',
            'Krayan Timur, Nunukan'           => '65.03.18.2001',
            'Krayan Barat, Nunukan'           => '65.03.19.2001',
            'Krayan, Nunukan'                 => '65.03.05.2001',
            // === KABUPATEN TANA TIDUNG ===
            'Sesayap, Tana Tidung'            => '65.04.01.2002',
            'Sesayap Hilir, Tana Tidung'      => '65.04.02.2001',
            'Tana Lia, Tana Tidung'           => '65.04.03.2001',
            'Betayau, Tana Tidung'            => '65.04.04.2001',
            'Muruk Rian, Tana Tidung'         => '65.04.05.2001'
        ];

        $kode = $wilayahKaltara[$search] ?? '65.01.05.1002';
        $cacheKey = "weather_api_" . $kode;

        // KUNCI PERBAIKAN 1: Cek cache secara manual agar tidak menyimpan hasil 'null'
        $cachedData = Cache::get($cacheKey);
        
        if ($cachedData) {
            return $cachedData;
        }

        try {
            $response = Http::timeout(10)->get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4={$kode}");
            if ($response->successful()) {
                $data = $response->json();
                Cache::put($cacheKey, $data, 43200); // Simpan 12 Jam
                return $data;
            }
        } catch (\Exception $e) {
            // Biarkan return null dan TIDAK di-cache jika gagal
        }

        return null;
    }
    public function index()
    {
        $lokasiList = [
            'Tanjung Selor' => 'Tanjung Selor, Bulungan',
            'Malinau Kota'  => 'Malinau Kota, Malinau',
            'Sesayap'       => 'Sesayap, Tana Tidung',
            'Tarakan'       => 'Tarakan, Tarakan',
            'Nunukan'       => 'Nunukan, Nunukan'
        ];

        $weatherData = [];
        $now = Carbon::now('Asia/Makassar');

        foreach ($lokasiList as $nama => $search) {
            $data = $this->getPrakiraanApi($search);
            $allForecasts = [];
            
            // KUNCI PERBAIKAN 2: Proteksi Fatal Error jika $data kosong
            if (!empty($data) && isset($data['data'][0]['cuaca'])) {
                foreach ($data['data'][0]['cuaca'] as $hari) {
                    foreach ($hari as $jam) {
                        $allForecasts[] = $jam;
                    }
                }
            }

            // Jika API mati sama sekali, allForecasts akan kosong. Kasih nilai null agar view tidak crash
            $cuacaAktual = null;
            $prakiraan = [];

            if (count($allForecasts) > 0) {
                $cuacaAktual = collect($allForecasts)->filter(function ($item) use ($now) {
                    return Carbon::parse($item['local_datetime'])->lessThanOrEqualTo($now);
                })->last() ?? ($allForecasts[0] ?? null);

                $prakiraan = collect($allForecasts)->filter(function ($item) use ($now) {
                    return Carbon::parse($item['local_datetime'])->greaterThan($now);
                })->values()->take(4);
            }

            $weatherData[] = [
                'nama'      => $nama,
                'cuaca'     => $cuacaAktual,
                'prakiraan' => $prakiraan
            ];
        }
        
        // --- KUNCI PERBAIKAN PERINGATAN DINI DI BERANDA ---
        // Menggunakan filter Kaltara agar peringatan beranda fokus ke wilayah kerja
        $warnings = WeatherWarning::where(function($query) {
                        $query->where('title', 'LIKE', '%Kalimantan Utara%')
                              ->orWhere('title', 'LIKE', '%Kaltara%')
                              ->orWhere('content', 'LIKE', '%Kalimantan Utara%')
                              ->orWhere('content', 'LIKE', '%Kaltara%');
                    })
                    ->where('publish_time', '>=', now()->subHours(6))
                    ->orderBy('publish_time', 'desc')
                    ->get();
                    
        $gempa = Earthquake::latest()->first();
        
        $iklimCache = Cache::remember('kualitas_udara_tanjung_selor_live', 1800, function () {
            try {
                $token = 'ee62d1bb0cc128d45baeb36f6bd27bec621cb5c1';
                $response = Http::timeout(5)->get("https://api.waqi.info/feed/@13505/?token={$token}");

                if ($response->successful() && $response->json('status') === 'ok') {
                    $data = $response->json('data');
                    return [
                        'station_name' => 'Tanjung Selor',
                        'aqi_value'    => $data['aqi'] ?? 0,
                        'measured_at'  => $data['time']['s'] ?? now()->toDateTimeString(),
                    ];
                }
            } catch (\Exception $e) {
                return null;
            }
            return null;
        });

        $iklim = $iklimCache ? (object) $iklimCache : null;

        if (!$iklim) {
            $iklim = AirQuality::where('station_name', 'LIKE', '%Tanjung Selor%')->latest()->first();
        }
        
        // KUNCI PERBAIKAN 3: Fallback aman jika database juga kosong
        $aqi = $iklim ? ($iklim->aqi_value ?? 0) : 0;
        
        $aqiData = [
            'value' => $aqi, 'color' => 'emerald', 'status' => 'Baik',
            'desc'  => 'Kualitas udara dianggap memuaskan, dan polusi udara menimbulkan sedikit atau tanpa risiko.'
        ];

        if ($aqi > 300) { $aqiData = ['value' => $aqi, 'color' => 'rose', 'status' => 'Berbahaya', 'desc' => 'Peringatan kesehatan: semua orang mungkin mengalami efek kesehatan yang lebih serius.']; }
        elseif ($aqi > 200) { $aqiData = ['value' => $aqi, 'color' => 'purple', 'status' => 'Sangat Tidak Sehat', 'desc' => 'Peringatan kesehatan untuk kondisi darurat.']; }
        elseif ($aqi > 150) { $aqiData = ['value' => $aqi, 'color' => 'red', 'status' => 'Tidak Sehat', 'desc' => 'Setiap orang mungkin mulai mengalami efek kesehatan.']; }
        elseif ($aqi > 100) { $aqiData = ['value' => $aqi, 'color' => 'orange', 'status' => 'Tidak Sehat (Sensitif)', 'desc' => 'Anggota kelompok sensitif dapat mengalami efek kesehatan.']; }
        elseif ($aqi > 50) { $aqiData = ['value' => $aqi, 'color' => 'yellow', 'status' => 'Moderat', 'desc' => 'Kualitas udara dapat diterima.']; }
        
        $beritas = Berita::latest()->take(3)->get(); 
        
        return view('frontend.home', compact('weatherData', 'gempa', 'iklim', 'warnings', 'aqiData', 'beritas'));
    }
    public function peringatanDini()
    {
        // --- KUNCI PERBAIKAN PERINGATAN DINI HALAMAN KHUSUS ---
        // Disamakan logikanya dengan beranda
        $warnings = WeatherWarning::where('publish_time', '>=', now()->subHours(6))
                    ->orderBy('publish_time', 'desc')
                    ->get();

        return view('frontend.cuaca.peringatan-dini', compact('warnings'));
    }
    public function prakiraan(Request $request)
    {
        $search = $request->input('search', 'Tanjung Selor, Bulungan');
        $data = $this->getPrakiraanApi($search);
        
        // KUNCI PERBAIKAN 2 (Lanjutan): Proteksi akses Array Null
        $currentWeather = null;
        $allForecasts = [];

        if (!empty($data) && isset($data['data'][0]['cuaca'])) {
            $currentWeather = $data['data'][0]['cuaca'][0][0] ?? null;
            
            foreach ($data['data'][0]['cuaca'] as $hari) {
                foreach ($hari as $jam) {
                    $allForecasts[] = $jam;
                }
            }
        }
        
        $groupedForecast = collect($allForecasts)
            ->groupBy(function ($item) {
                return Carbon::parse($item['local_datetime'])->translatedFormat('d F Y');
            })
            ->take(3); 

        return view('frontend.cuaca.prakiraan', compact('currentWeather', 'groupedForecast', 'search'));
    }
    public function penerbangan()
    {
        $targetUrl = 'https://bmkgbulungan.id/awos/waqd/realtime.xml';
        $proxyUrl = 'https://api.allorigins.win/raw?url=' . urlencode($targetUrl);
        
        $error = null;
        $awosData = null;

        try {
            $response = Http::timeout(20)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ])
                ->get($proxyUrl);

            if ($response->successful()) {
                $xmlContent = $response->body();
                
                $start = strpos($xmlContent, '<AWOS>');
                $end   = strpos($xmlContent, '</AWOS>');
                
                if ($start !== false && $end !== false) {
                    $cleanXml = substr($xmlContent, $start, ($end - $start) + 7);
                    $xml = @simplexml_load_string($cleanXml, 'SimpleXMLElement', LIBXML_NOCDATA);
                    
                    if ($xml) {
                        $awosData = json_decode(json_encode($xml), true);
                    } else {
                        $error = "Gagal mem-parsing format XML AWOS setelah dibypass.";
                    }
                } else {
                    $error = "Format XML tidak ditemukan. Server mungkin sedang offline.";
                }
            } else {
                $error = "Gagal menghubungi Proxy Bridge (HTTP " . $response->status() . ")";
            }
        } catch (\Exception $e) {
            $error = "Koneksi Proxy Gagal: " . $e->getMessage();
        }

        return view('frontend.cuaca.penerbangan', compact('awosData', 'error'));
    }
    public function gempaTerkini()
    {
        $gempaTerbaru = Earthquake::orderBy('datetime', 'desc')->first();
        $riwayatGempa = Earthquake::where('id', '!=', $gempaTerbaru->id ?? 0)
                            ->where('datetime', '>=', now()->subDays(2))
                            ->orderBy('datetime', 'desc')->get();
        return view('frontend.gempa.terkini', compact('gempaTerbaru', 'riwayatGempa'));
    }
    public function kualitasUdara()
    {
        $kualitasUdara = Cache::remember('kualitas_udara_indonesia', 1800, function () {
            $token = 'ee62d1bb0cc128d45baeb36f6bd27bec621cb5c1'; 
            
            $stasiun = [
                'Tanjung Selor'  => '@13505', 'Tarakan' => 'tarakan', 'Pontianak' => 'pontianak',
                'Palangkaraya'   => 'palangkaraya', 'Banjarmasin' => 'banjarmasin', 'Samarinda' => 'samarinda',
                'Balikpapan'     => 'balikpapan', 'Banda Aceh' => 'banda aceh', 'Medan' => 'medan',
                'Pekanbaru'      => 'pekanbaru', 'Padang' => 'padang', 'Jambi' => 'jambi',
                'Palembang'      => 'palembang', 'Bengkulu' => 'bengkulu', 'Bandar Lampung' => 'lampung',
                'Batam'          => 'batam', 'Pangkal Pinang' => 'pangkal pinang', 'Jakarta' => 'jakarta',
                'Serang'         => 'serang', 'Bandung' => 'bandung', 'Semarang' => 'semarang',
                'Yogyakarta'     => 'yogyakarta', 'Surabaya' => 'surabaya', 'Malang' => 'malang',
                'Denpasar'       => 'denpasar', 'Mataram' => 'mataram', 'Kupang' => 'kupang',
                'Makassar'       => 'makassar', 'Manado' => 'manado', 'Palu' => 'palu',
                'Kendari'        => 'kendari', 'Gorontalo' => 'gorontalo', 'Mamuju' => 'mamuju',
                'Ambon'          => 'ambon', 'Ternate' => 'ternate', 'Jayapura' => 'jayapura',
                'Sorong'         => 'sorong', 'Manokwari' => 'manokwari', 'Timika' => 'timika'
            ];

            $responses = Http::pool(function (Pool $pool) use ($stasiun, $token) {
                $reqs = [];
                foreach ($stasiun as $nama => $id) {
                    $reqs[] = $pool->as($nama)->timeout(5)->get("https://api.waqi.info/feed/{$id}/?token={$token}");
                }
                return $reqs;
            });

            $results = [];

            foreach ($responses as $nama => $response) {
                if ($response instanceof \Illuminate\Http\Client\Response && $response->successful() && $response->json('status') === 'ok') {
                    $data = $response->json('data');
                    $aqi = $data['aqi'] ?? 0;

                    $category = 'Baik';
                    if ($aqi > 300) $category = 'Berbahaya';
                    elseif ($aqi > 200) $category = 'Sangat Tidak Sehat';
                    elseif ($aqi > 150) $category = 'Tidak Sehat';
                    elseif ($aqi > 100) $category = 'Tidak Sehat (Sensitif)';
                    elseif ($aqi > 50) $category = 'Moderat';

                    $results[] = [
                        'station_name' => $nama,
                        'aqi_value'    => $aqi,
                        'category'     => $category,
                        'pm25'         => $data['iaqi']['pm25']['v'] ?? 'N/A',
                        'measured_at'  => Carbon::parse($data['time']['s'])->toDateTimeString(),
                    ];
                }
            }

            usort($results, function($a, $b) {
                return $a['aqi_value'] <=> $b['aqi_value'];
            });

            return $results; 
        });

        $kualitasUdara = collect($kualitasUdara);

        return view('frontend.iklim.kualitas-udara', compact('kualitasUdara'));
    }
    public function gempaDirasakan()
    {
        $gempaData = [];
        try {
            $response = Http::timeout(10)->get('https://data.bmkg.go.id/DataMKG/TEWS/gempadirasakan.json');
            if ($response->successful()) {
                $gempaData = $response->json('Infogempa.gempa');
            }
        } catch (\Exception $e) {
            $gempaData = [];
        }
        return view('frontend.gempa.gempa-dirasakan', compact('gempaData'));
    }

    public function petaIklim()
    {
        $kategoriList = [
            'prediksi_ch_dasarian'   => 'Prediksi Curah Hujan Dasarian',
            'prediksi_ch_bulanan'    => 'Prediksi Curah Hujan Bulanan',
            'prediksi_sifat_bulanan' => 'Prediksi Sifat Hujan Bulanan',
            'monitoring_hth'         => 'Monitoring Hari Tanpa Hujan',
            'analisis_ch_dasarian'   => 'Analisis Curah Hujan Dasarian',
            'analisis_ch_bulanan'    => 'Analisis Curah Hujan Bulanan',
            'analisis_sifat_bulanan' => 'Analisis Sifat Hujan Bulanan',
        ];

        $dataIklim = [];

        foreach ($kategoriList as $key => $judul) {
            // KUNCI PERUBAHAN: Ambil SEMUA data untuk kategori ini, urutkan dari yang terbaru
            $semuaData = \App\Models\PetaIklim::where('kategori', $key)->latest()->get();
            
            // Ambil data urutan pertama (paling baru) untuk layar utama
            $record = $semuaData->first(); 
            
            // Ambil sisanya (lewati data 1, ambil maksimal 10 data lama) untuk arsip
            $arsip = $semuaData->take(10); 

            $dataIklim[$key] = [
                'judul'      => $judul,
                'gambar'     => $record ? asset('storage/' . $record->gambar) : 'https://placehold.co/800x600/e2e8f0/475569?text=Peta+Belum+Tersedia',
                'periode'    => $record ? $record->periode : 'Menunggu Update',
                'keterangan' => $record && $record->keterangan ? $record->keterangan : 'Belum ada keterangan atau analisis untuk periode ini.',
                'arsip'      => $arsip // Masukkan arsip ke array untuk dikirim ke Blade
            ];
        }

        return view('frontend.iklim.peta-iklim', compact('dataIklim'));
    }
    public function berita()
    {
        $beritas = Berita::orderBy('published_at', 'desc')->paginate(9);
        return view('frontend.publikasi.berita', compact('beritas'));
    }
    public function beritaDetail(string $slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('frontend.publikasi.berita-detail', compact('berita'));
    }
    public function buletin()
    {
        $buletins = Buletin::orderBy('published_date', 'desc')->paginate(12);
        return view('frontend.publikasi.buletin', compact('buletins'));
    }
    public function visiMisi()
    {
        return view('profile.visi-misi');
    }
    public function tugasFungsi()
    {
        return view('profile.tugas-fungsi');
    }
    public function struktur()
    {
        return view('profile.struktur');
    }
    public function layanan()
    {
        $layanans = \App\Models\Layanan::latest()->get(); 
        return view('layanan', compact('layanans'));
    }
}