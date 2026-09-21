@extends('layouts.app')

@section('content')

{{-- Latar belakang senada dengan halaman lain --}}
<section class="bg-slate-50 py-24 2xl:py-40 min-h-screen">
    {{-- KUNCI PERBAIKAN: Hapus max-w-4xl yang bikin sempit, ganti dengan lebar persentase dinamis --}}
    <div class="w-[98%] md:w-[95%] 2xl:w-[90%] max-w-[2500px] mx-auto px-4 md:px-6">
        
        {{-- Breadcrumb Modern --}}
        <div class="mb-8 2xl:mb-12">
            <a href="{{ route('publikasi.berita') }}" class="inline-flex items-center px-5 py-2.5 2xl:px-8 2xl:py-4 bg-white border border-slate-200 rounded-full text-sm 2xl:text-xl font-bold text-slate-600 hover:text-cyan-600 hover:border-cyan-300 hover:bg-cyan-50 transition-all shadow-sm group">
                <svg class="w-4 h-4 2xl:w-6 2xl:h-6 mr-2 2xl:mr-3 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Publikasi
            </a>
        </div>

        {{-- Kartu Artikel Utama --}}
        <div class="bg-white rounded-[2rem] 2xl:rounded-[4rem] shadow-sm border border-slate-100 overflow-hidden">
            
            {{-- Header Artikel --}}
            <div class="p-8 md:p-12 2xl:p-24 pb-6 border-b border-slate-50">
                {{-- Meta Info --}}
                <div class="flex flex-wrap items-center gap-4 2xl:gap-8 mb-6 2xl:mb-10 text-xs 2xl:text-xl font-bold uppercase tracking-widest text-slate-400">
                    <span class="inline-flex items-center px-3 py-1 2xl:px-6 2xl:py-2 bg-blue-50 text-blue-600 rounded-lg 2xl:rounded-xl">
                        Berita Utama
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 2xl:w-6 2xl:h-6 mr-1.5 2xl:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d M Y') }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 2xl:w-6 2xl:h-6 mr-1.5 2xl:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        BMKG Tanjung Harapan
                    </span>
                </div>

                {{-- Judul --}}
                <h1 class="text-3xl md:text-5xl 2xl:text-[5rem] font-black text-slate-900 leading-[1.2] tracking-tight mb-2 2xl:mb-6">
                    {{ $berita->title }}
                </h1>
            </div>

            {{-- Thumbnail Proteksi --}}
            @if($berita->thumbnail)
            <div class="w-full h-[400px] md:h-[550px] 2xl:h-[800px] bg-slate-100 relative">
                <img src="{{ asset('storage/' . $berita->thumbnail) }}" 
                     alt="{{ $berita->title }}" 
                     onerror="this.onerror=null; this.outerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center text-slate-400\'><svg class=\'w-16 h-16 2xl:w-32 2xl:h-32 mb-3 2xl:mb-6 opacity-50\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg><span class=\'text-xs 2xl:text-xl font-bold uppercase tracking-widest\'>Gambar Tidak Tersedia</span></div>';"
                     class="w-full h-full object-cover">
            </div>
            @endif

            {{-- Isi Artikel --}}
            {{-- KUNCI PERBAIKAN: Konten juga otomatis memanjang mengikuti kotak putihnya --}}
            <div class="p-8 md:p-12 2xl:p-24 format-berita">
                {!! $berita->content !!}
            </div>

            {{-- Footer Artikel / Share (Opsional) --}}
            <div class="px-8 md:px-12 2xl:px-24 py-6 2xl:py-12 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs 2xl:text-lg font-bold text-slate-400 uppercase tracking-widest">Bagikan Informasi Ini:</p>
                <div class="flex space-x-3 2xl:space-x-6">
                    {{-- Tombol Salin Tautan --}}
                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan disalin!');" class="p-2.5 2xl:p-5 bg-white text-slate-600 rounded-xl 2xl:rounded-2xl shadow-sm border border-slate-200 hover:text-cyan-600 hover:border-cyan-200 transition-colors" title="Salin Tautan">
                        <svg class="w-5 h-5 2xl:w-8 2xl:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </button>
                    {{-- Tombol Cetak --}}
                    <button onclick="window.print()" class="p-2.5 2xl:p-5 bg-white text-slate-600 rounded-xl 2xl:rounded-2xl shadow-sm border border-slate-200 hover:text-cyan-600 hover:border-cyan-200 transition-colors" title="Cetak Artikel">
                        <svg class="w-5 h-5 2xl:w-8 2xl:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Styling Khusus untuk Konten dari Rich Text Editor --}}
<style>
    .format-berita {
        color: #475569; /* text-slate-600 */
        font-size: 1.125rem; /* text-lg */
        line-height: 1.8;
    }
    .format-berita p {
        margin-bottom: 1.5rem;
    }
    .format-berita h2, .format-berita h3, .format-berita h4 {
        color: #0f172a; /* text-slate-900 */
        font-weight: 900;
        margin-top: 2rem;
        margin-bottom: 1rem;
        line-height: 1.3;
    }
    .format-berita h2 { font-size: 1.875rem; }
    .format-berita h3 { font-size: 1.5rem; }
    .format-berita ul, .format-berita ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    .format-berita ul { list-style-type: disc; }
    .format-berita ol { list-style-type: decimal; }
    .format-berita li { margin-bottom: 0.5rem; }
    .format-berita strong, .format-berita b {
        color: #1e293b;
        font-weight: 800;
    }
    .format-berita a {
        color: #0284c7; /* text-blue-600 */
        text-decoration: underline;
        font-weight: 600;
    }
    .format-berita img {
        max-width: 100%;
        height: auto;
        border-radius: 1rem;
        margin: 2rem auto;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }
    
    /* Ukuran khusus di PC Besar (2XL) agar konten tidak terlihat kecil di kotak yang sudah lebar */
    @media (min-width: 1536px) {
        .format-berita {
            font-size: 1.875rem; /* Setara text-3xl */
            line-height: 2;
        }
        .format-berita p { margin-bottom: 2.5rem; }
        .format-berita h2 { font-size: 3.5rem; margin-top: 3.5rem; margin-bottom: 1.5rem; }
        .format-berita h3 { font-size: 2.5rem; margin-top: 3rem; margin-bottom: 1.5rem; }
        .format-berita ul, .format-berita ol { margin-bottom: 2.5rem; padding-left: 2.5rem; }
        .format-berita li { margin-bottom: 1rem; }
        .format-berita img { border-radius: 2rem; margin: 4rem auto; }
    }

    /* Sembunyikan elemen tidak penting saat diprint */
    @media print {
        header, footer, .mb-8, button { display: none !important; }
        .bg-white { box-shadow: none !important; border: none !important; }
        .format-berita { color: #000; font-size: 12pt; }
        body { background: #fff !important; }
    }
</style>
@endsection