<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'regex', "/$keyword/i")
                  ->orWhere('email', 'regex', "/$keyword/i")
                  ->orWhere('role', 'regex', "/$keyword/i")
                  ->orWhere('location', 'regex', "/$keyword/i");
            });
        }

        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'farmer') {
            return back()->with('error', 'Only farmer accounts can be verified.');
        }

        $user->is_verified = !$user->is_verified;
        $user->save();

        $status = $user->is_verified ? 'verified' : 'unverified';

        // Notify farmer
        Notification::create([
            'user_id' => $user->id,
            'type' => 'system',
            'title' => $user->is_verified ? 'Account Verified!' : 'Verification Suspended',
            'message' => $user->is_verified 
                ? 'Congratulations! Your farmer profile has been verified by the administrator. A verification badge has been added to your profile.'
                : 'Your profile verification status has been suspended by the administrator. Please contact support.',
            'is_read' => false,
        ]);

        return back()->with('success', 'Farmer ' . $user->name . ' is now ' . $status . '.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Delete user's products if they are a farmer
        if ($user->role === 'farmer') {
            \App\Models\Product::where('farmer_id', $user->id)->delete();
        }

        $user->delete();

        return back()->with('success', 'User account and associated records deleted.');
    }
}
