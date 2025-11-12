<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        //return view('auth.reset-password', ['request' => $request]);
        return view('auth.reset-password', [
            'token' => $request->route('token'),
            'email' => $request->email
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        // Debug - Remove after testing
        \Log::info('Password Reset Request:', [
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'match' => $request->password === $request->password_confirmation,
        ]);

        // Try validation
        try {
            $validated = $request->validate([
                'token' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            
            \Log::info('Validation PASSED');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation FAILED:', $e->errors());
            throw $e;
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        // Reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        \Log::info('Password Reset Status: ' . $status);

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status)) //success message
            : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]); //Error message
    }
}
