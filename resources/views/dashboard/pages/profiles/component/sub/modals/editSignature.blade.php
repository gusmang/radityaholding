<div class="modal fade bs-example-modal-lg" id="bd-addSignature-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" onsubmit="submitEditUsaha();" id="formEditUsaha">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Edit Signature
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="required-label"> Draw New Signature </label>
                                <div>
                                    <input type="hidden" class="form-control" name="sig_t_index" id="sig_t_index" value="{{ $profiles->id }}" placeholder="Input Index ..." required />
                                    <canvas id="signaturePad" height="300" style="border: 1px solid #999999; width: 100%;"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="clearButton" class="btn btn-primary-outlined">
                        Clear
                    </button>
                    <button type="button" id="saveButton" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        const canvas = document.getElementById('signaturePad');
        const ctx = canvas.getContext('2d');
        const clearButton = document.getElementById('clearButton');
        const saveButton = document.getElementById('saveButton');
        let drawing = false;

        // Set up canvas for drawing
        canvas.addEventListener('mousedown', (e) => {
            drawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        });

        canvas.addEventListener('mousemove', (e) => {
            if (drawing) {
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.stroke();
            }
        });

        canvas.addEventListener('mouseup', () => {
            drawing = false;
        });

        canvas.addEventListener('mouseout', () => {
            drawing = false;
        });

        // Clear the canvas
        clearButton.addEventListener('click', () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        // Save the canvas content as PNG
        saveButton.addEventListener('click', () => {
            const dataURL = canvas.toDataURL('image/png');
            const urlSave = "{{ route('saveSignatureProfile') }}";

            let formData = {
                sig_t_index: $("#sig_t_index").val()
                , sig_unit_usaha_edit: $("#sig_unit_usaha_edit").val()
                , image: dataURL
                , _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "POST"
                , data: formData
                , url: urlSave
                , dataType: "json"
                , success: function(data) {
                    Swal.fire({
                        icon: "success"
                        , title: "Success"
                        , text: data.message
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location = data.redirectUrl;
                        } else if (result.isDenied) {
                            Swal.fire("Changes are not saved", "", "info");
                        }
                    });
                }
            })

        });

    </script>
</div>
