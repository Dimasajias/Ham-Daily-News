<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pengguna';

    protected static ?string $modelLabel = 'Pengguna';

    protected static ?string $pluralModelLabel = 'Pengguna';

    protected static ?string $navigationGroup = 'Administrasi';

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'name';

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) User::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('👤 Informasi Pengguna')
                ->description('Data akun pengguna sistem.')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Ahmad Susanto')
                        ->prefixIcon('heroicon-o-user'),

                    Forms\Components\TextInput::make('email')
                        ->label('Alamat Email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->placeholder('contoh@kemenham.go.id')
                        ->prefixIcon('heroicon-o-envelope'),

                    Forms\Components\TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context) => $context === 'create')
                        ->prefixIcon('heroicon-o-lock-closed')
                        ->helperText('Kosongkan jika tidak ingin mengubah password.'),

                    Forms\Components\Select::make('office_id')
                        ->label('Kantor Wilayah')
                        ->relationship('office', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->prefixIcon('heroicon-o-building-office')
                        ->placeholder('Pilih Kanwil...'),

                    Forms\Components\Select::make('roles')
                        ->label('Role Akses')
                        ->relationship('roles', 'name')
                        ->multiple()
                        ->preload()
                        ->required()
                        ->helperText('Admin: akses penuh. Regional: akses terbatas.')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (User $record) => $record->email),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'admin' => 'danger',
                        'regional' => 'info',
                        default => 'gray',
                    })
                    ->icon(fn (string $state) => match ($state) {
                        'admin' => 'heroicon-o-shield-check',
                        'regional' => 'heroicon-o-map',
                        default => 'heroicon-o-user',
                    })
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('office.name')
                    ->label('Kantor Wilayah')
                    ->icon('heroicon-o-building-office-2')
                    ->sortable()
                    ->placeholder('— Pusat —'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->since()
                    ->tooltip(fn (User $record) => $record->created_at?->format('d M Y H:i:s')),
            ])
            ->striped()
            ->deferLoading()
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->tooltip('Edit Pengguna'),
            ])
            ->emptyStateHeading('Belum ada pengguna')
            ->emptyStateDescription('Tambahkan pengguna baru untuk mulai mengelola akses.')
            ->emptyStateIcon('heroicon-o-user-group');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
