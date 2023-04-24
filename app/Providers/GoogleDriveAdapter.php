<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleDriveAdapter extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
    public function grtService(){
        return $this->service;
    }
}
