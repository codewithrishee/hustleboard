@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
/* Dashboard-specific responsive layout */
.dashboard-page {
    width: 100%;
    min-width: 0;
}

.dashboard-page .row > [class*="col-"] {
    min-width: 0;
}

.dashboard-page .hero {
    width: 100%;
    min-width: 0;
}

.dashboard-page .hero > div:first-child {
    min-width: 0;
}

.dashboard-page .hero p,
.dashboard-page .task-row span,
.dashboard-page .stage-row span {
    overflow-wrap: anywhere;
}

.dashboard-page .panel {
    min-width: 0;
}

.dashboard-page .chart-wrap {
    width: 100%;
    min-width: 0;
}

.dashboard-page canvas {
    max-width: 100%;
}

@media (max-width: 767px) {
    .dashboard-page .hero {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 18px;
        padding: 20px;
    }

    .dashboard-page .hero h2 {
        font-size: clamp(20px, 5.5vw, 25px);
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .dashboard-page .hero-focus {
        width: 100%;
        min-width: 0;
        margin: 0;
        padding: 15px 0 0;
        border-left: 0;
        border-top: 1px solid #64836b;
    }

    .dashboard-page .hero-focus label {
        font-size: 12px;
        line-height: 1.5;
    }

    .dashboard-page .stat-card {
        height: 100%;
        min-height: 88px;
        padding: 12px;
        gap: 10px;
    }

    .dashboard-page .stat-icon {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        font-size: 17px;
    }

    .dashboard-page .stat-label {
        font-size: 11px;
        line-height: 1.3;
    }

    .dashboard-page .stat-number {
        font-size: clamp(17px, 4.5vw, 21px);
        line-height: 1.25;
        overflow-wrap: anywhere;
    }

    .dashboard-page .stat-note {
        font-size: 10px;
        line-height: 1.3;
    }

    .dashboard-page .panel {
        padding: 16px !important;
    }

    .dashboard-page .section-title {
        font-size: 15px;
        line-height: 1.35;
    }

    .dashboard-page .task-row {
        align-items: flex-start;
        font-size: 12px;
    }

    .dashboard-page .task-row > span:first-child {
        min-width: 0;
        flex: 1;
    }

    .dashboard-page .task-row > span:last-child {
        flex: 0 0 auto;
        white-space: nowrap;
    }

    .dashboard-page .stage-row {
        font-size: 12px;
    }

    .dashboard-page .chart-wrap {
        height: 210px;
    }

    .dashboard-page #leadChart {
        max-height: 170px;
    }

    .dashboard-page .quick-link {
        white-space: nowrap;
        font-size: 11px;
    }
}

@media (max-width: 480px) {
    .dashboard-page .hero {
        padding: 17px;
        border-radius: 15px;
    }

    .dashboard-page .hero h2 {
        font-size: 20px;
    }

    .dashboard-page .row.g-3 {
        --bs-gutter-x: 10px;
        --bs-gutter-y: 10px;
    }

    .dashboard-page .stat-card {
        min-height: 82px;
        padding: 10px !important;
        gap: 8px;
    }

    .dashboard-page .stat-icon {
        width: 34px;
        height: 34px;
        flex-basis: 34px;
        font-size: 15px;
        border-radius: 10px;
    }

    .dashboard-page .stat-label {
        font-size: 10px;
    }

    .dashboard-page .stat-number {
        font-size: 17px;
        margin: 3px 0;
    }

    .dashboard-page .stat-note {
        font-size: 9px;
    }

    .dashboard-page .panel {
        padding: 13px !important;
        border-radius: 13px;
    }

    .dashboard-page .d-flex.justify-content-between {
        gap: 8px;
    }

    .dashboard-page .chart-wrap {
        height: 190px;
    }

    .dashboard-page .row.align-items-center > .col-5 {
        width: 42%;
    }

    .dashboard-page .row.align-items-center > .col-7 {
        width: 58%;
    }

    .dashboard-page #leadChart {
        max-height: 145px;
    }
}

@media (max-width: 360px) {
    .dashboard-page .row.align-items-center > .col-5,
    .dashboard-page .row.align-items-center > .col-7 {
        width: 100%;
    }

    .dashboard-page #leadChart {
        max-height: 180px;
    }

    .dashboard-page .stat-card {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
@endpush

@section('content')
<div class="dashboard-page">

<div class="hero">
    <div>
        <h2>Good Afternoon, Vijay 👋</h2>
        <p class="mb-0 text-light opacity-75">Stay consistent. Hunt, Apply, Learn and Build.</p>
    </div>

    <div class="hero-focus">
        <h5 class="fw-bold mb-3"><i class="fa-solid fa-bullseye text-success me-2"></i>Today's Focus</h5>
        <label><i class="fa-regular fa-square-check text-success me-2"></i> Job Applications (3–5)</label>
        <label><i class="fa-regular fa-square text-success me-2"></i> Client Outreach (10)</label>
        <label><i class="fa-regular fa-square text-success me-2"></i> Skill Learning (1 hr)</label>
    </div>
</div>

{{-- Statistics --}}
<div class="row g-3 mb-4">

    @php
        $stats = [
            ['Total Leads', $leads, 'fa-users', 'Client prospects'],
            ['Outreach', $outreachCount, 'fa-phone', 'Calls and messages'],
            ['Replies', $replies, 'fa-message', 'Responses received'],
            ['Jobs Applied', $jobsApplied, 'fa-briefcase', 'Applications tracked'],
            ['Total Income', '₹'.number_format($income), 'fa-wallet', 'Payments received'],
        ];
    @endphp

    @foreach($stats as $stat)
        <div class="col-6 col-xl">
            <div class="panel stat-card">
                <div class="stat-icon">
                    <i class="fa-solid {{ $stat[2] }}"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="stat-label">{{ $stat[0] }}</div>
                    <div class="stat-number text-truncate">{{ $stat[1] }}</div>
                    <div class="stat-note">{{ $stat[3] }}</div>
                </div>
            </div>
        </div>
    @endforeach

</div>

<div class="row g-3 mb-3">

    {{-- Daily Activity --}}
    <div class="col-xl-4 col-lg-6">
        <div class="panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="section-title mb-0">
                    <i class="fa-solid fa-bullseye"></i>Daily Activity
                </h5>
                <a href="{{ route('activities.create') }}" class="quick-link">+ Update</a>
            </div>

            @php
                $tasks = [
                    ['Apply for jobs', $todayActivity->jobs_applied ?? 0, 5],
                    ['Find new client leads', $todayActivity->leads_found ?? 0, 10],
                    ['Send outreach messages', $todayActivity->messages_sent ?? 0, 5],
                    ['Follow-ups', $todayActivity->follow_ups ?? 0, 5],
                    ['Skill learning (minutes)', $todayActivity->learning_minutes ?? 0, 60],
                ];

                $completed = collect($tasks)->filter(fn($task) => $task[1] >= $task[2])->count();
                $percentage = round(($completed / count($tasks)) * 100);
            @endphp

            <div class="d-flex justify-content-between small mb-2">
                <span class="muted">{{ $completed }} / {{ count($tasks) }} Completed</span>
                <strong>{{ $percentage }}%</strong>
            </div>

            <div class="progress mb-3">
                <div class="progress-bar" style="width:{{ $percentage }}%"></div>
            </div>

            @foreach($tasks as $task)
                <div class="task-row">
                    <span>
                        <i class="fa-solid {{ $task[1] >= $task[2] ? 'fa-square-check text-success' : 'fa-square text-secondary' }} me-2"></i>
                        {{ $task[0] }}
                    </span>
                    <span class="muted">{{ $task[1] }} / {{ $task[2] }}</span>
                </div>
            @endforeach

            <a href="{{ route('activities.create') }}" class="btn btn-outline-success btn-sm w-100 mt-3">
                Update Today's Activity
            </a>
        </div>
    </div>

    {{-- Lead Pipeline --}}
    <div class="col-xl-4 col-lg-6">
        <div class="panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="section-title mb-0">
                    <i class="fa-solid fa-filter"></i>Lead Pipeline
                </h5>
                <a href="{{ route('leads.index') }}" class="quick-link">View All →</a>
            </div>

            <div class="row align-items-center">
                <div class="col-5">
                    <canvas id="leadChart"></canvas>
                </div>
                <div class="col-7">
                    @php
                        $leadColors = [
                            'New' => '#42bfc1',
                            'Contacted' => '#08b875',
                            'Interested' => '#7ce88d',
                            'Negotiation' => '#b0ed9b',
                            'Won' => '#38c879',
                            'Lost' => '#ef6464',
                        ];
                    @endphp

                    @foreach($leadColors as $status => $color)
                        <div class="stage-row small">
                            <span>
                                <span class="stage-dot" style="background:{{ $color }}"></span>
                                {{ $status }}
                            </span>
                            <strong>{{ $leadStages[$status] ?? 0 }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Job Applications --}}
    <div class="col-xl-4 col-lg-12">
        <div class="panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="section-title mb-0">
                    <i class="fa-solid fa-briefcase"></i>Job Applications
                </h5>
                <a href="{{ route('jobs.index') }}" class="quick-link">View All →</a>
            </div>

            @php
                $jobColors = [
                    'Saved' => '#89949a',
                    'Applied' => '#89949a',
                    'HR Response' => '#49a7e9',
                    'Interview' => '#f5c842',
                    'Selected' => '#08b875',
                    'Rejected' => '#ef6464',
                ];
            @endphp

            @foreach($jobColors as $status => $color)
                <div class="stage-row">
                    <span>
                        <span class="stage-dot" style="background:{{ $color }}"></span>
                        {{ $status }}
                    </span>
                    <strong>{{ $jobStages[$status] ?? 0 }}</strong>
                </div>
            @endforeach

            <a href="{{ route('jobs.create') }}" class="btn btn-outline-success btn-sm w-100 mt-3">
                + Add Job Application
            </a>
        </div>
    </div>

</div>

<div class="row g-3">

    {{-- Skill Progress --}}
    <div class="col-xl-4 col-lg-5">
        <div class="panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="section-title mb-0">
                    <i class="fa-solid fa-graduation-cap"></i>Skill Progress
                </h5>
                <a href="{{ route('skills.index') }}" class="quick-link">View All →</a>
            </div>

            @forelse($skills as $skill)
                <div class="skill-row">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>{{ $skill->name }}</strong>
                        <span>{{ $skill->progress }}%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width:{{ $skill->progress }}%"></div>
                    </div>
                </div>
            @empty
                <p class="muted">No skills added yet.</p>
            @endforelse

            <a href="{{ route('skills.create') }}" class="btn btn-outline-success btn-sm w-100 mt-2">
                + Add Skill
            </a>
        </div>
    </div>

    {{-- Weekly Chart --}}
    <div class="col-xl-8 col-lg-7">
        <div class="panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="section-title mb-0">
                    <i class="fa-solid fa-chart-column"></i>Work Overview
                </h5>
                <span class="muted small">Last 7 Days</span>
            </div>
            <div class="chart-wrap">
                <canvas id="workChart"></canvas>
            </div>
        </div>
    </div>

</div>

</div>
@endsection

@push('scripts')
<script>
    const chartText = '#aab9af';
    const chartGrid = 'rgba(150,170,155,0.12)';

    Chart.defaults.color = chartText;
    Chart.defaults.font.family = 'Inter';

    new Chart(document.getElementById('leadChart'), {
        type: 'doughnut',
        data: {
            labels: @json(array_keys($leadColors)),
            datasets: [{
                data: @json(array_values(array_map(fn($status) => $leadStages[$status] ?? 0, array_keys($leadColors)))),
                backgroundColor: @json(array_values($leadColors)),
                borderWidth: 0,
                hoverOffset: 5
            }]
        },
        options: {
            cutout: '72%',
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    new Chart(document.getElementById('workChart'), {
        type: 'bar',
        data: {
            labels: @json($weeklyLabels),
            datasets: [
                {
                    label: 'Outreach',
                    data: @json($weeklyOutreach),
                    backgroundColor: '#079c63',
                    borderRadius: 5
                },
                {
                    label: 'Jobs Applied',
                    data: @json($weeklyJobs),
                    backgroundColor: '#8ee99b',
                    borderRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, boxWidth: 8 }
                }
            },
            scales: {
                x: { grid: { display: false } },
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { color: chartGrid }
                }
            }
        }
    });
</script>
@endpush