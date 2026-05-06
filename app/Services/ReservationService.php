<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Stadium;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationService
{
    // for bookings

    public function isSlotTaken(int $stadiumId, string $date, string $startTime, ?int $excludeReservationId = null)
    {
        return Reservation::where('stadium_id', $stadiumId)
            ->where('reservation_date', $date)
            ->where('start_time', $startTime)
            ->whereIn('status', ['pending', 'confirmed'])
            ->when($excludeReservationId, fn($q) => $q->where('id', '!=', $excludeReservationId))
            ->exists();
    }

    public function buildSlots(Stadium $stadium, string $date)
    {
        $openHour    = $stadium->open_from->hour;
        $closeHour   = $stadium->open_until->hour;
        $bookedTimes = $this->getBookedTimes($stadium, $date);

        if (Carbon::parse($date)->isToday()) {
            $bookedTimes = $this->markPastSlotsAsBooked($bookedTimes, $openHour, $closeHour);
        }

        return $this->generateSlots($openHour, $closeHour, $bookedTimes);
    }

    public function createReservation(Stadium $stadium, int $customerId, string $date, string $startTime)
    {
        return Reservation::create([
            'stadium_id'       => $stadium->id,
            'customerId'       => $customerId,
            'reservation_date' => $date,
            'start_time'       => $startTime,
            'end_time'         => $this->addOneHour($startTime),
            'total_price'      => $stadium->price_per_hour,
            'status'           => 'pending',
        ]);
    }

    public function updateReservation(Reservation $reservation, string $date, string $startTime)
    {
        $reservation->update([
            'reservation_date' => $date,
            'start_time'       => $startTime,
            'end_time'         => $this->addOneHour($startTime),
            'status'           => 'pending',
        ]);
    }

    public function isSameSlot(Reservation $reservation, string $date, string $startTime)
    {
        return $reservation->reservation_date->toDateString() === $date
            && $reservation->start_time->format('H:i') === $startTime;
    }

    public function cancel(Reservation $reservation)
    {
        if (in_array($reservation->status, ['pending', 'confirmed'])) {
            $reservation->update(['status' => 'canceled']);
        }
    }

    public function confirm(Reservation $reservation)
    {
        if ($reservation->status === 'pending') {
            $reservation->update(['status' => 'confirmed']);
        }
    }

    public function cancelConflictingReservations(Stadium $stadium, string $from, string $until)
    {
        Reservation::where('stadium_id', $stadium->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->whereBetween('reservation_date', [$from, $until])
            ->update(['status' => 'canceled']);
    }

    // for the manager dashboard

    public function getManagerStats(int $managerId)
    {
        return [
            'ended'        => $this->managerReservations($managerId)->where('status', 'ended')->count(),
            'confirmed'    => $this->managerReservations($managerId)->where('status', 'confirmed')->count(),
            'pending'      => $this->managerReservations($managerId)->where('status', 'pending')->count(),
            'total_earned' => $this->managerReservations($managerId)->where('status', 'ended')->sum('total_price'),
        ];
    }

    public function getRecentManagerReservations(int $managerId)
    {
        return $this->managerReservations($managerId)->latest()->take(5)->get();
    }

    public function getFilteredManagerReservations(int $managerId, Request $request)
    {
        $sortOrder = $request->get('sort', 'newest') === 'oldest' ? 'asc' : 'desc';

        return $this->managerReservations($managerId)
            ->with(['user', 'stadium'])
            ->when($request->filled('status'),     fn($q) => $q->where('status', $request->status))
            ->when($request->filled('stadium_id'), fn($q) => $q->where('stadium_id', $request->stadium_id))
            ->orderBy('reservation_date', $sortOrder)
            ->orderBy('start_time', $sortOrder)
            ->paginate(10)
            ->withQueryString();
    }


    public function getStadiumManager(Stadium $stadium)
    {
        return User::findOrFail($stadium->managerId);
    }

    public function formatOpeningHours(Stadium $stadium)
    {
        $openHour  = $stadium->open_from->hour;
        $closeHour = $stadium->open_until->hour;

        return sprintf('%02d:00 - %02d:00', $openHour, $closeHour);
    }

    // for the customer dashboard

    public function getCustomerStats(int $customerId)
    {
        return [
            'reservationsCounter'      => $this->customerReservations($customerId)->whereIn('status', ['confirmed', 'ended'])->count(),
            'pendingReservationCounter' => $this->customerReservations($customerId)->where('status', 'pending')->count(),
            'totalSpent'               => $this->customerReservations($customerId)->whereIn('status', ['confirmed', 'ended'])->sum('total_price'),
            'thisMonthReservations'    => $this->customerReservations($customerId)
                ->whereIn('status', ['confirmed', 'ended'])
                ->whereMonth('reservation_date', now()->month)
                ->whereYear('reservation_date', now()->year)
                ->count(),
        ];
    }

    public function getFilteredCustomerReservations(int $customerId, Request $request)
    {
        $sortOrder = $request->sort === 'asc' ? 'asc' : 'desc';

        return $this->customerReservations($customerId)
            ->with('stadium')
            ->when(
                $request->filled('status') && $request->status !== 'all',
                fn($q) => $q->where('status', $request->status)
            )
            ->orderBy('created_at', $sortOrder)
            ->paginate(4)
            ->appends($request->query());
    }


    private function managerReservations(int $managerId)
    {
        return Reservation::whereHas('stadium', fn($q) => $q->where('managerId', $managerId));
    }

    private function customerReservations(int $customerId)
    {
        return Reservation::where('customerId', $customerId);
    }

    private function getBookedTimes(Stadium $stadium, string $date)
    {
        return Reservation::where('stadium_id', $stadium->id)
            ->where('reservation_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('start_time')
            ->map(fn($time) => Carbon::parse($time)->format('H:i'))
            ->toArray();
    }

    private function markPastSlotsAsBooked(array $bookedTimes, int $openHour, int $closeHour)
    {
        $now = Carbon::now();

        for ($hour = $openHour; $hour <= $closeHour; $hour++) {
            $slotTime = Carbon::today()->setHour($hour)->setMinute(0);

            if ($slotTime->isPast() || $slotTime->isBefore($now->copy()->addHour())) {
                $bookedTimes[] = $slotTime->format('H:i');
            }
        }

        return array_unique($bookedTimes);
    }

    private function generateSlots(int $openHour, int $closeHour, array $bookedTimes)
    {
        $slots = [];

        for ($hour = $openHour; $hour < $closeHour; $hour++) {
            $time    = sprintf('%02d:00', $hour);
            $slots[] = [
                'label'  => sprintf('%02d:00 - %02d:00', $hour, $hour + 1),
                'time'   => $time,
                'booked' => in_array($time, $bookedTimes),
            ];
        }

        return $slots;
    }

    private function addOneHour(string $time)
    {
        return date('H:i', strtotime($time . ' +1 hour'));
    }
}
