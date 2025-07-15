<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Dashboard - Raditya Holding</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendors/images/logo_profile.ico') }}" />
    <link rel="icon" href="{{ asset('vendors/images/logo_profile.ico') }}" type="image/x-icon">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <script type="text/javascript">
        // let templates = (suratDate = '15 Oktober 2024', 
        // suratNo = '210/RDT/GYR/X/2024', 
        // employeeName = 'I Ketut Arimbawa', 
        // position = 'AO (Account Officer)', 
        // joinDate = '25 Maret 2014',
        // deceasedName = 'I Made Merta',
        // deceasedDate = '13 Oktober 2024',
        // skNo = '648/Holding/HRD/VI/2023',
        // amount = '500.000',
        // amountText = 'Lima Ratus Ribu Rupiah') => `
        // <p>Dengan Hormat,&nbsp;</p>
        
        // <p>Menindaklanjuti Surat yang masuk dari PT. Raditya Dewata Perkasa Cabang Gianyar pada tanggal ${suratDate} dengan nomor Surat ${suratNo} Perihal Permohonan Persetujuan Pemberian Dana Duka untuk karyawan Raditya Gianyar yang Orang Tua Kandung Meninggal Dunia (${deceasedName}) pada tanggal ${deceasedDate}. Karyawan tersebut a/n ${employeeName} Jabatan Sebagai ${position} (Join/Masa Kerja dari tanggal ${joinDate} s/d Sekarang).&nbsp;</p>
        
        // <p>Berdasarkan Surat Keputusan yang berlaku No.${skNo} tentang Pedoman Pemberian Manfaat Dana Duka /Dana Sosial bagi karyawan yang orang tua kandung meninggal dunia akan mendapatkan dana sosial, maka yang bersangkutan akan diberikan dana sebesar Rp ${amount},- (${amountText}) dan sudah dikoordinasikan bersama pihak HRD sesuai dengan peraturan yang berlaku di perusahaan. Adapun Rincian sebagai berikut :</p>
        
        // <table cellspacing="0" style="border-collapse:collapse; width:100%">
        //     <tbody>
        //         <tr>
        //             <td style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; vertical-align:top; width:34px">
        //             <p><strong>No</strong></p>
        //             </td>
        //             <td style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; vertical-align:top; width:45%">
        //             <p><strong>KETERANGAN</strong></p>
        //             </td>
        //             <td style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; vertical-align:top; width:113px">
        //             <p><strong>TOTAL</strong></p>
        //             </td>
        //         </tr>
        //         <tr>
        //             <td style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; vertical-align:top; width:34px">
        //             <p>1</p>
        //             </td>
        //             <td style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; vertical-align:top; width:45%">
        //             <p>Permohonan Persetujuan Pemberian Dana Duka untuk karyawan Raditya Gianyar yang Orang Tua Kandung Meninggal Dunia (${deceasedName}) pada tanggal ${deceasedDate}. Karyawan tersebut a/n ${employeeName} Jabatan Sebagai ${position} (Join/Masa Kerja dari tanggal ${joinDate} s/d Sekarang).&nbsp;</p>
        //             </td>
        //             <td style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; vertical-align:top; width:113px">
        //             <p><strong>Rp ${amount},-</strong></p>
        //             </td>
        //         </tr>
        //         <tr>
        //             <td colspan="2" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; vertical-align:top; width:34px">
        //             <p><strong>Terbilang : ${amountText}&nbsp;</strong></p>
        //             </td>
        //             <td style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000; vertical-align:top; width:45%">
        //             <p><strong>Rp ${amount},-</strong></p>
        //             </td>
        //         </tr>
        //     </tbody>
        // </table>
        
        // <p>Bersama dengan ini kami mohon persetujuan dari Ibu Direksi untuk memberikan dana berdasarkan permohonan di atas.</p>
        
        // <p>Demikian permohonan ini kami sampaikan, atas perhatian dari Ibu Direksi kami haturkan terima kasih</p>
        
        // <p>&nbsp;</p>`;

        let templates = (suratDate = '15 Oktober 2024', 
        suratNo = '210/RDT/GYR/X/2024', 
        employeeName = 'I Ketut Arimbawa', 
        position = 'AO (Account Officer)', 
        joinDate = '25 Maret 2014',
        deceasedName = 'I Made Merta',
        deceasedDate = '13 Oktober 2024',
        skNo = '648/Holding/HRD/VI/2023',
        amount = '500.000',
        amountText = 'Lima Ratus Ribu Rupiah') => `
        <p>Dengan Hormat,&nbsp;</p>
        
        <p>Isi Surat</p>

        <p>Demikian permohonan ini kami sampaikan, atas perhatian dari Bapak/Ibu Direksi kami haturkan terima kasih.</p>
        <p>&nbsp;</p>`;
    </script>

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

        .badge-rejected{
            width: 80px;
            height: 40px;
            padding: 10px;
            color: #FFFFFF;
            background: #FF0000;
            text-align: center;
            border-radius: 5px;
        }

        .badge-icons{
            width: 35px; 
            height: 35px; 
            color: #FFFFFF; 
            background: green; 
            display: flex; 
            align-items:center; 
            justify-content: center; 
            border-radius: 5px;
        }

        .badge-pending{
            width: 80px;
            height: 40px;
            padding: 10px;
            color: #FFFFFF;
            background: rgb(217, 106, 1);
            text-align: center;
            border-radius: 5px;
        }

        .badge-success{
            width: 80px;
            height: 40px;
            padding: 10px;
            color: #FFFFFF;
            background: rgb(11, 167, 11);
            text-align: center;
            border-radius: 5px;
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

        /* timeline */

        .uk-timeline .uk-timeline-item .uk-card {
            max-height: 300px;
        }

        .uk-timeline .uk-timeline-item {
            display: flex;
            position: relative;
        }

        .uk-timeline .uk-timeline-item::before {
            background: #dadee4;
            content: "";
            height: 100%;
            left: 19px;
            position: absolute;
            top: 20px;
            width: 2px;
                z-index: -1;
        }

        .uk-timeline .uk-timeline-item .uk-timeline-icon .uk-badge {
                margin-top: 20px;
            width: 40px;
            height: 40px;
        }

        .uk-timeline .uk-timeline-item .uk-timeline-content {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 0 0 0 1rem;
        }

        /* .highcharts-background {
            fill: "#FF0000!important"
        } */

        .highcharts-background {
            fill: #FFFFFF !important;
        }

        button.form-control{
            color: #FFFFFF !important;
        }

        .password-match{
            color: #FF0000;
            font-size: 11px;
            display: none;
        }

        /* end timeline */

        /* Mobile portrait */
        @media (max-width: 480px) {
        /* Mobile-specific styles */
            .is_mobile{
                display: inherit;
            }

            .is_desktop{
                display: none;
            }
        }

        /* Mobile landscape */
        @media (min-width: 481px) and (max-width: 767px) {
        /* Styles for larger mobile */
            .is_mobile{
                display: inherit;
            }

            .is_desktop{
                display: none;
            }
        }

        /* Tablet */
        @media (min-width: 768px) and (max-width: 1023px) {
        /* Tablet styles */
            .is_mobile{
                display: inherit;
            }

            .is_desktop{
                display: none;
            }
        }

        /* Desktop */
        @media (min-width: 1024px) {
        /* Desktop styles */
            .is_mobile{
                display: none;
            }

            .is_desktop{
                display: inherit;
            }
        }

        .timeliner {
            & ul, & li {
                list-style: none;
                padding: 0;
            }

            & .container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            & .wrapper {
                /* background: #eaf6ff; */
                padding: 1rem;
                border-radius: 15px;
            }

            & h1 {
                font-size: 1.1rem;
                font-family: sans-serif;
            }

            & .sessions {
                margin-top: 2rem;
                border-radius: 12px;
                position: relative;
            }

            & li {
                padding-bottom: 1.5rem;
                border-left: 1px solid #abaaed;
                position: relative;
                padding-left: 20px;
                margin-left: 10px;
                
                &:last-child {
                border: 0px;
                padding-bottom: 0;
                }
                
                &:before {
                content: '';
                width: 15px;
                height: 15px;
                background: white;
                border: 1px solid #4e5ed3;
                box-shadow: 3px 3px 0px #bab5f8;
                border-radius: 50%;
                position: absolute;
                left: -10px;
                top: 0px;
                }
            }

            & .time {
                color: #2a2839;
                font-family: 'Poppins', sans-serif;
                font-weight: 500;
                
                @media (min-width: 768px) { /* mobile-and-up replacement */
                font-size: .9rem;
                }
                
                @media (max-width: 767px) { /* mobile-only replacement */
                margin-bottom: .3rem;
                font-size: 0.85rem;
                }
            }

            & p {
                color: #4f4f4f;
                font-family: sans-serif;
                line-height: 1.5;
                margin-top: 0.4rem;
                
                @media (max-width: 767px) { /* mobile-only replacement */
                font-size: .9rem;
                }
            }
        }

        .call-to-action-wa {
            position:fixed;  
            font-family:sans-serif;
            bottom:10px; 
            right:10px; 
            background-color:#25D366; 
            color:#FFFFFF!important; 
            border-radius:40px; 
            padding:10px 16px 10px 12px; 
            text-decoration:none; 
            display:flex; 
            align-items:center; 
            box-shadow:0 4px 10px rgba(0,0,0,0.2); 
            font-weight:bold; 
            z-index:1000;
            opacity: 0.9;
        }

        .call-to-action-wa:hover{
            opacity: 1;
        }

        @media only screen and (max-width: 767px) {
            /* Mobile-specific styles */
            .riwayat-approval{
                display: none;
            }
        }
        

    </style>
    <!-- End Google Tag Manager -->
</head>