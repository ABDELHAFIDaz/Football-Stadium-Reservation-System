<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $managerId = Auth::id();

        // Statistics
        $stats = [
            'ended' => Reservation::whereHas('stadium', fn($q) => $q->where('managerId', $managerId))
                ->where('status', 'ended')->count(),
            'confirmed' => Reservation::whereHas('stadium', fn($q) => $q->where('managerId', $managerId))
                ->where('status', 'confirmed')->count(),
            'pending' => Reservation::whereHas('stadium', fn($q) => $q->where('managerId', $managerId))
                ->where('status', 'pending')->count(),
            'total_earned' => Reservation::whereHas('stadium', fn($q) => $q->where('managerId', $managerId))
                ->where('status', 'ended')->sum('total_price'),
        ];

        // Recent Data
        $reservations = Reservation::whereHas('stadium', fn($q) => $q->where('managerId', $managerId))
            ->latest()->take(5)->get();

        $stadiums = Stadium::where('managerId', $managerId)->limit(3)->get();

        return view('manager.managerDashboard', compact('stats', 'reservations', 'stadiums'));
    }


    public function reservations(Request $request)
    {
        $managerId = Auth::id();

        $query = Reservation::whereHas('stadium', function ($q) use ($managerId) {
            $q->where('managerId', $managerId);
        })->with(['user', 'stadium']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('stadium_id')) {
            $query->where('stadium_id', $request->stadium_id);
        }

        $sortOrder = $request->get('sort', 'newest') === 'oldest' ? 'asc' : 'desc';
        $query->orderBy('reservation_date', $sortOrder)
            ->orderBy('start_time', $sortOrder);

        $reservations = $query->paginate(10)->withQueryString();
        $myStadiums = Stadium::where('managerId', $managerId)->get();

        return view('manager.reservations', compact('reservations', 'myStadiums'));
    }
}
