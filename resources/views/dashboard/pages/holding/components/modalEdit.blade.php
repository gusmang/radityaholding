<div class="modal fade bs-example-modal-lg" id="bd-example-edit-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="put" id="editHoldingForm" name="editHoldingForm">
        {{-- @csrf --}}
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Edit Pengguna
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
                                    <input type="hidden" class="form-control" name="t_index_edit" id="t_index_edit"
                                        placeholder="Input Index ..." required />
                                    <input type="text" class="form-control" name="name_edit" id="name_edit"
                                        placeholder="Input Nama ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Email </label>
                                <div>
                                    <input type="email" class="form-control" name="email_edit" id="email_edit"
                                        placeholder="Input Email ..." required />


                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Peran </label>
                                <div>
                                    <select class="form-control" name="role_edit" id="role_edit" required>
                                        <option value="">- Pilih Peran -</option>
                                        @foreach($jabatan as $rows)
                                        <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="1"
                                        name="chk_aktif_edit" id="chk_aktif_edit">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">&nbsp;Aktif </label>
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

@section("footer_modals")
<script type="text/javascript">

</script>
@endsection