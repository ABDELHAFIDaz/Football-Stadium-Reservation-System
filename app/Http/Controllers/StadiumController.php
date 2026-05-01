<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use App\Models\City;
use Illuminate\Http\Request;

class StadiumController extends Controller
{
    public function showStadiums()
    {

        $stadiums = Stadium::paginate(9);
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
