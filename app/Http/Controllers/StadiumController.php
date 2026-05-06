<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStadiumRequest;
use App\Http\Requests\UpdateStadiumRequest;
use App\Models\City;
use App\Models\Stadium;
use App\Services\StadiumService;
use Illuminate\Http\Request;


class StadiumController extends Controller
{
    public function __construct(private StadiumService $stadiumService) {}

    public function index(Request $request)
    {
        $stadiums = $this->stadiumService->getFilteredStadiums($request);
        $cities   = City::all();

        return view('pitches', compact('stadiums', 'cities'));
    }

    public function store(StoreStadiumRequest $request)
    {

        try {

            $this->stadiumService->createStadium($request->validated());
            return redirect()->route('admin.pitches');

        } catch (\Exception) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function update(UpdateStadiumRequest $request, Stadium $stadium)
    {

        try {

            $this->stadiumService->updateStadium($stadium, $request->validated());
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
