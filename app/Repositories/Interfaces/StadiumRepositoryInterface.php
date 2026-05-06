<?php

namespace App\Repositories\Interfaces;

use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface StadiumRepositoryInterface
{
    public function create(array $data): Stadium;
    public function update(Stadium $stadium, array $data): void;
    public function delete(Stadium $stadium): void;
    public function getFilteredStadiums(Request $request): LengthAwarePaginator;
    public function getAdminFilteredStadiums(Request $request): LengthAwarePaginator;
    public function getManagerStadiums(int $managerId);
    public function getManagerStadiumPreview(int $managerId);
    public function getFilteredManagerStadiums(int $managerId, Request $request): LengthAwarePaginator;
}