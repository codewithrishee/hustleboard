
@extends('layouts.app')


@section('title', 'Reports')
@section('page-heading', 'Reports & Analytics')
@section('page-subtitle', 'Understand your performance, track progress and measure growth.')

@push('styles')
<style>
    .report-page { padding-bottom: 30px; }

    .report-hero {
        position: relative;
        overflow: hidden;
        padding: 25px 28px;
        border-radius: 18px;
        border: 1px solid #28543a;
        background:
            radial-gradient(circle at 85% 20%, rgba(85,223,128,.17), transparent 32%),
            linear-gradient(120deg,#102b1b,#101a14 75%);
        margin-bottom: 22px;
    }

    .report-hero h3 {
        font-size: 23px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .report-hero p {
        color: #a8b9ad;
        margin: 0;
        font-size: 13px;
    }

    .report-period {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #8df0a8;
        background: #193b27;
        border: 1px solid #28543a;
        border-radius: 30px;
        padding: 8px 13px;
        font-size: 11px;
        font-weight: 700;
        margin-top: 15px;
    }

    .report-filter {
        background: #101a14;
        border: 1px solid #26382d;
        border-radius: 15px;
        padding: 18px;
        margin-bottom: 22px;
    }

    .report-filter label {
        color: #aabbb0;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .report-filter .form-control {
        background: #0a120d;
        border: 1px solid #304237;
        color: #f2f7f3;
        min-height: 43px;
        border-radius: 9px;
        color-scheme: dark;
    }

    .report-filter .form-control:focus {
        border-color: #55df80;
        box-shadow: 0 0 0 3px rgba(85,223,128,.1);
    }

    .report-stat {
        height: 100%;
        padding: 19px;
        background: linear-gradient(145deg,#142219,#101a14);
        border: 1px solid #26382d;
        border-radius: 15px;
        transition: .2s;
    }

    .report-stat:hover {
        transform: translateY(-3px);
        border-color: #477c57;
    }

    .report-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 19px;
    }

    .report-stat-icon {
        width: 43px;
        height: 43px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        font-size: 17px;
    }

    .icon-green { background: #193b27; color: #68e68c; }
    .icon-blue { background: #142f3b; color: #5cc8ed; }
    .icon-orange { background: #3b2b18; color: #f5b95f; }
    .icon-purple { background: #302343; color: #c39af5; }

    .report-stat-label {
        color: #9aada1;
        font-size: 12px;
        font-weight: 600;
    }

    .report-stat-value {
        font-size: 27px;
        font-weight: 800;
        letter-spacing: -.8px;
        color: #f2f7f3;
        margin-top: 7px;
        overflow-wrap: anywhere;
    }

    .report-stat-note {
        color: #718579;
        font-size: 11px;
        margin-top: 6px;
    }

    .report-panel {
        height: 100%;
        padding: 21px;
        background: linear-gradient(145deg,#121e17,#0f1813);
        border: 1px solid #26382d;
        border-radius: 16px;
    }

    .report-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 20px;
    }

    .report-panel-title {
        color: #f2f7f3;
        font-size: 15px;
        font-weight: 750;
        margin: 0 0 5px;
    }

    .report-panel-subtitle {
        color: #82968a;
        font-size: 11px;
        margin: 0;
    }

    .report-chart {
        position: relative;
        height: 255px;
    }

    .report-chart.tall { height: 290px; }

    .report-tag {
        background: #193b27;
        color: #8df0a8;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .finance-box {
        padding: 17px;
        border: 1px solid #293d30;
        background: #0c160f;
        border-radius: 13px;
        height: 100%;
    }

    .finance-label {
        font-size: 11px;
        color: #96a99b;
        margin-bottom: 10px;
    }

    .finance-value {
        font-size: 21px;
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .finance-icon {
        font-size: 15px;
        margin-bottom: 12px;
    }

    .productivity-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 0;
        border-bottom: 1px solid #26352c;
    }

    .productivity-item:last-child { border-bottom: 0; }

    .productivity-left {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #aabbb0;
        font-size: 12px;
    }

    .productivity-left i {
        width: 35px;
        height: 35px;
        display: grid;
        place-items: center;
        background: #193b27;
        color: #72e995;
        border-radius: 10px;
    }

    .productivity-value {
        font-size: 17px;
        font-weight: 800;
    }

    .report-empty {
        color: #819388;
        font-size: 12px;
        text-align: center;
        padding: 35px 10px;
    }

    @media(max-width:767px) {
        .report-hero { padding: 20px; }
        .report-hero h3 { font-size: 19px; }
        .report-stat { padding: 15px; }
        .report-stat-value { font-size: 23px; }
        .report-panel { padding: 16px; }
        .report-chart { height: 220px; }
        .report-chart.tall { height: 250px; }
        .finance-value { font-size: 18px; }
    }
</style>
@endpush

@section('content')

<div class="report-page">

    {{-- HERO --}}
    <div class="report-hero">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3>Your Growth, In Numbers.</h3>
                <p>A complete overview of your work, clients, applications and earnings.</p>
                <div class="report-period">
                    <i class="fa-regular fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($from)->format('d M Y') }}
                    <span>—</span>
                    {{ \Carbon\Carbon::parse($to)->format('d M Y') }}
                </div>
            </div>

            <div class="text-end d-none d-md-block">
                <i class="fa-solid fa-chart-pie"
                   style="font-size:55px;color:#55df80;opacity:.8;"></i>
            </div>
        </div>
    </div>

    {{-- DATE FILTER --}}
    <div class="report-filter">
        <form action="{{ route('reports.index') }}" method="GET">
            <div class="row align-items-end g-3">
                <div class="col-lg-4 col-md-5">
                    <label>START DATE</label>
                    <input type="date" name="from"
                           class="form-control" value="{{ $from }}" required>
                </div>

                <div class="col-lg-4 col-md-5">
                    <label>END DATE</label>
                    <input type="date" name="to"
                           class="form-control" value="{{ $to }}" required>
                </div>

                <div class="col-lg-4 col-md-2 d-flex gap-2">
                    <button class="btn btn-success flex-grow-1 py-2">
                        <i class="fa-solid fa-filter me-2"></i> Apply
                    </button>
                    <a href="{{ route('reports.index') }}"
                       class="btn btn-outline-light py-2">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                </div>

                @error('from')
                    <div class="col-12 text-danger small">{{ $message }}</div>
                @enderror
                @error('to')
                    <div class="col-12 text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </div>

    {{-- KPI CARDS --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-sm-6">
            <div class="report-stat">
                <div class="report-stat-top">
                    <span class="report-stat-label">TOTAL LEADS</span>
                    <div class="report-stat-icon icon-green">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div class="report-stat-value">{{ $totalLeads }}</div>
                <div class="report-stat-note">Leads added in this period</div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="report-stat">
                <div class="report-stat-top">
                    <span class="report-stat-label">JOBS APPLIED</span>
                    <div class="report-stat-icon icon-blue">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                </div>
                <div class="report-stat-value">{{ $totalJobs }}</div>
                <div class="report-stat-note">Applications submitted</div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="report-stat">
                <div class="report-stat-top">
                    <span class="report-stat-label">OUTREACH SENT</span>
                    <div class="report-stat-icon icon-orange">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>
                </div>
                <div class="report-stat-value">{{ $totalOutreach }}</div>
                <div class="report-stat-note">{{ $replies }} replies recorded</div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="report-stat">
                <div class="report-stat-top">
                    <span class="report-stat-label">RESPONSE RATE</span>
                    <div class="report-stat-icon icon-purple">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
                <div class="report-stat-value">{{ $responseRate }}%</div>
                <div class="report-stat-note">Outreach reply percentage</div>
            </div>
        </div>

    </div>

    {{-- LEAD + JOB CHARTS --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-6">
            <div class="report-panel">
                <div class="report-panel-header">
                    <div>
                        <h5 class="report-panel-title">Lead Pipeline</h5>
                        <p class="report-panel-subtitle">Lead status distribution</p>
                    </div>
                    <span class="report-tag">CLIENTS</span>
                </div>

                <div class="report-chart">
                    <canvas id="leadReportChart"></canvas>
                    <div id="leadEmpty" class="report-empty d-none">
                        No lead data available for this period.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="report-panel">
                <div class="report-panel-header">
                    <div>
                        <h5 class="report-panel-title">Job Applications</h5>
                        <p class="report-panel-subtitle">Application status breakdown</p>
                    </div>
                    <span class="report-tag">CAREER</span>
                </div>

                <div class="report-chart">
                    <canvas id="jobReportChart"></canvas>
                    <div id="jobEmpty" class="report-empty d-none">
                        No job application data available.
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- OUTREACH + FINANCE --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-5">
            <div class="report-panel">
                <div class="report-panel-header">
                    <div>
                        <h5 class="report-panel-title">Outreach Performance</h5>
                        <p class="report-panel-subtitle">Response status breakdown</p>
                    </div>
                    <span class="report-tag">OUTREACH</span>
                </div>

                <div class="report-chart">
                    <canvas id="outreachReportChart"></canvas>
                    <div id="outreachEmpty" class="report-empty d-none">
                        No outreach data available.
                    </div>
                </div>

                <div class="d-flex justify-content-between pt-3 mt-2"
                     style="border-top:1px solid #26382d;">
                    <span class="text-secondary small">Total outreach</span>
                    <strong>{{ $totalOutreach }}</strong>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span class="text-secondary small">Replies</span>
                    <strong class="text-success">{{ $replies }}</strong>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="report-panel">
                <div class="report-panel-header">
                    <div>
                        <h5 class="report-panel-title">Financial Overview</h5>
                        <p class="report-panel-subtitle">Your income and expenses</p>
                    </div>
                    <span class="report-tag">FINANCE</span>
                </div>

                <div class="row g-3">

                    <div class="col-sm-6">
                        <div class="finance-box">
                            <div class="finance-icon text-success">
                                <i class="fa-solid fa-arrow-trend-up"></i>
                            </div>
                            <div class="finance-label">RECEIVED INCOME</div>
                            <div class="finance-value text-success">
                                ₹{{ number_format($totalIncome, 2) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="finance-box">
                            <div class="finance-icon text-danger">
                                <i class="fa-solid fa-arrow-trend-down"></i>
                            </div>
                            <div class="finance-label">TOTAL EXPENSES</div>
                            <div class="finance-value text-danger">
                                ₹{{ number_format($totalExpenses, 2) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="finance-box">
                            <div class="finance-icon text-info">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="finance-label">PENDING / PARTIAL</div>
                            <div class="finance-value text-info">
                                ₹{{ number_format($pendingIncome, 2) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="finance-box">
                            <div class="finance-icon text-warning">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div class="finance-label">NET PROFIT / LOSS</div>
                            <div class="finance-value {{ $netProfit >= 0 ? 'text-success' : 'text-danger' }}">
                                ₹{{ number_format($netProfit, 2) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- PRODUCTIVITY --}}
    <div class="row g-3">

        <div class="col-lg-8">
            <div class="report-panel">
                <div class="report-panel-header">
                    <div>
                        <h5 class="report-panel-title">Productivity Overview</h5>
                        <p class="report-panel-subtitle">Daily jobs and client leads added</p>
                    </div>
                    <span class="report-tag">ACTIVITY</span>
                </div>

                <div class="report-chart tall">
                    <canvas id="activityReportChart"></canvas>
                    <div id="activityEmpty" class="report-empty d-none">
                        No daily activity data available.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="report-panel">
                <div class="report-panel-header">
                    <div>
                        <h5 class="report-panel-title">Your Productivity</h5>
                        <p class="report-panel-subtitle">Selected period summary</p>
                    </div>
                    <i class="fa-solid fa-bolt text-success fs-5"></i>
                </div>

                <div class="productivity-item">
                    <div class="productivity-left">
                        <i class="fa-solid fa-graduation-cap"></i>
                        Learning time
                    </div>
                    <div class="productivity-value">
                        {{ floor($totalLearning / 60) }}h {{ $totalLearning % 60 }}m
                    </div>
                </div>

                <div class="productivity-item">
                    <div class="productivity-left">
                        <i class="fa-solid fa-comment-dots"></i>
                        Messages sent
                    </div>
                    <div class="productivity-value">{{ $totalMessages }}</div>
                </div>

                <div class="productivity-item">
                    <div class="productivity-left">
                        <i class="fa-solid fa-phone-volume"></i>
                        Follow-ups done
                    </div>
                    <div class="productivity-value">{{ $totalFollowups }}</div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    const reportText = '#aabbb0';
    const reportGrid = '#26382d';

    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: reportText,
                    padding: 18,
                    usePointStyle: true,
                    pointStyle: 'circle',
                    font: { size: 11 }
                }
            }
        }
    };

    function makeReportChart(id, emptyId, type, labels, values, colors, title) {
        const canvas = document.getElementById(id);

        if (!labels.length || !values.some(value => Number(value) > 0)) {
            canvas.classList.add('d-none');
            document.getElementById(emptyId).classList.remove('d-none');
            return;
        }

        new Chart(canvas, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: values,
                    backgroundColor: colors,
                    borderWidth: type === 'doughnut' ? 0 : 1,
                    borderRadius: type === 'bar' ? 6 : 0,
                    hoverOffset: type === 'doughnut' ? 7 : 0
                }]
            },
            options: {
                ...commonOptions,
                ...(type === 'bar' ? {
                    scales: {
                        x: {
                            ticks: { color: reportText },
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: reportText,
                                precision: 0
                            },
                            grid: { color: reportGrid }
                        }
                    }
                } : {})
            }
        });
    }

    makeReportChart(
        'leadReportChart',
        'leadEmpty',
        'doughnut',
        @json($leadStages->keys()->values()),
        @json($leadStages->values()->values()),
        ['#55df80','#38bdf8','#f5b95f','#b58af2','#ef7777','#7d9b89'],
        'Leads'
    );

    makeReportChart(
        'jobReportChart',
        'jobEmpty',
        'bar',
        @json($jobStages->keys()->values()),
        @json($jobStages->values()->values()),
        '#55df80',
        'Applications'
    );

    makeReportChart(
        'outreachReportChart',
        'outreachEmpty',
        'doughnut',
        @json($outreachStages->keys()->values()),
        @json($outreachStages->values()->values()),
        ['#55df80','#38bdf8','#f5b95f','#ef7777','#b58af2','#7d9b89'],
        'Outreach'
    );

    const activityLabels = @json($activityLabels);
    const activityJobs = @json($activityJobs);
    const activityLeads = @json($activityLeads);

    if (
        !activityLabels.length ||
        (!activityJobs.some(v => Number(v) > 0) &&
         !activityLeads.some(v => Number(v) > 0))
    ) {
        document.getElementById('activityReportChart').classList.add('d-none');
        document.getElementById('activityEmpty').classList.remove('d-none');
    } else {
        new Chart(document.getElementById('activityReportChart'), {
            type: 'bar',
            data: {
                labels: activityLabels,
                datasets: [
                    {
                        label: 'Jobs Applied',
                        data: activityJobs,
                        backgroundColor: '#55df80',
                        borderRadius: 5
                    },
                    {
                        label: 'Leads Added',
                        data: activityLeads,
                        backgroundColor: '#38bdf8',
                        borderRadius: 5
                    }
                ]
            },
            options: {
                ...commonOptions,
                scales: {
                    x: {
                        ticks: { color: reportText },
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: reportText, precision: 0 },
                        grid: { color: reportGrid }
                    }
                }
            }
        });
    }
</script>
@endpush
