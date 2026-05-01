<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use App\Models\City;
use Illuminate\Http\Request;

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

    public function addStaduim(Request $request)
    {

        $stadiumData = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'adress' => 'required|string',
            'capacity' => 'required|integer',
            'description' => 'nullable',
            'equipments' => 'nullable',
            'status' => 'required|string',
            'price_per_hour' => 'required|numeric',
            'stadium_image_url' => 'required|string',
        ]);

        try {

            Stadium::create($stadiumData);

            return redirect()->route('home');
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function editStaduim(Request $request)
    {

        $stadiumData = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'adress' => 'required|string',
            'capacity' => 'required|integer',
            'description' => 'nullable',
            'equipments' => 'nullable',
            'status' => 'required|string',
            'price_per_hour' => 'required|numeric',
            'stadium_image_url' => 'required|string',
        ]);

        try {

            Stadium::findOrFail($request->id)->update($stadiumData);
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function removeStadium(Stadium $stadium)
    {

        $stadium->delete();
        return redirect()->route('home');
    }
}
