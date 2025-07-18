<div class="modal fade bs-example-modal-lg" id="bd-detail-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" onsubmit="submitEditUsaha();" id="formEditUsaha">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Edit Unit Usaha
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
                                    <input type="hidden" class="form-control" value="{{ $unitUsaha->id }}"
                                        name="t_index" id="t_index" placeholder="Input Index ..." required />
                                    <input type="text" class="form-control" name="unitUsaha" id="unitUsaha"
                                        value="{{ $unitUsaha->name }}" placeholder="Input Nama ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Limit Petty Cash </label>
                                <div>
                                    <input type="number" class="form-control" name="limit_petty_cash"
                                        id="limit_petty_cash" value="{{ $unitUsaha->limit_petty_cash }}"
                                        placeholder="Input Amount ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Kategori Unit Bisnis </label>
                                <select class="form-control" name="id_unit_bisnis" id="id_unit_bisnis" required
                                    value={{ $unitUsaha->id_unit_bisnis }}>
                                    <?php
                                    $unitBisnis = $unitUsaha->id_unit_bisnis;

                                    for($an = 1; $an <= 3; $an++){
                                    $selected = $an === $unitBisnis ? "selected" : "";
                                    ?>
                                        <option value="<?php echo $an; ?>" <?php echo $selected; ?>>Unit Bisnis <?php echo $an; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-12 mt-4">

                                <div class="form-check form-switch">
                                    @php
                                        $active = $unitUsaha->status === 1 ? "checked" : "";
                                    @endphp
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" value="1" name="chk_aktif" id="chk_aktif"
                                        {{ $active }} 
                                    />
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

@section("footer_modals_unit")
<script type="text/javascript">
$(document).ready(function() {
    // Attach event listener for form submission
    $('#formEditUsaha').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Serialize form data
        const formData = $(this).serialize();
        const urlEdit = "{{ route('editUsaha') }}";

        // Send AJAX request
        $.ajax({
            url: urlEdit, // URL to handle the form data
            type: 'PUT',
            data: formData,
            dataType: "json",
            success: function(response) {
                // Display server response
                if (response.status === 200) {
                    window.location = "{{route('detailUsaha',['index'=> $unitUsaha->id])}}";
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