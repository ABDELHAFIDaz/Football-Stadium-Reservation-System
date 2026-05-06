<?php

namespace App\Repositories;

use App\Models\Reservation;
use App\Repositories\Interfaces\ReservationRepositoryInterface;

class EloquentReservationRepository implements ReservationRepositoryInterface
{
    public function update(Reservation $reservation, array $data): void
    {
        $reservation->update($data);
    }

    public function create(array $data): Reservation
    {
        return Reservation::create($data);
    }

    public function find(int $id): Reservation
    {
        return Reservation::findOrFail($id);
    }

    public function cancelConflicting(int $stadiumId, string $from, string $until): void
    {
        Reservation::where('stadium_id', $stadiumId)
            ->whereIn('status', ['confirmed', 'pending'])
            ->whereBetween('reservation_date', [$from, $until])
            ->update(['status' => 'canceled']);
    }

    public function cancelAll(int $stadiumId): void
    {
        Reservation::where('stadium_id', $stadiumId)
            ->whereIn('status', ['confirmed', 'pending'])
            ->update(['status' => 'canceled']);
    }
}