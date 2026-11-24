@extends('layouts.app')

@php
    $isEdit = isset($job);
@endphp

@section('title', $isEdit ? 'Edit Job' : 'Add Job')
@section('page-heading', $isEdit ? 'Edit Job Application' : 'Add Job Application')
@section('page-subtitle', 'Keep your job search organized.')

@section('content')

<div class="panel p-4">

    <form action="{{ $isEdit ? route('jobs.update', $job) : route('jobs.store') }}"
          method="POST">

        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="row g-3">

            @php
                $fields = [
                    'company_name' => 'Company Name',
                    'role' => 'Job Role',
                    'location' => 'Location',
                    'salary' => 'Expected / Offered Salary',
                    'job_link' => 'Job URL',
                    'applied_date' => 'Application Date',
                    'hr_contact' => 'HR Contact',
                    'follow_up_date' => 'Follow-up Date',
                    'interview_date' => 'Interview Date',
                ];
            @endphp

            @foreach($fields as $name => $label)
                <div class="col-md-6">
                    <label class="form-label">{{ $label }}</label>

                    <input
                        name="{{ $name }}"
                        type="{{ in_array($name, ['applied_date','follow_up_date','interview_date']) ? 'date' : 'text' }}"
                        value="{{ old($name, $isEdit ? (in_array($name, ['applied_date','follow_up_date','interview_date']) ? $job->$name?->format('Y-m-d') : $job->$name) : '') }}"
                        class="form-control bg-dark text-white border-secondary"
                        {{ in_array($name, ['company_name','role']) ? 'required' : '' }}
                    >

                    @error($name)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach

            <div class="col-md-6">
                <label class="form-label">Application Status</label>

                <select name="status" class="form-select bg-dark text-white border-secondary" required>
                    @foreach(['Saved','Applied','HR Response','Interview','Selected','Rejected'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $isEdit ? $job->status : 'Saved') === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Notes</label>
                <textarea name="notes"
                    class="form-control bg-dark text-white border-secondary"
                    rows="4">{{ old('notes', $isEdit ? $job->notes : '') }}</textarea>
            </div>

        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-check me-2"></i>
                {{ $isEdit ? 'Update Application' : 'Save Application' }}
            </button>

            <a href="{{ route('jobs.index') }}" class="btn btn-outline-light">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection