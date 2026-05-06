<?php

namespace App\Services;

use App\Models\Stadium;
use App\Repositories\Interfaces\StadiumRepositoryInterface;
use Illuminate\Http\Request;

class StadiumService
{
    public function __construct(
        private StadiumRepositoryInterface $stadiumRepository,
        private ReservationService $reservationService
    ) {}

    public function getFilteredStadiums(Request $request)
    {
        return $this->stadiumRepository->getFilteredStadiums($request);
    }

    public function getAdminFilteredStadiums(Request $request)
    {
        return $this->stadiumRepository->getAdminFilteredStadiums($request);
    }

    public function getManagerStadiums(int $managerId)
    {
        return $this->stadiumRepository->getManagerStadiums($managerId);
    }

    public function getManagerStadiumPreview(int $managerId)
    {
        return $this->stadiumRepository->getManagerStadiumPreview($managerId);
    }

    public function getFilteredManagerStadiums(int $managerId, Request $request)
    {
        return $this->stadiumRepository->getFilteredManagerStadiums($managerId, $request);
    }

    public function createStadium(array $data): Stadium
    {
        return $this->stadiumRepository->create($data);
    }

    public function updateStadium(Stadium $stadium, array $data): void
    {
        $this->stadiumRepository->update($stadium, $data);

        if ($data['status'] === 'unavailable') {
            $this->reservationService->cancelConflictingReservations(
                $stadium,
                $data['unavailable_from'],
                $data['unavailable_until']
            );
        }
    }

    public function deleteStadium(Stadium $stadium): void
    {
        $this->reservationService->deletedStadiumReservations($stadium->id);
        $this->stadiumRepository->delete($stadium);
    }
}