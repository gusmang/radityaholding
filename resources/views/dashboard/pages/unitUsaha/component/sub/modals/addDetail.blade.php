<div class="modal fade bs-example-modal-lg" id="bd-addUnit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" onsubmit="submitEditUsaha();" id="formEditUsaha">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tambah Unit Usaha
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
                                    <input type="hidden" class="form-control" name="t_index" id="t_index" placeholder="Input Index ..." required />
                                    <input type="text" class="form-control" name="unitUsaha" id="unitUsaha" placeholder="Input Nama ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Limit Petty Cash </label>
                                <div>
                                    <input type="text" class="form-control rupiahInput" name="limit_petty_cash" id="limit_petty_cash" placeholder="Input Amount ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Unit Bisnis </label>
                                <select class="form-control" name="id_unit_bisnis" id="id_unit_bisnis" required>
                                    <option value="">- Pilih Unit Bisnis -</option>
                                    @php
                                    $bisnis = app('App\Helpers\Status')->getUnitType();

                                    $an = 0;
                                    @endphp

                                    <?php
                                    foreach($bisnis as $rows){
                                        $an++;
                                        ?>
                                            <option value="<?php echo $an; ?>"><?php echo $rows; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-12 mt-4">

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" name="chk_aktif" id="chk_aktif">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"> Aktif </label>
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
    $(document).ready(function() {
        // Attach event listener for form submission
        $('#formEditUsaha').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = $(this).serialize();
            const urlEdit = "{{ route('addUsaha') }}";

            // Send AJAX request
            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'POST'
                , data: formData
                , dataType: "json"
                , success: function(response) {
                    // Display server response
                    if (response.status === 200) {
                        window.location = "{{ route('unit-usaha') }}";
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
