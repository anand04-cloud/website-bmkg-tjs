<?php

namespace App\Http\Controllers;

use App\Models\Earthquake;
use App\Models\WeatherWarning;
use App\Models\Berita;
use App\Models\Buletin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\Response;
use App\Models\Pm25Log;

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
        
        // --- KUNCI PERBAIKAN PERINGATAN DINI DI BERANDA --
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
        
        // --- AMBIL DATA KUALITAS UDARA DARI API LOKAL BARU ---
        $pm25Data = $this->getPm25Data()['pm25Data'];

        // Fallback jika API lokal gagal/kosong
        $val = $pm25Data['pm25'] ?? 83.80; 

        $beritas = Berita::latest()->take(3)->get(); 
        
        return view('frontend.home', compact('weatherData', 'gempa', 'pm25Data', 'warnings', 'beritas'));
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
        try {
            $response = Http::withoutVerifying()->timeout(10)->get('https://bmkgbulungan.id/awos/waqd/realtime.xml');
            if ($response->successful()) {
                $xml = simplexml_load_string($response->body());
                $awosData = json_decode(json_encode($xml), true);
                $awosData['status'] = 'online';
            } else {
                $awosData = ['status' => 'offline'];
            }
        } catch (\Exception $e) {
            $awosData = ['status' => 'offline'];
        }

        return view('frontend.cuaca.penerbangan', compact('awosData'));
    }
    public function gempaTerkini()
    {
        $gempaTerbaru = Earthquake::orderBy('datetime', 'desc')->first();
        $riwayatGempa = Earthquake::where('id', '!=', $gempaTerbaru->id ?? 0)
                            ->where('datetime', '>=', now()->subDays(2))
                            ->orderBy('datetime', 'desc')->get();
        return view('frontend.gempa.terkini', compact('gempaTerbaru', 'riwayatGempa'));
    }
    private function getPm25Data(): array
    {
        // Cache 3 menit (180 detik) agar beban query dan HTTP request tetap ringan
        return Cache::remember('pm25_realtime_and_hourly', 180, function () {
            $pm25Data = [
                'pm25'       => 0,
                'suhu'       => 0,
                'kelembapan' => 0,
                'tekanan'    => 0,
                'kec_angin'  => 0,
                'arah_angin' => 0,
                'waktu'      => '-',
            ];

            $hourlyData = array_fill(0, 24, null);

            // 1. Ambil 1 data terbaru dari API JSON CMS
            try {
                $response = Http::withoutVerifying()
                    ->timeout(8)
                    ->get('https://bmkgbulungan.id/cms/public/api/pm25_latest.json');

                if ($response->successful()) {
                    $json = $response->json();
                    $latest = $json['data'] ?? $json['latest'] ?? $json;
                    $obsTime = $latest['observation_at'] ?? $latest['waktu'] ?? $latest['updated_at'] ?? null;

                    $pm25Data = [
                        'pm25'       => (float) ($latest['pm25'] ?? 0),
                        'suhu'       => (float) ($latest['at'] ?? $latest['suhu'] ?? 0),
                        'kelembapan' => (float) ($latest['rh'] ?? $latest['kelembapan'] ?? 0),
                        'tekanan'    => (float) ($latest['bp'] ?? $latest['tekanan'] ?? 0),
                        'kec_angin'  => (float) ($latest['ws'] ?? $latest['kec_angin'] ?? 0),
                        'arah_angin' => (float) ($latest['wd'] ?? $latest['arah_angin'] ?? 0),
                        'waktu'      => $obsTime ? Carbon::parse($obsTime)->format('d M Y, H:i') : '-',
                    ];
                }
            } catch (\Exception $e) {
                // Lanjut ke fallback database jika endpoint JSON gagal diakses
            }

            // 2. Ambil data grafik 24 jam hari ini (WITA) dari database bmkj2641_cms
            try {
                $todayWita = Carbon::today('Asia/Makassar')->toDateString();

                $logs = Pm25Log::whereDate('observation_at', $todayWita)
                    ->orderBy('observation_at', 'asc')
                    ->get();

                foreach ($logs as $log) {
                    $hour = (int) Carbon::parse($log->observation_at)->format('G');
                    if ($hour >= 0 && $hour < 24) {
                        $hourlyData[$hour] = (float) $log->pm25;
                    }
                }

                // Fallback kartu utama jika JSON sempat gagal
                if ($pm25Data['pm25'] == 0) {
                    $latestDb = Pm25Log::orderBy('observation_at', 'desc')->first();
                    if ($latestDb) {
                        $pm25Data = [
                            'pm25'       => (float) ($latestDb->pm25 ?? 0),
                            'suhu'       => (float) ($latestDb->at ?? 0),
                            'kelembapan' => (float) ($latestDb->rh ?? 0),
                            'tekanan'    => (float) ($latestDb->bp ?? 0),
                            'kec_angin'  => (float) ($latestDb->ws ?? 0),
                            'arah_angin' => (float) ($latestDb->wd ?? 0),
                            'waktu'      => $latestDb->observation_at ? Carbon::parse($latestDb->observation_at)->format('d M Y, H:i') : '-',
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Aman di lingkungan lokal (Laragon) meskipun database CMS tidak terhubung
            }

            return compact('pm25Data', 'hourlyData');
        });
    }

    public function kualitasUdara()
    {
        $data = $this->getPm25Data();

        return view('frontend.iklim.kualitas-udara', [
            'pm25Data'   => $data['pm25Data'],
            'hourlyData' => $data['hourlyData'],
        ]);
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
        $data = $this->getClimateData();

        return view('frontend.iklim.peta-iklim', [
            'climateGroups' => $data['climateGroups'],
        ]);
    }

    public function downloadPetaIklim(Request $request)
    {
        $kategori = (string) $request->query('kategori');
        $filename = basename((string) $request->query('file'));

        $allowedCategories = ['PCH_Bulanan', 'PCH_Dasarian', 'PSH_Bulanan', 'PSH_Dasarian'];
        if (!in_array($kategori, $allowedCategories, true) || !preg_match('/^[A-Za-z0-9_.-]+\.png$/', $filename)) {
            abort(404);
        }

        // 1. Prioritas Utama (Server Produksi cPanel): Baca langsung dari disk tanpa HTTP/SSL
        $candidatePaths = [
            dirname(base_path()) . "/public_html/cms/storage/app/public/climate/{$kategori}/{$filename}",
            public_path("cms/storage/app/public/climate/{$kategori}/{$filename}"),
        ];

        foreach ($candidatePaths as $localPath) {
            if (is_file($localPath)) {
                return response()->download($localPath, $filename, [
                    'Content-Type' => 'image/png',
                ]);
            }
        }

        $remoteUrl = "https://bmkgbulungan.id/cms/storage/app/public/climate/{$kategori}/{$filename}";

        // 2. Fallback Laragon Lokal: Gunakan PHP SSL stream wrapper (melewati bug handshake cURL OpenSSL 3.0.15)
        try {
            $context = stream_context_create([
                'ssl' => [
                    'verify_peer'      => false,
                    'verify_peer_name' => false,
                    'allow_self_signed'=> true,
                ],
                'http' => [
                    'timeout'    => 15,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                ],
            ]);

            $binary = @file_get_contents($remoteUrl, false, $context);
            if ($binary !== false && strlen($binary) > 100) {
                return response($binary, 200, [
                    'Content-Type'        => 'image/png',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                ]);
            }
        } catch (\Throwable $e) {
            // Lanjut ke fallback redirect jika jaringan lokal memblokir PHP
        }

        // 3. Pengaman terakhir agar tidak pernah memunculkan halaman 404
        return redirect()->away($remoteUrl);
    }

    private function getClimateData(): array
    {
        // Cache 10 menit (600 detik)
        return Cache::remember('bmkg_climate_all_regions_v2', 600, function () {
            $baseUrl = 'https://bmkgbulungan.id/cms/storage/app/public/climate';
            $now = Carbon::now('Asia/Makassar')->locale('id');

            // 1. Deteksi otomatis periode paling baru berdasarkan Last-Modified file di CMS
            $selectedPeriode = 1;
            $latestTimestamp = 0;

            foreach ([1, 2, 3] as $p) {
                $checkUrl = "{$baseUrl}/PCH_Bulanan/PCH_Bulanan_65_kalimantan_utara_periode_{$p}.png";
                try {
                    $head = Http::withoutVerifying()->timeout(3)->head($checkUrl);
                    if ($head->successful() && $head->header('Last-Modified')) {
                        $ts = Carbon::parse($head->header('Last-Modified'))->timestamp;
                        if ($ts > $latestTimestamp) {
                            $latestTimestamp = $ts;
                            $selectedPeriode = $p;
                        }
                    }
                } catch (\Exception $e) {
                    // Lanjut ke pengecekan berikutnya
                }
            }

            // 2. Hitung label Periode Bulanan & Dasarian sesuai periode terbaru
            $targetMonth = $now->copy()->addMonths($selectedPeriode - 1);
            $labelBulanan = 'Bulan ' . $targetMonth->translatedFormat('F Y');

            $currentDasarian = $now->day <= 10 ? 1 : ($now->day <= 20 ? 2 : 3);
            $totalDasarianIndex = (($now->month - 1) * 3) + ($currentDasarian - 1) + ($selectedPeriode - 1);
            $dasarianMonthOffset = intdiv($totalDasarianIndex, 3) - ($now->month - 1);
            $dasarianNumber = ($totalDasarianIndex % 3) + 1;
            $romawi = [1 => 'I', 2 => 'II', 3 => 'III'][$dasarianNumber];
            $dasarianDate = $now->copy()->addMonths($dasarianMonthOffset);
            $labelDasarian = "Dasarian {$romawi} " . $dasarianDate->translatedFormat('F Y');

            // 3. Daftar Provinsi & Kabupaten/Kota Kalimantan Utara (dengan titik pada kode: 65.xx)
            $regions = [
                [
                    'code'  => '65',
                    'name'  => 'Kalimantan Utara',
                    'type'  => 'Provinsi',
                    'slug'  => 'kalimantan_utara',
                    'slugs' => ['kalimantan_utara'],
                ],
                [
                    'code'  => '65.01',
                    'name'  => 'Bulungan',
                    'type'  => 'Kabupaten / Kota',
                    'slug'  => 'bulungan',
                    'slugs' => ['bulungan', 'kabupaten_bulungan'],
                ],
                [
                    'code'  => '65.02',
                    'name'  => 'Malinau',
                    'type'  => 'Kabupaten / Kota',
                    'slug'  => 'malinau',
                    'slugs' => ['malinau', 'kabupaten_malinau'],
                ],
                [
                    'code'  => '65.03',
                    'name'  => 'Nunukan',
                    'type'  => 'Kabupaten / Kota',
                    'slug'  => 'nunukan',
                    'slugs' => ['nunukan', 'kabupaten_nunukan'],
                ],
                [
                    'code'  => '65.04',
                    'name'  => 'Tana Tidung',
                    'type'  => 'Kabupaten / Kota',
                    'slug'  => 'tana_tidung',
                    'slugs' => ['tana_tidung', 'kabupaten_tana_tidung'],
                ],
                [
                    'code'  => '65.71',
                    'name'  => 'Kota Tarakan',
                    'type'  => 'Kabupaten / Kota',
                    'slug'  => 'tarakan',
                    'slugs' => ['tarakan', 'kota_tarakan'],
                ],
            ];

            $categories = [
                ['key' => 'PCH_Bulanan',  'title' => 'Prediksi Curah Hujan Bulanan',  'periode' => $labelBulanan],
                ['key' => 'PCH_Dasarian', 'title' => 'Prediksi Curah Hujan Dasarian', 'periode' => $labelDasarian],
                ['key' => 'PSH_Bulanan',  'title' => 'Prediksi Sifat Hujan Bulanan',  'periode' => $labelBulanan],
                ['key' => 'PSH_Dasarian', 'title' => 'Prediksi Sifat Hujan Dasarian', 'periode' => $labelDasarian],
            ];

            // 4. Cek ketersediaan file & waktu render secara paralel
            $urlsToCheck = [];
            foreach ($regions as $region) {
                foreach ($categories as $cat) {
                    foreach ($region['slugs'] as $candidateSlug) {
                        $poolKey = "{$region['code']}|{$cat['key']}|{$candidateSlug}";
                        $filename = "{$cat['key']}_{$region['code']}_{$candidateSlug}_periode_{$selectedPeriode}.png";
                        $urlsToCheck[$poolKey] = "{$baseUrl}/{$cat['key']}/{$filename}";
                    }
                }
            }

            $responses = Http::pool(function ($pool) use ($urlsToCheck) {
                foreach ($urlsToCheck as $poolKey => $url) {
                    $pool->as($poolKey)->withoutVerifying()->timeout(4)->head($url);
                }
            });

            $climateGroups = [];

            foreach ($regions as $region) {
                $maps = [];
                foreach ($categories as $cat) {
                    $chosenSlug = $region['slugs'][0];
                    $renderDate = $now->format('d M Y H:i');
                    $versionTs = $now->timestamp;

                    foreach ($region['slugs'] as $candidateSlug) {
                        $poolKey = "{$region['code']}|{$cat['key']}|{$candidateSlug}";
                        $res = $responses[$poolKey] ?? null;

                        if ($res instanceof Response && $res->successful()) {
                            $chosenSlug = $candidateSlug;
                            if ($res->header('Last-Modified')) {
                                $dt = Carbon::parse($res->header('Last-Modified'))->setTimezone('Asia/Makassar');
                                $renderDate = $dt->format('d M Y H:i');
                                $versionTs = $dt->timestamp;
                            }
                            break;
                        }
                    }

                    $filename = "{$cat['key']}_{$region['code']}_{$chosenSlug}_periode_{$selectedPeriode}.png";
                    $rawUrl = "{$baseUrl}/{$cat['key']}/{$filename}";

                    $maps[] = [
                        'key'            => $cat['key'],
                        'title'          => $cat['title'],
                        'wilayah'        => $region['name'],
                        'periode'        => $cat['periode'],
                        'tanggal_render' => $renderDate,
                        'image_url'      => "{$rawUrl}?v={$versionTs}",
                        'raw_url'        => $rawUrl,
                        'filename'       => $filename,
                    ];
                }

                $climateGroups[] = [
                    'code'  => $region['code'],
                    'name'  => $region['name'],
                    'type'  => $region['type'],
                    'slug'  => $region['slug'],
                    'count' => count($maps),
                    'maps'  => $maps,
                ];
            }

            return compact('climateGroups');
        });
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