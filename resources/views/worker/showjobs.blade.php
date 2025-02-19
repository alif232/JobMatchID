<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>JobMatchID | Worker</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../home/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../home/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../home/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../home/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../../home/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../../home/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="../../home/assets/css/theme.css" rel="stylesheet" />
    <style>
    .fixed-lamar {
        position: fixed;
        bottom: 0px;
        /* Jarak dari bawah layar */
        left: 50%;
        /* Pusatkan secara horizontal */
        transform: translateX(-50%);
        /* Geser ke kiri 50% agar pas di tengah */
        z-index: 1050;
        /* Di atas elemen lainnya */
        background-color: #007bff;
        /* Warna tombol */
        color: #ffffff;
        /* Warna teks */
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        /* Tambahkan bayangan */
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .fixed-lamar:hover {
        transform: translateX(-50%) translateY(-5px);
        /* Efek hover sedikit naik */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.3);
        /* Bayangan lebih besar */
    }
    </style>

</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 backdrop"
            data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand d-flex align-items-center fw-bolder fs-2 fst-italic" href="#">
                    <div class="text-info">JOB</div>
                    <div class="text-warning">MATCHID</div>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
                        <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page"
                                href="../dashboard">Home</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium" href="../jobs">Jobs</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium" href="../aboutus">About Us</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium" href="../lamaran">Lamaran</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium" href="../profile">Profile</a></li>
                        <li class="nav-item px-2">
                            <a class="nav-link fw-medium" href="#" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="py-5" id="home">
            <div class="bg-holder d-none d-sm-block"
                style="background-image:url(../../home/assets/img/illustrations/hero-bg.png);background-position:right top;background-size:contain;">
            </div>
            <!--/.bg-holder-->

            <div class="bg-holder d-sm-none"
                style="background-image:url(../../home/assets/img/illustrations/hero-bg.png);background-position:right top;background-size:contain;">
            </div>
            <!--/.bg-holder-->

            <!-- Detail Show Jobs -->
            <div class="container" style="margin-top: 100px;">
                <div class="row justify-content-center">
                    <!-- Card untuk detail perusahaan -->
                    <div class="mb-4">
                        <h2>Detail Perusahaan</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="media d-flex align-items-center">
                                    <img class="me-3 img-fluid w-25" style="width: 100px; height: 100px;"
                                        src="{{ asset($job->user->companyDetail->logo_photo ?? 'default-logo.png')}}"
                                        alt="Logo {{ $job->user->companyDetail->company_name ?? 'Perusahaan' }}">
                                    <div class="media-body">
                                        <h4 class="mt-0">
                                            {{ $job->user->companyDetail->company_name ?? 'Nama Perusahaan' }}</h4>
                                        <p class="mb-1">
                                            <strong>Alamat:</strong>
                                            {{ $job->user->companyDetail->company_address ?? 'Alamat tidak tersedia' }}
                                        </p>
                                        <p class="mb-1">
                                            <strong>No Telp:</strong>
                                            {{ $job->user->companyDetail->phone_number ?? 'No Telp tidak tersedia' }}
                                        </p>
                                        <p class="mb-2">
                                            <strong>Email:</strong>
                                            {{ $job->user->companyDetail->email ?? 'Email tidak tersedia' }}
                                        </p>
                                        <p class="mb-1">
                                            <strong>Deskripsi:</strong>
                                        <p class="mb-0">
                                            {!! nl2br(e($job->user->companyDetail->description ?? 'Deskripsi tidak tersedia')) !!}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card untuk detail pekerjaan -->
                    <div class="mb-4">
                        <h2>Detail Pekerjaan</h2>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-3">{{ $job->posisi }}</h3>

                                <p><strong>Deskripsi Pekerjaan:</strong></p>
                                <p>{!! nl2br(e($job->jobdesk)) !!}</p>

                                <p><strong>Kualifikasi:</strong></p>
                                <p>{!! nl2br(e($job->kualifikasi)) !!}</p>

                                <p><strong>Benefit:</strong></p>
                                <p>{!! nl2br(e($job->benefit)) !!}</p>
                            </div>
                        </div>
                    </div>


                    <!-- Logout Confirmation Modal -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin logout?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sticky Navbar for "Lamar Pekerjaan" -->
                    <div class="fixed-lamar">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#applyJobModal">
                            Lamar Pekerjaan
                        </button>
                    </div>

                    <!-- Modal for Job Application -->
                    <div class="modal fade" id="applyJobModal" tabindex="-1" aria-labelledby="applyJobModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('apply.job', $job->id_jobs) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="applyJobModalLabel">Lamar Pekerjaan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form CV Upload -->
                                        <div class="mb-3">
                                            <label for="cv" class="form-label">Upload CV</label>
                                            <input type="file" name="cv" id="cv" class="form-control" required>
                                            @error('cv')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Form Link Pendukung -->
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Link Pendukung (Opsional)</label>
                                            <input type="url" name="link" id="link" class="form-control"
                                                placeholder="https://example.com">
                                            @error('link')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Kirim Lamaran</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>

        <section class="py-0 bg-primary-gradient">
            <div class="bg-holder"
                style="background-image:url(../../home/assets/img/illustrations/footer-bg.png);background-position:center;background-size:cover;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row flex-center py-8">
                    <div class="col-lg-6 mb-4 text-center">
                        <h1 class="text-white">Get started now</h1>
                    </div>
                </div>
                <div class="row justify-content-lg-between">
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-5 text-white">CATEGORIES </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">IOS Developers</a>
                            </li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Front-End
                                    Developers</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">UX Designers</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">UI Designers</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Content Writer</a>
                            </li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Program &amp; Tech</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-5 text-white">COMMUNITY </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Events</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Blog</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Forum</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Podcast</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Affiliates</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Invite a Friend</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-5 text-white">ABOUT </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">About Us</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Partnerships</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Finance Experts</a>
                            </li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Project Management</a>
                            </li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Product Manager</a>
                            </li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">The Team</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-5 text-white">CONTACT </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Contact Us</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Press Center</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">Careers</a></li>
                            <li class="mb-3"><a class="text-light text-decoration-none" href="#!">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row flex-center">
                    <div class="col-auto my-4">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item me-3"><a href="#!">
                                    <svg class="bi bi-twitter" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        fill="#1F3A63" viewBox="0 0 16 16">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z">
                                        </path>
                                    </svg></a></li>
                            <li class="list-inline-item me-3"><a class="text-decoration-none" href="#!">
                                    <svg class="bi bi-facebook" xmlns="http://www.w3.org/2000/svg" width="32"
                                        height="32" fill="#1F3A63" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                                        </path>
                                    </svg></a></li>
                            <li class="list-inline-item me-3"><a href="#!">
                                    <svg class="bi bi-instagram" xmlns="http://www.w3.org/2000/svg" width="32"
                                        height="32" fill="#1F3A63" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z">
                                        </path>
                                    </svg></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script>
    document.getElementById('logoutModal').addEventListener('shown.bs.modal', function() {
        console.log("Logout modal displayed");
    });
    </script>
    <script src="../../home/vendors/@popperjs/popper.min.js"></script>
    <script src="../../home/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../../home/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="../../home/assets/js/theme.js"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400&amp;display=swap"
        rel="stylesheet">
</body>

</html>