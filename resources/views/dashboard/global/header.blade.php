<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Dashboard - Raditya Holding</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href={{ asset("vendors/styles/swal2.css") }} />
    <link rel="stylesheet" type="text/css" href={{ asset("vendors/styles/core.css") }} />
    <link rel="stylesheet" type="text/css" href={{ asset("vendors/styles/icon-font.min.css") }} />
    <link rel="stylesheet" type="text/css" href={{ asset("src/plugins/datatables/css/dataTables.bootstrap4.min.css") }} />
    <link rel="stylesheet" type="text/css" href={{ asset("src/plugins/datatables/css/responsive.bootstrap4.min.css") }} />
    <link rel="stylesheet" type="text/css" href={{ asset("vendors/styles/style.css") }} />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258" crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");

    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime()
                , event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0]
                , j = d.createElement(s)
                , dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");

    </script>

    <style>
        .sidebar-menu .submenu li>a:before {
            content: "" !important;
            position: absolute !important;
            line-height: 1 !important;
            left: 0 !important;
            width: 0 !important;
            height: 0 !important;
            -webkit-transform: translate(0px, -50%);
            -moz-transform: translate(0px, -50%);
            -o-transform: translate(0px, -50%);
            -ms-transform: translate(0px, -50%);
            transform: translate(0px, -50%);
            font-family: Ionicons;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        a {
            text-decoration: none;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #0d6efd !important;
            border-bottom: 2px solid #0d6efd !important;
            background: none !important;
        }

        .nav-pills .nav-link {
            border-radius: 0 !important;
        }

        .nav-pills .nav-link {
            border-radius: 0 !important;
        }

        .nav-pills .nav-link {
            color: #666 !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 3px !important;
        }

    </style>
    <!-- End Google Tag Manager -->
</head>
