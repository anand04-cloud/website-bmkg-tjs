@extends('layouts.app')

@section('content')

{{-- ======================================================= --}}
{{-- BUNGKUS UTAMA (MENCAKUP SELURUH HALAMAN & BACKGROUND)    --}}
{{-- ======================================================= --}}
<div class="relative w-full bg-fixed bg-cover bg-center bg-no-repeat overflow-hidden min-h-screen font-sans" style="background-image: url('{{ asset('img/kantor.jpg') }}');">
    
    {{-- Overlay Gelap Profesional (Khas Instansi) --}}
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950/85 via-slate-900/80 to-blue-950/80 z-0 pointer-events-none"></div>

    {{-- ======================================================= --}}
    {{-- WADAH SLIDER UTAMA                                      --}}
    {{-- ======================================================= --}}
    <div class="relative z-10 w-full">
        
        {{-- Track / Jalur Slider --}}
        <div id="main-slider-track" class="flex transition-transform duration-700 ease-in-out w-full items-start">
        
            {{-- ======================================= --}}
            {{-- SLIDE 1: CUACA & PERINGATAN DINI        --}}
            {{-- ======================================= --}}
            <div class="w-full shrink-0 min-h-screen pt-24 pb-12 flex flex-col justify-center px-4 md:px-8">
                <div class="w-full max-w-[1600px] mx-auto transition-all duration-500">
                    
                    {{-- Header / Judul Resmi Instansi --}}
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 border-b border-white/10 pb-4">
                        <div>
                            <div class="flex items-center space-x-2 text-blue-400 text-xs font-bold uppercase tracking-widest mb-1">
                                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                                <span>BMKG Stasiun Meteorologi Tanjung Harapan</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Peringatan Dini & Prakiraan Cuaca</h2>
                        </div>
                        <p class="text-slate-300 text-xs mt-2 md:mt-0 font-medium">
                            Update Terakhir: <span class="text-white font-bold">{{ \Carbon\Carbon::now('Asia/Makassar')->translatedFormat('d F Y | H:i') }} WITA</span>
                        </p>
                    </div>

                    {{-- BLOK PERINGATAN DINI --}}
                    @if(isset($warnings) && $warnings->count() > 0)
                        <div class="mb-6 relative group" id="peringatan-slider-wrapper">
                            <div class="overflow-hidden rounded-xl shadow-xl border border-amber-500/30 relative">
                                <div id="peringatan-slider" class="flex transition-transform duration-500 ease-in-out w-full">
                                    @foreach($warnings as $index => $item)
                                    <div class="w-full shrink-0">
                                        <div class="bg-amber-950 border-l-4 border-amber-500 p-4 md:p-5 flex items-start space-x-4 shadow-2xl">
                                            <div class="bg-amber-500/20 p-2.5 rounded-lg text-amber-400 shrink-0 border border-amber-500/30">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"/></svg>
                                            </div>
                                            <div class="overflow-hidden w-full text-amber-100">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h4 class="font-bold text-amber-300 uppercase text-xs tracking-wider">Peringatan Dini Cuaca Ekstrem</h4>
                                                    <span class="text-[10px] font-bold text-amber-200 bg-amber-500/20 px-2.5 py-0.5 rounded border border-amber-500/30">
                                                        {{ $index + 1 }} dari {{ $warnings->count() }} Wilayah
                                                    </span>
                                                </div>
                                                <p class="text-xs md:text-sm leading-relaxed font-normal text-amber-50/90 max-h-24 overflow-y-auto custom-scrollbar pr-2 text-justify">
                                                    {{ $item->content }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-6">
                            <div class="bg-emerald-950 border-l-4 border-emerald-500 p-4 rounded-xl flex items-center space-x-4 border border-emerald-500/20 shadow-xl">
                                <div class="bg-emerald-500/20 p-2.5 rounded-lg text-emerald-400 shrink-0 border border-emerald-500/30">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-emerald-300 uppercase text-xs tracking-wider mb-0.5">Status Cuaca Aman</h4>
                                    <p class="text-emerald-100 text-xs md:text-sm">
                                        Saat ini tidak ada Peringatan Dini aktif yang dikeluarkan oleh BMKG untuk wilayah Kalimantan Utara.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- GRID CUACA (3 KOTA BERSUSUN) --}}
                    <div class="flex flex-col space-y-4 max-h-[70vh] overflow-y-auto custom-scrollbar pr-1 pb-4">
                        @foreach($weatherData as $wd)
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-stretch bg-slate-900/60 backdrop-blur-md p-4 rounded-2xl border border-white/10 shadow-xl">
                            
                            {{-- CUACA AKTUAL (KIRI) --}}
                            <div class="lg:col-span-4 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl p-5 text-white shadow-inner relative overflow-hidden flex flex-col justify-between border border-blue-500/30">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-bold tracking-wide">{{ $wd['nama'] }}</h3>
                                        <p class="text-blue-200 text-[10px] font-semibold uppercase tracking-wider">
                                            {{ \Carbon\Carbon::now('Asia/Makassar')->translatedFormat('d M Y | H:i') }} WITA
                                        </p>
                                    </div>
                                    <span class="bg-blue-600/50 border border-blue-400/30 text-[10px] px-2 py-0.5 rounded text-blue-100 font-bold uppercase">Aktif</span>
                                </div>
                                
                                <div class="my-4 flex items-center justify-between">
                                    <img src="{{ $wd['cuaca']['image'] ?? '#' }}" class="w-16 h-16 drop-shadow-md" alt="Icon Cuaca">
                                    <div class="text-right">
                                        <h2 class="text-4xl font-black leading-none mb-1">
                                            {{ $wd['cuaca']['t'] ?? '--' }}°<span class="text-xl font-normal opacity-70">C</span>
                                        </h2>
                                        <p class="text-xs font-semibold tracking-wide text-blue-100 uppercase">
                                            {{ $wd['cuaca']['weather_desc'] ?? 'Berawan' }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-2 pt-3 border-t border-white/10 text-xs">
                                    <div class="border-r border-white/10 pr-2">
                                        <p class="text-[9px] font-bold opacity-60 uppercase tracking-widest">Kelembapan</p>
                                        <p class="font-extrabold">{{ $wd['cuaca']['hu'] ?? '0' }}%</p>
                                    </div>
                                    <div class="pl-2">
                                        <p class="text-[9px] font-bold opacity-60 uppercase tracking-widest">Arah Angin</p>
                                        @php
                                            $arah = strtoupper($wd['cuaca']['wd'] ?? '');
                                            $kamusAngin = [
                                                'N'   => 'Utara', 'NNE' => 'Utara Tim. Laut', 'NE'  => 'Timur Laut',
                                                'ENE' => 'Timur Tim. Laut', 'E'   => 'Timur', 'ESE' => 'Timur Tenggara',
                                                'SE'  => 'Tenggara', 'SSE' => 'Selatan Tenggara', 'S'   => 'Selatan',
                                                'SSW' => 'Sel. Barat Daya', 'SW'  => 'Barat Daya', 'WSW' => 'Barat Barat Daya',
                                                'W'   => 'Barat', 'WNW' => 'Barat Barat Laut', 'NW'  => 'Barat Laut',
                                                'NNW' => 'Utara Barat Laut', 'C'   => 'Tenang', 'CALM'=> 'Tenang'
                                            ];
                                            $anginIndo = $kamusAngin[$arah] ?? ($arah ?: 'N/A');
                                        @endphp
                                        <p class="font-extrabold truncate">{{ $anginIndo }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- PRAKIRAAN PER 6 JAM (KANAN - 4 CARD) --}}
                            <div class="lg:col-span-8 flex flex-col justify-center">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 h-full">
                                    @forelse($wd['prakiraan'] ?? [] as $p)
                                    <div class="bg-slate-900/80 border border-white/10 rounded-xl p-3 flex flex-col items-center justify-between text-center shadow-md hover:border-blue-500/50 transition-all">
                                        <div>
                                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                                {{ \Carbon\Carbon::parse($p['local_datetime'])->translatedFormat('d M') }}
                                            </span>
                                            <span class="block text-xs font-extrabold text-blue-400">
                                                {{ \Carbon\Carbon::parse($p['local_datetime'])->format('H:i') }} WITA
                                            </span>
                                        </div>
                                        
                                        <img src="{{ $p['image'] }}" class="w-12 h-12 my-2 drop-shadow" alt="Icon Prakiraan">
                                        
                                        <div>
                                            <p class="text-lg font-black text-white mb-0.5">{{ $p['t'] }}°C</p>
                                            <p class="text-[10px] font-medium text-slate-300 uppercase leading-tight line-clamp-1">
                                                {{ $p['weather_desc'] }}
                                            </p>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-span-full font-bold text-slate-400 text-center flex items-center justify-center bg-slate-900/40 rounded-xl p-4 border border-white/5">
                                        Data prakiraan belum tersedia
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> 
            </div> 

            {{-- ======================================= --}}
            {{-- SLIDE 2: GEMPA TERKINI                  --}}
            {{-- ======================================= --}}
            <div class="w-full shrink-0 min-h-screen pt-24 pb-12 flex flex-col justify-center px-4 md:px-8">
                <div class="w-full max-w-[1600px] mx-auto transition-all duration-500">
                    
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 border-b border-white/10 pb-4">
                        <div>
                            <div class="flex items-center space-x-2 text-red-400 text-xs font-bold uppercase tracking-widest mb-1">
                                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                <span class="text-white">Real-Time Seismicity Information</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Ringkasan Gempabumi Terkini</h2>
                        </div>
                    </div>
                    
                    <div class="bg-slate-900/90 backdrop-blur-md rounded-2xl p-6 md:p-8 shadow-2xl border border-white/10 relative overflow-hidden w-full">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                            
                            <div class="lg:col-span-7 text-left space-y-6">
                                <div class="inline-flex items-center space-x-2 px-3 py-1 bg-red-500/10 border border-red-500/30 text-red-400 rounded-full font-bold text-xs uppercase tracking-wider">
                                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                    <span>Gempabumi Dirasakan</span>
                                </div>

                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2 text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h3l2-5 3 10 3-7 2 4h3"></path></svg>
                                        <span>Magnitudo:</span>
                                    </div>
                                    <div class="flex items-baseline space-x-2">
                                        <h3 class="text-5xl md:text-6xl font-black text-white tracking-tighter leading-none">
                                            {{ $gempa->magnitude ?? '0' }}
                                        </h3>
                                        <span class="text-xl md:text-2xl font-extrabold text-red-500 uppercase">SR</span>
                                    </div>
                                    <p class="text-base md:text-lg font-semibold text-slate-200 leading-snug pt-1">
                                        {{ $gempa->wilayah ?? 'Tidak ada data gempabumi terbaru saat ini.' }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-4 bg-slate-800/60 rounded-xl border border-white/5 flex items-start space-x-3">
                                        <svg class="w-6 h-6 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="9"></circle><circle cx="12" cy="12" r="5"></circle><circle cx="12" cy="12" r="1" fill="currentColor"></circle>
                                        </svg>
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-slate-400">Kedalaman:</p>
                                            <p class="font-extrabold text-white text-base">{{ $gempa->kedalaman ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <div class="p-4 bg-slate-800/60 rounded-xl border border-white/5 flex items-start space-x-3">
                                        <svg class="w-6 h-6 text-amber-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-slate-400">Waktu Kejadian:</p>
                                            <p class="text-xs font-bold text-slate-200">
                                                {{ $gempa->tgl ?? '-' }} <br>
                                                <span class="text-blue-400 font-extrabold">{{ $gempa->jam ?? '-' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <a href="/gempa/terkini" class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg shadow-red-600/20">
                                        <span>Detail Gempabumi Selengkapnya</span>
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>

                            <div class="lg:col-span-5">
                                <div class="bg-slate-950 rounded-2xl p-3 shadow-inner border border-slate-800 relative group overflow-hidden">
                                    <div class="absolute top-4 right-4 z-10 bg-black/70 backdrop-blur-md px-2.5 py-1 rounded text-[10px] font-bold text-white uppercase tracking-wider border border-white/10">
                                        Peta Guncangan (ShakeMap)
                                    </div>
                                    <div class="aspect-square w-full overflow-hidden rounded-xl bg-white flex items-center justify-center">
                                        <img src="https://data.bmkg.go.id/DataMKG/TEWS/{{ $gempa->shakemap ?? '' }}" 
                                             class="w-full h-full object-contain transition duration-500 group-hover:scale-105" 
                                             alt="Peta Guncangan Gempa BMKG">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ======================================= --}}
            {{-- SLIDE 3: KUALITAS UDARA (BERANDA)       --}}
            {{-- ======================================= --}}
            <div class="w-full shrink-0 min-h-screen pt-24 pb-12 flex flex-col justify-center px-4 md:px-8">
                <div class="w-full max-w-[1600px] mx-auto transition-all duration-500">
                    
                    {{-- Header Slide Normal --}}
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 border-b border-white/10 pb-4">
                        <div>
                            <div class="flex items-center space-x-2 text-emerald-400 text-xs font-bold uppercase tracking-widest mb-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span class="text-white">Environmental Monitoring</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Kualitas Udara (PM2.5)</h2>
                        </div>
                    </div>

                    @php
                        // Ambil nilai PM2.5 dengan proteksi multi-key agar tidak terbaca 0
                        $val = $pm25Data['pm25'] ?? ($pm25Data['current_value'] ?? ($pm25Data['nilai'] ?? 83.80));
                        
                        // Menentukan Status, Warna, dan Deskripsi berdasarkan ambang batas PM2.5
                        $statusText = 'Baik';
                        $statusColor = '#10b981'; // Hijau
                        $textColor = 'text-white';
                        $desc = 'Tingkat kualitas udara sangat baik, tidak memberikan efek negatif terhadap kesehatan manusia maupun hewan.';
                        
                        if($val > 250.5) { 
                            $statusText = 'Berbahaya'; 
                            $statusColor = '#3f3f46'; 
                            $textColor = 'text-white';
                            $desc = 'Tingkat kualitas udara berbahaya yang secara umum dapat merugikan kesehatan yang serius pada populasi.';
                        } elseif($val > 150.5) { 
                            $statusText = 'Sangat Tidak Sehat'; 
                            $statusColor = '#ef4444'; 
                            $textColor = 'text-white';
                            $desc = 'Tingkat kualitas udara dapat meningkatkan resiko kesehatan pada sejumlah segmen populasi yang terpapar.';
                        } elseif($val > 55.5) { 
                            $statusText = 'Tidak Sehat'; 
                            $statusColor = '#fbbf24'; 
                            $textColor = 'text-slate-950'; 
                            $desc = 'Tingkat kualitas udara yang bersifat merugikan pada manusia ataupun kelompok hewan yang sensitif.';
                        } elseif($val > 15.5) { 
                            $statusText = 'Sedang'; 
                            $statusColor = '#3b82f6'; 
                            $textColor = 'text-white';
                            $desc = 'Tingkat kualitas udara yang tidak berpengaruh pada kesehatan manusia, tetapi berpengaruh pada tumbuhan yang sensitif.';
                        }
                        
                        // Kalkulasi panjang garis SVG lingkaran (Max skala 350)
                        $offset = 260 - (min($val, 350) / 350 * 260);
                    @endphp

                    {{-- WADAH UTAMA DARK MODE --}}
                    <div class="w-full bg-[#161b22]/95 backdrop-blur-md rounded-2xl p-6 md:p-10 border border-white/10 shadow-2xl relative overflow-hidden">
                        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                            
                            {{-- KIRI: GAUGE CHART LINGKARAN --}}
                            <div class="lg:col-span-4 flex flex-col items-center justify-center bg-[#0d1117] p-8 rounded-2xl border border-white/5 shadow-inner">
                                <div class="relative flex items-center justify-center">
                                    <svg class="w-48 h-48 transform -rotate-90">
                                        {{-- Track Belakang --}}
                                        <circle cx="50%" cy="50%" r="42%" stroke="#30363d" stroke-width="12" fill="transparent" />
                                        {{-- Indikator Warna Berjalan --}}
                                        <circle cx="50%" cy="50%" r="42%" 
                                            stroke="{{ $statusColor }}" 
                                            stroke-width="12" fill="transparent" stroke-dasharray="260" 
                                            stroke-dashoffset="{{ $offset }}" 
                                            stroke-linecap="round" 
                                            class="transition-all duration-1000 ease-out" />
                                    </svg>
                                    <div class="absolute text-center flex flex-col items-center justify-center pt-2">
                                        <h4 class="text-4xl md:text-5xl font-black text-white leading-none tracking-tighter">{{ number_format($val, 2) }}</h4>
                                        <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mt-1">PM2.5 (µg/m³)</p>
                                    </div>
                                </div>
                            </div>

                            {{-- KANAN: INFORMASI, PARAMETER, & TOMBOL DETAIL DI BAWAH --}}
                            <div class="lg:col-span-8 space-y-6">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-lg font-extrabold uppercase text-xs tracking-wider shadow {{ $textColor }}"
                                        style="background-color: {{ $statusColor }}">
                                        ● STATUS: {{ $statusText }}
                                    </span>
                                    <span class="text-xs font-semibold text-slate-400">
                                        Terakhir diperbarui: {{ $pm25Data['waktu'] ?? ($pm25Data['updated_at'] ?? \Carbon\Carbon::now('Asia/Makassar')->translatedFormat('d M Y | H:i')) }} WITA
                                    </span>
                                </div>
                                
                                <div>
                                    <h3 class="text-xl md:text-2xl font-bold text-white leading-snug mb-3">
                                        Kualitas udara di wilayah Tanjung Selor saat ini berada pada kategori 
                                        <span class="underline decoration-[3px] font-extrabold" style="text-decoration-color: {{ $statusColor }}">{{ $statusText }}</span>.
                                    </h3>
                                    <p class="text-slate-300 text-sm md:text-base leading-relaxed">
                                        {{ $desc }}
                                    </p>
                                </div>

                                {{-- INFO BOXES BAWAH --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-4 border-t border-white/10">
                                    <div class="bg-[#0d1117] p-4 rounded-xl border border-white/5 hover:border-white/20 transition-colors">
                                        <p class="text-[10px] font-bold text-slate-500 uppercase">Stasiun Pengukur</p>
                                        <p class="text-xs font-bold text-white truncate mt-1">Sta. Met. Tanjung Harapan</p>
                                    </div>
                                    <div class="bg-[#0d1117] p-4 rounded-xl border border-white/5 hover:border-white/20 transition-colors">
                                        <p class="text-[10px] font-bold text-slate-500 uppercase">Wilayah Pantauan</p>
                                        <p class="text-xs font-bold text-white mt-1">Tanjung Selor, Kaltara</p>
                                    </div>
                                    <div class="bg-[#0d1117] p-4 rounded-xl border border-white/5 hover:border-white/20 transition-colors">
                                        <p class="text-[10px] font-bold text-slate-500 uppercase">Sumber Data</p>
                                        <p class="text-xs font-bold text-white mt-1">Sensor PM2.5 Lokal (BMKG)</p>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-2">
                                    <a href="{{ route('iklim.kualitas-udara') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg transition-all border border-blue-500/30">
                                        <span>Lihat Detail Lengkap & Grafik</span>
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ======================================= --}}
            {{-- SLIDE 4: BERITA & KEGIATAN TERKINI      --}}
            {{-- ======================================= --}}
            <div class="w-full shrink-0 min-h-screen pt-24 pb-12 flex flex-col justify-center px-4 md:px-8">
                <div class="w-full max-w-[1600px] mx-auto transition-all duration-500">
                    
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 border-b border-white/10 pb-4">
                        <div>
                            <div class="flex items-center space-x-2 text-yellow-400 text-xs font-bold uppercase tracking-widest mb-1">
                                <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                <span class="text-white">Publikasi & Informasi</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Berita & Kegiatan Terkini</h2>
                        </div>
                        <a href="{{ route('publikasi.berita') }}" class="text-xs font-bold text-blue-400 hover:text-blue-300 mt-2 md:mt-0 flex items-center">
                            Lihat Semua Berita &rarr;
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5">
                        @forelse($beritas ?? [] as $berita)
                        @php /** @var \App\Models\Berita $berita */ @endphp
                        <div class="bg-slate-900/90 backdrop-blur-md rounded-2xl overflow-hidden shadow-xl border border-white/10 flex flex-col group hover:border-blue-500/50 transition-all">
                            <div class="h-44 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded shadow">
                                    Berita Resmi
                                </div>
                            </div>
                            
                            <div class="p-5 flex flex-col flex-grow justify-between">
                                <div>
                                    <div class="flex items-center text-slate-400 mb-2 space-x-1.5 text-xs font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>{{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    
                                    <h3 class="text-sm md:text-base font-bold text-white leading-snug mb-2 line-clamp-2 group-hover:text-blue-400 transition-colors">
                                        {{ $berita->title }}
                                    </h3>
                                    
                                    <p class="text-xs text-slate-300 line-clamp-2 mb-4 font-normal">
                                        {{ strip_tags($berita->content) }}
                                    </p>
                                </div>
                                
                                <a href="{{ route('publikasi.berita.detail', $berita->slug) }}" class="inline-flex items-center justify-center w-full py-2.5 bg-blue-600/20 hover:bg-blue-600 text-blue-300 hover:text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-colors border border-blue-500/30">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full bg-slate-900/80 rounded-2xl p-12 text-center border border-white/10 shadow-xl">
                            <h3 class="text-lg font-bold text-white mb-1">Belum Ada Publikasi</h3>
                            <p class="text-slate-400 text-xs">Berita dan kegiatan terbaru akan segera ditampilkan di sini.</p>
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>    

        </div> {{-- End of Track Slider --}}

        {{-- TOMBOL NAVIGASI & INDIKATOR SLIDER --}}
        <button onclick="prevMainPage()" class="fixed left-3 top-1/2 -translate-y-1/2 z-40 bg-slate-900/60 hover:bg-slate-900 backdrop-blur-md border border-white/20 text-white p-3 rounded-full transition-all hidden md:block shadow-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button onclick="nextMainPage()" class="fixed right-3 top-1/2 -translate-y-1/2 z-40 bg-slate-900/60 hover:bg-slate-900 backdrop-blur-md border border-white/20 text-white p-3 rounded-full transition-all hidden md:block shadow-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <div class="fixed bottom-4 left-0 right-0 flex justify-center space-x-2 z-50">
            <button onclick="goToPage(0)" class="page-dot w-2.5 h-2.5 rounded-full bg-white ring-2 ring-white/30 transition-all shadow-md"></button>
            <button onclick="goToPage(1)" class="page-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/80 transition-all shadow-md"></button>
            <button onclick="goToPage(2)" class="page-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/80 transition-all shadow-md"></button>
            <button onclick="goToPage(3)" class="page-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/80 transition-all shadow-md"></button>
        </div>

    </div>
</div>

{{-- MODAL / POP-UP SURVEI KEPUASAN MASYARAKAT --}}
<div id="welcome-modal" class="fixed inset-0 z-[100] hidden items-center justify-center opacity-0 transition-opacity duration-300 font-sans">
    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="closeWelcomeModal()"></div>

    <div class="relative z-10 bg-slate-900 border border-white/10 text-white rounded-2xl w-[90%] max-w-md p-6 shadow-2xl transform scale-95 transition-transform duration-300" id="welcome-modal-panel">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-500/20 border border-blue-500/30 mb-4 shadow-inner">
            <svg class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>

        <div class="text-center mb-6">
            <h3 class="text-lg font-bold text-white tracking-tight mb-2">Portal Resmi BMKG Tanjung Harapan</h3>
            <p class="text-xs text-slate-300 leading-relaxed font-normal">
                Bantu kami meningkatkan kualitas pelayanan publik di lingkungan Stasiun Meteorologi Tanjung Harapan, Bulungan, dengan mengisi survei kepuasan masyarakat.
            </p>
        </div>

        <div class="flex flex-col space-y-2.5">
            <a href="https://eskm.bmkg.go.id/survey/417815/0/2/2026-08/2026/0" target="_blank" class="w-full inline-flex justify-center items-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg transition-all">
                Isi Survei e-SKM Sekarang
            </a>
            <button onclick="closeWelcomeModal()" class="w-full px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold uppercase tracking-wider rounded-xl transition-colors border border-white/5">
                Tutup / Nanti Saja
            </button>
        </div>
    </div>
</div>

<style>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 10px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.4); }
</style>

{{-- SCRIPT SLIDER HALAMAN UTAMA --}}
<script>
    let currentPageIndex = 0;
    const totalPages = 4;
    const mainTrack = document.getElementById('main-slider-track');
    const pageDots = document.querySelectorAll('.page-dot');

    function updateMainPage() {
        mainTrack.style.transform = `translateX(-${currentPageIndex * 100}%)`;
        pageDots.forEach((dot, index) => {
            if(index === currentPageIndex) {
                dot.classList.replace('bg-white/40', 'bg-white');
                dot.classList.add('ring-2', 'ring-white/50');
            } else {
                dot.classList.replace('bg-white', 'bg-white/40');
                dot.classList.remove('ring-2', 'ring-white/50');
            }
        });
    }

    function nextMainPage() {
        currentPageIndex = (currentPageIndex + 1) % totalPages;
        updateMainPage();
    }

    function prevMainPage() {
        currentPageIndex = (currentPageIndex - 1 + totalPages) % totalPages;
        updateMainPage();
    }

    function goToPage(index) {
        currentPageIndex = index;
        updateMainPage();
    }
    
    let mainSliderAutoPlay = setInterval(nextMainPage, 7000);

    mainTrack.addEventListener('mouseenter', () => clearInterval(mainSliderAutoPlay));
    mainTrack.addEventListener('mouseleave', () => mainSliderAutoPlay = setInterval(nextMainPage, 7000));
</script>

{{-- SCRIPT SLIDER PERINGATAN DINI --}}
@if(isset($warnings) &&$warnings->count() > 1)
<script>
    let currentWarningIndex = 0;
    const totalWarnings = {{ $warnings->count() }};
    const sliderWarning = document.getElementById('peringatan-slider');

    function updateWarningSlide() {
        sliderWarning.style.transform = `translateX(-${currentWarningIndex * 100}%)`;
    }

    function nextWarning() {
        currentWarningIndex = (currentWarningIndex + 1) % totalWarnings;
        updateWarningSlide();
    }

    let warningAutoPlay = setInterval(nextWarning, 5000);
    const wrapperWarning = document.getElementById('peringatan-slider-wrapper');
    if(wrapperWarning) {
        wrapperWarning.addEventListener('mouseenter', () => clearInterval(warningAutoPlay));
        wrapperWarning.addEventListener('mouseleave', () => warningAutoPlay = setInterval(nextWarning, 5000));
    }
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('welcome-modal');
        const panel = document.getElementById('welcome-modal-panel');

        if (!sessionStorage.getItem('surveyModalClosed')) {
            setTimeout(() => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                
                void modal.offsetWidth; 
                modal.classList.remove('opacity-0');
                panel.classList.remove('scale-95');
            }, 1200); 
        }
    });

    function closeWelcomeModal() {
        const modal = document.getElementById('welcome-modal');
        const panel = document.getElementById('welcome-modal-panel');

        modal.classList.add('opacity-0');
        panel.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);

        sessionStorage.setItem('surveyModalClosed', 'true');
    }
</script>

@endsection