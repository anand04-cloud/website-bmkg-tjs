@extends('layouts.app')

@section('content')
{{-- CSS Leaflet Mandatori --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

{{-- Header Banner --}}
<section class="relative bg-slate-900 pt-32 pb-24 2xl:pt-48 2xl:pb-36 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 2xl:space-x-4 px-4 py-1.5 2xl:px-8 2xl:py-3 mb-6 2xl:mb-10 bg-amber-500/20 border border-amber-500/30 rounded-full text-amber-400 text-xs 2xl:text-xl font-black uppercase tracking-widest">
            <span class="w-2 h-2 2xl:w-4 2xl:h-4 rounded-full bg-amber-500 animate-ping"></span>
            <span>Update Terkini Nasional</span>
        </div>
        <h1 class="text-4xl md:text-5xl 2xl:text-[7rem] font-black text-white tracking-tight mb-4 2xl:mb-8">
            Peringatan Dini Cuaca
        </h1>
        <p class="text-slate-400 font-medium max-w-2xl 2xl:max-w-6xl mx-auto text-base 2xl:text-3xl leading-relaxed">
            Sistem pemantauan peringatan dini cuaca ekstrem secara real-time untuk seluruh wilayah Republik Indonesia (Nowcasting)
        </p>
    </div>
</section>

{{-- Main Content --}}
<section class="relative w-full bg-[#f8faff] pb-24 2xl:pb-40 -mt-10 2xl:-mt-16 z-20">
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12">
        
        <div class="w-full mx-auto bg-white rounded-[2rem] 2xl:rounded-[4rem] shadow-xl border border-slate-100 overflow-hidden">
            
            {{-- Peta Interaktif Leaflet Nasional --}}
            <div class="w-full relative group">
                <div id="map" class="w-full h-[400px] md:h-[500px] 2xl:h-[700px] z-10"></div>
                
                <div class="absolute bottom-6 2xl:bottom-10 left-6 2xl:left-10 bg-white/95 backdrop-blur-sm px-6 py-3 2xl:px-10 2xl:py-6 rounded-2xl 2xl:rounded-[2rem] shadow-lg border border-slate-100 z-20 pointer-events-none">
                    <p class="text-[10px] 2xl:text-base font-black text-slate-400 uppercase tracking-widest mb-1 2xl:mb-2">Status Pemantauan</p>
                    <p class="text-sm 2xl:text-2xl font-bold text-slate-800">
                        {{ \Carbon\Carbon::now('Asia/Makassar')->translatedFormat('l, d F Y | H:i') }} WITA
                    </p>
                </div>
            </div>

            {{-- Bagian Bawah: Daftar Peringatan Nasional Dinamis --}}
            <div class="p-8 md:p-12 2xl:p-24 relative">
                @if(isset($warnings) &&$warnings->count() > 0)
                    
                    <div class="absolute top-0 right-0 w-64 2xl:w-[500px] h-64 2xl:h-[500px] bg-amber-100/50 rounded-full blur-3xl -z-10 pointer-events-none"></div>

                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 2xl:mb-16 pb-6 2xl:pb-12 border-b border-slate-100 gap-4 2xl:gap-8">
                        <h2 class="text-2xl 2xl:text-5xl font-black text-slate-800 uppercase tracking-tight flex items-center">
                            <span class="w-3 h-3 2xl:w-6 2xl:h-6 rounded-full bg-red-500 animate-pulse mr-3 2xl:mr-5"></span>
                            Daftar Peringatan Aktif ({{ $warnings->count() }} Wilayah)
                        </h2>
                    </div>
                    
                    {{-- Grid List Peringatan Nasional --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-6 2xl:gap-10">
                        @foreach($warnings as $warn)
                            <div class="bg-white border-2 border-red-100 hover:border-red-300 rounded-2xl 2xl:rounded-[2rem] p-6 2xl:p-10 shadow-sm hover:shadow-lg transition-all flex flex-col h-full">
                                <div class="flex-1">
                                    <h3 class="font-black text-red-600 text-lg 2xl:text-3xl mb-2 2xl:mb-4">{{ $warn->title }}</h3>
                                    <p class="text-xs 2xl:text-lg text-slate-500 mb-4 2xl:mb-6 font-medium">
                                        Rilis: {{ \Carbon\Carbon::parse($warn->publish_time)->translatedFormat('d M Y, H:i') }} WITA
                                    </p>
                                    <div class="format-bmkg text-slate-700 text-sm 2xl:text-xl text-justify max-h-40 2xl:max-h-64 overflow-y-auto custom-scrollbar pr-4">
                                        {!! $warn->content !!}
                                    </div>
                                </div>
                                <div class="mt-6 2xl:mt-10 pt-4 2xl:pt-6 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-full">Peringatan Dini Resmi</span>
                                    
                                    {{-- Tombol diarahkan ke web resmi BMKG / Infografis --}}
                                    <a href="https://www.bmkg.go.id/cuaca/peringatan-dini-cuaca" target="_blank" class="inline-flex items-center text-sm 2xl:text-xl font-bold text-blue-600 hover:text-blue-800 transition-colors">
                                        Lihat Selengkapnya
                                        <svg class="w-4 h-4 2xl:w-6 2xl:h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @else
                    {{-- JIKA TIDAK ADA PERINGATAN NASIONAL --}}
                    <div class="text-center py-10 2xl:py-24">
                        <div class="w-24 h-24 2xl:w-40 2xl:h-40 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 2xl:mb-10 text-emerald-500 shadow-inner">
                            <svg class="w-12 h-12 2xl:w-20 2xl:h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-3xl 2xl:text-6xl font-black text-slate-800 mb-3 2xl:mb-6 tracking-tight">Cuaca Terpantau Aman</h3>
                        <p class="text-slate-500 max-w-xl 2xl:max-w-4xl mx-auto font-medium text-lg 2xl:text-3xl leading-relaxed">
                            Saat ini <strong>tidak ada peringatan dini cuaca</strong> yang aktif di seluruh wilayah Indonesia.
                        </p>
                    </div>
                @endif
                
                {{-- Imbauan Standar --}}
                <div class="mt-12 2xl:mt-24 p-5 2xl:p-10 bg-slate-50 border-l-4 2xl:border-l-8 border-slate-700 rounded-r-2xl 2xl:rounded-r-[2rem] flex items-start space-x-4 2xl:space-x-8 shadow-sm">
                    <svg class="w-7 h-7 2xl:w-12 2xl:h-12 text-slate-600 shrink-0 mt-0.5 2xl:mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm 2xl:text-2xl font-black text-slate-800 tracking-wide uppercase mb-1 2xl:mb-3">Informasi Cuaca BMKG</p>
                        <p class="text-sm 2xl:text-xl text-slate-500 font-medium leading-relaxed 2xl:leading-relaxed">Masyarakat diimbau agar selalu waspada terhadap potensi cuaca ekstrem yang dinamis dan memantau pembaruan secara berkala.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Style Kustom Format Teks BMKG --}}
<style>
    .format-bmkg { line-height: 1.8; }
    .format-bmkg p { margin-bottom: 1rem; }
    .format-bmkg b, .format-bmkg strong {
        color: #0f172a;
        font-weight: 900;
        display: inline-block;
        margin-top: 0.5rem;
    }
    .format-bmkg br {
        content: "";
        margin: 1.5em;
        display: block;
        font-size: 24%;
    }
    @media (min-width: 1536px) {
        .format-bmkg { line-height: 2; }
        .format-bmkg p { margin-bottom: 1.5rem; }
        .format-bmkg b, .format-bmkg strong { margin-top: 1rem; }
    }
    
    /* Custom Scrollbar untuk Box Peringatan */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

{{-- Script Pemetaan Leaflet Nasional --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('map')) {
            // Peta berpusat di tengah Indonesia
            var map = L.map('map', { scrollWheelZoom: false }).setView([-0.789, 113.921], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Koordinat Pendekatan Tiap Provinsi di Indonesia
            const provinceCoords = {
                "Aceh": [4.6951, 96.7494], "Sumatera Utara": [2.1154, 99.5451], "Sumatera Barat": [-0.7399, 100.8000],
                "Riau": [0.2933, 101.7068], "Jambi": [-1.6110, 103.6131], "Sumatera Selatan": [-3.3194, 104.0413],
                "Bengkulu": [-3.5778, 102.3464], "Lampung": [-4.5586, 105.4068], "Bangka Belitung": [-2.7411, 106.4406],
                "Kepulauan Riau": [3.9456, 108.1429], "DKI Jakarta": [-6.2088, 106.8456], "Jawa Barat": [-6.9204, 107.6046],
                "Jawa Tengah": [-7.1509, 110.1403], "DI Yogyakarta": [-7.7956, 110.3695], "Jawa Timur": [-7.2504, 112.7688],
                "Banten": [-6.4058, 106.0640], "Bali": [-8.4095, 115.1889], "Nusa Tenggara Barat": [-8.6529, 117.3616],
                "Nusa Tenggara Timur": [-8.6574, 121.0794], "Kalimantan Barat": [-0.2788, 111.4753], "Kalimantan Tengah": [-1.6815, 113.3824],
                "Kalimantan Selatan": [-3.0926, 115.2838], "Kalimantan Timur": [0.5387, 116.4194], "Kalimantan Utara": [3.0731, 116.0414],
                "Sulawesi Utara": [0.6247, 123.9750], "Sulawesi Tengah": [-1.4300, 121.4456], "Sulawesi Selatan": [-3.6688, 119.9741],
                "Sulawesi Tenggara": [-4.1449, 122.1746], "Gorontalo": [0.5435, 123.0568], "Sulawesi Barat": [-2.8441, 119.2312],
                "Maluku": [-3.2385, 130.1453], "Maluku Utara": [1.5709, 127.8088], "Papua Barat": [-1.3361, 133.1747],
                "Papua": [-4.2699, 138.0804]
            };

            // Ikon Kustom Peringatan Dini (Warna Merah/Kuning)
            var warningIcon = L.divIcon({
                className: 'custom-warning-icon',
                html: `<div style="background-color: #facc15; border: 2px solid #ea580c; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 10px rgba(234, 88, 12, 0.5);"><span style="color: #ea580c; font-weight: bold; font-size: 14px;">!</span></div>`,
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });

            var warningsData = @json($warnings ?? []);

            if (warningsData && warningsData.length > 0) {
                warningsData.forEach(function(item) {
                    var judul = item.title || "";
                    var wilayahMatch = null;
                    
                    // Deteksi nama provinsi dari judul Peringatan Dini
                    for (var prov in provinceCoords) {
                        if (judul.toLowerCase().includes(prov.toLowerCase()) || 
                           (prov === "Kalimantan Utara" && judul.toLowerCase().includes("kaltara"))) {
                            wilayahMatch = prov;
                            break;
                        }
                    }

                    // Jika provinsi dikenali, pasang Marker di Peta
                    if (wilayahMatch) {
                        var popupContent = `
                            <div class="text-sm p-2 min-w-[200px]">
                                <b class="text-red-600 block mb-1">${judul}</b>
                                <span class="text-xs text-slate-500 block mb-2">${item.publish_time} WITA</span>
                                <div class="max-h-24 overflow-y-auto text-xs text-justify pr-2 mb-2 border-l-2 border-red-200 pl-2">
                                    ${item.content.replace(/(<([^>]+)>)/gi, "").substring(0, 150)}...
                                </div>
                            </div>
                        `;

                        L.marker(provinceCoords[wilayahMatch], { icon: warningIcon })
                         .addTo(map)
                         .bindPopup(popupContent);
                    }
                });
            }
        }
    });
</script>
@endsection