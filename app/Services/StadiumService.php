<?php

namespace App\Services;

use App\Models\Stadium;
use Illuminate\Http\Request;

class StadiumService
{
    public function __construct(private ReservationService $reservationService) {}

    public function getFilteredStadiums(Request $request)
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

    public function getAdminFilteredStadiums(Request $request)
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

    public function getFilteredManagerStadiums(int $managerId, Request $request)
    {
        $sortOrder = $request->get('sort', 'newest') === 'oldest' ? 'asc' : 'desc';

        return Stadium::where('managerId', $managerId)
            ->when($request->filled('search'), fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('created_at', $sortOrder)
            ->paginate(10)
            ->withQueryString();
    }

    public function createStadium(array $data)
    {
        return Stadium::create($data);
    }

    public function updateStadium(Stadium $stadium, array $data)
    {
        $stadium->update($data);

        if ($data['status'] === 'unavailable') {
            $this->reservationService->cancelConflictingReservations(
                $stadium,
                $data['unavailable_from'],
                $data['unavailable_until']
            );
        }
    }

    public function deleteStadium(Stadium $stadium)
    {
        $stadium->delete();
    }
}