<div class="modal fade bs-example-modal-lg" id="bd-addAccMenu-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" id="formMenuUsaha">
        @csrf
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Add Access Menu
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="acc_t_index" id="acc_t_index" placeholder="Input Index ..." required />
                    <div class="col-md-12">
                        <div class="row">
                            @foreach($menu as $rowMenu)
                            <div class="col-md-6 mt-2">
                                <div>
                                    <input type="checkbox" name="chk_menus_{{ $rowMenu->id }}" id="chk_menus_{{ $rowMenu->id }}" class="chk_menu" value={{ $rowMenu->id }} />
                                    &nbsp; &nbsp;<label> {{ $rowMenu->nama }} </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="clearButton" class="btn btn-primary-outlined" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="saveButton" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@section("footer_endMenu_section")
<script>
    $(document).ready(function() {
        // Attach event listener for form submission

        $('#formMenuUsaha').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = $(this).serialize();
            const urlEdit = "{{ route('editAccessMenu') }}";

            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'POST'
                , data: formData
                , dataType: "json"
                , success: function(response) {
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
                        Swal.fire({
                            icon: "error"
                            , title: "Error"
                            , text: "Something Wrong"
                        })
                    }
                }
                , error: function(xhr, status, error) {
                    $('#response').text('An error occurred: ' + error);
                }
            });
        });
    })

</script>
@endsection
