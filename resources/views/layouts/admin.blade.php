<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')

    <style>
        .navbar {
            background-color: #007bff;
            color: #fff;
            padding: 0.5rem 1rem;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 200px; /* Fixed width for sidebar */
            padding-top: 60px;
            background-color: #007bff;
            color: #fff;
            transition: width 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1000; /* Ensures sidebar is above other content */
        }

        .sidebar.collapsed {
            width: 60px; /* Width when collapsed */
        }

        .sidebar .nav-link span {
            display: inline-block;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0; /* Hides text when collapsed */
        }

        .nav-link {
            color: #fff;
        }

        .nav-link:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .content-area {
            margin-left: 200px; /* Fixed margin for content area */
            padding: 1rem;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed + .content-area {
            margin-left: 60px; /* Margin adjustment when sidebar is collapsed */
        }

        /* Prevent sidebar from collapsing on smaller devices */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px; /* Keep the same width on smaller devices */
            }

            .sidebar.collapsed {
                width: 60px; /* Width when collapsed */
            }

            .content-area {
                margin-left: 200px; /* Keep margin consistent */
            }

            .sidebar.collapsed + .content-area {
                margin-left: 60px; /* Margin adjustment when sidebar is collapsed */
            }
        }

        /* User name and logout styles */
        .user-info {
            font-size: 0.8rem; /* Smaller font size for user name */
        }

        .logout-btn {
            font-size: 0.8rem; /* Smaller font size for logout button */
            padding: 0.3rem 0.5rem; /* Adjust padding for the logout button */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <button id="sidebarCollapse" class="navbar-toggler" type="button">
            <i class="fas fa-bars"></i>
        </button>
        <span class="navbar-brand ms-3">
            <img src="{{ asset('image/logo.png') }}" alt="YUPITA Air Minum" style="height: 40px; width: auto;">
        </span>
    </nav>

    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.laporan.index') }}"><i class="fas fa-file-alt"></i>
                    <span>View Laporan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt"></i>
                    <span>Isi Penjadwalan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.jual.index') }}"><i class="fas fa-shopping-cart"></i>
                    <span>Isi Penjualan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.promo.index') }}"><i class="fas fa-tags"></i>
                    <span>Isi Promo</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.kasir.index') }}"><i class="fas fa-cash-register"></i>
                    <span>Kasir</span></a>
            </li>
        </ul>

        <!-- User Name and Logout Section -->
        <div class="text-center mb-4 user-info">
            <span class="d-block mb-2">{{ Auth::user()->name }}</span>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frmlogout').submit();" class="btn btn-outline-light logout-btn">
                Logout
            </a>
            <form id="frmlogout" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="content-area">
        <section class="py-5 mt-5">
            @yield('section')
            @yield('content')
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.content-area').classList.toggle('collapsed');
        });
    </script>

    @yield('js')
</body>

</html>
