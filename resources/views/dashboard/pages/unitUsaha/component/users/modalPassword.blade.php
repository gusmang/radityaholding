<div class="modal fade bd-password-modal-lg" id="bd-password-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" id="form-ulangi-password" name="form-ulangi-password">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Ganti Password
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <input type="hidden" name="sig_rp_unit_usaha_edit" id="sig_rp_unit_usaha_edit"
                                value="{{ $unitUsaha->id }}" />
                            <input type="hidden" class="form-control" name="sig_rp_t_index" id="sig_rp_t_index"
                                placeholder="Input Index ..." required />

                            <div class="col-md-12">
                                <label class="required-label"> Kata Sandi Baru </label>
                                <div>
                                    <input type="password" class="form-control" name="sig_rp_new_pass"
                                        id="sig_rp_new_pass" placeholder="Input Kata Sandi Baru ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Ulangi Kata Sandi </label>
                                <div>
                                    <input type="password" placeholder="Ulangi Kata Sandi ..." class="form-control"
                                        name="sig_rp_recon_pass" id="sig_rp_recon_pass" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outlined" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


@section("footer_modals_rs_password_ptc")
<script type="text/javascript">
    $(document).ready(function() {
        // Attach event listener for form submission

        $('#form-ulangi-password').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            if($("#sig_rp_new_pass").val() !== $("#sig_rp_recon_pass").val()){
                alert("Password tidak sama !");
                return false;
            }

            // Serialize form data
            const formData = $(this).serialize();
            const urlEdit = "{{ route('reset-password') }}";

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
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location = response.redirectUrl;
                            } else if (result.isDenied) {
                                Swal.fire("Changes are not saved", "", "info");
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something Wrong"
                        })
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    $('#response').text('An error occurred: ' + error);
                }
            });
        });
    })
</script>
@endsection