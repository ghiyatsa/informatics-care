<?php

namespace App\Services\Auth;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthService
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(): User
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Validate domain
            $this->validateDomain($googleUser->email);

            // Find or create user
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = $this->createUserFromGoogle($googleUser);
            }

            return $user;
        } catch (\Exception $e) {
            Log::error('Google OAuth Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Validate email domain
     */
    protected function validateDomain(string $email): void
    {
        $emailDomain = substr(strrchr($email, '@'), 1);
        $isUnimalDomain = str_ends_with($emailDomain, 'unimal.ac.id');

        if (!$isUnimalDomain) {
            throw new \Exception('Email harus menggunakan domain Universitas Malikussaleh. Domain Anda: ' . $emailDomain);
        }
    }

    /**
     * Create user from Google account
     */
    protected function createUserFromGoogle($googleUser): User
    {
        $studentId = $this->extractStudentId($googleUser->email);

        return User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => Hash::make(uniqid()),
            'email_verified_at' => now(),
            'role' => UserRole::User->value,
            'student_id' => $studentId,
        ]);
    }

    /**
     * Extract student ID from email
     * Format: nim@students.unimal.ac.id
     */
    protected function extractStudentId(string $email): ?string
    {
        if (preg_match('/^(\w+)@/', $email, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Handle OAuth exceptions
     */
    public function handleException(\Exception $e): string
    {
        if (str_contains($e->getMessage(), 'organization') || str_contains($e->getMessage(), 'Access blocked')) {
            return 'Email Anda belum terdaftar sebagai Test User di Google Cloud Console. Silakan hubungi admin atau gunakan email/password untuk login.';
        }

        return 'Gagal login dengan Google: ' . $e->getMessage() . '. Silakan gunakan email dan password.';
    }
}

