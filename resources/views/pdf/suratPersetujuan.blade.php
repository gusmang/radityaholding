<html>

<head>
    <title> Surat Pengadaan </title>
    <style>
        @page{
            margin: 2.54cm 2.54cm 2.54cm 2.54cm;
        }

        body {
            margin: 0;
            padding: 0;
        }

        #tbl_detail table {
            padding: 15px;
            border: 1px solid #333333;
        }

        #tbl_detail td {
            padding: 10px;
            border-bottom: 1px solid #333333;
            border-left: 1px solid #333333;
        }

        #tbl_detail tbody {
            border: 1px solid #333333;
        }

        .page-break {
            page-break-before: always;
        }

        table#ttdTable {
            width: 100%;
            border-collapse: collapse;
            direction: rtl;
        }

        .ttd-td {
            width: 50%;
            vertical-align: top;
            text-align: center;
            padding: 20px;
            break-inside: avoid;
            box-sizing: border-box;
        }

        .ttd-td img {
            width: 100px;
            height: auto;
            margin-bottom: 8px;
        }

        .ttd-td {
            break-inside: avoid;
        }

        .underline {
            text-decoration: underline;
        }

        table{
            page-break-inside: avoid;
            table-layout: auto !important; /* Otomatis sesuaikan lebar kolom */
            width: 100% !important;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
    </style>
</head>

<body>
    <div>
        <img src="{{ $logoPath }}" style="height: 70px;"  />
    </div>
    <div style="border:1px solid #000000; margin-top: 5px;"></div>
    <div style="border:2px solid #000000; margin-top: 2px;"></div>

    <table style="margin-top: 10px;">
        <tr>
            <td width="150">No. </td>
            <td>: {{ $data->no_surat }} </td>
        </tr>
        <tr>
            <td width="150">Lampiran </td>
            <td>: {{ $lampiran === 0 ? "-" : $lampiran. " (".app('App\Helpers\Status')->terbilang($lampiran).")"." Gabung" }} 
        </tr>
        <tr>
            <td width="150">Perihal </td>
            <td>: {{ $data->perihal }} </td>
        </tr>

    </table>

    <div style="margin-top: 50px;">
        Kepada Yth. <br />
        Bapak dan Ibu Direksi 
        <br />
        Di Tempat
    </div>

    <div style="margin-top: 30px; line-height: 1.15;" id="tbl_detail">
        {!! app('App\Helpers\Status')->clean_width($data->detail) !!}
    </div>

    <div style="margin-top: 50px;">
        <div style="clear: both;"></div>
        {{-- <div class="page-break"></div> --}}

        <p>&nbsp;</p>
        <center> Menyetujui </center>
        <p>&nbsp;</p>

        <?php
        $incr = 0;
        $incs = 0;
        $positions = $data->position;
        $increment = 0;
        ?>

        <table id="ttdTable">
            <?php
                foreach ($menyetujui as $rows) {
                    //if($rows->is_menyetujui == 1){
                        $incr++;
                        $increment++;

                        if ($incr === 3) {
                        ?>
                            <tr>
                        <?php
                        $incr = 1;
                        }
                        ?>
                            <td class="ttd-td">
                                <?php
                                if ($rows->signature_url !== "-") {
                                ?>
                                    <img src={{ str_replace("public","",getcwd()).'storage/app/public/'.$rows->signature_url }}  />
                                <?php
                                }
                                ?>
                                <div class="underline"><strong><?php echo $rows->name ?></strong></div>
                                <div style="font-weight: 500;"><?php echo $rows->role; ?></div>
                            </td>
                        <?php
                        if ($incr === 3) {
                        ?>
                            </tr>
                        <?php
                        }
                   // }
                }
            ?>
        </table>
    </div>
</body>

</html>