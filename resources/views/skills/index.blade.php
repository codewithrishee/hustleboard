@extends('layouts.app')
@section('title','Skill Tracker')
@section('page-heading','Skill Tracker')
@section('page-subtitle','Track your learning journey and skill development.')

@section('content')
<div class="panel p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h5>My Skills</h5>
            <span class="muted small">{{ $skills->total() }} skills tracked</span>
        </div>
        <a href="{{ route('skills.create') }}" class="btn btn-success">+ Add Skill</a>
    </div>

    <div class="row g-3">
        @forelse($skills as $skill)
        <div class="col-md-6 col-xl-4">
            <div class="panel p-3 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $skill->name }}</h6>
                        <span class="muted small">{{ $skill->category ?? 'General' }}</span>
                    </div>
                    <span class="badge bg-success">{{ $skill->progress }}%</span>
                </div>

                <div class="progress mb-3">
                    <div class="progress-bar" style="width:{{ $skill->progress }}%"></div>
                </div>

                <div class="small muted mb-3">
                    Target: {{ $skill->target_date ? \Illuminate\Support\Carbon::parse($skill->target_date)->format('d M Y') : 'Not set' }}
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('skills.edit',$skill) }}" class="btn btn-sm btn-outline-info">Edit</a>
                    <form action="{{ route('skills.destroy',$skill) }}" method="POST" onsubmit="return confirm('Delete this skill?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center muted py-5">No skills added yet. Start tracking your learning!</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $skills->links() }}</div>
</div>
@endsection