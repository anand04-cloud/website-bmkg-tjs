@extends('layouts.app')

@section('title', 'Dashboard Kualitas Udara')

@section('content')

{{-- HEADER BANNER TEMA GELAP (Sesuai Template BMKG) --}}
<section class="relative bg-slate-900 pt-32 pb-24 2xl:pt-48 2xl:pb-36 overflow-hidden">
    {{-- Background Texture & Glow --}}
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    <div class="absolute top-0 right-0 w-96 2xl:w-[800px] h-96 2xl:h-[800px] bg-emerald-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-96 2xl:w-[800px] h-96 2xl:h-[800px] bg-blue-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    
    <div class="w-[98%] max-w-[1600px] mx-auto px-6 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 mb-6 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-xs font-black uppercase tracking-widest shadow-lg">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Real-time Monitoring Station</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4">
            Monitoring Kualitas Udara
        </h1>
        <p class="text-slate-400 font-medium max-w-2xl mx-auto leading-relaxed">
            Sistem Pemantauan Konsentrasi Partikulat (PM2.5) dan Parameter Cuaca Pendukung terintegrasi di Stasiun Meteorologi Tanjung Harapan.
        </p>
    </div>
</section>

{{-- MAIN CONTENT WADAH TERANG (Berada di atas banner gelap) --}}
<section class="relative w-full bg-[#f8faff] pb-24 -mt-10 z-20 font-sans">
    <div class="w-[98%] max-w-[1600px] mx-auto px-4 md:px-8">
        
        {{-- WADAH KARTU PUTIH --}}
        <div class="bg-[#f4f7f9] rounded-[2rem] p-4 md:p-8 shadow-2xl border border-slate-200/60">

            {{-- WADAH KARTU DATA REALTIME --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch mb-6">
                
                {{-- KIRI: KONSENTRASI PM2.5 --}}
                <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200 p-6 flex flex-col justify-between shadow-sm">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                        <div class="flex items-center space-x-2 text-blue-600 font-bold text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            <span>Konsentrasi PM2.5</span>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 bg-slate-50 border border-slate-200 text-slate-500 text-[10px] font-bold rounded-md uppercase tracking-wide">
                            <svg class="w-3 h-3 text-red-500 mr-1.5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Realtime
                        </span>
                    </div>
                    
                    @php
                        // Logika Status ISPU murni PHP
                        $val = $pm25Data['pm25'] ?? 0; 
                        $statusText = 'BAIK';
                        $statusBg = 'bg-[#00ff00] text-black'; // Hijau

                        if($val > 250.4) { $statusText = 'BERBAHAYA'; $statusBg = 'bg-black text-white'; }
                        elseif($val > 150.4) { $statusText = 'SANGAT TIDAK SEHAT'; $statusBg = 'bg-red-600 text-white'; }
                        elseif($val > 55.4) { $statusText = 'TIDAK SEHAT'; $statusBg = 'bg-[#fbbf24] text-black'; } 
                        elseif($val > 15.5) { $statusText = 'SEDANG'; $statusBg = 'bg-blue-600 text-white'; }
                    @endphp

                    <div class="text-center flex-grow flex flex-col justify-center">
                        <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1">Nilai PM2.5 Saat Ini</p>
                        <div class="flex items-baseline justify-center space-x-1 mb-5">
                            <h3 class="text-7xl md:text-[6rem] font-black text-slate-800 leading-none tracking-tighter">{{ number_format($val, 2) }}</h3>
                            <span class="text-2xl md:text-3xl font-bold text-slate-500">µg/m³</span>
                        </div>
                        <div>
                            <span class="inline-block px-10 py-2.5 rounded-full font-black text-xl shadow-sm tracking-wide border border-slate-200 {{ $statusBg }}">
                                {{ $statusText }}
                            </span>
                        </div>
                    </div>

                    <div class="pt-5 mt-6 border-t border-slate-100 flex items-center text-slate-500 text-sm font-medium">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Update : <span class="font-bold text-slate-800 ml-1">{{ $pm25Data['waktu'] }} WITA</span>
                    </div>
                </div>

                {{-- KANAN: PARAMETER PENDUKUNG --}}
                <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 p-6 flex flex-col shadow-sm">
                    <div class="flex items-center space-x-2 text-teal-600 font-bold text-sm border-b border-slate-100 pb-4 mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                        <span>Parameter Pendukung Sensor</span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-5 flex-grow content-start">
                        <div class="bg-[#f8fafc] p-4 rounded-2xl border border-slate-100 flex items-center space-x-4">
                            <div class="p-3 bg-orange-50 text-orange-500 rounded-xl"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Suhu Udara</p>
                                <p class="text-2xl font-black text-slate-800">{{ $pm25Data['suhu'] }}<span class="text-sm font-semibold text-slate-400 ml-1">°C</span></p>
                            </div>
                        </div>
                        <div class="bg-[#f8fafc] p-4 rounded-2xl border border-slate-100 flex items-center space-x-4">
                            <div class="p-3 bg-blue-50 text-blue-500 rounded-xl"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Kelembapan</p>
                                <p class="text-2xl font-black text-slate-800">{{ $pm25Data['kelembapan'] }}<span class="text-sm font-semibold text-slate-400 ml-1">%</span></p>
                            </div>
                        </div>
                        <div class="bg-[#f8fafc] p-4 rounded-2xl border border-slate-100 flex items-center space-x-4">
                            <div class="p-3 bg-fuchsia-50 text-fuchsia-500 rounded-xl"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Tekanan Udara</p>
                                <p class="text-2xl font-black text-slate-800">{{ $pm25Data['tekanan'] }}<span class="text-sm font-semibold text-slate-400 ml-1">hPa</span></p>
                            </div>
                        </div>
                        <div class="bg-[#f8fafc] p-4 rounded-2xl border border-slate-100 flex items-center space-x-4">
                            <div class="p-3 bg-cyan-50 text-cyan-500 rounded-xl"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Kec. Angin</p>
                                <p class="text-2xl font-black text-slate-800">{{ $pm25Data['kec_angin'] }}<span class="text-sm font-semibold text-slate-400 ml-1">m/s</span></p>
                            </div>
                        </div>
                        <div class="bg-[#f8fafc] p-4 rounded-2xl border border-slate-100 flex items-center space-x-4">
                            <div class="p-3 bg-indigo-50 text-indigo-500 rounded-xl"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Arah Angin</p>
                                <p class="text-2xl font-black text-slate-800">{{ $pm25Data['arah_angin'] }}<span class="text-sm font-semibold text-slate-400 ml-1">°</span></p>
                            </div>
                        </div>
                        <div class="bg-[#f8fafc] p-4 rounded-2xl border border-slate-100 flex items-center space-x-4">
                            <div class="p-3 bg-emerald-50 text-emerald-500 rounded-xl"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Status Sensor</p>
                                <p class="text-xl font-black text-emerald-500 uppercase">NORMAL</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GRAFIK PM2.5 HARIAN (SVG RENDER PRESISI) --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-4 md:p-6 shadow-sm">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-6 pb-4 border-b border-slate-100 gap-4">
                    <div class="flex items-center space-x-3 text-slate-800">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                        <h3 class="font-black text-lg md:text-xl">Grafik Konsentrasi PM2.5 Harian</h3>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center bg-white border border-slate-300 rounded-lg px-3 py-2 shadow-sm text-sm font-semibold text-slate-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="relative w-full h-[420px] md:h-[520px] bg-white rounded-xl flex items-stretch select-none border border-slate-200 overflow-hidden">
                    {{-- Sumbu Y (Kiri) --}}
                    <div class="w-12 md:w-16 h-full relative border-r border-slate-200 bg-white z-20 text-[10px] md:text-[12px] font-black text-slate-800">
                        <span class="absolute top-2 w-full text-center">350</span>
                        <span class="absolute w-full text-center" style="bottom: 80%; transform: translateY(50%);">200</span>
                        <span class="absolute w-full text-center" style="bottom: 60%; transform: translateY(50%);">100</span>
                        <span class="absolute w-full text-center" style="bottom: 40%; transform: translateY(50%);">50</span>
                        <span class="absolute bottom-10 w-full text-center">0</span>
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span class="transform -rotate-90 text-[10px] text-slate-500 tracking-widest -ml-8">PM2.5 (ug/m3)</span>
                        </div>
                    </div>

                    {{-- Area Grafik Utama --}}
                    <div class="relative flex-1 bg-white pb-8">
                        {{-- Latar Warna Solid ISPU --}}
                        <div class="absolute inset-0 flex flex-col w-full h-full pb-8">
                            <div class="w-full bg-[#111111] border-b border-slate-700" style="height: 20%;"></div>
                            <div class="w-full bg-[#ff0000] border-b border-red-800" style="height: 20%;"></div>
                            <div class="w-full bg-[#ffff00] border-b border-yellow-600" style="height: 20%;"></div>
                            <div class="w-full bg-[#0000ff] border-b border-blue-800" style="height: 20%;"></div>
                            <div class="w-full bg-[#00ff00]" style="height: 20%;"></div>
                        </div>

                        {{-- Garis Grid Vertikal --}}
                        <div class="absolute inset-0 w-full h-full pointer-events-none pb-8">
                            <div class="flex w-full h-full">
                                @for($i=0; $i<24; $i++)
                                <div class="flex-1 border-r border-white/20 h-full"></div>
                                @endfor
                            </div>
                        </div>

                        @php
                            $hourlyData = [13.0, 17.1, 17.7, 21.8, 19.1, 18.4, 16.6, 20.2, 16.2, 18.5, 11.9, 16.5, 21.0, 17.9, 16.0, 15.5, 14.5, null, null, null, null, null, null, null];
                            
                            $coords = [];
                            foreach($hourlyData as $index => $v) {
                                if($v !== null) {
                                    // Posisi X per jam (0-23) dibagi rata ke dalam SVG viewBox 1000x1000
                                    $x = ($index / 23) * 1000;
                                    
                                    // Kalkulasi posisi Y dalam persentase
                                    if ($v <= 15.5) { $yPct = ($v / 15.5) * 20; }
                                    elseif ($v <= 55.4) { $yPct = 20 + (($v - 15.5) / (55.4 - 15.5)) * 20; }
                                    elseif ($v <= 150.4) { $yPct = 40 + (($v - 55.4) / (150.4 - 55.4)) * 20; }
                                    elseif ($v <= 250.4) { $yPct = 60 + (($v - 150.4) / (250.4 - 150.4)) * 20; }
                                    else { $yPct = 80 + (min($v - 250.4, 99.6) / 99.6) * 20; }
                                    
                                    // SVG viewBox 1000, Y dibalik (0 di atas, 1000 di bawah)
                                    $svgY = 1000 - ($yPct * 10);
                                    $coords[] = ['x' => $x, 'y' => $svgY, 'val' => $v, 'htmlX' => ($index / 23) * 100, 'htmlY' => $yPct];
                                }
                            }

                            // Membuat jalur garis mulus (Smooth Bezier Curve)
                            $pathSvg = "";
                            if (count($coords) > 0) {
                                $pathSvg = "M {$coords[0]['x']} {$coords[0]['y']}";
                                for ($i = 0; $i < count($coords) - 1; $i++) {
                                    $xc = ($coords[$i]['x'] + $coords[$i+1]['x']) / 2;
                                    $yc = ($coords[$i]['y'] + $coords[$i+1]['y']) / 2;
                                    $pathSvg .= " Q {$coords[$i]['x']} {$coords[$i]['y']}, {$xc} {$yc}";
                                }
                                $last = end($coords);
                                $pathSvg .= " L {$last['x']} {$last['y']}";
                            }
                        @endphp

                        {{-- SVG KANVAS UTAMA (Garis Grafik Presisi) --}}
                        <svg class="absolute inset-0 w-full h-full pointer-events-none z-10 overflow-visible pb-8" preserveAspectRatio="none" viewBox="0 0 1000 1000">
                            <path d="{{ $pathSvg }}" fill="none" stroke="#8b0000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>

                        {{-- RENDER TITIK BULAT & ANGKA DI ATASNYA (Satu Koordinat Presisi) --}}
                        <div class="absolute inset-0 w-full h-full z-20 pb-8 pointer-events-none">
                            @foreach($coords as $pt)
                            {{-- Bulatan Putih Ber-border Merah Tua --}}
                            <div class="absolute w-3 h-3 md:w-3.5 md:h-3.5 bg-white border-[2.5px] border-[#8b0000] rounded-full shadow-sm" 
                                style="left: {{ $pt['htmlX'] }}%; bottom: {{ $pt['htmlY'] }}%; transform: translate(-50%, 50%);"></div>
                            
                            {{-- Angka Nilai Oranye --}}
                            <div class="absolute flex justify-center z-30" 
                                style="left: {{ $pt['htmlX'] }}%; bottom: {{ $pt['htmlY'] }}%; transform: translate(-50%, 0); margin-bottom: 10px;">
                                <span class="text-[9px] md:text-[11px] font-black text-orange-500 bg-white/80 px-1 py-0.5 rounded shadow-sm leading-none text-center">
                                    {{ $pt['val'] }}
                                </span>
                            </div>
                            @endforeach
                        </div>

                        {{-- Sumbu X (Bawah): Jam 0-23 --}}
                        <div class="absolute bottom-0 left-0 right-0 h-8 flex bg-[#f0f2f5] border-t-2 border-slate-300 z-30 text-[10px] md:text-[11px] font-black text-slate-700 items-center">
                            @for($h=0; $h<24; $h++)
                            <div class="flex-1 flex items-center justify-center border-r border-slate-300 last:border-r-0">{{ $h }}</div>
                            @endfor
                        </div>
                    </div>

                    {{-- Sumbu Kanan: Avatar Indikator Status ISPU --}}
                    <div class="w-24 md:w-[140px] bg-slate-100 flex flex-col justify-between items-center p-2 border-l border-slate-300 z-20 space-y-1.5">
                        <div class="flex flex-col items-center bg-[#111111] rounded-xl p-1 w-full h-full justify-center border border-slate-300 shadow-sm text-center">
                            <div class="text-2xl md:text-4xl mb-0.5">☠️</div>
                            <div class="bg-white text-black text-[9px] md:text-[10px] font-black w-full rounded-md py-0.5 leading-tight mt-1">Berbahaya<br><span class="text-[7px] font-normal">> 250,5</span></div>
                        </div>
                        <div class="flex flex-col items-center bg-[#ff0000] rounded-xl p-1 w-full h-full justify-center border border-slate-300 shadow-sm text-center">
                            <div class="text-2xl md:text-4xl mb-0.5">😷</div>
                            <div class="bg-white text-black text-[9px] md:text-[10px] font-black w-full rounded-md py-0.5 leading-tight mt-1">Sgt. Tidak Sehat<br><span class="text-[7px] font-normal">150,5 - 250,4</span></div>
                        </div>
                        <div class="flex flex-col items-center bg-[#ffff00] rounded-xl p-1 w-full h-full justify-center border border-slate-300 shadow-sm text-center">
                            <div class="text-2xl md:text-4xl mb-0.5">🤧</div>
                            <div class="bg-white text-black text-[9px] md:text-[10px] font-black w-full rounded-md py-0.5 leading-tight mt-1">Tidak Sehat<br><span class="text-[7px] font-normal">55,5 - 150,4</span></div>
                        </div>
                        <div class="flex flex-col items-center bg-[#0000ff] rounded-xl p-1 w-full h-full justify-center border border-slate-300 shadow-sm text-center">
                            <div class="text-2xl md:text-4xl mb-0.5">😐</div>
                            <div class="bg-white text-black text-[9px] md:text-[10px] font-black w-full rounded-md py-0.5 leading-tight mt-1">Sedang<br><span class="text-[7px] font-normal">15,6 - 55,4</span></div>
                        </div>
                        <div class="flex flex-col items-center bg-[#00ff00] rounded-xl p-1 w-full h-full justify-center border border-slate-300 shadow-sm text-center">
                            <div class="text-2xl md:text-4xl mb-0.5">😇</div>
                            <div class="bg-white text-black text-[9px] md:text-[10px] font-black w-full rounded-md py-0.5 leading-tight mt-1">Baik<br><span class="text-[7px] font-normal">0 - 15,5</span></div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <span class="text-[11px] font-black text-slate-800 tracking-widest uppercase">JAM (WITA)</span>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection