<?php

namespace App\Providers;

use App\Contracts\Repositories\PlanRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Data\Repositories\PlanRepository;
use App\Data\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PlanRepositoryInterface::class, PlanRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
