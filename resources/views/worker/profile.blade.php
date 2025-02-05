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
    <link rel="apple-touch-icon" sizes="180x180" href="../home/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../home/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../home/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../home/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../home/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../home/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="../home/assets/css/theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="../profile/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
                <div class="collapse navbar-collapse mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
                        <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page"
                                href="dashboard">Home</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium" href="jobs">Jobs</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium" href="aboutus">About Us</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium" href="lamaran">Lamaran</a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium" href="profile">Profile</a></li>
                        <li class="nav-item px-2">
                            <a class="nav-link fw-medium" href="#" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="py-0" id="home">
            <div class="bg-holder d-none d-sm-block"
                style="background-image:url(../home/assets/img/illustrations/hero-bg.png);background-position:right top;background-size:contain;">
            </div>
            <!--/.bg-holder-->

            <div class="bg-holder d-sm-none"
                style="background-image:url(../home/assets/img/illustrations/hero-bg.png);background-position:right top;background-size:contain;">
            </div>
            <!--/.bg-holder-->

            <!-- ===============================================-->
            <!--Profile-->
            <!-- ===============================================-->
            <section class="py-7" id="home">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                            <h2 class="mb-4 display-5 text-center">Profile</h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row gy-4 gy-lg-0">
                        <div class="col-12 col-lg-4 col-xl-3">
                            <div class="row gy-4">
                                <!-- Info Worker -->
                                <div class="col-12">
                                    <div class="card widget-card border-light shadow-sm">
                                        <div class="card-header text-bg-primary">Worker Profile</div>
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <img src="{{ asset($workerDetail->logo_photo ?? 'default-avatar.jpg') }}"
                                                    class="img-fluid rounded-circle" alt="Company Logo"
                                                    style="width: 140px; height: 150px;">
                                            </div>
                                            <h5 class="text-center mb-1">
                                                {{ $workerDetail->nama }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card widget-card border-light shadow-sm">
                                        <div class="card-header text-bg-primary">About Me</div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush mb-0">
                                                <li class="list-group-item">
                                                    <h6 class="mb-1">
                                                        <span class="bi bi-mortarboard-fill me-2"></span>
                                                        Education
                                                    </h6>
                                                    @if ($latestEducation)
                                                    <span>{{ $latestEducation->kualifikasi }} in
                                                        {{ $latestEducation->lembaga }} (Graduated:
                                                        {{ $latestEducation->thnlulus }})</span>
                                                    @else
                                                    <span>No education records available</span>
                                                    @endif
                                                </li>
                                                <li class="list-group-item">
                                                    <h6 class="mb-1">
                                                        <span class="bii bi-geo-alt-fill me-2"></span>
                                                        Location
                                                    </h6>
                                                    <span>{{ $workerDetail->alamat }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card widget-card border-light shadow-sm">
                                        <div class="card-header text-bg-primary">Skills</div>
                                        <div class="card-body">
                                            @foreach ($skills as $skill)
                                            <span class="badge text-bg-primary">{{ $skill->skills }}</span>
                                            @endforeach
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
                                            <button class="nav-link" id="education-tab" data-bs-toggle="tab"
                                                data-bs-target="#education-tab-pane" type="button" role="tab"
                                                aria-controls="education-tab-pane"
                                                aria-selected="false">Education</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="skills-tab" data-bs-toggle="tab"
                                                data-bs-target="#skills-tab-pane" type="button" role="tab"
                                                aria-controls="skills-tab-pane" aria-selected="false">Skills</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="password-tab" data-bs-toggle="tab"
                                                data-bs-target="#password-tab-pane" type="button" role="tab"
                                                aria-controls="password-tab-pane"
                                                aria-selected="false">Password</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-4" id="profileTabContent">
                                        <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel"
                                            aria-labelledby="overview-tab" tabindex="0">
                                            <h5 class="mb-3">About</h5>
                                            <p class="lead mb-3">{{ $workerDetail->deskripsi }}</p>
                                            <h5 class="mb-3">Profile</h5>
                                            <div class="row g-0">
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Name</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $workerDetail->nama }}</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Date Of Birth</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $workerDetail->tgllahir }}</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Education</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">@if ($latestEducation)
                                                    <span>{{ $latestEducation->kualifikasi }} in
                                                        {{ $latestEducation->lembaga }} (Graduated:
                                                        {{ $latestEducation->thnlulus }})</span>
                                                    @else
                                                    <span>No education records available</span>
                                                    @endif</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Address</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $workerDetail->alamat }}</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Phone</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $workerDetail->notelp }}</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Email</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $user->email }}</div>
                                                </div>
                                                <div
                                                    class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                                                    <div class="p-2">Link</div>
                                                </div>
                                                <div
                                                    class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                                                    <div class="p-2">{{ $workerDetail->link }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <form action="{{ route('profile.update.worker') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-12">
                                                    <div class="row gy-2">
                                                        <label class="col-12 form-label m-0">Profile Image</label>
                                                        <div class="col-12">
                                                            @if ($workerDetail->logo_photo ?? false)
                                                            <img src="{{ asset($workerDetail->logo_photo) }}"
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
                                                            <input type="file" name="logo_photo"
                                                                class="form-control mt-2" id="logoPhotoInput">
                                                            @if ($workerDetail->logo_photo ?? false)
                                                            @endif
                                                            @error('logo_photo')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="col-12">
                                                    <label for="inputFirstName" class="form-label">Name</label>
                                                    <input type="text" name="nama" class="form-control" id="name"
                                                        value="{{ old('nama', $workerDetail->nama ?? '') }}" required>
                                                    @error('nama')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputLastName" class="form-label">Date Of Birth</label>
                                                    <input type="date" name="tgllahir" class="form-control"
                                                        id="tgllahir"
                                                        value="{{ old('tgllahir', $workerDetail->tgllahir ?? '') }}"
                                                        required>
                                                    @error('tgllahir')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputPhone" class="form-label">Phone</label>
                                                    <input type="text" name="notelp" class="form-control" id="notelp"
                                                        value="{{ old('notelp', $workerDetail->notelp ?? '') }}"
                                                        required>
                                                    @error('notelp')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputEmail" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email"
                                                        value="{{ $user->email }}" readonly>
                                                    @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAddress" class="form-label">Address</label>
                                                    <textarea type="text" name="alamat" class="form-control" id="alamat"
                                                        required>{{ old('alamat', $workerDetail->alamat ?? '') }}</textarea>
                                                    @error('alamat')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputLinkedIn" class="form-label">Link
                                                        (Optional)</label>
                                                    <input type="text" name="link" class="form-control" id="link"
                                                        value="{{ old('link', $workerDetail->link ?? '') }}">
                                                    @error('link')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAbout" class="form-label">About</label>
                                                    <textarea class="form-control" id="inputAbout" name="deskripsi"
                                                        required>{{ old('deskripsi', $workerDetail->deskripsi ?? '') }}</textarea>
                                                    @error('deskripsi')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="education-tab-pane" role="tabpanel"
                                            aria-labelledby="education-tab" tabindex="0">
                                            <form action="{{ route('worker.education.store') }}" method="POST"
                                                id="educationForm">
                                                @csrf
                                                <input type="hidden" name="id" id="educationId">
                                                <!-- Hidden input for ID when editing -->

                                                <div class="row gy-3 gy-xxl-4">
                                                    <div class="col-12">
                                                        <label for="kualifikasi" class="form-label">Kualifikasi</label>
                                                        <input type="text" name="kualifikasi" class="form-control"
                                                            id="kualifikasi"
                                                            placeholder="Mis: Diploma 3 Teknik Informatika" required>
                                                        @error('kualifikasi')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="lembaga" class="form-label">Lembaga</label>
                                                        <input type="text" name="lembaga" class="form-control"
                                                            id="lembaga"
                                                            placeholder="Mis: Universitas Logistik Dan Bisnis Internasional"
                                                            required>
                                                        @error('lembaga')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="thnlulus" class="form-label">Tahun Lulus</label>
                                                        <input type="number" name="thnlulus" class="form-control"
                                                            id="thnlulus" min="1900" max="{{ date('Y') }}"
                                                            placeholder="1900 - {{ date('Y') }}" required>
                                                        @error('thnlulus')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary"
                                                            id="submitButton">Tambah Education</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr>
                                            <h5 class="mb-3">List Education</h5>
                                            <div class="row g-0">
                                                @forelse ($educations->sortByDesc('thnlulus') as $education)
                                                <div
                                                    class="col-12 bg-light border-bottom border-white border-3 d-flex justify-content-between align-items-center p-2">
                                                    <!-- Qualification -->
                                                    <div class="text-truncate" style="width: 30%;">
                                                        {{ $education->kualifikasi }}</div>

                                                    <!-- Institution -->
                                                    <div class="text-truncate" style="width: 50%;">
                                                        {{ $education->lembaga }}</div>

                                                    <!-- Graduation Year -->
                                                    <div class="text-truncate" style="width: 10%;">
                                                        {{ $education->thnlulus }}</div>

                                                    <!-- Icons (Edit & Delete) -->
                                                    <div class="d-flex justify-content-end" style="width: 10%;">
                                                        <!-- Edit Icon -->
                                                        <a href="javascript:void(0)" class="me-2 text-primary"
                                                            data-id="{{ $education->id_education }}"
                                                            data-kualifikasi="{{ $education->kualifikasi }}"
                                                            data-lembaga="{{ $education->lembaga }}"
                                                            data-thnlulus="{{ $education->thnlulus }}"
                                                            onclick="editEducation(this)">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <!-- Delete Icon -->
                                                        <a href="javascript:void(0)" class="text-danger delete-btn"
                                                            data-id="{{ $education->id_education }}"
                                                            data-kualifikasi="{{ $education->kualifikasi }}">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
                                                        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="confirmDeleteModalLabel">Konfirmasi Hapus
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus pendidikan dengan
                                                                    kualifikasi:
                                                                    <strong id="deleteQualification"></strong>?
                                                                    Tindakan ini tidak dapat dibatalkan.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <form id="deleteForm" action="" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @empty
                                                <div
                                                    class="col-12 bg-light border-bottom border-white border-3 p-2 text-center">
                                                    No Education Records Found
                                                </div>
                                                @endforelse
                                            </div>
                                        </div>
                                        <!-- Skills Tab -->
                                        <div class="tab-pane fade" id="skills-tab-pane" role="tabpanel"
                                            aria-labelledby="skills-tab" tabindex="0">
                                            <form action="{{ route('worker.skills.store') }}" method="POST"
                                                id="skillsForm">
                                                @csrf
                                                <div class="row gy-3 gy-xxl-4">
                                                    <div class="col-12">
                                                        <label for="skillInput" class="form-label">Add a Skill </label>
                                                        <div class="form-label"><span style="color: blue;">(Tambah
                                                                Skills: Masukkan Nama Skills Lalu Enter Terus Klik
                                                                Save)</span> <span style="color: red;">(Hapus Skills:
                                                                Klik x Lalu Save)</span></div>
                                                        <input type="text" id="skillInput" class="form-control"
                                                            placeholder="Mis: PHP, Word, Excel, Javascript">
                                                    </div>
                                                    <div class="col-12" id="skillsContainer">
                                                        <!-- Display existing skills as badges -->
                                                        @foreach ($skills as $skill)
                                                        <span class="badge bg-primary me-2 skill-badge"
                                                            data-id="{{ $skill->id_skills }}">
                                                            {{ $skill->skills }}
                                                            <button type="button"
                                                                class="btn-close btn-close-white ms-1 remove-skill-btn"
                                                                aria-label="Remove"></button>
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Save
                                                            Skills</button>
                                                    </div>
                                                </div>
                                                <!-- Hidden input to store all skills as a comma-separated string -->
                                                <input type="hidden" name="skills" id="skillsHiddenInput"
                                                    value="{{ $skills->pluck('skills')->join(',') }}">
                                            </form>
                                        </div>
                                        <!-- Password Tab -->
                                        <div class="tab-pane fade" id="password-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <form action="{{ route('profile.worker.update.password') }}" method="POST">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </section>


        <section class="py-0 bg-primary-gradient">
            <div class="bg-holder"
                style="background-image:url(../home/assets/img/illustrations/footer-bg.png);background-position:center;background-size:cover;">
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
    document.addEventListener("DOMContentLoaded", function() {
        // Upload icon click event
        document.getElementById("uploadIcon").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("logoPhotoInput").click(); // Trigger file input
        });

        // Trash icon click event (remove image)
        document.getElementById("trashIcon")?.addEventListener("click", function(e) {
            e.preventDefault();

            // Remove the image preview
            document.getElementById("profileImagePreview").src =
                "{{ asset('assets/img/default-avatar.jpg') }}";

            // Clear the file input
            document.getElementById("logoPhotoInput").value = "";

            // Hide trash icon after deletion
            document.getElementById("trashIcon").style.display = 'none';
        });

        // File input change event (update image preview)
        document.getElementById("logoPhotoInput").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("profileImagePreview").src = e.target.result;
                };
                reader.readAsDataURL(file);

                // Show the trash icon when a new image is selected
                document.getElementById("trashIcon").style.display = 'inline-block';
            }
        });
    });
    </script>
    <script>
    function editEducation(element) {
        // Get data from the clicked Edit icon
        const id = element.getAttribute('data-id');
        const kualifikasi = element.getAttribute('data-kualifikasi');
        const lembaga = element.getAttribute('data-lembaga');
        const thnlulus = element.getAttribute('data-thnlulus');

        // Populate the form fields with the existing data
        document.getElementById('educationId').value = id;
        document.getElementById('kualifikasi').value = kualifikasi;
        document.getElementById('lembaga').value = lembaga;
        document.getElementById('thnlulus').value = thnlulus;

        // Update the form action to the update route with the ID
        const form = document.getElementById('educationForm');
        form.action = '/worker/education/update/' + id;

        // Change the button text to "Update Education"
        document.getElementById('submitButton').innerText = 'Update Education';
    }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener to delete buttons
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const educationId = button.getAttribute('data-id'); // Get the ID
                const kualifikasi = button.getAttribute(
                    'data-kualifikasi'); // Get the qualification name

                // Set the form action to the delete URL
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = '/worker/education/delete/' + educationId;

                // Update the qualification name in the modal
                document.getElementById('deleteQualification').textContent = kualifikasi;

                // Show the confirmation modal
                const confirmDeleteModal = new bootstrap.Modal(document.getElementById(
                    'confirmDeleteModal'));
                confirmDeleteModal.show();
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const skillInput = document.getElementById('skillInput');
        const skillsContainer = document.getElementById('skillsContainer');
        const skillsHiddenInput = document.getElementById('skillsHiddenInput');
        let skillsArray = skillsHiddenInput.value ? skillsHiddenInput.value.split(',') : [];

        // Add new skill on Enter key press
        skillInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const skill = skillInput.value.trim();
                if (skill && !skillsArray.includes(skill)) {
                    skillsArray.push(skill); // Add to the local array
                    updateSkillsDisplay(); // Update the badges display
                    skillInput.value = ''; // Clear input field
                }
            }
        });

        // Function to update the skills badges display
        function updateSkillsDisplay() {
            skillsContainer.innerHTML = ''; // Clear the container
            skillsArray.forEach(skill => {
                const badge = document.createElement('span');
                badge.className = 'badge bg-primary me-2 skill-badge';
                badge.innerHTML = `
                ${skill}
                <button type="button" class="btn-close btn-close-white ms-1 remove-skill-btn" aria-label="Remove"></button>
            `;
                skillsContainer.appendChild(badge);
            });
            skillsHiddenInput.value = skillsArray.join(','); // Sync with hidden input
        }

        // Event delegation for removing badges
        skillsContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-skill-btn')) {
                const skillBadge = event.target.closest('.skill-badge'); // Find the badge
                const skillName = skillBadge.textContent.trim(); // Extract the skill name

                // Remove from DOM immediately
                skillBadge.remove();

                // Remove from the array and update the hidden input
                skillsArray = skillsArray.filter(skill => skill !== skillName);
                skillsHiddenInput.value = skillsArray.join(',');

                // If the skill exists in the database (has a data-id), send a DELETE request
                const skillId = skillBadge.getAttribute('data-id');
                if (skillId) {
                    deleteSkillFromDatabase(skillId);
                }
            }
        });

        // Function to delete a skill from the database
        function deleteSkillFromDatabase(skillId) {
            fetch(`/worker/skills/delete/${skillId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        alert('Failed to delete the skill. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }
    });
    </script>

    <script>
    document.getElementById('logoutModal').addEventListener('shown.bs.modal', function() {
        console.log("Logout modal displayed");
    });
    </script>
    <script src="../home/vendors/@popperjs/popper.min.js"></script>
    <script src="../home/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../home/vendors/is/is.min.js"></script>
    <script src="../home/assets/js/theme.js"></script>
    <script src="../profile/bootstrap.bundle.min.js"></script>
</body>

</html>