@extends('layouts.app')

@section('content')
{{-- CSS & JS Leaflet Mandatori --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

{{-- Header Banner --}}
<section class="relative bg-slate-900 pt-32 pb-24 2xl:pt-48 2xl:pb-36 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    
    {{-- KUNCI 1: Wrapper Hero Merentang Penuh --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 2xl:space-x-4 px-4 py-1.5 2xl:px-8 2xl:py-3 mb-6 2xl:mb-10 bg-orange-500/20 border border-orange-500/30 rounded-full text-orange-400 text-xs 2xl:text-xl font-black uppercase tracking-widest">
            <span class="w-2 h-2 2xl:w-4 2xl:h-4 rounded-full bg-orange-500 animate-ping"></span>
            <span>Update Terkini</span>
        </div>
        <h1 class="text-4xl md:text-5xl 2xl:text-[7rem] font-black text-white tracking-tight mb-4 2xl:mb-8">
            Gempa Bumi Dirasakan
        </h1>
        <p class="text-slate-400 font-medium max-w-2xl 2xl:max-w-6xl mx-auto 2xl:text-3xl leading-relaxed">
            Peta sebaran dan informasi gempabumi yang dirasakan oleh masyarakat berdasarkan skala MMI (Modified Mercalli Intensity)
        </p>
    </div>
</section>

{{-- Main Content --}}
<section class="relative w-full bg-[#f8faff] pb-24 2xl:pb-40 -mt-10 2xl:-mt-16 z-20">
    
    {{-- KUNCI 2: Wrapper Konten Utama Merentang --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-4 md:px-6 2xl:px-12">
        
        {{-- KUNCI 3: Hapus max-w-5xl agar grid melebar penuh --}}
        <div class="w-full mx-auto">
            
            {{-- WADAH PETA GEMPA (SELALU TAMPIL DI ATAS DAFTAR) --}}
            <div class="mb-8 2xl:mb-16 bg-white p-4 2xl:p-8 rounded-[2rem] 2xl:rounded-[3rem] shadow-xl border border-slate-100 relative z-0">
                <div id="map-gempa" class="w-full h-[400px] md:h-[500px] 2xl:h-[700px] rounded-[1.5rem] 2xl:rounded-[2.5rem] z-0"></div>
            </div>

            @if(!empty($gempaData) && count($gempaData) > 0)
                <div class="grid grid-cols-1 gap-6 2xl:gap-10">
                    @foreach($gempaData as $index => $gempa)
                    <div class="bg-white rounded-[2rem] 2xl:rounded-[3rem] shadow-lg border border-slate-100 p-6 md:p-8 2xl:p-16 flex flex-col md:flex-row md:items-center gap-6 md:gap-10 2xl:gap-20 hover:-translate-y-1 2xl:hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden">
                        
                        {{-- KUNCI PERBAIKAN 2: Penanda Gempa Terbaru di List (Khusus Index 0) --}}
                        @if($index === 0)
                            <div class="absolute top-0 right-0 bg-rose-600 text-white text-[10px] 2xl:text-lg font-black uppercase tracking-widest px-5 py-2 2xl:px-8 2xl:py-4 rounded-bl-2xl 2xl:rounded-bl-3xl z-10 shadow-md">
                                Paling Baru
                            </div>
                        @endif

                        {{-- Kiri: Magnitudo & Waktu --}}
                        <div class="shrink-0 text-center md:text-left md:border-r md:border-slate-100 md:pr-10 2xl:pr-20 pt-4 md:pt-0">
                            <h3 class="text-6xl 2xl:text-[7rem] font-black text-slate-800 tracking-tighter leading-none">
                                {{ $gempa['Magnitude'] }}<span class="text-2xl 2xl:text-5xl font-bold text-slate-400 ml-1 2xl:ml-3">SR</span>
                            </h3>
                            <div class="mt-3 2xl:mt-6 inline-block px-3 py-1 2xl:px-6 2xl:py-3 bg-slate-50 text-slate-600 rounded-lg 2xl:rounded-xl text-[10px] 2xl:text-lg font-black uppercase tracking-widest border border-slate-200">
                                Kedalaman: {{ $gempa['Kedalaman'] }}
                            </div>
                        </div>

                        {{-- Kanan: Detail Lokasi & Dirasakan --}}
                        <div class="flex-1 space-y-4 2xl:space-y-8">
                            <div>
                                <p class="text-[10px] 2xl:text-lg font-bold text-slate-400 uppercase tracking-widest mb-1 2xl:mb-2">Waktu Kejadian</p>
                                <p class="text-sm 2xl:text-3xl font-black text-blue-600">{{ $gempa['Tanggal'] }} | {{ $gempa['Jam'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-[10px] 2xl:text-lg font-bold text-slate-400 uppercase tracking-widest mb-1 2xl:mb-2">Pusat Gempa</p>
                                <p class="text-base 2xl:text-4xl font-bold text-slate-700 leading-tight">{{ $gempa['Wilayah'] }}</p>
                                <p class="text-xs 2xl:text-xl font-medium text-slate-500 mt-1 2xl:mt-3">Koordinat: {{ $gempa['Lintang'] }} - {{ $gempa['Bujur'] }}</p>
                            </div>

                            <div class="pt-4 2xl:pt-8 border-t border-slate-50">
                                <p class="text-[10px] 2xl:text-xl font-bold text-orange-500 uppercase tracking-widest mb-1 2xl:mb-4 flex items-center">
                                    <svg class="w-3 h-3 2xl:w-6 2xl:h-6 mr-1 2xl:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    Wilayah Dirasakan (Skala MMI)
                                </p>
                                <p class="text-sm 2xl:text-2xl font-bold text-slate-800 bg-orange-50 px-4 py-2 2xl:px-8 2xl:py-5 rounded-xl 2xl:rounded-2xl border border-orange-100/50 leading-relaxed">
                                    {{ $gempa['Dirasakan'] }}
                                </p>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback jika API BMKG Error/Kosong --}}
                <div class="bg-white rounded-[2rem] 2xl:rounded-[4rem] shadow-xl border border-slate-100 p-12 2xl:p-32 text-center">
                    <div class="w-20 h-20 2xl:w-40 2xl:h-40 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 2xl:mb-12 text-slate-400">
                        <svg class="w-10 h-10 2xl:w-20 2xl:h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl 2xl:text-5xl font-black text-slate-800 mb-2 2xl:mb-6">Data Tidak Tersedia</h3>
                    <p class="text-slate-500 font-medium 2xl:text-2xl">Mohon maaf, saat ini data Gempa Dirasakan tidak dapat diambil dari server pusat BMKG.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<style>
    /* Styling untuk Popup Peta */
    .custom-popup .leaflet-popup-content-wrapper {
        border-radius: 1.5rem;
        padding: 0.5rem;
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        border: 1px solid #f1f5f9;
    }
    .custom-popup .leaflet-popup-tip {
        background: #ffffff;
    }
    
    /* Tambahan Styling khusus PC Besar pada konten Popup Leaflet */
    @media (min-width: 1536px) {
        .custom-popup .leaflet-popup-content-wrapper {
            border-radius: 2rem;
            padding: 1rem;
        }
    }
</style>

{{-- SCRIPT PETA GEMPA --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Inisialisasi Peta (Default ke tengah Indonesia)
        var mapGempa = L.map('map-gempa', {
            scrollWheelZoom: false
        }).setView([-2.5, 118.0], 5);

        // 2. Gunakan layer peta terang (Light Mode)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapGempa);

        // 3. Tarik data gempa dari controller
        var gempaData = @json($gempaData);

        if (gempaData && gempaData.length > 0) {
            // Siapkan wadah pembatas peta
            var bounds = [];
            
            // Ikon Gempa (Warna Merah dengan simbol Petir)
            // Di JS kita buat agar ukuran ikonnya menyesuaikan class Tailwind
            var quakeIcon = L.divIcon({
                className: 'custom-div-icon',
                html: `<div class="bg-rose-500 border-2 border-white rounded-full p-1.5 shadow-md animate-pulse flex justify-center items-center h-full w-full">
                         <svg class="w-4 h-4 2xl:w-6 2xl:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                       </div>`,
                iconSize: [36, 36],
                iconAnchor: [18, 18]
            });

            // 4. Looping data gempa untuk digambar di peta
            gempaData.forEach(function(gempa, index) {
                // Pastikan koordinat tersedia
                if (gempa.Coordinates) {
                    // Pecah koordinat (BMKG formatnya: "Lintang,Bujur")
                    var coords = gempa.Coordinates.split(',');
                    var lat = parseFloat(coords[0]);
                    var lng = parseFloat(coords[1]);

                    // Jika angkanya valid, buat markernya
                    if (!isNaN(lat) && !isNaN(lng)) {
                        bounds.push([lat, lng]); // Masukkan ke wadah pembatas
                        
                        var marker = L.marker([lat, lng], {icon: quakeIcon}).addTo(mapGempa);
                        
                        // Tag "Gempa Terbaru" khusus data paling atas (index 0)
                        var badgeHtml = index === 0 
                            ? `<div class="bg-rose-500 text-white text-[10px] 2xl:text-sm font-bold px-2 py-1 2xl:px-4 2xl:py-2 rounded-md 2xl:rounded-lg mb-2 uppercase tracking-wider inline-block">Gempa Paling Baru</div>`
                            : `<div class="bg-rose-100 text-rose-700 text-[10px] 2xl:text-sm font-bold px-2 py-1 2xl:px-4 2xl:py-2 rounded-md 2xl:rounded-lg mb-2 uppercase tracking-wider inline-block">Histori Dirasakan</div>`;

                        var popupContent = `
                            <div class="p-2 2xl:p-4 min-w-[220px] 2xl:min-w-[320px] font-sans text-center">
                                ${badgeHtml}
                                <h4 class="text-3xl 2xl:text-5xl font-black text-slate-800 mb-0 2xl:mb-2">${gempa.Magnitude} <span class="text-sm 2xl:text-xl font-bold text-slate-500">SR</span></h4>
                                <p class="text-[10px] 2xl:text-sm font-bold text-slate-500 mb-2 2xl:mb-4">${gempa.Tanggal} | ${gempa.Jam}</p>
                                <div class="bg-slate-50 border border-slate-100 rounded-xl 2xl:rounded-2xl p-2 2xl:p-4 mb-2 2xl:mb-4">
                                    <p class="text-[10px] 2xl:text-base font-bold text-slate-700 leading-tight">${gempa.Wilayah}</p>
                                </div>
                                <div class="bg-orange-50 text-orange-600 text-[9px] 2xl:text-sm font-bold p-2 2xl:p-4 rounded-lg 2xl:rounded-xl border border-orange-100 leading-relaxed">
                                    MMI: ${gempa.Dirasakan}
                                </div>
                            </div>
                        `;
                        marker.bindPopup(popupContent, { className: 'custom-popup' });
                    }
                }
            });

            // 5. Jika ada titik gempa, zoom otomatis layar agar memuat semua titik tersebut
            if (bounds.length > 0) {
                mapGempa.fitBounds(bounds, { padding: [40, 40] });
            }
        }
    });
</script>
@endsection