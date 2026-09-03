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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Bootstrap 5.3.3 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome 6 Icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >

    <!-- SweetAlert2 CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
    >

    <!-- Custom Enterprise CSS -->
    <style>
        :root {
            --sidebar-width: 260px;

            --sidebar-bg: #1b3b28;
            --sidebar-hover: #243447;
            --sidebar-active: #D4A017;

            --topbar-height: 64px;

            --primary-color: #1D4ED8;

            --bg-body: #F4F6F9;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-body);
            color: #334155;
            overflow-x: hidden;
        }

        /* =========================================================
           SIDEBAR
           ========================================================= */

        #sidebar-wrapper {
            min-height: 100vh;
            width: var(--sidebar-width);

            background:
                linear-gradient(
                    180deg,
                    #1B263B 0%,
                    #23395D 100%
                );

            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;

            transition: all .3s ease;

            box-shadow:
                4px 0 18px rgba(0, 0, 0, .10);
        }

        .sidebar-heading {
            height: var(--topbar-height);

            display: flex;
            align-items: center;

            padding: 0 1.5rem;

            color: #ffffff;

            font-size: 1.15rem;
            font-weight: 700;

            background: rgba(27, 20, 237, 0.03);

            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar-logo {
            width: 46px;
            height: 46px;

            object-fit: contain;

            margin-right: 12px;

            background: #ffffff;

            border-radius: 50%;

            padding: 2px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, .15);
        }

        .sidebar-title {
            color: #ffffff;

            font-size: 15px;
            font-weight: 700;

            line-height: 1.2;
        }

        .sidebar-section-title {
            padding: 18px 24px 8px;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1.5px;

            text-transform: uppercase;

            color: #94A3B8;

            border: none;

            user-select: none;
        }

        .sidebar-subtitle {
            color: #94a3b8;

            font-size: 10px;

            letter-spacing: 1px;

            text-transform: uppercase;
        }

        .list-group-sidebar {
            padding: 1rem 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;

            padding: 0.85rem 1.5rem;

            color: #C7D2E0;

            text-decoration: none;

            font-size: .93rem;
            font-weight: 500;

            border-left: 4px solid transparent;

            transition: all .25s ease;
        }

        .sidebar-link i {
            width: 24px;

            margin-right: 12px;

            font-size: 1.1rem;

            text-align: center;
        }

        .sidebar-link:hover {
            color: #ffffff;

            background-color:
                rgba(255, 255, 255, .05);

            padding-left: 1.7rem;
        }

        .sidebar-link.active {
            color: #ffffff;

            background:
                rgba(212, 160, 23, .12);

            border-left: 4px solid #D4A017;
        }

        .sidebar-link.active i {
            color: #60a5fa;
        }

        /* =========================================================
           MAIN CONTENT
           ========================================================= */

        #page-content-wrapper {
            margin-left: var(--sidebar-width);

            width: calc(100% - var(--sidebar-width));

            min-height: 100vh;

            display: flex;
            flex-direction: column;

            transition: all 0.3s ease;
        }

        /* =========================================================
           TOP NAVBAR / HEADER
           ========================================================= */

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

        /* =========================================================
           USER PROFILE MENU
           ========================================================= */

        .profile-dropdown {
            position: relative;
        }

        .profile-trigger {
            display: flex;

            align-items: center;

            gap: 10px;

            padding: 4px 6px 4px 10px;

            border: 0;

            background: transparent;

            border-radius: 10px;

            color: #0f172a;

            transition:
                background-color .2s ease,
                box-shadow .2s ease;
        }

        .profile-trigger:hover,
        .profile-trigger:focus {
            background-color: #f8fafc;

            box-shadow: none;

            outline: none;
        }

        .profile-trigger:active {
            background-color: #f1f5f9;
        }

        .profile-name {
            color: #0f172a;

            font-size: 14px;

            font-weight: 600;

            line-height: 1.2;
        }

        .profile-avatar {
            width: 38px;

            height: 38px;

            flex: 0 0 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background-color: #2563eb;

            color: #ffffff;

            font-size: 15px;

            font-weight: 700;

            user-select: none;
        }

        .profile-chevron {
            color: #64748b;

            font-size: 11px;

            margin-left: 1px;

            transition: transform .2s ease;
        }

        .profile-trigger[aria-expanded="true"] .profile-chevron {
            transform: rotate(180deg);
        }

        .profile-menu {
            width: 270px;

            margin-top: 10px !important;

            padding: 0;

            overflow: hidden;

            border: 1px solid #e2e8f0;

            border-radius: 12px;

            background: #ffffff;

            box-shadow:
                0 12px 30px rgba(15, 23, 42, .12),
                0 3px 8px rgba(15, 23, 42, .06);
        }

        .profile-header {
            display: flex;

            align-items: center;

            gap: 12px;

            padding: 16px;

            background: #ffffff;

            border-bottom: 1px solid #eef2f7;
        }

        .profile-header-avatar {
            width: 42px;

            height: 42px;

            flex: 0 0 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background-color: #2563eb;

            color: #ffffff;

            font-size: 15px;

            font-weight: 700;
        }

        .profile-header-name {
            color: #0f172a;

            font-size: 14px;

            font-weight: 700;

            line-height: 1.35;
        }

        .profile-header-role {
            margin-top: 2px;

            color: #64748b;

            font-size: 12px;

            font-weight: 400;
        }

        .profile-menu-body {
            padding: 6px;
        }

        .profile-menu-item {
            width: 100%;

            display: flex;

            align-items: center;

            gap: 11px;

            min-height: 42px;

            padding: 10px 12px;

            border: 0;

            border-radius: 8px;

            background: transparent;

            color: #334155;

            text-decoration: none;

            font-size: 13px;

            font-weight: 500;

            text-align: left;

            transition:
                background-color .18s ease,
                color .18s ease;
        }

        .profile-menu-item i {
            width: 18px;

            color: #64748b;

            font-size: 14px;

            text-align: center;
        }

        .profile-menu-item:hover,
        .profile-menu-item:focus {
            background-color: #f8fafc;

            color: #0f172a;

            outline: none;

            text-decoration: none;
        }

        .profile-menu-item:hover i,
        .profile-menu-item:focus i {
            color: #2563eb;
        }

        .profile-menu-divider {
            height: 1px;

            margin: 5px 6px;

            background-color: #eef2f7;
        }

        .profile-menu-item.logout-item {
            color: #b42318;
        }

        .profile-menu-item.logout-item i {
            color: #b42318;
        }

        .profile-menu-item.logout-item:hover,
        .profile-menu-item.logout-item:focus {
            background-color: #fff5f5;

            color: #b42318;
        }

        .profile-menu-item.logout-item:hover i,
        .profile-menu-item.logout-item:focus i {
            color: #b42318;
        }

        /* =========================================================
           CARDS & WIDGETS
           ========================================================= */

        .card-custom {
            border: 1px solid #e2e8f0;

            border-radius: 12px;

            box-shadow:
                0 1px 3px rgba(0, 0, 0, 0.02);

            background-color: #ffffff;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .card-custom:hover {
            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.05);
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

        /* =========================================================
           TABLES
           ========================================================= */

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

        /* =========================================================
           BUTTONS
           ========================================================= */

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

        /* =========================================================
           STATUS BADGES
           ========================================================= */

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

        /* =========================================================
           FOOTER
           ========================================================= */

        footer {
            margin-top: auto;

            background-color: #ffffff;

            border-top: 1px solid #e2e8f0;

            padding: 1rem 1.5rem;

            font-size: 0.85rem;

            color: #64748b;
        }

        /* =========================================================
           RESPONSIVE
           ========================================================= */

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

        @media (max-width: 575.98px) {
            .top-navbar {
                padding: 0 1rem;
            }

            .profile-name {
                display: none;
            }

            .profile-trigger {
                padding: 4px;
            }

            .profile-menu {
                width: 250px;
            }

            main.container-fluid {
                padding: 1rem !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- =====================================================
             SIDEBAR NAVIGATION
             ===================================================== -->

        <aside id="sidebar-wrapper">

            <div class="sidebar-heading">

                <img
                    src="{{ asset('images/logo-smk.png') }}"
                    alt="Logo SMK Informatika Utama"
                    class="sidebar-logo"
                >

                <div>
                    <div class="sidebar-title">
                        ASSET INVENTARIS
                    </div>
                </div>

            </div>

            <div class="list-group list-group-flush list-group-sidebar">

                <!-- Dashboard -->
                <a
                    href="{{ route('dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Section -->
                <div class="sidebar-section-title">
                    MANAJEMEN DATA
                </div>

                <!-- Data Aset -->
                <a
                    href="{{ route('assets.index') }}"
                    class="sidebar-link {{ request()->routeIs('assets.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-laptop-file"></i>
                    <span>Data Aset</span>
                </a>

                <!-- Kategori Aset -->
                <a
                    href="{{ route('categories.index') }}"
                    class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Kategori Aset</span>
                </a>

                <!-- Supplier -->
                <a
                    href="{{ route('suppliers.index') }}"
                    class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-handshake"></i>
                    <span>Supplier</span>
                </a>

                <!-- Lokasi -->
                <a
                    href="{{ route('locations.index') }}"
                    class="sidebar-link {{ request()->routeIs('locations.*') ? 'active' : '' }}"
                >
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Lokasi Penempatan</span>
                </a>

            </div>
        </aside>

        <!-- =====================================================
             MAIN PAGE CONTENT
             ===================================================== -->

        <div id="page-content-wrapper">

            <!-- =================================================
                 TOP NAVBAR / HEADER
                 ================================================= -->

            <header class="top-navbar">

                <div class="d-flex align-items-center">

                    <!-- Mobile Sidebar Toggle -->
                    <button
                        type="button"
                        class="btn btn-light d-lg-none me-2"
                        id="sidebarToggle"
                        aria-label="Buka menu navigasi"
                    >
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <h1 class="page-header-title">
                        @yield('title', 'Dashboard')
                    </h1>

                </div>

                <!-- =================================================
                     USER PROFILE
                     ================================================= -->

                <div class="dropdown profile-dropdown">

                    <button
                        type="button"
                        class="profile-trigger dropdown-toggle"
                        id="profileMenuButton"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        aria-expanded="false"
                        aria-label="Buka menu profil Administrator System"
                    >

                        <div class="text-end d-none d-sm-block">
                            <span class="d-block profile-name">
                                Administrator System
                            </span>
                        </div>

                        <div class="profile-avatar">
                            A
                        </div>

                        <i class="fa-solid fa-chevron-down profile-chevron"></i>

                    </button>

                    <!-- Profile Dropdown -->
                    <div
                        class="dropdown-menu dropdown-menu-end profile-menu"
                        aria-labelledby="profileMenuButton"
                    >

                        <!-- Profile Header -->
                        <div class="profile-header">

                            <div class="profile-header-avatar">
                                A
                            </div>

                            <div>
                                <div class="profile-header-name">
                                    Administrator System
                                </div>

                                <div class="profile-header-role">
                                    Administrator
                                </div>
                            </div>

                        </div>

                        <!-- Profile Menu -->
                        <div class="profile-menu-body">

                            <!-- Profil Saya -->
                            <div
                                class="profile-menu-item"
                                aria-disabled="true"
                                title="Menu profil belum tersedia"
                            >
                                <i class="fa-solid fa-user"></i>
                                <span>Profil Saya</span>
                            </div>

                            <div class="profile-menu-divider"></div>

                            <!-- Logout -->
                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                                class="m-0"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="profile-menu-item logout-item"
                                >
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            </header>

            <!-- =================================================
                 MAIN CONTENT AREA
                 ================================================= -->

            <main class="container-fluid p-4">
                @yield('content')
            </main>

            <!-- =================================================
                 FOOTER
                 ================================================= -->

            <footer class="d-flex justify-content-between align-items-center">

                <div>
                    &copy; {{ date('Y') }}
                    <strong>Asset Inventaris System</strong>.
                    Enterprise Edition.
                </div>

                <div>
                    Status Server:

                    <span class="badge bg-success">
                        <i class="fa-solid fa-circle-check me-1"></i>
                        Running OK
                    </span>
                </div>

            </footer>

        </div>

    </div>

    <!-- =========================================================
         BOOTSTRAP JS
         ========================================================= -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    <!-- =========================================================
         SWEETALERT2 JS
         ========================================================= -->

    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11"
    ></script>

    <!-- =========================================================
         SIDEBAR TOGGLE
         ========================================================= -->

    <script>
        document
            .getElementById('sidebarToggle')
            ?.addEventListener('click', function () {

                document
                    .getElementById('sidebar-wrapper')
                    .classList
                    .toggle('toggled');

            });
    </script>

    <!-- =========================================================
         FLASH ALERT HANDLER
         ========================================================= -->

    @if(session('success'))

        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success')),
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
                text: @json(session('error')),
                confirmButtonColor: '#2563eb'
            });
        </script>

    @endif

    <!-- =========================================================
         DELETE CONFIRMATION
         ========================================================= -->

    <script>
        function confirmDelete(formId, itemName) {

            Swal.fire({
                title: 'Konfirmasi Hapus?',
                text:
                    "Apakah Anda yakin ingin menghapus " +
                    (itemName
                        ? "'" + itemName + "'"
                        : "data ini"
                    ) +
                    "? Tindakan ini tidak dapat dibatalkan.",

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#ef4444',

                cancelButtonColor: '#64748b',

                confirmButtonText:
                    '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus',

                cancelButtonText: 'Batal'

            }).then((result) => {

                if (result.isConfirmed) {

                    document
                        .getElementById(formId)
                        .submit();

                }

            });
        }
    </script>

    @stack('scripts')

</body>
</html>