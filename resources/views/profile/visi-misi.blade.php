@extends('layouts.app')

@section('content')

{{-- Tambahan CSS agar efek klik tombol meluncur ke bawah dengan mulus --}}
<style>
    html {
        scroll-behavior: smooth;
    }
</style>

{{-- HERO SECTION --}}
<div class="relative bg-[#0f172a] pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden flex items-center justify-center">
    {{-- Efek Cahaya --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] 2xl:w-[1200px] h-[300px] 2xl:h-[500px] bg-blue-600/20 blur-[120px] rounded-full pointer-events-none"></div>

    {{-- KUNCI PERBAIKAN: Buang 'container', gunakan w-[98%] max-w-[2500px] --}}
    <div class="w-[98%] max-w-[2500px] mx-auto text-center relative z-10 px-6 2xl:px-12">
        <div class="inline-flex items-center space-x-2 px-4 py-2 2xl:px-8 2xl:py-4 mb-8 2xl:mb-12 bg-white/10 backdrop-blur-md shadow-sm border border-white/20 rounded-full animate-fade-in">
            <span class="flex h-2 w-2 2xl:w-4 2xl:h-4 rounded-full bg-cyan-400 animate-pulse"></span>
            <span class="text-xs 2xl:text-xl font-bold tracking-widest text-white uppercase">Stasiun Meteorologi Kelas III Tanjung Harapan</span>
        </div>

        <h1 class="text-5xl md:text-7xl 2xl:text-[8rem] font-black text-white leading-tight mb-8 2xl:mb-14 drop-shadow-lg">
            Informasi Cuaca <br class="hidden md:block"> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">
                Terpercaya & Akurat
            </span>
        </h1>

        <div class="flex flex-wrap justify-center gap-6 2xl:gap-10 mb-12 2xl:mb-20 max-w-4xl 2xl:max-w-7xl mx-auto">
            @foreach(['Cepat', 'Tepat', 'Akurat', 'Luas', 'Mudah Dipahami'] as $jargon)
                <div class="flex items-center space-x-2 2xl:space-x-4 bg-white/10 backdrop-blur-md px-4 py-2 2xl:px-8 2xl:py-4 rounded-xl 2xl:rounded-2xl border border-white/20 shadow-sm">
                    <div class="bg-blue-500 rounded-full p-1 2xl:p-2">
                        <svg class="w-3 h-3 2xl:w-6 2xl:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-sm 2xl:text-2xl font-bold text-white">{{ $jargon }}</span>
                </div>
            @endforeach
        </div>

        <div class="flex justify-center">
            <a href="#konten-profil" class="bg-white text-slate-800 border border-slate-200 px-10 py-4 2xl:px-16 2xl:py-6 rounded-2xl 2xl:rounded-[2rem] font-bold 2xl:text-2xl hover:bg-cyan-50 hover:text-cyan-700 transition-all shadow-lg transform hover:-translate-y-1">
                Jelajahi Profil Kami
            </a>
        </div>
    </div>
</div>

<div id="konten-profil" class="w-full bg-[#f8fafc] py-16 2xl:py-24 min-h-screen scroll-mt-20">
    {{-- KUNCI PERBAIKAN: Buang 'container' & 'max-w-7xl', gunakan w-[98%] max-w-[2500px] --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12">
        
        <div class="flex flex-col lg:flex-row gap-12 2xl:gap-20 items-start">
            
            {{-- SIDEBAR --}}
            <div class="w-full lg:w-1/4 lg:sticky lg:top-28 2xl:top-36 z-20">
                <div class="bg-white rounded-3xl 2xl:rounded-[2.5rem] p-6 2xl:p-10 shadow-sm border border-slate-100">
                    <ul class="space-y-2 2xl:space-y-4 flex flex-col">
                        <li><a href="/profil/visi-misi" class="flex items-center space-x-3 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl bg-blue-50 text-blue-600"><span class="w-2 h-2 2xl:w-3 2xl:h-3 rounded-full bg-blue-600"></span> <span>Visi, Misi, & Tujuan</span></a></li>
                        <li><a href="/profil/tugas-fungsi" class="flex items-center space-x-3 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-all"><span>Tugas & Fungsi</span></a></li>
                        <li><a href="/profil/struktur" class="flex items-center space-x-3 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-all"><span>Struktur Organisasi</span></a></li>
                    </ul>
                </div>
            </div>

            {{-- KONTEN UTAMA --}}
            <div class="w-full lg:w-3/4 space-y-10 2xl:space-y-16">
                
                {{-- BAGIAN VISI --}}
                <div>
                    <div class="mb-6 2xl:mb-10">
                        <h2 class="text-3xl 2xl:text-6xl font-black text-slate-800 tracking-tight">Visi BMKG</h2>
                        <div class="w-20 2xl:w-32 h-1.5 2xl:h-2.5 bg-blue-600 mt-3 2xl:mt-5 rounded-full"></div>
                    </div>

                    {{-- Visi Utama --}}
                    <div class="bg-gradient-to-br from-blue-600 to-cyan-500 rounded-3xl 2xl:rounded-[3rem] p-8 md:p-10 2xl:p-16 text-white shadow-xl mb-6 2xl:mb-10 relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 text-white/10">
                            <svg class="w-48 h-48 2xl:w-96 2xl:h-96" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.714 2.131-8.609 7.983-8.609h.983v6.6h-1.121c-2.45 0-3.379 1.144-3.379 3.429v1.971h4.517l-.872 4h-3.611v11h-4.5zm-14 0v-7.391c0-5.714 2.131-8.609 7.982-8.609h.983v6.6h-1.121c-2.45 0-3.379 1.144-3.379 3.429v1.971h4.517l-.872 4h-3.611v11h-4.5z"/></svg>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-sm 2xl:text-2xl font-bold uppercase tracking-widest text-cyan-200 mb-4 2xl:mb-8">Visi BMKG 2025-2030</h3>
                            <p class="text-xl md:text-2xl 2xl:text-5xl font-black leading-snug 2xl:leading-snug">
                                "BMKG yang berkelas dunia dengan spirit socio-entrepreneur untuk mewujudkan Indonesia Maju yang Berdaulat, Mandiri, dan berkepribadian berlandaskan Gotong-Royong."
                            </p>
                        </div>
                    </div>

                    {{-- Penjelasan Terminologi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 2xl:gap-10">
                        <div class="bg-white rounded-3xl 2xl:rounded-[2.5rem] p-6 2xl:p-10 border border-slate-100 shadow-sm hover:-translate-y-1 transition-transform">
                            <div class="flex items-center space-x-3 2xl:space-x-6 mb-4 2xl:mb-6">
                                <div class="p-3 2xl:p-5 bg-blue-50 text-blue-600 rounded-2xl 2xl:rounded-3xl">
                                    <svg class="w-6 h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h4 class="font-bold text-slate-800 text-lg 2xl:text-3xl">Kelas Dunia</h4>
                            </div>
                            <p class="text-sm 2xl:text-2xl text-slate-600 font-medium leading-relaxed 2xl:leading-relaxed">
                                BMKG menjadi rujukan tingkat regional dan global. Informasi BMKG menjadi rujukan masyarakat internasional, SDM BMKG berperan aktif dalam organisasi MKG Internasional dan menjadi <i>Regional Modelling Centre</i>.
                            </p>
                        </div>
                        <div class="bg-white rounded-3xl 2xl:rounded-[2.5rem] p-6 2xl:p-10 border border-slate-100 shadow-sm hover:-translate-y-1 transition-transform">
                            <div class="flex items-center space-x-3 2xl:space-x-6 mb-4 2xl:mb-6">
                                <div class="p-3 2xl:p-5 bg-cyan-50 text-cyan-600 rounded-2xl 2xl:rounded-3xl">
                                    <svg class="w-6 h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <h4 class="font-bold text-slate-800 text-lg 2xl:text-3xl">Socio-Entrepreneur</h4>
                            </div>
                            <p class="text-sm 2xl:text-2xl text-slate-600 font-medium leading-relaxed 2xl:leading-relaxed">
                                Menjalankan bisnis pelayanan MKG tidak hanya untuk publik dan sektor (transportasi, pariwisata, pertahanan, pertanian, SDA, dll), namun juga memproduksi informasi premium untuk kesejahteraan masyarakat menuju penguatan kemandirian keuangan BMKG.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- BAGIAN MISI --}}
                <div>
                    <div class="mb-6 2xl:mb-10">
                        <h2 class="text-3xl 2xl:text-6xl font-black text-slate-800 tracking-tight leading-none">Misi BMKG</h2>
                        <div class="w-20 2xl:w-32 h-1.5 2xl:h-2.5 bg-blue-600 mt-3 2xl:mt-5 rounded-full mb-3"></div>
                    </div>
                    <div class="bg-white rounded-3xl 2xl:rounded-[3rem] p-6 md:p-8 2xl:p-16 shadow-sm border border-slate-100">
                        <p class="text-slate-500 font-medium text-base 2xl:text-3xl leading-relaxed 2xl:leading-relaxed mb-6 2xl:mb-10">
                            BMKG melaksanakan misi Presiden dan Wakil Presiden Nomor 1 (Peningkatan Kualitas Manusia Indonesia), Nomor 4 (Mencapai Lingkungan Hidup yang Berkelanjutan), dan Nomor 7 (Perlindungan bagi Segenap Bangsa dan Memberikan Rasa Aman), dengan uraian:
                        </p>
                        <ul class="space-y-5 2xl:space-y-8">
                            <li class="flex items-start space-x-4 2xl:space-x-8">
                                <div class="w-10 h-10 2xl:w-16 2xl:h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-black 2xl:text-3xl shrink-0">1</div>
                                <p class="text-slate-700 font-medium text-base 2xl:text-3xl leading-relaxed 2xl:leading-relaxed pt-1.5 2xl:pt-3">Menjadikan informasi BMKG sebagai rujukan masyarakat internasional dan mewujudkan <i>Regional Modelling Centre</i>.</p>
                            </li>
                            <li class="flex items-start space-x-4 2xl:space-x-8">
                                <div class="w-10 h-10 2xl:w-16 2xl:h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-black 2xl:text-3xl shrink-0">2</div>
                                <p class="text-slate-700 font-medium text-base 2xl:text-3xl leading-relaxed 2xl:leading-relaxed pt-1.5 2xl:pt-3">Mendorong SDM BMKG berperan aktif dalam organisasi MKG Internasional.</p>
                            </li>
                            <li class="flex items-start space-x-4 2xl:space-x-8">
                                <div class="w-10 h-10 2xl:w-16 2xl:h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-black 2xl:text-3xl shrink-0">3</div>
                                <p class="text-slate-700 font-medium text-base 2xl:text-3xl leading-relaxed 2xl:leading-relaxed pt-1.5 2xl:pt-3">Mewujudkan sebagian unit layanan jasa dan informasi BMKG menjadi unit Badan Layanan Umum (BLU).</p>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- BAGIAN TUJUAN --}}
                <div>
                    <div class="mb-6 2xl:mb-10">
                        <h2 class="text-3xl 2xl:text-6xl font-black text-slate-800 tracking-tight">Tujuan Strategis</h2>
                        <div class="w-20 2xl:w-32 h-1.5 2xl:h-2.5 bg-blue-600 mt-3 2xl:mt-5 rounded-full"></div>
                    </div>
                    <div class="bg-white rounded-3xl 2xl:rounded-[3rem] p-6 md:p-8 2xl:p-16 shadow-sm border border-slate-100 relative overflow-hidden">
                        {{-- Dekorasi air mark --}}
                        <div class="absolute -bottom-10 -right-10 text-slate-50 opacity-50 pointer-events-none">
                            <svg class="w-64 h-64 2xl:w-96 2xl:h-96" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                        </div>
                        <div class="relative z-10">
                            <p class="text-slate-500 font-medium text-base 2xl:text-3xl leading-relaxed 2xl:leading-relaxed mb-8 2xl:mb-12">
                                Penjabaran dan implementasi dari pernyataan misi yang akan dicapai untuk merealisasikan visi BMKG 2025-2030:
                            </p>
                            <ul class="space-y-6 2xl:space-y-10">
                                <li class="flex items-start">
                                    <span class="text-cyan-500 mr-4 2xl:mr-8 mt-1 2xl:mt-2"><svg class="w-6 h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                                    <p class="text-slate-700 font-medium text-base 2xl:text-3xl leading-relaxed 2xl:leading-relaxed">Menjamin terselenggaranya pelayanan informasi dan jasa meteorologi, klimatologi, kualitas udara, dan geofisika yang cepat, tepat, akurat, luas cakupan dan mudah dipahami untuk keselamatan, kesejahteraan, ketahanan dan berkelanjutan yang menjadi rujukan masyarakat internasional.</p>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyan-500 mr-4 2xl:mr-8 mt-1 2xl:mt-2"><svg class="w-6 h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                                    <p class="text-slate-700 font-medium text-base 2xl:text-3xl leading-relaxed 2xl:leading-relaxed">Terwujudnya ketangguhan ekonomi dan masyarakat terhadap faktor MKG.</p>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyan-500 mr-4 2xl:mr-8 mt-1 2xl:mt-2"><svg class="w-6 h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                                    <p class="text-slate-700 font-medium text-base 2xl:text-3xl leading-relaxed 2xl:leading-relaxed">Terwujudnya lembaga dengan tata kelola yang transparan, bersih, akuntabel dan berkualitas, serta mampu mewujudkan layanan premium menuju penguatan kemandirian keuangan BMKG.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            
        {{-- PENUTUP FLEXBOX --}}
        </div>

    </div>
</div>
@endsection