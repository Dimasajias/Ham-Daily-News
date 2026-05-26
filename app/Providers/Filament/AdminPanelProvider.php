<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\View\PanelsRenderHook;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('HAMDANS')
            ->brandLogo(asset('images/logo_header.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo_kemenham.png'))
            ->font('Inter')
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::hex('#0A2B6B'),
                'danger' => Color::Rose,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): HtmlString => new HtmlString('<link rel="stylesheet" href="' . asset('css/filament-custom.css') . '">')
            )
            ->renderHook(
                PanelsRenderHook::FOOTER,
                fn (): HtmlString => new HtmlString('
                    <div class="fi-footer-custom" style="
                        text-align: center;
                        padding: 1.25rem 2rem;
                        font-size: 0.72rem;
                        border-top: 1px solid var(--fi-color-gray-200);
                        letter-spacing: 0.02em;
                        font-family: Inter, -apple-system, sans-serif;
                    ">
                        &copy; ' . date('Y') . ' <span style="font-weight: 700; color: var(--fi-color-primary-600);">HAMDANS</span> &mdash; <span style="color: var(--fi-color-gray-500);">Kementerian Hak Asasi Manusia Republik Indonesia</span>
                    </div>
                    <style>
                        .dark .fi-footer-custom {
                            border-top-color: var(--fi-color-gray-800) !important;
                            background: rgba(24, 24, 27, 0.6) !important;
                        }
                        html:not(.dark) .fi-footer-custom {
                            border-top-color: rgba(0,0,0,0.05) !important;
                            background: rgba(248,250,252,0.6) !important;
                        }
                    </style>
                ')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->profile(\App\Filament\Pages\EditProfile::class)
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
