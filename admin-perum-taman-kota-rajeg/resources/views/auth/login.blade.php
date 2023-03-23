<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - Perum Taman Kota Rajeg</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/security-icon.png') }}" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-custom.css') }}">
</head>

<body>
    <div id="app">
        <section>
            <div class="container bg-white pb-5">
                <div class="row d-flex justify-content-start align-items-center mt-sm-5">
                    <div class="col-lg-5 col-10">
                        <div id="circle"></div>
                        <div class="pb-5"> <img src="{{ asset('assets/img/image-login.png') }}" alt=""> </div>
                    </div>
                    <div class="col-lg-4 offset-lg-2 col-md-6 offset-md-3">
                        <div class="mt-3 mt-md-5">
                            <h5>Selamat Datang Admin Perum Taman Kota Rajeg</h5>
                            <form class="pt-4" method="POST" action="{{ route('login') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="Masukkan Alamat Email" value="{{ old('email') }}" tabindex="1"
                                        required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password"
                                            class="control-label @error('password') is-invalid @enderror">Password</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password"
                                        placeholder="Masukkan Password" tabindex="2" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input"
                                            tabindex="3" id="remember-me">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <!-- Copyright -->
        <div class="text-center p-4 mb-0">
            Build with ❤️
            <a class="text-reset fw-bold" href="https://github.com/Bahrul-Rozak">Bahrul Rozak</a>
        </div>
        <!-- Copyright -->
    </footer>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
