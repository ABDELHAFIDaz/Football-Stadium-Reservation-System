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
}
