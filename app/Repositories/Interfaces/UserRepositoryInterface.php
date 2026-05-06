<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function create(array $data, string $role): User;
    public function find(int $id): User;
    public function getManagers();
    public function getRecentNonAdmins();
    public function countByRole(string $role): int;
    public function getFilteredUsers(Request $request): LengthAwarePaginator;
    public function toggleBan(User $user): string;
}