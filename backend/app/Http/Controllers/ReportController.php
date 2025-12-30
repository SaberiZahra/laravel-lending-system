<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return Report::with([
            'reporter',
            'targetUser',
            'targetItem',
            'targetListing',
            'targetLoan'
        ])
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function show(Report $report)
    {
        return $report->load([
            'reporter',
            'targetUser',
            'targetItem',
            'targetListing',
            'targetLoan'
        ]);
    }

    public function updateStatus(Request $request, Report $report)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,resolved,rejected',
        ]);

        $report->update($data);

        return response()->json([
            'message' => 'Report status updated',
            'report' => $report
        ]);
    }
}
