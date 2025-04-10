<div class="modal fade bs-example-modal-lg" id="bd-editSignature-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="put" id="form-settings-edit" name="form-settings-edit">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Edit Role
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-12 mt-2">
                                <label class="required-label"> Role / Peran </label>
                                <div>
                                    <input type="hidden" class="form-control" name="t_index_edit" id="t_index_edit" placeholder="Input Index ..." required />
                                    <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="Input Role ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Unit Bisnis </label>
                                <div>
                                    <select name="is_unit_usaha" id="is_unit_usaha" class="form-control">
                                        <option value="0"> Unit Usaha</option>
                                        <option value="1"> Holding </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Note </label>
                                <div>
                                    <textarea rows="2" class="form-control" name="edit_note" id="edit_note"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="1" name="chk_aktif_edit" id="chk_aktif_edit">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"> Aktif </label>
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
