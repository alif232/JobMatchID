<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="home/assets/img/favicons/favicon-32x32.png">
    <title>JobMatchID | Sign Up</title>
    <link href="all/dist/css/style.min.css" rel="stylesheet">
</head>
<body>
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
             style="background:url(home/assets/img/illustrations/come-on-join.png) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(home/assets/img/illustrations/jobs.png);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="home/assets/img/favicons/favicon.ico" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Sign Up</h2>
                        <p class="text-center">Masukkan username, password dan pilih daftar sebagai apa.</p>

                        <!-- Display error or success alerts -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="mt-4" method="POST" action="{{ route('signup.submit') }}">
                        @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="uname">Username</label>
                                        <input class="form-control" type="text" name="username" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label text-dark" for="uname">Password</label>
                                    <div class="form-group mb-3">
                                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="uname">Konfirmasi Password</label>
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="level">Sebagai</label>
                                    <select name="level" id="level" class="form-control" required>
                                        <option value="worker">Worker</option>
                                        <option value="company">Company</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn w-100 btn-dark">Sign Up</button>
                                </div>
                        </form>
                        <div class="col-lg-12 text-center mt-5">
                            Already have an account? <a href="{{ route('signin') }}" class="text-danger">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="all/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="all/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(".preloader").fadeOut();
    </script>
</body>
</html>