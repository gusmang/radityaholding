<div class="modal fade bs-example-modal-lg" id="bd-edituser-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" action="{{ route('users-edit') }}">
        @csrf
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

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Unit Usaha </label>
                                <div style="margin-top: -5px;">
                                    {{-- <select class="form-control" name="role" id="role" required>
                                        <option value="">- Pilih Unit Usaha -</option>
                                        @foreach($jabatan as $rows)
                                        <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                    @endforeach
                                    </select> --}}
                                    <b style="font-size: 18px;"> {{ $unitUsaha->name }} </b>
                                    <input type="hidden" name="t_unit_usaha_edit" id="t_unit_usaha_edit" value="{{ $unitUsaha->id }}" />
                                    <input type="hidden" name="index_edit" id="index_edit" value="{{ Request::segment(3) }}" />
                                </div>
                            </div>


                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Nama </label>
                                <div>
                                    <input type="hidden" class="form-control" name="t_index_edit" id="t_index_edit" placeholder="Input Index ..." required />
                                    <input type="text" class="form-control" name="name_edit" id="name_edit" placeholder="Input Nama ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Email </label>
                                <div>
                                    <input type="email" class="form-control" name="email_edit" id="email_edit" placeholder="Input Email ..." required />
                                </div>
                            </div>

                            {{-- <div class="col-md-12 mt-4">
                                <label class="required-label"> Unit Bisnis </label>
                                <div>
                                    <select class="form-control" name="id_unit_bisnis" id="id_unit_bisnis" required value={{ $row->id_unit_bisnis }}>
                            <option value="">- Pilih Unit Bisnis -</option>
                            <option value="1">- Unit Bisnis 1 -</option>
                            <option value="2">- Unit Bisnis 2 -</option>
                            <option value="3">- Unit Bisnis 3 -</option>
                            </select>
                        </div>
                    </div> --}}



                    {{-- <div class="col-md-12 mt-4">
                                <label class="required-label"> Unit Usaha </label>
                                <div>
                                    <select class="form-control" name="role_edit" id="role_edit" required>
                                        <option value="">- Pilih Unit Usaha -</option>
                                        @foreach($jabatan as $rows)
                                        <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div> --}}

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
