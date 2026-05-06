<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Stadium;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class AdminDashboardService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private StadiumService          $stadiumService
    ) {}

    public function getDashboardData(): array
    {
        return [
            'users'               => $this->userRepository->getRecentNonAdmins(),
            'pitches'             => Stadium::orderBy('created_at', 'desc')->limit(6)->get(),
            'customersCounter'    => $this->userRepository->countByRole('customer'),
            'managersCounter'     => $this->userRepository->countByRole('manager'),
            'pitchesCounter'      => Stadium::count(),
            'reservationsCounter' => Reservation::where('status', 'ended')->count(),
        ];
    }

    public function getFilteredUsers(Request $request)
    {
        return $this->userRepository->getFilteredUsers($request);
    }

    public function toggleBan(User $user): string
    {
        return $this->userRepository->toggleBan($user);
    }

    public function createManager(array $data): User
    {
        return $this->userRepository->create($data, 'manager');
    }

    public function getManagers()
    {
        return $this->userRepository->getManagers();
    }

    public function getAdminFilteredStadiums(Request $request)
    {
        return $this->stadiumService->getAdminFilteredStadiums($request);
    }
}