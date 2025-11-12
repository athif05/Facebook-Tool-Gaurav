<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show user profile
     */
    public function show()
    {
        return view('profile.show');
    }

    /**
     * Show change password form
     */
    public function password()
    {
        return view('profile.password');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        // Validate
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'The current password is incorrect.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Update password
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}