<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\BlockRepositoryInterface;
use App\Repositories\BlockRepository;
use App\Services\BlockService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BlockRepositoryInterface::class, BlockRepository::class);
        $this->app->bind(BlockService::class, function ($app) {
            return new BlockService($app->make(BlockRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
