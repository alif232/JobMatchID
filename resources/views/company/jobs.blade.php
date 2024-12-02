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
    <title>JobMatchID | Company | Kelola Jobs</title>
    <!-- Custom CSS -->
    <link href="../all/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../all/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../all/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../all/dist/css/style.min.css" rel="stylesheet">
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
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <div class="navbar-brand">
                        <a href="dashboard">
                            <img src="../all/assets/images/gallery/logo.png" alt="Logo" class="img-fluid">
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- Navbar collapse -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- Left-aligned nav items (if any) -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- User profile positioned to the right -->
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('storage/' . $companyDetail->logo_photo) }}" alt="user"
                                class="rounded-circle" width="40">
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
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i data-feather="power" class="svg-icon me-2 ms-1"></i>Logout
                            </a>
                        </div>
                    </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->

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
                                    <li class="breadcrumb-item"><a href="kelolajobs">Kelola Jobs</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Kelola Jobs -->
            <!-- ============================================================== -->
            <!-- Tabel -->
            <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex justify-content-between">
                            Kelola Jobs
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addJobModal">
                                Tambah Data
                            </button>
                        </h4>
                        <div class="table-responsive">
                            <table id="jobsTable" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Posisi</th>
                                        <th>Kualifikasi</th>
                                        <th>Jobdesk</th>
                                        <th>Benefit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan diisi oleh DataTables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit -->
            <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editJobModalLabel">Edit Job</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editJobForm" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="editPosisi" class="form-label">Posisi</label>
                                    <input type="text" class="form-control" id="editPosisi" name="posisi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editKualifikasi" class="form-label">Kualifikasi</label>
                                    <textarea class="form-control" id="editKualifikasi" name="kualifikasi" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editJobdesk" class="form-label">Jobdesk</label>
                                    <textarea class="form-control" id="editJobdesk" name="jobdesk" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editBenefit" class="form-label">Benefit</label>
                                    <textarea class="form-control" id="editBenefit" name="benefit" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal Delete -->
            <div class="modal fade" id="deleteJobModal" tabindex="-1" aria-labelledby="deleteJobModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Job</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="deleteJobModalLabel">Are you sure you want to delete this job?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form id="deleteJobForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Kelola Jobs -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Modal for Adding Job -->
    <!-- ============================================================== -->
    <div class="modal fade" id="addJobModal" tabindex="-1" aria-labelledby="addJobModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJobModalLabel">Tambah Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jobs.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control" id="posisi" name="posisi" required>
                        </div>
                        <div class="mb-3">
                            <label for="kualifikasi" class="form-label">Kualifikasi</label>
                            <textarea class="form-control" id="kualifikasi" name="kualifikasi" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="jobdesk" class="form-label">Jobdesk</label>
                            <textarea class="form-control" id="jobdesk" name="jobdesk" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="benefit" class="form-label">Benefit</label>
                            <textarea class="form-control" id="benefit" name="benefit" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
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
    <!-- End Modal -->
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
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#jobsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('company.jobs') }}",
                    type: 'GET',
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Nomor urut
                    { data: 'posisi', name: 'posisi', orderable: false, searchable: true }, // Dropdown di kolom Posisi
                    { data: 'kualifikasi', name: 'kualifikasi', searchable: false },
                    { data: 'jobdesk', name: 'jobdesk', searchable: false },
                    { data: 'benefit', name: 'benefit', searchable: false }
                ],
                order: [[1, 'asc']], 
                searching: true,
                language: {
                    search: "Cari Posisi:",
                    emptyTable: "Tidak ada data tersedia"
                }
            });
        });
    </script>

    <script>
    function toggleDropdown(event, jobId) {
        event.preventDefault();
        const dropdown = document.getElementById(`dropdownMenu${jobId}`);
        const isVisible = dropdown.style.display === 'block';

        // Sembunyikan semua dropdown posisi lain
        document.querySelectorAll('.dropdown-container .dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });

        // Tampilkan atau sembunyikan dropdown posisi yang diklik
        dropdown.style.display = isVisible ? 'none' : 'block';
    }

    // Sembunyikan semua dropdown posisi jika klik di luar dropdown posisi
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-container')) {
            document.querySelectorAll('.dropdown-container .dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });

    function openEditModal(jobId) {
        // Gunakan URL yang sesuai dengan definisi route
        $.get(`/company/kelolajobs/${jobId}/edit`, function(data) {
            // Isi data ke dalam form modal
            $('#editPosisi').val(data.posisi);
            $('#editKualifikasi').val(data.kualifikasi);
            $('#editJobdesk').val(data.jobdesk);
            $('#editBenefit').val(data.benefit);

            // Set action form untuk update
            $('#editJobForm').attr('action', `/company/kelolajobs/update/${jobId}`);
            $('#editJobModal').modal('show'); // Tampilkan modal
        }).fail(function(xhr) {
            alert('Failed to fetch job details.');
            console.error(xhr.responseText);
        });
    }

    function openDeleteModal(jobId) {
        // Ambil data job berdasarkan ID menggunakan AJAX
        $.get(`/company/kelolajobs/${jobId}/edit`, function(data) {
            // Set action form untuk URL delete
            $('#deleteJobForm').attr('action', `/company/kelolajobs/delete/${jobId}`);
            // Tampilkan nama posisi di modal
            $('#deleteJobModalLabel').text(`Apakah kamu yakin untuk menghapus jobs ${data.posisi}? `);
            // Tampilkan modal delete
            $('#deleteJobModal').modal('show');
        }).fail(function(xhr) {
            alert('Failed to fetch job details.');
            console.error(xhr.responseText);
        });
    }
    </script>
    <script>
    document.getElementById('logoutModal').addEventListener('shown.bs.modal', function () {
        console.log("Logout modal displayed");
    });
    </script>
</body>

</html>