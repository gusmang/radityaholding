<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Raditya Holding</title>


</head>

<body style="-webkit-text-size-adjust: none; box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; height: 100%; line-height: 1.4; margin: 0; width: 100% !important;" bgcolor="#F2F4F6">
    <style type="text/css">
        body {
            width: 100% !important;
            height: 100%;
            margin: 0px auto !important;
            line-height: 1.4;
            background-color: #F2F4F6;
            color: #74787E;
            -webkit-text-size-adjust: none;
        }

        @media only screen and (max-width: 600px) {
            .email-body_inner {
                width: 100% !important;
            }

            .email-footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

    </style>
    <table class="email-wrapper text-left" width="100%" aligin="center" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0px auto !important; padding: 0; width: 100%;" bgcolor="#F2F4F6" summary="Tabel reset password">
        <tr>
            <th scope="col" align="center" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;">
                <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" summary="Tabel reset password">
                    <tr>
                        <th scope="col" class="email-masthead" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding: 25px 0; word-break: break-word;" align="center">
                            <img src="{{ url("vendors/images/logo.png") }}" style="margin:auto;display:block;width: 130px;" alt="logo radityaHolding">
                        </th>
                    </tr>

                    <tr>
                        <th scope="col" class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 0; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;">
                            <table class="email-body_inner text-left" style="margin-bottom: 50px" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF" summary="Tabel reset password">
                                <tr>
                                    <th scope="col" class="content-cell" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding: 35px; word-break: break-word;">

                                        <h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin-top: 0;" align="left">Hi, {{ $row->name }}</h1>
                                        <p style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 14px; line-height: 1.5em; margin-top: 0;" align="left">Kamu akan Merubah Password {{ $row->email }}!</p>

                                        <table class="purchase" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; width: 100%; padding: 15px;" bgcolor="#F2F4F6" summary="Tabel reset password">

                                            <tr>
                                                <th scope="col" colspan="2" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;">
                                                    <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" summary="Tabel reset password">

                                                        <tr>
                                                            <th scope="col" width="30%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 14px; line-height: 18px; padding: 10px 0; word-break: break-word;border-bottom: 1px dashed #e3e3e3;">
                                                                <a href="{{ $urlReset }}">Klik Link Ini</a>
                                                                Untuk Reset Password
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </th>
                                            </tr>
                                        </table>
                                        <p style="color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 14px; line-height: 1.5em; margin-top: 15px;" align="left">Klik Link Diatas untuk Melakukan Reset Password Akun Kamu!
                                        </p>
                                    </th>
                                </tr>
                            </table>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word; background: {{ url('/') == env('BALICASH_BASE_URL') ? '#C02227' : '#1a2eb0' }};">
                            <table class="email-footer text-left" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;" summary="Tabel reset password">
                                <tr>
                                    <th scope="col" class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding: 35px; word-break: break-word;">
                                        <p class="sub align-center" style="box-sizing: border-box; color: #FFF; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">
                                            Email ini dikirim secara otomatis oleh sistem, mohon untuk tidak membalas
                                            email ini.<br> Jika Anda
                                            perlu bantuan silakan hubungi <a href="#" style="color:#FFF">{{ url('/')  }}</a><br><br>
                                        </p>
                                        <p class="sub align-center" style="box-sizing: border-box; color: #FFF; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">© {!! DATE('Y') !!}
                                            {{ url('/') }}
                                            All rights reserved.</p>
                                    </th>
                                </tr>
                            </table>
                        </th>
                    </tr>
                </table>
            </th>
        </tr>
    </table>
</body>

</html>
