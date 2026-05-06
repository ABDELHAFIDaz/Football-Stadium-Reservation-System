<?php

namespace App\Services;

use Illuminate\Http\Request;

class ManagerDashboardService
{
    public function __construct(
        private ReservationService $reservationService,
        private StadiumService     $stadiumService
    ) {}

    public function getStats(int $managerId): array
    {
        return $this->reservationService->getManagerStats($managerId);
    }

    public function getRecentReservations(int $managerId)
    {
        return $this->reservationService->getRecentManagerReservations($managerId);
    }

    public function getFilteredReservations(int $managerId, Request $request)
    {
        return $this->reservationService->getFilteredManagerReservations($managerId, $request);
    }

    public function getStadiumPreview(int $managerId)
    {
        return $this->stadiumService->getManagerStadiumPreview($managerId);
    }

    public function getAllStadiums(int $managerId)
    {
        return $this->stadiumService->getManagerStadiums($managerId);
    }

    public function getFilteredStadiums(int $managerId, Request $request)
    {
        return $this->stadiumService->getFilteredManagerStadiums($managerId, $request);
    }
}
