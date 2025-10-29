<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReportStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateReportStatusRequest;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {}

    /**
     * Display a listing of all reports
     */
    public function index(): View
    {
        $reports = $this->reportService->getAllReports();

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show a specific report
     */
    public function show(Report $report): \Illuminate\Http\JsonResponse
    {
        $report->load(['user', 'category']);

        return response()->json([
            'report' => [
                'id' => $report->id,
                'title' => $report->title,
                'description' => $report->description,
                'location' => $report->location,
                'status' => $report->status->value,
                'admin_response' => $report->admin_response,
                'created_at' => $report->created_at->toIso8601String(),
                'updated_at' => $report->updated_at ? $report->updated_at->toIso8601String() : null,
                'user' => [
                    'name' => $report->user->name,
                    'email' => $report->user->email,
                ],
                'category' => [
                    'name' => $report->category->name,
                ],
            ],
        ]);
    }

    /**
     * Update the status of a report
     */
    public function updateStatus(UpdateReportStatusRequest $request, Report $report): RedirectResponse
    {
        $validated = $request->validated();

        $this->reportService->updateStatus(
            $report,
            ReportStatus::from($validated['status']),
            $validated['admin_response'] ?? null
        );

        return redirect()
            ->back()
            ->with('success', 'Status laporan berhasil diupdate!');
    }

    /**
     * Delete a report (admin can delete any report)
     */
    public function destroy(Report $report): RedirectResponse
    {
        try {
            $this->reportService->deleteReport($report);

            return redirect()
                ->route('admin.reports.index')
                ->with('success', 'Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
