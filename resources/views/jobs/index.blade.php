@extends('layouts.app')

@section('title', 'Job Tracker')
@section('page-heading', 'Job Tracker')
@section('page-subtitle', 'Track applications, HR responses and interviews.')

@section('content')

<div class="panel p-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h5 class="mb-1">Job Applications</h5>
            <span class="muted small">{{ $jobs->total() }} total applications</span>
        </div>

        <a href="{{ route('jobs.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus me-2"></i>Add Job
        </a>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-5">
            <input type="text" name="search"
                value="{{ request('search') }}"
                class="form-control bg-dark text-white border-secondary"
                placeholder="Search company or job role...">
        </div>

        <div class="col-auto">
            <button class="btn btn-outline-success">Search</button>
            <a href="{{ route('jobs.index') }}" class="btn btn-outline-light">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Job Role</th>
                    <th>Location</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Applied Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($jobs as $job)
                <tr>
                    <td>
                        <strong>{{ $job->company_name }}</strong>
                        <div class="muted small">{{ $job->hr_contact }}</div>
                    </td>

                    <td>{{ $job->role }}</td>
                    <td>{{ $job->location ?? '—' }}</td>
                    <td>{{ $job->salary ?? '—' }}</td>

                    <td>
                        @php
                            $statusColors = [
                                'Saved' => 'secondary',
                                'Applied' => 'info',
                                'HR Response' => 'primary',
                                'Interview' => 'warning',
                                'Selected' => 'success',
                                'Rejected' => 'danger',
                            ];
                        @endphp

                        <span class="badge bg-{{ $statusColors[$job->status] ?? 'secondary' }}">
                            {{ $job->status }}
                        </span>
                    </td>

                    <td>{{ $job->applied_date?->format('d M Y') ?? '—' }}</td>

                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('jobs.edit', $job) }}"
                               class="btn btn-sm btn-outline-info">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('jobs.destroy', $job) }}" method="POST"
                                  onsubmit="return confirm('Delete this application?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center muted py-5">
                        <i class="fa-solid fa-briefcase fa-2x mb-3 d-block"></i>
                        No job applications yet. Add your first application!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $jobs->links() }}

</div>

@endsection