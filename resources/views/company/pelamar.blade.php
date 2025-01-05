<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../home/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../home/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../home/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../home/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../home/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../home/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <title>JobMatchID | Company | Pelamar</title>
    <!-- Custom CSS -->
    <link href="../all/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../all/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../all/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../all/dist/css/style.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <style>
    /* Gaya Dropdown */
    .dropdown-container {
        position: relative;
        display: inline-block;
    }

    .dropdown-trigger {
        color: #007bff;
        text-decoration: none;
        cursor: pointer;
    }

    .dropdown-trigger:hover {
        text-decoration: underline;
    }

    .dropdown-menu {
        display: none;
        /* Sembunyikan dropdown secara default */
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        min-width: 150px;
        z-index: 1000;
        padding: 0;
    }

    .dropdown-menu .dropdown-item {
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        display: block;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Main Wrapper -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- Logo -->
                    <div class="navbar-brand">
                        <a href="dashboard">
                            <img src="../all/assets/images/gallery/logo.png" alt="Logo" class="img-fluid">
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- Navbar collapse -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- Left-aligned nav items (if any) -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- User profile positioned to the right -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                @if ($companyDetail->logo_photo ?? false)
                                <!-- User logo -->
                                <img src="{{ asset($companyDetail->logo_photo) }}" alt="user"
                                    class="rounded-circle" width="40">
                                @endif
                                <span class="ms-2 d-none d-lg-inline-block">
                                    <span>Hello,</span>
                                    <span class="text-dark">{{ $user->email }}</span>
                                    <i data-feather="chevron-down" class="svg-icon"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                                <a class="dropdown-item" href="profile">
                                    <i data-feather="user" class="svg-icon me-2 ms-1"></i>
                                    My Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i data-feather="power" class="svg-icon me-2 ms-1"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- ============================================================== -->
        <!-- Left Sidebar -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="dashboard"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="kelolajobs"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Kelola Jobs</span></a></li>
                        <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="datapelamar"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">Data Pelamar</span></a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- ============================================================== -->
        <!-- Page Wrapper -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread Crumb -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome
                            {{ $companyDetail->company_name ?? false }}!</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="datapelamar">Data Pelamar</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Data Pelamar -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex justify-content-between">
                            Data Pelamar
                        </h4>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataPelamarTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelamar</th>
                                        <th>Posisi</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat oleh DataTables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout Confirmation Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Data Pelamar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page Wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Main Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Required JavaScript -->
    <!-- ============================================================== -->
    <script src="../all/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../all/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../all/dist/js/app-style-switcher.js"></script>
    <script src="../all/dist/js/feather.min.js"></script>
    <script src="../all/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../all/dist/js/sidebarmenu.js"></script>
    <script src="../all/dist/js/custom.min.js"></script>
    <script src="../all/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../all/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../all/assets/extra-libs/c3/d3.min.js"></script>
    <script src="../all/assets/extra-libs/c3/c3.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        var table = $('#dataPelamarTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pelamar') }}",  // Ensure this route is correct
                type: "GET",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama', name: 'nama', orderable: false, searchable: true }, // Searchable by name
                { data: 'posisi', name: 'posisi', orderable: false, searchable: true }, // Searchable by position
                { data: 'status', name: 'status', searchable: false },
                { data: 'tanggal', name: 'tanggal', searchable: false },
            ],
            order: [[4, 'asc']],
            searching: true,
            language: {
                search: "Cari:",  // Label for search box
                emptyTable: "Tidak ada data tersedia"  // Message when no data is found
            }
        });
    });
</script>

    <script>
    document.getElementById('logoutModal').addEventListener('shown.bs.modal', function () {
        console.log("Logout modal displayed");
    });
    </script>
</body>

</html>