<html>

<head>
    <title> Surat Pengadaan </title>
    
    <style>
        /* CSS styles for the table */
        body {
            font-family: Arial, sans-serif;
        }
        
        .export-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 12px;
        }
        
        .export-table th, 
        .export-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        .export-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .export-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .export-table tr:hover {
            background-color: #f1f1f1;
        }
        
        .export-btn {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .export-btn:hover {
            background-color: #45a049;
        }
    </style>

</head>

<body>
    <div>
        <img src="{{ $logoPath }}" style="height: 60px;" />
    </div>
    <div style="border:1px solid #000000; margin-top: 5px;"></div>
    <div style="border:2px solid #000000; margin-top: 2px;"></div>

    <table style="margin-top: 30px; width: 100%;" class="export-table">
        <thead>
            <tr>
                <th>No. Surat</th>
                <th>Perihal</th>
                <th>Nominal</th>
                <th>Unit Usaha</th>
                <th>Verifikator</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $an = 0;
        foreach($dataExport as $row){
            $an++;
            ?>
                <tr>
                    <td class="table-plus">
                        @php
                        echo "<b>".$row->no_surat."</b><br /><span
                            style='color: #666666'>".app('App\Helpers\Date')->tanggal_waktu($row->created_at ,
                            false)."</span>"
                        @endphp
                    </td>
                    <td>
                        @php
                        echo $row->perihal
                        @endphp
                    </td>
                    <td>
                        @php
                        echo app('App\Helpers\Str')->rupiah($row->nominal_pengajuan)
                        @endphp
                    </td>
                    <td>
                        @php
                        echo $row->unit_usaha
                        @endphp
                    </td>
                    <td>
                        @php
                        echo $row->next_verifikator
                        @endphp
                    </td>
                </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    </div>
</body>

</html>