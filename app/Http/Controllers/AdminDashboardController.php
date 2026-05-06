<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManagerRequest;
use App\Models\City;
use App\Models\User;
use App\Services\AdminDashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct(private AdminDashboardService $adminDashboardService) {}

    public function index()
    {
        $admin = Auth::user();
        $data  = $this->adminDashboardService->getDashboardData();

        return view('admin.adminDashboard', array_merge(['admin' => $admin], $data));
    }

    public function users(Request $request)
    {
        $admin = Auth::user();
        $users = $this->adminDashboardService->getFilteredUsers($request);

        return view('admin.users', compact('users', 'admin'));
    }

    public function toggleBan(User $user)
    {
        try {
            $status = $this->adminDashboardService->toggleBan($user);
            return back()->with('success', "User has been successfully {$status}.");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function storeManager(StoreManagerRequest $request)
    {

        $this->adminDashboardService->createManager($request->validated());

        return back()->with('success', 'Manager account created successfully.');
    }

    public function pitches(Request $request)
    {
        $pitches  = $this->adminDashboardService->getAdminFilteredStadiums($request);
        $cities   = City::all();
        $managers = $this->adminDashboardService->getManagers();
        $admin    = Auth::user();

        return view('admin.pitches', compact('pitches', 'cities', 'managers', 'admin'));
    }
}
