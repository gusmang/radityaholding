<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Register Sukses - Raditya Holding</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include("dashboard.pages.global.header")
</head>
<body class="login-page" style="background: #FFFFFF !important;">
    <div style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <div style="width: 45%; min-height: 200px;">
            <div>
                <div class="col-md-12 col-12 d-flex align-items-center justify-content-center" style="flex-direction: column;">
                    <img src="{{ url('vendors/images/logo.png') }}" height="43" width="100" />

                    <div style="margin-top: 40px;">
                        <img src="{{ url('vendors/images/waiting.png') }}" height="300" />
                    </div>
                </div>

                <div class="col-md-12 col-12 mt-4 text-center">
                    <h3 style="font-weight: 400; font-size: 28px; line-height: 36px;">
                        Tautan sudah mendaftar <br />sebagai unit usaha!
                    </h3>

                    <h5 class="mt-4" style="font-size: 14px; font-weight: normal;">
                        Tunggu Admin kami melakukan verifikasi untuk Akun Anda.<br />
                        Anda akan diberi notifikasi via email yang Anda <br />menggunakan untuk mendaftar sebagai unit usaha
                    </h5>

                    <div class="mt-4">
                        <a href="{{ url('/') }}">
                            <button class="btn btn-primary form-control text-white" type="button">
                                Kembali ke halaman login
                            </button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- welcome modal end -->
    <!-- js -->
    @include("dashboard.pages.global.footer")

    @yield("login_footer_scripts")
</body>
</html>
