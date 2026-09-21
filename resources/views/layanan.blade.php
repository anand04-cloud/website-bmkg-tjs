@extends('layouts.app')

@section('content')
{{-- 1. Header Banner --}}
<section class="relative bg-slate-900 pt-32 pb-24 overflow-hidden">
    {{-- Ornamen Background --}}
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center">
        {{-- Badge Animasi --}}
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 mb-6 bg-cyan-500/20 border border-cyan-500/30 rounded-full text-cyan-400 text-xs font-black uppercase tracking-widest">
            <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
            <span>Pelayanan Publik</span>
        </div>
        
        {{-- Judul --}}
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4">
            Layanan & <span class="text-cyan-400">Jasa</span>
        </h1>
        
        {{-- Deskripsi --}}
        <p class="text-slate-400 font-medium max-w-2xl mx-auto">
            Sistem Pelayanan Terpadu BMKG Tanjung Harapan. <br> Silakan pelajari alur dan pilih layanan yang Anda butuhkan.
        </p>
    </div>
</section>

{{-- 2. Seksi Konten --}}
<section class="bg-slate-50 py-10 min-h-screen">
    <div class="container mx-auto px-6 max-w-7xl">
        
        {{-- Seksi Atas: Alur Pelayanan --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 mb-10 text-center overflow-hidden">
            <h2 class="text-2xl font-black text-slate-800 mb-6 mt-8">Alur Pelayanan Data dan Jasa</h2>
            
            <div class="w-full max-w-5xl mx-auto bg-slate-50 rounded-xl overflow-hidden flex items-center justify-center min-h-[300px] border border-slate-200 border-dashed mb-8">
                {{-- KUNCI PERBAIKAN: Tambahan onerror fallback agar rapi jika gambar lupa diupload --}}
                <img src="{{ asset('img/pelayanan.jpeg') }}" 
                     alt="Alur Pelayanan BMKG" 
                     onerror="this.onerror=null; this.outerHTML='<div class=\'text-center p-8\'><div class=\'text-4xl mb-3\'>⚙️</div><p class=\'text-sm font-bold text-slate-400\'>Gambar Bagan Alur Pelayanan Belum Tersedia</p></div>';"
                     class="w-full h-auto object-contain">
            </div>
        </div>

        {{-- Seksi Bawah: Grid Card Layanan Google Form --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-center">
            @forelse($layanans as $item)
            
            {{-- KUNCI PERBAIKAN: Penambahan rel="noopener noreferrer" untuk keamanan --}}
            <a href="{{ $item->gform_url }}" target="_blank" rel="noopener noreferrer" class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 flex flex-col items-center text-center group">
                
                {{-- Area Ikon --}}
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-blue-100 transition-all border border-blue-50/50">
                    @if($item->icon_image)
                        <img src="{{ asset('storage/' . $item->icon_image) }}" 
                             alt="Ikon {{ $item->title }}" 
                             onerror="this.style.display='none'"
                             class="w-8 h-8 object-contain">
                    @else
                        {{-- Ikon default --}}
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                    @endif
                </div>
                
                {{-- Teks --}}
                <h3 class="text-2xl font-bold text-blue-600 mb-3 group-hover:text-blue-700 transition-colors">
                    {{ $item->title }}
                </h3>
                
                <p class="text-slate-500 text-sm mb-2 flex-1 px-2">
                    {{ $item->description }}
                </p>
                             
                {{-- Garis Pembatas Bawah --}}
                <hr class="w-full border-t border-slate-100 my-4">
                
                {{-- Tombol Aksi Blok --}}
                <div class="w-full mt-2">
                    <div class="w-full bg-blue-600 group-hover:bg-blue-700 text-white font-bold py-3.5 px-6 rounded-xl transition-colors text-sm tracking-wider uppercase">
                        Ajukan Layanan
                    </div>
                </div>        
            </a>
            @empty
            <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm">
                <span class="text-5xl block mb-4 opacity-50">📂</span>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Layanan</h3>
                <p class="text-slate-500 text-sm">Daftar layanan publik akan segera diperbarui. Silakan kembali lagi nanti.</p>
            </div>
            @endforelse
        </div>

    </div>
</section>
@endsection