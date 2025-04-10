<div style="padding: 0 15px 20px 15px;">
    <form method="get">
        <div class="row">
            <div class="col-3">
                {{-- if (!empty($_GET['search_surat'])) {
                    $pengadaan = $pengadaan->where("no_surat", $_GET['search_surat']);
                }
                if (!empty($_GET['tanggal_surat'])) {
                    $pengadaan = $pengadaan->where("tanggal", $_GET['tanggal_surat']);
                }
                if (!empty($_GET['unit_usaha'])) {
                    $pengadaan = $pengadaan->where("id_unit_usaha", $_GET['unit_usaha']);
                }
                if ($_GET['status_surat'] == "0") {
                    $pengadaan = $pengadaan->where("next_verifikator", Auth::user()->role);
                } --}}
                <input type="hidden" name="index" value="{{ $_GET['index'] }}" class="form-control" />
                <input type="text" value="{{ isset($_GET['search_surat']) ? $_GET['search_surat'] : ""  }}" name="search_surat" id="search_surat" placeholder="Cari Surat ..." class="form-control" />
            </div>
            <div class="col-3">
                <select name="unit_usaha" id="unit_usaha" placeholder="Status Surat ..." class="form-control">
                    <option value="">- Pilih Unit Usaha -</option>
                        @foreach($unitUsaha as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-2">
                <select name="status_surat" id="status_surat" placeholder="Status Surat ..." class="form-control">
                    @if(isset($_GET['status_surat']))
                        @if($_GET['status_surat'] == '0')
                        <option value="0" selected>On Approve</option>
                        <option value="1">Semua</option>
                        @else
                        <option value="1" selected>Semua</option>
                        <option value="0">On Approve</option>
                        @endif
                    @else
                    <option value="0" selected>On Approve</option>
                    <option value="1">Semua</option>
                    @endif
                </select>
            </div>
            <div class="col-2">
                <input type="date" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Pengajuan ..." class="form-control" />
            </div>
            <div class="col-2">
                <button class="btn btn-primary" value="submit" type="submit" name="btn-submit-new" id="btn-submit-new">
                    <i class="fa fa-search"></i>&nbsp; Cari
                </button>
            </div>
        </div>
    </form>
</div>