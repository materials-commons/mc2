<?php

namespace App\Providers;

use App\Events\ProjectClicked;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Native\Laravel\Facades\Window;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::globalOptions([
            'verify' => false,
        ]);

        $configPath = Storage::disk('home')->path('.materialscommons/config.json');
        if (file_exists($configPath)) {
            $config = json_decode(file_get_contents($configPath), true);
            if (isset($config['default_remote']['mcapikey'])) {
                config(['user.token' => $config['default_remote']['mcapikey']]);
            } else {
                config(['user.token' => '']);
            }

            if (isset($config['default_remote']['mcurl'])) {
                config(['mc.url' => $config['default_remote']['mcurl']]);
            } else {
                config(['mc.url' => 'https://materialscommons.org/api']);
            }
        }

        Event::listen(function (ProjectClicked $event): void {
            ray("ProjectClicked", $event);
            $id = $event->item["id"];
            $label = $event->item["label"];
            Window::open("project-{$id}")
                  ->title($label)
                  ->width(800)
                  ->height(500)
                  ->route('show-project', [$id]);
        });
    }
}
