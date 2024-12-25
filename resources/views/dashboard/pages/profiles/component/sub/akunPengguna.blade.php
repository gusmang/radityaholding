<div class="mt-40">
    <div class="card-box mb-20">
        <div class="pd-20">
            <div class="row">
                <div class="col-3">
                    <div> <label> Cari Nama :</label> </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Cari Nama" name="cari_nama" />
                    </div>
                </div>

                <div class="col-3">
                    <div> <label> Tipe Pengguna :</label> </div>
                    <div>
                        <select class="form-control" name="tipe_pengguna">
                            <option value=""> - Tipe Pengguna - </option>
                            <option value="manager">Manager</option>
                            <option value="sekretaris">Sektretaris</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <a href="#" onClick="" class="btn-block" data-toggle="modal" data-target="#bd-example-modal-lg" type="button">
                        <button class="btn btn-primary" style="float: right;">
                            <i class="fa fa-plus"></i>&nbsp; Tambah Pengguna
                        </button>
                    </a>
                </div>
            </div>
        </div>


        <div class="pb-20">
            <div style="clear: both; height: 10px;"></div>
            <table class="table stripe hover nowrap">
                <thead style="background: #F5F5F5; height: 60px;">
                    <tr>
                        <th> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></th>
                        <th class="table-plus datatable-nosort">Role / Peran </th>
                        <th class="table-plus datatable-nosort">Note</th>
                        <th>Status</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $an = 0;
                    @endphp
                    @foreach($position as $row)
                    @php
                    $an++;
                    @endphp
                    <tr>
                        <td> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></td>
                        <td class="table-plus">
                            @php
                            echo $row->name
                            @endphp
                        </td>
                        <td class="table-plus">
                            @php
                            echo $row->note
                            @endphp
                        </td>
                        <td>
                            <div class="{{ $row->status === 0 ? 'label-nonaktif' : 'label-aktif' }}">
                                {{ $row->status === 0 ? 'Non Aktif' : 'Aktif' }}
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bd-editSignature-modal-lg" onclick="showedit({{ $row }})">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bd-addAccMenu-modal-lg" onclick="showMenu({{ $row }}); $('#acc_t_index').val({{ $row->id}});">
                                        <i class="dw dw-eye"></i> Access Menu
                                    </a>
                                    <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end; margin-bottom: 20px;">
            <div> @php echo $position->links('pagination::paging-setting-users'); @endphp </div>
        </div>
    </div>
</div>


@section("footer_modals_pengguna")
<script type="text/javascript">
    function showedit(rows) {
        $("#edit_name").val(rows.name);
        $("#edit_note").val(rows.note);
        $("#t_index_edit").val(rows.id);
        $("#chk_aktif_edit").prop('checked', rows.aktif);
    }

    function showMenu(rows) {
        const urlGet = "{{ route('getAccessMenu') }}" + "?index=" + rows.id;
        //$("#chk_menus_1").prop("checked", 1);

        $.ajax({
            type: "GET"
            , data: ""
            , dataType: "json"
            , url: urlGet
            , success: function(response) {
                const resData = response.data

                for (let an = 0; an < resData.length; an++) {
                    console.log("Menu", "#chk_menus_" + resData[an].id_menu);
                    $("#chk_menus_" + resData[an].id_menu).prop("checked", 1);
                    if (an === resData.length - 1) {
                        $("#bd-addAccMenu-modal-lg").modal("show");

                    }
                }
            }
        });
    }

</script>
@endsection