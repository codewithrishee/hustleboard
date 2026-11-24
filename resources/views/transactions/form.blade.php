@extends('layouts.app')

@php $isEdit = isset($transaction); @endphp

@section('title',$isEdit ? 'Edit Transaction' : 'Add Transaction')
@section('page-heading',$isEdit ? 'Edit Transaction' : 'Add Transaction')
@section('page-subtitle','Record your income or business expenses.')

@section('content')
<div class="panel p-4">
<form action="{{ $isEdit ? route('transactions.update',$transaction) : route('transactions.store') }}" method="POST">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Transaction Type</label>
            <select name="type" class="form-select bg-dark text-white border-secondary" required>
                <option value="income" @selected(old('type',$isEdit ? $transaction->type : 'income') === 'income')>Income</option>
                <option value="expense" @selected(old('type',$isEdit ? $transaction->type : '') === 'expense')>Expense</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Title / Description</label>
            <input type="text" name="title" required
                value="{{ old('title',$isEdit ? $transaction->title : '') }}"
                class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="col-md-6">
            <label class="form-label">Amount (₹)</label>
            <input type="number" name="amount" min="0.01" step="0.01" required
                value="{{ old('amount',$isEdit ? $transaction->amount : '') }}"
                class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="col-md-6">
            <label class="form-label">Transaction Date</label>
            <input type="date" name="transaction_date" required
                value="{{ old('transaction_date',$isEdit ? $transaction->transaction_date->format('Y-m-d') : now()->toDateString()) }}"
                class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="col-md-6">
            <label class="form-label">Related Client (Optional)</label>
            <select name="lead_id" class="form-select bg-dark text-white border-secondary">
                <option value="">No client selected</option>
                @foreach($leads as $lead)
                    <option value="{{ $lead->id }}"
                        @selected((string)old('lead_id',$isEdit ? $transaction->lead_id : '') === (string)$lead->id)>
                        {{ $lead->business_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Payment Status</label>
            <select name="payment_status" class="form-select bg-dark text-white border-secondary" required>
                @foreach(['Received','Pending','Partial'] as $status)
                    <option value="{{ $status }}"
                        @selected(old('payment_status',$isEdit ? $transaction->payment_status : 'Received') === $status)>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Notes</label>
            <textarea name="notes" rows="3" class="form-control bg-dark text-white border-secondary">{{ old('notes',$isEdit ? $transaction->notes : '') }}</textarea>
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ $isEdit ? 'Update Transaction' : 'Save Transaction' }}</button>
    <a href="{{ route('transactions.index') }}" class="btn btn-outline-light mt-4">Cancel</a>
</form>
</div>
@endsection