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
}
