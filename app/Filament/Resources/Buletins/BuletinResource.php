<?php

namespace App\Filament\Resources\Buletins;

use App\Filament\Resources\Buletins\Pages\CreateBuletin;
use App\Filament\Resources\Buletins\Pages\EditBuletin;
use App\Filament\Resources\Buletins\Pages\ListBuletins;

use App\Models\Buletin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables;

// Standard Filament Table Actions
// use Filament\Tables\Actions\Action;

// Komponen Form
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class BuletinResource extends Resource
{
    protected static ?string $model = Buletin::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Buletin Bulanan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Edisi Buletin')
                    ->placeholder('Contoh: Buletin Cuaca Bulanan Edisi Juni 2026')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('cover_image')
                    ->label('Sampul Depan (Cover)')
                    ->image()
                    ->disk('public')
                    ->directory('buletin-covers')
                    ->maxSize(2048),

                FileUpload::make('file_pdf')
                    ->label('Upload File Dokumen PDF')
                    ->required()
                    ->disk('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('buletin-files')
                    ->maxSize(10240),

                DatePicker::make('published_date')
                    ->label('Tanggal Rilis Dokumen')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl (
                fn ($record): string => static::getUrl('edit', ['record' => $record])
            )
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Cover'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Edisi Buletin')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_date')
                    ->label('Tanggal Rilis')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->actions([
                // Tombol Edit Custom (Bypass Anti-Error)
            //     Action::make('edit')
            //         ->label('Edit')
            //         ->icon('heroicon-m-pencil-square')
            //         ->color('warning')
            //         ->url(fn ($record): string => static::getUrl('edit', ['record' => $record])),

            //     // Tombol Delete Custom (Bypass Anti-Error)
            //     Action::make('delete')
            //         ->label('Delete')
            //         ->icon('heroicon-m-trash')
            //         ->color('danger')
            //         ->requiresConfirmation()
            //         ->action(fn ($record) => $record->delete()),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBuletins::route('/'),
            'create' => CreateBuletin::route('/create'),
            'edit' => EditBuletin::route('/{record}/edit'),
        ];
    }
}