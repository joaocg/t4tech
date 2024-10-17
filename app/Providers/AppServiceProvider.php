<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\PlayerRepositoryInterface;
use App\Repositories\PlayerRepository;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Repositories\TeamRepository;
use App\Repositories\Contracts\GameRepositoryInterface;
use App\Repositories\GameRepository;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
