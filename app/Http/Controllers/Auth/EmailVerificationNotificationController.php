<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        // Check if user is authenticated
        if ($request->user()) {
            if ($request->user()->hasVerifiedEmail()) {
                return redirect()->intended('/dashboard');
            }
            
            $request->user()->sendEmailVerificationNotification();
        } else {
            // For non-authenticated users who need to resend
            $userId = session('unverified_user_id');
            if ($userId) {
                $user = User::find($userId);
                if ($user && !$user->hasVerifiedEmail()) {
                    $user->sendEmailVerificationNotification();
                }
            }
        }

        return back()->with('status', 'verification-link-sent');
    }
}
