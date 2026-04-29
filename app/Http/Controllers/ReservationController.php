<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{


    public function book(Stadium $stadium)
    {
        $manager = User::findOrFail($stadium->managerId);

        $openHour  = $stadium->open_from->hour;
        $closeHour = $stadium->open_until->hour;
        $openingHours = sprintf('%02d:00 - %02d:00', $openHour, $closeHour);

        $date = today()->toDateString();

        return view('bookPitche', compact('stadium', 'openingHours', 'manager', 'date'));
    }



    public function slots(Stadium $stadium, Request $request)
    {
        $date = $request->input('date', today()->toDateString()); // the input method retreives one value of the key that match the first param, if it did not find it, she goes with the default wich is the second param

        $bookedTimes = Reservation::where('stadium_id', $stadium->id)
            ->where('reservation_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('start_time')
            ->map(fn($time) => $time->format('H:i'))
            ->toArray();

        $openHour  = $stadium->open_from->hour;
        $closeHour = $stadium->open_until->hour;

        $slots = [];

        for ($hour = $openHour; $hour < $closeHour; $hour++) {
            $time      = sprintf('%02d:00', $hour);
            $timeRange = sprintf('%02d:00 - %02d:00', $hour, $hour + 1);

            $slots[] = [
                'label'  => $timeRange,
                'time'   => $time,
                'booked' => in_array($time, $bookedTimes),
            ];
        }

        return response()->json($slots);
    }
}
