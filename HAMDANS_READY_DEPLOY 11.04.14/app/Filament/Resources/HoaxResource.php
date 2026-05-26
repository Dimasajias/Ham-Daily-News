<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HoaxResource\Pages;
use App\Models\Hoax;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HoaxResource extends Resource
{
    protected static ?string $model = Hoax::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    protected static ?string $navigationLabel = 'Berita Hoax';

    protected static ?string $modelLabel = 'Berita Hoax';

    protected static ?string $pluralModelLabel = 'Berita Hoax';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('📰 Informasi Berita Hoax')
                    ->description('Masukkan detail berita hoax yang akan dipublikasikan.')
                    ->icon('heroicon-o-shield-exclamation')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Berita Hoax')
                            ->required()
                            ->maxLength(500)
                            ->placeholder('Contoh: Klaim palsu vaksin mengandung microchip...')
                            ->helperText('Masukkan judul hoax yang diklaim/beredar di masyarakat.')
                            ->columnSpanFull(),


                        Forms\Components\RichEditor::make('content')
                            ->label('Isi / Klarifikasi Berita')
                            ->required()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'blockquote',
                                'link',
                            ])
                            ->placeholder('Tulis klarifikasi atau penjelasan lengkap tentang hoax ini...')
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('cover_image')
                                    ->label('📷 Gambar Cover / Tangkapan Layar Hoax')
                                    ->image()
                                    ->directory('hoax')
                                    ->disk('public')
                                    ->imageEditor()
                                    ->maxSize(5120)
                                    ->helperText('Upload gambar hoax atau tangkapan layar (maks 5MB).'),

                                Forms\Components\TextInput::make('source_url')
                                    ->label('Sumber / Link Referensi')
                                    ->url()
                                    ->placeholder('https://...')
                                    ->helperText('Link sumber berita resmi atau fakta-cek.')
                                    ->prefixIcon('heroicon-o-link'),
                            ]),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Publikasikan ke Halaman Publik')
                            ->helperText('Aktifkan agar berita hoax ini tampil di portal publik.')
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $set('published_at', now());
                                }
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('#')
                    ->rowIndex()
                    ->alignCenter()
                    ->width('60px'),

                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->disk('public')
                    ->width(60)
                    ->height(60)
                    ->defaultImageUrl(asset('images/logo_kemenham.png'))
                    ->extraImgAttributes(['class' => 'rounded-lg object-cover']),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Hoax')
                    ->limit(70)
                    ->searchable()
                    ->wrap()
                    ->weight('medium'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Dibuat oleh')
                    ->icon('heroicon-o-user')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since()
                    ->tooltip(fn (Hoax $record) => $record->created_at?->format('d M Y H:i:s')),
            ])
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi')
                    ->trueLabel('Sudah Dipublish')
                    ->falseLabel('Belum Dipublish'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton()->tooltip('Edit'),
                Tables\Actions\DeleteAction::make()->iconButton()->tooltip('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada data berita hoax')
            ->emptyStateDescription('Mulai tambahkan berita hoax dengan tombol di atas.')
            ->emptyStateIcon('heroicon-o-shield-exclamation');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHoaxes::route('/'),
            'create' => Pages\CreateHoax::route('/create'),
            'edit'   => Pages\EditHoax::route('/{record}/edit'),
        ];
    }
}
