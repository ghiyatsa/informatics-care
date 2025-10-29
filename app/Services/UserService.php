<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Get all users with reports count
     */
    public function getAllUsers(int $perPage = 20): LengthAwarePaginator
    {
        return User::withCount('reports')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Create a new user
     */
    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'student_id' => $data['student_id'] ?? null,
            'email_verified_at' => now(),
        ]);
    }

    /**
     * Update user
     */
    public function updateUser(User $user, array $data): User
    {
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'student_id' => $data['student_id'] ?? null,
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);
        return $user->fresh();
    }

    /**
     * Delete user (cannot delete self)
     */
    public function deleteUser(User $user, User $currentUser): bool
    {
        if ($user->id === $currentUser->id) {
            throw new \Exception('Anda tidak dapat menghapus akun sendiri!');
        }

        return $user->delete();
    }

    /**
     * Get user with reports
     *
     * @return array{user: User, reports: \Illuminate\Contracts\Pagination\LengthAwarePaginator}
     */
    public function getUserWithReports(User $user, int $perPage = 10): array
    {
        $user->loadCount('reports');
        $reports = $user->reports()
            ->with('category')
            ->latest()
            ->paginate($perPage);

        return [
            'user' => $user,
            'reports' => $reports,
        ];
    }
}

