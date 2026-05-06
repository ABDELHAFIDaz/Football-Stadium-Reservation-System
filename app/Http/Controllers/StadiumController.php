<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Stadium;
use App\Services\StadiumService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StadiumController extends Controller
{
    public function __construct(private StadiumService $stadiumService) {}

    public function index(Request $request)
    {
        $stadiums = $this->stadiumService->getFilteredStadiums($request);
        $cities   = City::all();

        return view('pitches', compact('stadiums', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:100',
            'managerId'     => 'required|exists:users,id',
            'city_id'       => 'required|exists:cities,id',
            'address'       => 'required|string|max:100',
            'capacity'      => 'required|integer',
            'price_per_hour' => 'required|numeric',
            'open_from'     => 'required',
            'open_until'    => 'required',
            'equipments'    => 'required|string',
        ]);

        try {
            $this->stadiumService->createStadium($validated);
            return redirect()->route('admin.pitches');
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, Stadium $stadium)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:100',
            'status'            => 'required|in:available,reserved,unavailable',
            'price_per_hour'    => 'required|numeric',
            'note'              => 'nullable|string|max:500',
            'open_from'         => 'required|date_format:H:i',
            'open_until'        => 'required|date_format:H:i|after:open_from',
            'unavailable_from'  => 'required_if:status,unavailable|nullable|date',
            'unavailable_until' => 'required_if:status,unavailable|nullable|date|after_or_equal:unavailable_from',
        ]);

        try {
            $this->stadiumService->updateStadium($stadium, $validated);
            return back()->with('success', 'Stadium updated successfully, and the reservations for that period are cancelled.');
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function destroy(Stadium $stadium)
    {
        $this->stadiumService->deleteStadium($stadium);
        return redirect()->route('admin.dashboard');
    }
}
