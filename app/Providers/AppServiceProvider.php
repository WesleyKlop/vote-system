<?php

namespace App\Providers;

use App\Models\AppConfig;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! app()->runningInConsole()) {
            $this->bootWebApplication();
        }
    }

    private function bootWebApplication(): void
    {
        if (Str::startsWith(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        $language = AppConfig::find('language');
        if($language !== null && in_array($language->value(), ['en', 'nl'])) {
            app()->setLocale($language->value());
        }
    }
}
