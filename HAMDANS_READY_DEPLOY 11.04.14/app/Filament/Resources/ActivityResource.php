<?php

namespace App\Filament\Resources;

use App\Enums\ActivityStatus;
use App\Enums\Platform;
use App\Filament\Resources\ActivityResource\Pages;
use App\Jobs\ScrapeActivityJob;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
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
                    ->description('Isi data kegiatan yang akan diterbitkan.')
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

                        // ──── Multi-Link Media Sosial ────
                        Forms\Components\Repeater::make('social_media_links')
                            ->label('🔗 Link Media Sosial')
                            ->schema([
                                Forms\Components\Select::make('platform')
                                    ->label('Platform')
                                    ->options([
                                        'instagram' => '📸 Instagram',
                                        'tiktok'    => '🎵 TikTok',
                                        'youtube'   => '▶️ YouTube',
                                        'twitter'   => '🐦 Twitter / X',
                                        'facebook'  => '📘 Facebook',
                                        'other'     => '🔗 Lainnya',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->searchable(),

                                Forms\Components\TextInput::make('url')
                                    ->label('URL')
                                    ->required()
                                    ->url()
                                    ->placeholder('https://www.instagram.com/p/...')
                                    ->prefixIcon('heroicon-o-link'),
                            ])
                            ->columns(2)
                            ->minItems(1)
                            ->maxItems(6)
                            ->defaultItems(1)
                            ->addActionLabel('+ Tambah Link Sosmed')
                            ->reorderable(false)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string =>
                                match ($state['platform'] ?? null) {
                                    'instagram' => '📸 Instagram',
                                    'tiktok'    => '🎵 TikTok',
                                    'youtube'   => '▶️ YouTube',
                                    'twitter'   => '🐦 Twitter / X',
                                    'facebook'  => '📘 Facebook',
                                    'other'     => '🔗 Lainnya',
                                    default     => 'Link Media Sosial',
                                }
                            )
                            ->helperText('Masukkan semua link media sosial untuk kegiatan ini. Satu kegiatan bisa memiliki banyak link dari platform berbeda.')
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\FileUpload::make('foto_dokumentasi')
                                    ->label('📷 Foto Dokumentasi')
                                    ->required()
                                    ->image()
                                    ->directory('dokumentasi')
                                    ->disk('public')
                                    ->imageEditor()
                                    ->maxSize(5120)
                                    ->helperText('Upload foto (maks 5MB). Akan dikompres otomatis.')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Forms\Components\Section::make('🔍 Konten Terdeteksi')
                    ->description('Konten berikut diekstrak otomatis dari URL. Anda dapat mengedit jika diperlukan.')
                    ->icon('heroicon-o-magnifying-glass')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Kegiatan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Infolists\Components\TextEntry::make('extracted_title')
                            ->label('Judul Kegiatan')
                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('description')
                            ->label('Deskripsi / Keterangan')
                            ->placeholder('Tidak ada deskripsi.')
                            ->markdown()
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('office.name')
                            ->label('Unit Kerja')
                            ->icon('heroicon-m-building-office-2'),

                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Dilaporkan Oleh')
                            ->icon('heroicon-m-user'),

                        Infolists\Components\TextEntry::make('status')
                            ->label('Status Publikasi')
                            ->badge()
                            ->color(fn (ActivityStatus $state): string => match ($state) {
                                ActivityStatus::Draft => 'gray',
                                ActivityStatus::Pending => 'warning',
                                ActivityStatus::Approved => 'success',
                                ActivityStatus::Rejected => 'danger',
                            })
                            ->icon(fn (ActivityStatus $state) => $state->icon()),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Waktu Submit')
                            ->dateTime('d M Y, H:i')
                            ->icon('heroicon-m-clock'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Media Sosial & Tautan')
                    ->icon('heroicon-o-link')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('social_media_links')
                            ->label('Daftar Tautan Publikasi')
                            ->schema([
                                Infolists\Components\TextEntry::make('platform')
                                    ->label('Platform')
                                    ->formatStateUsing(fn ($state) => match ($state) {
                                        'instagram' => '📸 Instagram',
                                        'tiktok'    => '🎵 TikTok',
                                        'youtube'   => '▶️ YouTube',
                                        'twitter'   => '🐦 Twitter / X',
                                        'facebook'  => '📘 Facebook',
                                        'other'     => '🔗 Lainnya',
                                        default     => ucfirst($state),
                                    })
                                    ->badge()
                                    ->color(fn ($state) => match ($state) {
                                        'instagram' => 'danger',
                                        'tiktok'    => 'gray',
                                        'youtube'   => 'danger',
                                        'twitter'   => 'info',
                                        'facebook'  => 'primary',
                                        default     => 'secondary',
                                    }),
                                Infolists\Components\TextEntry::make('url')
                                    ->label('URL Tautan')
                                    ->url(fn ($state) => $state)
                                    ->color('primary')
                                    ->openUrlInNewTab(),
                            ])
                            ->columns(2)
                            ->grid(2)
                            ->columnSpanFull(),
                    ]),

                Infolists\Components\Section::make('Dokumentasi Kegiatan')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Infolists\Components\ImageEntry::make('foto_dokumentasi')
                            ->label('')
                            ->hiddenLabel()
                            ->width('100%')
                            ->height(400)
                            ->extraImgAttributes(['style' => 'object-fit: contain; background-color: #f3f4f6; border-radius: 0.5rem;'])
                            ->columnSpanFull(),
                    ]),

                Infolists\Components\Section::make('Alasan Penolakan')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->schema([
                        Infolists\Components\TextEntry::make('rejection_reason')
                            ->label('')
                            ->hiddenLabel()
                            ->color('danger')
                            ->columnSpanFull(),
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

                // Multi-platform badges
                Tables\Columns\TextColumn::make('social_media_links')
                    ->label('Platform')
                    ->badge()
                    ->formatStateUsing(function ($state, Activity $record) {
                        $platforms = $record->getPlatforms();
                        if (empty($platforms)) {
                            return '—';
                        }
                        return collect($platforms)->map(fn (Platform $p) => $p->label())->join(', ');
                    })
                    ->color('primary')
                    ->alignCenter(),

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
                    ->tooltip(fn (Activity $record) => $record->created_at?->format('d M Y H:i:s')),

                Tables\Columns\TextColumn::make('approved_at')
                    ->label('Direview')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
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
                    ->label('Unit Kerja Asal'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(ActivityStatus::class)
                    ->indicator('Status'),

                Tables\Filters\SelectFilter::make('platform')
                    ->label('Platform')
                    ->options(
                        collect(Platform::cases())
                            ->mapWithKeys(fn (Platform $p) => [$p->value => $p->label()])
                            ->toArray()
                    )
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['value'])) {
                            $query->whereRaw(
                                "JSON_CONTAINS(social_media_links, JSON_OBJECT('platform', ?))",
                                [$data['value']]
                            );
                        }
                    })
                    ->indicator('Platform'),

                Tables\Filters\SelectFilter::make('office_id')
                    ->label('Unit Kerja')
                    ->relationship('office', 'name', fn ($query) => $query->orderByRaw("CASE WHEN name LIKE 'Kementerian%' THEN 0 ELSE 1 END")->orderBy('name'))
                    ->searchable()
                    ->preload()
                    ->indicator('Unit Kerja'),
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
                    ->visible(fn (Activity $record) => in_array($record->status, [
                        ActivityStatus::Draft,
                        ActivityStatus::Pending,
                        ActivityStatus::Approved,
                        ActivityStatus::Rejected
                    ])),

                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->tooltip('Hapus')
                    ->visible(fn (Activity $record) => in_array($record->status, [
                        ActivityStatus::Draft,
                        ActivityStatus::Pending,
                        ActivityStatus::Approved,
                        ActivityStatus::Rejected
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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

                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'view' => Pages\ViewActivity::route('/{record}'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
