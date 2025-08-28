<?php
// app/Http/Controllers/Admin/UserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Apply filters
        if ($request->has('status')) {
            if ($request->status === 'verified') {
                $query->where('is_verified', 1);
            } elseif ($request->status === 'pending') {
                $query->where('is_verified', 0);
            }
        }

        if ($request->has('district')) {
            $query->where('district', $request->district);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%");
            });
        }

        $users = $query->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);
        $user->is_verified = 1;
        $user->save();

        return redirect()->back()->with('success', 'User verified successfully.');
    }

    public function rejectVerification($id)
    {
        $user = User::findOrFail($id);
        $user->is_verified = 0;
        $user->save();

        return redirect()->back()->with('success', 'User verification rejected.');
    }
}
