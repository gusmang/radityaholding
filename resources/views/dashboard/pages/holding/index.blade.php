@extends('dashboard.index')

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="height-100-p mb-20" style="padding: 15px;">
                <div class="row align-items-center">
                    <div class="col-md-8" style="padding:0!important; margin:0!important;">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            <div class="weight-600 font-30">Daftar Role Holding</div>
                        </h4>
                        <p class="font-18 max-width-600"> Atur dan lihat daftar pengguna pada tabel dibawah </p>
                    </div>
                    <div class="col-md-4" style="padding:0!important; margin:0!important;">
                        <a href="#" onClick="" class="btn-block" data-toggle="modal" data-target="#bd-example-modal-lg" type="button">
                            <button class="btn btn-primary" style="float: right;">
                                <i class="fa fa-plus"></i>&nbsp; Tambah Role
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            @include("dashboard.pages.holding.components.modalUser")
            @include("dashboard.pages.holding.components.modalEdit")
            @include("dashboard.pages.holding.components.modalSignature")
            @include("dashboard.pages.holding.components.modalViewSignature")
            @include("dashboard.pages.holding.components.modalMenu")

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
                    </div>
                </div>
                <div class="pb-20">
                    <div style="clear: both; height: 10px;"></div>
                    <table class="table stripe hover nowrap">
                        <thead style="background: #F5F5F5; height: 60px;">
                            <tr>
                                <th> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></th>
                                <th class="table-plus datatable-nosort">Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $an = 0;
                            @endphp
                            @foreach($users as $row)
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
                                <td>
                                    @php
                                    echo $row->email
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo $row->role
                                    @endphp
                                </td>
                                <td>
                                    <div class="label-aktif">
                                        Aktif
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bd-addSignature-modal-lg" onclick="$('#sig_t_index').val({{ $row->id}});">
                                                <i class="fa fa-paper-plane"></i> Add / Edit Signature
                                            </a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bd-viewSignature-modal-lg" onclick="$('#sig_image_signature').attr('src','{{ url('storage/'.$row->signature_url) }}');">
                                                <i class="fa fa-eye"></i> View Signature
                                            </a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bd-addAccMenu-modal-lg" onclick="showMenu({{ $row }}); $('#acc_t_index').val({{ $row->id}});">
                                                <i class="fa fa-eye"></i> Access Menu
                                            </a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bd-password-modal-lg">
                                                <i class="dw dw-lock"></i> Ganti Password
                                            </a>
                                            <a class="dropdown-item"><i class="dw dw-eye"></i> View</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#bd-example-edit-modal-lg" onClick="showEdit({{ $row }})"><i class="dw dw-edit2"></i> Edit</a>
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
                    <div> @php echo $users->links('pagination::bootstrap-4'); @endphp </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("footer_modals_holding")
<script type="text/javascript">
    function showEdit(row) {
        document.getElementById("t_index_edit").value = row.id;
        document.getElementById("name_edit").value = row.name;
        document.getElementById("t_index_edit").value = row.id;
        document.getElementById("email_edit").value = row.email;
        document.getElementById("role_edit").value = row.role_id;
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


    $('#editHoldingForm').on('submit', function(event) {
        event.preventDefault();

        let urlDoc = "{{ route('update-holding') }}";

        $.ajax({
            type: "PUT"
            , url: urlDoc
            , data: $(this).serialize() + "&_token={{ csrf_token() }}"
            , dataType: "json"
            , success: function(data) {
                console.log("datas", data);
                if (data.status === 200) {
                    Swal.fire(
                        'Confirmed!'
                        , 'Edit Holding SuccessFull'
                        , 'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location = data.redirectUrl;
                        }
                    });
                }
            }
        });

    });

</script>
@endsection