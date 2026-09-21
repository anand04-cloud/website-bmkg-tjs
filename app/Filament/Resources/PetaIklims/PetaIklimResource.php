<?php

namespace App\Filament\Resources\PetaIklims;

use App\Filament\Resources\PetaIklims\Pages\CreatePetaIklim;
use App\Filament\Resources\PetaIklims\Pages\EditPetaIklim;
use App\Filament\Resources\PetaIklims\Pages\ListPetaIklims;
use App\Models\PetaIklim;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PetaIklimResource extends Resource
{
    protected static ?string $model = PetaIklim::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori')
                    ->label('Jenis Peta Iklim')
                    ->options([
                        'prediksi_ch_dasarian'   => 'Prediksi Curah Hujan Dasarian',
                        'prediksi_ch_bulanan'    => 'Prediksi Curah Hujan Bulanan',
                        'prediksi_sifat_bulanan' => 'Prediksi Sifat Hujan Bulanan',
                        'monitoring_hth'         => 'Monitoring Hari Tanpa Hujan',
                        'analisis_ch_dasarian'   => 'Analisis Curah Hujan Dasarian',
                        'analisis_ch_bulanan'    => 'Analisis Curah Hujan Bulanan',
                        'analisis_sifat_bulanan' => 'Analisis Sifat Hujan Bulanan',
                    ])
                    ->required(),
                TextInput::make('periode')
                    ->label('Periode (Contoh: Dasarian I - Agustus 2026)')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('gambar')
                    ->label('Upload Peta')
                    ->image()
                    ->disk('public')
                    ->directory('peta-iklim')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('keterangan')
                    ->label('Keterangan / Analisis Singkat (Opsional)')
                    ->placeholder('Ketikkan narasi penjelasan peta di sini...')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')->label('Peta'),
                TextColumn::make('kategori')->label('Jenis Peta')->sortable()->searchable(),
                TextColumn::make('periode')->label('Periode'),
                TextColumn::make('created_at')->label('Diupload Pada')->dateTime('d M Y, H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPetaIklims::route('/'),
            'create' => CreatePetaIklim::route('/create'),
            'edit' => EditPetaIklim::route('/{record}/edit'),
        ];
    }
}