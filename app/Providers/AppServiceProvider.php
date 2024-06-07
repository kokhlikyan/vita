<?php

namespace App\Providers;

use App\Repositories\GoalRepository;
use App\Repositories\Interfaces\GoalRepositoryInterface;
use App\Services\GoalService;
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

        $this->app->bind(GoalRepositoryInterface::class, GoalRepository::class);
        $this->app->bind(GoalService::class, function ($app) {
            return new GoalService($app->make(GoalRepositoryInterface::class));
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
