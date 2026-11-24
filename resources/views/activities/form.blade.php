@extends('layouts.app')

@php $isEdit = isset($activity); @endphp

@section('title','Daily Activity')
@section('page-heading',$isEdit ? 'Edit Daily Activity' : 'Record Daily Activity')
@section('page-subtitle','Enter your actual work for the selected date.')

@section('content')
<div class="panel p-4">
<form action="{{ $isEdit ? route('activities.update',$activity) : route('activities.store') }}" method="POST">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Activity Date</label>
            <input type="date" name="activity_date" required
                value="{{ old('activity_date',$isEdit ? $activity->activity_date->format('Y-m-d') : now()->toDateString()) }}"
                class="form-control bg-dark text-white border-secondary">
        </div>

        @php
        $fields = [
            'jobs_applied'=>'Jobs Applied',
            'leads_found'=>'New Leads Found',
            'calls_made'=>'Calls Made',
            'messages_sent'=>'Messages Sent',
            'follow_ups'=>'Follow-ups',
            'replies_received'=>'Replies Received',
            'meetings'=>'Meetings',
            'clients_won'=>'Clients Won',
            'learning_minutes'=>'Learning Minutes',
        ];
        @endphp

        @foreach($fields as $name=>$label)
        <div class="col-md-4">
            <label class="form-label">{{ $label }}</label>
            <input type="number" min="0" name="{{ $name }}" required
                value="{{ old($name,$isEdit ? $activity->$name : 0) }}"
                class="form-control bg-dark text-white border-secondary">
        </div>
        @endforeach

        <div class="col-12">
            <label class="form-label">Daily Notes</label>
            <textarea name="notes" rows="3" class="form-control bg-dark text-white border-secondary">{{ old('notes',$isEdit ? $activity->notes : '') }}</textarea>
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ $isEdit ? 'Update Activity' : 'Save Activity' }}</button>
    <a href="{{ route('activities.index') }}" class="btn btn-outline-light mt-4">Cancel</a>
</form>
</div>
@endsection