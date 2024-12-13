<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        $this->configureDatabase();

        $this->configureUrl();
    }

    private function configureDatabase(): void
    {
        Model::unguard();

        Model::shouldBeStrict();

        DB::prohibitDestructiveCommands(prohibit: config('app.env') === 'production');
    }

    private function configureUrl(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
