@extends('layouts.app')

@section('content')

{{-- Header Banner --}}
<section class="relative bg-[#0b132b] pt-32 pb-28 2xl:pt-48 2xl:pb-44 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-30"></div>
    <div class="absolute top-0 right-0 w-96 2xl:w-[800px] h-96 2xl:h-[800px] bg-rose-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    
    {{-- KUNCI 1: Lebarkan Container Hero --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 2xl:space-x-4 px-4 py-1.5 2xl:px-8 2xl:py-3 mb-6 2xl:mb-10 bg-rose-500/20 border border-rose-500/30 rounded-full text-rose-400 text-xs 2xl:text-xl font-black uppercase tracking-widest">
            <span class="w-2 h-2 2xl:w-4 2xl:h-4 rounded-full bg-rose-500 animate-pulse"></span>
            <span>Informasi Real-Time</span>
        </div>
        <h1 class="text-4xl md:text-5xl 2xl:text-[7rem] font-black text-white tracking-tight mb-4 2xl:mb-8">
            Gempa Bumi Terkini
        </h1>
        <p class="text-slate-400 font-medium max-w-2xl 2xl:max-w-6xl mx-auto 2xl:text-3xl leading-relaxed">
            Informasi kejadian gempabumi yang terpantau oleh jaringan sensor seismik BMKG di seluruh wilayah Indonesia
        </p>
    </div>
</section>

{{-- Main Content --}}
<section class="relative w-full bg-[#f4f7fb] pb-24 2xl:pb-40 -mt-16 2xl:-mt-24 z-20">
    {{-- KUNCI 2: Lebarkan Container Konten Utama --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 py-3 2xl:py-8">
        
        @if($gempaTerbaru)
        {{-- KARTU GEMPA TERBARU --}}
        {{-- KUNCI 3: Hapus max-w-7xl ubah jadi w-full --}}
        <div class="w-full mx-auto bg-white rounded-3xl 2xl:rounded-[4rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 overflow-hidden mb-8 2xl:mb-16 relative">

            <div class="flex flex-col md:flex-row pt-4 md:pt-0">
                {{-- Kiri: Gambar Shakemap --}}
                <div class="w-full md:w-5/12 bg-slate-100 relative group overflow-hidden border-r border-slate-100 flex items-center justify-center min-h-[300px] 2xl:min-h-[600px]">
                    <div class="absolute inset-0 bg-slate-900/5 z-10 pointer-events-none"></div>
                    
                    {{-- Judul Label Melayang --}}
                    <div class="absolute top-6 2xl:top-12 left-5 2xl:left-10 z-20 bg-white/95 backdrop-blur-md px-4 py-2 2xl:px-8 2xl:py-4 rounded-xl 2xl:rounded-3xl shadow-lg border border-slate-100 flex items-center space-x-2 2xl:space-x-4">
                        <svg class="w-4 h-4 2xl:w-8 2xl:h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                        <span class="text-[10px] 2xl:text-xl font-black text-slate-700 uppercase tracking-widest">Peta Guncangan</span>
                    </div>

                    <img src="https://data.bmkg.go.id/DataMKG/TEWS/{{ $gempaTerbaru->shakemap }}" 
                         alt="Peta Guncangan Gempa" 
                         onerror="this.onerror=null; this.outerHTML='<div class=\'text-center p-8 2xl:p-16\'><div class=\'w-16 h-16 2xl:w-32 2xl:h-32 mx-auto mb-4 2xl:mb-8 bg-slate-200 rounded-full flex items-center justify-center text-slate-400\'><svg class=\'w-8 h-8 2xl:w-16 2xl:h-16\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div><p class=\'text-sm 2xl:text-2xl font-bold text-slate-500\'>Peta sedang diproses oleh sistem BMKG</p></div>';"
                         class="w-full h-full p-7 pt-16 2xl:p-16 2xl:pt-32 object-contain object-center group-hover:scale-105 transition-transform duration-700 relative z-10">
                </div>

                {{-- Kanan: Detail Parameter --}}
                <div class="w-full md:w-7/12 p-8 md:p-10 2xl:p-24 flex flex-col justify-center">
                    
                    <h2 class="text-3xl 2xl:text-6xl font-black text-slate-800 mb-2 2xl:mb-6 leading-tight">
                        {{ $gempaTerbaru->wilayah }}
                    </h2>
                    <p class="text-slate-500 font-medium mb-8 2xl:mb-16 2xl:text-2xl">
                        Terjadi pada <span class="text-slate-800 font-bold">{{ \Carbon\Carbon::parse($gempaTerbaru->datetime)->translatedFormat('l, d F Y') }}</span> pukul <span class="text-slate-800 font-bold">{{ $gempaTerbaru->jam }}</span>
                    </p>

                    {{-- Grid Parameter Teknis --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 2xl:gap-8 mb-8 2xl:mb-16">
                        {{-- 1. Kedalaman --}}
                        <div class="bg-slate-50 border border-slate-100 p-4 2xl:p-8 rounded-2xl 2xl:rounded-3xl flex flex-col justify-center">
                            <p class="text-[10px] 2xl:text-lg font-black text-slate-400 uppercase tracking-widest mb-1 2xl:mb-3">Kedalaman</p>
                            <p class="text-lg md:text-xl 2xl:text-4xl font-black text-slate-700">{{ $gempaTerbaru->kedalaman }}</p>
                        </div>
                        
                        {{-- 2. Magnitudo (Di Tengah) --}}
                        <div class="bg-rose-50 border border-rose-100 p-4 2xl:p-8 rounded-2xl 2xl:rounded-3xl flex flex-col justify-center items-center text-center shadow-sm relative overflow-hidden group">
                            <div class="absolute -right-4 -bottom-4 text-rose-200/50 transform rotate-12 group-hover:scale-110 transition-transform">
                                <svg class="w-20 h-20 2xl:w-40 2xl:h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            </div>
                            <p class="text-[10px] 2xl:text-lg font-black text-rose-500 uppercase tracking-widest mb-1 2xl:mb-3 relative z-10">Magnitudo</p>
                            <p class="text-4xl 2xl:text-7xl font-black text-rose-600 relative z-10">{{ $gempaTerbaru->magnitude }}</p>
                        </div>

                        {{-- 3. Koordinat --}}
                        <div class="bg-slate-50 border border-slate-100 p-4 2xl:p-8 rounded-2xl 2xl:rounded-3xl flex flex-col justify-center">
                            <p class="text-[10px] 2xl:text-lg font-black text-slate-400 uppercase tracking-widest mb-1 2xl:mb-3">Koordinat</p>
                            <p class="text-lg 2xl:text-3xl font-black text-slate-700">{{ $gempaTerbaru->coordinates }}</p>
                        </div>
                    </div>

                    {{-- Kotak Potensi / Warning --}}
                    <div class="p-4 2xl:p-8 rounded-2xl 2xl:rounded-3xl border-l-4 2xl:border-l-8 border-rose-500 bg-rose-50 flex items-start space-x-4 2xl:space-x-8">
                        <div class="w-10 h-10 2xl:w-16 2xl:h-16 rounded-full bg-rose-200 text-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs 2xl:text-xl font-black text-rose-500 uppercase tracking-widest mb-1 2xl:mb-2">Potensi Gempa</p>
                            <p class="text-sm 2xl:text-3xl font-bold text-slate-800 leading-snug">{{ $gempaTerbaru->potensi }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- RIWAYAT GEMPA (2 Hari Terakhir) --}}
        {{-- KUNCI 4: Buang max-w-5xl, jadikan w-full --}}
        <div class="w-full mx-auto mt-12 2xl:mt-24">
            <h3 class="text-xl 2xl:text-4xl font-black text-slate-800 mb-6 2xl:mb-12 flex items-center">
                Riwayat Gempa Terakhir <span class="ml-3 2xl:ml-6 px-3 py-1 2xl:px-6 2xl:py-2 bg-slate-200 text-slate-600 text-xs 2xl:text-xl rounded-full">2 Hari Terakhir</span>
            </h3>

            @if($riwayatGempa->count() > 0)
                {{-- KUNCI 5: Ubah grid menjadi 3 Kolom di layar 2XL --}}
                <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-6 2xl:gap-12">
                    @foreach($riwayatGempa as $rg)
                    <div class="bg-white rounded-3xl 2xl:rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-shadow flex flex-col">
                        
                        {{-- Bagian Atas Kartu (Info Utama) --}}
                        <div class="p-6 2xl:p-10 flex items-center justify-between grow relative">
                            
                            {{-- Indikator Magnitudo Besar (>= 5.0) --}}
                            @if((float)$rg->magnitude >= 5.0)
                                <div class="absolute top-0 right-0 bg-red-500 text-white text-[8px] 2xl:text-sm font-black uppercase px-3 py-1 2xl:px-6 2xl:py-2 rounded-bl-xl 2xl:rounded-bl-3xl shadow-sm">
                                    Signifikan
                                </div>
                            @endif

                            <div class="pr-4 2xl:pr-8">
                                <p class="text-xs 2xl:text-xl font-bold text-slate-400 mb-1 2xl:mb-3">{{ \Carbon\Carbon::parse($rg->datetime)->translatedFormat('d M Y | H:i:s') }}</p>
                                <h4 class="text-sm 2xl:text-3xl font-bold text-slate-800 line-clamp-2 2xl:leading-tight" title="{{ $rg->wilayah }}">{{ $rg->wilayah }}</h4>
                                <p class="text-xs 2xl:text-xl text-slate-500 mt-2 2xl:mt-4">Kedalaman: <span class="font-bold text-slate-700">{{ $rg->kedalaman }}</span></p>
                                
                                {{-- Tombol Buka Shakemap --}}
                                @if($rg->shakemap)
                                <a href="https://data.bmkg.go.id/DataMKG/TEWS/{{ $rg->shakemap }}" target="_blank" class="inline-flex items-center mt-3 2xl:mt-6 text-xs 2xl:text-xl font-bold text-blue-600 hover:text-blue-800 transition">
                                    <svg class="w-4 h-4 2xl:w-6 2xl:h-6 mr-1.5 2xl:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                    Lihat Peta Guncangan
                                </a>
                                @endif
                            </div>
                            
                            {{-- Lingkaran Magnitudo --}}
                            <div class="w-14 h-14 2xl:w-28 2xl:h-28 shrink-0 ml-auto rounded-full border-4 2xl:border-8 {{ ((float)$rg->magnitude >= 5.0) ? 'border-red-100 bg-red-600' : 'border-rose-50 bg-rose-500' }} flex items-center justify-center text-white font-black text-lg 2xl:text-4xl shadow-sm">
                                {{ $rg->magnitude }}
                            </div>
                        </div>

                        {{-- Bagian Bawah Kartu (Footer Potensi Gempa) --}}
                        <div class="bg-rose-50/50 border-t border-rose-100 px-6 py-3 2xl:px-10 2xl:py-6 flex items-start space-x-2 2xl:space-x-4">
                            <svg class="w-4 h-4 2xl:w-8 2xl:h-8 text-rose-500 shrink-0 mt-0.5 2xl:mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <p class="text-xs 2xl:text-xl font-bold text-rose-600 leading-tight">{{ $rg->potensi }}</p>
                        </div>

                    </div>
                    @endforeach
                </div>
                
                {{-- TOMBOL SELENGKAPNYA BMKG PUSAT --}}
                <div class="mt-10 2xl:mt-20 flex justify-center">
                    <a href="https://www.bmkg.go.id/gempabumi/gempabumi-terkini.bmkg" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-3.5 2xl:px-14 2xl:py-6 text-sm 2xl:text-2xl font-black text-slate-700 bg-white border-2 2xl:border-4 border-slate-200 rounded-full hover:border-rose-500 hover:text-rose-600 hover:shadow-lg hover:shadow-rose-500/20 transition-all duration-300 group">
                        <span>Lihat Seluruh Data Gempa BMKG</span>
                        <svg class="w-4 h-4 2xl:w-8 2xl:h-8 ml-2 2xl:ml-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            @else
                {{-- Tampilan Jika Belum Ada History --}}
                <div class="bg-white rounded-3xl 2xl:rounded-[4rem] shadow-sm border border-slate-100 p-12 2xl:p-32 text-center">
                    <span class="text-5xl 2xl:text-8xl opacity-50 mb-4 2xl:mb-8 block">📡</span>
                    <h4 class="text-lg 2xl:text-4xl font-bold text-slate-700 mb-2 2xl:mb-6">Belum Ada Riwayat Gempa</h4>
                    <p class="text-sm 2xl:text-2xl text-slate-500 max-w-md 2xl:max-w-4xl mx-auto leading-relaxed">Data riwayat gempa untuk 2 hari terakhir belum terekam di sistem. Data riwayat akan bertambah secara otomatis seiring berjalannya waktu operasional server.</p>
                </div>
            @endif
        </div>

        @else
        {{-- Tampilan Jika Database Gempa Kosong --}}
        <div class="w-full mx-auto bg-white rounded-3xl 2xl:rounded-[4rem] shadow-sm border border-slate-100 p-16 2xl:p-32 text-center mt-8">
            <div class="text-6xl 2xl:text-9xl mb-4 2xl:mb-8 text-rose-300">⚠️</div>
            <h3 class="text-2xl 2xl:text-5xl font-black text-slate-800 mb-2 2xl:mb-6">Data Tidak Tersedia</h3>
            <p class="text-slate-500 2xl:text-2xl">Sistem belum menarik data gempa dari server BMKG. Pastikan proses sinkronisasi telah berjalan.</p>
        </div>
        @endif

    </div>
</section>
@endsection