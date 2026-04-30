<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $reservations = Auth::user()->reservations;

        $reservationsCounter = Reservation::where('customerId', Auth::id())->whereIn('status', ['confirmed', 'ended'])->count();

        $pendingReservationCounter = Reservation::where('customerId', Auth::id())->where('status', 'pending')->count();

        $totalSpent = Reservation::where('customerId', Auth::id())->whereIn('status', ['confirmed', 'ended'])->sum('total_price');

        $thisMonthReservations = Reservation::where('customerId', Auth::id())->whereIn('status', ['confirmed', 'ended'])->whereMonth('reservation_date', Carbon::now()->month)->count();

        return view('userDashboard', compact('user', 'reservations', 'reservationsCounter', 'thisMonthReservations', 'totalSpent', 'pendingReservationCounter'));
    }
}
