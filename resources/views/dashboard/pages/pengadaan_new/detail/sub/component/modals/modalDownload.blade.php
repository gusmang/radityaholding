<div class="modal fade bs-download-modal" id="bs-download-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    {{-- <form method="post" id="form-verifikasi-pengadaan-add" name="form-verifikasi-pengadaan-add"> --}}
    <input type="hidden" id="teks_dokumen_persetujuan" name="teks_dokumen_persetujuan" />
    @csrf
    <div class="modal-dialog modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Download Berkas
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div>
                        <input type="hidden" id="url_download_page" name="url_download_page" />

                        <div> Pilih Nomor tanda tangan menyetujui (page-break): </div>
                        <div class="mt-2">
                            <input type="number" name="pagebreak" id="pagebreak" value="0" style="padding: 5px; width: 80px;" />
                            <br />
                            <small style="font-size: 10px;"> <i> pilih 0 jika tidak ada page-break </i> </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-outlined" data-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="downloadFile()">
                    Download
                </button>
            </div>
        </div>
    </div>
    {{-- </form> --}}
</div>
