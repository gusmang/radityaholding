<div class="modal fade bs-verifikasi-modal-pengadaan" id="bs-verifikasi-modal-pengadaan" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" id="form-verifikasi-pengadaan-add-new" name="form-verifikasi-pengadaan-add-new">
        <input type="hidden" id="teks_dokumen_pengadaan" name="teks_dokumen_pengadaan" />
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Verifikasi Berkas ?
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div>
                            <input type="hidden" id="teks_branch_approval" name="teks_branch_approval" />
                            <input type="hidden" id="teks_person_approval_new_sc" name="teks_person_approval_new"
                                value="{{ Auth::user()->role_id }}" />
                            <input type="hidden" name="t_index" id="t_index_sc" value="{{ $pengadaan->id }}" />

                            Apakah anda yakin ingin melakukan verifikasi berkas ini ? Verifikasi akan diteruskan ke
                            <b><span id="teruskan_person"></span></b>
                            <b>
                                <span id="span_pengadaan_diteruskan"></span>
                            </b>
                        </div>
                        <div>
                            <label class="mt-4" style="font-size: 14px;"> Catatan : </label>
                            <textarea rows="4" class="form-control" name="verifikasi_berkas"
                                id="verifikasi_berkas"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-12" style="margin: 10px 0 10px 0; padding: 0;">
                            File Pendukung :
                        </div>
                        <input type="file" name="file_upload_ver" id="file_upload_ver" class="form-control" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outlined" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Verifikasi
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>