<?php

namespace App\Services;

use App\Models\Stadium;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerDashboardService
{
    public function __construct(private ReservationService $reservationService) {}

    public function getFilteredReservations(int $customerId, Request $request)
    {
        return $this->reservationService->getFilteredCustomerReservations($customerId, $request);
    }

    public function getStats(int $customerId): array
    {
        return $this->reservationService->getCustomerStats($customerId);
    }

    public function getFavoriteStadiums(int $customerId)
    {
        return Stadium::withCount([
            'reservations as my_bookings_count' => fn($q) => $q
                ->where('customerId', $customerId)
                ->whereIn('status', ['confirmed', 'ended']),
        ])
            ->orderBy('my_bookings_count', 'desc')
            ->take(3)
            ->get();
    }

    public function updateProfile(User $user, array $data)
    {
        $user->update([
            'email'        => $data['email'],
            'phone_number' => $data['phone_number'],
        ]);
    }
}
