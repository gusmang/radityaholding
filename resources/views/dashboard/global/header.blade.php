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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/12.1.2/css/highcharts.min.css" integrity="sha512-E7OW6cVoaC6yt40ga3PcBIgL/LPy03B4tVWw4+po0QTPTw8XD7vsQ0LC9NSqu/iE1QFgeBF04ybD4nw8HFzkUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href={{ asset("vendors/styles/swal2.css") }} />
    <link rel="stylesheet" type="text/css" href={{ asset("vendors/styles/core.css") }} />
    <link rel="stylesheet" type="text/css" href={{ asset("vendors/styles/icon-font.min.css") }} />
    <link rel="stylesheet" type="text/css"
        href={{ asset("src/plugins/datatables/css/dataTables.bootstrap4.min.css") }} />
    <link rel="stylesheet" type="text/css"
        href={{ asset("src/plugins/datatables/css/responsive.bootstrap4.min.css") }} />
    <link rel="stylesheet" type="text/css" href={{ asset("vendors/styles/style.css") }} />

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>
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
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
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

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        /* Hide the default checkbox */
        .switch-input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Style for the slider */
        .switch-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        /* Circle inside the switch */
        .switch-slider::before {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            width: 15px;
            height: 15px;
            background-color: white;
            border-radius: 50%;
            transition: 0.4s;
        }

        /* When the checkbox is checked (on state) */
        .switch-input:checked+.switch-slider {
            background-color: rgb(6, 158, 158);
            /* Green color when toggled on */
        }

        /* Move the circle to the right when toggled on */
        .switch-input:checked+.switch-slider::before {
            transform: translateX(26px);
        }

        .disabled-btn{
            background: #DDDDDD!important;
            color: #000000!important;
        }
        
        .disabled-button{
            display: none;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        .highcharts-description {
            margin: 0.3rem 10px;
        }

    </style>
    <!-- End Google Tag Manager -->
</head>