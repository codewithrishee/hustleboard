@extends('layouts.app')
@section('title','Income & Expenses')
@section('page-heading','Income & Expenses')
@section('page-subtitle','Keep track of your earnings, payments and spending.')

@section('content')

@php
    $received = \App\Models\Transaction::where('type','income')->where('payment_status','Received')->sum('amount');
    $expenses = \App\Models\Transaction::where('type','expense')->sum('amount');
    $pending = \App\Models\Transaction::where('type','income')->where('payment_status','Pending')->sum('amount');
@endphp

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="panel p-3">
            <span class="muted">Received Income</span>
            <h3 class="green mt-2">₹{{ number_format($received,2) }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel p-3">
            <span class="muted">Total Expenses</span>
            <h3 class="text-danger mt-2">₹{{ number_format($expenses,2) }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel p-3">
            <span class="muted">Pending Payments</span>
            <h3 class="text-warning mt-2">₹{{ number_format($pending,2) }}</h3>
        </div>
    </div>
</div>

<div class="panel p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h5>Transaction History</h5>
            <span class="muted small">{{ $transactions->total() }} records</span>
        </div>
        <a href="{{ route('transactions.create') }}" class="btn btn-success">+ Add Transaction</a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>Date</th><th>Description</th><th>Client</th>
                    <th>Type</th><th>Amount</th><th>Payment</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_date->format('d M Y') }}</td>
                    <td>{{ $transaction->title }}</td>
                    <td>{{ $transaction->lead?->business_name ?? '—' }}</td>
                    <td>
                        <span class="badge bg-{{ $transaction->type === 'income' ? 'success' : 'danger' }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </td>
                    <td class="{{ $transaction->type === 'income' ? 'text-success' : 'text-danger' }}">
                        {{ $transaction->type === 'income' ? '+' : '-' }}₹{{ number_format($transaction->amount,2) }}
                    </td>
                    <td>{{ $transaction->payment_status }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('transactions.edit',$transaction) }}" class="btn btn-sm btn-outline-info">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('transactions.destroy',$transaction) }}" method="POST" onsubmit="return confirm('Delete this transaction?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center muted py-5">No transactions recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $transactions->links() }}
</div>
@endsection