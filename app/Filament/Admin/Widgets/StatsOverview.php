<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use App\Models\Buletin;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita & Kegiatan', Berita::count())
                ->description('Publikasi aktif')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success'),
                
            Stat::make('Total Buletin Bulanan', Buletin::count())
                ->description('Arsip dokumen')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
        ];
    }
}