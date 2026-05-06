<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(array $data, string $role): User
    {
        return User::create([
            'fullname'     => $data['fullname'],
            'email'        => $data['email'],
            'phone_number' => $data['phone_number'] ?? null,
            'password'     => Hash::make($data['password']),
            'role'         => $role,
            'is_adult'     => true,
            'is_banned'    => false,
        ]);
    }

    public function find(int $id): User
    {
        return User::findOrFail($id);
    }

    public function getManagers()
    {
        return User::where('role', 'manager')->get();
    }

    public function getRecentNonAdmins()
    {
        return User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
    }

    public function countByRole(string $role): int
    {
        return User::where('role', $role)->count();
    }

    public function getFilteredUsers(Request $request): LengthAwarePaginator
    {
        $sort = $request->sort === 'oldest' ? 'asc' : 'desc';

        return User::where('role', '!=', 'admin')
            ->when($request->filled('search'), fn($q) => $q->where(fn($q) => $q
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
}