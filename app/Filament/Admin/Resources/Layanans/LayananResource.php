<?php

namespace App\Filament\Admin\Resources\Layanans;

use App\Filament\Admin\Resources\Layanans\Pages\CreateLayanan;
use App\Filament\Admin\Resources\Layanans\Pages\EditLayanan;
use App\Filament\Admin\Resources\Layanans\Pages\ListLayanans;

use App\Models\Layanan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables;

// Komponen Form
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    // Ikon koper agar cocok dengan tema "Layanan/Jasa"
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-briefcase'; 
    protected static ?string $navigationLabel = 'Layanan & Jasa';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Layanan')
                    ->required()
                    ->placeholder('Contoh: Permintaan Data Iklim')
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('harga')
                    ->label('Tarif Layanan (Rp)')
                    ->default('0')
                    ->prefix('Rp')
                    ->helperText('Contoh: 0, 175rb, atau 10rb - 50rb')
                    ->columnSpanFull(),

                TextInput::make('satuan_harga')
                    ->label('Satuan / Periode')
                    ->default('PENGAJUAN')
                    ->prefix('/')
                    ->placeholder('Contoh: / LOKASI / HARI')
                    ->helperText('Teks akan otomatis dikapitalisasi di halaman depan.')
                    ->columnSpanFull(),

                FileUpload::make('icon_image')
                    ->label('Ikon / Ilustrasi Layanan')
                    ->image()
                    ->disk('public') // Dijamin aman masuk folder public
                    ->directory('layanan-icons')
                    ->maxSize(1024),

                TextInput::make('gform_url')
                    ->label('Link Google Form')
                    ->url()
                    ->required()
                    ->placeholder('https://docs.google.com/forms/d/e/...')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(
                fn ($record): string => static::getUrl('edit', ['record' => $record]),
            )
            ->columns([
                Tables\Columns\ImageColumn::make('icon_image')
                    ->label('Ikon'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gform_url')
                    ->label('Link Form')
                    ->limit(30)
                    ->color('primary'),
            ])
            ->actions([
                // Kosongkan sementara karena kita pakai klik baris
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLayanans::route('/'),
            'create' => CreateLayanan::route('/create'),
            'edit' => EditLayanan::route('/{record}/edit'),
        ];
    }
}