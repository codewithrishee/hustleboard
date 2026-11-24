<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Job;
use App\Models\OutreachLog;
use App\Models\DailyActivity;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Date filter
        $from = $request->input(
            'from',
            Carbon::now()->startOfMonth()->toDateString()
        );

        $to = $request->input(
            'to',
            Carbon::now()->toDateString()
        );

        // Validate date range
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
        ]);

        // Leads
        $leads = Lead::whereBetween('created_at', [
            Carbon::parse($from)->startOfDay(),
            Carbon::parse($to)->endOfDay()
        ])->get();

        $totalLeads = $leads->count();
        $leadStages = $leads->groupBy('status')
            ->map(fn ($items) => $items->count());

        // Job Applications
        $jobs = Job::whereBetween('applied_date', [$from, $to])->get();

        $totalJobs = $jobs->count();
        $jobStages = $jobs->groupBy('status')
            ->map(fn ($items) => $items->count());

        // Outreach
        $outreach = OutreachLog::whereBetween('contacted_at', [
            Carbon::parse($from)->startOfDay(),
            Carbon::parse($to)->endOfDay()
        ])->get();

        $totalOutreach = $outreach->count();

        $replies = $outreach->whereIn('response_status', [
            'Replied',
            'Interested'
        ])->count();

        $responseRate = $totalOutreach > 0
            ? round(($replies / $totalOutreach) * 100, 1)
            : 0;

        $outreachStages = $outreach->groupBy('response_status')
            ->map(fn ($items) => $items->count());

        // Transactions
        $transactions = Transaction::whereBetween(
            'transaction_date',
            [$from, $to]
        )->get();

        $totalIncome = $transactions
            ->where('type', 'income')
            ->where('payment_status', 'Received')
            ->sum('amount');

        $pendingIncome = $transactions
            ->where('type', 'income')
            ->whereIn('payment_status', ['Pending', 'Partial'])
            ->sum('amount');

        $totalExpenses = $transactions
            ->where('type', 'expense')
            ->sum('amount');

        $netProfit = $totalIncome - $totalExpenses;

        // Daily Activities
        $activities = DailyActivity::whereBetween(
            'activity_date',
            [$from, $to]
        )->get();

        $totalLearning = $activities->sum('learning_minutes');
        $totalMessages = $activities->sum('messages_sent');
        $totalFollowups = $activities->sum('followups_done');

        // Activity chart data
        $activityLabels = $activities
            ->sortBy('activity_date')
            ->pluck('activity_date')
            ->map(fn ($date) => Carbon::parse($date)->format('d M'))
            ->values();

        $activityJobs = $activities
            ->sortBy('activity_date')
            ->pluck('jobs_applied')
            ->values();

        $activityLeads = $activities
            ->sortBy('activity_date')
            ->pluck('leads_added')
            ->values();

        return view('reports.index', compact(
            'from',
            'to',
            'totalLeads',
            'leadStages',
            'totalJobs',
            'jobStages',
            'totalOutreach',
            'replies',
            'responseRate',
            'outreachStages',
            'totalIncome',
            'pendingIncome',
            'totalExpenses',
            'netProfit',
            'totalLearning',
            'totalMessages',
            'totalFollowups',
            'activityLabels',
            'activityJobs',
            'activityLeads'
        ));
    }
}
