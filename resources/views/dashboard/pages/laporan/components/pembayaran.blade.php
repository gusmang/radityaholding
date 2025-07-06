<div id="div-lap-pembayaran" style="display: none;" class="div_display_unit">
    <div class="pb-20" style="overflow: auto;">
        <div style="clear: both; height: 10px;"></div>
        <table class="table stripe hover nowrap">
            <thead style="background: #F5F5F5; height: 60px;">
                <tr>
                    <th> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></th>
                    <th class="table-plus datatable-nosort">No. Surat</th>
                    <th>Perihal</th>
                    <th>Nominal Pengajuan</th>
                    <th>Status Surat</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $an = 0;
                @endphp
                @foreach($pembayaran as $row)
                @php
                $an++;
                @endphp
                <tr>
                    <td> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></td>
                    <td class="table-plus">
                        @php
                        echo $row->no_surat
                        @endphp
                    </td>
                    <td>
                        @php
                        echo $row->perihal
                        @endphp
                    </td>
                    <td>
                        @php
                        echo app("App\Helpers\Str")->rupiah($row->nominal_pengajuan)
                        @endphp
                    </td>
                    <td>
                        @php
                        echo $row->created_at
                        @endphp
                    </td>
                    <td>
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="<?php echo route('createZipPembayaran',['index' => $row->id]); ?>" target="_blank">
                            <i class="fa fa-download"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end;">
        <div> @php echo $pengadaan->links('pagination::bootstrap-4'); @endphp </div>
    </div>
</div>