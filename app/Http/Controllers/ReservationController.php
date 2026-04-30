<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
            ->map(fn($time) => Carbon::parse($time)->format('H:i'))
            ->toArray();


        $openHour  = $stadium->open_from->hour;
        $closeHour = $stadium->open_until->hour;


        if (Carbon::parse($date)->isToday()) {
            $now = Carbon::now();

            for ($hour = $openHour; $hour <= $closeHour; $hour++) {
                $slotTime = Carbon::today()->setHour($hour)->setMinute(0);

                // If the slot time is in the past, add it to the booked list
                if ($slotTime->isPast() || $slotTime->isBefore($now->copy()->addHour())) {
                    $bookedTimes[] = $slotTime->format('H:i');
                }
            }

            $bookedTimes = array_unique($bookedTimes);
        }

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


    // Handle the form submission when a user clicks a slot

    public function store(Stadium $stadium, Request $request)

    {

        if (!$request->start_time) {
            return back()->with('error', 'Please select a slot first.');
        }


        $request->validate([

            'date' => 'required|date|after_or_equal:today',

            'start_time' => 'required',

        ]);



        $startTime = $request->start_time;

        $endTime = date('H:i', strtotime($startTime . ' +1 hour'));



        $alreadyBooked = Reservation::where('stadium_id', $stadium->id)

            ->where('reservation_date', $request->date)

            ->where('start_time', $startTime)

            ->whereIn('status', ['pending', 'confirmed'])

            ->exists();



        // if the slot is already been taken

        if ($alreadyBooked) {

            return back()->with('error', 'This slot was just taken! Please pick another one.');
        }



        Reservation::create([

            'stadium_id' => $stadium->id,

            'customerId' => Auth::id(),

            'reservation_date' => $request->date,

            'start_time' => $startTime,

            'end_time' => $endTime,

            'total_price' => $stadium->price_per_hour,

            'status' => 'pending',

        ]);



        return redirect()

            ->route('stadium.book', $stadium->id)

            ->with('success', 'Slot reservation is sent to the owner ✅');
    }
}
