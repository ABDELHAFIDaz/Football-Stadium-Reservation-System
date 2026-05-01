<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $reservations = Auth::user()->reservations()->with('stadium')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $reservationsCounter = Reservation::where('customerId', Auth::id())
            ->whereIn('status', ['confirmed', 'ended'])
            ->count();

        $pendingReservationCounter = Reservation::where('customerId', Auth::id())
            ->where('status', 'pending')
            ->count();

        $totalSpent = Reservation::where('customerId', Auth::id())
            ->whereIn('status', ['confirmed', 'ended'])
            ->sum('total_price');

        $thisMonthReservations = Reservation::where('customerId', Auth::id())
            ->whereIn('status', ['confirmed', 'ended'])
            ->whereMonth('reservation_date', Carbon::now()->month)
            ->whereYear('reservation_date', Carbon::now()->year)
            ->count();

        $favoriteStadiums = Stadium::withCount([
            'reservations as my_bookings_count' => function ($query) {
                $query->where('customerId', Auth::id())
                    ->whereIn('status', ['confirmed', 'ended']);
            }
        ])
            ->orderBy('my_bookings_count', 'desc')
            ->take(3)
            ->get();


        return view('userDashboard', compact('user', 'reservations', 'reservationsCounter', 'thisMonthReservations', 'totalSpent', 'pendingReservationCounter', 'favoriteStadiums'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone_number' => 'required|string|max:20',
        ]);

        $user = Auth::user();
        $user->update([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }
}
