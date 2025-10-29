<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\GoogleAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function __construct(
        protected GoogleAuthService $googleAuthService
    ) {}

    /**
     * Redirect the user to Google OAuth
     */
    public function redirectToGoogle()
    {
        return $this->googleAuthService->redirectToGoogle();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $user = $this->googleAuthService->handleGoogleCallback();
            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            $errorMessage = $this->googleAuthService->handleException($e);

            return redirect('/login')->with('error', $errorMessage);
        }
    }
}
