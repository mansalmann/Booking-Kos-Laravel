<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Interfaces\CityRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Repositories\BoardingHouseRepository;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\BoardingHouseRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BoardingHouseRepositoryInterface::class, BoardingHouseRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
