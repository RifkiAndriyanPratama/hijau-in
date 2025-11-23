<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            
            // --- TEMA & WARNA (Mode Gelap Permanen) ---
            ->defaultThemeMode(ThemeMode::Dark)
            ->colors([
                'primary' => Color::Emerald,
                'gray' => Color::Slate,
            ])
            ->viteTheme('resources/css/filament/hijauin.css')
            ->font('Poppins')

            // --- BRANDING ---
            ->brandName('HijauIN Admin')
            ->brandLogo(asset('images/logo-hijauin.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/logo-hijauin.png'))

            // --- LAYOUT ---
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')

            // --- NAVIGASI ---
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])

            // --- WIDGETS ---
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])

            // --- CUSTOM CSS & JS (Scrollbar & Topbar) ---
            ->renderHook('panels::body.end', fn() => <<<'HTML'
                <style>
                    /* Scrollbar Kustom */
                    ::-webkit-scrollbar { width: 8px; height: 8px; }
                    ::-webkit-scrollbar-track { background: transparent; }
                    ::-webkit-scrollbar-thumb { background: #475569; border-radius: 4px; }
                    ::-webkit-scrollbar-thumb:hover { background: #64748b; }
                    .fi-topbar { transition: all 0.3s ease; }
                </style>

                <script>
                    document.addEventListener('scroll', () => {
                        const topbar = document.querySelector('.fi-topbar');
                        if (!topbar) return;
                        
                        if (window.scrollY > 10) {
                            topbar.style.backgroundColor = 'rgba(2, 6, 23, 0.8)'; 
                            topbar.style.backdropFilter = 'blur(12px)';
                            topbar.classList.add('shadow-md', 'border-b', 'border-white/5');
                        } else {
                            topbar.style.backgroundColor = '';
                            topbar.style.backdropFilter = '';
                            topbar.classList.remove('shadow-md', 'border-b', 'border-white/5');
                        }
                    });
                </script>
HTML
            )

            // --- MIDDLEWARE ---
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