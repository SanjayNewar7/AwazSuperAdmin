<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.layouts.app')

@section('content')
<div class="page-title">
    <h1>Dashboard Overview</h1>
    <ul class="breadcrumb">
        <li>Home</li>
        <li>Dashboard</li>
    </ul>
</div>

<!-- Stats Cards -->
<div class="stats-cards">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_issues'] }}</h3>
            <p>Total Issues</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_users'] }}</h3>
            <p>Registered Users</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['verified_users'] }}</h3>
            <p>Verified Users</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red">
            <i class="fas fa-comments"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_comments'] }}</h3>
            <p>Total Comments</p>
        </div>
    </div>
</div>

<!-- Analytics Section -->
<div class="analytics-section">
    <div class="section-header">
        <h2>Issue Analytics</h2>
        <div class="filter-controls">
                 {{-- District Dropdown --}}
<select name="district" id="district" class="form-control">
    <option value="">Select District</option>
    @foreach($districts as $d)
        <option value="{{ $d }}">{{ $d }}</option>
    @endforeach
</select>

{{-- Region Dropdown (initially empty) --}}
<select name="region" id="region" class="form-control">
    <option value="">Select Region</option>
</select>

{{-- Ward Dropdown (initially empty) --}}
<select name="ward" id="ward" class="form-control">
    <option value="">Select Ward</option>
</select>
            <input type="date" id="dateFilter">
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-header">
            <div class="chart-title">Issue Reports by Type</div>
            <div class="chart-actions">
                <select id="timeRangeFilter">
                    <option value="7">Last 7 Days</option>
                    <option value="30">Last 30 Days</option>
                    <option value="90">Last 90 Days</option>
                </select>
            </div>
        </div>
        <div class="chart-wrapper">
            <canvas id="issueTypeChart"></canvas>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-header">
            <div class="chart-title">Issue Trends Over Time</div>
        </div>
        <div class="chart-wrapper">
            <canvas id="issueTrendChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Issues Table -->
<div class="data-table">
    <div class="table-header">
        <h3>Recent Issues</h3>
        <button class="btn-primary">Export Report</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Issue ID</th>
                <th>Title</th>
                <th>User</th>
                <th>District</th>
                <th>Ward</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentIssues as $issue)
            <tr>
                <td>#ISS-{{ str_pad($issue->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $issue->heading }}</td>
                <td>{{ $issue->user->username ?? 'Unknown' }}</td>
                <td>{{ $issue->district }}</td>
                <td>{{ $issue->ward }}</td>
                <td>{{ $issue->report_type }}</td>
                <td>
                    @if($issue->fixed_count > 0)
                        <span class="status verified">Resolved</span>
                    @else
                        <span class="status pending">Pending</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.issues.show', $issue->id) }}" class="action-btn btn-view">View</a>
                    <button class="action-btn btn-warning">Warn</button>
                    <form action="{{ route('admin.issues.delete', $issue->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch analytics data
        fetchAnalyticsData();

        // Set up filter change events
        document.getElementById('districtFilter').addEventListener('change', fetchAnalyticsData);
        document.getElementById('regionFilter').addEventListener('change', fetchAnalyticsData);
        document.getElementById('wardFilter').addEventListener('change', fetchAnalyticsData);
        document.getElementById('dateFilter').addEventListener('change', fetchAnalyticsData);
        document.getElementById('timeRangeFilter').addEventListener('change', fetchAnalyticsData);

        function fetchAnalyticsData() {
            const filters = {
                district: document.getElementById('districtFilter').value,
                region: document.getElementById('regionFilter').value,
                ward: document.getElementById('wardFilter').value,
                date: document.getElementById('dateFilter').value,
                time_range: document.getElementById('timeRangeFilter').value
            };

            fetch('{{ route("admin.analytics") }}?' + new URLSearchParams(filters))
                .then(response => response.json())
                .then(data => {
                    updateCharts(data);
                })
                .catch(error => console.error('Error fetching analytics:', error));
        }

        function updateCharts(data) {
            // Update issue type chart
            updateIssueTypeChart(data.issue_types);

            // Update issue trend chart
            updateIssueTrendChart(data.issue_trends);
        }

        function updateIssueTypeChart(data) {
            const ctx = document.getElementById('issueTypeChart').getContext('2d');
            if (window.issueTypeChart) {
                window.issueTypeChart.destroy();
            }

            window.issueTypeChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        data: Object.values(data),
                        backgroundColor: [
                            '#1a73e8', '#4caf50', '#ff9800', '#9c27b0', '#f44336', '#607d8b'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                }
            });
        }

        function updateIssueTrendChart(data) {
            const ctx = document.getElementById('issueTrendChart').getContext('2d');
            if (window.issueTrendChart) {
                window.issueTrendChart.destroy();
            }

            window.issueTrendChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [{
                        label: 'Issues Reported',
                        data: data.map(item => item.count),
                        backgroundColor: 'rgba(26, 115, 232, 0.1)',
                        borderColor: '#1a73e8',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
