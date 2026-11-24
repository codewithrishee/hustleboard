@extends('layouts.app')
@section('title','Outreach Log')
@section('page-heading','Outreach Log')
@section('page-subtitle','Track every call, WhatsApp message and client response.')

@section('content')
<div class="panel p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h5>All Outreach Records</h5>
            <span class="muted small">{{ $outreach->total() }} records</span>
        </div>
        <a href="{{ route('outreach.create') }}" class="btn btn-success">+ Log Outreach</a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>Business</th>
                    <th>Method</th>
                    <th>Contacted</th>
                    <th>Response</th>
                    <th>Follow-up</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($outreach as $item)
                <tr>
                    <td>{{ $item->lead?->business_name ?? 'General Contact' }}</td>
                    <td>{{ $item->method }}</td>
                    <td>{{ $item->contacted_at?->format('d M Y, h:i A') }}</td>
                    <td><span class="badge bg-info">{{ $item->response_status }}</span></td>
                    <td>{{ $item->follow_up_date?->format('d M Y') ?? '—' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('outreach.edit',$item) }}" class="btn btn-sm btn-outline-info">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('outreach.destroy',$item) }}" method="POST"
                                  onsubmit="return confirm('Delete this record?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center muted py-5">No outreach records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $outreach->links() }}
</div>
@endsection