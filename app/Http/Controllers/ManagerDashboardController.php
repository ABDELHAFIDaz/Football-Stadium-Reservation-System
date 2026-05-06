<?php

namespace App\Http\Controllers;

use App\Services\ManagerDashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{
    public function __construct(private ManagerDashboardService $dashboardService) {}

    public function index()
    {
        $managerId    = Auth::id();
        $stats        = $this->dashboardService->getStats($managerId);
        $reservations = $this->dashboardService->getRecentReservations($managerId);
        $stadiums     = $this->dashboardService->getStadiumPreview($managerId);

        return view('manager.managerDashboard', compact('stats', 'reservations', 'stadiums'));
    }

    public function reservations(Request $request)
    {
        $managerId    = Auth::id();
        $reservations = $this->dashboardService->getFilteredReservations($managerId, $request);
        $myStadiums   = $this->dashboardService->getAllStadiums($managerId);

        return view('manager.reservations', compact('reservations', 'myStadiums'));
    }

    public function stadiums(Request $request)
    {
        $managerId = Auth::id();
        $stadiums  = $this->dashboardService->getFilteredStadiums($managerId, $request);

        return view('manager.stadiums', compact('stadiums'));
    }
}