<?php

namespace App\Providers;

use App\Repository\DashboardRepository;
use Illuminate\Support\ServiceProvider;
use App\Contract\DashboardRepositoryInterface;

class DashboardProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(DashboardRepositoryInterface::class, DashboardRepository::class);
    }
}
