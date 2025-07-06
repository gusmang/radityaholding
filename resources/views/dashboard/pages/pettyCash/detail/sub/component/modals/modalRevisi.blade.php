<div class="modal fade bs-revisi-modal-pettyCash" id="bs-revisi-modal-pettyCash" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" id="form-verifikasi-pettycash-rev" name="form-verifikasi-pettycash-add">
        <input type="hidden" id="teks_dokumen_pengadaan_rev" name="teks_dokumen_pengadaan_rev" />
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                    Revisi Berkas
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="mt-2 required-label" style="font-size: 14px;"> Perihal : </label>
                        <input type="text" class="form-control" name="rev_perihal_pettycash"
                            id="rev_perihal_pettycash" value="{{ $pengadaan->perihal }}" />
                    </div>
                    <div>
                        <label class="mt-4 required-label" style="font-size: 14px;"> Nominal : </label>
                        <input type="text" class="form-control rupiahInput" name="rev_nominal_pettycash"
                        id="rev_nominal_pettycash" placeholder="Nominal Pengajuan ..." required value="{{ 'Rp ' . number_format($pengadaan->nominal_pengajuan, 0, ',', '.') }}" />
                    </div>
                    <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0 0 30px 0;">
                        <div class="row">
                            <div class="col-md-12 font-500">
                                <label class="required-label"> Detail Isi Surat </label>
                            </div>
                            <div class="col-md-12" style="color: #444444;">
                                {{-- <div>
                                    <textarea class="form-control" rows="6" name="detailIsiSurat" id="detailIsiSurat" placeholder="Detail Isi Surat ..." required></textarea>
                                </div> --}}
                                <div id="detailIsiSurat">
                                    {{ strip_tags($pengadaan->detail) }}
                                </div>

                            </div>
                        </div>
                    </div>
                    <p style="height: 3px;"></p>
                    <div class="col-md-12" style="margin: 20px 0 0 0; padding: 0;">
                        <div class="col-md-12" style="margin: 20px 0 10px 0; padding: 0;">
                            File Pendukung :
                        </div>
                        <input type="file" name="file_upload_ver_rev" id="file_upload_ver_rev" class="form-control" />
                    </div>
                    <div class="col-md-12" style="display: none;">
                        <div>
                            <input type="hidden" id="teks_branch_approval_rev" name="teks_branch_approval_rev" />
                            <input type="hidden" id="teks_person_approval_new_rev" name="teks_person_approval_new_rev"
                                value="{{ Auth::user()->role_id }}" />
                            <input type="hidden" name="t_index_rev" id="t_index_rev" value="{{ $pengadaan->id }}" />

                            Apakah anda yakin ingin melakukan verifikasi berkas ini ? Verifikasi akan diteruskan ke
                            <b><span id="teruskan_person"></span></b>
                            <b>
                                <span id="span_pengadaan_diteruskan_rev"></span>
                            </b>
                        </div>
                        <div>
                            <label class="mt-4" style="font-size: 14px;"> Catatan : </label>
                            <textarea rows="4" class="form-control" name="verifikasi_berkas_rev"
                                id="verifikasi_berkas_rev"></textarea>
                        </div>
                        <div class="col-md-12" style="margin: 0; padding: 0;">
                            <div class="col-md-12" style="margin: 10px 0 10px 0; padding: 0;">
                                File Pendukung :
                            </div>
                            <input type="file" name="file_upload_ver_rev" id="file_upload_ver_rev" class="form-control" />
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