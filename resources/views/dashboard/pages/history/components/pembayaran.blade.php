<div id="suratPembayaranContainer" class="div_display_unit" style="display: none;">
    @include("dashboard.pages.surat.components.global.search")
    <table class="table stripe hover nowrap">
        <thead style="background: #F5F5F5; height: 60px;">
            <tr>
                <th> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></th>
                <th class="table-plus datatable-nosort">No. Surat</th>
                <th>Perihal</th>
                <th>Nominal Pengajuan</th>
                <th>Unit Usaha</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody id="tb-surat-pembayaran">
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
                    <a href="{{route('detailPembayaran',['index'=> $row->id])}}">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
                <!-- <td>
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="dw dw-more"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                    </div>
                </div>
            </td> -->
            </tr>
            @endforeach
        </tbody>
    </table>

    <div
        style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end;">
        <div> @php echo $pembayaran->links('pagination::bootstrap-4'); @endphp </div>
    </div>

</div>