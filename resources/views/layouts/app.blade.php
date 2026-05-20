<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'School Attendance System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;
            --secondary: #0ea5e9;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --sidebar-width: 260px;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: #f1f5f9;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--darker) 0%, var(--dark) 100%);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 800;
            margin: 0;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .sidebar-brand .brand-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            font-size: 1.5rem;
            color: #fff;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav .nav-label {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0.75rem 1.5rem 0.5rem;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 0.65rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-nav .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.08);
        }

        .sidebar-nav .nav-link.active {
            color: #fff;
            background: rgba(79, 70, 229, 0.2);
            border-left-color: var(--primary);
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .top-navbar {
            background: #fff;
            padding: 0.75rem 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .top-navbar h5 {
            margin: 0;
            font-weight: 700;
            color: var(--dark);
        }

        .content-wrapper {
            padding: 1.5rem 2rem;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.04);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }

        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
        }

        .stat-card .stat-label {
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-custom {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .card-custom .card-header {
            background: transparent;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
        }

        .card-custom .card-header h6 {
            margin: 0;
            font-weight: 700;
            color: var(--dark);
        }

        .card-custom .card-body {
            padding: 1.5rem;
        }

        .table-custom {
            margin: 0;
        }

        .table-custom thead th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.875rem 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-custom tbody td {
            padding: 0.875rem 1rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.9rem;
        }

        .table-custom tbody tr:hover {
            background: #f8fafc;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            color: #fff;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--primary-dark), #3730a3);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
            color: #fff;
        }

        .badge-status {
            padding: 0.35em 0.75em;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .badge-active { background: rgba(16,185,129,0.1); color: var(--success); }
        .badge-inactive { background: rgba(239,68,68,0.1); color: var(--danger); }
        .badge-present { background: rgba(16,185,129,0.1); color: var(--success); }
        .badge-absent { background: rgba(239,68,68,0.1); color: var(--danger); }
        .badge-late { background: rgba(245,158,11,0.1); color: var(--warning); }
        .badge-excused { background: rgba(14,165,233,0.1); color: var(--secondary); }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.85rem;
            margin-bottom: 0.4rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .page-header h4 {
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }

        .search-box {
            position: relative;
        }

        .search-box .form-control {
            padding-left: 2.5rem;
        }

        .search-box i {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h4>School Attendance</h4>
            <small class="text-muted" style="color: rgba(255,255,255,0.4) !important; font-size: 0.7rem;">Management System</small>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Main</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="nav-label">Management</div>
            <a href="{{ route('teachers.index') }}" class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> Teachers
            </a>
            <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i> Students
            </a>
            <a href="{{ route('classes.index') }}" class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">
                <i class="fas fa-school"></i> Classes
            </a>
            <a href="{{ route('subjects.index') }}" class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Subjects
            </a>

            <div class="nav-label">Schedule</div>
            <a href="{{ route('periods.index') }}" class="nav-link {{ request()->routeIs('periods.*') ? 'active' : '' }}">
                <i class="fas fa-clock"></i> Periods / Timetable
            </a>

            <div class="nav-label">Attendance</div>
            <a href="{{ route('attendance.mark') }}" class="nav-link {{ request()->routeIs('attendance.mark') ? 'active' : '' }}">
                <i class="fas fa-clipboard-check"></i> Mark Attendance
            </a>
            <a href="{{ route('attendance.index') }}" class="nav-link {{ request()->routeIs('attendance.index') ? 'active' : '' }}">
                <i class="fas fa-list-check"></i> View Attendance
            </a>
            <a href="{{ route('attendance.report') }}" class="nav-link {{ request()->routeIs('attendance.report') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Reports
            </a>
        </nav>
    </div>

    <div class="main-content">
        <div class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="fas fa-bars"></i>
                </button>
                <h5>@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted" style="font-size: 0.85rem;">
                    <i class="fas fa-calendar-alt me-1"></i>
                    {{ now()->format('l, d M Y') }}
                </span>
            </div>
        </div>

        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; border: none; background: rgba(16,185,129,0.1); color: #065f46;">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; border: none; background: rgba(239,68,68,0.1); color: #991b1b;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.alert-dismissible').forEach(function(alert) {
            setTimeout(function() {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    </script>
    @yield('scripts')
</body>
</html>
