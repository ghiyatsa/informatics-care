<?php

use App\Http\Controllers\Reports\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('reports')->middleware(['auth'])->group(function () {
    Route::get('/create', [ReportController::class, 'create'])
        ->name('reports.create');
    Route::post('/create', [ReportController::class, 'store'])
        ->name('reports.store');
    Route::get('/my-reports', [ReportController::class, 'myReports'])
        ->name('reports.my');
    Route::delete('/{report}', [ReportController::class, 'destroy'])
        ->name('reports.destroy');
});

