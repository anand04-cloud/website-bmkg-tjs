@extends('layouts.app')

@section('content')

{{-- Header Banner Tema Iklim/Udara --}}
<section class="relative bg-slate-900 pt-32 pb-24 2xl:pt-48 2xl:pb-36 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    <div class="absolute top-0 right-0 w-96 2xl:w-[800px] h-96 2xl:h-[800px] bg-emerald-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-96 2xl:w-[800px] h-96 2xl:h-[800px] bg-cyan-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    
    {{-- KUNCI 1: Wrapper Hero Merentang Penuh --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 2xl:space-x-4 px-4 py-1.5 2xl:px-8 2xl:py-3 mb-6 2xl:mb-10 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-xs 2xl:text-xl font-black uppercase tracking-widest">
            <span class="w-2 h-2 2xl:w-4 2xl:h-4 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Real-time Monitoring</span>
        </div>
        <h1 class="text-4xl md:text-5xl 2xl:text-[7rem] font-black text-white tracking-tight mb-4 2xl:mb-8">
            Kualitas Udara Indonesia
        </h1>
        <p class="text-slate-400 font-medium max-w-2xl 2xl:max-w-6xl mx-auto 2xl:text-3xl leading-relaxed">
            Pemantauan Indeks Kualitas Udara (AQI) dan Partikulat (PM2.5) di berbagai stasiun pengamatan BMKG dan KLHK di seluruh Indonesia
        </p>
    </div>
</section>

{{-- Main Content --}}
<section class="relative w-full bg-[#f8faff] pb-24 2xl:pb-40 -mt-10 2xl:-mt-16 z-20">
    {{-- KUNCI 2: Wrapper Konten Utama Merentang --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12">
        
        {{-- KUNCI 3: Hapus max-w-6xl agar grid melebar penuh --}}
        <div class="w-full mx-auto">

            {{-- INDEKS / LEGENDA KUALITAS UDARA --}}
            <div class="bg-white rounded-3xl 2xl:rounded-[3rem] shadow-xl border border-slate-100 p-8 2xl:p-12 mb-12 2xl:mb-20">
                <h3 class="text-lg 2xl:text-4xl font-black text-slate-800 mb-6 2xl:mb-10 flex items-center">
                    <svg class="w-5 h-5 2xl:w-10 2xl:h-10 mr-2 2xl:mr-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Indeks Standar Kualitas Udara (AQI)
                </h3>
                
                <div class="grid grid-cols-2 md:grid-cols-6 gap-3 2xl:gap-8">
                    <div class="bg-emerald-50 border-t-4 2xl:border-t-8 border-emerald-500 p-4 2xl:p-8 rounded-xl 2xl:rounded-2xl text-center">
                        <p class="text-emerald-700 font-black text-xl 2xl:text-5xl mb-1 2xl:mb-3">0-50</p>
                        <p class="text-[10px] 2xl:text-lg font-bold text-emerald-600 uppercase">Baik</p>
                    </div>
                    <div class="bg-yellow-50 border-t-4 2xl:border-t-8 border-yellow-400 p-4 2xl:p-8 rounded-xl 2xl:rounded-2xl text-center">
                        <p class="text-yellow-700 font-black text-xl 2xl:text-5xl mb-1 2xl:mb-3">51-100</p>
                        <p class="text-[10px] 2xl:text-lg font-bold text-yellow-600 uppercase">Moderat</p>
                    </div>
                    <div class="bg-orange-50 border-t-4 2xl:border-t-8 border-orange-500 p-4 2xl:p-8 rounded-xl 2xl:rounded-2xl text-center flex flex-col justify-center">
                        <p class="text-orange-700 font-black text-xl 2xl:text-5xl mb-1 2xl:mb-3">101-150</p>
                        <p class="text-[10px] 2xl:text-base font-bold text-orange-600 uppercase leading-tight">Tidak Sehat<br>(Sensitif)</p>
                    </div>
                    <div class="bg-red-50 border-t-4 2xl:border-t-8 border-red-500 p-4 2xl:p-8 rounded-xl 2xl:rounded-2xl text-center flex flex-col justify-center">
                        <p class="text-red-700 font-black text-xl 2xl:text-5xl mb-1 2xl:mb-3">151-200</p>
                        <p class="text-[10px] 2xl:text-base font-bold text-red-600 uppercase">Tidak Sehat</p>
                    </div>
                    <div class="bg-purple-50 border-t-4 2xl:border-t-8 border-purple-500 p-4 2xl:p-8 rounded-xl 2xl:rounded-2xl text-center flex flex-col justify-center">
                        <p class="text-purple-700 font-black text-xl 2xl:text-5xl mb-1 2xl:mb-3">201-300</p>
                        <p class="text-[10px] 2xl:text-base font-bold text-purple-600 uppercase leading-tight">Sangat Tidak<br>Sehat</p>
                    </div>
                    <div class="bg-rose-100 border-t-4 2xl:border-t-8 border-rose-900 p-4 2xl:p-8 rounded-xl 2xl:rounded-2xl text-center flex flex-col justify-center">
                        <p class="text-rose-900 font-black text-xl 2xl:text-5xl mb-1 2xl:mb-3">300+</p>
                        <p class="text-[10px] 2xl:text-base font-bold text-rose-800 uppercase">Berbahaya</p>
                    </div>
                </div>
            </div>

            {{-- KARTU DATA STASIUN SELURUH INDONESIA --}}
            <h3 class="text-2xl 2xl:text-5xl font-black text-slate-800 mb-6 2xl:mb-12">Data Pemantauan Stasiun</h3>
            
            @if($kualitasUdara->count() > 0)
                {{-- KUNCI 4: Ubah grid menjadi 5 kolom khusus di layar besar (2xl:grid-cols-5) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-5 gap-6 2xl:gap-10">
                    @foreach($kualitasUdara as $ku)
                        @php
                            $aqiValue = $ku['aqi_value'] ?? 0;
                            $bgColor = 'bg-emerald-50'; $borderColor = 'border-emerald-200'; $textColor = 'text-emerald-700'; $badgeColor = 'bg-emerald-500';
                            
                            if ($aqiValue > 300) { $bgColor = 'bg-rose-50'; $borderColor = 'border-rose-300'; $textColor = 'text-rose-900'; $badgeColor = 'bg-rose-900'; }
                            elseif ($aqiValue > 200) { $bgColor = 'bg-purple-50'; $borderColor = 'border-purple-200'; $textColor = 'text-purple-800'; $badgeColor = 'bg-purple-500'; }
                            elseif ($aqiValue > 150) { $bgColor = 'bg-red-50'; $borderColor = 'border-red-200'; $textColor = 'text-red-700'; $badgeColor = 'bg-red-500'; }
                            elseif ($aqiValue > 100) { $bgColor = 'bg-orange-50'; $borderColor = 'border-orange-200'; $textColor = 'text-orange-800'; $badgeColor = 'bg-orange-500'; }
                            elseif ($aqiValue > 50) { $bgColor = 'bg-yellow-50'; $borderColor = 'border-yellow-200'; $textColor = 'text-yellow-800'; $badgeColor = 'bg-yellow-400'; }
                        @endphp

                        <div class="bg-white rounded-3xl 2xl:rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-all flex flex-col relative group">
                            
                            {{-- Header Kartu --}}
                            <div class="{{ $bgColor }} border-b {{ $borderColor }} p-5 2xl:p-8 flex justify-between items-center transition-colors">
                                <div class="pr-2">
                                    <h4 class="text-lg 2xl:text-3xl font-black text-slate-800 line-clamp-2">{{ $ku['station_name'] ?? 'Stasiun Tidak Diketahui' }}</h4>
                                    <p class="text-xs 2xl:text-xl font-bold {{ $textColor }} uppercase tracking-wider mt-1 2xl:mt-3">{{ $ku['category'] ?? '-' }}</p>
                                </div>
                                <div class="w-14 h-14 2xl:w-28 2xl:h-28 shrink-0 rounded-2xl 2xl:rounded-3xl flex flex-col items-center justify-center text-white {{ $badgeColor }} shadow-inner">
                                    <span class="text-xs 2xl:text-xl font-medium opacity-80 leading-none">AQI</span>
                                    <span class="text-xl 2xl:text-5xl font-black leading-none mt-1 2xl:mt-2">{{ $aqiValue }}</span>
                                </div>
                            </div>
                            
                            {{-- Parameter Detail --}}
                            <div class="p-6 2xl:p-10 grow flex flex-col justify-between">
                                <div class="flex items-center space-x-6 2xl:space-x-10 mb-4 2xl:mb-8">
                                    <div class="flex items-center space-x-2 2xl:space-x-4">
                                        <div class="w-8 h-8 2xl:w-16 2xl:h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                            <svg class="w-4 h-4 2xl:w-8 2xl:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] 2xl:text-lg font-black text-slate-400 uppercase">Partikulat (PM2.5)</p>
                                            <p class="text-sm 2xl:text-3xl font-bold text-slate-700">{{ $ku['pm25'] ?? '-' }} <span class="text-xs 2xl:text-xl font-medium text-slate-400">µg/m³</span></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="pt-4 2xl:pt-8 border-t border-slate-100 flex items-center text-xs 2xl:text-xl text-slate-400">
                                    <svg class="w-3.5 h-3.5 2xl:w-6 2xl:h-6 mr-1.5 2xl:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Update: {{ isset($ku['measured_at']) ? \Carbon\Carbon::parse($ku['measured_at'])->translatedFormat('d M Y | H:i') : '-' }} WITA
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback jika Kosong --}}
                <div class="bg-white rounded-3xl 2xl:rounded-[4rem] shadow-sm border border-slate-100 p-16 2xl:p-32 text-center">
                    <span class="text-6xl 2xl:text-9xl mb-4 2xl:mb-8 block">🍃</span>
                    <h4 class="text-xl 2xl:text-5xl font-bold text-slate-800 mb-2 2xl:mb-6">Data Kualitas Udara Kosong</h4>
                    <p class="text-slate-500 2xl:text-2xl">Sistem belum berhasil mengambil data dari stasiun pengamatan.</p>
                </div>
            @endif

        </div>
    </div>
</section>
@endsection