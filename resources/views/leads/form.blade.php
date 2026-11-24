@extends('layouts.app')

@php
    $isEdit = isset($lead);
@endphp

@section('title', $isEdit ? 'Edit Lead' : 'Add Lead')
@section('page-heading', $isEdit ? 'Edit Client Lead' : 'Add New Client')
@section('page-subtitle', 'Manage your business opportunity details.')

@section('content')

<div class="panel p-4">
    <form action="{{ $isEdit ? route('leads.update', $lead) : route('leads.store') }}"
          method="POST">

        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="row g-3">

            @php
                $fields = [
                    'business_name' => 'Business Name',
                    'category' => 'Business Category',
                    'contact_person' => 'Contact Person',
                    'phone' => 'Phone Number',
                    'email' => 'Email',
                    'website' => 'Website',
                    'instagram' => 'Instagram',
                    'area' => 'Area / Location',
                    'source' => 'Lead Source',
                    'service_offered' => 'Service Offered',
                    'quoted_price' => 'Quoted Price',
                    'follow_up_date' => 'Follow-up Date',
                ];
            @endphp

            @foreach($fields as $name => $label)
                <div class="col-md-6">
                    <label class="form-label">{{ $label }}</label>

                    <input
                        name="{{ $name }}"
                        type="{{ $name === 'follow_up_date' ? 'date' : ($name === 'email' ? 'email' : ($name === 'quoted_price' ? 'number' : 'text')) }}"
                        step="{{ $name === 'quoted_price' ? '0.01' : '' }}"
                        value="{{ old($name, $isEdit ? ($name === 'follow_up_date' ? $lead->follow_up_date?->format('Y-m-d') : $lead->$name) : '') }}"
                        class="form-control bg-dark text-white border-secondary"
                        {{ $name === 'business_name' ? 'required' : '' }}
                    >

                    @error($name)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach

            <div class="col-md-6">
                <label class="form-label">Lead Status</label>
                <select name="status" class="form-select bg-dark text-white border-secondary" required>
                    @foreach(['New','Contacted','Interested','Negotiation','Won','Lost'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $isEdit ? $lead->status : 'New') === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Problem Identified</label>
                <textarea name="problem_identified"
                    class="form-control bg-dark text-white border-secondary"
                    rows="3">{{ old('problem_identified', $isEdit ? $lead->problem_identified : '') }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Additional Notes</label>
                <textarea name="notes"
                    class="form-control bg-dark text-white border-secondary"
                    rows="3">{{ old('notes', $isEdit ? $lead->notes : '') }}</textarea>
            </div>

        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-check me-2"></i>
                {{ $isEdit ? 'Update Lead' : 'Save Lead' }}
            </button>

            <a href="{{ route('leads.index') }}" class="btn btn-outline-light">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection