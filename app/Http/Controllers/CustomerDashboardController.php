<?php

namespace App\Http\Controllers;

use App\Services\CustomerDashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function __construct(private CustomerDashboardService $customerDashboardService) {}

    public function index(Request $request)
    {
        $customerId       = Auth::id();
        $customer         = Auth::user();
        $reservations = $this->customerDashboardService->getFilteredReservations($customerId, $request);
        $stats        = $this->customerDashboardService->getStats($customerId);
        $favoriteStadiums = $this->customerDashboardService->getFavoriteStadiums($customerId);

        return view('userDashboard', array_merge(
            ['user' => $customer, 'reservations' => $reservations, 'favoriteStadiums' => $favoriteStadiums],
            $stats
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email'        => 'required|email|unique:users,email,' . Auth::id(),
            'phone_number' => 'required|string|max:20',
        ]);

        $this->customerDashboardService->updateProfile(Auth::user(), $request->only('email', 'phone_number'));

        return back()->with('success', 'Profile updated successfully!');
    }
}