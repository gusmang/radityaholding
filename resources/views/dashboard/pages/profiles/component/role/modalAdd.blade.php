<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" id="form-settings-add" name="form-settings-add">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tambah Role
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
                                    <input type="hidden" class="form-control" name="t_index" id="t_index" placeholder="Input Index ..." required />
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Input Role ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="required-label"> Note </label>
                                <div>
                                    <textarea rows="2" class="form-control" name="note" id="note" required></textarea>
                                </div>
                            </div>


                            <div class="col-md-12 mt-4" style="padding: 10px; margin-top: 20px;">

                                <div class="col-md-12">
                                    <div class="row">
                                        @foreach($menu as $rowMenu)
                                        <div class="col-md-6 mt-2">
                                            <div>
                                                <input type="checkbox" name="chk_menu_{{ $rowMenu->id }}" id="chk_menu_{{ $rowMenu->id }}" class="chk_menu" value={{ $rowMenu->id }} />
                                                &nbsp; &nbsp;<label> {{ $rowMenu->nama }} </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-12 mt-4">

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="1" name="chk_aktif_add" id="chk_aktif_add" style="margin-right: 10px;" />
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
