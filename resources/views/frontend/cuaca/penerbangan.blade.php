@extends('layouts.app')

@section('content')

{{-- Header Banner Tema Cyan/Aviation --}}
<section class="relative bg-slate-900 pt-32 pb-32 2xl:pt-48 2xl:pb-48 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    <div class="absolute top-0 right-0 w-[500px] 2xl:w-[800px] h-[500px] 2xl:h-[800px] bg-cyan-500/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3"></div>
    
    {{-- KUNCI 1: Wrapper Hero Merentang --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 2xl:space-x-4 px-4 py-1.5 2xl:px-8 2xl:py-3 mb-6 2xl:mb-10 bg-cyan-500/20 border border-cyan-500/30 rounded-full text-cyan-400 text-[10px] 2xl:text-lg font-black uppercase tracking-[0.2em]">
            <span class="w-2 h-2 2xl:w-4 2xl:h-4 rounded-full bg-cyan-500 animate-ping"></span>
            <span>Live AWOS Monitoring</span>
        </div>
        <h1 class="text-4xl md:text-5xl 2xl:text-[7rem] font-black text-white tracking-tighter mb-4 2xl:mb-8 italic uppercase">
            Aviation Weather <span class="text-cyan-500">System</span>
        </h1>
        <p class="text-slate-400 font-medium max-w-2xl 2xl:max-w-5xl mx-auto md:text-base 2xl:text-2xl 2xl:leading-relaxed">
            Cuaca Penerbangan di Bandara Tanjung Harapan (WAQD) <br> Data diperbarui secara real-time dari Automatic Weather Observing System
        </p>
    </div>
</section>

{{-- Dashboard Content --}}
<section class="relative w-full bg-[#0f172a] pb-24 2xl:pb-40 -mt-20 2xl:-mt-32 z-20">
    {{-- KUNCI 2: Wrapper Konten Utama Merentang --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12">
        
        {{-- KUNCI 3: Hapus max-w-6xl, ubah menjadi w-full --}}
        <div class="w-full mx-auto">
            
            @if($error)
                <div class="bg-slate-800 rounded-3xl 2xl:rounded-[3rem] border border-slate-700 p-16 2xl:p-32 text-center shadow-2xl">
                    <span class="text-6xl 2xl:text-9xl mb-6 2xl:mb-12 block">📡</span>
                    <h3 class="text-2xl 2xl:text-5xl font-black text-white mb-2 2xl:mb-6">Offline Connection</h3>
                    <p class="text-slate-400 mb-8 2xl:mb-12 2xl:text-2xl">{{ $error }}</p>
                    <button onclick="window.location.reload()" class="bg-cyan-600 text-white font-black py-3 px-8 2xl:py-5 2xl:px-12 rounded-full hover:bg-cyan-500 transition-all uppercase text-xs 2xl:text-xl tracking-widest">Try Reconnect</button>
                </div>
            @elseif($awosData)
                @php
                    // MAPPING DATA AWOS (Lengkap dengan Sensor Baru)
                    $wd10m  = $awosData['wind_dir_10m'] ?? 0;
                    $ws10m  = $awosData['wind_speed_10m'] ?? 0;
                    
                    // Kecepatan Angin Min & Max
                    $ws_min = $awosData['wind_speed_10m_min'] ?? '-';
                    $ws_max = $awosData['wind_speed_10m_max'] ?? '-';

                    // Suhu & Dew Point
                    $temp   = $awosData['t'] ?? $awosData['temp'] ?? $awosData['ta'] ?? '///';
                    $dew    = $awosData['dew_point'] ?? $awosData['dp'] ?? $awosData['dew'] ?? '///';

                    $qnh    = $awosData['qnh'] ?? '-';
                    $qfe    = $awosData['qfe'] ?? '-';
                    $hum    = $awosData['hum'] ?? '-';
                    $solRad = $awosData['sol_rad'] ?? '-';
                    $prec   = $awosData['prec_1h'] ?? '0.0';
                    
                    $obsTime = $awosData['observation_time'] ?? null;
                    $waktuUpdate = $obsTime ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $obsTime, 'UTC')->setTimezone('Asia/Makassar')->translatedFormat('d M Y • H:i:s') : '-';

                    // LOGIKA KONVERSI ARAH ANGIN (DERAJAT KE TEKS)
                    $arahAnginTeks = '-';
                    if (is_numeric($wd10m)) {
                        $val = floor(($wd10m / 45) + 0.5);
                        $arrArah = ["Utara", "Timur Laut", "Timur", "Tenggara", "Selatan", "Barat Daya", "Barat", "Barat Laut"];
                        $arahAnginTeks = $arrArah[($val % 8)];
                    }
                @endphp

                <div class="bg-slate-900 rounded-[2.5rem] 2xl:rounded-[4rem] shadow-2xl border border-slate-800 overflow-hidden ring-1 ring-white/5 w-full">
                    
                    {{-- Status Bar Atas --}}
                    <div class="bg-slate-950/50 border-b border-slate-800 px-8 py-4 2xl:px-12 2xl:py-8 flex flex-col md:flex-row justify-between items-center">
                        <div class="flex items-center space-x-3 2xl:space-x-6 mb-2 md:mb-0">
                            <span class="px-3 py-1 2xl:px-5 2xl:py-2 bg-cyan-500/10 border border-cyan-500/30 text-cyan-500 text-[10px] 2xl:text-lg font-black rounded-lg 2xl:rounded-xl">ICAO: WAQD</span>
                            <span class="text-slate-500 font-bold text-xs 2xl:text-xl">TANJUNG SELOR, INDONESIA</span>
                        </div>
                        <div class="text-slate-400 text-[11px] 2xl:text-lg font-bold">
                            <span class="text-slate-600 mr-2 uppercase tracking-widest">Last Update:</span> {{ $waktuUpdate }} WITA
                        </div>
                    </div>

                    {{-- Main Dashboard Layout --}}
                    <div class="p-8 md:p-12 2xl:p-24 flex flex-col lg:flex-row gap-12 2xl:gap-24">
                        
                        {{-- SISI KIRI: WIND ANALYZER --}}
                        <div class="w-full lg:w-2/5 flex flex-col items-center justify-center">
                            {{-- KUNCI 4: Radar Angin Diperbesar di 2xl --}}
                            <div class="relative w-64 h-64 md:w-80 md:h-80 2xl:w-[500px] 2xl:h-[500px]">
                                {{-- Background Dial --}}
                                <div class="absolute inset-0 rounded-full border-[12px] 2xl:border-[20px] border-slate-800 bg-slate-950 shadow-inner flex items-center justify-center">
                                    <div class="absolute inset-4 2xl:inset-8 rounded-full border border-slate-800/50"></div>
                                    <span class="absolute top-2 2xl:top-6 font-black text-slate-600 text-lg 2xl:text-4xl">N</span>
                                    <span class="absolute right-4 2xl:right-8 font-black text-slate-600 text-lg 2xl:text-4xl">E</span>
                                    <span class="absolute bottom-2 2xl:bottom-6 font-black text-slate-600 text-lg 2xl:text-4xl">S</span>
                                    <span class="absolute left-4 2xl:left-8 font-black text-slate-600 text-lg 2xl:text-4xl">W</span>
                                    
                                    {{-- Angka Tengah --}}
                                    <div class="text-center z-10">
                                        <p class="text-xs 2xl:text-xl font-black text-cyan-500/60 uppercase tracking-tighter">Direction</p>
                                        <h4 class="text-6xl 2xl:text-[8rem] font-black text-white leading-none">{{ $wd10m }}°</h4>
                                        <p class="text-sm 2xl:text-2xl font-bold text-slate-400 mt-2 2xl:mt-4 italic">{{ $arahAnginTeks }}</p>
                                    </div>
                                </div>

                                {{-- Jarum Angin Dinamis --}}
                                <div class="absolute inset-0 flex items-center justify-center transition-transform duration-1000 ease-out" style="transform: rotate({{ $wd10m }}deg);">
                                    <div class="w-1.5 2xl:w-2.5 h-1/2 bg-gradient-to-t from-cyan-500 to-transparent absolute bottom-1/2 rounded-full shadow-[0_0_15px_rgba(6,182,212,0.5)]"></div>
                                    <div class="w-4 h-4 2xl:w-8 2xl:h-8 bg-cyan-500 rounded-full border-4 2xl:border-8 border-slate-900 shadow-lg"></div>
                                </div>
                            </div>
                            
                            {{-- Kotak Detail Angin (Speed, Min, Max) --}}
                            <div class="mt-8 2xl:mt-16 bg-slate-950 border border-slate-800 p-6 2xl:p-10 rounded-3xl 2xl:rounded-[2.5rem] w-full max-w-[320px] 2xl:max-w-[450px] shadow-lg">
                                <p class="text-[10px] 2xl:text-base font-black text-slate-500 uppercase tracking-widest mb-1 2xl:mb-3 text-center">Wind Speed</p>
                                <p class="text-4xl 2xl:text-7xl font-black text-white text-center">{{ $ws10m }} <span class="text-lg 2xl:text-3xl text-cyan-500 font-bold uppercase italic">Kts</span></p>
                                
                                <div class="grid grid-cols-2 gap-4 2xl:gap-8 mt-5 2xl:mt-8 pt-4 2xl:pt-6 border-t border-slate-800/80 text-center">
                                    <div>
                                        <p class="text-[9px] 2xl:text-sm font-black text-slate-500 uppercase tracking-widest mb-1 2xl:mb-2">Min Gust</p>
                                        <p class="text-xl 2xl:text-4xl font-black text-slate-300">{{ $ws_min }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] 2xl:text-sm font-black text-slate-500 uppercase tracking-widest mb-1 2xl:mb-2">Max Gust</p>
                                        <p class="text-xl 2xl:text-4xl font-black text-rose-500">{{ $ws_max }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SISI KANAN: PARAMETER GRID TERLENGKAP --}}
                        <div class="w-full lg:w-3/5 grid grid-cols-1 md:grid-cols-2 gap-6 2xl:gap-10">
                            
                            {{-- Suhu & Titik Embun --}}
                            <div class="bg-slate-950/40 border border-slate-800 p-6 2xl:p-10 rounded-3xl 2xl:rounded-[2.5rem] group hover:border-orange-500/30 transition-all">
                                <p class="text-[10px] 2xl:text-base font-black text-slate-500 uppercase tracking-widest mb-5 2xl:mb-8">Temperature & Dew</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex space-x-6 2xl:space-x-10 items-end">
                                        <div>
                                            <p class="text-[10px] 2xl:text-base font-bold text-slate-600 mb-1 2xl:mb-2">TEMP</p>
                                            <div class="text-3xl 2xl:text-6xl font-black text-white">{{ $temp }}<span class="text-sm 2xl:text-2xl text-slate-600 font-bold ml-1 2xl:ml-2">°C</span></div>
                                        </div>
                                        <div class="w-px h-8 2xl:h-12 bg-slate-800 mb-1 2xl:mb-2"></div>
                                        <div>
                                            <p class="text-[10px] 2xl:text-base font-bold text-slate-600 mb-1 2xl:mb-2">DEW</p>
                                            <div class="text-3xl 2xl:text-6xl font-black text-white">{{ $dew }}<span class="text-sm 2xl:text-2xl text-slate-600 font-bold ml-1 2xl:ml-2">°C</span></div>
                                        </div>
                                    </div>
                                    <div class="w-12 h-12 2xl:w-20 2xl:h-20 bg-orange-500/10 rounded-xl 2xl:rounded-2xl flex items-center justify-center text-orange-500 text-xl 2xl:text-4xl shrink-0">🌡️</div>
                                </div>
                            </div>

                            {{-- Humidity --}}
                            <div class="bg-slate-950/40 border border-slate-800 p-6 2xl:p-10 rounded-3xl 2xl:rounded-[2.5rem] group hover:border-blue-500/30 transition-all">
                                <p class="text-[10px] 2xl:text-base font-black text-slate-500 uppercase tracking-widest mb-4 2xl:mb-8">Air Humidity</p>
                                <div class="flex items-center justify-between">
                                    <div class="text-4xl 2xl:text-7xl font-black text-white">{{ $hum }}<span class="text-xl 2xl:text-4xl text-slate-600 ml-1">%</span></div>
                                    <div class="w-12 h-12 2xl:w-20 2xl:h-20 bg-blue-500/10 rounded-xl 2xl:rounded-2xl flex items-center justify-center text-blue-500 text-xl 2xl:text-4xl shrink-0">💧</div>
                                </div>
                                <div class="w-full bg-slate-800 h-1.5 2xl:h-3 mt-4 2xl:mt-8 rounded-full overflow-hidden">
                                    <div class="bg-blue-500 h-full transition-all duration-1000" style="width: {{ $hum == '-' ? 0 : $hum }}%;"></div>
                                </div>
                            </div>

                            {{-- Pressure QNH & QFE --}}
                            <div class="bg-slate-950/40 border border-slate-800 p-6 2xl:p-10 rounded-3xl 2xl:rounded-[2.5rem] group hover:border-indigo-500/30 transition-all md:col-span-2">
                                <p class="text-[10px] 2xl:text-base font-black text-slate-500 uppercase tracking-widest mb-4 2xl:mb-8">Pressure (Altimeter)</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex space-x-10 2xl:space-x-20 items-end">
                                        <div>
                                            <p class="text-[10px] 2xl:text-base font-bold text-slate-600 mb-1 2xl:mb-2">QNH</p>
                                            <div class="text-4xl 2xl:text-7xl font-black text-white">{{ $qnh }}<span class="text-sm 2xl:text-2xl text-slate-600 font-bold ml-1 2xl:ml-3">hPa</span></div>
                                        </div>
                                        <div>
                                            <p class="text-[10px] 2xl:text-base font-bold text-slate-600 mb-1 2xl:mb-2">QFE</p>
                                            <div class="text-4xl 2xl:text-7xl font-black text-white">{{ $qfe }}<span class="text-sm 2xl:text-2xl text-slate-600 font-bold ml-1 2xl:ml-3">hPa</span></div>
                                        </div>
                                    </div>
                                    <div class="w-14 h-14 2xl:w-24 2xl:h-24 bg-indigo-500/10 rounded-xl 2xl:rounded-2xl flex items-center justify-center text-indigo-500 text-2xl 2xl:text-5xl shrink-0">⏱️</div>
                                </div>
                            </div>

                            {{-- Solar Radiation --}}
                            <div class="bg-slate-950/40 border border-slate-800 p-6 2xl:p-10 rounded-3xl 2xl:rounded-[2.5rem] group hover:border-amber-500/30 transition-all">
                                <p class="text-[10px] 2xl:text-base font-black text-slate-500 uppercase tracking-widest mb-4 2xl:mb-8">Solar Radiation</p>
                                <div class="flex items-center justify-between">
                                    <div class="text-4xl 2xl:text-7xl font-black text-white">{{ $solRad }}<span class="text-sm 2xl:text-2xl text-slate-600 font-bold ml-1 2xl:ml-2">W/m²</span></div>
                                    <div class="w-12 h-12 2xl:w-20 2xl:h-20 bg-amber-500/10 rounded-xl 2xl:rounded-2xl flex items-center justify-center text-amber-500 text-xl 2xl:text-4xl shrink-0">☀️</div>
                                </div>
                            </div>

                            {{-- Precipitation --}}
                            <div class="bg-slate-950/40 border border-slate-800 p-6 2xl:p-10 rounded-3xl 2xl:rounded-[2.5rem] group hover:border-emerald-500/30 transition-all">
                                <p class="text-[10px] 2xl:text-base font-black text-slate-500 uppercase tracking-widest mb-4 2xl:mb-8">Precipitation (1h)</p>
                                <div class="flex items-center justify-between">
                                    <div class="text-4xl 2xl:text-7xl font-black text-white">{{ $prec }}<span class="text-sm 2xl:text-2xl text-slate-600 font-bold ml-1 2xl:ml-2">mm</span></div>
                                    <div class="w-12 h-12 2xl:w-20 2xl:h-20 bg-emerald-500/10 rounded-xl 2xl:rounded-2xl flex items-center justify-center text-emerald-500 text-xl 2xl:text-4xl shrink-0">🌧️</div>
                                </div>
                            </div>

                            {{-- Info Tambahan --}}
                            <div class="md:col-span-2 mt-2 2xl:mt-4 p-5 2xl:p-8 bg-slate-950 border border-slate-800 rounded-2xl 2xl:rounded-3xl flex items-start md:items-center space-x-4 2xl:space-x-8">
                                <div class="flex-shrink-0 w-8 h-8 2xl:w-12 2xl:h-12 bg-slate-800 rounded-full flex items-center justify-center text-slate-400 text-sm 2xl:text-xl">ℹ️</div>
                                <p class="text-[11px] 2xl:text-lg font-medium text-slate-500 leading-relaxed italic">
                                    METAR WAQD: Automated Monitoring Observation System. Indikator arah angin 10 meter mengacu pada derajat geografis utara. Gunakan data QNH & QFE untuk pengaturan Altimeter Pesawat.
                                </p>
                            </div>

                        </div>
                    </div>

                </div>

            @endif

        </div>
    </div>
</section>
<style>
    .transition-all { transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 500ms; }
</style>

@endsection