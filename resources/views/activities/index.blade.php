@extends('layouts.app')
@section('title','Daily Activity')
@section('page-heading','Daily Activity')
@section('page-subtitle','Monitor your daily goals and productivity.')

@section('content')
<div class="panel p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h5>Activity History</h5>
            <span class="muted small">{{ $activities->total() }} recorded days</span>
        </div>
        <a href="{{ route('activities.create') }}" class="btn btn-success">+ Add Activity</a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>Date</th><th>Jobs</th><th>Leads</th><th>Calls</th>
                    <th>Messages</th><th>Follow-ups</th><th>Learning</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                <tr>
                    <td>{{ $activity->activity_date->format('d M Y') }}</td>
                    <td>{{ $activity->jobs_applied }}</td>
                    <td>{{ $activity->leads_found }}</td>
                    <td>{{ $activity->calls_made }}</td>
                    <td>{{ $activity->messages_sent }}</td>
                    <td>{{ $activity->follow_ups }}</td>
                    <td>{{ $activity->learning_minutes }} min</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('activities.edit',$activity) }}" class="btn btn-sm btn-outline-info"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('activities.destroy',$activity) }}" method="POST" onsubmit="return confirm('Delete this activity?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center muted py-5">No activities recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $activities->links() }}
</div>
@endsection