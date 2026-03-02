<?php

namespace App\Filament\Resources;

use App\Enums\ActivityStatus;
use App\Enums\Platform;
use App\Enums\Unit;
use App\Filament\Resources\ActivityResource\Pages;
use App\Jobs\ScrapeActivityJob;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Kegiatan';

    protected static ?string $modelLabel = 'Kegiatan';

    protected static ?string $pluralModelLabel = 'Kegiatan';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'extracted_title';

    public static function getNavigationBadge(): ?string
    {
        $user = auth()->user();
        $query = Activity::where('status', ActivityStatus::Pending);

        if ($user && $user->hasRole('regional')) {
            $query->where('user_id', $user->id);
        }

        $pending = $query->count();
        return $pending > 0 ? (string) $pending : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('📝 Informasi Publikasi')
                    ->description(new HtmlString('Isi data kegiatan yang akan diterbitkan. <span style="color: #E11D48; font-weight: 600;">⏰ Batas waktu submit: pukul 16:00 waktu setempat.</span>'))
                    ->icon('heroicon-o-document-text')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('extracted_title')
                            ->label('Judul Kegiatan')
                            ->required()
                            ->maxLength(500)
                            ->placeholder('Contoh: Sosialisasi HAM di Kelurahan Menteng')
                            ->helperText('Masukkan judul yang jelas dan deskriptif.')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi / Keterangan')
                            ->placeholder('Tuliskan deskripsi atau keterangan kegiatan...')
                            ->helperText('Opsional. Tambahkan detail kegiatan yang ingin ditampilkan.')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('social_media_url')
                            ->label('Link Media Sosial')
                            ->required()
                            ->url()
                            ->placeholder('https://www.instagram.com/p/...')
                            ->helperText('Tempel URL Instagram, TikTok, YouTube, dsb.')
                            ->prefixIcon('heroicon-o-link')
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\FileUpload::make('foto_dokumentasi')
                                    ->label('📷 Foto Dokumentasi')
                                    ->required()
                                    ->image()
                                    ->directory('dokumentasi')
                                    ->imageEditor()
                                    ->maxSize(5120)
                                    ->helperText('Upload foto (maks 5MB). Akan dikompres otomatis.')
                                    ->columnSpan(2),

                                Forms\Components\Select::make('unit')
                                    ->label('Unit Kerja')
                                    ->options(Unit::class)
                                    ->placeholder('Pilih Unit...')
                                    ->prefixIcon('heroicon-o-building-office')
                                    ->columnSpan(1),
                            ]),
                    ]),

                Forms\Components\Section::make('🔍 Konten Terdeteksi')
                    ->description('Konten berikut diekstrak otomatis dari URL. Anda dapat mengedit jika diperlukan.')
                    ->icon('heroicon-o-magnifying-glass')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\Select::make('platform')
                            ->label('Platform')
                            ->options(Platform::class)
                            ->disabled()
                            ->dehydrated()
                            ->prefixIcon('heroicon-o-globe-alt'),

                        Forms\Components\Textarea::make('extracted_title')
                            ->label('Judul / Caption')
                            ->rows(3),

                        Forms\Components\TextInput::make('extracted_image')
                            ->label('URL Gambar')
                            ->url()
                            ->prefixIcon('heroicon-o-photo'),

                        Forms\Components\Select::make('status')
                            ->options(ActivityStatus::class)
                            ->disabled()
                            ->dehydrated()
                            ->default(ActivityStatus::Draft)
                            ->prefixIcon('heroicon-o-flag'),
                    ])
                    ->visible(fn (?Activity $record) => $record !== null)
                    ->columns(2),

                Forms\Components\Section::make('❌ Review')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->schema([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->disabled()
                            ->rows(3),
                    ])
                    ->visible(fn (?Activity $record) => $record?->status === ActivityStatus::Rejected),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = auth()->user();
        $isAdmin = $user?->hasRole('admin');

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('#')
                    ->rowIndex()
                    ->alignCenter()
                    ->width('60px'),

                Tables\Columns\TextColumn::make('extracted_title')
                    ->label('Judul Kegiatan')
                    ->limit(70)
                    ->searchable()
                    ->wrap()
                    ->weight('medium')
                    ->description(fn (Activity $record) => $record->office?->name ?? '-'),

                Tables\Columns\TextColumn::make('platform')
                    ->badge()
                    ->color(fn (Platform $state): string => match ($state) {
                        Platform::Instagram => 'danger',
                        Platform::Twitter => 'gray',
                        Platform::TikTok => 'gray',
                        Platform::YouTube => 'danger',
                        Platform::Facebook => 'info',
                        default => 'primary',
                    })
                    ->formatStateUsing(fn (Platform $state) => $state->icon() . ' ' . $state->label())
                    ->alignCenter(),



                Tables\Columns\TextColumn::make('unit')
                    ->label('Unit')
                    ->badge()
                    ->color('gray')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelapor')
                    ->icon('heroicon-o-user')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (ActivityStatus $state): string => match ($state) {
                        ActivityStatus::Draft => 'gray',
                        ActivityStatus::Pending => 'warning',
                        ActivityStatus::Approved => 'success',
                        ActivityStatus::Rejected => 'danger',
                    })
                    ->icon(fn (ActivityStatus $state) => $state->icon())
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Disubmit')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since()
                    ->tooltip(fn (Activity $record) => $record->created_at?->format('d M Y H:i:s')),

                Tables\Columns\TextColumn::make('approved_at')
                    ->label('Direview')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('—'),
            ])
            ->striped()
            ->deferLoading()
            ->groups([
                Tables\Grouping\Group::make('status')
                    ->label('Status Publikasi')
                    ->getTitleFromRecordUsing(fn (Activity $record): string => $record->status->label()),
                Tables\Grouping\Group::make('office.name')
                    ->label('Kanwil Asal'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(ActivityStatus::class)
                    ->indicator('Status'),

                Tables\Filters\SelectFilter::make('platform')
                    ->label('Platform')
                    ->options(Platform::class)
                    ->indicator('Platform'),

                Tables\Filters\SelectFilter::make('office_id')
                    ->label('Kanwil')
                    ->relationship('office', 'name')
                    ->searchable()
                    ->preload()
                    ->indicator('Kanwil'),



                Tables\Filters\SelectFilter::make('unit')
                    ->label('Unit')
                    ->options(Unit::class)
                    ->indicator('Unit'),
            ])
            ->filtersFormColumns(3)
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->iconButton()
                    ->tooltip('Lihat Detail'),

                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-badge')
                    ->modalHeading('Setujui Kegiatan')
                    ->modalDescription('Kegiatan ini akan dipublikasikan di halaman portal publik.')
                    ->action(function (Activity $record) {
                        $record->approve(auth()->user());
                    })
                    ->visible(fn (Activity $record) => $isAdmin && $record->status === ActivityStatus::Pending),

                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->modalIcon('heroicon-o-exclamation-triangle')
                    ->modalHeading('Tolak Kegiatan')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3)
                            ->placeholder('Jelaskan mengapa kegiatan ini ditolak...'),
                    ])
                    ->action(function (Activity $record, array $data) {
                        $record->reject(auth()->user(), $data['rejection_reason']);
                    })
                    ->visible(fn (Activity $record) => $isAdmin && $record->status === ActivityStatus::Pending),

                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->tooltip('Edit')
                    ->visible(fn (Activity $record) => $record->status === ActivityStatus::Draft || $record->status === ActivityStatus::Rejected),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('bulkApprove')
                    ->label('Setujui Terpilih')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-badge')
                    ->modalHeading('Setujui Kegiatan Terpilih')
                    ->modalDescription('Semua kegiatan yang dipilih akan dipublikasikan di halaman portal.')
                    ->action(function ($records) {
                        $admin = auth()->user();
                        $records->each(fn (Activity $record) => $record->approve($admin));
                    })
                    ->visible(fn () => $isAdmin)
                    ->deselectRecordsAfterCompletion(),
            ])
            ->emptyStateHeading('Belum ada kegiatan')
            ->emptyStateDescription('Mulai submit kegiatan baru dengan tombol di atas.')
            ->emptyStateIcon('heroicon-o-newspaper');
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        if ($user && $user->hasRole('regional')) {
            $query->where('user_id', $user->id);
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
