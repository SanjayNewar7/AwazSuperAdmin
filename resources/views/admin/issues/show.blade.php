@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-title">
        <h1>Issue Details</h1>
        <ul class="breadcrumb">
            <li>Home</li>
            <li>Issues</li>
            <li>Details</li>
        </ul>
    </div>

    <div class="user-card" style="margin-bottom: 20px;">
        <div class="user-card-header">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($issue->user->username ?? 'Unknown') }}&background=1a73e8&color=fff" alt="User">
            <div class="user-card-info">
                <h3>{{ $issue->user->username ?? 'Unknown' }}</h3>
                <p>Reported on {{ $issue->created_at->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>

    <div class="data-table">
        <div class="table-header">
            <h3>Issue Information</h3>
        </div>
        <table>
            <tr>
                <th>Title</th>
                <td>{{ $issue->heading }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $issue->description }}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{ $issue->report_type }}</td>
            </tr>
            <tr>
                <th>Location</th>
                <td>{{ $issue->district }}, Ward {{ $issue->ward }}, {{ $issue->area_name }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($issue->fixed_count > 0)
                        <span class="status verified">Resolved</span>
                    @else
                        <span class="status pending">Pending</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Support Count</th>
                <td>{{ $issue->support_count }}</td>
            </tr>
            <tr>
                <th>Affected Count</th>
                <td>{{ $issue->affected_count }}</td>
            </tr>
        </table>
    </div>

    @if($issue->photo1 || $issue->photo2)
    <div class="data-table" style="margin-top: 20px;">
        <div class="table-header">
            <h3>Issue Photos</h3>
        </div>
        <div class="issue-images" style="padding: 20px;">
            @if($issue->photo1)
            <div class="issue-image">
                <img src="{{ asset('storage/' . $issue->photo1) }}" alt="Issue Photo 1">
            </div>
            @endif
            @if($issue->photo2)
            <div class="issue-image">
                <img src="{{ asset('storage/' . $issue->photo2) }}" alt="Issue Photo 2">
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="modal-footer" style="margin-top: 20px;">
        <a href="{{ route('admin.issues.index') }}" class="btn-secondary">Back to Issues</a>
        <form action="{{ route('admin.issues.delete', $issue->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete Issue</button>
        </form>
    </div>
</div>
@endsection
