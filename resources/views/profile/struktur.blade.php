@extends('layouts.app')

@section('content')
<div class="relative bg-[#0f172a] pt-32 pb-20 lg:pt-40 lg:pb-28 2xl:pt-52 2xl:pb-40 overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] 2xl:w-[1400px] h-[300px] 2xl:h-[500px] bg-blue-600/20 blur-[120px] rounded-full pointer-events-none"></div>
    
    {{-- KUNCI: Wrapper Hero dilebarkan --}}
    <div class="w-[98%] max-w-[2500px] mx-auto px-6 2xl:px-12 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl 2xl:text-[7rem] font-black text-white mb-4 2xl:mb-8 tracking-tight drop-shadow-md">
            Struktur <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Organisasi</span>
        </h1>
        <p class="text-slate-300 max-w-2xl 2xl:max-w-6xl mx-auto text-lg 2xl:text-3xl font-medium">
            Susunan pegawai dan bidang tugas di Stasiun Meteorologi Kelas III Tanjung Harapan
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
                        <li><a href="/profil/visi-misi" class="flex items-center space-x-3 2xl:space-x-4 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-all"><span>Visi, Misi, & Tujuan</span></a></li>
                        <li><a href="/profil/tugas-fungsi" class="flex items-center space-x-3 2xl:space-x-4 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition-all"><span>Tugas & Fungsi</span></a></li>
                        <li><a href="/profil/struktur" class="flex items-center space-x-3 2xl:space-x-4 px-4 py-3 2xl:px-6 2xl:py-5 rounded-2xl 2xl:rounded-3xl font-bold 2xl:text-2xl bg-blue-50 text-blue-600"><span class="w-2 h-2 2xl:w-3 2xl:h-3 rounded-full bg-blue-600"></span> <span>Struktur Organisasi</span></a></li>
                    </ul>
                </div>
            </div>

            {{-- KONTEN BAGAN ORGANISASI --}}
            <div class="w-full lg:w-3/4">
                <div class="bg-white rounded-3xl 2xl:rounded-[3rem] p-8 md:p-12 2xl:p-20 shadow-sm border border-slate-100 text-center overflow-hidden">
                    
                    {{-- 1. KEPALA STASIUN & TATA USAHA (Layout Cabang) --}}
                    <div class="flex flex-col items-center mb-6 2xl:mb-12"> 
                        
                        {{-- Card Kepala Stasiun --}}
                        <div class="flex flex-col items-center bg-gradient-to-br from-blue-600 to-cyan-500 p-1.5 2xl:p-2.5 rounded-3xl 2xl:rounded-[2.5rem] shadow-lg relative z-10 hover:scale-105 transition-transform">
                            <div class="bg-white p-6 2xl:p-10 rounded-2xl 2xl:rounded-[2rem] flex flex-col items-center w-64 2xl:w-96">
                                <img src="{{ asset('img/Kepala.jpeg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Abdul+Haris&background=0D8ABC&color=fff&size=128'" alt="Kepala Stasiun" class="w-24 h-24 2xl:w-40 2xl:h-40 rounded-full object-cover mb-4 2xl:mb-6 shadow-md border-4 border-blue-50">
                                <h4 class="font-black text-slate-800 text-sm 2xl:text-2xl">Abdul Haris Zulkarnaen, ST.</h4>
                                <p class="text-[10px] 2xl:text-sm font-bold text-blue-600 uppercase tracking-widest mt-1 2xl:mt-3">Kepala Stasiun</p>
                            </div>
                        </div>

                        {{-- Konektor Vertical Pertama --}}
                        <div class="w-1 2xl:w-2 h-10 2xl:h-16 bg-slate-200"></div>

                        {{-- Wadah Cabang (Splitter) --}}
                        <div class="flex flex-col md:flex-row w-full justify-center items-start relative">

                            {{-- Garis Cabang Horizontal ke TU (Khusus Desktop) --}}
                            <div class="hidden md:block absolute top-10 2xl:top-16 left-1/2 w-[160px] lg:w-[220px] 2xl:w-[350px] h-1 2xl:h-2 bg-slate-200"></div>
                            
                            {{-- Garis Vertical turun ke TU (Khusus Desktop) --}}
                            <div class="hidden md:block absolute top-0 2xl:top-0 left-[calc(50%+160px)] lg:left-[calc(50%+220px)] 2xl:left-[calc(50%+350px)] w-1 2xl:w-2 h-4 2xl:h-8 bg-slate-200"></div>

                            {{-- Lajur Tengah (Terus Ke Bawah Menuju Staf) --}}
                            <div class="flex flex-col items-center w-full md:w-auto relative z-10">
                                <div class="w-1 2xl:w-2 h-12 md:h-40 2xl:h-64 bg-slate-200"></div>
                                
                                {{-- Card Tata Usaha (Khusus Mode Mobile / HP) --}}
                                <div class="md:hidden bg-white p-5 rounded-2xl shadow-sm border border-slate-200 w-64 mb-2 hover:shadow-md transition-shadow">
                                    <div class="flex flex-col items-center">
                                        <img src="{{ asset('img/Riki.jpeg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Ricky+Oktavian&background=random&color=fff&size=128'" alt="Tata Usaha" class="w-16 h-16 rounded-full object-cover mb-3 shadow-sm border-2 border-slate-100">
                                        <h4 class="font-bold text-slate-800 text-sm">Ricky Oktavian, A.Md.</h4>
                                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">Tata Usaha</p>
                                    </div>
                                </div>
                                <div class="md:hidden w-1 h-12 bg-slate-200"></div>
                            </div>

                            {{-- Lajur Kanan: Card Tata Usaha (Khusus Desktop) --}}
                            <div class="hidden md:block absolute left-[calc(50%+160px)] lg:left-[calc(50%+220px)] 2xl:left-[calc(50%+350px)] -translate-x-1/2 z-10">
                                <div class="bg-white p-5 2xl:p-10 rounded-2xl 2xl:rounded-[2rem] shadow-sm border border-slate-200 w-56 2xl:w-80 hover:shadow-md transition-shadow">
                                    <div class="flex flex-col items-center">
                                        <img src="{{ asset('img/Riki.jpeg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Ricky+Oktavian&background=random&color=fff&size=128'" alt="Tata Usaha" class="w-16 h-16 2xl:w-32 2xl:h-32 rounded-full object-cover mb-3 2xl:mb-6 shadow-sm border-2 2xl:border-4 border-slate-100">
                                        <h4 class="font-bold text-slate-800 text-sm 2xl:text-2xl">Ricky Oktavian, A.Md.</h4>
                                        <p class="text-[10px] 2xl:text-sm font-bold text-slate-500 uppercase tracking-widest mt-1 2xl:mt-3">Tata Usaha</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Garis Pembatas --}}
                    <div class="w-full h-px 2xl:h-1 bg-slate-200 mb-12 2xl:mb-24 relative mt-4 md:mt-8 2xl:mt-16">
                        <div class="absolute left-1/2 -top-3 2xl:-top-5 -translate-x-1/2 bg-white px-4 2xl:px-8 text-xs 2xl:text-xl font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Tim Operasional & Teknis</div>
                    </div>

                    {{-- 2. SEMUA PEGAWAI (Digabung) --}}
                    @php
                        $pegawai = [
                            ['nama' => 'Agus Ariyanto', 'role' => 'Forecaster', 'foto' => 'Agus.jpeg'],
                            ['nama' => 'Khafidzo Rakhmah', 'role' => 'Forecaster', 'foto' => 'Afi.jpeg'],
                            ['nama' => 'Magdalena Sidauruk', 'role' => 'Forecaster', 'foto' => 'Lena_1.PNG'],
                            ['nama' => 'Sylvi Yulianti', 'role' => 'Forecaster', 'foto' => 'Sylvi.jpeg'],
                            ['nama' => 'Dewi Paramitha', 'role' => 'Forecaster', 'foto' => 'Dewi.jpeg'],
                            ['nama' => 'Zenia Ika Savitri', 'role' => 'Forecaster', 'foto' => 'Zenia.jpeg'],
                            ['nama' => 'Farid Hardiansyah', 'role' => 'Observer', 'foto' => 'Farid.jpg'],
                            ['nama' => 'Izza Nur Rahman', 'role' => 'Observer', 'foto' => 'Izza.png'],
                            ['nama' => 'Hafidz Irvan Rahmaddani', 'role' => 'Observer', 'foto' => 'Hafidz.jpeg'],
                            ['nama' => 'Aris Widiantoro', 'role' => 'Observer', 'foto' => 'Aris.jpeg'],
                            ['nama' => 'Cristianto Sihombing', 'role' => 'Observer', 'foto' => 'Cris.jpeg'],
                            ['nama' => 'Reski Salman', 'role' => 'Observer & Teknisi', 'foto' => 'Rezky.jpeg'],
                            ['nama' => 'Rivan Hikmawan', 'role' => 'Observer & Teknisi', 'foto' => 'Rivan.jpeg'],
                            ['nama' => 'Muhammad Zaki Lazuardi', 'role' => 'Observer & Teknisi', 'foto' => 'Zaki.jpeg'],
                            ['nama' => 'Febri Ananda', 'role' => 'Observer & Teknisi', 'foto' => 'Febri.jpeg'],
                            ['nama' => 'Dik Mulyono', 'role' => 'PPNPN', 'foto' => 'Dik.jpeg'],
                            ['nama' => 'Joko Kuncoro', 'role' => 'PPNPN', 'foto' => 'Joko.jpeg'],
                            ['nama' => 'Risna Lie', 'role' => 'PPNPN', 'foto' => 'Risna.jpeg'],
                        ];
                    @endphp

                    {{-- KUNCI: Kolom Grid ditambah jadi 5 khusus 2xl --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-4 2xl:gap-8">
                        @foreach($pegawai as $p)
                        <div class="bg-slate-50/50 p-4 3xl:p-8 rounded-2xl 2xl:rounded-3xl border border-slate-100 flex flex-col items-center hover:bg-blue-50/50 transition-colors group">
                            <img src="{{ asset('img/' . $p['foto']) }}" 
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($p['nama']) }}&background=random&color=fff&size=128'" 
                                 alt="{{ $p['nama'] }}" 
                                 class="w-16 h-16 2xl:w-32 2xl:h-32 rounded-full object-cover mb-3 2xl:mb-6 border-2 2xl:border-4 border-white shadow-sm group-hover:scale-110 transition-transform">
                            <h4 class="font-bold text-slate-700 text-xs 2xl:text-xl text-center leading-tight mb-1 2xl:mb-2">{{ $p['nama'] }}</h4>
                            <p class="text-[9px] 2xl:text-sm font-bold text-slate-400 uppercase text-center leading-tight">{{ $p['role'] }}</p>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection