<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Success - Raditya Holding</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include("dashboard.pages.global.header")
    <!-- End Google Tag Manager -->
</head>
<body class="login-page" style="background: #FFFFFF !important;">
    <div style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <div style="width: 45%; min-height: 200px;">
            <div>
                <div class="col-md-12 col-12 d-flex align-items-center justify-content-center" style="flex-direction: column;">
                    <img src="{{ url('vendors/images/logo.png') }}" height="43" width="100" />

                    <div style="margin-top: 40px;">
                        <img src="{{ url('vendors/images/email-success.png') }}" height="300" />
                    </div>
                </div>

                <div class="col-md-12 col-12 mt-4 text-center">
                    <h3 style="font-weight: 400; font-size: 28px; line-height: 36px;">
                        Tautan sudah terkirim!
                    </h3>

                    <h5 class="mt-4" style="font-size: 14px; font-weight: normal;">
                        Cek kotak masuk email anda dan klik tautan untuk membuat kata sandi baru untuk akun anda.
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
</body>
</html>
