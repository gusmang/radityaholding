<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Login Page - Raditya Holding</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include("dashboard.pages.global.header")
</head>

<body class="login-page" style="background: #FFFFFF !important;">
    <div style="display: flex; align-items: center; justify-content: center; height: 100vh;">

        <div class="col-md-5 col-12" style="min-height: 200px;">
            <div>
                <div class="col-md-12 col-12">
                    <img src="{{ asset('vendors/images/logo.png') }}" height="43" />
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

                    <div style="margin-top: 30px;">
                        <form method="post" action={{ url('/login') }}>
                            @csrf
                            <div class="col-md-12" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Email</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" placeholder="Masukkan Email" name="email" />
                                </div>
                            </div>
                            <div class="col-md-12 mt-4" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Kata Sandi</label>
                                </div>
                                <div>
                                    <input type="password" class="form-control" placeholder="Masukkan Kata Sandi"
                                        name="password" />
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