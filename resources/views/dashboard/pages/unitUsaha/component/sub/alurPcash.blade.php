<div class="mt-40">
    <form method="post" id="formAlurPettyCash" name="formAlurPettyCash">
        @csrf
        <div class="card-box mb-20">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h2 style="font-size: 22px;"> Daftar Role Petty Cash</h2>
                    </div>

                    <div class="col-md-6">
                        <input type="hidden" name="t_jumlah_role" id="t_jumlah_role"
                            value="{{ count($users_petty_cash) }}" />
                        <input type="hidden" name="t_index_pembayaran" id="t_index_pengadaan_pembayaran"
                            value="{{ $unitUsaha->id }}" />
                        <a href="#" onClick="showModals();" class="btn-block" data-toggle="modal"
                            data-target="#bd-role-pettycash-modal-lg" type="button">
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
                            <th>Aktif</th>
                            <th>Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $an = 0;
                        @endphp
                        @foreach($users_petty_cash as $row)
                        @php
                        $an++;
                        @endphp
                        <tr>
                            <td>
                                <input type="hidden" id={{ "id_role_pettycash_".$an }}
                                    name={{ "id_role_pettycash_".$an }} class="form-control" value="{{ $row->id }}"
                                    style="width: 70px!important;" />
                                <input type="number" id={{ "role_pettycash_".$an }} name={{ "role_pettycash_".$an }}
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
                                        id={{ "checked_role_pettycash_".$an }} name={{ "checked_role_pettycash_".$an }}>
                                    <?php
                                    } else {
                                    ?>
                                    <input type="checkbox" class="switch-input" value="1"
                                        id={{ "checked_role_pettycash_".$an }} name={{ "checked_role_pettycash_".$an }}>
                                    <?php
                                    }
                                    ?>

                                    <span class="switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                <select id={{ "select_role_pettycash_".$an }} name={{ "select_role_pettycash_".$an }}
                                    class="form-control">
                                    <option value="0"> Mengajukan </option>
                                    <option value="1" {{ $row->menyetujui === 1 ? "selected" : "" }}> Menyetujui
                                    </option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="btn btn-primary" type="submit" style="margin-left: 20px; margin-top: 20px;">
                    <i class="fa fa-refresh"></i>&nbsp; Update Role
                </button>
            </div>
        </div>
    </form>
</div>

@section("footer_modals_pettyCash")
<script type="text/javascript">
function showModals() {
    $.ajax({
        type: "get",
        url: "{{ route('api-jabatan') }}",
        data: "",
        dataType: "json",
        success: function(data) {
            $('.select-field').select2({
                theme: 'bootstrap-4',
                data: data
            });
        }
    });
}

$("#pid_role_unit_usaha_ptc").on('change', function(event) {
        
    const urlRole = "{{ route('get_role_list') }}";
    let index = "{{ Request::segment(3) }}";
    
    $.ajax({
        url: urlRole, // URL to handle the form data
        type: 'GET',
        data: "value=" + this.value+"&index="+index,
        success: function(response) {
            $("#pt_id_rol_ptc").html(response);
        }
    });

});

$('.formRolePettyCashNew').on('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Serialize form data
    const formData = $(this).serialize();
    const urlEdit = "{{ route('role_petycash_save') }}";

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

$(document).ready(function() {
    // Attach event listener for form submission
    $('#formAlurPettyCash').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Serialize form data
        const formData = $(this).serialize();
        const urlEdit = "{{ route('editPosPettyCash') }}";

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