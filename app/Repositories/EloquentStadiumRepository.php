<?php

namespace App\Repositories;

use App\Models\Stadium;
use App\Repositories\Interfaces\StadiumRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentStadiumRepository implements StadiumRepositoryInterface
{
    public function create(array $data): Stadium
    {
        return Stadium::create($data);
    }

    public function update(Stadium $stadium, array $data): void
    {
        $stadium->update($data);
    }

    public function delete(Stadium $stadium): void
    {
        $stadium->delete();
    }

    public function getFilteredStadiums(Request $request): LengthAwarePaginator
    {
        return Stadium::query()
            ->when(
                $request->filled('city') && $request->city !== 'all',
                fn($q) => $q->where('city_id', $request->city)
            )
            ->when($request->sort === 'price_asc',  fn($q) => $q->orderBy('price_per_hour', 'asc'))
            ->when($request->sort === 'price_desc', fn($q) => $q->orderBy('price_per_hour', 'desc'))
            ->paginate(9)
            ->withQueryString();
    }

    public function getAdminFilteredStadiums(Request $request): LengthAwarePaginator
    {
        return Stadium::query()
            ->when($request->filled('search'),  fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->when($request->filled('city_id'), fn($q) => $q->where('city_id', $request->city_id))
            ->when($request->filled('status'),  fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getManagerStadiums(int $managerId)
    {
        return Stadium::where('managerId', $managerId)->get();
    }

    public function getManagerStadiumPreview(int $managerId)
    {
        return Stadium::where('managerId', $managerId)->limit(3)->get();
    }

    public function getFilteredManagerStadiums(int $managerId, Request $request): LengthAwarePaginator
    {
        $sortOrder = $request->get('sort', 'newest') === 'oldest' ? 'asc' : 'desc';

        return Stadium::where('managerId', $managerId)
            ->when($request->filled('search'), fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('created_at', $sortOrder)
            ->paginate(10)
            ->withQueryString();
    }
}