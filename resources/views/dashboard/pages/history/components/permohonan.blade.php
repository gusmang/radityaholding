<div id="suratPermohonanContainer" class="div_display_unit">
    @include("dashboard.pages.surat.components.global.search")
    <table class="table stripe hover nowrap">
        <thead style="background: #F5F5F5; height: 60px;">
            <tr>
                <th> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></th>
                <th class="table-plus datatable-nosort">No. Surat</th>
                <th>Perihal</th>
                <th>Nominal Pengajuan</th>
                <th>Unit Usaha</th>
                <th>Verifikator</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @php
            $an = 0;
            @endphp
            @foreach($pengadaan as $row)
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
                    @php
                    echo $row->next_verifikator
                    @endphp
                </td>
                <td>
                    <?php
                    if($row->is_rejected === 1){
                        ?>
                            <div class="badge-rejected"> Rejected</div>
                        <?php
                    }
                    else if($row->is_rejected === 0 && $row->position === 0){
                        ?>
                            <div class="badge-pending"> Pending </div>
                        <?php
                    }
                    else if($row->position > 0){
                        ?>
                            <div class="badge-success"> Approved </div>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if($row->tipe_surat == "2"){
                        ?>
                            <a href="{{route('detailLainnya',['index'=> $row->id])}}"> 
                                <i class="fa fa-eye"></i> 
                            </a>
                        <?php
                    }
                    else{
                    ?>
                        <a href="{{route('detailPengadaan',['index'=> $row->id])}}"> 
                            <i class="fa fa-eye"></i> 
                        </a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div
        style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end;">
        <div> @php echo $pengadaan->links('pagination::bootstrap-4'); @endphp </div>
    </div>

</div>