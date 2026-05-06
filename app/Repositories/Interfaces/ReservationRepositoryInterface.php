<?php

namespace App\Repositories\Interfaces;

use App\Models\Reservation;

interface ReservationRepositoryInterface
{
    public function update(Reservation $reservation, array $data): void;
    public function create(array $data): Reservation;
    public function find(int $id): Reservation;
    public function cancelConflicting(int $stadiumId, string $from, string $until): void;
    public function cancelAll(int $stadiumId): void;
}