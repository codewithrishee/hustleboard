@extends('layouts.app')

@php $isEdit = isset($outreach); @endphp

@section('title', $isEdit ? 'Edit Outreach' : 'Add Outreach')
@section('page-heading', $isEdit ? 'Edit Outreach Record' : 'Log New Outreach')
@section('page-subtitle','Record your communication and follow-up details.')

@section('content')
<div class="panel p-4">
<form action="{{ $isEdit ? route('outreach.update',$outreach) : route('outreach.store') }}" method="POST">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Client / Business</label>
            <select name="lead_id" class="form-select bg-dark text-white border-secondary">
                <option value="">General Contact</option>
                @foreach($leads as $lead)
                    <option value="{{ $lead->id }}"
                        @selected((string)old('lead_id',$isEdit ? $outreach->lead_id : '') === (string)$lead->id)>
                        {{ $lead->business_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Contact Method</label>
            <select name="method" class="form-select bg-dark text-white border-secondary" required>
                @foreach(['WhatsApp','Call','Instagram','Email','In Person'] as $method)
                    <option value="{{ $method }}" @selected(old('method',$isEdit ? $outreach->method : '') === $method)>
                        {{ $method }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Contact Date & Time</label>
            <input type="datetime-local" name="contacted_at"
                value="{{ old('contacted_at',$isEdit ? $outreach->contacted_at?->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                class="form-control bg-dark text-white border-secondary" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Response Status</label>
            <select name="response_status" class="form-select bg-dark text-white border-secondary" required>
                @foreach(['Pending','Replied','Interested','Not Interested','No Response'] as $status)
                    <option value="{{ $status }}" @selected(old('response_status',$isEdit ? $outreach->response_status : 'Pending') === $status)>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Follow-up Date</label>
            <input type="date" name="follow_up_date"
                value="{{ old('follow_up_date',$isEdit ? $outreach->follow_up_date?->format('Y-m-d') : '') }}"
                class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="col-12">
            <label class="form-label">Message Sent</label>
            <textarea name="message" rows="3" class="form-control bg-dark text-white border-secondary">{{ old('message',$isEdit ? $outreach->message : '') }}</textarea>
        </div>

        <div class="col-12">
            <label class="form-label">Response / Notes</label>
            <textarea name="response" rows="3" class="form-control bg-dark text-white border-secondary">{{ old('response',$isEdit ? $outreach->response : '') }}</textarea>
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ $isEdit ? 'Update Record' : 'Save Outreach' }}</button>
    <a href="{{ route('outreach.index') }}" class="btn btn-outline-light mt-4">Cancel</a>
</form>
</div>
@endsection