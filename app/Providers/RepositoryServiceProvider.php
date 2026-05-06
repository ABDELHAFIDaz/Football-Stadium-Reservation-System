<?php

namespace App\Providers;

use App\Repositories\EloquentReservationRepository;
use App\Repositories\EloquentStadiumRepository;
use App\Repositories\Interfaces\ReservationRepositoryInterface;
use App\Repositories\Interfaces\StadiumRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ReservationRepositoryInterface::class,
            EloquentReservationRepository::class
        );

        $this->app->bind(
            StadiumRepositoryInterface::class,
            EloquentStadiumRepository::class
        );
    }
}
