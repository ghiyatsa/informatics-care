<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\StoreReportRequest;
use App\Models\Category;
use App\Services\ReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {}

    /**
     * Show the form for creating a new report
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('reports.create', compact('categories'));
    }

    /**
     * Store a newly created report
     */
    public function store(StoreReportRequest $request): RedirectResponse
    {
        $report = $this->reportService->createReport(
            Auth::user(),
            $request->validated()
        );

        return redirect()
            ->route('dashboard')
            ->with('success', 'Laporan berhasil dibuat!');
    }

    /**
     * Display the user's reports
     */
    public function myReports(): View
    {
        $reports = $this->reportService->getUserReports(Auth::user());

        return view('reports.my', compact('reports'));
    }

    /**
     * Delete a report (user can only delete their own reports)
     */
    public function destroy(Report $report): RedirectResponse
    {
        try {
            $this->reportService->deleteReport($report, Auth::user());

            return redirect()
                ->route('reports.my')
                ->with('success', 'Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
