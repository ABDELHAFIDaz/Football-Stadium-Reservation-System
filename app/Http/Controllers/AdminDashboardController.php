<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Stadium;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{

    public function index()
    {
        $admin = Auth::user();

        $users = User::where('role', '!=', 'admin')->orderby('created_at', 'desc')->limit(4)->get();

        $pitches = Stadium::orderby('created_at', 'desc')->limit(6)->get();

        $customersCounter = User::where('role', 'customer')->count();
        $managersCounter = User::where('role', 'manager')->count();
        $pitchesCounter = Stadium::count();
        $reservationsCounter = Reservation::where('status', 'ended')->count();

        return view('admin.adminDashboard', compact('admin', 'users', 'pitches', 'customersCounter', 'managersCounter', 'pitchesCounter', 'reservationsCounter'));
    }


    public function users(Request $request)
    {
        $admin = Auth::user();

        $query = User::where('role', '!=', 'admin');

        // 1. Search by Name
        $query->when($request->search, function ($q) use ($request) {
            return $q->where('fullname', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        });

        // 2. Filter by Status (Banned or Not)
        $query->when($request->status, function ($q) use ($request) {
            if ($request->status === 'banned') return $q->where('is_banned', true);
            if ($request->status === 'active') return $q->where('is_banned', false);
        });

        // 3. Sorting
        $sort = $request->sort === 'oldest' ? 'asc' : 'desc';
        $query->orderBy('created_at', $sort);

        $users = $query->paginate(10)->withQueryString();

        return view('admin.users', compact('users', 'admin'));
    }

    public function toggleBan(User $user)
    {

        if ($user->role === 'admin') {
            return back()->with('error', "Administrators cannot be banned.");
        }

        // Toggle the boolean
        $user->is_banned = !$user->is_banned;
        $user->save();

        $status = $user->is_banned ? 'banned' : 'unbanned';
        return back()->with('success', "User has been successfully {$status}.");
    }

    public function storeManager(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|min:8|max:255',
        ]);

        User::create([
            'fullname' => $validated['fullname'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
            'role' => 'manager',
            'is_adult' => true,
            'is_banned' => false,
        ]);

        return back()->with('success', 'Manager account created successfully.');
    }
}
