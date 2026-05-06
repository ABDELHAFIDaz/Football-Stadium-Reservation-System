<?php

namespace App\Providers;

use App\Repositories\EloquentReservationRepository;
use App\Repositories\Interfaces\ReservationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ReservationRepositoryInterface::class,
            EloquentReservationRepository::class
        );
    }
}