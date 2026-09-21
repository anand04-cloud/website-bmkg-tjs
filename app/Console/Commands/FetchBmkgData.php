<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Earthquake;
use App\Models\WeatherWarning;
use Carbon\Carbon;

class FetchBmkgData extends Command
{
    protected $signature = 'bmkg:fetch';
    protected $description = 'Sinkronisasi data Gempa, Kualitas Udara, Peringatan Dini, dan Refresh Cache Cuaca';

    public function handle()
    {
        $this->info('🚀 Memulai sinkronisasi data BMKG...');

        // 1. Gempa Bumi
        $this->fetchEarthquake();

        // 2. Peringatan Dini
        $this->fetchWeatherWarning();

        $this->info('✅ Semua Sinkronisasi Selesai!');
        return self::SUCCESS;
    }

    private function fetchEarthquake()
    {
        try {
            $response = Http::get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');
            if ($response->successful()) {
                $g = $response->json()['Infogempa']['gempa'];
                Earthquake::updateOrCreate(
                    ['datetime' => Carbon::parse($g['DateTime'])],
                    [
                        'tgl' => $g['Tanggal'], 'jam' => $g['Jam'],
                        'coordinates' => $g['Coordinates'], 'magnitude' => $g['Magnitude'],
                        'kedalaman' => $g['Kedalaman'], 'wilayah' => $g['Wilayah'],
                        'potensi' => $g['Potensi'], 'shakemap' => $g['Shakemap'],
                    ]
                );
                Earthquake::where('datetime', '<', now()->subDays(7))->delete();
                $this->info('✔️ Data Gempa berhasil diupdate.');
            }
        } catch (\Exception $e) {
            $this->error('❌ Gagal Gempa: ' . $e->getMessage());
        }
    }

    private function fetchWeatherWarning()
    {
        try {
            $this->info("Menarik data Peringatan Dini Cuaca...");
            
            $http = Http::withoutVerifying()
                ->timeout(60)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                ]);

            $endpoint = 'https://www.bmkg.go.id/alerts/nowcast/id/rss.xml?v=' . time();
            $res = $http->get($endpoint);
            
            if ($res->successful()) {
                libxml_use_internal_errors(true);
                $xml = simplexml_load_string($res->body());
                
                $warningFound = false;
                $imageUrlToDownload = null;
                
                WeatherWarning::truncate(); 
                
                if ($xml !== false && isset($xml->channel->item)) {
                    $count = 0;
                    
                    foreach ($xml->channel->item as $item) {
                        $title = (string)$item->title;
                        $pubTimeWita = Carbon::parse((string)$item->pubDate)
                                        ->setTimezone('Asia/Makassar')
                                        ->format('Y-m-d H:i:s');
                        
                        if (stripos($title, 'Kalimantan Utara') !== false || stripos($title, 'Kaltara') !== false) {
                            $warningFound = true;
                            $linkCap = (string)$item->link;
                            
                            WeatherWarning::create([
                                'title'        => $title,
                                'content'      => (string)$item->description,
                                'publish_time' => $pubTimeWita,
                                'link'         => $linkCap
                            ]);
                            
                            // Ambil detail CAP XML sesuai standar dokumentasi BMKG
                            try {
                                $capRaw = $http->get($linkCap)->body();
                                $cap = simplexml_load_string($capRaw);
                                
                                if ($cap !== false) {
                                    $namespaces = $cap->getNamespaces(true);
                                    $cap_ns = isset($namespaces[""]) ? $namespaces[""] : "urn:oasis:names:tc:emergency:cap:1.2";
                                    $info = $cap->children($cap_ns)->info;

                                    if ($info && isset($info->web)) {
                                        $capWeb = (string)$info->web; 
                                        if (!empty($capWeb) && filter_var($capWeb, FILTER_VALIDATE_URL)) {
                                            $imageUrlToDownload = $capWeb;
                                        }
                                    }
                                }
                            } catch (\Exception $e) {
                                $this->warn("Gagal membaca link detail: " . $e->getMessage());
                            }
                        } else {
                            WeatherWarning::create([
                                'title'        => $title,
                                'content'      => (string)$item->description,
                                'publish_time' => $pubTimeWita,
                                'link'         => (string)$item->link
                            ]);
                        }
                        $count++;
                    }
                    
                    // PROSES UNDUH GAMBAR
                    if ($warningFound && $imageUrlToDownload) {
                        try {
                            $this->info("Mencoba mengunduh gambar infografis dengan Streaming...");
                            $imagePath = storage_path('app/public/kaltara_aktif.jpg');
                            
                            $ch = curl_init($imageUrlToDownload);
                            $fp = fopen($imagePath, 'w+');

                            curl_setopt($ch, CURLOPT_FILE, $fp);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 120); 
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            
                            // Perbaikan utama cURL: Ikuti redirect dan gunakan User-Agent lengkap
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                            curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
                            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
                            
                            curl_exec($ch);
                            $curl_errno = curl_errno($ch);
                            $curl_error = curl_error($ch);
                            curl_close($ch);
                            fclose($fp);

                            if ($curl_errno > 0) {
                                if (file_exists($imagePath)) @unlink($imagePath);
                                $this->warn("⚠️ Download terputus: " . $curl_error);
                            } else {
                                if (filesize($imagePath) > 1024) { // Validasi ukuran minimal 1KB
                                    $this->info("📸 Gambar Infografis Kaltara berhasil diperbarui.");
                                } else {
                                    @unlink($imagePath);
                                    $this->warn("⚠️ Gambar terunduh tapi isinya kosong (kurang dari 1KB).");
                                }
                            }
                        } catch (\Exception $e) {
                            $this->warn("Gagal mengunduh gambar: " . $e->getMessage());
                        }
                    } elseif (!$warningFound) {
                        if (Storage::disk('public')->exists('kaltara_aktif.jpg')) {
                            Storage::disk('public')->delete('kaltara_aktif.jpg');
                            $this->info("🧹 Cuaca aman, gambar peringatan lama dihapus.");
                        }
                    }

                    $this->info("✅ Data Peringatan Dini berhasil diupdate ($count Peringatan Aktif Nasional).");
                }
            }
        } catch (\Exception $e) {
            $this->error('Gagal Peringatan Dini: ' . $e->getMessage());
        }
    }
}