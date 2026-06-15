<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM BOQ Enterprise')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Simple-DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* CSS Variables untuk Tema */
        :root {
            /* Tema Terang (Default) */
            --bg-body: #f8fafc;
            --bg-sidebar: #ffffff;
            --bg-header: #ffffff;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #e0e7ff;
            --hover-sidebar: #f1f5f9;
            --card-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.025);
        }

        [data-theme="dark"] {
            /* Premium Dark Mode (Zinc/Neutral palette - Vercel/GitHub style) */
            --bg-body: #09090b; 
            --bg-sidebar: #18181b; 
            --bg-header: #18181b;
            --bg-card: #18181b;
            --text-main: #fafafa; 
            --text-muted: #a1a1aa; 
            --border-color: #27272a; 
            --primary: #818cf8; 
            --primary-hover: #a5b4fc; 
            --primary-light: rgba(99, 102, 241, 0.15); 
            --hover-sidebar: #27272a; 
            --card-shadow: 0 4px 6px -1px rgba(0,0,0,0.5); 
            color-scheme: dark;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        h1, h2, h3, h4, h5, h6, .brand-text {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
        }

        /* Form Inputs & Placeholder Legibility untuk Dark Mode */
        .form-control, .form-select, .input-group-text {
            background-color: var(--bg-body) !important;
            color: var(--text-main) !important;
            border-color: var(--border-color) !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.25rem var(--primary-light) !important;
        }
        .form-control::placeholder {
            color: var(--text-muted) !important;
            opacity: 0.7 !important;
        }
        .form-control:disabled, .form-control[readonly], .input-group-text {
            background-color: var(--hover-sidebar) !important;
            opacity: 1;
        }

        /* Tables & DataTables Dark Mode Support */
        .table {
            color: var(--text-main) !important;
            border-color: var(--border-color) !important;
        }
        .table th {
            background-color: var(--hover-sidebar) !important;
            border-bottom-color: var(--border-color) !important;
            color: var(--text-main) !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        .table td {
            background-color: var(--bg-card) !important;
            border-bottom-color: var(--border-color) !important;
            color: var(--text-main) !important;
        }
        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: rgba(255, 255, 255, 0.02) !important;
            color: var(--text-main) !important;
        }
        .table-hover > tbody > tr:hover > * {
            background-color: var(--hover-sidebar) !important;
            color: var(--text-main) !important;
        }
        
        /* Simple DataTables Specific */
        .dataTable-input, .dataTable-selector {
            background-color: var(--hover-sidebar) !important;
            color: var(--text-main) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
        }
        .dataTable-selector {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23a1a1aa' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right 0.75rem center !important;
            background-size: 16px 12px !important;
            padding-right: 2rem !important;
            appearance: none;
        }
        .dataTable-input:focus, .dataTable-selector:focus {
            outline: none;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.25rem var(--primary-light) !important;
        }
        .dataTable-info, .dataTable-pagination a {
            color: var(--text-muted) !important;
        }
        .dataTable-pagination li.active a {
            background-color: var(--primary) !important;
            color: #fff !important;
            border-color: var(--primary) !important;
        }
        .dataTable-pagination a:hover {
            background-color: var(--hover-sidebar) !important;
        }

        /* Scrollbar Global & Table Horizontal Scroll */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-body);
        }
        ::-webkit-scrollbar-thumb {
            background-color: var(--border-color);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background-color: var(--text-muted);
        }

        /* Layout Structure */
        #app-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            height: 76px;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid var(--border-color);
            text-decoration: none;
        }

        .sidebar-brand i {
            font-size: 1.75rem;
            color: var(--primary);
        }

        .sidebar-brand .brand-text {
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }

        .sidebar-menu {
            padding: 1.5rem 1rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            padding-left: 1rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 0.75rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background-color: var(--hover-sidebar);
            color: var(--text-main);
        }

        .menu-item.active {
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
        }

        .menu-item i {
            font-size: 1.25rem;
        }

        .sidebar-footer {
            padding: 1.5rem 1rem;
            border-top: 1px solid var(--border-color);
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - 260px);
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        /* Top Header */
        .top-header {
            height: 76px;
            background-color: var(--bg-header);
            border-bottom: 1px solid var(--border-color);
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
            backdrop-filter: blur(10px);
            background-color: rgba(var(--bg-header-rgb), 0.8); /* Membutuhkan variabel rgb jika ingin sempurna, tapi var(--bg-header) sudah cukup baik */
        }

        .theme-toggle-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.2s;
        }
        
        .theme-toggle-btn:hover {
            background-color: var(--hover-sidebar);
            color: var(--text-main);
        }

        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s;
        }

        .user-dropdown-toggle:hover {
            background-color: var(--hover-sidebar);
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
        }

        /* Utility Classes (Custom Card) */
        .card-custom {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 1.25rem;
            box-shadow: var(--card-shadow);
        }
        
        .text-main { color: var(--text-main) !important; }
        .text-muted-custom { color: var(--text-muted) !important; }
        .border-custom { border-color: var(--border-color) !important; }

        /* Bootstrap Table Overrides for Theme */
        .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--text-main);
            --bs-table-border-color: var(--border-color);
            --bs-table-hover-bg: var(--hover-sidebar);
            --bs-table-hover-color: var(--text-main);
            color: var(--text-main);
        }
        .table > :not(caption) > * > * {
            border-bottom-color: var(--border-color);
        }

        /* Simple-DataTables Overrides for Dark Mode */
        [data-theme="dark"] .datatable-selector, 
        [data-theme="dark"] .datatable-input {
            background-color: var(--bg-card);
            color: var(--text-main);
            border-color: var(--border-color);
        }
        [data-theme="dark"] .datatable-pagination a {
            background-color: var(--bg-card);
            color: var(--text-main);
            border-color: var(--border-color);
        }
        [data-theme="dark"] .datatable-pagination a:hover {
            background-color: var(--hover-sidebar);
        }
        [data-theme="dark"] .datatable-pagination .active a,
        [data-theme="dark"] .datatable-pagination .active a:hover {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Dropdown Override */
        .dropdown-item:active, .dropdown-item:focus {
            background-color: var(--hover-sidebar) !important;
            color: var(--text-main) !important;
            outline: none !important;
            box-shadow: none !important;
        }
        .dropdown-item.text-danger:active, .dropdown-item.text-danger:focus {
            background-color: rgba(220, 53, 69, 0.1) !important;
            color: #dc3545 !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Remove blue focus ring globally for dropdown toggles and buttons */
        .user-dropdown-toggle:focus, .dropdown-toggle:focus, button:focus, a:focus, .btn:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        /* Responsive */
        html, body {
            overflow-x: hidden;
        }
        .datatable-container, .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
            width: 100%;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                width: 100vw;
                max-width: 100vw;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
        
        #sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-main);
        }
        @media (max-width: 991.98px) {
            #sidebar-toggle { display: block; }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 999; /* Tepat di bawah sidebar (1000) */
            backdrop-filter: blur(2px);
            transition: all 0.3s ease;
        }
    </style>
    @stack('styles')
</head>
<body>

    <div id="app-wrapper">
        
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                @if(!empty($globalSettings['logo_path']))
                    <img src="{{ asset('storage/' . $globalSettings['logo_path']) }}" alt="Logo" style="width: 36px; height: 36px; object-fit: contain; border-radius: 6px;">
                @else
                    <i class="bi bi-box-fill"></i>
                @endif
                <span class="brand-text">SIM BOQ</span>
            </a>
            
            <div class="sidebar-menu">
                <div class="menu-label">Menu Utama</div>
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dashboard</span>
                </a>
                
                @if (in_array(Auth::user()->role, ['Admin', 'Direktur', 'Klien', 'Site Manager']))
                <div class="menu-label mt-4">Laporan & Operasional</div>
                <a href="{{ route('proyek.index') }}" class="menu-item {{ request()->routeIs('proyek.*') ? 'active' : '' }}">
                    <i class="bi bi-kanban"></i>
                    <span>{{ Auth::user()->role === 'Admin' ? 'Manajemen Proyek' : 'Daftar Proyek' }}</span>
                </a>
                @if (in_array(Auth::user()->role, ['Admin', 'Direktur']))
                <a href="{{ route('cco.index') }}" class="menu-item {{ request()->routeIs('cco.*') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    <span>Request CCO</span>
                    @php
                        $ccoCount = \App\Models\ChangeRequest::where('status', 'Pending')->count();
                    @endphp
                    @if($ccoCount > 0)
                    <span class="badge bg-danger rounded-pill ms-auto" style="font-size: 0.7rem;">{{ $ccoCount }}</span>
                    @endif
                </a>
                <a href="{{ route('audit.index') }}" class="menu-item {{ request()->routeIs('audit.*') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i>
                    <span>Jejak Audit</span>
                </a>
                @endif
                @if (in_array(Auth::user()->role, ['Admin', 'Direktur', 'Site Manager']))
                <a href="{{ route('tiket.index') }}" class="menu-item {{ request()->routeIs('tiket.*') ? 'active' : '' }}">
                    <i class="bi bi-ticket-detailed"></i>
                    <span>Tiket Pemeliharaan</span>
                </a>
                @endif
                @endif
                
                @if (Auth::user()->role === 'Admin')
                <div class="menu-label mt-4">Sistem Data</div>
                <a href="{{ route('klien.index') }}" class="menu-item {{ request()->routeIs('klien.*') ? 'active' : '' }}">
                    <i class="bi bi-buildings"></i>
                    <span>Perusahaan Klien</span>
                </a>
                <a href="{{ route('barangjasa.index') }}" class="menu-item {{ request()->routeIs('barangjasa.*') ? 'active' : '' }}">
                    <i class="bi bi-database"></i>
                    <span>Master Barang/Jasa</span>
                </a>
                <a href="{{ route('users.index') }}" class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Manajemen Pengguna</span>
                </a>
                @endif
                
                @if (in_array(Auth::user()->role, ['Admin', 'Direktur']))
                <div class="menu-label mt-4">Keamanan</div>
                <a href="{{ route('settings.index') }}" class="menu-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan Sistem</span>
                </a>
                @endif
            </div>
            
            <div class="sidebar-footer">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar">
                        {{ substr(Auth::user()->nama_lengkap, 0, 1) }}
                    </div>
                    <div style="overflow: hidden;">
                        <div class="fw-bold text-main text-truncate" style="font-size: 0.9rem;">{{ Auth::user()->nama_lengkap }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->role }}</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            
            <!-- Topbar -->
            <header class="top-header">
                <div>
                    <button id="sidebar-toggle" class="btn btn-link p-0 text-main d-lg-none">
                        <i class="bi bi-list fs-3"></i>
                    </button>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <!-- Theme Toggle -->
                    <button class="theme-toggle-btn me-2" id="themeToggle" title="Ganti Tema">
                        <i class="bi bi-moon-fill" id="theme-icon"></i>
                    </button>
                    
                    <div class="dropdown me-2">
                        <button class="btn btn-icon position-relative border-0 bg-transparent" id="notificationDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false" style="color: var(--text-muted); font-size: 1.25rem;">
                            <i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none" id="notificationBadge" style="font-size: 0.6rem;">
                                0
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end shadow-sm border-custom rounded-4 p-0" style="width: 320px; max-height: 400px; overflow-y: auto;" aria-labelledby="notificationDropdownBtn">
                            <div class="p-3 border-bottom border-custom bg-light rounded-top-4 d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0 text-main">Notifikasi</h6>
                                <form action="{{ route('notifications.markAllRead') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link btn-sm text-primary p-0 text-decoration-none" style="font-size: 0.8rem;">Tandai semua dibaca</button>
                                </form>
                            </div>
                            <div id="notificationList">
                                <div class="p-4 text-center text-muted-custom small">
                                    <div class="spinner-border spinner-border-sm text-primary mb-2" role="status"></div>
                                    <div>Memuat notifikasi...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dropdown">
                        <div class="user-dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="text-main fw-medium d-none d-md-block">{{ Auth::user()->username }}</span>
                            <i class="bi bi-chevron-down text-muted-custom" style="font-size: 0.75rem;"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end border-custom shadow-sm mt-2" style="background-color: var(--bg-card);">
                            <li><h6 class="dropdown-header text-muted-custom">Pengaturan Akun</h6></li>
                            <li><a class="dropdown-item text-main" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profil Saya</a></li>
                            <li><hr class="dropdown-divider border-custom"></li>
                            
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-3 p-md-5 flex-grow-1">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="py-4 text-center text-muted-custom border-top border-custom" style="font-size: 0.85rem;">
                &copy; {{ date('Y') }} Sistem Informasi Manajemen BOQ Enterprise.
            </footer>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    
    <!-- Global Scripts -->
    <script>
        // Polling Notifikasi
        function fetchNotifications() {
            fetch('{{ route('notifications.unread') }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('notificationBadge');
                    const list = document.getElementById('notificationList');
                    
                    // Update Badge
                    if (data.count > 0) {
                        badge.textContent = data.count > 99 ? '99+' : data.count;
                        badge.classList.remove('d-none');
                    } else {
                        badge.classList.add('d-none');
                    }

                    // Update List
                    if (data.notifications.length === 0) {
                        list.innerHTML = `
                            <div class="p-4 text-center text-muted-custom small">
                                <i class="bi bi-bell-slash fs-4 d-block mb-2 text-muted"></i>
                                Tidak ada notifikasi baru.
                            </div>
                        `;
                        return;
                    }

                    let html = '';
                    data.notifications.forEach(notif => {
                        let linkHtml = `href="/notifications/${notif.id}/read"`;

                        html += `
                            <a ${linkHtml} class="dropdown-item p-3 border-bottom border-custom text-wrap hover-bg-light">
                                <div class="fw-bold text-dark mb-1" style="font-size: 0.85rem;">${notif.title}</div>
                                <div class="text-muted-custom" style="font-size: 0.8rem; line-height: 1.4;">${notif.message}</div>
                                <div class="text-primary mt-2" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i>${notif.created_at}</div>
                            </a>
                        `;
                    });
                    list.innerHTML = html;
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        // Fetch on load
        fetchNotifications();
        // Polling every 15 seconds
        setInterval(fetchNotifications, 15000);

        // Sidebar Toggle Mobile
        const sidebarToggleBtn = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarToggleBtn && sidebar && sidebarOverlay) {
            sidebarToggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });

            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        }

        // Theme Toggle Logic
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        
        // Cek LocalStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        htmlElement.setAttribute('data-theme', savedTheme);

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const currentTheme = htmlElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                htmlElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            });
        }

        // Form Double-Submit Prevention
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form.method.toLowerCase() !== 'get') {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    if (submitBtn.disabled) {
                        e.preventDefault();
                        return;
                    }
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.8';
                    submitBtn.style.cursor = 'not-allowed';
                    if (!submitBtn.dataset.nospinner) {
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...';
                    }
                }
            }
        });

        // Toggle Password Visibility
        document.addEventListener('click', function(e) {
            if (e.target.closest('.toggle-password')) {
                const btn = e.target.closest('.toggle-password');
                const targetId = btn.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = btn.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
