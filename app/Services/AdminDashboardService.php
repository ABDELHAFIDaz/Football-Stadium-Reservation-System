<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Stadium;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDashboardService
{

    public function __construct(private StadiumService $stadiumService) {}

    public function getAdminFilteredStadiums(Request $request)
    {
        return $this->stadiumService->getAdminFilteredStadiums($request);
    }

    public function getDashboardData(): array
    {
        return [
            'users'               => User::where('role', '!=', 'admin')->orderBy('created_at', 'desc')->limit(4)->get(),
            'pitches'             => Stadium::orderBy('created_at', 'desc')->limit(6)->get(),
            'customersCounter'    => User::where('role', 'customer')->count(),
            'managersCounter'     => User::where('role', 'manager')->count(),
            'pitchesCounter'      => Stadium::count(),
            'reservationsCounter' => Reservation::where('status', 'ended')->count(),
        ];
    }

    public function getFilteredUsers(Request $request)
    {
        $sort = $request->sort === 'oldest' ? 'asc' : 'desc';

        return User::where('role', '!=', 'admin')
            ->when($request->filled('search'), fn($q) => $q->where(
                fn($q) => $q
                    ->where('fullname', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
            ))
            ->when($request->filled('status'), function ($q) use ($request) {
                if ($request->status === 'banned') return $q->where('is_banned', true);
                if ($request->status === 'active') return $q->where('is_banned', false);
            })
            ->orderBy('created_at', $sort)
            ->paginate(10)
            ->withQueryString();
    }

    public function toggleBan(User $user): string
    {
        if ($user->role === 'admin') {
            throw new \Exception('Administrators cannot be banned.');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        return $user->is_banned ? 'banned' : 'unbanned';
    }

    public function createManager(array $data)
    {
        return User::create([
            'fullname'     => $data['fullname'],
            'email'        => $data['email'],
            'phone_number' => $data['phone_number'] ?? null,
            'password'     => Hash::make($data['password']),
            'role'         => 'manager',
            'is_adult'     => true,
            'is_banned'    => false,
        ]);
    }

    public function getManagers()
    {
        return User::where('role', 'manager')->get();
    }
}
