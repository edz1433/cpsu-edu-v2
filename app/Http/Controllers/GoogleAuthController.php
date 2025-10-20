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
    public function applyJob($jobId, $jobTitle)
    {
        session(['job_id' => $jobId]);
        session(['job_title' => $jobTitle]);
        
        return redirect()->route('google.login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $google_user = Socialite::driver('google')->user();
        } catch (\Exception $ex) {
            \Log::error('Google OAuth failed', ['exception' => $ex->getMessage()]);
            return redirect()->route('login')->with('error', 'Failed to authenticate with Google.');
        }

        $fullName = $google_user->getName();
        $nameParts = explode(' ', $fullName, 2);

        $firstName = $nameParts[0] ?? '';
        $lastName  = $nameParts[1] ?? '';

        session([
            'google_id'     => $google_user->getId(),
            'google_name'   => $fullName,
            'google_fname'  => $firstName,
            'google_lname'  => $lastName,
            'google_email'  => $google_user->getEmail(),
            'google_avatar' => $google_user->getAvatar(),
            'logged_in'     => true,
        ]);

        $jobId = session('job_id');

        \Log::info('Google login success', [
            'google_id' => $google_user->getId(),
            'job_id'    => $jobId,
        ]);

        if ($jobId) {
            return redirect()->route('jobApplicationForm');
        }

        return redirect()->route('web-home'); // fallback
    }


}
