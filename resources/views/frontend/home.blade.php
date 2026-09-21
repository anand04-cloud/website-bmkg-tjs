@extends('layouts.app')

@section('content')

{{-- ======================================================= --}}
{{-- BUNGKUS UTAMA (MENCAKUP SELURUH HALAMAN & BACKGROUND)   --}}
{{-- ======================================================= --}}
<div class="relative w-full bg-fixed bg-cover bg-center bg-no-repeat overflow-hidden min-h-screen" style="background-image: url('{{ asset('img/kantor.jpg') }}');">
    
    {{-- Overlay Kaca Gelap --}}
    <div class="absolute inset-0 bg-slate-900/70 z-0 pointer-events-none"></div>

    {{-- Efek Cahaya --}}
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-200/20 rounded-full blur-[120px] z-0 pointer-events-none"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-cyan-200/20 rounded-full blur-[120px] z-0 pointer-events-none"></div>

    {{-- ======================================================= --}}
    {{-- WADAH SLIDER UTAMA (Layer di atas background)           --}}
    {{-- ======================================================= --}}
    <div class="relative z-10 w-full">
        
        {{-- Track / Jalur Slider --}}
        <div id="main-slider-track" class="flex transition-transform duration-700 ease-in-out w-full items-start">
        
            {{-- ======================================= --}}
            {{-- SLIDE 1: CUACA & PERINGATAN DINI        --}}
            {{-- ======================================= --}}
            <div class="w-full shrink-0 min-h-screen pt-24 pb-8 flex flex-col justify-center px-4 md:px-6">
                {{-- WADAH BARU: Merentang 98% di PC Besar tanpa batas max-width kaku --}}
                <div class="w-[98%] 2xl:w-[98%] max-w-[2500px] mx-auto transition-all duration-500">
                    
                    {{-- Judul Halaman --}}
                    <div class="text-center mb-4 2xl:mb-8">
                        <h2 class="text-3xl 2xl:text-5xl font-black text-white uppercase tracking-tighter italic drop-shadow-md">Peringatan Dini & Prakiraan Cuaca</h2>
                        <div class="w-40 2xl:w-64 h-1.5 2xl:h-2.5 bg-blue-500 mx-auto mt-2 2xl:mt-4 rounded-full"></div>
                    </div>

                    {{-- BLOK PERINGATAN DINI --}}
                    @if(isset($warnings) && $warnings->count() > 0)
                        {{-- KONDISI 1: JIKA ADA PERINGATAN DINI (WASPADA) --}}
                        <div class="mb-4 2xl:mb-8 relative group" id="peringatan-slider-wrapper">
                            <div class="overflow-hidden rounded-2xl 2xl:rounded-[2rem] shadow-lg relative">
                                <div id="peringatan-slider" class="flex transition-transform duration-500 ease-in-out w-full">
                                    @foreach($warnings as $index => $item)
                                    <div class="w-full shrink-0">
                                        <div class="bg-[#fff4e5] border-l-4 2xl:border-l-8 border-[#d48806] p-3 md:p-4 2xl:p-6 flex items-start space-x-3 md:space-x-4 2xl:space-x-6 min-h-full">
                                            <div class="bg-[#ffdca9] p-2 2xl:p-4 rounded-xl 2xl:rounded-2xl text-[#d48806] shrink-0">
                                                <svg class="w-5 h-5 md:w-6 md:h-6 2xl:w-10 2xl:h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"/></svg>
                                            </div>
                                            <div class="overflow-hidden pr-8 w-full">
                                                <div class="flex items-center space-x-2 2xl:space-x-4 mb-1 2xl:mb-2">
                                                    <h4 class="font-black text-[#855d25] uppercase text-[10px] 2xl:text-sm tracking-[0.2em]">Peringatan Dini Terkini se Indonesia</h4>
                                                    <span class="text-[9px] 2xl:text-xs font-bold text-[#d48806] bg-[#ffdca9] px-2 py-0.5 2xl:px-3 2xl:py-1 rounded-full">
                                                        {{ $index + 1 }}/{{ $warnings->count() }}
                                                    </span>
                                                </div>
                                                <p class="text-[#a07842] text-[11px] 2xl:text-base leading-relaxed font-medium max-h-20 2xl:max-h-32 overflow-y-auto custom-scrollbar pr-3 text-justify">
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
                        {{-- KONDISI 2: JIKA TIDAK ADA PERINGATAN (CUACA AMAN) --}}
                        <div class="mb-4 2xl:mb-8 relative">
                            <div class="overflow-hidden rounded-2xl 2xl:rounded-[2rem] shadow-sm relative">
                                <div class="bg-emerald-50 border-l-4 2xl:border-l-8 border-emerald-500 p-3 md:p-4 2xl:p-6 flex items-center space-x-3 md:space-x-4 2xl:space-x-6 min-h-[80px] 2xl:min-h-[120px]">
                                    <div class="bg-emerald-100 p-2 2xl:p-4 rounded-xl 2xl:rounded-2xl text-emerald-600 shrink-0 shadow-inner">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="overflow-hidden w-full">
                                        <h4 class="font-black text-emerald-800 uppercase text-[10px] 2xl:text-sm tracking-[0.2em] mb-1">Status Cuaca Aman</h4>
                                        <p class="text-emerald-700 text-[11px] 2xl:text-base leading-relaxed font-medium">
                                            Saat ini tidak ada Peringatan Dini aktif yang dikeluarkan oleh BMKG untuk wilayah Kalimantan Utara.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- GRID CUACA (3 KOTA BERSUSUN) --}}
                    {{-- DIUBAH: max-h dinaikkan ke 85vh agar mengisi tinggi layar PC dengan sempurna tanpa scrollbar jika muat --}}
                    <div class="flex flex-col space-y-4 2xl:space-y-6 max-h-[70vh] 2xl:max-h-[85vh] overflow-y-auto custom-scrollbar pr-2 pb-4">
                        @foreach($weatherData as $wd)
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 2xl:gap-8 items-stretch">
                            
                            {{-- CUACA AKTUAL (KIRI) --}}
                            <div class="lg:col-span-4 bg-gradient-to-br from-blue-700 to-blue-500 rounded-xl 2xl:rounded-3xl p-4 2xl:p-8 text-white shadow-xl relative overflow-hidden flex flex-col justify-center h-full">
                                <div class="relative z-10 flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl 2xl:text-4xl font-black tracking-tight mb-1">{{ $wd['nama'] }}</h3>
                                        <p class="text-blue-100 text-[8px] 2xl:text-sm font-bold uppercase tracking-widest">
                                            {{ \Carbon\Carbon::now('Asia/Makassar')->translatedFormat('d M | H:i') }} WITA
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="my-3 2xl:my-6 flex flex-row items-center justify-between">
                                    <img src="{{ $wd['cuaca']['image'] ?? '#' }}" class="w-14 h-14 2xl:w-28 2xl:h-28 drop-shadow-xl animate-bounce-slow" alt="Icon">
                                    <div class="text-right">
                                        <h2 class="text-3xl 2xl:text-6xl font-black leading-none mb-1 2xl:mb-3">
                                            {{ $wd['cuaca']['t'] ?? '--' }}°<span class="text-lg 2xl:text-3xl font-light opacity-70">C</span>
                                        </h2>
                                        <p class="text-[10px] 2xl:text-base font-bold tracking-wide uppercase text-blue-50">
                                            {{ $wd['cuaca']['weather_desc'] ?? 'Berawan' }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="relative z-10 grid grid-cols-2 gap-2 2xl:gap-4 mt-2 2xl:mt-4 pt-3 2xl:pt-6 border-t border-white/10">
                                    <div class="text-center border-r border-white/10">
                                        <p class="text-[7px] 2xl:text-xs font-bold opacity-60 uppercase tracking-widest mb-1">Kelembapan</p>
                                        <p class="text-xs 2xl:text-xl font-black">{{ $wd['cuaca']['hu'] ?? '0' }}%</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-[7px] 2xl:text-xs font-bold opacity-60 uppercase tracking-widest mb-1">Arah Angin</p>
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
                                        <p class="text-xs 2xl:text-xl font-black">{{ $anginIndo }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- PRAKIRAAN PER 6 JAM (KANAN - 4 CARD) --}}
                            <div class="lg:col-span-8 flex flex-col justify-center h-full">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 2xl:gap-6 h-full">
                                    @forelse($wd['prakiraan'] ?? [] as $p)
                                    <div class="bg-white rounded-3xl 2xl:rounded-[2.5rem] p-4 2xl:p-8 flex flex-col items-center justify-center shadow-lg hover:-translate-y-2 transition-transform h-full">
                                        <div class="text-center">
                                            <span class="block text-[10px] 2xl:text-sm font-bold text-slate-400 uppercase tracking-widest mb-1">
                                                {{ \Carbon\Carbon::parse($p['local_datetime'])->translatedFormat('d M Y') }}
                                            </span>
                                            <span class="block text-[12px] 2xl:text-xl font-black text-blue-600 uppercase">
                                                {{ \Carbon\Carbon::parse($p['local_datetime'])->format('H:i') }} WITA
                                            </span>
                                        </div>
                                        
                                        <img src="{{ $p['image'] }}" class="w-14 h-14 2xl:w-28 2xl:h-28 my-2 2xl:my-4 drop-shadow-md" alt="Icon">
                                        
                                        <div class="text-center">
                                            <p class="text-xl 2xl:text-5xl font-black text-slate-800 mb-1 2xl:mb-2">{{ $p['t'] }}°</p>
                                            <p class="text-[10px] 2xl:text-base font-bold text-slate-500 uppercase leading-tight">
                                                {{ $p['weather_desc'] }}
                                            </p>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-span-full font-bold text-slate-400 text-center flex items-center justify-center bg-white rounded-3xl p-4 shadow-lg h-full">
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
            {{-- SLIDE 2: GEMPA TERKINI (CUSTOM ICONS)    --}}
            {{-- ======================================= --}}
            <div class="w-full shrink-0 min-h-screen pt-28 pb-12 flex flex-col justify-center px-6 2xl:px-16">
                <div class="w-[98%] 2xl:w-[96%] max-w-[2500px] mx-auto transition-all duration-500">
                    
                    {{-- Header Section --}}
                    <div class="text-center mb-8 2xl:mb-14">
                        <div class="inline-flex items-center space-x-2 px-4 py-1.5 2xl:px-6 2xl:py-2.5 bg-red-500/20 border border-red-500/30 rounded-full text-red-400 text-xs 2xl:text-xl font-black uppercase tracking-widest mb-3">
                            <span class="w-2 h-2 2xl:w-3.5 2xl:h-3.5 rounded-full bg-red-500 animate-ping"></span>
                            <span>Real-Time Seismicity</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl 2xl:text-6xl font-black text-white uppercase tracking-tight drop-shadow-lg">
                            Ringkasan Gempa Terkini
                        </h2>
                        <div class="w-32 2xl:w-48 h-1.5 bg-gradient-to-r from-red-500 to-amber-500 mx-auto mt-3 rounded-full shadow-md"></div>
                    </div>
                    
                    {{-- Main Card Container --}}
                    <div class="bg-white/95 backdrop-blur-xl rounded-[2.5rem] 2xl:rounded-[4rem] p-8 md:p-12 2xl:p-20 shadow-2xl border border-white/20 relative overflow-hidden w-full">
                        
                        {{-- Background Subtle Glow Accent --}}
                        <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-100/50 rounded-full blur-3xl pointer-events-none"></div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 2xl:gap-16 items-center relative z-10">
                            
                            {{-- Kolom Kiri: Informasi Detail Gempa (7 Kolom) --}}
                            <div class="lg:col-span-7 text-left space-y-6 2xl:space-y-10">
                                
                                <div class="flex items-center space-x-3">
                                    <span class="px-4 py-1.5 2xl:px-6 2xl:py-2 bg-red-50 text-red-600 border border-red-100 rounded-full font-black text-xs 2xl:text-lg uppercase tracking-wider flex items-center shadow-sm">
                                        <svg class="w-4 h-4 mr-1.5 text-red-500 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                                        Gempabumi Dirasakan
                                    </span>
                                </div>

                                {{-- Magnitudo dengan Ikon Seismograf Merah --}}
                                <div class="space-y-2 2xl:space-y-4">
                                    <div class="flex items-center space-x-3">
                                        {{-- Ikon Seismograf (Merah) --}}
                                        <svg class="w-8 h-8 2xl:w-12 2xl:h-12 text-red-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h3l2-5 3 10 3-7 2 4h3"></path>
                                        </svg>
                                        <span class="text-xs 2xl:text-xl font-black text-slate-400 uppercase tracking-widest">Magnitudo:</span>
                                    </div>
                                    <div class="flex items-baseline space-x-3 pl-11 2xl:pl-16">
                                        <h3 class="text-6xl md:text-7xl 2xl:text-[9rem] font-black text-slate-900 tracking-tighter leading-none">
                                            {{ $gempa->magnitude ?? '0' }}
                                        </h3>
                                        <span class="text-2xl md:text-3xl 2xl:text-6xl font-extrabold text-red-600 uppercase tracking-tight">SR</span>
                                    </div>
                                    <p class="text-lg md:text-xl 2xl:text-3xl font-bold text-slate-700 leading-snug pl-11 2xl:pl-16">
                                        {{ $gempa->wilayah ?? 'Tidak ada data gempabumi terbaru saat ini.' }}
                                    </p>
                                </div>

                                {{-- Grid Informasi (Kedalaman & Waktu Kejadian dengan Ikon Sesuai Referensi) --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 2xl:gap-8">
                                    
                                    {{-- Kedalaman (Ikon Target Hijau)[cite: 13] --}}
                                    <div class="p-5 2xl:p-8 bg-slate-50/80 rounded-2xl 2xl:rounded-3xl border border-slate-100 shadow-sm hover:border-slate-200 transition-all flex items-start space-x-4">
                                        <div class="mt-1 shrink-0">
                                            <svg class="w-7 h-7 2xl:w-10 2xl:h-10 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="9"></circle>
                                                <circle cx="12" cy="12" r="5"></circle>
                                                <circle cx="12" cy="12" r="1" fill="currentColor"></circle>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs 2xl:text-lg uppercase font-black tracking-wider text-slate-400 mb-1">Kedalaman:</p>
                                            <p class="font-black text-slate-800 text-base md:text-xl 2xl:text-3xl">
                                                {{ $gempa->kedalaman ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Waktu Kejadian / Lokasi (Ikon Pin Jingga)[cite: 13] --}}
                                    <div class="p-5 2xl:p-8 bg-slate-50/80 rounded-2xl 2xl:rounded-3xl border border-slate-100 shadow-sm hover:border-slate-200 transition-all flex items-start space-x-4">
                                        <div class="mt-1 shrink-0">
                                            <svg class="w-7 h-7 2xl:w-10 2xl:h-10 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs 2xl:text-lg uppercase font-black tracking-wider text-slate-400 mb-1">Waktu Kejadian:</p>
                                            <p class="text-xs md:text-sm 2xl:text-2xl font-bold text-slate-800 leading-tight">
                                                {{ $gempa->tgl ?? '-' }} <br>
                                                <span class="text-blue-600 font-black">{{ $gempa->jam ?? '-' }}</span>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="pt-2">
                                    <a href="/gempa/terkini" class="inline-flex items-center justify-center bg-gradient-to-r from-red-600 to-rose-600 text-white px-8 py-4 2xl:px-12 2xl:py-6 rounded-2xl 2xl:rounded-3xl font-black text-sm 2xl:text-2xl hover:from-red-700 hover:to-rose-700 transition-all shadow-xl shadow-red-600/30 transform hover:-translate-y-0.5">
                                        <span>Detail Gempa Lengkap</span>
                                        <svg class="w-5 h-5 2xl:w-7 2xl:h-7 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Peta ShakeMap (5 Kolom) --}}
                            <div class="lg:col-span-5">
                                <div class="bg-slate-900 rounded-[2rem] 2xl:rounded-[3rem] p-3 2xl:p-5 shadow-inner border border-slate-800 relative group overflow-hidden">
                                    <div class="absolute top-4 right-4 z-10 bg-black/60 backdrop-blur-md px-3 py-1 rounded-full text-[10px] 2xl:text-sm font-bold text-white uppercase tracking-wider border border-white/10">
                                        Peta Guncangan (ShakeMap)
                                    </div>
                                    <div class="aspect-square w-full overflow-hidden rounded-[1.5rem] 2xl:rounded-[2.5rem] bg-white flex items-center justify-center">
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
            {{-- SLIDE 3: KUALITAS UDARA                 --}}
            {{-- ======================================= --}}
            <div class="w-full shrink-0 min-h-screen pt-24 pb-8 flex flex-col justify-center px-6">
                <div class="w-[98%] 2xl:w-[98%] max-w-[2500px] mx-auto transition-all duration-500">
                    
                    <div class="text-center mb-6 2xl:mb-10">
                        <h2 class="text-3xl 2xl:text-5xl font-black text-white uppercase tracking-tighter italic drop-shadow-md">Kualitas Udara</h2>
                        <div class="w-40 2xl:w-64 h-1.5 2xl:h-2.5 bg-green-500 mx-auto mt-3 rounded-full"></div>
                    </div>

                    <div class="w-full bg-gradient-to-br from-white to-{{ $aqiData['color'] ?? 'emerald' }}-50/30 bg-white rounded-[3.5rem] 2xl:rounded-[5rem] p-6 md:p-10 2xl:p-20 border border-slate-100 shadow-2xl relative overflow-hidden transition-all duration-500">
                        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 2xl:w-[500px] h-64 2xl:h-[500px] bg-{{ $aqiData['color'] ?? 'emerald' }}-200/20 rounded-full blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 2xl:w-[500px] h-64 2xl:h-[500px] bg-{{ $aqiData['color'] ?? 'emerald' }}-300/10 rounded-full blur-3xl"></div>

                        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 2xl:gap-24 items-center">
                            <div class="lg:col-span-5 flex flex-col items-center justify-center">
                                <div class="relative flex items-center justify-center group">
                                    <div class="absolute inset-0 rounded-full blur-2xl scale-110 opacity-20"
                                        style="background-color: {{ ($aqiData['color'] ?? '') == 'yellow' ? '#eab308' : (($aqiData['color'] ?? '') == 'orange' ? '#f97316' : (($aqiData['color'] ?? '') == 'red' ? '#ef4444' : (($aqiData['color'] ?? '') == 'purple' ? '#a855f7' : (($aqiData['color'] ?? '') == 'rose' ? '#e11d48' : '#10b981')))) }};">
                                    </div>
                                    
                                    <svg class="w-64 h-64 2xl:w-[450px] 2xl:h-[450px] transform -rotate-90">
                                        <circle cx="50%" cy="50%" r="45%" stroke="#f1f5f9" stroke-width="16" fill="transparent" />
                                        <circle cx="50%" cy="50%" r="45%" 
                                            stroke="{{ ($aqiData['color'] ?? '') == 'yellow' ? '#eab308' : (($aqiData['color'] ?? '') == 'orange' ? '#f97316' : (($aqiData['color'] ?? '') == 'red' ? '#ef4444' : (($aqiData['color'] ?? '') == 'purple' ? '#a855f7' : (($aqiData['color'] ?? '') == 'rose' ? '#e11d48' : '#10b981')))) }}" 
                                            stroke-width="16" fill="transparent" stroke-dasharray="283" 
                                            stroke-dashoffset="{{ 283 - (min($aqiData['value'] ?? 0, 400) / 400 * 283) }}" 
                                            stroke-linecap="round" style="transition: stroke-dashoffset 1.5s ease-in-out;" />
                                    </svg>

                                    <div class="absolute text-center">
                                        <h4 class="text-7xl 2xl:text-[11rem] font-black text-slate-800 leading-none tracking-tighter">{{ $aqiData['value'] ?? '0' }}</h4>
                                        <p class="text-[10px] 2xl:text-xl font-black text-slate-400 uppercase tracking-[0.3em] mt-2 2xl:mt-4">AQI INDEX</p>
                                    </div>

                                    <div class="absolute w-[265px] h-[265px] 2xl:w-[480px] 2xl:h-[480px] border-2 border-dashed rounded-full animate-spin-slow"
                                        style="border-color: {{ ($aqiData['color'] ?? '') == 'yellow' ? '#eab308' : (($aqiData['color'] ?? '') == 'orange' ? '#f97316' : (($aqiData['color'] ?? '') == 'red' ? '#ef4444' : (($aqiData['color'] ?? '') == 'purple' ? '#a855f7' : (($aqiData['color'] ?? '') == 'rose' ? '#e11d48' : '#10b981')))) }}; opacity: 0.5;">
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-7 space-y-8 2xl:space-y-16">
                                <div class="flex flex-col md:flex-row md:items-center gap-4 2xl:gap-8">
                                    <div class="inline-flex items-center px-6 py-2.5 2xl:px-10 2xl:py-5 bg-{{ $aqiData['color'] ?? 'emerald' }}-500 text-black rounded-2xl font-black uppercase text-xs 2xl:text-xl shadow-md">
                                        <span class="mr-2">●</span> STATUS: {{ $aqiData['status'] ?? 'Baik' }}
                                    </div>
                                    <span class="text-[10px] 2xl:text-lg font-bold text-slate-400 uppercase tracking-widest flex items-center">
                                        <svg class="w-4 h-4 2xl:w-8 2xl:h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Diperbarui: {{ isset($iklim->measured_at) ? \Carbon\Carbon::parse($iklim->measured_at)->translatedFormat('d M Y | H:i') : 'N/A' }} WITA
                                    </span>
                                </div>
                                
                                <div>
                                    <h3 class="text-3xl 2xl:text-6xl font-black text-slate-800 leading-tight mb-4 2xl:mb-8">
                                        Tanjung Selor memiliki kualitas udara <span class="text-{{ $aqiData['color'] ?? 'emerald' }}-600 italic">{{ $aqiData['status'] ?? 'Baik' }}</span>.
                                    </h3>
                                    <p class="text-slate-500 text-lg 2xl:text-3xl leading-relaxed font-medium">
                                        {{ $aqiData['desc'] ?? '' }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 2xl:gap-10">
                                    <div class="bg-slate-50/80 p-4 2xl:p-8 rounded-3xl border border-slate-100 shadow-sm">
                                        <p class="text-[9px] 2xl:text-base font-black text-slate-400 uppercase mb-1 2xl:mb-3">Stasiun Pengukur</p>
                                        <p class="text-xs 2xl:text-2xl font-bold text-slate-700 truncate">{{ $iklim->station_name ?? 'AQICN Tanjung Selor' }}</p>
                                    </div>
                                    <div class="bg-slate-50/80 p-4 2xl:p-8 rounded-3xl border border-slate-100 shadow-sm">
                                        <p class="text-[9px] 2xl:text-base font-black text-slate-400 uppercase mb-1 2xl:mb-3">Wilayah</p>
                                        <p class="text-xs 2xl:text-2xl font-bold text-slate-700">Tanjung Selor, Kaltara</p>
                                    </div>
                                    <div class="hidden md:block bg-slate-50/80 p-4 2xl:p-8 rounded-3xl border border-slate-100 shadow-sm">
                                        <p class="text-[9px] 2xl:text-base font-black text-slate-400 uppercase mb-1 2xl:mb-3">Sumber Data</p>
                                        <p class="text-xs 2xl:text-2xl font-bold text-slate-700">AQICN Real-time API</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ======================================= --}}
            {{-- SLIDE 4: BERITA & KEGIATAN TERKINI      --}}
            {{-- ======================================= --}}
            <div class="w-full shrink-0 min-h-screen pt-24 pb-8 flex flex-col justify-center px-4 md:px-6">
                <div class="w-[98%] 2xl:w-[98%] max-w-[2500px] mx-auto transition-all duration-500">
                    
                    <div class="text-center mb-8 2xl:mb-12">
                        <h2 class="text-3xl 2xl:text-5xl font-black text-white uppercase tracking-tighter italic drop-shadow-md">Berita & Kegiatan Terkini</h2>
                        <div class="w-40 2xl:w-64 h-1.5 2xl:h-2.5 bg-yellow-500 mx-auto mt-3 rounded-full"></div>
                    </div>
                    
                    {{-- DI PC BESAR OTOMATIS JADI 4 KOLOM AGAR TERISI PENUH --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 2xl:grid-cols-4 gap-6 2xl:gap-12">
                        @forelse($beritas ?? [] as $berita)
                        @php /** @var \App\Models\Berita $berita */ @endphp
                        <div class="bg-white rounded-[2rem] 2xl:rounded-[3rem] overflow-hidden shadow-lg border border-slate-100 flex flex-col group hover:-translate-y-2 transition-transform duration-300">
                            {{-- Thumbnail Berita --}}
                            <div class="h-48 2xl:h-80 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute top-4 left-4 bg-yellow-500 text-white text-[10px] 2xl:text-base font-black uppercase tracking-widest px-3 py-1 2xl:px-6 2xl:py-3 rounded-full shadow-md">
                                    Terbaru
                                </div>
                            </div>
                            
                            {{-- Konten Text --}}
                            <div class="p-6 2xl:p-10 flex flex-col flex-grow">
                                <div class="flex items-center text-slate-400 mb-3 2xl:mb-6 space-x-2">
                                    <svg class="w-4 h-4 2xl:w-6 2xl:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs 2xl:text-xl font-bold">{{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d M Y') }}</span>
                                </div>
                                
                                <h3 class="text-lg 2xl:text-3xl font-black text-slate-800 leading-tight mb-3 2xl:mb-6 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    {{ $berita->title }}
                                </h3>
                                
                                <p class="text-sm 2xl:text-xl text-slate-500 line-clamp-3 mb-5 2xl:mb-10 flex-grow">
                                    {{ strip_tags($berita->content) }}
                                </p>
                                
                                <a href="{{ route('publikasi.berita.detail', $berita->slug) }}" class="inline-flex items-center justify-center w-full py-3 2xl:py-6 bg-slate-50 text-blue-600 font-bold 2xl:text-2xl rounded-xl 2xl:rounded-2xl hover:bg-blue-600 hover:text-white transition-colors border border-blue-100">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 2xl:w-8 2xl:h-8 ml-2 2xl:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-1 md:col-span-3 2xl:col-span-4 bg-white/90 backdrop-blur-md rounded-[2rem] p-12 text-center shadow-xl border border-white/20">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-800 mb-2">Belum Ada Publikasi</h3>
                            <p class="text-slate-500 font-medium">Berita dan kegiatan terbaru akan segera ditampilkan di sini.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-8 2xl:mt-16 text-center">
                        <a href="{{ route('publikasi.berita') }}" class="inline-flex items-center px-6 py-3 2xl:px-12 2xl:py-6 bg-white/20 hover:bg-white/30 text-white backdrop-blur-md font-bold uppercase tracking-widest text-xs 2xl:text-xl rounded-full border border-white/30 transition-colors shadow-lg">
                            Lihat Semua Berita
                            <svg class="w-4 h-4 2xl:w-8 2xl:h-8 ml-2 2xl:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>    

        </div> {{-- End of Track Slider --}}

        {{-- ======================================================= --}}
        {{-- TOMBOL NAVIGASI & INDIKATOR SLIDER HALAMAN UTAMA        --}}
        {{-- ======================================================= --}}
        
        <button onclick="prevMainPage()" class="fixed left-4 top-1/2 -translate-y-1/2 z-40 bg-black/20 hover:bg-black/50 backdrop-blur-md border border-white/20 text-white p-4 2xl:p-8 rounded-full transition-all hidden md:block">
            <svg class="w-3 h-3 2xl:w-6 2xl:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button onclick="nextMainPage()" class="fixed right-4 top-1/2 -translate-y-1/2 z-40 bg-black/20 hover:bg-black/50 backdrop-blur-md border border-white/20 text-white p-4 2xl:p-8 rounded-full transition-all hidden md:block">
            <svg class="w-3 h-3 2xl:w-6 2xl:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <div class="fixed bottom-6 2xl:bottom-12 left-0 right-0 flex justify-center space-x-3 2xl:space-x-6 z-50">
            <button onclick="goToPage(0)" class="page-dot w-3 h-3 2xl:w-5 2xl:h-5 rounded-full bg-white ring-4 ring-white/30 transition-all shadow-lg shadow-black/50"></button>
            <button onclick="goToPage(1)" class="page-dot w-3 h-3 2xl:w-5 2xl:h-5 rounded-full bg-white/40 hover:bg-white/80 transition-all shadow-lg shadow-black/50"></button>
            <button onclick="goToPage(2)" class="page-dot w-3 h-3 2xl:w-5 2xl:h-5 rounded-full bg-white/40 hover:bg-white/80 transition-all shadow-lg shadow-black/50"></button>
            <button onclick="goToPage(3)" class="page-dot w-3 h-3 2xl:w-5 2xl:h-5 rounded-full bg-white/40 hover:bg-white/80 transition-all shadow-lg shadow-black/50"></button>
        </div>

    </div>
</div>

{{-- MODAL TETAP SAMA --}}
{{-- MODAL / POP-UP SURVEI KEPUASAN MASYARAKAT               --}}
{{-- ======================================================= --}}
<div id="welcome-modal" class="fixed inset-0 z-[100] hidden items-center justify-center opacity-0 transition-opacity duration-300">
    
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeWelcomeModal()"></div>

    <div class="relative z-10 bg-white rounded-[2rem] w-[90%] max-w-md p-8 shadow-2xl transform scale-95 transition-transform duration-300" id="welcome-modal-panel">
        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-blue-50 mb-6 shadow-inner">
            <svg class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>

        <div class="text-center mb-8">
            <h3 class="text-2xl font-black text-slate-800 tracking-tight mb-3">Selamat Datang di Portal Informasi Stasiun Meteorologi Tanjung Harapan, Bulungan!</h3>
            <p class="text-sm text-slate-500 font-medium leading-relaxed">
                Terima kasih telah mengunjungi portal layanan informasi kami. Bantu kami meningkatkan kualitas pelayanan di lingkungan Stasiun Meteorologi Tanjung Harapan dengan meluangkan waktu sejenak untuk mengisi survei.
            </p>
        </div>

        <div class="flex flex-col space-y-3">
            <a href="https://eskm.bmkg.go.id/survey/417815/0/2/2026-08/2026/0" target="_blank" class="w-full inline-flex justify-center items-center px-4 py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-black uppercase tracking-widest rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all">
                Isi Survei Sekarang
            </a>
            <button onclick="closeWelcomeModal()" class="w-full px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold uppercase tracking-widest rounded-xl transition-colors">
                Mungkin Nanti
            </button>
        </div>
    </div>
</div>

<style>
.custom-scrollbar::-webkit-scrollbar { width: 5px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

@keyframes spin-universal { 
    from { transform: rotate(0deg); } 
    to { transform: rotate(360deg); } 
}

.animate-spin-slow { 
    animation: spin-universal 25s linear infinite !important; 
    display: block !important;
}

@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}
.animate-bounce-slow {
    animation: bounce-slow 4s ease-in-out infinite;
}
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
                dot.classList.add('ring-4', 'ring-white/30');
            } else {
                dot.classList.replace('bg-white', 'bg-white/40');
                dot.classList.remove('ring-4', 'ring-white/30');
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
    
    let mainSliderAutoPlay = setInterval(nextMainPage, 6000);

    mainTrack.addEventListener('mouseenter', () => clearInterval(mainSliderAutoPlay));
    mainTrack.addEventListener('mouseleave', () => mainSliderAutoPlay = setInterval(nextMainPage, 6000));
</script>

{{-- SCRIPT SLIDER PERINGATAN DINI --}}
@if(isset($warnings) && $warnings->count() > 1)
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

    function prevWarning() {
        currentWarningIndex = (currentWarningIndex - 1 + totalWarnings) % totalWarnings;
        updateWarningSlide();
    }

    let warningAutoPlay = setInterval(nextWarning, 5000);
    const wrapperWarning = document.getElementById('peringatan-slider-wrapper');
    wrapperWarning.addEventListener('mouseenter', () => clearInterval(warningAutoPlay));
    wrapperWarning.addEventListener('mouseleave', () => warningAutoPlay = setInterval(nextWarning, 5000));
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
            }, 1500); 
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