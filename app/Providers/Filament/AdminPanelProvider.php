<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
// use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            ->brandName('BMKG Tanjung Harapan')
            ->brandLogo(asset('img/logo-bmkg.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('img/logo-bmkg.png'))
            ->colors([
                'primary' => Color::Blue,
            ])
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn (): string => Blade::render('
                    {{-- TOMBOL KEMBALI KE BERANDA (MENGGUNAKAN CSS CUSTOM AGAR AMAN) --}}
                    <a href="{{ url(\'/\') }}" class="btn-back-home">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Kembali ke Beranda</span>
                    </a>

                    <style>
                        /* STYLE TOMBOL KEMBALI CUSTOM */
                        .btn-back-home {
                            position: fixed !important;
                            top: 1.5rem !important;
                            left: 1.5rem !important;
                            z-index: 9999 !important;
                            display: flex !important;
                            align-items: center !important;
                            gap: 0.5rem !important;
                            padding: 0.6rem 1.25rem !important;
                            background: rgba(15, 23, 42, 0.6) !important;
                            backdrop-filter: blur(12px) !important;
                            color: #ffffff !important;
                            font-size: 0.875rem !important;
                            font-weight: bold !important;
                            border-radius: 9999px !important;
                            border: 1px solid rgba(255, 255, 255, 0.2) !important;
                            text-decoration: none !important;
                            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3) !important;
                            transition: all 0.3s ease !important;
                        }
                        .btn-back-home:hover {
                            background: rgba(15, 23, 42, 0.9) !important;
                        }
                        .btn-back-home svg {
                            transition: transform 0.3s ease !important;
                        }
                        .btn-back-home:hover svg {
                            transform: translateX(-4px) !important;
                        }

                        /* 1. Mengganti Background SELURUH HALAMAN (Luar Kotak) */
                        body {
                            background-image: 
                                linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.6)), 
                                url("'.asset('img/kantor.jpg').'") !important; 
                            background-size: cover !important;
                            background-position: center !important;
                            background-attachment: fixed !important;
                        }
                        
                        /* Memaksa warna abu-abu bawaan Filament agar tembus pandang */
                        .fi-simple-layout {
                            background: transparent !important;
                        }
                        
                        /* 2. Mengubah KOTAK LOGIN Menjadi Kaca (Glassmorphism) */
                        .fi-simple-main-content {
                            background: rgba(255, 255, 255, 0.85) !important;
                            backdrop-filter: blur(12px) !important;
                            border: 1px solid rgba(255, 255, 255, 0.6) !important;
                            border-radius: 1.5rem !important;
                            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
                        }

                        /* Menyesuaikan teks dan label agar tetap terbaca jelas */
                        .fi-simple-main-content label, 
                        .fi-simple-main-content h2 {
                            color: #1e293b !important;
                            font-weight: 800 !important;
                        }
                    </style>
                '),
            )
            // ==========================================
            ->navigationItems([
                NavigationItem::make('(CMS) BMKG Tanjung Harapan')
                    ->url('https://bmkgbulungan.id/cms/public/login')
                    ->openUrlInNewTab() // Membuka link di tab baru agar dashboard tidak tertutup
                    ->icon('heroicon-o-arrow-top-right-on-square') // Ikon panah keluar
                    ->sort(100), // Angka urutan besar agar berada paling bawah di sidebar
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\Filament\Admin\Resources')
            ->resources([
                \App\Filament\Resources\Beritas\BeritaResource::class,
                \App\Filament\Resources\Buletins\BuletinResource::class,
                \App\Filament\Resources\PetaIklims\PetaIklimResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\Filament\Admin\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\Filament\Admin\Widgets')
            ->widgets([
                AccountWidget::class,
                StatsOverview::class,
                // FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
