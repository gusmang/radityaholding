<div class="mt-40">
    <form method="post" id="formAlurPembayaran" name="formAlurPembayaran">
        @csrf
        <div class="card-box mb-20">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h2 style="font-size: 22px;"> Daftar Role Pembayaran</h2>
                    </div>

                    <div class="col-md-6">
                        <input type="hidden" name="t_jumlah_role_pembayaran" id="t_jumlah_role_pembayaran"
                            value="{{ count($users) }}" />
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
                                <select name="" class="form-control">
                                    <option value="0"> Mengajukan </option>
                                    <option value="1"> Menyetujui </option>
                                </select>
                            </td>
                            <!-- <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                        role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#bd-password-modal-lg">
                                            <i class="dw dw-lock"></i> Ganti Password
                                        </a>
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

                <button class="btn btn-primary" type="submit" style="margin-left: 20px; margin-top: 20px;">
                    <i class="fa fa-refresh"></i>&nbsp; Update Role
                </button>
            </div>

            <div
                style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end; margin-bottom: 20px;">
                <div> @php echo $users->links('pagination::bootstrap-4'); @endphp </div>
            </div>
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
                        // window.location = response.redirectUrl;
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