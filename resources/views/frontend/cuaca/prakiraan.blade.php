@extends('layouts.app')

@section('content')
@php
    // Helper untuk Icon, Cuaca, dan Warna
    function getPrakiraanDetail($code) {
        $code = (int) $code;
        $map = [
            0 => ['Cerah', '☀️', 'text-amber-500'],
            1 => ['Cerah Berawan', '🌤️', 'text-amber-400'],
            2 => ['Cerah Berawan', '🌤️', 'text-amber-400'],
            3 => ['Berawan', '☁️', 'text-slate-400'],
            4 => ['Berawan Tebal', '☁️', 'text-slate-600'],
            5 => ['Udara Kabur', '🌫️', 'text-slate-400'],
            10 => ['Asap', '🌫️', 'text-slate-500'],
            17 => ['Petir', '🌩️', 'text-amber-500'],
            45 => ['Kabut', '🌫️', 'text-slate-500'],
            60 => ['Hujan Ringan', '🌦️', 'text-blue-400'],
            61 => ['Hujan Sedang', '🌧️', 'text-blue-500'],
            63 => ['Hujan Lebat', '🌧️', 'text-blue-600'],
            80 => ['Hujan Lokal', '🌦️', 'text-blue-400'],
            95 => ['Hujan Petir', '⛈️', 'text-purple-600'],
            97 => ['Hujan Petir', '⛈️', 'text-purple-600'],

            // --- KODE MALAM (+100 dari kode siang) ---
            100 => ['Cerah', '🌙', 'text-blue-300'],
            101 => ['Cerah Berawan', '☁️', 'text-slate-400'],
            102 => ['Cerah Berawan', '☁️', 'text-slate-400'],
            103 => ['Berawan', '☁️', 'text-slate-500'],
            104 => ['Berawan Tebal', '☁️', 'text-slate-600'],
            105 => ['Udara Kabur', '🌫️', 'text-slate-400'],
            110 => ['Asap', '🌫️', 'text-slate-500'],
            117 => ['Petir', '🌩️', 'text-amber-500'],
            145 => ['Kabut', '🌫️', 'text-slate-500'],
            160 => ['Hujan Ringan', '🌦️', 'text-blue-400'],
            161 => ['Hujan Sedang', '🌧️', 'text-blue-500'],
            163 => ['Hujan Lebat', '🌧️', 'text-blue-600'],
            180 => ['Hujan Lokal', '🌦️', 'text-blue-400'],
            195 => ['Hujan Petir', '⛈️', 'text-purple-600'],
            197 => ['Hujan Petir', '⛈️', 'text-purple-600'],
        ];
        return $map[$code] ?? ["Tidak Diketahui ($code)", '❓', 'text-slate-400'];
    }

    // Helper untuk Arah Angin
    function getArahAngin($dir) {
        $map = ['N'=>'Utara', 'NNE'=>'Utara Timur Laut', 'NE'=>'Timur Laut', 'ENE'=>'Timur Timur Laut', 'E'=>'Timur', 'ESE'=>'Timur Menenggara', 'SE'=>'Tenggara', 'SSE'=>'Selatan Menenggara', 'S'=>'Selatan', 'SSW'=>'Selatan Barat Daya', 'SW'=>'Barat Daya', 'WSW'=>'Barat Barat Daya', 'W'=>'Barat', 'WNW'=>'Barat Barat Laut', 'NW'=>'Barat Laut', 'NNW'=>'Utara Barat Laut'];
        return $map[$dir] ?? $dir;
    }
@endphp

{{-- Header Banner & Search Autocomplete --}}
<section class="relative bg-slate-900 pt-32 pb-24 2xl:pt-48 2xl:pb-36 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>

    {{-- KUNCI 1: Wrapper Hero Merentang Penuh --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 2xl:space-x-4 px-4 py-1.5 2xl:px-8 2xl:py-3 mb-6 2xl:mb-10 bg-blue-500/20 border border-blue-500/30 rounded-full text-blue-400 text-xs 2xl:text-xl font-black uppercase tracking-widest">
            <span class="w-2 h-2 2xl:w-4 2xl:h-4 rounded-full bg-blue-500 animate-ping"></span>
            <span>Update Prakiraan</span>
        </div>
        <h1 class="text-4xl md:text-5xl 2xl:text-[7rem] font-black text-white tracking-tight mb-2 2xl:mb-6">Prakiraan Cuaca</h1>
        <p class="text-slate-400 font-medium max-w-2xl 2xl:max-w-5xl mx-auto mb-8 2xl:mb-14 2xl:text-2xl">
            Informasi Prakiraan Cuaca terkini untuk wilayah Kecamatan di Kalimantan Utara
        </p>

        {{-- Search Box --}}
        <div class="max-w-2xl 2xl:max-w-5xl mx-auto relative z-10">
            <form action="/cuaca/prakiraan" method="GET" id="dropdownSearchForm">
                <input type="hidden" name="search" id="hiddenSearchInput" value="{{ $search }}">

                <div class="flex flex-col sm:flex-row items-center gap-3 bg-white/10 border border-slate-600 rounded-[2rem] sm:rounded-full p-2.5 2xl:p-4 backdrop-blur-md">
                    
                    {{-- Dropdown 1: Kabupaten / Kota --}}
                    <div class="flex items-center w-full sm:w-1/2 px-3 2xl:px-6 border-b sm:border-b-0 sm:border-r border-slate-600/50 pb-2 sm:pb-0">
                        <span class="text-xl 2xl:text-3xl mr-2 2xl:mr-4">🏢</span>
                        <select id="kabupatenSelect" class="w-full bg-transparent text-white text-sm 2xl:text-xl font-semibold outline-none cursor-pointer appearance-none pr-4">
                            <option value="" class="text-slate-800">-- Pilih Kab / Kota --</option>
                            <option value="Bulungan" class="text-slate-800">Kab. Bulungan</option>
                            <option value="Tarakan" class="text-slate-800">Kota Tarakan</option>
                            <option value="Malinau" class="text-slate-800">Kab. Malinau</option>
                            <option value="Nunukan" class="text-slate-800">Kab. Nunukan</option>
                            <option value="Tana Tidung" class="text-slate-800">Kab. Tana Tidung</option>
                        </select>
                    </div>

                    {{-- Dropdown 2: Kecamatan / Kelurahan --}}
                    <div class="flex items-center w-full sm:w-1/2 px-3 2xl:px-6 pb-2 sm:pb-0">
                        <span class="text-xl 2xl:text-3xl mr-2 2xl:mr-4">📍</span>
                        <select id="kecamatanSelect" disabled class="w-full bg-transparent text-white text-sm 2xl:text-xl font-semibold outline-none cursor-pointer disabled:opacity-40 appearance-none pr-4">
                            <option value="" class="text-slate-800">-- Pilih Kecamatan --</option>
                        </select>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white text-xs 2xl:text-xl font-black px-6 py-3 2xl:px-10 2xl:py-5 rounded-full transition shrink-0 uppercase tracking-wider shadow-md">
                        Lihat Cuaca
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- Main Content --}}
<section class="relative w-full bg-[#f4f7fb] pb-24 2xl:pb-40 mt-5 2xl:mt-10 z-10">
    {{-- KUNCI 2: Wrapper Konten Utama Merentang Penuh --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12">
        
        @if($currentWeather)
        @php
            $weatherCode = $currentWeather['weather'] ?? 0;
            $currentDetail = getPrakiraanDetail($weatherCode);
            $speedKmH = round(($currentWeather['ws'] ?? 0) * 1.852, 1);
        @endphp

        {{-- KARTU CUACA SAAT INI --}}
        {{-- KUNCI 3: Hapus max-w-5xl, ubah jadi w-full --}}
        <div class="w-full mx-auto bg-white rounded-3xl 2xl:rounded-[4rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 md:p-10 2xl:p-24 relative mb-8 2xl:mb-16 flex flex-col lg:flex-row items-center justify-between gap-8 2xl:gap-20">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 bg-slate-900 text-white px-6 py-1.5 2xl:px-12 2xl:py-3 rounded-b-xl 2xl:rounded-b-3xl text-[10px] 2xl:text-lg font-black tracking-widest shadow-md whitespace-nowrap">
                PEMUTAKHIRAN: {{ \Carbon\Carbon::parse($currentWeather['local_datetime'])->translatedFormat('d M Y • H:i') }} WITA
            </div>

            <div class="flex items-center space-x-6 2xl:space-x-12 mt-4 md:mt-0 w-full lg:w-1/2">
                <div class="text-[100px] md:text-[120px] 2xl:text-[220px] leading-none drop-shadow-xl {{ $currentDetail[2] }}">
                    {{ $currentDetail[1] }}
                </div>
                <div>
                    <h2 class="text-6xl md:text-7xl 2xl:text-[9rem] font-black text-slate-800 tracking-tighter">{{ $currentWeather['t'] ?? '--' }}°C</h2>
                    <p class="text-lg md:text-xl 2xl:text-4xl font-bold text-slate-700 mt-1 2xl:mt-4 flex items-center flex-wrap">
                        {{ $currentDetail[0] }} 
                        <span class="text-slate-300 mx-2 2xl:mx-4 text-sm 2xl:text-3xl">•</span> 
                        <span class="text-slate-500 text-base md:text-lg 2xl:text-3xl">di {{ $search }}</span>
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-4 2xl:gap-8">
                <div class="bg-slate-50/80 rounded-2xl 2xl:rounded-3xl p-4 2xl:p-8 flex items-center space-x-4 2xl:space-x-8 border border-slate-100/50">
                    <div class="w-10 h-10 2xl:w-20 2xl:h-20 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center text-xl 2xl:text-4xl shrink-0">💧</div>
                    <div><p class="text-[10px] 2xl:text-lg font-black text-slate-400 uppercase tracking-wider">Kelembapan</p><p class="text-lg 2xl:text-3xl font-black text-slate-700 leading-tight">{{ $currentWeather['hu'] ?? '0' }}%</p></div>
                </div>
                <div class="bg-slate-50/80 rounded-2xl 2xl:rounded-3xl p-4 2xl:p-8 flex items-center space-x-4 2xl:space-x-8 border border-slate-100/50">
                    <div class="w-10 h-10 2xl:w-20 2xl:h-20 bg-slate-200 text-slate-600 rounded-full flex items-center justify-center text-xl 2xl:text-4xl shrink-0">💨</div>
                    <div><p class="text-[10px] 2xl:text-lg font-black text-slate-400 uppercase tracking-wider">Kec. Angin</p><p class="text-lg 2xl:text-3xl font-black text-slate-700 leading-tight">{{ $speedKmH }} km/j</p></div>
                </div>
                <div class="bg-slate-50/80 rounded-2xl 2xl:rounded-3xl p-4 2xl:p-8 flex items-center space-x-4 2xl:space-x-8 border border-slate-100/50 sm:col-span-2">
                    <div class="w-10 h-10 2xl:w-20 2xl:h-20 bg-amber-100 text-amber-500 rounded-full flex items-center justify-center text-xl 2xl:text-4xl shrink-0">🧭</div>
                    <div><p class="text-[10px] 2xl:text-lg font-black text-slate-400 uppercase tracking-wider">Arah Angin</p><p class="text-lg 2xl:text-3xl font-black text-slate-700 leading-tight">{{ getArahAngin($currentWeather['wd'] ?? 'N/A') }}</p></div>
                </div>
            </div>
        </div>

        {{-- PRAKIRAAN PER JAM --}}
        {{-- KUNCI 4: Hapus max-w-5xl, ubah jadi w-full --}}
        <div class="w-full mx-auto bg-white rounded-3xl 2xl:rounded-[4rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 md:p-10 2xl:p-20 relative">
            
            {{-- Tambahan Indikator Geser --}}
            <div class="hidden md:flex absolute top-4 2xl:top-8 right-8 2xl:right-16 items-center text-[10px] 2xl:text-base font-bold text-slate-400 uppercase tracking-widest pointer-events-none">
                <svg class="w-4 h-4 2xl:w-6 2xl:h-6 mr-1 2xl:mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                Geser (Drag) untuk melihat
            </div>

            <div id="scrollArea" class="flex overflow-x-auto pb-6 2xl:pb-10 custom-scrollbar snap-x relative cursor-grab active:cursor-grabbing select-none">
                @foreach($groupedForecast as $date => $forecasts)
                <div class="flex flex-col border-r border-slate-100 relative pt-12 2xl:pt-20 shrink-0">
                    <div class="absolute top-0 left-0 w-full text-sm 2xl:text-2xl font-black text-slate-800 px-4 py-3 2xl:px-8 2xl:py-6 border-b border-slate-100">{{ $date }}</div>
                    <div class="flex">
                        @foreach($forecasts as $hf)
                        @php 
                            $dtl = getPrakiraanDetail($hf['weather']);
                            $kmh = round(($hf['ws'] ?? 0) * 1.852, 1);
                        @endphp
                        {{-- KUNCI 5: Lebarkan kotak per jam di layar besar (2xl:w-48) --}}
                        <div class="flex-none w-24 2xl:w-48 flex flex-col items-center text-center px-2 py-4 2xl:px-4 2xl:py-8">
                            <p class="text-sm 2xl:text-2xl font-bold text-slate-600 mb-4 2xl:mb-6">{{ \Carbon\Carbon::parse($hf['local_datetime'])->format('H:00') }}</p>
                            <div class="text-4xl 2xl:text-7xl mb-2 2xl:mb-6 {{ $dtl[2] }} pointer-events-none">{{ $dtl[1] }}</div>
                            <div class="h-10 2xl:h-16 flex items-center justify-center mt-2 mb-1 2xl:mt-4 2xl:mb-2 w-full">
                                <p class="text-[10px] 2xl:text-lg font-bold text-slate-500 leading-tight">{{ $dtl[0] }}</p>
                            </div>
                            <p class="text-2xl 2xl:text-5xl font-black text-slate-800 mt-2 2xl:mt-4">{{ $hf['t'] }}°</p>
                            <p class="text-xs 2xl:text-xl font-bold text-slate-400 mt-1 2xl:mt-2">{{ $hf['hu'] }}%</p>
                            <div class="h-12 2xl:h-20 w-px border-l border-dashed border-slate-200 my-4 2xl:my-8"></div>
                            <p class="text-sm 2xl:text-2xl font-black text-slate-800">{{ $kmh }} <span class="text-[9px] 2xl:text-sm text-slate-400">km/j</span></p>
                            <p class="text-[9px] 2xl:text-base font-bold text-slate-500 mt-1 2xl:mt-3">{{ getArahAngin($hf['wd']) }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
            {{-- Tampilan saat wilayah tidak ditemukan --}}
            <div class="w-full mx-auto bg-white rounded-3xl 2xl:rounded-[4rem] p-16 2xl:p-32 text-center shadow-sm border border-slate-100">
                <div class="text-6xl 2xl:text-9xl mb-4 2xl:mb-8">🔍</div>
                <h3 class="text-2xl 2xl:text-5xl font-black text-slate-800">Wilayah Tidak Ditemukan</h3>
            </div>
        @endif
    </div>
</section>

{{-- Styling & Script Autocomplete --}}
<style>
    .custom-scrollbar::-webkit-scrollbar { height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    
    // =======================================================================
    // 1. DATA RELASI KABUPATEN & KECAMATAN
    // =======================================================================
    const dataWilayah = {
        "Bulungan": [
            "Tanjung Selor, Bulungan", "Tanjung Palas, Bulungan", "Tanjung Palas Barat, Bulungan",
            "Tanjung Palas Utara, Bulungan", "Tanjung Palas Timur, Bulungan", "Tanjung Palas Tengah, Bulungan",
            "Bunyu, Bulungan", "Peso, Bulungan", "Peso Hilir (Ilir), Bulungan", "Sekatak, Bulungan"
        ],
        "Tarakan": [
            "Tarakan Barat, Tarakan", "Tarakan Tengah, Tarakan", "Tarakan Timur, Tarakan", "Tarakan Utara, Tarakan"
        ],
        "Malinau": [
            "Malinau Kota, Malinau", "Malinau Selatan, Malinau", "Malinau Selatan Hulu, Malinau",
            "Malinau Selatan Hilir, Malinau", "Malinau Utara, Malinau", "Malinau Barat, Malinau",
            "Bahau Hulu, Malinau", "Kayan Hilir, Malinau", "Kayan Hulu, Malinau", "Kayan Selatan, Malinau",
            "Mentarang, Malinau", "Mentarang Hulu, Malinau", "Pujungan, Malinau", "Sungai Boh, Malinau", "Sungai Tubu, Malinau"
        ],
        "Nunukan": [
            "Nunukan, Nunukan", "Nunukan Selatan, Nunukan", "Sebatik, Nunukan", "Sebatik Barat, Nunukan",
            "Sebatik Tengah, Nunukan", "Sebatik Utara, Nunukan", "Sebatik Timur, Nunukan", "Lumbis, Nunukan",
            "Lumbis Ogong, Nunukan", "Lumbis Pansiangan, Nunukan", "Lumbis Hulu, Nunukan", "Sebuku, Nunukan",
            "Sembakung, Nunukan", "Sembakung Atulai, Nunukan", "Sei Menggaris, Nunukan", "Krayan Selatan, Nunukan",
            "Krayan Tengah, Nunukan", "Krayan Timur, Nunukan", "Krayan Barat, Nunukan", "Krayan, Nunukan"
        ],
        "Tana Tidung": [
            "Sesayap, Tana Tidung", "Sesayap Hilir, Tana Tidung", "Tana Lia, Tana Tidung",
            "Betayau, Tana Tidung", "Muruk Rian, Tana Tidung"
        ]
    };

    const kabupatenSelect = document.getElementById('kabupatenSelect');
    const kecamatanSelect = document.getElementById('kecamatanSelect');
    const hiddenSearchInput = document.getElementById('hiddenSearchInput');
    const form = document.getElementById('dropdownSearchForm');

    function renderKecamatan(kabPilihan, selectedKec = '') {
        kecamatanSelect.innerHTML = '<option value="" class="text-slate-800">-- Pilih Kecamatan --</option>';

        if (kabPilihan && dataWilayah[kabPilihan]) {
            kecamatanSelect.disabled = false;
            dataWilayah[kabPilihan].forEach(function (kec) {
                let option = document.createElement('option');
                option.value = kec;
                option.className = 'text-slate-800';
                option.textContent = kec.split(',')[0];
                
                if (kec === selectedKec) {
                    option.selected = true;
                }
                
                kecamatanSelect.appendChild(option);
            });
        } else {
            kecamatanSelect.disabled = true;
        }
    }

    kabupatenSelect.addEventListener('change', function () {
        renderKecamatan(this.value);
    });

    form.addEventListener('submit', function (e) {
        if (!kecamatanSelect.value) {
            e.preventDefault();
            alert('Silakan pilih Kecamatan terlebih dahulu!');
            return;
        }
        hiddenSearchInput.value = kecamatanSelect.value;
    });

    const prevSearch = hiddenSearchInput.value;
    if (prevSearch) {
        let foundKab = null;
        for (const kab in dataWilayah) {
            if (dataWilayah[kab].includes(prevSearch)) {
                foundKab = kab;
                break;
            }
        }
        if (foundKab) {
            kabupatenSelect.value = foundKab;
            renderKecamatan(foundKab, prevSearch);
        }
    }

    // =======================================================================
    // 2. FITUR DRAG TO SCROLL (DESKTOP UX)
    // =======================================================================
    const slider = document.getElementById('scrollArea');
    if(slider) {
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
            e.preventDefault(); // Mencegah highlight text saat digeser
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; // Kecepatan scroll
            slider.scrollLeft = scrollLeft - walk;
        });
    }
});
</script>
@endsection