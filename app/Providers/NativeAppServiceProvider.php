<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
        $projects = $this->getProjects();
        $projectMenus = [];
        foreach ($projects as $project) {
            $projectMenus[] = Menu::label("{$project->name} ({$project->owner->name})");
        }
        MenuBar::create()
               ->icon(storage_path("app/menuBarIconTemplate.png"))
               ->withContextMenu(Menu::make(
                   Menu::label("About"),
                   Menu::make(...$projectMenus)->label("Projects"),
               ))
               ->onlyShowContextMenu();
    }

    private function getProjects()
    {
        $apiUrl = config('mc.url');
        $resp = Http::withToken(config('user.token'))
                    ->get("{$apiUrl}/projects");
        if ($resp->ok()) {
            return $resp->object()->data;
        }

        return [];
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
