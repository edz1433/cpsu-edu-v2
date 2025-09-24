<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle($jobId)
    {
        // Save jobId in session before redirecting to Google
        session(['job_id' => $jobId]);

        return Socialite::driver('google')->redirect();
    }

public function handleGoogleCallback(Request $request)
{
    try {
        // 🟢 Step 1: Check if Socialite config is correct
        if (!config('services.google.client_id') || !config('services.google.redirect')) {
            \Log::error('Google config missing', [
                'client_id' => config('services.google.client_id'),
                'redirect'  => config('services.google.redirect'),
            ]);
            return redirect()->route('login')->with('error', 'Google config is missing.');
        }

        // 🟢 Step 2: Try to get user from Google
        try {
            $google_user = Socialite::driver('google')->user();
        } catch (\Exception $ex) {
            \Log::error('Google OAuth failed', ['exception' => $ex->getMessage()]);
            return redirect()->route('login')->with('error', 'Failed to authenticate with Google.');
        }

        // 🟢 Step 3: Store user info in session
        session([
            'google_id'     => $google_user->getId(),
            'google_name'   => $google_user->getName(),
            'google_email'  => $google_user->getEmail(),
            'google_avatar' => $google_user->getAvatar(),
            'logged_in'     => true,
        ]);

        // 🟢 Step 4: Retrieve jobId
        $jobId = session('job_id');
        session()->forget('job_id');

        // Log for debugging
        \Log::info('Google login success', [
            'google_id' => $google_user->getId(),
            'job_id'    => $jobId,
        ]);

        // 🟢 Step 5: Redirect
        if ($jobId) {
            return redirect()->route('jobApplicationForm', ['id' => $jobId]);
        }

        return redirect()->route('dashboard'); // fallback

    } catch (\Exception $e) {
        \Log::error('Google login exception', ['exception' => $e->getMessage()]);
        return redirect()->route('login')->with('error', 'Google login failed. Please try again.');
    }
}


}
