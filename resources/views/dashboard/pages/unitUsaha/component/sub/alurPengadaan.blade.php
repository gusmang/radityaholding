<div class="mt-40">

    @csrf
    <div class="card-box mb-20">
        <div class="pd-20">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h2 style="font-size: 22px;"> Daftar Role Pengadaan</h2>
                </div>

                <div class="col-md-6">
                    <input type="hidden" name="t_jumlah_role_pengadaan" id="t_jumlah_role_pengadaan"
                        value="{{ count($users_pengadaan) }}" />

                    <input type="hidden" name="t_index_pengadaan" id="t_index_pengadaan" value="{{ $unitUsaha->id }}" />
                    <a href="#" onClick="showModals();" class="btn-block" data-toggle="modal"
                        data-target="#bd-role-pengadaan-modal-lg" type="button">
                        <button class="btn btn-primary" style="float: right;" type="button">
                            <i class="fa fa-plus"></i>&nbsp; Tambah Role
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="pb-20" style="overflow: auto;">
            <div class="mt-40">
                <div style="display: flex; flex-direction: row; margin-top: 10px; padding:0 10px;">
                    <div style="padding:0 20px 20px 20px; color: #666666; cursor: pointer;"
                        class="tab-list-sub active-tab" id="tab-one-details" onclick="active_tab_surat(this.id , 1)">
                        Surat Biasa
                    </div>
                    <div style="padding:0 20px; color: #666666; cursor: pointer;" class="tab-list-sub"
                        id="tab-two-details" onclick="active_tab_surat(this.id , 2)">
                        Surat Lainnya
                    </div>
                </div>
                <div
                    style="border-bottom: 1px solid #DDDDDD; margin-top: 0;  padding:0 10px; margin-left: 10px; margin-right: 10px;">
                    <div style="display: flex; flex-direction: row;">
                        <div style="padding:0 10px; width: 170px;"></div>
                        <div style="padding:0 10px; width: 170px;"></div>
                    </div>
                </div>
            </div>
            <div style="clear: both; height: 30px;"></div>
        </div>

        <div class="pb-20">
            <div style="clear: both; height: 10px;"></div>

            <form method="post" id="formAlurPengadaan" name="formAlurPengadaan">
                <input type="hidden" name="t_jumlah_role_pengadaan" id="t_jumlah_role_pengadaan"
                    value="{{ count($users_pengadaan) }}" />

                <input type="hidden" name="t_index_pengadaan" id="t_index_pengadaan" value="{{ $unitUsaha->id }}" />

                @include("dashboard.pages.unitUsaha.component.sub.surat.biasa")

            </form>

            <form method="post" id="formAlurPengadaanLainnya" name="formAlurPengadaanLainnya">
                <input type="hidden" name="t_jumlah_role_pengadaanLainnya" id="t_jumlah_role_pengadaanLainnya"
                    value="{{ count($users_pengadaan) }}" />

                <input type="hidden" name="t_index_pengadaan" id="t_index_pengadaanLainnya"
                    value="{{ $unitUsaha->id }}" />

                @include("dashboard.pages.unitUsaha.component.sub.surat.lainnnya")

            </form>
        </div>

    </div>
</div>

@section("footer_modals")
<script type="text/javascript">
    function showModals() {
        $.ajax({
            type: "get",
            url: "{{ route('api-jabatan') }}",
            data: "",
            dataType: "json",
            success: function(data) {
                $('.select-field2').select2({
                    theme: 'bootstrap-5',
                    data: data
                });

            }
        });
    }

    $(document).ready(function() {
        // Attach event listener for form submission

        $('#formAlurPengadaan').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = $(this).serialize();
            const urlEdit = "{{ route('editPosPengadaan') }}";

            // alert("BosQue");

            // Send AJAX request
            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'POST',
                data: formData,
                dataType: "json",
                success: function(response) {
                    // Display server response
                    if (response.status === 200) {
                        //  window.location = response.redirectUrl;
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

        $('#formAlurPengadaanLainnya').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = $(this).serialize();
            const urlEdit = "{{ route('editPosPengadaanLainnya') }}";

            // alert("BosQue");

            // Send AJAX request
            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'POST',
                data: formData,
                dataType: "json",
                success: function(response) {
                    // Display server response
                    if (response.status === 200) {
                        //  window.location = response.redirectUrl;
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


        // $("#pid_role_unit_usaha").on('change', function(event) {
        //     //alert("changed");
        //     const urlRole = "{{ route('get_role_list') }}";

        //     $.ajax({
        //         url: urlRole, // URL to handle the form data
        //         type: 'GET',
        //         data: "value=" + this.value,
        //         success: function(response) {
        //             $("#pt_id_role").html(response);
        //         }
        //     });

        // })

        $('.formRolePengadaanNew').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = $(this).serialize();
            const urlEdit = "{{ route('role_pengadaan_save') }}";

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