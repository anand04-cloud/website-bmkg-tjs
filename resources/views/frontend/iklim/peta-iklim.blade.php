@extends('layouts.app')

@section('content')

{{-- CSS KHUSUS UNTUK MEMPERCANTIK SCROLLBAR ARSIP --}}
<style>
    .arsip-scroll::-webkit-scrollbar {
        height: 6px;
    }
    .arsip-scroll::-webkit-scrollbar-track {
        background: #f1f5f9; 
        border-radius: 10px;
    }
    .arsip-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1; 
        border-radius: 10px;
    }
    .arsip-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8; 
    }
</style>

{{-- HERO SECTION GELAP --}}
<section class="relative bg-slate-900 pt-32 pb-32 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 mb-6 bg-blue-500/20 border border-blue-500/30 rounded-full text-blue-400 text-xs font-black uppercase tracking-widest">
            <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
            <span>Update Berkala</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4">
            Informasi Iklim & HTH
        </h1>
        <p class="text-slate-400 font-medium max-w-2xl mx-auto">
            Analisis dan Prediksi Spasial Informasi Iklim dan Hari Tanpa Hujan (HTH) Wilayah Kalimantan Utara
        </p>
    </div>
</section>

{{-- KONTEN UTAMA (TABS & PETA) --}}
<div class="bg-slate-50 pb-20 min-h-screen">
    <div class="container mx-auto px-6 max-w-7xl relative -mt-20 z-20">
        
        <div class="bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden flex flex-col md:flex-row">
            
            {{-- SIDEBAR TABS --}}
            <div class="w-full md:w-1/3 lg:w-1/4 bg-slate-800 p-6 flex flex-col gap-2">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Pilih Jenis Peta</p>
                
                @foreach($dataIklim as $key => $item)
                <button onclick="changeTab('{{ $key }}')" id="btn-{{ $key }}" class="tab-btn w-full text-left px-5 py-4 rounded-xl font-bold text-sm transition-all duration-300 {{ $loop->first ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-slate-700' }}">
                    {{ $item['judul'] }}
                </button>
                @endforeach
            </div>

            {{-- KONTEN PETA & KETERANGAN --}}
            <div class="w-full md:w-2/3 lg:w-3/4 p-6 md:p-10 relative bg-slate-50/50 min-h-[600px]">
                @foreach($dataIklim as $key => $item)
                <div id="content-{{ $key }}" class="tab-content transition-opacity duration-500 {{ $loop->first ? 'block opacity-100' : 'hidden opacity-0' }}">
                    
                    <div class="flex flex-col md:flex-row justify-between md:items-end mb-6 gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-slate-800">{{ $item['judul'] }}</h2>
                            <p id="periode-{{ $key }}" class="text-sm font-bold text-blue-600 mt-1">Periode: {{ $item['periode'] }}</p>
                        </div>
                        @if($item['periode'] !== 'Menunggu Update')
                        <span id="badge-{{ $key }}" class="inline-flex items-center justify-center px-4 py-1.5 bg-green-100 text-green-700 text-xs font-black rounded-full uppercase tracking-wider h-fit shadow-sm">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-2"></span> Update Terbaru
                        </span>
                        @endif
                    </div>

                    {{-- WADAH GAMBAR UTAMA --}}
                    <div id="main-wrapper-{{ $key }}" data-img="{{ $item['gambar'] }}" onclick="openLightbox(this.getAttribute('data-img'))" class="bg-white p-2 rounded-2xl shadow-sm border border-slate-200 group cursor-zoom-in overflow-hidden relative flex items-center justify-center min-h-[300px]">
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center z-10 rounded-xl">
                            <span class="bg-white text-slate-800 px-4 py-2 rounded-full font-bold text-sm flex items-center gap-2 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                Klik untuk Perbesar
                            </span>
                        </div>
                        <img id="main-img-{{ $key }}" src="{{ $item['gambar'] }}" alt="{{ $item['judul'] }}" class="w-full h-auto object-contain max-h-[500px] rounded-xl transition-transform duration-500 group-hover:scale-[1.02]" loading="lazy">
                    </div>

                    {{-- KETERANGAN / ANALISIS --}}
                    <div class="mt-6 p-6 bg-blue-50/70 rounded-2xl border border-blue-100/50 shadow-sm">
                        <h3 class="text-xs font-black text-blue-800 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Keterangan & Analisis
                        </h3>
                        <p id="keterangan-{{ $key }}" class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">{{ $item['keterangan'] }}</p>
                    </div>

                    {{-- ARSIP DATA (Termasuk yang terbaru) --}}
                    @if(count($item['arsip']) > 0)
                    <div class="mt-8 relative">
                        <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Daftar Peta Iklim
                            <span class="hidden md:inline-block ml-auto text-[9px] text-slate-400 font-bold tracking-widest"><span class="animate-pulse mr-1">↔️</span> GESER (DRAG) UNTUK MELIHAT</span>
                        </h3>
                        
                        {{-- KUNCI PERBAIKAN: Penambahan class UX cursor-grab dan select-none --}}
                        <div class="flex overflow-x-auto gap-4 pb-4 snap-x arsip-scroll cursor-grab active:cursor-grabbing select-none">
                            @foreach($item['arsip'] as $arsip)
                            <div class="snap-start shrink-0 w-48 group cursor-pointer relative" 
                                 data-img="{{ asset('storage/' . $arsip->gambar) }}"
                                 data-periode="{{ $arsip->periode }}"
                                 data-ket="{{ $arsip->keterangan ?? 'Belum ada keterangan analisis untuk periode ini.' }}"
                                 data-is-latest="{{ $loop->first ? 'yes' : 'no' }}" 
                                 onclick="viewArchive('{{ $key }}', this)">
                                
                                {{-- Jika ini data terbaru, beri indikator kecil --}}
                                @if($loop->first)
                                <div class="absolute -top-2 -right-2 w-4 h-4 bg-green-500 rounded-full border-2 border-white z-20 animate-pulse"></div>
                                @endif

                                <div class="bg-white p-1.5 rounded-xl border {{ $loop->first ? 'border-green-300' : 'border-slate-200' }} shadow-sm overflow-hidden relative transition-all duration-300 hover:border-blue-400 hover:shadow-md pointer-events-none">
                                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center z-10 rounded-lg">
                                        <svg class="w-6 h-6 text-white mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <span class="text-white text-[10px] font-bold">Lihat Detail</span>
                                    </div>
                                    <img src="{{ asset('storage/' . $arsip->gambar) }}" class="w-full h-32 object-cover rounded-lg" alt="Arsip {{ $arsip->periode }}" loading="lazy">
                                </div>
                                <p class="text-[11px] font-bold {{ $loop->first ? 'text-green-600' : 'text-slate-600' }} mt-2 line-clamp-2 text-center group-hover:text-blue-600 transition-colors pointer-events-none">{{ $arsip->periode }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

{{-- MODAL LIGHTBOX --}}
<div id="lightbox" class="fixed inset-0 z-[9999] bg-slate-900/95 hidden flex-col items-center justify-center opacity-0 transition-opacity duration-300" onclick="closeLightbox()">
    <button class="absolute top-6 right-6 text-white bg-white/10 hover:bg-red-500 p-3 rounded-full transition-colors z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    <div class="w-full h-full p-4 md:p-12 flex items-center justify-center overflow-auto">
        <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl transform scale-95 transition-transform duration-300 cursor-zoom-out" alt="Zoomed Map" onclick="event.stopPropagation(); closeLightbox();">
    </div>
</div>

<script>
    // Fungsi Tab Peta Kiri
    function changeTab(tabId) {
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-500/30');
            btn.classList.add('text-slate-300', 'hover:bg-slate-700');
        });
        
        const activeBtn = document.getElementById('btn-' + tabId);
        activeBtn.classList.remove('text-slate-300', 'hover:bg-slate-700');
        activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-500/30');

        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden', 'opacity-0');
            content.classList.remove('block', 'opacity-100');
        });

        const activeContent = document.getElementById('content-' + tabId);
        activeContent.classList.remove('hidden');
        setTimeout(() => {
            activeContent.classList.remove('opacity-0');
            activeContent.classList.add('opacity-100');
        }, 50);
    }

    // Fungsi Gallery Swap
    function viewArchive(tabKey, element) {
        const imgSrc = element.getAttribute('data-img');
        const periode = element.getAttribute('data-periode');
        const keterangan = element.getAttribute('data-ket');
        const isLatest = element.getAttribute('data-is-latest');

        document.getElementById('main-img-' + tabKey).src = imgSrc;
        document.getElementById('main-wrapper-' + tabKey).setAttribute('data-img', imgSrc);
        document.getElementById('periode-' + tabKey).innerText = 'Periode: ' + periode;
        document.getElementById('keterangan-' + tabKey).innerText = keterangan;

        const badge = document.getElementById('badge-' + tabKey);
        if (badge) {
            badge.style.display = isLatest === 'yes' ? 'inline-flex' : 'none';
        }

        document.getElementById('content-' + tabKey).scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Fungsi Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    function openLightbox(imgSrc) {
        if(imgSrc.includes('placehold.co')) return; 
        
        lightboxImg.src = imgSrc;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden'; 
        
        setTimeout(() => {
            lightbox.classList.remove('opacity-0');
            lightboxImg.classList.remove('scale-95');
            lightboxImg.classList.add('scale-100');
        }, 10);
    }

    function closeLightbox() {
        lightbox.classList.add('opacity-0');
        lightboxImg.classList.remove('scale-100');
        lightboxImg.classList.add('scale-95');
        document.body.style.overflow = 'auto'; 
        
        setTimeout(() => {
            lightbox.classList.remove('flex');
            lightbox.classList.add('hidden');
            lightboxImg.src = '';
        }, 300);
    }

    // =======================================================================
    // FUNGSI BARU: DRAG TO SCROLL UNTUK MULTIPLE SLIDER ARSIP (DESKTOP UX)
    // =======================================================================
    document.addEventListener('DOMContentLoaded', () => {
        const sliders = document.querySelectorAll('.arsip-scroll');
        
        sliders.forEach(slider => {
            let isDown = false;
            let startX;
            let scrollLeft;

            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                slider.classList.add('cursor-grabbing');
                slider.classList.remove('cursor-grab');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });
            
            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('cursor-grabbing');
                slider.classList.add('cursor-grab');
            });
            
            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('cursor-grabbing');
                slider.classList.add('cursor-grab');
            });
            
            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault(); 
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 2; 
                slider.scrollLeft = scrollLeft - walk;
            });
        });
    });
</script>
@endsection