@extends('layouts.app')

@section('title', 'Informasi Iklim — Peta Prakiraan')

@section('content')

{{-- HEADER BANNER TEMA GELAP --}}
<section class="relative bg-slate-900 pt-32 pb-24 2xl:pt-48 2xl:pb-36 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    <div class="absolute top-0 right-0 w-96 2xl:w-[800px] h-96 2xl:h-[800px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-96 2xl:w-[800px] h-96 2xl:h-[800px] bg-emerald-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>

    <div class="w-[98%] max-w-[1600px] mx-auto px-6 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 mb-6 bg-blue-500/20 border border-blue-500/30 rounded-full text-blue-300 text-xs font-black uppercase tracking-widest shadow-lg">
            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
            <span>WebGIS Auto-Layout Climate Service</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4">
            Informasi Iklim Kalimantan Utara
        </h1>
        <p class="text-slate-400 font-medium max-w-2xl mx-auto leading-relaxed">
            Peta Prakiraan Curah Hujan dan Sifat Hujan (Bulanan & Dasarian) Wilayah Provinsi Kalimantan Utara serta Kabupaten/Kota.
        </p>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="relative w-full bg-[#f8faff] pb-24 -mt-10 z-20 font-sans">
    <div class="w-[98%] max-w-[1600px] mx-auto px-4 md:px-8">

        <div class="bg-[#f4f7f9] rounded-[2rem] p-4 md:p-8 shadow-2xl border border-slate-200/60">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                {{-- SIDEBAR KIRI (Produk Layanan & Filter Wilayah Kaltara) --}}
                <aside class="lg:col-span-3 bg-white rounded-2xl border border-slate-200 p-4 shadow-sm space-y-6 lg:sticky lg:top-28">
                    {{-- Menu Kategori Produk --}}
                    <div class="space-y-1.5">
                        <p class="px-3 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Produk Layanan Iklim</p>

                        <div class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold bg-blue-600 text-white shadow-md shadow-blue-600/20">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span>Peta Prediksi</span>
                        </div>
                    </div>

                    {{-- Filter Wilayah Kaltara --}}
                    <div class="pt-4 border-t border-slate-100">
                        <label for="filter-wilayah" class="block px-1 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                            Filter Wilayah Kaltara
                        </label>
                        <select id="filter-wilayah" onchange="filterRegion(this.value)"
                            class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm font-bold text-slate-700 focus:border-blue-500 focus:ring-blue-500">
                            <option value="all">Semua Wilayah (Provinsi & Kab/Kota)</option>
                            @foreach($climateGroups as $group)
                                <option value="{{ $group['slug'] }}">{{ $group['name'] }} ({{ $group['type'] }})</option>
                            @endforeach
                        </select>
                    </div>
                </aside>

                {{-- KONTEN KANAN: PETA LAYOUT PROVINSI & KABUPATEN/KOTA --}}
                <div class="lg:col-span-9 space-y-6">

                    {{-- Header Section --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 md:p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start space-x-3">
                            <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-black text-slate-800">
                                    Peta Layout Prakiraan Iklim
                                </h2>
                                <p class="text-xs md:text-sm text-slate-500 font-medium">
                                    Terintegrasi otomatis dari Sistem WebGIS Stasiun Meteorologi Tanjung Harapan — Kalimantan Utara
                                </p>
                            </div>
                        </div>

                        <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200 self-start md:self-center">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2"></span>
                            Sinkronisasi Otomatis Aktif
                        </span>
                    </div>

                    {{-- Daftar Wilayah (Provinsi + Kabupaten/Kota) --}}
                    @foreach($climateGroups as $group)
                        <div class="region-block bg-white rounded-2xl border border-slate-200 p-5 md:p-6 shadow-sm" data-region="{{ $group['slug'] }}">
                            {{-- Header Wilayah --}}
                            <div class="flex flex-wrap items-center justify-between gap-3 pb-4 mb-5 border-b border-slate-100 border-l-4 border-l-blue-600 pl-3">
                                <div class="flex items-center space-x-2.5">
                                    <svg class="w-5 h-5 text-rose-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                    <h3 class="text-lg font-black text-slate-800">{{ $group['name'] }}</h3>
                                    <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $group['type'] }}
                                    </span>
                                </div>
                                <span class="px-3 py-1 rounded-lg text-xs font-extrabold bg-blue-50 text-blue-600 border border-blue-100">
                                    {{ $group['count'] }} Peta Layout
                                </span>
                            </div>

                            {{-- Grid 4 Kartu Peta --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                                @foreach($group['maps'] as $map)
                                    <div class="group bg-white rounded-xl border border-slate-200 hover:border-blue-400 hover:shadow-lg transition-all duration-200 flex flex-col overflow-hidden">
                                        {{-- Thumbnail Peta (Klik buka gambar penuh di tab baru) --}}
                                        <a href="{{ $map['image_url'] }}" target="_blank" rel="noopener"
                                           class="block relative aspect-[4/3] bg-slate-50 border-b border-slate-100 overflow-hidden">
                                            <img src="{{ $map['image_url'] }}"
                                                 alt="{{ $map['title'] }} - {{ $map['wilayah'] }}"
                                                 loading="lazy"
                                                 onerror="this.onerror=null; this.src='https://placehold.co/600x450/f1f5f9/64748b?text=Peta+Belum+Tersedia';"
                                                 class="w-full h-full object-contain p-1.5 group-hover:scale-105 transition-transform duration-300">
                                        </a>

                                        {{-- Metadata Peta --}}
                                        <div class="p-4 flex-grow flex flex-col justify-between">
                                            <div>
                                                <h4 class="font-extrabold text-sm text-slate-800 leading-snug mb-2">
                                                    {{ $map['title'] }}
                                                </h4>
                                                <div class="space-y-1 text-[11px] text-slate-500">
                                                    <p>Wilayah : <span class="font-bold text-blue-600">{{ $map['wilayah'] }}</span></p>
                                                    <p>Periode : <span class="font-semibold text-slate-700">{{ $map['periode'] }}</span></p>
                                                    <p>Tanggal Render : <span class="font-semibold text-slate-700">{{ $map['tanggal_render'] }}</span></p>
                                                </div>
                                            </div>

                                            {{-- 3 Tombol Aksi (Lihat, Salin Link, Download Langsung) --}}
                                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5">
                                                <a href="{{ $map['image_url'] }}" target="_blank" rel="noopener"
                                                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-blue-50 hover:border-blue-300 text-xs font-bold text-slate-700 hover:text-blue-700 transition">
                                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                    <span>Lihat</span>
                                                </a>

                                                <button type="button"
                                                    onclick="copyMapUrl(this, '{{ $map['raw_url'] }}')"
                                                    title="Salin Tautan Peta"
                                                    class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                                </button>

                                                <a href="{{ route('iklim.peta.download', ['kategori' => $map['key'], 'file' => $map['filename']]) }}"
                                                   title="Unduh Peta PNG"
                                                   class="p-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function filterRegion(slug) {
        document.querySelectorAll('.region-block').forEach(el => {
            if (slug === 'all' || el.dataset.region === slug) {
                el.classList.remove('hidden');
            } else {
                el.classList.add('hidden');
            }
        });
    }

    function copyMapUrl(btn, url) {
        navigator.clipboard.writeText(url).then(() => {
            const originalHtml = btn.innerHTML;
            btn.classList.add('border-emerald-400', 'bg-emerald-50', 'text-emerald-600');
            btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
            setTimeout(() => {
                btn.classList.remove('border-emerald-400', 'bg-emerald-50', 'text-emerald-600');
                btn.innerHTML = originalHtml;
            }, 1500);
        });
    }
</script>

@endsection