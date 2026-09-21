@extends('layouts.app')

@section('content')
<div class="relative bg-[#0f172a] pt-32 pb-20 lg:pt-40 lg:pb-28 2xl:pt-52 2xl:pb-40 overflow-hidden">
    {{-- Efek Cahaya --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] 2xl:w-[1400px] h-[300px] 2xl:h-[500px] bg-blue-600/20 blur-[120px] rounded-full pointer-events-none"></div>
    
    {{-- KUNCI: Wrapper Hero dilebarkan --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl 2xl:text-[7rem] font-black text-white mb-4 2xl:mb-8 tracking-tight drop-shadow-md">
            Tugas & <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Fungsi</span>
        </h1>
        <p class="text-slate-300 max-w-2xl 2xl:max-w-6xl mx-auto text-lg 2xl:text-3xl font-medium">
            Tanggung jawab pokok Stasiun Meteorologi Kelas III Tanjung Harapan
        </p>
    </div>
</div>

<div class="w-full bg-[#f8fafc] py-16 2xl:py-24 min-h-screen">
    {{-- KUNCI: Wrapper Konten Utama dilebarkan --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12">
        <div class="flex flex-col lg:flex-row gap-12 2xl:gap-20 items-start">
            
            {{-- SIDEBAR --}}
            <div class="w-full lg:w-1/4 lg:sticky lg:top-28 2xl:top-36 z-20">
                <div class="bg-white rounded-3xl 2xl:rounded-[2.5rem] p-6 2xl:p-10 shadow-sm border border-slate-100">
                    <ul class="space-y-2 2xl:space-y-4 flex flex-col">
                        <li><a href="/profil/visi-misi" class="flex items-center space-x-3 2xl:space-x-4 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-all"><span>Visi & Misi</span></a></li>
                        <li><a href="/profil/tugas-fungsi" class="flex items-center space-x-3 2xl:space-x-4 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl bg-blue-50 text-blue-600"><span class="w-2 h-2 2xl:w-3 2xl:h-3 rounded-full bg-blue-600"></span> <span>Tugas & Fungsi</span></a></li>
                        <li><a href="/profil/struktur" class="flex items-center space-x-3 2xl:space-x-4 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-all"><span>Struktur Organisasi</span></a></li>
                    </ul>
                </div>
            </div>

            {{-- KONTEN UTAMA --}}
            <div class="w-full lg:w-3/4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 2xl:gap-12">
                    
                    {{-- KOTAK TUGAS POKOK --}}
                    <div class="bg-white rounded-3xl 2xl:rounded-[3rem] p-8 2xl:p-12 border border-slate-100 shadow-sm">
                        <div class="w-12 h-12 2xl:w-20 2xl:h-20 bg-cyan-100 text-cyan-600 rounded-2xl 2xl:rounded-[1.5rem] flex items-center justify-center mb-6 2xl:mb-8">
                            <svg class="w-6 h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-xl 2xl:text-4xl font-black text-slate-800 mb-4 2xl:mb-6">Tugas Pokok</h3>
                        <p class="text-slate-600 leading-relaxed 2xl:leading-relaxed font-medium 2xl:text-2xl">
                            Melaksanakan kegiatan operasional Pengamatan, pengelolaan data, pelayanan informasi dan jasa, kerja sama, serta pemeliharaan peralatan meteorologi.
                        </p>
                    </div>

                    {{-- KOTAK FUNGSI UTAMA --}}
                    <div class="bg-white rounded-3xl 2xl:rounded-[3rem] p-8 2xl:p-12 border border-slate-100 shadow-sm">
                        <div class="w-12 h-12 2xl:w-20 2xl:h-20 bg-blue-100 text-blue-600 rounded-2xl 2xl:rounded-[1.5rem] flex items-center justify-center mb-6 2xl:mb-8">
                            <svg class="w-6 h-6 2xl:w-10 2xl:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        </div>
                        <h3 class="text-xl 2xl:text-4xl font-black text-slate-800 mb-4 2xl:mb-8">Fungsi Utama</h3>
                        
                        {{-- List dengan padding dan margin disesuaikan untuk layar raksasa --}}
                        <ul class="space-y-3 2xl:space-y-6 text-slate-600 font-medium 2xl:text-2xl leading-relaxed">
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-3 2xl:mr-4 2xl:text-2xl mt-1">✔</span> 
                                <span>Penyusunan rencana, program, anggaran, pemantauan dan evaluasi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-3 2xl:mr-4 2xl:text-2xl mt-1">✔</span> 
                                <span>Pelaksanaan Pengamatan meteorologi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-3 2xl:mr-4 2xl:text-2xl mt-1">✔</span> 
                                <span>Pelaksanaan Pengelolaan data meteorologi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-3 2xl:mr-4 2xl:text-2xl mt-1">✔</span> 
                                <span>Pelaksanaan pelayanan informasi dan jasa meteorologi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-3 2xl:mr-4 2xl:text-2xl mt-1">✔</span> 
                                <span>Pelaksanaan pemeliharaan peralatan utama dan peralatan pendukung operasional meteorologi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-3 2xl:mr-4 2xl:text-2xl mt-1">✔</span> 
                                <span>Pelaksanaan koordinasi/kerja sama</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-3 2xl:mr-4 2xl:text-2xl mt-1">✔</span> 
                                <span>Pelaksanaan urusan sumber daya manusia, keuangan, tata laksana, hubungan masyarakat, pengelolaan barang milik negara, persuratan, kearsipan, pelaporan, dan rumah tangga</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection