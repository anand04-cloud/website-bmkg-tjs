@extends('layouts.app')

@section('content')
<section class="bg-slate-50 py-24 2xl:py-36 min-h-screen relative overflow-hidden">
    {{-- KUNCI 1: Buang container dan max-w-7xl, ganti dengan w-[98%] max-w-[2500px] --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10">
        
        {{-- Header Section --}}
        <div class="mb-16 2xl:mb-24 text-center pt-8 2xl:pt-16">
            <h1 class="text-4xl md:text-5xl 2xl:text-[6rem] font-black text-slate-900 mb-4 2xl:mb-8 tracking-tight">Berita & <span class="text-cyan-600">Kegiatan</span></h1>
            <p class="text-slate-500 font-medium max-w-2xl 2xl:max-w-5xl mx-auto 2xl:text-2xl 2xl:leading-relaxed">Informasi terbaru seputar kegiatan operasional dan observasi di BMKG Tanjung Harapan</p>
        </div>

        {{-- Grid Berita --}}
        {{-- KUNCI 2: Tambah 2xl:grid-cols-4 agar jadi 4 kolom di PC raksasa --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8 2xl:gap-12">
            
            @forelse($beritas as $item)
            <div class="bg-white rounded-3xl 2xl:rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col group">
                
                {{-- Area Thumbnail --}}
                <div class="h-56 2xl:h-80 overflow-hidden bg-slate-100 relative flex items-center justify-center">
                    @if($item->thumbnail)
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                             alt="{{ $item->title }}" 
                             onerror="this.onerror=null; this.outerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-200\'><svg class=\'w-10 h-10 2xl:w-16 2xl:h-16 mb-2 2xl:mb-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg><span class=\'text-xs 2xl:text-base font-bold uppercase tracking-widest\'>Gambar Tidak Tersedia</span></div>';"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-200">
                            <svg class="w-10 h-10 2xl:w-16 2xl:h-16 mb-2 2xl:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path></svg>
                            <span class="text-xs 2xl:text-base font-bold uppercase tracking-widest">BMKG Tanjung Harapan</span>
                        </div>
                    @endif
                    
                    {{-- Badge Tanggal --}}
                    <div class="absolute top-4 left-4 2xl:top-6 2xl:left-6 bg-white/95 backdrop-blur text-slate-800 text-xs 2xl:text-base font-bold px-3 py-1.5 2xl:px-5 2xl:py-2.5 rounded-lg 2xl:rounded-xl shadow-sm border border-slate-100">
                        {{ \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y') }}
                    </div>
                </div>

                {{-- Konten Teks --}}
                <div class="p-6 2xl:p-10 flex-1 flex flex-col">
                    <h3 class="text-xl 2xl:text-3xl font-bold text-slate-900 mb-3 2xl:mb-5 leading-snug 2xl:leading-snug line-clamp-2 group-hover:text-cyan-600 transition-colors">
                        {{ $item->title }}
                    </h3>
                    
                    <p class="text-slate-500 text-sm 2xl:text-xl mb-6 2xl:mb-10 line-clamp-3 2xl:line-clamp-4 leading-relaxed">
                        {{ Str::limit(strip_tags($item->content), 120) }}
                    </p>
                    
                    <div class="mt-auto pt-4 2xl:pt-6 border-t border-slate-100">
                        <a href="{{ route('publikasi.berita.detail', $item->slug) }}" class="inline-flex items-center text-cyan-600 font-bold text-sm 2xl:text-xl hover:text-cyan-700 group-hover:translate-x-2 transition-transform">
                            Baca Selengkapnya <span class="ml-2 2xl:ml-3">-></span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            {{-- Tampilan saat belum ada berita --}}
            <div class="col-span-full bg-white rounded-3xl 2xl:rounded-[4rem] p-16 2xl:p-32 text-center shadow-sm border border-slate-100 mt-4 2xl:mt-8">
                <span class="text-6xl 2xl:text-8xl mb-4 2xl:mb-8 block opacity-50">ðŸ“°</span>
                <h3 class="text-2xl 2xl:text-4xl font-black text-slate-800 mb-2 2xl:mb-6">Belum Ada Publikasi</h3>
                <p class="text-slate-500 2xl:text-2xl font-medium">Berita dan kegiatan terbaru akan segera ditampilkan di sini.</p>
            </div>
            @endforelse
        </div>

        {{-- Navigasi Pagination --}}
        @if($beritas->hasPages())
        <div class="mt-16 2xl:mt-24 flex justify-center">
            {{ $beritas->links() }}
        </div>
        @endif
        
    </div>
</section>
@endsection