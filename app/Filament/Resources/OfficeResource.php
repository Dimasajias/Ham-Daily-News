<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeResource\Pages;
use App\Models\Office;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfficeResource extends Resource
{
    protected static ?string $model = Office::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Kanwil dan Wilker';

    protected static ?string $modelLabel = 'Kanwil dan Wilker';

    protected static ?string $pluralModelLabel = 'Kanwil dan Wilker';

    protected static ?string $navigationGroup = 'Administrasi';

    protected static ?int $navigationSort = 10;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Office::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('🏛️ Data Kanwil dan Wilker')
                ->description('Informasi dasar kanwil dan wilker.')
                ->icon('heroicon-o-building-office-2')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Kanwil')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Kanwil Aceh')
                        ->prefixIcon('heroicon-o-building-office')
                        ->columnSpan(2),

                    Forms\Components\TextInput::make('code')
                        ->label('Kode')
                        ->maxLength(10)
                        ->unique(ignoreRecord: true)
                        ->placeholder('Contoh: ACH')
                        ->prefixIcon('heroicon-o-hashtag')
                        ->columnSpan(1),

                    Forms\Components\TextInput::make('tempat_kedudukan')
                        ->label('Tempat Kedudukan')
                        ->placeholder('Contoh: Banda Aceh, Medan, dll.')
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-map-pin')
                        ->columnSpan(2),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kanwil dan Wilker')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-building-office-2')
                    ->description(fn (Office $record) => $record->tempat_kedudukan ? '📍 ' . $record->tempat_kedudukan : null),

                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->badge()
                    ->color('primary')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('users_count')
                    ->counts('users')
                    ->label('Jumlah Staff')
                    ->icon('heroicon-o-users')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('activities_count')
                    ->counts('activities')
                    ->label('Total Kegiatan')
                    ->icon('heroicon-o-newspaper')
                    ->alignCenter()
                    ->sortable(),
            ])
            ->striped()
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->tooltip('Edit Kanwil dan Wilker'),
            ])
            ->emptyStateHeading('Belum ada kanwil dan wilker')
            ->emptyStateDescription('Tambahkan kanwil dan wilker untuk mulai mengelola data.')
            ->emptyStateIcon('heroicon-o-building-office-2');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffices::route('/'),
            'create' => Pages\CreateOffice::route('/create'),
            'edit' => Pages\EditOffice::route('/{record}/edit'),
        ];
    }
}
