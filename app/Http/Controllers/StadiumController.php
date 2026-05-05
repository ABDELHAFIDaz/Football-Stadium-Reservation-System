<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use App\Models\City;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StadiumController extends Controller
{
    public function index(Request $request)
    {
        $query = Stadium::query();

        if ($request->filled('city') && $request->city !== 'all') {
            $query->where('city_id', $request->city);
        }

        if ($request->sort === 'price_asc') {
            $query->orderBy('price_per_hour', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price_per_hour', 'desc');
        }

        $stadiums = $query->paginate(9)->withQueryString();
        $cities = City::all();

        return view('pitches', compact('stadiums', 'cities'));
    }

    public function adminIndex(Request $request)
    {
        $query = Stadium::query();

        // 1. Search by Stadium Name
        $query->when($request->search, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        });

        // 2. Filter by City
        $query->when($request->city_id, function ($q) use ($request) {
            return $q->where('city_id', $request->city_id);
        });

        // 3. Filter by Status (available, reserved, unavailable)
        $query->when($request->status, function ($q) use ($request) {
            return $q->where('status', $request->status);
        });

        $pitches = $query->latest()->paginate(10)->withQueryString();
        $cities = City::all();
        $managers = User::where('role', 'manager')->get();
        $admin = Auth::user();

        return view('admin.pitches', compact('pitches', 'cities', 'managers', 'admin'));
    }

    public function store(Request $request)
    {

        $stadiumData = $request->validate([
            'name' => 'required|string|max:100',
            'managerId' => 'required|exists:users,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:100',
            'capacity' => 'required|integer',
            'price_per_hour' => 'required|numeric',
            'open_from' => 'required',
            'open_until' => 'required',
            'equipments' => 'required|string',
        ]);

        try {

            Stadium::create($stadiumData);

            return redirect()->route('admin.pitches');
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, Stadium $stadium)
    {

        $stadiumData = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|in:available,reserved,unavailable',
            'price_per_hour' => 'required|numeric',
            'note' => 'nullable|string|max:500',
            'open_from' => 'required|date_format:H:i',
            'open_until' => 'required|date_format:H:i|after:open_from',
            'unavailable_from' => 'required_if:status,unavailable|nullable|date',
            'unavailable_until' => 'required_if:status,unavailable|nullable|date|after_or_equal:unavailable_from',
        ]);
        try {

            $stadium->update($stadiumData);
            if ($stadiumData['status'] === 'unavailable') {
                $this->cancelConflictingReservations($stadium, $stadiumData['unavailable_from'], $stadiumData['unavailable_until']);
            }
            return back()->with('success', 'Stadium updated successfully, and the reservations for that period are cancelled.');
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function cancelConflictingReservations(Stadium $stadium, $from, $until)
    {
        Reservation::where('stadium_id', $stadium->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->whereBetween('reservation_date', [$from, $until])
            ->update(['status' => 'canceled']);
    }

    public function destroy(Stadium $stadium)
    {

        $stadium->delete();
        return redirect()->route('admin.dashboard');
    }
}
