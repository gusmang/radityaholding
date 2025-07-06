<div class="modal fade bs-example-modal-lg" id="bd-detail-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" name="formEditUsaha" id="formEditUsaha">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Edit Profile
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-12">
                                <label class="required-label"> Nama </label>
                                <div>
                                    <input type="hidden" class="form-control" value="" name="tIndex" id="tIndex" placeholder="Input Index ..." required />
                                    <input type="text" class="form-control" name="tName" id="tName" value="" placeholder="Input Nama ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="required-label"> Email </label>
                                <div>
                                    <input type="text" class="form-control" name="tEmail" id="tEmail" value="" placeholder="Input Email ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="required-label"> Password </label>
                                <div>
                                    <input type="password" class="form-control" name="tPassword" id="tPassword" value="" placeholder="Input Password ..." required />
                                </div>
                                <div class="password-match">
                                    Password Tidak Sama
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="required-label"> Ulangi Password </label>
                                <div>
                                    <input type="password" class="form-control" name="tUlangiPassword" id="tUlangiPassword" value="" placeholder="Ulangi Password ..." required />
                                </div>
                                <div class="password-match">
                                    Password Tidak Sama
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outlined" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@section("footer_modals")
<script type="text/javascript">
    function match_password(){
        let tPassVal = $("#tPassword").val();
        let tUlangiVal = $("#tUlangiPassword").val();
        if(tPassVal !== tUlangiVal){
            return false
        }
        else{
            return true
        }
    }
    
    $(document).ready(function() {
        // Attach event listener for form submission
        $('#formEditUsaha').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            if(match_password() === false){
                $(".password-match").show();
                return false;
            }

            // Serialize form data
            const formData = $(this).serialize();
            const urlEdit = "{{ route('editProfiles') }}";

            // Send AJAX request
            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'PUT'
                , data: formData
                , dataType: "json"
                , success: function(response) {
                    // Display server response
                    if (response.status === 200) {
                        Swal.fire({
                            icon: "success"
                            , title: "Success"
                            , text: response.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = response.redirectUrl;
                            } else if (result.isDenied) {
                                Swal.fire("Changes are not saved", "", "info");
                            }
                        });
                    } else {
                        alert(response.message);
                    }
                }
                , error: function(xhr, status, error) {
                    // Handle errors
                    $('#response').text('An error occurred: ' + error);
                }
            });
        });
    });

</script>
@endsection
