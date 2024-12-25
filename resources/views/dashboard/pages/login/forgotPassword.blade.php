<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include("dashboard.pages.global.header")
</head>
<body class="login-page" style="background: #FFFFFF !important;">
    <div style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <div style="width: 45%; min-height: 200px;">
            <div>
                <div class="col-md-12 col-12">
                    <img src="{{ url('vendors/images/logo.png') }}" height="43" />
                </div>

                <div class="col-md-12 col-12 mt-2 mb-2">
                    <a href="{{ route('login') }}" class="mt-4 mb-4">
                        <i class="fa fa-arrow-left"></i> &nbsp;<small><b>Kembali</b></small>
                    </a>
                </div>

                <div class="col-md-12 col-12 mt-4">
                    <h3 style="font-weight: 400; font-size: 28px; line-height: 36px;">
                        Lupa Password
                    </h3>

                    <h5 class="mt-2" style="font-size: 14px; font-weight: normal;">
                        Masukkan email anda yang terdaftar untuk mendapatkan tautan untuk melakukan perubahan kata sandi
                    </h5>

                    <div style="margin-top: 30px;">
                        <form method="post" id="form_lupa_password">
                            @csrf
                            <div class="col-md-12 mt-4" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Email</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" id="inp_email" name="inp_email" placeholder="Masukkan Email" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary form-control text-white" type="submit" id="button_kirim">
                                    Kirim
                                </button>

                                <button class="btn btn-primary form-control text-white text-center" type="button" id="button_progress" disabled="disabled" style="display: none;">
                                    <div style="display: flex; align-items: center; justify-content: center;">
                                        <div class="spinner" style="margin-right: 10px;"></div> Please Wait ...
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome modal end -->
    <!-- js -->
    @include("dashboard.pages.global.footer")

    <script type="text/javascript">
        let loading = false;
        document.getElementById('form_lupa_password').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = $("#form_lupa_password").serialize();
            const urlRegist = "{{ url('forgot-pass'); }}";

            loading = true;

            $("#button_kirim").hide();
            $("#button_progress").show();

            $.ajax({
                url: urlRegist
                , data: formData
                , type: "POST"
                , dataType: "json"
                , success: function(response) {
                    if (response.status == 200) {
                        Swal.fire({
                            icon: "success"
                            , title: "Kami telah mengirimkan link reset password ke email anda"
                            , text: response.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "{{ url('reset-success') }}";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error"
                            , title: "Terjadi Kesalahan"
                            , text: response.message
                        });
                    }
                    loading = false;
                    $("#button_kirim").show();
                    $("#button_progress").hide();
                }
            });
        });

    </script>
</body>
</html>
