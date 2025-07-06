<div class="mt-40">
    <form method="post" id="formAlurPembayaran" name="formAlurPembayaran">
        @csrf
        <div class="card-box mb-20">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h2 style="font-size: 22px;">Daftar Role Pembayaran</h2>
                    </div>

                    <div class="col-md-6">
                        <input type="hidden" name="t_jumlah_role_pembayaran" id="t_jumlah_role_pembayaran"
                            value="{{ count($users_pembayaran) }}" />
                        <input type="hidden" name="t_index_pembayaran" id="t_index_pengadaan_pembayaran"
                            value="{{ $unitUsaha->id }}" />
                        <a href="#" onClick="showModals();" class="btn-block" data-toggle="modal"
                            data-target="#bd-role-pembayaran-modal-lg" type="button">
                            <button class="btn btn-primary" style="float: right;" type="button">
                                <i class="fa fa-plus"></i>&nbsp; Tambah Role
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
                            <th>Prioritas</th>
                            <th class="table-plus datatable-nosort">Role</th>
                            <th>Organisasi</th>
                            <th>Status</th>
                            <th>Tugas</th>
                            <th>Tolak</th>
                            <th>Tanda Tangan</th>
                            <th></th>
                            <!-- <th class="datatable-nosort"></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $an = 0;
                        @endphp
                        @foreach($users_pembayaran as $row)
                        @php
                        $an++;
                        @endphp
                        <tr>
                            <td>
                                <input type="hidden" id={{ "id_role_pembayaran_".$an }}
                                    name={{ "id_role_pembayaran_".$an }} class="form-control" value="{{ $row->id }}"
                                    style="width: 70px!important;" />
                                <input type="number" id={{ "role_pembayaran_".$an }} name={{ "role_pembayaran_".$an }}
                                    class="form-control" value="{{ $row->urutan }}" style="width: 70px!important;" />
                            </td>
                            <td class="table-plus">
                                @php
                                echo $row->name
                                @endphp
                            </td>
                            <td>
                                <?php echo $unitUsaha->name; ?>
                            </td>
                            <td>
                                <label class="switch">
                                    <?php
                                    if ($row->aktif == "1") {
                                    ?>
                                        <input type="checkbox" class="switch-input" value="1" checked
                                            id={{ "checked_role_pembayaran_".$an }}
                                            name={{ "checked_role_pembayaran_".$an }}>
                                    <?php
                                    } else {
                                    ?>
                                        <input type="checkbox" class="switch-input" value="1"
                                            id={{ "checked_role_pembayaran_".$an }}
                                            name={{ "checked_role_pembayaran_".$an }}>
                                    <?php
                                    }
                                    ?>

                                    <span class="switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                <select id={{ "select_role_pembayaran_".$an }} name={{ "select_role_pembayaran_".$an }} class="form-control">
                                    <?php
                                        if($row->menyetujui === 0){
                                        ?>
                                            <option value="0" selected> Mengajukan </option>
                                            <option value="1"> Menyetujui </option>
                                        <?php
                                        }
                                        else{
                                        ?>
                                            <option value="0"> Mengajukan </option>
                                            <option value="1" selected> Menyetujui </option>
                                        <?php
                                        }
                                        ?>
                                </select>
                            </td>
                            <td>
                                <label class="switch">
                                    <?php
                                    if ($row->rj == "1") {
                                    ?>
                                        <input type="checkbox" class="switch-input" value="1" checked
                                            id={{ "checked_role_rj_pengadaan_".$an }} name={{ "checked_role_rj_pengadaan_".$an }}>
                                    <?php
                                    } else {
                                    ?>
                                        <input type="checkbox" class="switch-input" value="1" id={{ "checked_role_rj_pengadaan_".$an }}
                                            name={{ "checked_role_rj_pengadaan_".$an }}>
                                    <?php
                                    }
                                    ?>
            
                                    <span class="switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                <label class="switch">
                                    <?php
                                    if ($row->is_menyetujui == "1") {
                                    ?>
                                        <input type="checkbox" class="switch-input" value="1" checked
                                            id={{ "checked_role_is_mt_pengadaan_".$an }} name={{ "checked_role_is_mt_pengadaan_".$an }}>
                                    <?php
                                    } else {
                                    ?>
                                        <input type="checkbox" class="switch-input" value="1" id={{ "checked_role_is_mt_pengadaan_".$an }}
                                            name={{ "checked_role_is_mt_pengadaan_".$an }}>
                                    <?php
                                    }
                                    ?>
            
                                    <span class="switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                <button class="btn btn-danger" type="button" onclick="deleteRole({{ $row->id }}, 'pembayaran')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="btn btn-primary" type="submit" style="margin-left: 20px; margin-top: 20px;">
                    <i class="fa fa-refresh"></i>&nbsp; Update Role
                </button>
            </div>

            {{-- <div
                style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end; margin-bottom: 20px;">
                <div> @php echo $users->links('pagination::bootstrap-4'); @endphp </div>
            </div> --}}
        </div>
    </form>
</div>

@section("footer_modals_pembayaran")
<script type="text/javascript">
    function showModals() {
        $.ajax({
            type: "get",
            url: "{{ route('api-jabatan') }}",
            data: "",
            dataType: "json",
            success: function(data) {
                $('.select-field').select2({
                    theme: 'bootstrap-5',
                    data: data
                });
            }
        });
    }

    $("#pid_role_unit_usaha_pmb").on('change', function(event) {
        
        const urlRole = "{{ route('get_role_list') }}";
        let index = "{{ Request::segment(3) }}";
        
        $.ajax({
            url: urlRole, // URL to handle the form data
            type: 'GET',
            data: "value=" + this.value+"&index="+index,
            success: function(response) {
                $("#pt_id_role_pembayaran").html(response);
            }
        });

    });

    $(document).ready(function() {
        // Attach event listener for form submission

        $('#formAlurPembayaran').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = $(this).serialize();
            const urlEdit = "{{ route('editPosPembayaran') }}";

            // Send AJAX request
            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'POST',
                data: formData,
                dataType: "json",
                success: function(response) {
                    // Display server response
                    if (response.status === 200) {
                        window.location = response.redirectUrl;
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    $('#response').text('An error occurred: ' + error);
                }
            });
        });

        $('#formAlurPembayaranNew').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = $(this).serialize();
            const urlEdit = "{{ route('role_pembayaran_save') }}";

            // Send AJAX request
            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'POST',
                data: formData,
                dataType: "json",
                success: function(response) {
                    // Display server response
                    if (response.status === 200) {
                        window.location = response.redirectUrl;
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    $('#response').text('An error occurred: ' + error);
                }
            });
        });

    });
</script>
@endsection