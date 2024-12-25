<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" action="{{ url('users/save') }}">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tambah Pengguna
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
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Input Nama ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Email </label>
                                <div>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Input Email ..." required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Unit Usaha </label>
                                <div>
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="">- Pilih Unit Usaha -</option>
                                        @foreach($jabatan as $rows)
                                        <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Peran </label>
                                <div>
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="">- Pilih Peran -</option>
                                        @foreach($jabatan as $rows)
                                        <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Password </label>
                                <div>
                                    <input type="password" class="form-control" name="password" id="password" required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Ulangi Password </label>
                                <div>
                                    <input type="ulangi_password" class="form-control" name="form_password" id="form_password" required />
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
