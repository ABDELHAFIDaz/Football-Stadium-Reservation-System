<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Stadium;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct(private ReservationService $reservationService) {}

    public function book(Stadium $stadium)
    {
        $manager      = $this->reservationService->getStadiumManager($stadium);
        $openingHours = $this->reservationService->formatOpeningHours($stadium);
        $date         = today()->toDateString();

        return view('bookPitche', compact('stadium', 'openingHours', 'manager', 'date'));
    }

    public function slots(Stadium $stadium, Request $request)
    {
        $date  = $request->input('date', today()->toDateString());
        $slots = $this->reservationService->buildSlots($stadium, $date);

        return response()->json($slots);
    }

    public function store(Stadium $stadium, Request $request)
    {
        if (!$request->start_time) {
            return back()->with('error', 'Please select a slot first.');
        }

        $request->validate([
            'date'       => 'required|date|after_or_equal:today',
            'start_time' => 'required',
        ]);

        if ($this->reservationService->isSlotTaken($stadium->id, $request->date, $request->start_time)) {
            return back()->with('error', 'This slot was just taken! Please pick another one.');
        }

        $this->reservationService->createReservation($stadium, Auth::id(), $request->date, $request->start_time);

        return redirect()
            ->route('stadium.book', $stadium->id)
            ->with('success', 'Slot reservation is sent to the owner ✅');
    }

    public function cancel(Reservation $reservation)
    {
        $this->reservationService->cancel($reservation);
        return back();
    }

    public function confirm(Reservation $reservation)
    {
        $this->reservationService->confirm($reservation);
        return back();
    }

    public function update(Reservation $reservation, Request $request)
    {
        if ($reservation->customerId !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'date'       => 'required|date|after_or_equal:today',
            'start_time' => 'required',
        ]);

        if ($this->reservationService->isSlotTaken($reservation->stadium_id, $request->date, $request->start_time, $reservation->id)) {
            return back()->with('error', 'This slot is already taken. Please pick another one.');
        }

        if ($this->reservationService->isSameSlot($reservation, $request->date, $request->start_time)) {
            return redirect()->route('user.dashboard')->with('info', 'No changes were made to the reservation.');
        }

        $this->reservationService->updateReservation($reservation, $request->date, $request->start_time);

        return redirect()->route('user.dashboard')->with('success', 'Reservation updated successfully! ✅');
    }
}