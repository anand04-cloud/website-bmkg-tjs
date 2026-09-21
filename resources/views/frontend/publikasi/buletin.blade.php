@extends('layouts.app')

@section('content')
<section class="bg-slate-900 py-24 2xl:py-40 min-h-screen relative overflow-hidden">
    {{-- Ornamen Background --}}
    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-10 pointer-events-none"></div>

    {{-- KUNCI 1: Wrapper Merentang Penuh --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10">
        
        <div class="mb-16 2xl:mb-24 text-center pt-8 2xl:pt-16">
            <h1 class="text-4xl md:text-5xl 2xl:text-[6rem] font-black text-white mb-4 2xl:mb-8 tracking-tight">Rak <span class="text-cyan-500">Buletin</span></h1>
            <p class="text-slate-400 font-medium max-w-2xl 2xl:max-w-5xl mx-auto 2xl:text-2xl 2xl:leading-relaxed">Dokumen analisis dan prospek iklim bulanan Provinsi Kalimantan Utara</p>
        </div>

        {{-- KUNCI 2: Tambah 2xl:grid-cols-6 agar memuat 6 dokumen sebaris di PC besar --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-6 gap-6 md:gap-8 2xl:gap-12">
            
            @forelse($buletins as $doc)
            <div class="bg-slate-800 rounded-2xl 2xl:rounded-3xl overflow-hidden border border-slate-700 group hover:border-cyan-500/50 transition-all shadow-xl flex flex-col relative">
                
                {{-- Cover Image --}}
                <div class="aspect-[1/1.4] bg-slate-900 relative overflow-hidden">
                    @if($doc->cover_image)
                        {{-- Proteksi gambar onerror agar etalase tetap cantik --}}
                        <img src="{{ asset('storage/' . $doc->cover_image) }}" 
                             alt="Cover {{ $doc->title }}" 
                             onerror="this.onerror=null; this.outerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center text-slate-500 bg-slate-800 border-4 2xl:border-8 border-dashed border-slate-700/50 m-2 2xl:m-4 w-[calc(100%-1rem)] 2xl:w-[calc(100%-2rem)] rounded-xl 2xl:rounded-2xl\'><svg class=\'w-10 h-10 2xl:w-16 2xl:h-16 mb-2 2xl:mb-4 opacity-50\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z\'></path></svg><span class=\'text-[10px] 2xl:text-base font-bold uppercase tracking-widest\'>Cover Hilang</span></div>';"
                             class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                    @else
                        <div class="h-full flex flex-col items-center justify-center text-slate-600 border-4 2xl:border-8 border-dashed border-slate-700/50 m-3 2xl:m-5 w-auto rounded-xl 2xl:rounded-2xl">
                            <span class="text-4xl 2xl:text-6xl mb-2 2xl:mb-4">ðŸ“„</span>
                            <span class="text-[10px] 2xl:text-base font-bold uppercase tracking-widest">No Cover</span>
                        </div>
                    @endif
                    
                    {{-- Overlay Tombol Baca --}}
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center z-20">
                        <a href="{{ asset('storage/' . $doc->file_pdf) }}" target="_blank" rel="noopener noreferrer" class="absolute inset-0 flex items-center justify-center w-full h-full">
                            <span class="bg-cyan-500 hover:bg-cyan-400 text-white font-bold py-2 px-6 2xl:py-4 2xl:px-10 rounded-full 2xl:rounded-2xl 2xl:text-xl shadow-[0_0_15px_rgba(6,182,212,0.4)] transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                Baca PDF
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Detail Info --}}
                <div class="p-5 2xl:p-8 flex-1 flex flex-col justify-between bg-slate-800 z-10 relative pointer-events-none">
                    <div>
                        <p class="text-cyan-400 text-[10px] 2xl:text-base font-black uppercase tracking-widest mb-1 2xl:mb-3">{{ \Carbon\Carbon::parse($doc->published_date)->translatedFormat('F Y') }}</p>
                        <h3 class="text-white font-bold text-sm 2xl:text-2xl leading-tight line-clamp-2" title="{{ $doc->title }}">{{ $doc->title }}</h3>
                    </div>
                </div>
            </div>
            @empty
            {{-- Tampilan saat database dokumen masih kosong --}}
            <div class="col-span-full bg-slate-800 rounded-3xl 2xl:rounded-[4rem] p-16 2xl:p-32 text-center border border-slate-700 shadow-xl">
                <span class="text-6xl 2xl:text-9xl mb-4 2xl:mb-8 block opacity-40">ðŸ“š</span>
                <h3 class="text-2xl 2xl:text-5xl font-black text-white mb-2 2xl:mb-6">Rak Buletin Kosong</h3>
                <p class="text-slate-400 2xl:text-2xl font-medium">Belum ada dokumen buletin yang diunggah. Silakan kembali lagi nanti.</p>
            </div>
            @endforelse
        </div>

        {{-- Navigasi Pagination --}}
        @if($buletins->hasPages())
        <div class="mt-16 2xl:mt-24 flex justify-center">
            {{ $buletins->links() }}
        </div>
        @endif
        
    </div>
</section>
@endsection