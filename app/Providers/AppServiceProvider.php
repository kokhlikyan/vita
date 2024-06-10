<?php

namespace App\Providers;

use App\Repositories\GoalRepository;
use App\Repositories\HabitRepository;
use App\Repositories\Interfaces\GoalRepositoryInterface;
use App\Repositories\Interfaces\HabitRepositoryInterface;
use App\Services\GoalService;
use App\Services\HabitService;
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

        $this->app->bind(HabitRepositoryInterface::class, HabitRepository::class);
        $this->app->bind(HabitService::class, function ($app) {
            return new HabitService($app->make(HabitRepositoryInterface::class));
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
