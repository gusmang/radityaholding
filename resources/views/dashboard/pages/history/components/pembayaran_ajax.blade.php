<div id="suratPembayaranContainer" class="div_display_unit" style="display: none;">
    @include("dashboard.pages.surat.components.global.search")
    <table class="table stripe hover nowrap">
        <thead style="background: #F5F5F5; height: 60px;">
            <tr>
                <th> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></th>
                <th class="table-plus datatable-nosort">No. Surat</th>
                <th>Perihal</th>
                <th>Nominal Pengajuan</th>
                <th>Status Surat</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody id="tb-surat-pembayaran">
           
        </tbody>
    </table>

    <div
        style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end;">
        <div> @php echo $pembayaran->links('pagination::ajax-pagination-pmb'); @endphp </div>
    </div>

</div>