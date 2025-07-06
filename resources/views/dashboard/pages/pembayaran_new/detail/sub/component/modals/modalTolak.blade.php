<div class="modal fade bs-tolak-modal" id="bs-tolak-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" id="form-tolak-pengadaan-add" name="form-tolak-pengadaan-add">
        <input type="hidden" id="teks_dokumen_pengadaan" name="teks_dokumen_pengadaan" />
        <input type="hidden" id="teks_dokumen_pengadaan_tolak" value="{{ $pengadaan->id }}" name="teks_dokumen_pengadaan_tolak" />
 
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tolak Berkas ?
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div>
                            <input type="hidden" id="teks_branch_approval_tolak" name="teks_branch_approval_tolak" />
                            <input type="hidden" id="teks_person_approval_tolak" name="teks_person_approval_tolak" />
                            <input type="hidden" name="t_login_tolak" id="t_login_tolak" value="{{ Auth::user()->id }}" />

                            Apakah anda yakin ingin tolak berkas ini ? <b><span id="teruskan_person"></span></b>
                            <b>
                                <span id="span_pengadaan_diteruskan"></span>
                            </b>
                        </div>
                        <div>
                            <label class="mt-4" style="font-size: 14px;"> Catatan : </label>
                            <textarea rows="4" class="form-control" name="verifikasi_berkas_tolak" id="verifikasi_berkas_tolak"></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12" style="margin: 10px 0 10px 0; padding: 0;">
                                File Pendukung :
                            </div>
                            <input type="file" name="file_upload_tolak" id="file_upload_tolak" class="form-control" />
                        </div>
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
