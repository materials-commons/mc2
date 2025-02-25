<?php

namespace App\Providers;

use Native\Laravel\Facades\Menu;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Facades\Window;
use Native\Laravel\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        MenuBar::create()
               ->icon(storage_path("app/menuBarIconTemplate.png"))
               ->withContextMenu(Menu::make(
                   Menu::label("About"),
                   Menu::make(
                       Menu::label("Project 1"),
                       Menu::label("Project 2"),
                   )->label("Projects"),
               ))
               ->onlyShowContextMenu();
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
