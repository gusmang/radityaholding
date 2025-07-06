<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Login Page - Raditya Holding</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendors/images/logo_profile.ico') }}" />
    <link rel="icon" href="{{ asset('vendors/images/logo_profile.ico') }}" type="image/x-icon">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include("dashboard.pages.global.header")
</head>

<body class="login-page" style="background: #FFFFFF !important;">
    @if(session()->has('errors') && session('errors')->has('419'))
        <div class="alert alert-danger">
            Your session has expired. Please refresh the page and try again.
        </div>
    @endif
    <div style="display: flex; align-items: center; justify-content: center; height: 100vh;">

        <div class="col-md-5 col-12" style="min-height: 200px;">
            <div>
                <div class="col-md-12 col-12">
                    <img src="{{ asset('vendors/images/logo.png') }}" style="height: 50px;" />
                </div>

                <div class="col-md-12 col-12 mt-4">
                    <h3 style="font-weight: 400; font-size: 28px; line-height: 36px;">
                        Selamat datang di Document Approval
                        <br />
                        System Raditya Holdings
                    </h3>

                    <h5 class="mt-4" style="font-size: 14px; font-weight: normal;">
                        Masuk menggunakan akun yang sudah didaftarkan sebelumnya
                    </h5>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div style="margin-top: 30px;">
                        <form method="post" action={{ url('/login') }}>
                            @csrf
                            <div class="col-md-12" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Email</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" placeholder="Masukkan Email" name="email" required="required" />
                                </div>
                            </div>
                            <div class="col-md-12 mt-4" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Kata Sandi</label>
                                </div>
                                <div>
                                    <input type="password" class="form-control" placeholder="Masukkan Kata Sandi"
                                        name="password"  required="required" />
                                </div>
                            </div>

                            <div>
                                <h5 class="mt-4" style="font-size: 14px; font-weight: normal;">
                                    Lupa Kata Sandi ? <a href="{{ url('reset-pass' )}}"> Klik Disini </a>
                                </h5>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary form-control text-white">
                                    Masuk
                                </button>
                            </div>

                            {{-- <div class="mt-4">
                                <a href="<?php //echo url('/register' ); 
                                            ?>">
                                    <button class="btn btn-primary-outlined form-control" type="button">
                                        Daftar Sebagai Unit Usaha
                                    </button>
                                </a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome modal end -->
    <!-- js -->
    @include("dashboard.pages.global.footer")
</body>

</html>