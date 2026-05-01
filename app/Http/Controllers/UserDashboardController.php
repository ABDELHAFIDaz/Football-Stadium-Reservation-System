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
    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $query = Auth::user()->reservations()->with('stadium');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->sort === 'asc') 
            $query->orderBy('created_at', 'asc');
        else
            $query->orderBy('created_at', 'desc');
        

        $reservations = $query->paginate(4)->appends($request->query());

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
            ->whereMonth('reservation_date', now()->month)
            ->whereYear('reservation_date', now()->year)
            ->count();

        $favoriteStadiums = Stadium::withCount([
            'reservations as my_bookings_count' => function ($q) {
                $q->where('customerId', Auth::id())
                    ->whereIn('status', ['confirmed', 'ended']);
            }
        ])
            ->orderBy('my_bookings_count', 'desc')
            ->take(3)
            ->get();

        return view('userDashboard', compact(
            'user',
            'reservations',
            'reservationsCounter',
            'thisMonthReservations',
            'totalSpent',
            'pendingReservationCounter',
            'favoriteStadiums'
        ));
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
