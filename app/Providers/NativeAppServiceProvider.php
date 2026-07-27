<?php

namespace App\Providers;

use Native\Desktop\Contracts\ProvidesPhpIni;
use Native\Desktop\Facades\Menu;
use Native\Desktop\Facades\Window;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        $panels = [];

        if (config('nativekit.admin_panel_enabled', false)) {
            $panels[] = Menu::route('filament.admin.auth.login', 'Admin Panel');
        }
        if (config('nativekit.app_panel_enabled', false)) {
            $panels[] = Menu::route('filament.app.auth.login', 'App Panel');
        }
        if (config('nativekit.guest_panel_enabled', false)) {
            $panels[] = Menu::route('filament.guest.pages.dashboard', 'Guest Panel');
        }

        Menu::create(
            Menu::make(...$panels)->label('Panels'),
            Menu::file(),
            Menu::view(),
        );

        Window::open()
            ->maximized();
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
