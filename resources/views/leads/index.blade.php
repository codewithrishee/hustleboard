@extends('layouts.app')

@section('title', 'Client Leads')
@section('page-heading', 'Client Leads')
@section('page-subtitle', 'Manage your business prospects and opportunities.')

@section('content')

    <div class="panel p-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h5 class="mb-1">All Client Leads</h5>
                <span class="muted small">{{ $leads->total() }} total leads</span>
            </div>
            <a href="{{ route('leads.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus me-2"></i>Add Lead
            </a>
        </div>

        <form method="GET" class="row g-2 mb-4">
            <div class="col-md-5">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control bg-dark text-white border-secondary"
                    placeholder="Search business, phone or area...">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-success">Search</button>
                <a href="{{ route('leads.index') }}" class="btn btn-outline-light">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr>
                        <th>Business</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Follow-up</th>
                        <th>Quote</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($leads as $lead)
                                <tr>
                                    <td>
                                        <strong>{{ $lead->business_name }}</strong>
                                        <div class="muted small">{{ $lead->category }}</div>
                                    </td>
                                    <td>
                                        {{ $lead->contact_person ?? '—' }}
                                        <div class="muted small">{{ $lead->phone }}</div>
                                    </td>
                                    <td>{{ $lead->area ?? '—' }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $lead->status }}</span>
                                    </td>
                                    <td>
                                        {{ $lead->follow_up_date
                        ? \Illuminate\Support\Carbon::parse($lead->follow_up_date)->format('d M Y')
                        : '-' }}
                                    </td>
                                    <td>{{ $lead->quoted_price ? '₹' . number_format($lead->quoted_price) : '—' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('leads.edit', $lead) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <form action="{{ route('leads.destroy', $lead) }}" method="POST"
                                                onsubmit="return confirm('Delete this lead?')">
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
                                <i class="fa-solid fa-users fa-2x mb-3 d-block"></i>
                                No client leads found. Add your first lead!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $leads->links() }}
    </div>

@endsection