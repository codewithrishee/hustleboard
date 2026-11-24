
@extends('layouts.app')

@php
    $isEdit = isset($skill) && $skill->exists;
@endphp

@section('title', $isEdit ? 'Edit Skill' : 'Add Skill')
@section('page-heading', $isEdit ? 'Update Skill' : 'Add New Skill')
@section('page-subtitle', 'Track what you are learning and how far you have progressed.')

@section('content')

<div class="panel p-4">

    <form action="{{ $isEdit ? route('skills.update', $skill->id) : route('skills.store') }}"
          method="POST">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif

        <div class="row g-3">

            <!-- Skill Name -->
            <div class="col-md-6">
                <label class="form-label">Skill Name</label>

                <input
                    type="text"
                    name="name"
                    required
                    value="{{ old('name', $skill->name ?? '') }}"
                    class="form-control bg-dark text-white border-secondary"
                    placeholder="e.g. Laravel Development"
                >
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Category -->
            <div class="col-md-6">
                <label class="form-label">Category</label>

                <select name="category"
                        class="form-select bg-dark text-white border-secondary">

                    @foreach(['Development', 'AI & Automation', 'Marketing', 'Communication', 'Other'] as $category)

                        <option value="{{ $category }}"
                            @selected(old('category', $skill->category ?? '') === $category)>
                            {{ $category }}
                        </option>

                    @endforeach

                </select>

                @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Progress -->
            <div class="col-md-6">
                <label class="form-label">Progress (%)</label>

                <input
                    type="number"
                    name="progress"
                    min="0"
                    max="100"
                    required
                    value="{{ old('progress', $skill->progress ?? 0) }}"
                    class="form-control bg-dark text-white border-secondary"
                    placeholder="0 - 100"
                >

                @error('progress')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Target Completion Date -->
            <div class="col-md-6">
                <label class="form-label">Target Completion Date</label>

                <input
                    type="date"
                    name="target_date"
                    value="{{ old('target_date', !empty($skill->target_date) ? \Illuminate\Support\Carbon::parse($skill->target_date)->format('Y-m-d') : '') }}"
                    class="form-control bg-dark text-white border-secondary"
                >

                @error('target_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Learning Notes -->
            <div class="col-12">
                <label class="form-label">Learning Notes</label>

                <textarea
                    name="notes"
                    rows="4"
                    class="form-control bg-dark text-white border-secondary"
                    placeholder="Write your learning goals and notes..."
                >{{ old('notes', $skill->notes ?? '') }}</textarea>

                @error('notes')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-success mt-4">
            {{ $isEdit ? 'Update Skill' : 'Save Skill' }}
        </button>

        <a href="{{ route('skills.index') }}"
           class="btn btn-outline-light mt-4">
            Cancel
        </a>

    </form>

</div>

@endsection
