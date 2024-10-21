<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Data Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar styling */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            width: 250px;
            padding-top: 20px;
            transition: all 0.3s ease; /* Animasi smooth */
            /* Sidebar terlihat secara default, jadi hapus translateX */
        }

        .sidebar.hide {
            transform: translateX(-250px); /* Sidebar disembunyikan saat tombol diklik */
        }

        /* Content styling */
        .content {
            margin-left: 250px; /* Konten bergeser saat sidebar terlihat */
            transition: margin-left 0.3s ease; /* Animasi smooth pada konten */
        }

        .content.without-sidebar {
            margin-left: 0; /* Konten kembali ke posisi awal saat sidebar disembunyikan */
        }

        /* Toggle button */
        #sidebar-toggle {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 18px;
            margin-right: 15px;
        }

        /* Adjust button in title */
        .page-header {
            display: flex;
            align-items: center; /* Membuat tombol dan judul berada di satu garis */
        }
    </style>
</head>
<body>
    @if(View::hasSection('show_sidebar') && View::getSection('show_sidebar') == true)
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar">
            <h4 class="text-center">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">Data Management</a>
            </h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kk.index') }}">Kartu Keluarga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ktp.index') }}">Kartu Tanda Penduduk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kk.daftar') }}">Daftar Kartu Keluarga</a>
                </li>
            </ul>
        </div>
    @endif

    <div class="@if(View::hasSection('show_sidebar') && View::getSection('show_sidebar') == true) content @endif container mt-4">
        <!-- Page Header with Sidebar Toggle -->
        @if(View::hasSection('show_sidebar') && View::getSection('show_sidebar') == true)
            <div class="page-header">
                <button id="sidebar-toggle">☰</button>
                <h1>@yield('title')</h1>
            </div>
            <hr>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function () {
            var sidebar = document.getElementById('sidebar');
            var content = document.querySelector('.content');

            // Toggle class "hide" pada sidebar dan "without-sidebar" pada konten
            sidebar.classList.toggle('hide');
            content.classList.toggle('without-sidebar');
        });
    </script>
</body>
</html>
