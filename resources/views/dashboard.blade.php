<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awaz - Super Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d47a1;
            --primary-light: #64b5f6;
            --secondary: #f5f7fa;
            --text-dark: #333;
            --text-light: #666;
            --text-lighter: #888;
            --white: #fff;
            --border: #e0e0e0;
            --success: #4caf50;
            --warning: #ff9800;
            --danger: #f44336;
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background: var(--primary);
            color: var(--white);
            height: 100vh;
            position: fixed;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: var(--shadow);
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }

        .sidebar-header h2 {
            font-weight: 600;
            font-size: 22px;
            margin-left: 10px;
        }

        .sidebar-header img {
            width: 40px;
            height: 40px;
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--white);
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 18px;
        }

        .menu-item span {
            font-size: 15px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 260px;
            transition: all 0.3s ease;
            overflow-x: hidden;
        }

        /* Header Styles */
        .header {
            background: var(--white);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: var(--secondary);
            border-radius: 8px;
            padding: 8px 15px;
            width: 300px;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            padding: 5px;
            width: 100%;
            font-size: 14px;
        }

        .search-box i {
            color: var(--text-lighter);
            margin-right: 8px;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .user-info h4 {
            font-size: 15px;
            font-weight: 500;
        }

        .user-info p {
            font-size: 13px;
            color: var(--text-lighter);
        }

        /* Content Area Styles */
        .content {
            padding: 30px;
        }

        .page-title {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-title h1 {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .breadcrumb {
            display: flex;
            list-style: none;
        }

        .breadcrumb li {
            font-size: 14px;
            color: var(--text-light);
        }

        .breadcrumb li:after {
            content: '/';
            margin: 0 10px;
        }

        .breadcrumb li:last-child:after {
            content: '';
        }

        .breadcrumb li:last-child {
            color: var(--primary);
            font-weight: 500;
        }

        /* Dashboard Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }

        .stat-icon.blue {
            background: rgba(26, 115, 232, 0.1);
            color: var(--primary);
        }

        .stat-icon.green {
            background: rgba(76, 175, 80, 0.1);
            color: var(--success);
        }

        .stat-icon.orange {
            background: rgba(255, 152, 0, 0.1);
            color: var(--warning);
        }

        .stat-icon.red {
            background: rgba(244, 67, 54, 0.1);
            color: var(--danger);
        }

        .stat-info h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-info p {
            font-size: 14px;
            color: var(--text-light);
        }

        /* Charts and Analytics */
        .analytics-section {
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .filter-controls {
            display: flex;
            gap: 10px;
        }

        .filter-controls select, .filter-controls input {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .chart-container {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            position: relative;
            height: 400px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: 500;
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Data Tables */
        .data-table {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }

        .table-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
        }

        .table-header h3 {
            font-size: 18px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            font-weight: 500;
            color: var(--text-light);
            background: var(--secondary);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: #f9f9f9;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status.pending {
            background: rgba(255, 152, 0, 0.1);
            color: var(--warning);
        }

        .status.verified {
            background: rgba(76, 175, 80, 0.1);
            color: var(--success);
        }

        .status.rejected {
            background: rgba(244, 67, 54, 0.1);
            color: var(--danger);
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            outline: none;
            transition: all 0.2s;
        }

        .btn-view {
            background: rgba(26, 115, 232, 0.1);
            color: var(--primary);
        }

        .btn-view:hover {
            background: rgba(26, 115, 232, 0.2);
        }

        .btn-warning {
            background: rgba(255, 152, 0, 0.1);
            color: var(--warning);
        }

        .btn-warning:hover {
            background: rgba(255, 152, 0, 0.2);
        }

        .btn-delete {
            background: rgba(244, 67, 54, 0.1);
            color: var(--danger);
        }

        .btn-delete:hover {
            background: rgba(244, 67, 54, 0.2);
        }

        .btn-notify {
            background: rgba(76, 175, 80, 0.1);
            color: var(--success);
        }

        .btn-notify:hover {
            background: rgba(76, 175, 80, 0.2);
        }

        /* User Verification Section */
        .verification-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .citizenship-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .citizenship-card h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .citizenship-image {
            width: 100%;
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .citizenship-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .verification-actions {
            display: flex;
            gap: 10px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--white);
            border-radius: 12px;
            width: 600px;
            max-width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: var(--text-light);
        }

        .modal-body {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: var(--secondary);
            color: var(--text-dark);
            border: 1px solid var(--border);
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #e6e9ed;
        }

        /* Content Sections */
        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        /* User Cards */
        .user-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .user-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .user-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .user-card-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .user-card-info h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .user-card-info p {
            font-size: 14px;
            color: var(--text-light);
        }

        .user-card-details {
            margin-bottom: 15px;
        }

        .user-card-details p {
            font-size: 14px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .user-card-details i {
            margin-right: 8px;
            color: var(--primary);
        }

        .user-card-actions {
            display: flex;
            gap: 10px;
        }

        /* Issue Detail Modal */
        .issue-images {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .issue-image {
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .issue-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* Notification Cards */
        .notification-cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .notification-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: flex-start;
        }

        .notification-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(26, 115, 232, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
            color: var(--primary);
        }

        .notification-content {
            flex: 1;
        }

        .notification-content h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .notification-content p {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 10px;
        }

        .notification-meta {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: var(--text-lighter);
        }

        .notification-meta i {
            margin-right: 5px;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
        }

        /* Image Upload */
        .image-upload {
            border: 2px dashed var(--border);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .image-upload i {
            font-size: 40px;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .image-upload p {
            color: var(--text-light);
            margin-bottom: 10px;
        }

        .image-upload-btn {
            background: var(--primary-light);
            color: var(--primary-dark);
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
        }

        .uploaded-image {
            margin-top: 15px;
            text-align: center;
        }

        .uploaded-image img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }
            .sidebar-header h2, .menu-item span {
                display: none;
            }
            .menu-item {
                justify-content: center;
            }
            .menu-item i {
                margin-right: 0;
            }
            .main-content {
                margin-left: 70px;
            }
            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }
            .verification-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }
            .search-box {
                width: 200px;
            }
            .filter-controls {
                flex-wrap: wrap;
            }
            .issue-images {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .header {
                padding: 15px;
            }
            .content {
                padding: 15px;
            }
            .filter-controls {
                flex-direction: column;
                width: 100%;
            }
            .user-info {
                display: none;
            }
            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .user-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-volume-up" style="font-size: 28px;"></i>
            <h2>Awaz Admin</h2>
        </div>
        <div class="sidebar-menu">
            <div class="menu-item active" data-section="dashboard">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </div>
            <div class="menu-item" data-section="analytics">
                <i class="fas fa-chart-bar"></i>
                <span>Analytics</span>
            </div>
            <div class="menu-item" data-section="issues">
                <i class="fas fa-exclamation-circle"></i>
                <span>Issues</span>
            </div>
            <div class="menu-item" data-section="users">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </div>
            <div class="menu-item" data-section="verification">
                <i class="fas fa-id-card"></i>
                <span>Verification</span>
            </div>
            <div class="menu-item" data-section="notifications">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </div>
            <div class="menu-item" data-section="settings">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </div>
            <div class="menu-item" id="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="user-profile">
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=1a73e8&color=fff" alt="Admin">
                <div class="user-info">
                    <h4>Super Admin</h4>
                    <p>Administrator</p>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content">
            <!-- Dashboard Section -->
            <div class="content-section active" id="dashboard-section">
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
                            <h3>1,248</h3>
                            <p>Total Issues</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>5,742</h3>
                            <p>Registered Users</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>893</h3>
                            <p>Verified Users</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon red">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-info">
                            <h3>3,456</h3>
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

                            <input type="date">
                        </div>
                    </div>

                    <div class="chart-container">
                        <div class="chart-header">
                            <div class="chart-title">Issue Reports by Type</div>
                            <div class="chart-actions">
                                <select>
                                    <option>Last 7 Days</option>
                                    <option>Last 30 Days</option>
                                    <option>Last 90 Days</option>
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
                            <tr>
                                <td>#ISS-001</td>
                                <td>Road damage at main street</td>
                                <td>user123</td>
                                <td>Kathmandu</td>
                                <td>15</td>
                                <td>Infrastructure</td>
                                <td><span class="status pending">Pending</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-issue="1">View</button>
                                    <button class="action-btn btn-warning">Warn</button>
                                    <button class="action-btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ISS-002</td>
                                <td>Water supply issue</td>
                                <td>user456</td>
                                <td>Lalitpur</td>
                                <td>7</td>
                                <td>Utility</td>
                                <td><span class="status verified">In Progress</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-issue="2">View</button>
                                    <button class="action-btn btn-notify">Notify</button>
                                    <button class="action-btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ISS-003</td>
                                <td>Garbage collection problem</td>
                                <td>user789</td>
                                <td>Bhaktapur</td>
                                <td>3</td>
                                <td>Sanitation</td>
                                <td><span class="status rejected">Resolved</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-issue="3">View</button>
                                    <button class="action-btn btn-warning">Warn</button>
                                    <button class="action-btn btn-delete">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="content-section" id="analytics-section">
                <div class="page-title">
                    <h1>Advanced Analytics</h1>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li>Analytics</li>
                    </ul>
                </div>

                <div class="analytics-section">
                    <div class="section-header">
                        <h2>Detailed Analytics</h2>
                        <div class="filter-controls">
                            <select>
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                                <option>Last 90 Days</option>
                                <option>Last Year</option>
                            </select>
                            <select>
                                <option>All Issue Types</option>
                                <option>Infrastructure</option>
                                <option>Utility</option>
                                <option>Sanitation</option>
                                <option>Public Space</option>
                            </select>
                        </div>
                    </div>

                    <div class="chart-container">
                        <div class="chart-header">
                            <div class="chart-title">Issues by District</div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="districtChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-container">
                        <div class="chart-header">
                            <div class="chart-title">User Demographics</div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="demographicsChart"></canvas>
                        </div>
                    </div>

                    <div class="data-table">
                        <div class="table-header">
                            <h3>Top Issues by Engagement</h3>
                            <button class="btn-primary">Export Data</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Issue ID</th>
                                    <th>Title</th>
                                    <th>District</th>
                                    <th>Likes</th>
                                    <th>Comments</th>
                                    <th>Shares</th>
                                    <th>Engagement Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ISS-045</td>
                                    <td>Water shortage in ward 10</td>
                                    <td>Kathmandu</td>
                                    <td>245</td>
                                    <td>89</td>
                                    <td>56</td>
                                    <td>18.2%</td>
                                </tr>
                                <tr>
                                    <td>#ISS-089</td>
                                    <td>Road repair needed</td>
                                    <td>Lalitpur</td>
                                    <td>189</td>
                                    <td>67</td>
                                    <td>42</td>
                                    <td>15.7%</td>
                                </tr>
                                <tr>
                                    <td>#ISS-122</td>
                                    <td>Garbage collection issue</td>
                                    <td>Bhaktapur</td>
                                    <td>167</td>
                                    <td>54</td>
                                    <td>38</td>
                                    <td>14.3%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Issues Section -->
            <div class="content-section" id="issues-section">
                <div class="page-title">
                    <h1>Issue Management</h1>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li>Issues</li>
                    </ul>
                </div>

                <div class="filter-controls" style="margin-bottom: 20px;">
                    <select>
                        <option>All Statuses</option>
                        <option>Pending</option>
                        <option>In Progress</option>
                        <option>Resolved</option>
                        <option>Rejected</option>
                    </select>
                    <select>
                        <option>All Districts</option>
                        <option>Kathmandu</option>
                        <option>Lalitpur</option>
                        <option>Bhaktapur</option>
                    </select>
                    <select>
                        <option>All Wards</option>
                        <option>Ward 1</option>
                        <option>Ward 2</option>
                        <option>Ward 3</option>
                    </select>
                    <input type="text" placeholder="Search issues...">
                </div>

                <div class="data-table">
                    <div class="table-header">
                        <h3>All Issues</h3>
                        <div>
                            <button class="btn-secondary" style="margin-right: 10px;">Export</button>
                            <button class="btn-primary">Add New Issue</button>
                        </div>
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
                            <tr>
                                <td>#ISS-001</td>
                                <td>Road damage at main street</td>
                                <td>user123</td>
                                <td>Kathmandu, Ward 15</td>
                                <td>2023-10-15</td>
                                <td><span class="status pending">Pending</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-issue="1">View</button>
                                    <button class="action-btn btn-warning">Warn</button>
                                    <button class="action-btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ISS-002</td>
                                <td>Water supply issue</td>
                                <td>user456</td>
                                <td>Lalitpur, Ward 7</td>
                                <td>2023-10-14</td>
                                <td><span class="status verified">In Progress</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-issue="2">View</button>
                                    <button class="action-btn btn-notify">Notify</button>
                                    <button class="action-btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ISS-003</td>
                                <td>Garbage collection problem</td>
                                <td>user789</td>
                                <td>Bhaktapur, Ward 3</td>
                                <td>2023-10-13</td>
                                <td><span class="status rejected">Resolved</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-issue="3">View</button>
                                    <button class="action-btn btn-warning">Warn</button>
                                    <button class="action-btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ISS-004</td>
                                <td>Electricity outage</td>
                                <td>user101</td>
                                <td>Kathmandu, Ward 12</td>
                                <td>2023-10-12</td>
                                <td><span class="status pending">Pending</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-issue="4">View</button>
                                    <button class="action-btn btn-warning">Warn</button>
                                    <button class="action-btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ISS-005</td>
                                <td>Park maintenance needed</td>
                                <td>user202</td>
                                <td>Lalitpur, Ward 9</td>
                                <td>2023-10-11</td>
                                <td><span class="status verified">In Progress</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-issue="5">View</button>
                                    <button class="action-btn btn-notify">Notify</button>
                                    <button class="action-btn btn-delete">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Users Section -->
            <div class="content-section" id="users-section">
                <div class="page-title">
                    <h1>User Management</h1>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li>Users</li>
                    </ul>
                </div>

                <div class="filter-controls" style="margin-bottom: 20px;">
                    <select>
                        <option>All Users</option>
                        <option>Verified</option>
                        <option>Pending Verification</option>
                        <option>Suspended</option>
                    </select>
                    <select>
                        <option>All Districts</option>
                        <option>Kathmandu</option>
                        <option>Lalitpur</option>
                        <option>Bhaktapur</option>
                    </select>
                    <input type="text" placeholder="Search users...">
                </div>

                <div class="user-cards">
                    <div class="user-card">
                        <div class="user-card-header">
                            <img src="https://ui-avatars.com/api/?name=Ram+Sharma&background=1a73e8&color=fff" alt="User">
                            <div class="user-card-info">
                                <h3>Ram Sharma</h3>
                                <p>@ramsharma</p>
                            </div>
                        </div>
                        <div class="user-card-details">
                            <p><i class="fas fa-map-marker-alt"></i> Kathmandu, Ward 5</p>
                            <p><i class="fas fa-phone"></i> +977 9841122334</p>
                            <p><i class="fas fa-envelope"></i> ram.sharma@example.com</p>
                            <p><i class="fas fa-exclamation-circle"></i> 12 issues reported</p>
                        </div>
                        <div class="user-card-actions">
                            <button class="action-btn btn-view">View Profile</button>
                            <button class="action-btn btn-warning">Warn</button>
                            <button class="action-btn btn-delete">Suspend</button>
                        </div>
                    </div>

                    <div class="user-card">
                        <div class="user-card-header">
                            <img src="https://ui-avatars.com/api/?name=Sita+Aryal&background=1a73e8&color=fff" alt="User">
                            <div class="user-card-info">
                                <h3>Sita Aryal</h3>
                                <p>@sitaaryal</p>
                            </div>
                        </div>
                        <div class="user-card-details">
                            <p><i class="fas fa-map-marker-alt"></i> Lalitpur, Ward 7</p>
                            <p><i class="fas fa-phone"></i> +977 9851234567</p>
                            <p><i class="fas fa-envelope"></i> sita.aryal@example.com</p>
                            <p><i class="fas fa-exclamation-circle"></i> 8 issues reported</p>
                        </div>
                        <div class="user-card-actions">
                            <button class="action-btn btn-view">View Profile</button>
                            <button class="action-btn btn-warning">Warn</button>
                            <button class="action-btn btn-delete">Suspend</button>
                        </div>
                    </div>

                    <div class="user-card">
                        <div class="user-card-header">
                            <img src="https://ui-avatars.com/api/?name=Hari+Gurung&background=1a73e8&color=fff" alt="User">
                            <div class="user-card-info">
                                <h3>Hari Gurung</h3>
                                <p>@harigurung</p>
                            </div>
                        </div>
                        <div class="user-card-details">
                            <p><i class="fas fa-map-marker-alt"></i> Bhaktapur, Ward 3</p>
                            <p><i class="fas fa-phone"></i> +977 9862345678</p>
                            <p><i class="fas fa-envelope"></i> hari.gurung@example.com</p>
                            <p><i class="fas fa-exclamation-circle"></i> 5 issues reported</p>
                        </div>
                        <div class="user-card-actions">
                            <button class="action-btn btn-view">View Profile</button>
                            <button class="action-btn btn-warning">Warn</button>
                            <button class="action-btn btn-delete">Suspend</button>
                        </div>
                    </div>

                    <div class="user-card">
                        <div class="user-card-header">
                            <img src="https://ui-avatars.com/api/?name=Gita+Thapa&background=1a73e8&color=fff" alt="User">
                            <div class="user-card-info">
                                <h3>Gita Thapa</h3>
                                <p>@gitathapa</p>
                            </div>
                        </div>
                        <div class="user-card-details">
                            <p><i class="fas fa-map-marker-alt"></i> Kathmandu, Ward 10</p>
                            <p><i class="fas fa-phone"></i> +977 9873456789</p>
                            <p><i class="fas fa-envelope"></i> gita.thapa@example.com</p>
                            <p><i class="fas fa-exclamation-circle"></i> 15 issues reported</p>
                        </div>
                        <div class="user-card-actions">
                            <button class="action-btn btn-view">View Profile</button>
                            <button class="action-btn btn-warning">Warn</button>
                            <button class="action-btn btn-delete">Suspend</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification Section -->
            <div class="content-section" id="verification-section">
                <div class="page-title">
                    <h1>User Verification</h1>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li>Verification</li>
                    </ul>
                </div>

                <div class="filter-controls" style="margin-bottom: 20px;">
                    <select>
                        <option>All Users</option>
                        <option>Pending Verification</option>
                        <option>Verified</option>
                        <option>Rejected</option>
                    </select>
                    <input type="text" placeholder="Search users...">
                </div>

                <div class="user-card" style="margin-bottom: 30px;">
                    <div class="user-card-header">
                        <img src="https://ui-avatars.com/api/?name=Ram+Sharma&background=1a73e8&color=fff" alt="User">
                        <div class="user-card-info">
                            <h3>Ram Sharma</h3>
                            <p>@ramsharma | Citizenship: 123-456-7890</p>
                        </div>
                    </div>
                    <div class="user-card-details">
                        <p><i class="fas fa-map-marker-alt"></i> Kathmandu, Ward 5</p>
                        <p><i class="fas fa-phone"></i> +977 9841122334</p>
                        <p><i class="fas fa-envelope"></i> ram.sharma@example.com</p>
                        <p><i class="fas fa-clock"></i> Verification Pending</p>
                    </div>
                </div>

                <div class="verification-container">
                    <div class="citizenship-card">
                        <h3>Front Side of Citizenship</h3>
                        <div class="citizenship-image">
                            <img src="https://via.placeholder.com/400x250?text=Front+Side+of+Citizenship" alt="Citizenship Front">
                        </div>
                        <div class="verification-actions">
                            <button class="btn-primary">Approve</button>
                            <button class="btn-secondary">Reject</button>
                            <button class="action-btn btn-view">View Details</button>
                        </div>
                    </div>

                    <div class="citizenship-card">
                        <h3>Back Side of Citizenship</h3>
                        <div class="citizenship-image">
                            <img src="https://via.placeholder.com/400x250?text=Back+Side+of+Citizenship" alt="Citizenship Back">
                        </div>
                        <div class="verification-actions">
                            <button class="btn-primary">Approve</button>
                            <button class="btn-secondary">Reject</button>
                            <button class="action-btn btn-view">View Details</button>
                        </div>
                    </div>
                </div>

                <div class="data-table" style="margin-top: 30px;">
                    <div class="table-header">
                        <h3>Verification History</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th>Reviewed By</th>
                                <th>Reviewed On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ram Sharma</td>
                                <td>2023-10-15</td>
                                <td><span class="status pending">Pending</span></td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <button class="action-btn btn-view">Review</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Sita Aryal</td>
                                <td>2023-10-14</td>
                                <td><span class="status verified">Verified</span></td>
                                <td>Super Admin</td>
                                <td>2023-10-14</td>
                                <td>
                                    <button class="action-btn btn-view">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Hari Gurung</td>
                                <td>2023-10-13</td>
                                <td><span class="status rejected">Rejected</span></td>
                                <td>Super Admin</td>
                                <td>2023-10-13</td>
                                <td>
                                    <button class="action-btn btn-view">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Notifications Section -->
            <div class="content-section" id="notifications-section">
                <div class="page-title">
                    <h1>Notification Center</h1>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li>Notifications</li>
                    </ul>
                </div>

                <div class="section-header">
                    <h2>Send New Notification</h2>
                    <button class="btn-primary" id="compose-notification">Compose Notification</button>
                </div>

                <div class="notification-cards">
                    <div class="notification-card">
                        <div class="notification-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="notification-content">
                            <h3>Water Supply Restored</h3>
                            <p>The water supply issue in Ward 7 has been resolved. Thank you for your patience.</p>
                            <div class="notification-meta">
                                <i class="fas fa-clock"></i> Sent on 2023-10-15 at 14:30
                            </div>
                        </div>
                        <div class="notification-actions">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </div>
                    </div>

                    <div class="notification-card">
                        <div class="notification-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="notification-content">
                            <h3>Road Repair Notice</h3>
                            <p>Please be advised that the main street in Ward 15 will be under repair from tomorrow.</p>
                            <div class="notification-meta">
                                <i class="fas fa-clock"></i> Sent on 2023-10-14 at 09:15
                            </div>
                        </div>
                        <div class="notification-actions">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </div>
                    </div>

                    <div class="notification-card">
                        <div class="notification-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="notification-content">
                            <h3>Issue Resolved: Garbage Collection</h3>
                            <p>The garbage collection problem in Ward 3 has been fixed. Regular schedule will resume from tomorrow.</p>
                            <div class="notification-meta">
                                <i class="fas fa-clock"></i> Sent on 2023-10-13 at 16:45
                            </div>
                        </div>
                        <div class="notification-actions">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="content-section" id="settings-section">
                <div class="page-title">
                    <h1>System Settings</h1>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li>Settings</li>
                    </ul>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <h3>General Settings</h3>
                        <div class="settings-option">
                            <div class="settings-info">
                                <h4>System Notifications</h4>
                                <p>Receive alerts for important system events</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-option">
                            <div class="settings-info">
                                <h4>Email Notifications</h4>
                                <p>Receive daily summary reports via email</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-option">
                            <div class="settings-info">
                                <h4>Auto Refresh Data</h4>
                                <p>Automatically refresh data every 5 minutes</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="settings-card">
                        <h3>User Management Settings</h3>
                        <div class="settings-option">
                            <div class="settings-info">
                                <h4>Auto Verify Users</h4>
                                <p>Automatically verify users with valid documents</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-option">
                            <div class="settings-info">
                                <h4>Require Re-verification</h4>
                                <p>Ask users to re-verify their account annually</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="settings-card">
                        <h3>Issue Management Settings</h3>
                        <div class="settings-option">
                            <div class="settings-info">
                                <h4>Auto Escalate Issues</h4>
                                <p>Automatically escalate unresolved issues after 7 days</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="settings-option">
                            <div class="settings-info">
                                <h4>Notify All Users</h4>
                                <p>Send notifications to all users when an issue is resolved</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Modal -->
    <div class="modal" id="notificationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Send Notification</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="notificationTitle">Title</label>
                    <input type="text" id="notificationTitle" placeholder="Enter notification title">
                </div>
                <div class="form-group">
                    <label for="notificationMessage">Message</label>
                    <textarea id="notificationMessage" placeholder="Enter notification message"></textarea>
                </div>

                <div class="form-group">
                    <label for="notificationImage">Add Image (Show Issue Resolution)</label>
                    <div class="image-upload" id="imageUploadArea">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Drag & drop an image here or click to browse</p>
                        <button class="image-upload-btn">Select Image</button>
                        <input type="file" id="notificationImage" accept="image/*" style="display: none;">
                    </div>
                    <div class="uploaded-image" id="uploadedImageContainer" style="display: none;">
                        <img id="uploadedImage" src="" alt="Uploaded Image">
                        <button class="action-btn btn-delete" id="removeImageBtn" style="margin-top: 10px;">Remove Image</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="notificationUsers">Send To</label>
                    <select id="notificationUsers">
                        <option value="all">All Users</option>
                        <option value="engaged">Engaged Users (Liked/Commented/Supported)</option>
                        <option value="verified">Verified Users Only</option>
                        <option value="district">Issue District Users</option>
                        <option value="region">Issue Region Users</option>
                        <option value="ward">Issue Ward Users</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary">Cancel</button>
                <button class="btn-primary">Send Notification</button>
            </div>
        </div>
    </div>

    <!-- Issue Detail Modal -->
    <div class="modal" id="issueDetailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Issue Details</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Issue Title</label>
                    <input type="text" value="Road damage at main street" readonly>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea readonly>The main street in ward 15 has severe damage with multiple potholes, making it difficult for vehicles to pass through. This needs immediate attention.</textarea>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" value="Kathmandu, Ward 15" readonly>
                </div>
                <div class="form-group">
                    <label>Issue Type</label>
                    <input type="text" value="Infrastructure" readonly>
                </div>
                <div class="form-group">
                    <label>Reported By</label>
                    <input type="text" value="user123 (Ram Sharma)" readonly>
                </div>
                <div class="form-group">
                    <label>Reported On</label>
                    <input type="text" value="2023-10-15 at 14:23" readonly>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" value="Pending" readonly>
                </div>
                <div class="issue-images">
                    <div class="issue-image">
                        <img src="https://via.placeholder.com/400x300?text=Issue+Photo+1" alt="Issue Photo 1">
                    </div>
                    <div class="issue-image">
                        <img src="https://via.placeholder.com/400x300?text=Issue+Photo+2" alt="Issue Photo 2">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary">Close</button>
                <button class="btn-primary">Update Status</button>
            </div>
        </div>
    </div>

   <script>
    // Charts initialization
    document.addEventListener('DOMContentLoaded', function() {
        /** =========================
         *  CHARTS
         *  ========================= */
        const issueTypeCtx = document.getElementById('issueTypeChart').getContext('2d');
        const issueTypeChart = new Chart(issueTypeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Infrastructure', 'Utility', 'Sanitation', 'Public Space', 'Security', 'Other'],
                datasets: [{
                    data: [30, 25, 20, 15, 5, 5],
                    backgroundColor: ['#1a73e8','#4caf50','#ff9800','#9c27b0','#f44336','#607d8b'],
                    borderWidth: 0
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right' } } }
        });

        const issueTrendCtx = document.getElementById('issueTrendChart').getContext('2d');
        const issueTrendChart = new Chart(issueTrendCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Issues Reported',
                    data: [120, 150, 180, 90, 130, 160, 200],
                    backgroundColor: 'rgba(26, 115, 232, 0.1)',
                    borderColor: '#1a73e8',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
        });

        const districtCtx = document.getElementById('districtChart').getContext('2d');
        const districtChart = new Chart(districtCtx, {
            type: 'bar',
            data: {
                labels: ['Kathmandu', 'Lalitpur', 'Bhaktapur', 'Pokhara', 'Biratnagar'],
                datasets: [{ label: 'Issues by District', data: [450, 320, 280, 190, 150], backgroundColor: '#1a73e8', borderWidth: 0 }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
        });

        const demographicsCtx = document.getElementById('demographicsChart').getContext('2d');
        const demographicsChart = new Chart(demographicsCtx, {
            type: 'pie',
            data: {
                labels: ['18-24', '25-34', '35-44', '45-54', '55+'],
                datasets: [{
                    data: [25, 35, 20, 12, 8],
                    backgroundColor: ['#1a73e8','#4caf50','#ff9800','#9c27b0','#f44336'],
                    borderWidth: 0
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right' } } }
        });

        /** =========================
         *  MODALS
         *  ========================= */
        const modals = document.querySelectorAll('.modal');
        const notifyButtons = document.querySelectorAll('.btn-notify, #compose-notification');
        const viewButtons = document.querySelectorAll('.btn-view');
        const closeButtons = document.querySelectorAll('.close-modal');

        notifyButtons.forEach(button => {
            button.addEventListener('click', () => document.getElementById('notificationModal').style.display = 'flex');
        });

        viewButtons.forEach(button => {
            if (button.getAttribute('data-issue')) {
                button.addEventListener('click', () => document.getElementById('issueDetailModal').style.display = 'flex');
            }
        });

        closeButtons.forEach(button => {
            button.addEventListener('click', () => modals.forEach(modal => modal.style.display = 'none'));
        });

        window.addEventListener('click', (event) => {
            modals.forEach(modal => { if (event.target === modal) modal.style.display = 'none'; });
        });

        /** =========================
         *  MENU NAVIGATION
         *  ========================= */
        const menuItems = document.querySelectorAll('.menu-item');
        const contentSections = document.querySelectorAll('.content-section');

        menuItems.forEach(item => {
            if (item.id !== 'logout-btn') {
                item.addEventListener('click', () => {
                    const sectionId = item.getAttribute('data-section') + '-section';
                    menuItems.forEach(menuItem => menuItem.classList.remove('active'));
                    item.classList.add('active');
                    contentSections.forEach(section => section.classList.remove('active'));
                    document.getElementById(sectionId).classList.add('active');
                });
            }
        });

        /** =========================
         *  LOGOUT
         *  ========================= */
        document.getElementById('logout-btn').addEventListener('click', () => {
            if (confirm('Are you sure you want to logout?')) window.location.href = 'login.html';
        });

        /** =========================
         *  IMAGE UPLOAD
         *  ========================= */
        const imageUploadArea = document.getElementById('imageUploadArea');
        const notificationImage = document.getElementById('notificationImage');
        const uploadedImageContainer = document.getElementById('uploadedImageContainer');
        const uploadedImage = document.getElementById('uploadedImage');
        const removeImageBtn = document.getElementById('removeImageBtn');

        imageUploadArea.addEventListener('click', () => notificationImage.click());

        notificationImage.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    uploadedImage.src = e.target.result;
                    uploadedImageContainer.style.display = 'block';
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        removeImageBtn.addEventListener('click', () => {
            notificationImage.value = '';
            uploadedImageContainer.style.display = 'none';
        });

        imageUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUploadArea.style.borderColor = '#1a73e8';
            imageUploadArea.style.backgroundColor = 'rgba(26, 115, 232, 0.05)';
        });

        imageUploadArea.addEventListener('dragleave', () => {
            imageUploadArea.style.borderColor = '#e0e0e0';
            imageUploadArea.style.backgroundColor = 'transparent';
        });

        imageUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUploadArea.style.borderColor = '#e0e0e0';
            imageUploadArea.style.backgroundColor = 'transparent';

            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                notificationImage.files = e.dataTransfer.files;
                const reader = new FileReader();
                reader.onload = (e) => {
                    uploadedImage.src = e.target.result;
                    uploadedImageContainer.style.display = 'block';
                };
                reader.readAsDataURL(e.dataTransfer.files[0]);
            }
        });

        /** =========================
         *  CASCADING DROPDOWNS
         *  ========================= */
        const districtSelect = document.getElementById('district');
        const regionSelect = document.getElementById('region');
        const wardSelect = document.getElementById('ward');

        if (districtSelect && regionSelect && wardSelect) {
            districtSelect.addEventListener('change', function() {
    const district = this.value;
    console.log('Selected District:', district); // Debug: Log selected district

    regionSelect.innerHTML = '<option value="">Select Region</option>';
    wardSelect.innerHTML = '<option value="">Select Ward</option>';

    if (district) {
        fetch(`/admin/get-regions?district=${encodeURIComponent(district)}`)
            .then(res => {
                console.log('Response Status:', res.status); // Debug: Log response status
                return res.json();
            })
            .then(data => {
                console.log('Fetched Regions:', data); // Debug: Log fetched regions
                data.forEach(region => {
                    const opt = document.createElement('option');
                    opt.value = region;
                    opt.textContent = region;
                    regionSelect.appendChild(opt);
                });
            })
            .catch(error => {
                console.error('Error fetching regions:', error); // Debug: Log errors
            });
    }
});
            regionSelect.addEventListener('change', function() {
                const district = districtSelect.value;
                const region = this.value;

                wardSelect.innerHTML = '<option value="">Select Ward</option>';

                if (district && region) {
                    fetch(`/admin/get-wards?district=${district}&region=${region}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(ward => {
                                const opt = document.createElement('option');
                                opt.value = ward;
                                opt.textContent = ward;
                                wardSelect.appendChild(opt);
                            });
                        });
                }
            });
        }
    });
</script>

</body>
</html>
