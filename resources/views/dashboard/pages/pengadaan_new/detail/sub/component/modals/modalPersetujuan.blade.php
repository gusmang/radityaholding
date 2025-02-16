<div class="modal fade bs-persetujuan-modal" id="bs-persetujuan-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    {{-- <form method="post" id="form-verifikasi-pengadaan-add" name="form-verifikasi-pengadaan-add"> --}}
    <input type="hidden" id="teks_dokumen_persetujuan" name="teks_dokumen_persetujuan" />
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
                        <input type="hidden" id="teks_person_approval" name="teks_person_approval" />
                        <input type="hidden" name="t_login" id="t_login" value="{{ Auth::user()->id }}" />

                        Apakah anda yakin ingin melakukan verifikasi berkas ini ? Verifikasi akan dilanjutkan ke tahap pembuatan surat persetujuan ?
                        <b>
                            <span id="span_pengadaan_diteruskan"></span>
                        </b>
                    </div>
                    {{-- <div>
                            <label class="mt-4" style="font-size: 14px;"> Catatan : </label>
                            <textarea rows="4" class="form-control" name="verifikasi_berkas" id="verifikasi_berkas"></textarea>
                        </div> --}}
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
    {{-- </form> --}}
</div>
