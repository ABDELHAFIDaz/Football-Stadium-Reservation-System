<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{

    public function index()
    {
        $admin = Auth::user();

        return view('admin.adminDashboard', compact('admin'));
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
}
