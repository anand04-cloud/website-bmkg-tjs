<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo-bmkg.png') }}" type="image/png">
    <title>Stasiun Meteorologi Kelas III Tanjung Harapan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 antialiased">
    <nav class="fixed w-full z-50 top-0 bg-white/80 backdrop-blur-md shadow-sm border-b border-blue-100">
        <div class="w-full mx-auto px-4 lg:px-8 xl:px-12 py-2 flex items-center justify-between">
            
            {{-- BAGIAN KIRI: LOGO --}}
            <div class="flex items-center space-x-2 md:space-x-3 shrink-0">
                <img src="{{ asset('img/logo-bmkg.png') }}" class="h-10 md:h-12">
                <div>
                    <span class="block font-bold text-blue-900 leading-none text-base md:text-lg">Stasiun Meteorologi</span>
                    <span class="text-[8px] md:text-[10px] text-gray-500 uppercase tracking-widest font-semibold">Tanjung Harapan, Bulungan</span>
                </div>
            </div>
            
            {{-- BAGIAN TENGAH KE KANAN: MENU NAVIGASI (DESKTOP SAJA) --}}
            <div class="hidden lg:flex items-center space-x-6 xl:space-x-10 font-bold text-gray-600 ml-auto mr-4 lg:mr-8">
                {{-- Beranda --}}
                <a href="/" class="pb-1 border-b-2 transition-all duration-300 {{ request()->is('/') ? 'text-blue-600 border-blue-600' : 'text-slate-600 border-transparent hover:text-blue-600' }}">Beranda</a>
                
                {{-- Profil --}}
                <a href="/profil/visi-misi" class="font-bold pb-1 border-b-2 transition-all duration-300 {{ request()->is('profil/*') ? 'text-blue-600 border-blue-600' : 'text-slate-600 border-transparent hover:text-blue-600' }}">Profil</a>

                {{-- Dropdown Menu Cuaca --}}
                <div class="relative group">
                    <button class="flex items-center space-x-1 font-bold focus:outline-none pb-1 border-b-2 transition-all duration-300 {{ request()->is('cuaca/*') ? 'text-blue-600 border-blue-600' : 'text-slate-600 border-transparent group-hover:text-blue-600' }}">
                        <span>Cuaca</span>
                        <svg class="w-4 h-4 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute left-1/2 -translate-x-1/2 top-full w-60 bg-white border border-slate-100 rounded-2xl shadow-xl p-2 opacity-0 scale-95 pointer-events-none group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto transition-all duration-300 z-50">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-2 w-4 h-4 bg-white border-t border-l border-slate-100 rotate-45"></div>
                        <div class="relative z-10 space-y-1">
                            <a href="/cuaca/peringatan-dini" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-amber-50 text-slate-700 hover:text-amber-700 transition">
                                <div class="bg-amber-100 p-2 rounded-lg text-amber-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>
                                <div>
                                    <p class="text-xs font-black leading-tight">Peringatan Dini</p>
                                    <p class="text-[9px] font-medium text-slate-400">Info potensi cuaca ekstrem</p>
                                </div>
                            </a>
                            <a href="/cuaca/prakiraan" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-blue-50 text-slate-700 hover:text-blue-700 transition">
                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg></div>
                                <div>
                                    <p class="text-xs font-black leading-tight">Prakiraan Cuaca</p>
                                    <p class="text-[9px] font-medium text-slate-400">Informasi cuaca lengkap per jam</p>
                                </div>
                            </a>
                            <a href="/cuaca/penerbangan" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-cyan-50 text-slate-700 hover:text-cyan-700 transition">
                                <div class="bg-cyan-100 p-2 rounded-lg text-cyan-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg></div>
                                <div>
                                    <p class="text-xs font-black leading-tight">Cuaca Penerbangan</p>
                                    <p class="text-[9px] font-medium text-slate-400">Data operasional & sigmet</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Dropdown Menu Gempa --}}
                <div class="relative group">
                    <button class="flex items-center space-x-1 font-bold focus:outline-none pb-1 border-b-2 transition-all duration-300 {{ request()->is('gempa/*') ? 'text-rose-600 border-rose-600' : 'text-slate-600 border-transparent group-hover:text-rose-600' }}">
                        <span>Gempa</span>
                        <svg class="w-4 h-4 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute left-1/2 -translate-x-1/2 top-full w-60 bg-white border border-slate-100 rounded-2xl shadow-xl p-2 opacity-0 scale-95 pointer-events-none group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto transition-all duration-300 z-50">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-2 w-4 h-4 bg-white border-t border-l border-slate-100 rotate-45"></div>
                        <div class="relative z-10 space-y-1">
                            <a href="/gempa/terkini" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-rose-50 text-slate-700 hover:text-rose-700 transition">
                                <div class="bg-rose-100 p-2 rounded-lg text-rose-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                                <div>
                                    <p class="text-xs font-black leading-tight">Gempa Terkini</p>
                                    <p class="text-[9px] font-medium text-slate-400">Parameter gempa bumi Terkini</p>
                                </div>
                            </a>
                            <a href="/gempa/dirasakan" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-orange-50 text-slate-700 hover:text-orange-700 transition group/item {{ request()->is('gempa/dirasakan') ? 'bg-orange-50' : '' }}">
                                <div class="bg-orange-100 p-2 rounded-lg text-orange-600 group-hover/item:bg-orange-500 group-hover/item:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black leading-tight">Gempa Dirasakan</p>
                                    <p class="text-[9px] font-medium text-slate-400 group-hover/item:text-orange-600/70">Parameter gempa yang dirasakan</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Dropdown Menu Iklim --}}
                <div class="relative group">
                    <button class="flex items-center space-x-1 font-bold focus:outline-none pb-1 border-b-2 transition-all duration-300 {{ request()->is('iklim/*') ? 'text-emerald-600 border-emerald-600' : 'text-slate-600 border-transparent group-hover:text-emerald-600' }}">
                        <span>Iklim</span>
                        <svg class="w-4 h-4 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute left-1/2 -translate-x-1/2 top-full w-64 bg-white border border-slate-100 rounded-2xl shadow-xl p-2 opacity-0 scale-95 pointer-events-none group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto transition-all duration-300 z-50">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-2 w-4 h-4 bg-white border-t border-l border-slate-100 rotate-45"></div>
                        <div class="relative z-10 space-y-1">
                            <a href="/iklim/kualitas-udara" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 transition">
                                <div class="bg-emerald-100 p-2 rounded-lg text-emerald-600 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black leading-tight">Kualitas Udara</p>
                                    <p class="text-[9px] font-medium text-slate-400 mt-0.5 line-clamp-1">Pemantauan AQI Indonesia</p>
                                </div>
                            </a>
                            
                            {{-- Menu Tambahan: Peta Iklim & HTH --}}
                            <a href="{{ route('iklim.peta') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 transition">
                                <div class="bg-emerald-100 p-2 rounded-lg text-emerald-600 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black leading-tight">Informasi Iklim & HTH</p>
                                    <p class="text-[9px] font-medium text-slate-400 mt-0.5 line-clamp-1">Prediksi & Analisis Spasial</p>
                                </div>
                            </a>
                            
                        </div>
                    </div>
                </div>

                {{-- Layanan --}}
                <a href="{{ route('layanan.index') }}" class="font-bold pb-1 border-b-2 transition-all duration-300 {{ request()->routeIs('layanan.index') ? 'text-cyan-600 border-cyan-600' : 'text-slate-600 border-transparent hover:text-cyan-600' }}">Layanan</a>
                
                {{-- Publikasi --}}
                <div class="relative group">
                    <button class="pb-1 border-b-2 transition-all duration-300 focus:outline-none flex items-center {{ request()->is('publikasi*') ? 'text-blue-600 border-blue-600 font-bold' : 'text-slate-600 border-transparent hover:text-blue-600' }}">
                        Publikasi <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 transform origin-top-left scale-95 group-hover:scale-100">
                        <div class="py-2 overflow-hidden rounded-xl">
                            <a href="{{ route('publikasi.berita') }}" class="block px-5 py-2.5 text-sm transition-colors {{ request()->routeIs('publikasi.berita') ? 'text-blue-600 bg-blue-50 font-bold border-l-4 border-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600 border-l-4 border-transparent' }}">Berita & Kegiatan</a>
                            <a href="{{ route('publikasi.buletin') }}" class="block px-5 py-2.5 text-sm transition-colors {{ request()->routeIs('publikasi.buletin') ? 'text-blue-600 bg-blue-50 font-bold border-l-4 border-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600 border-l-4 border-transparent' }}">Rak Buletin</a>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:flex items-center ml-2 pl-4 xl:pl-6 border-l border-slate-200">
                    @auth
                        {{-- Dropdown Dashboard --}}
                        <div class="relative group">
                            {{-- Tombol Pemicu (Trigger) --}}
                            <button class="bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold py-2 px-4 rounded-full transition-all flex items-center shadow-md focus:outline-none">
                                <span class="mr-1">⚙️</span> Dashboard
                                <svg class="w-3 h-3 ml-1.5 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            {{-- Isi Dropdown Menu --}}
                            <div class="absolute right-0 top-full mt-2 w-48 bg-white border border-slate-100 rounded-2xl shadow-xl p-2 opacity-0 scale-95 pointer-events-none group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto transition-all duration-300 z-50">
                                {{-- Segitiga panah kecil di atas kotak --}}
                                <div class="absolute -top-2 right-6 w-4 h-4 bg-white border-t border-l border-slate-100 rotate-45"></div>
                                
                                <div class="relative z-10 space-y-1">
                                    {{-- Link ke Panel Admin --}}
                                    <a href="{{ url('/admin') }}" class="flex items-center space-x-3 p-2.5 rounded-xl hover:bg-blue-50 text-slate-700 hover:text-blue-700 transition w-full text-left">
                                        <div class="bg-blue-100 p-1.5 rounded-lg text-blue-600 shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                        </div>
                                        <span class="text-xs font-black">Panel Admin</span>
                                    </a>
                                    
                                    {{-- Garis Pembatas --}}
                                    <div class="h-px bg-slate-100 my-1 mx-2"></div>

                                    {{-- Form Logout --}}
                                    <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="m-0 p-0 w-full">
                                        @csrf
                                        <button type="submit" class="flex items-center space-x-3 p-2.5 rounded-xl hover:bg-red-50 text-slate-700 hover:text-red-600 transition w-full text-left">
                                            <div class="bg-slate-100 p-1.5 rounded-lg text-slate-500 group-hover:bg-red-100 group-hover:text-red-600 shrink-0 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            </div>
                                            <span class="text-xs font-black">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Tombol Login --}}
                        <a href="{{ url('/admin/login') }}" class="text-slate-300 hover:text-cyan-600 p-2 rounded-full hover:bg-cyan-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4v-3l8.44-8.44A6 6 0 0115 7h.01z"></path></svg>
                        </a>
                    @endauth
                </div>
            </div>
            
            {{-- BAGIAN KANAN: JAM DIGITAL & TOMBOL MOBILE --}}
            <div class="flex items-center space-x-2 shrink-0 ml-auto lg:ml-0">
                {{-- Jam Digital --}}
                <div class="flex items-center bg-blue-900 text-white px-3 md:px-4 py-2 md:py-2.5 rounded-xl shadow-md border border-blue-800 cursor-default">
                    <span id="nav-clock-wita" class="text-[10px] md:text-xs font-black tracking-wider leading-none">--:--:-- WITA</span>
                    <span class="mx-2 md:mx-3 w-px h-3 md:h-4 bg-blue-700"></span>
                    <span id="nav-clock-utc" class="text-[8px] md:text-xs font-bold text-blue-300 tracking-widest uppercase leading-none">--:--:-- UTC</span>
                </div> 

                {{-- Tombol Hamburger (Khusus Mobile) --}}
                <button id="mobile-menu-btn" class="lg:hidden p-2 text-blue-900 bg-blue-50 hover:bg-blue-100 rounded-lg focus:outline-none transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>

        {{-- ======================================================== --}}
        {{-- DROPDOWN MENU KHUSUS MOBILE (Muncul saat tombol diklik)  --}}
        {{-- ======================================================== --}}
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-slate-100 shadow-xl absolute w-full left-0 top-full max-h-[80vh] overflow-y-auto">
            <div class="flex flex-col px-4 py-4 space-y-2">
                <a href="/" class="block px-4 py-3 text-sm font-bold text-blue-700 bg-blue-50 rounded-xl">Beranda</a>
                <a href="/profil/visi-misi" class="block px-4 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 rounded-xl">Profil</a>
                
                <div class="px-4 pt-3 pb-1 text-[10px] font-black text-slate-400 uppercase tracking-widest">Cuaca</div>
                <a href="/cuaca/peringatan-dini" class="block px-6 py-2.5 text-sm font-bold text-slate-600 hover:bg-amber-50 hover:text-amber-700 rounded-xl border-l-2 border-transparent hover:border-amber-500 transition">Peringatan Dini</a>
                <a href="/cuaca/prakiraan" class="block px-6 py-2.5 text-sm font-bold text-slate-600 hover:bg-blue-50 hover:text-blue-700 rounded-xl border-l-2 border-transparent hover:border-blue-500 transition">Prakiraan Cuaca</a>
                <a href="/cuaca/penerbangan" class="block px-6 py-2.5 text-sm font-bold text-slate-600 hover:bg-cyan-50 hover:text-cyan-700 rounded-xl border-l-2 border-transparent hover:border-cyan-500 transition">Cuaca Penerbangan</a>

                <div class="px-4 pt-3 pb-1 text-[10px] font-black text-slate-400 uppercase tracking-widest">Gempa</div>
                <a href="/gempa/terkini" class="block px-6 py-2.5 text-sm font-bold text-slate-600 hover:bg-rose-50 hover:text-rose-700 rounded-xl border-l-2 border-transparent hover:border-rose-500 transition">Gempa Terkini</a>

                <div class="px-4 pt-3 pb-1 text-[10px] font-black text-slate-400 uppercase tracking-widest">Iklim & Layanan</div>
                <a href="/iklim/kualitas-udara" class="block px-6 py-2.5 text-sm font-bold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl border-l-2 border-transparent hover:border-emerald-500 transition">Kualitas Udara</a>
                <a href="{{ route('layanan.index') }}" class="block px-6 py-2.5 text-sm font-bold text-slate-600 hover:bg-cyan-50 rounded-xl border-l-2 border-transparent hover:border-cyan-500 transition">Layanan Publik</a>

                <div class="px-4 pt-3 pb-1 text-[10px] font-black text-slate-400 uppercase tracking-widest">Publikasi</div>
                <a href="{{ route('publikasi.berita') }}" class="block px-6 py-2.5 text-sm font-bold text-slate-600 hover:bg-blue-50 rounded-xl border-l-2 border-transparent hover:border-blue-500 transition">Berita & Kegiatan</a>
                <a href="{{ route('publikasi.buletin') }}" class="block px-6 py-2.5 text-sm font-bold text-slate-600 hover:bg-blue-50 rounded-xl border-l-2 border-transparent hover:border-blue-500 transition">Rak Buletin</a>

                <div class="border-t border-slate-100 my-2 pt-2"></div>
                @auth
                    <a href="{{ url('/admin') }}" class="block px-4 py-3 text-sm font-bold text-white bg-slate-800 hover:bg-slate-900 rounded-xl text-center shadow-md transition">Masuk ke Dashboard</a>
                @else
                    <a href="{{ url('/admin/login') }}" class="block px-4 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 rounded-xl text-center border border-slate-200 transition">Login Internal Pegawai</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="w-full">
        @yield('content')
    </main>

<footer class="relative w-full bg-[#0B1121] text-slate-400 pt-16 pb-6 overflow-hidden">
    {{-- Garis Gradien Atas --}}
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-500 to-emerald-400"></div>
    
    {{-- Efek Glow Latar Belakang --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-32 bg-cyan-900/20 blur-[100px] pointer-events-none"></div>
    
    <div class="container mx-auto px-6 relative z-10 max-w-7xl">
        {{-- Main 4-Column Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-slate-800/80">
            
            {{-- Kolom 1: Profil Instansi & Sosmed (Paling Kiri - 4 Kolom) --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-white p-2 rounded-xl">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo BMKG" class="w-12 h-auto object-contain">
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white tracking-tight leading-none uppercase">
                            BMKG
                        </h3>
                        <p class="text-[10px] font-bold text-cyan-500 uppercase mt-1.5 tracking-widest">
                            STASIUN METEOROLOGI KELAS III TANJUNG HARAPAN, BULUNGAN
                        </p>
                    </div>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed font-medium pr-4">
                    Penyedia layanan informasi Meteorologi, Klimatologi, dan Geofisika yang cepat, tepat, akurat, luas, dan mudah dipahami untuk masyarakat Kalimantan Utara.
                </p>
                
                {{-- Ikon Sosial Media --}}
                <div class="flex items-center space-x-4 pt-2">
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-cyan-500 hover:text-white transition-all duration-300 hover:-translate-y-1 shadow-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-cyan-500 hover:text-white transition-all duration-300 hover:-translate-y-1 shadow-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Kolom 2: Link Terkait (Tengah Kiri - 2 Kolom) --}}
            <div class="lg:col-span-2 space-y-5">
                <h4 class="text-sm font-black text-white uppercase tracking-wider border-l-4 border-cyan-500 pl-3">
                    Tautan Cepat
                </h4>
                <ul class="space-y-3 text-sm font-medium">
                    <li><a href="https://www.bmkg.go.id" target="_blank" class="hover:text-cyan-400 hover:translate-x-1.5 inline-flex items-center transition-all duration-300"><span class="mr-2 text-cyan-600">▪</span> BMKG Pusat</a></li>
                    <li><a href="https://aviation.bmkg.go.id" target="_blank" class="hover:text-cyan-400 hover:translate-x-1.5 inline-flex items-center transition-all duration-300"><span class="mr-2 text-cyan-600">▪</span> Aviation BMKG</a></li>
                    <li><a href="https://maritim.bmkg.go.id" target="_blank" class="hover:text-cyan-400 hover:translate-x-1.5 inline-flex items-center transition-all duration-300"><span class="mr-2 text-cyan-600">▪</span> Maritim BMKG</a></li>
                    <li><a href="https://iklim.bmkg.go.id" target="_blank" class="hover:text-cyan-400 hover:translate-x-1.5 inline-flex items-center transition-all duration-300"><span class="mr-2 text-cyan-600">▪</span> Iklim BMKG</a></li>
                    <li><a href="https://inasiam.bmkg.go.id" target="_blank" class="hover:text-cyan-400 hover:translate-x-1.5 inline-flex items-center transition-all duration-300"><span class="mr-2 text-cyan-600">▪</span> Ina SAM</a></li>
                    <li><a href="https://inatews.bmkg.go.id" target="_blank" class="hover:text-cyan-400 hover:translate-x-1.5 inline-flex items-center transition-all duration-300"><span class="mr-2 text-cyan-600">▪</span> Ina TEWS</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Hubungi Kami (Tengah Kanan - 3 Kolom) --}}
            <div class="lg:col-span-3 space-y-5">
                <h4 class="text-sm font-black text-white uppercase tracking-wider border-l-4 border-cyan-500 pl-3">
                    Hubungi Kami
                </h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li class="flex items-start space-x-3 group">
                        <div class="p-2 bg-slate-800 rounded-lg group-hover:bg-cyan-500/20 transition-colors">
                            <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="text-slate-400 leading-relaxed mt-1">
                            Jl. Ulin No. 119, Tj. Selor Hilir, Kec. Tanjung Selor, Kab. Bulungan, Kalimantan Utara 77216
                        </span>
                    </li>
                    <li class="flex items-center space-x-3 group">
                        <div class="p-2 bg-slate-800 rounded-lg group-hover:bg-cyan-500/20 transition-colors">
                            <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <span class="text-slate-400 mt-1">+62 552 21306</span>
                    </li>
                    <li class="flex items-center space-x-3 group">
                        <div class="p-2 bg-slate-800 rounded-lg group-hover:bg-cyan-500/20 transition-colors">
                            <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-slate-400 mt-1 truncate">stamet.tanjungharapan@bmkg.go.id</span>
                    </li>
                </ul>
            </div>

            {{-- Kolom 4: Google Maps --}}
            <div class="lg:col-span-3 space-y-5">
                <h4 class="text-sm font-black text-white uppercase tracking-wider border-l-4 border-cyan-500 pl-3">
                    Lokasi Kantor
                </h4>
                <div class="w-full h-48 rounded-2xl overflow-hidden shadow-2xl border border-slate-700/50 relative group">
                    {{-- Overlay warna biru untuk map agar serasi, menghilang saat di-hover --}}
                    <div class="absolute inset-0 bg-cyan-900/20 pointer-events-none group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15939.689882560588!2d117.3640008!3d2.8387002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3213cfd3553670d5%3A0xd8745e9ccffd75ff!2sBMKG%20Tanjung%20Harapan!5e0!3m2!1sid!2sid!4v1779194684647!5m2!1sid!2sid" 
                        class="w-full h-full border-0 grayscale-[50%] group-hover:grayscale-0 transition-all duration-500" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>

        {{-- Bottom Copyright Section --}}
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 font-semibold tracking-wide">
            <p>© {{ date('Y') }} Stasiun Meteorologi Kelas III Tanjung Harapan.</p>
            <p class="mt-2 sm:mt-0">Dilindungi Hak Cipta.</p>
        </div>
    </div>
</footer>

</body>

{{-- SCRIPT PENGGERAK JAM DIGITAL --}}
<script>
    function updateNavClock() {
        const now = new Date();
        
        // Pengaturan format untuk waktu WITA (Asia/Makassar)
        const optionsWita = { timeZone: 'Asia/Makassar', hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' };
        // Pengaturan format untuk waktu UTC
        const optionsUtc = { timeZone: 'UTC', hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' };
        
        // Ambil waktu dan ganti titik menjadi titik dua (tergantung locale browser)
        const timeWita = now.toLocaleTimeString('id-ID', optionsWita).replace(/\./g, ':');
        const timeUtc = now.toLocaleTimeString('id-ID', optionsUtc).replace(/\./g, ':');
        
        // Suntikkan ke dalam elemen HTML
        document.getElementById('nav-clock-wita').innerText = timeWita + ' WITA';
        document.getElementById('nav-clock-utc').innerText = timeUtc + ' UTC';
    }

    // Jalankan fungsi pertama kali agar tidak ada jeda kosong
    updateNavClock();
    // Atur interval agar fungsi berjalan setiap 1000 milidetik (1 detik)
    setInterval(updateNavClock, 1000);

    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        // Toggle class 'hidden' untuk memunculkan/menyembunyikan menu
        menu.classList.toggle('hidden');
    });
</script>
</html>