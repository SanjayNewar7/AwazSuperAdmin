@extends('layouts.admin')

@section('content')
<div class="content-section" id="issues-section">
    <div class="page-title">
        <h1>Issue Management</h1>
        <ul class="breadcrumb">
            <li>Home</li>
            <li>Issues</li>
        </ul>
    </div>

    <div class="filter-controls mb-4">
        <form method="GET" action="{{ route('admin.issues.index') }}">
            <select name="status">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status')=='pending' ? 'selected':'' }}>Pending</option>
                <option value="in_progress" {{ request('status')=='in_progress' ? 'selected':'' }}>In Progress</option>
                <option value="resolved" {{ request('status')=='resolved' ? 'selected':'' }}>Resolved</option>
                <option value="rejected" {{ request('status')=='rejected' ? 'selected':'' }}>Rejected</option>
            </select>
            <input type="text" name="search" placeholder="Search issues..." value="{{ request('search') }}">
            <button type="submit" class="btn-primary">Filter</button>
        </form>
    </div>

    <div class="data-table">
        <div class="table-header">
            <h3>All Issues</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Issue ID</th>
                    <th>Title</th>
                    <th>User</th>
                    <th>Location</th>
                    <th>Reported On</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues as $issue)
                    <tr>
                        <td>#ISS-{{ $issue->id }}</td>
                        <td>{{ $issue->heading }}</td>
                        <td>{{ $issue->user ? $issue->user->name : 'N/A' }}</td>
                        <td>{{ $issue->district }}, Ward {{ $issue->ward }}</td>
                        <td>{{ $issue->created_at->format('Y-m-d') }}</td>
                        <td><span class="status {{ strtolower($issue->status) }}">{{ ucfirst($issue->status) }}</span></td>
                        <td>
                            <a href="{{ route('admin.issues.show', $issue->id) }}" class="action-btn btn-view">View</a>
                            <form action="{{ route('admin.issues.notify', $issue->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="action-btn btn-warning">Warn</button>
                            </form>
                            <form action="{{ route('admin.issues.delete', $issue->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="action-btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">No issues found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $issues->links() }}
    </div>
</div>
@endsection
