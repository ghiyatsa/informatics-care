<?php

namespace App\Services;

use App\Enums\ReportStatus;
use App\Models\Report;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReportService
{
    /**
     * Create a new report
     */
    public function createReport(User $user, array $data): Report
    {
        return Report::create([
            'user_id' => $user->id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'],
            'status' => ReportStatus::Pending->value,
        ]);
    }

    /**
     * Get reports for a specific user
     */
    public function getUserReports(User $user, int $perPage = 10): LengthAwarePaginator
    {
        return Report::where('user_id', $user->id)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get all reports with pagination
     */
    public function getAllReports(int $perPage = 15): LengthAwarePaginator
    {
        return Report::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Update report status
     */
    public function updateStatus(Report $report, ReportStatus $status, ?string $adminResponse = null): Report
    {
        $report->update([
            'status' => $status->value,
            'admin_response' => $adminResponse,
        ]);

        return $report->fresh();
    }
}

