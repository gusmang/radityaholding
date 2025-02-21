<html>

<head>
    <title> Surat Pengadaan </title>
    <style>
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
    </style>
</head>

<body>
    <div>
        <img src="{{ $logoPath }}" height="100" />
    </div>
    <div style="border:1px solid #000000; margin-top: 5px;"></div>
    <div style="border:2px solid #000000; margin-top: 2px;"></div>

    <table style="margin-top: 10px;">
        <tr>
            <td width="150">No. </td>
            <td>: {{ $data->no_surat }} </td>
        </tr>
        <tr>
            <td width="150">Lampiran. </td>
            <td>: (satu) Lampiran </td>
        </tr>
        <tr>
            <td width="150">Perihal. </td>
            <td>: {{ $data->perihal }} </td>
        </tr>

    </table>

    <div style="margin-top: 50px;">
        Kepada Yth. <br />
        Ibu Direksi
        <br />
        di Tempat
    </div>

    <div style="margin-top: 30px;" id="tbl_detail">
        {!! $data->detail !!}
    </div>

    <div style="text-align: center; margin-top: 30px;">
        Canggu , {{ app('App\Helpers\Date')->tanggalIndo($data->created_at) }} <br />
        Mengajukan
    </div>

    <div style="margin-top: 50px;">
        <?php
        $incr = 0;
        $incs = 0;
        $positions = $data->position;

        foreach ($jabatan as $rows) {
            $incr++;
        ?>
            <?php
            if ($incr === 3) {
            ?>
                <div style="clear: both; height: 30px;"></div>
            <?php
                $incr = 1;
            }
            ?>
            <div style="float: left; width: 50%; text-align: center;">
                <div style="text-decoration: underline; font-weight; bold;">
                    <b><?php echo $rows->name ?></b>
                </div>
                <div style="height: 100px; padding: 10px 0;">
                    <?php
                    if ($rows->signature_url !== "-") {
                    ?>
                        <img src={{ str_replace("public","",getcwd()).'/storage/app/public/'.$rows->signature_url }}
                            style="height: 90px;" />
                    <?php
                    }
                    ?>
                </div>
                <div>
                    <?php echo $rows->role; ?>
                </div>
            </div>
        <?php
            $incs++;
        }
        ?>

        <p>&nbsp;</p>
        <center> Menyetujui </center>

        <?php
        $incr = 0;
        $incs = 0;
        $positions = $data->position;

        foreach ($menyetujui as $rows) {
            $incr++;
        ?>
            <?php
            if ($incr === 3) {
            ?>
                <div style="clear: both; height: 30px;"></div>
            <?php
                $incr = 1;
            }
            ?>
            <div style="float: left; width: 50%; text-align: center;">
                <div style="text-decoration: underline; font-weight; bold;">
                    <b><?php echo $rows->name ?></b>
                </div>
                <div style="height: 100px; padding: 10px 0;">
                    <?php
                    if ($rows->signature_url !== "-") {
                    ?>
                        <img src={{ str_replace("public","",getcwd()).'/storage/app/public/'.$rows->signature_url }}
                            style="height: 90px;" />
                    <?php
                    }
                    ?>
                </div>
                <div>
                    <?php echo $rows->role; ?>
                </div>
            </div>
        <?php
            $incs++;
        }
        ?>
    </div>
</body>

</html>