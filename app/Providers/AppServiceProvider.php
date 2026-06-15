<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        // Share global settings with all views
        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('settings')) {
                    $view->with('globalSettings', [
                        'nama_perusahaan' => Setting::getValue('nama_perusahaan', 'PT Indotama Media Teknologi'),
                        'logo_path' => Setting::getValue('logo_path', null),
                    ]);
                } else {
                    $view->with('globalSettings', [
                        'nama_perusahaan' => 'PT Indotama Media Teknologi',
                        'logo_path' => null,
                    ]);
                }
            } catch (\Exception $e) {
                $view->with('globalSettings', [
                    'nama_perusahaan' => 'PT Indotama Media Teknologi',
                    'logo_path' => null,
                ]);
            }
        });
    }
}
