<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Register Page - Raditya Holding</title>
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
                        Daftar Sebagai Unit Usaha
                    </h3>

                    <h5 class="mt-2" style="font-size: 14px; font-weight: normal;">
                        Lengkapi formulir dibawah untuk menyelesaikan registrasi sebagai unit usaha.
                    </h5>

                    <div style="margin-top: 30px;">
                        <form method="post" id="form_registration">
                            @csrf
                            <div class="col-md-12" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Nama</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" required="required" placeholder="Masukkan Name" id="inp_name" name="inp_name" />
                                </div>
                            </div>
                            <div class="col-md-12 mt-4" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Email</label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" required="required" placeholder="Masukkan Email" id="inp_email" name="inp_email" />
                                </div>
                            </div>
                            <div class="col-md-12 mt-4" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Unit Usaha</label>
                                </div>
                                <div>
                                    <select class="form-control" required="required" name="cmb_unit_usaha" id="cmb_unit_usaha">
                                        <option value="">- Pilih Unit Usaha -</option>
                                        @foreach($unitUsaha as $rows)
                                        <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                        @endforeach
                                        {{-- <option value="karyawan">Karyawan</option>
                                    <option value="manager">Manager</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4" style="padding:0; margin:0;">
                                <div>
                                    <label class="required-label">Kata Sandi</label>
                                </div>
                                <div>
                                    <input type="password" required="required" class="form-control" placeholder="Masukkan Kata Sandi" id="inp_kata_sandi" name="inp_kata_sandi" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary form-control text-white" type="submit">
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("dashboard.pages.global.footer")

    <script type="text/javascript">
        document.getElementById('form_registration').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = $("#form_registration").serialize();
            const urlRegist = "{{ url('new-registration'); }}";

            $.ajax({
                url: urlRegist
                , data: formData
                , type: "POST"
                , dataType: "json"
                , success: function(response) {
                    if (response.status == 200) {
                        Swal.fire({
                            icon: "success"
                            , title: "Pendaftaran Berhasil"
                            , text: response.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "{{ url('success-register') }}";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error"
                            , title: "Pendaftaran Gagal"
                            , text: response.message
                        });
                    }
                }
            });
        });

    </script>
</body>
</html>
