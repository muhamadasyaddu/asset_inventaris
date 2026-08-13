<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sistem Manajemen Inventaris Aset') - Enterprise Asset Manager</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS (CDN - Tanpa Vite) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom Enterprise CSS -->
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #3b82f6;
            --topbar-height: 64px;
            --primary-color: #2563eb;
            --bg-body: #f8fafc;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-body);
            color: #334155;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar-wrapper {
            min-height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar-heading {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            color: #ffffff;
            font-size: 1.15rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            letter-spacing: -0.02em;
        }

        .sidebar-heading i {
            color: #60a5fa;
        }

        .list-group-sidebar {
            padding: 1rem 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.925rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.1rem;
            text-align: center;
        }

        .sidebar-link:hover {
            color: #f8fafc;
            background-color: var(--sidebar-hover);
        }

        .sidebar-link.active {
            color: #ffffff;
            background-color: rgba(59, 130, 246, 0.15);
            border-left-color: var(--sidebar-active);
        }

        .sidebar-link.active i {
            color: #60a5fa;
        }

        /* Main Content Styling */
        #page-content-wrapper {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Top Navbar */
        .top-navbar {
            height: var(--topbar-height);
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .page-header-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: #0f172a;
            margin: 0;
        }

        /* Cards & Widgets */
        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            background-color: #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-custom:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 1.25rem;
            background: #ffffff;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        /* Tables */
        .table-custom {
            margin-bottom: 0;
        }

        .table-custom th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.85rem 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-custom td {
            padding: 0.95rem 1rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Buttons */
        .btn-primary-custom {
            background-color: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-primary-custom:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            color: #ffffff;
        }

        .badge-soft-success {
            background-color: #dcfce7;
            color: #166534;
            font-weight: 600;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }

        .badge-soft-danger {
            background-color: #fee2e2;
            color: #991b1b;
            font-weight: 600;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }

        .badge-soft-warning {
            background-color: #fef3c7;
            color: #92400e;
            font-weight: 600;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }

        .badge-soft-info {
            background-color: #e0f2fe;
            color: #075985;
            font-weight: 600;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }

        /* Footer */
        footer {
            margin-top: auto;
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Responsive Mobile Toggle */
        @media (max-width: 991.98px) {
            #sidebar-wrapper {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            #sidebar-wrapper.toggled {
                margin-left: 0;
            }

            #page-content-wrapper {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar Navigation -->
        <aside id="sidebar-wrapper">
            <div class="sidebar-heading">
                <i class="fa-solid fa-boxes-stacked me-2"></i>
                <span>ASSET INVENTARIS</span>
            </div>
            <div class="list-group list-group-flush list-group-sidebar">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>

                <div class="sidebar-heading fs-6 text-uppercase text-muted pt-3 pb-1 px-3 style-heading" style="font-size: 0.7rem !important; letter-spacing: 0.1em; border: none; height: auto;">
                    MANAJEMEN DATA
                </div>

                <a href="{{ route('assets.index') }}" class="sidebar-link {{ request()->routeIs('assets.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box-archive"></i>
                    <span>Data Aset</span>
                </a>
                <a href="{{ route('categories.index') }}" class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-tags"></i>
                    <span>Kategori Aset</span>
                </a>
                <a href="{{ route('suppliers.index') }}" class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-truck-field"></i>
                    <span>Supplier</span>
                </a>
                <a href="{{ route('locations.index') }}" class="sidebar-link {{ request()->routeIs('locations.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Lokasi Penempatan</span>
                </a>
            </div>
        </aside>

        <!-- Main Page Content Wrapper -->
        <div id="page-content-wrapper">
            <!-- Top Navbar Header -->
            <header class="top-navbar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-light d-lg-none me-2" id="sidebarToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h1 class="page-header-title">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-sm-block">
                        <span class="d-block fw-semibold text-dark fs-7">Administrator System</span>
                        <span class="text-muted small">Laragon 6.0 &bull; PHP 8.2 &bull; Laravel 12</span>
                    </div>
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">
                        A
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="container-fluid p-4">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="d-flex justify-content-between align-items-center">
                <div>
                    &copy; {{ date('Y') }} <strong>Asset Inventaris System</strong>. Enterprise Edition.
                </div>
                <div>
                    Status Server: <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Running OK</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS Bundle (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.getElementById('sidebar-wrapper').classList.toggle('toggled');
        });
    </script>

    <!-- Flash Alert Handler -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3500,
                showConfirmButton: false
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#2563eb'
            });
        </script>
    @endif

    <!-- Delete Confirmation Helper -->
    <script>
        function confirmDelete(formId, itemName) {
            Swal.fire({
                title: 'Konfirmasi Hapus?',
                text: "Apakah Anda yakin ingin menghapus " + (itemName ? "'" + itemName + "'" : "data ini") + "? Tindakan ini tidak dapat dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
