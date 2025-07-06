<div style="padding: 0 15px 20px 15px;">
    <form method="get">
        <div class="row">
            <div class="col-3">
                <input type="hidden" name="index" value="{{ $_GET['index'] }}" class="form-control" />
                <input type="text" name="search_surat" id="search_surat" placeholder="Cari Surat ..." class="form-control" />
            </div>
            <div class="col-3">
                <select name="status_surat" id="status_surat" placeholder="Status Surat ..." class="form-control">
                    <option value="">- Pilih Status Surat -</option>
                </select>
            </div>
            <div class="col-3">
                <input type="date" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Pengajuan ..." class="form-control" />
            </div>
            <div class="col-3">
                <button class="btn btn-primary" value="submit" onClick="fetchDataPermohonan(1 , true);" type="button" name="btn-submit-new" id="btn-submit-new">
                    <i class="fa fa-search"></i>&nbsp; Cari
                </button>
            </div>
        </div>
    </form>
</div>