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
    <title>JobMatchID | Company | Profile</title>
    <!-- Custom CSS -->
    <link href="../all/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../all/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../all/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../all/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- Logo -->
                    <div class="navbar-brand">
                        <a href="dashboard">
                            <img src="../all/assets/images/gallery/logo.png" alt="Logo" class="img-fluid">
                        </a>
                    </div>
                    <!-- Toggle which is visible on mobile only -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- End Logo -->
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
                                <img src="{{ asset('storage/' . $companyDetail->logo_photo) }}" alt="user"
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
        <!-- End Topbar header -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="dashboard"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="kelolajobs"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Kelola Jobs</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="datapelamar"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">Data Pelamar</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome
                            {{ $companyDetail->company_name ?? false }}!</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="profile">Profile</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="container">
                    <div class="row gy-4 gy-lg-0">
                        <div class="col-12 col-lg-4 col-xl-3">
                            <div class="row gy-4">
                                <!-- Info Perusahaan -->
                                <div class="col-12">
                                    <div class="card widget-card border-light shadow-sm">
                                        <div class="card-header text-bg-primary">Company Profile</div>
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <img src="{{ asset('storage/' . $companyDetail->logo_photo ?? 'default-avatar.jpg') }}"
                                                    class="img-fluid rounded-circle" alt="Company Logo"
                                                    style="width: 140px; height: 150px;">
                                            </div>
                                            <h5 class="text-center mb-1">
                                                {{ $companyDetail->company_name ?? 'Unknown Company' }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 col-xl-9">
                            <div class="card widget-card border-light shadow-sm">
                                <div class="card-body p-4">
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <ul class="nav nav-tabs" id="profileTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                                data-bs-target="#overview-tab-pane" type="button" role="tab"
                                                aria-controls="overview-tab-pane" aria-selected="true">Overview</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                                aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="password-tab" data-bs-toggle="tab"
                                                data-bs-target="#password-tab-pane" type="button" role="tab"
                                                aria-controls="password-tab-pane"
                                                aria-selected="false">Password</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-4" id="profileTabContent">
                                        <!-- Overview Tab -->
                                        <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel"
                                            aria-labelledby="overview-tab">
                                            <h5 class="mb-3">About The Company</h5>
                                            <p class="lead mb-3">{{ $companyDetail->description ?? '-' }}</p>
                                            <hr>
                                            <h5 class="mb-3">Company Information</h5>
                                            <div class="row g-0">
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Company Name</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $companyDetail->company_name ?? '-' }}</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Phone</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $companyDetail->phone_number ?? '-' }}</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Email</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $companyDetail->email ?? '-' }}</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Address</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $companyDetail->company_address ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Profile Tab -->
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <form action="{{ route('profile.update.company') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row gy-2">
                                                    <!-- Gambar Profil -->
                                                    <label class="col-12 form-label m-0">Logo Perusahaan</label>
                                                    <div class="col-12">
                                                        @if ($companyDetail->logo_photo ?? false)
                                                        <img src="{{ asset('storage/' . $companyDetail->logo_photo) }}"
                                                            class="img-fluid" alt="Logo Perusahaan"
                                                            id="profileImagePreview"
                                                            style="width: 140px; height: 140px; object-fit: cover;">
                                                        @else
                                                        <img src="{{ asset('assets/img/default-avatar.jpg') }}"
                                                            class="img-fluid" alt="Default Logo"
                                                            id="profileImagePreview"
                                                            style="width: 140px; height: 140px; object-fit: cover;">
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="file" name="logo_photo" class="form-control mt-2"
                                                            id="logoPhotoInput">
                                                        @if ($companyDetail->logo_photo ?? false)
                                                        @endif
                                                        @error('logo_photo')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <hr>

                                                <!-- Nama Perusahaan -->
                                                <div class="col-12">
                                                    <label for="inputCompanyName" class="form-label">Nama
                                                        Perusahaan</label>
                                                    <input type="text" name="company_name" class="form-control"
                                                        id="inputCompanyName"
                                                        value="{{ old('company_name', $companyDetail->company_name ?? '') }}"
                                                        required>
                                                    @error('company_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Nomor Telepon -->
                                                <div class="col-12">
                                                    <label for="inputPhoneNumber" class="form-label">Nomor
                                                        Telepon</label>
                                                    <input type="text" name="phone_number" class="form-control"
                                                        id="inputPhoneNumber"
                                                        value="{{ old('phone_number', $companyDetail->phone_number ?? '') }}"
                                                        required>
                                                    @error('phone_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Email -->
                                                <div class="col-12">
                                                    <label for="inputEmail" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        id="inputEmail"
                                                        value="{{ old('email', $companyDetail->email ?? '') }}"
                                                        required>
                                                    @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Alamat Perusahaan -->
                                                <div class="col-12">
                                                    <label for="inputCompanyAddress" class="form-label">Alamat
                                                        Perusahaan</label>
                                                    <textarea name="company_address" class="form-control"
                                                        id="inputCompanyAddress" rows="3"
                                                        required>{{ old('company_address', $companyDetail->company_address ?? '') }}</textarea>
                                                    @error('company_address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Deskripsi Perusahaan -->
                                                <div class="col-12">
                                                    <label for="inputDescription" class="form-label">Deskripsi
                                                        Perusahaan</label>
                                                    <textarea name="description" class="form-control"
                                                        id="inputDescription"
                                                        rows="3">{{ old('description', $companyDetail->description ?? '') }}</textarea>
                                                    @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Tombol -->
                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">Simpan
                                                        Perubahan</button>
                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Password Tab -->
                                        <div class="tab-pane fade" id="password-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <form action="{{ route('company.profile.update.password') }}" method="POST">
                                                @csrf
                                                <div class="col-12">
                                                    <label for="inputCurrentPassword" class="form-label">Password Saat
                                                        Ini</label>
                                                    <input type="password" name="current_password" class="form-control"
                                                        id="inputCurrentPassword" required>
                                                    @error('current_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="newPassword" class="form-label">Password Baru</label>
                                                    <input type="password" name="new_password" class="form-control"
                                                        id="newPassword" required>
                                                    @error('new_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="confirmPassword" class="form-label">Konfirmasi Password
                                                        Baru</label>
                                                    <input type="password" name="new_password_confirmation"
                                                        class="form-control" id="confirmPassword" required>
                                                    @error('new_password_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                <!-- End Container fluid  -->
                <!-- footer -->
                <footer class="footer text-center text-muted">
                    JOBMATCHID
                </footer>
                <!-- End footer -->
            </div>
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->
        <!-- All Jquery -->
        <script src="../all/assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../all/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- apps -->
        <!-- apps -->
        <script src="../all/dist/js/app-style-switcher.js"></script>
        <script src="../all/dist/js/feather.min.js"></script>
        <script src="../all/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="../all/dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="../all/dist/js/custom.min.js"></script>
        <!--This page JavaScript -->
        <script src="../all/assets/extra-libs/c3/d3.min.js"></script>
        <script src="../all/assets/extra-libs/c3/c3.min.js"></script>
        <script src="../all/assets/libs/chartist/dist/chartist.min.js"></script>
        <script src="../all/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
        <script src="../all/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../all/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../all/dist/js/pages/dashboards/dashboard1.min.js"></script>
        <script>
        document.getElementById('logoutModal').addEventListener('shown.bs.modal', function () {
            console.log("Logout modal displayed");
        });
        </script>
</body>

</html>