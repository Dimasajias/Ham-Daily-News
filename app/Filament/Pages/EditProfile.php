<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\Password;

class EditProfile extends BaseEditProfile
{
    /**
     * Intercept save: kirim dialog konfirmasi ke browser.
     * Jika user klik OK, browser memanggil confirmedSave().
     */
    public function save(): void
    {
        $this->js("
            if (confirm('Apakah Anda yakin ingin menyimpan perubahan profil ini?')) {
                \$wire.confirmedSave();
            }
        ");
    }

    /**
     * Method terpisah yang dipanggil setelah user klik OK.
     */
    public function confirmedSave(): void
    {
        parent::save();
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Profil Berhasil Diperbarui!')
            ->body('Perubahan data profil Anda telah tersimpan dengan aman.')
            ->success();
    }

    public function getHeading(): string
    {
        return 'Profil Saya';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola informasi akun dan keamanan kata sandi Anda.';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Profile header card
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('profile_header')
                            ->hiddenLabel()
                            ->content(function () {
                                $user = auth()->user();
                                $avatarUrl = asset('images/logo_kemenham.png');
                                $name = e($user->name);
                                $email = e($user->email);
                                $role = $user->roles->first()?->name ?? 'Staff';
                                $office = $user->office?->name ?? '-';
                                
                                return new HtmlString("
                                    <div style=\"display: flex; align-items: center; gap: 1.25rem;\">
                                        <img src=\"{$avatarUrl}\" alt=\"Avatar\" style=\"
                                            width: 72px; height: 72px;
                                            border-radius: 50%;
                                            object-fit: cover;
                                            border: 3px solid rgba(10, 43, 107, 0.1);
                                            background: #f8fafc;
                                            padding: 4px;
                                        \">
                                        <div>
                                            <div style=\"font-size: 1.25rem; font-weight: 800; color: #0f172a; letter-spacing: -0.02em; line-height: 1.3;\">{$name}</div>
                                            <div style=\"font-size: 0.85rem; color: #64748b; margin-top: 2px;\">{$email}</div>
                                            <div style=\"margin-top: 8px; display: flex; gap: 8px; flex-wrap: wrap;\">
                                                <span style=\"
                                                    font-size: 0.7rem; font-weight: 700;
                                                    background: linear-gradient(135deg, #0A2B6B, #1e3a8a);
                                                    color: white;
                                                    padding: 3px 10px;
                                                    border-radius: 6px;
                                                    text-transform: uppercase;
                                                    letter-spacing: 0.05em;
                                                \">{$role}</span>
                                                <span style=\"
                                                    font-size: 0.7rem; font-weight: 600;
                                                    background: #f1f5f9;
                                                    color: #475569;
                                                    padding: 3px 10px;
                                                    border-radius: 6px;
                                                \">{$office}</span>
                                            </div>
                                        </div>
                                    </div>
                                ");
                            }),
                    ]),

                Forms\Components\Section::make('Informasi Akun')
                    ->description('Perbarui nama dan alamat email Anda.')
                    ->icon('heroicon-o-user-circle')
                    ->aside()
                    ->schema([
                        $this->getNameFormComponent()
                            ->label('Nama Lengkap')
                            ->prefixIcon('heroicon-m-user'),
                        $this->getEmailFormComponent()
                            ->label('Alamat Email')
                            ->prefixIcon('heroicon-m-envelope'),
                    ]),

                Forms\Components\Section::make('Keamanan Password')
                    ->description('Kosongkan jika tidak ingin mengubah password.')
                    ->icon('heroicon-o-shield-check')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('current_password')
                            ->label('Password Saat Ini')
                            ->password()
                            ->revealable()
                            ->requiredWith('password')
                            ->currentPassword()
                            ->dehydrated(false)
                            ->prefixIcon('heroicon-m-lock-closed')
                            ->helperText('Masukkan password yang sedang Anda gunakan saat ini.'),

                        Forms\Components\TextInput::make('password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->rule(Password::min(8)->letters()->mixedCase()->numbers()->symbols())
                            ->autocomplete('new-password')
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->live(debounce: 500)
                            ->same('passwordConfirmation')
                            ->prefixIcon('heroicon-m-key')
                            ->afterStateUpdated(fn ($state) => $this->dispatch('password-updated', password: $state ?? '')),

                        Forms\Components\Placeholder::make('password_strength')
                            ->hiddenLabel()
                            ->content(new HtmlString('
                                <div x-data="{
                                    pw: \'\',
                                    get hasMin()   { return this.pw.length >= 8 },
                                    get hasUpper() { return /[A-Z]/.test(this.pw) },
                                    get hasLower() { return /[a-z]/.test(this.pw) },
                                    get hasNum()   { return /[0-9]/.test(this.pw) },
                                    get hasSym()   { return /[^A-Za-z0-9]/.test(this.pw) },
                                    get score()    { return (this.hasMin?1:0)+(this.hasUpper?1:0)+(this.hasLower?1:0)+(this.hasNum?1:0)+(this.hasSym?1:0) },
                                    get level()    { if(this.score<=1) return \'Lemah\'; if(this.score<=3) return \'Sedang\'; if(this.score<=4) return \'Kuat\'; return \'Sangat Kuat\' },
                                    get color()    { if(this.score<=1) return \'#ef4444\'; if(this.score<=3) return \'#f59e0b\'; if(this.score<=4) return \'#3b82f6\'; return \'#10b981\' },
                                }"
                                x-on:password-updated.window="pw = $event.detail.password || \'\'"
                                x-show="pw.length > 0"
                                x-transition
                                style="margin-top: -0.5rem;">

                                    <!-- Progress Bar -->
                                    <div style="height: 6px; background: #e2e8f0; border-radius: 99px; overflow: hidden; margin-bottom: 0.75rem;">
                                        <div :style="`width: ${score * 20}%; background: ${color}; height: 100%; border-radius: 99px; transition: all 0.4s ease;`"></div>
                                    </div>

                                    <!-- Status Label -->
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                        <span style="font-size: 0.75rem; font-weight: 700; color: #64748b;">KEKUATAN PASSWORD</span>
                                        <span :style="`font-size: 0.75rem; font-weight: 800; color: ${color};`" x-text="level"></span>
                                    </div>

                                    <!-- Checklist -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4px 16px; font-size: 0.8rem;">
                                        <div :style="`color: ${hasMin ? \'#10b981\' : \'#94a3b8\'}`">
                                            <span x-text="hasMin ? \'✓\' : \'✕\'" :style="`font-weight:800; margin-right:4px;`"></span> Min. 8 karakter
                                        </div>
                                        <div :style="`color: ${hasUpper ? \'#10b981\' : \'#94a3b8\'}`">
                                            <span x-text="hasUpper ? \'✓\' : \'✕\'" :style="`font-weight:800; margin-right:4px;`"></span> Huruf besar (A-Z)
                                        </div>
                                        <div :style="`color: ${hasLower ? \'#10b981\' : \'#94a3b8\'}`">
                                            <span x-text="hasLower ? \'✓\' : \'✕\'" :style="`font-weight:800; margin-right:4px;`"></span> Huruf kecil (a-z)
                                        </div>
                                        <div :style="`color: ${hasNum ? \'#10b981\' : \'#94a3b8\'}`">
                                            <span x-text="hasNum ? \'✓\' : \'✕\'" :style="`font-weight:800; margin-right:4px;`"></span> Angka (0-9)
                                        </div>
                                        <div :style="`color: ${hasSym ? \'#10b981\' : \'#94a3b8\'}`">
                                            <span x-text="hasSym ? \'✓\' : \'✕\'" :style="`font-weight:800; margin-right:4px;`"></span> Simbol (@#$!%*)
                                        </div>
                                    </div>
                                </div>
                            ')),

                        Forms\Components\TextInput::make('passwordConfirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->revealable()
                            ->requiredWith('password')
                            ->dehydrated(false)
                            ->prefixIcon('heroicon-m-check-circle'),
                    ]),
            ]);
    }
}
