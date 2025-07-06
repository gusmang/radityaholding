@extends('dashboard.index')

@php
$active_detail = (!isset($_GET['index']) || $_GET['index'] === '1') ? "active-tab" : "";
$active_pengadaan = (isset($_GET['index']) && $_GET['index'] === '2') ? "active-tab" : "";
$active_pembayaran = (isset($_GET['index']) && $_GET['index'] === '3') ? "active-tab" : "";
$active_urgent = (isset($_GET['index']) && $_GET['index'] === '4') ? "active-tab" : "";

$display_detail = (isset($_GET['index']) && $_GET['index'] !== '') ? 'display: none;' : '';
$display_pengadaan = (!isset($_GET['index'])) ? "display: none;" : "";
$display_pembayaran = (!isset($_GET['index'])) ? "display: none;" : "";
$display_urgent = (!isset($_GET['index'])) ? "display: none;" : "";

if(isset($_GET['tab'])){
    if($_GET['tab'] !== '1'){
        $display_pengadaan = 'display: none;';
    }
    if($_GET['tab'] !== '2'){
        $display_pembayaran = 'display: none;';
    }
    if($_GET['tab'] !== '3'){
        $display_pengguna = 'display: none;';
    }
    if($_GET['tab'] !== '4'){
        $display_urgent = 'display: none;';
    }
}
@endphp

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header mb-30">
                <div class="row">
                    <div class="col-md-9 col-12 mt-2">
                        <div class="title">
                            <h4>Permohonan Petty Cash</h4>
                            <small>Atur dan lihat daftar petty cash pada tabel di bawah</small>
                        </div>
                        {{-- <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    List
                                </li>
                            </ol>
                        </nav> --}}
                    </div>
                    <?php
                        if(isset($roles->urutan)){
                            if($roles->urutan === 1){
                            ?>
                                <div class="col-md-3 col-sm-12 mt-2 text-right">
                                    <div style="padding:0; width: 100%; clear: both;">
                                        <a href="{{ route('addPettyCash') }}" class="btn-block" type="button">
                                            <button class="btn btn-primary form-control" style="float: right;">
                                                <i class="fa fa-plus"></i>&nbsp; Tambah Permohonan Baru
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="card-box mb-10">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-12">
                            <form method="get">
                                <div>
                                    <div class="row">
                                        <div class="col-12 col-md-3 mt-2">
                                            <div><label> Cari Surat : </label></div>
                                            <input type="text" name="search_surat" placeholder="Cari Surat ..."
                                                class="form-control" />
                                        </div>
                                        <div class="col-12 col-md-3 mt-2">
                                            <div><label> Status : </label></div>
                                            <select name="status_surat" placeholder="Status Surat ..."
                                                    class="form-control" onchange="document.getElementById('btn-submit-new').click();">
                                                    <option value="">- Pilih Status Surat -</option>
                                                    <?php
                                                        $urgent_sts = "";
                                                        $onAppr_sts = "";
                                                        $pending_sts = "";
                                                        $finished_sts = "";
                                                        $rejected_sts = "";

                                                        if(isset($_GET['status_surat'])){
                                                            if($_GET['status_surat'] == "1"){
                                                                $urgent_sts = "selected";
                                                            }
                                                            else if($_GET['status_surat'] == "2"){
                                                                $onAppr_sts = "selected";
                                                            }
                                                            else if($_GET['status_surat'] == "3"){
                                                                $pending_sts = "selected";
                                                            }
                                                            else if($_GET['status_surat'] == "4"){
                                                                $finished_sts = "selected";
                                                            }
                                                            else if($_GET['status_surat'] == "5"){
                                                                $rejected_sts = "selected";
                                                            }
                                                        }
                                                    ?>
                                                    <option value="1" <?php echo $urgent_sts; ?>>Urgent</option>
                                                    <option value="2" <?php echo $onAppr_sts; ?>>On Approve</option>
                                                    <option value="3" <?php echo $pending_sts; ?>>Pending</option>
                                                    <option value="4" <?php echo $finished_sts; ?>>Finished</option>
                                                    <option value="5" <?php echo $rejected_sts; ?>>Rejected</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 mt-2">
                                            <div><label> Tanggal Pengajuan : </label></div>
                                            <input type="text" class="dateRange"  id="dateRange" name="tanggal_surat" placeholder="Tanggal Pengajuan ..."
                                                class="form-control" style="padding: 10px; width: 90%; border-radius: 5px; border:1px solid #DDDDDD;" />
                                        </div>
                                        <div class="col-12 col-md-2 mt-2">
                                            <div style="visibility: hidden;"><label> Cari di sini : </label></div>
                                            <Button class="btn btn-primary form-control" name="btn-submit-new" id="btn-submit-new" type="submit"
                                                value="submit">
                                                <i class="fa fa-search"></i>&nbsp; Cari
                                            </Button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="pb-20" style="overflow: auto; margin-top: 30px;">
                <div class="mt-40">
                    <div style="display: flex; flex-direction: row; margin-top: 10px; padding:0 10px;">
                        <div style="padding:0 20px 20px 20px; color: #666666; cursor: pointer;"
                            class="tab-list {{ $active_detail }} " id="tab-one-detail"
                            onclick="active_tab(this.id , 1)">
                            On Progress
                        </div>
                        <div style="padding:0 20px; color: #666666; cursor: pointer;"
                            class="tab-list {{ $active_pengadaan }} " id="tab-two-detail"
                            onclick="active_tab(this.id , 3);">
                            Approved
                        </div>
                        <div style="padding:0 20px; color: #666666; cursor: pointer;"
                            class="tab-list {{ $active_pembayaran }} " id="tab-three-detail"
                            onclick="active_tab(this.id , 2)">
                            Rejected
                        </div>
                        <div style="padding:0 20px; color: #666666; cursor: pointer;"
                            class="tab-list {{ $active_urgent }}" id="tab-four-detail"
                            onclick="active_tab(this.id , 4);">
                            Urgent
                        </div>
                    </div>
                    <div
                        style="border-bottom: 1px solid #DDDDDD; margin-top: 0;  padding:0 10px; margin-left: 10px; margin-right: 10px;">
                        <div style="display: flex; flex-direction: row;">
                            <div style="padding:0 10px; width: 170px;"></div>
                            <div style="padding:0 10px; width: 170px;"></div>
                            <div style="padding:0 10px; width: 152px;"></div>
                            <div style="padding:0 10px; width: 152px;"></div>
                        </div>
                    </div>
                </div>
            </div> --}}

            @include("dashboard.pages.pettyCash.list.progress")
            {{-- @include("dashboard.pages.pettyCash.list.pending")
            @include("dashboard.pages.pettyCash.list.approve") --}}

            <div>
                <div style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end; margin-bottom: 20px;">
                    <div> @php echo $pengadaan->links('pagination::bootstrap-4'); @endphp </div>
                </div>
            </div>

            <!-- Simple Datatable start -->
            @include("dashboard.pages.users.components.modalUser")


        </div>
    </div>
</div>

<script type="text/javascript">
    function active_tab(id, page) {
        $(".tab-list").removeClass("active-tab");
        $("#" + id).addClass("active-tab");

        if (page === 1) {
            $(".div_display_unit").hide();
            $("#div_tab_detail").fadeIn("slow");
        } else if (page === 2) {
            $(".div_display_unit").hide();
            $("#div_tab_pengadaan").fadeIn("slow");
        } else if (page === 3) {
            $(".div_display_unit").hide();
            $("#div_tab_pembayaran").fadeIn("slow");
        } else if (page === 4) {
            
            $(".div_display_unit").hide();
            $("#div_tab_urgent").fadeIn("slow");
        }
    }
</script>
@endsection

@section("footer_pengadaan_tab")
<script type="text/javascript">
    let searched = "<?php echo isset($_GET['btn-submit-new']) ? 1 : 0; ?>";
    let val_tanggal = "<?php echo isset($_GET['tanggal_surat']) ? $_GET['tanggal_surat'] : ''; ?>"

    let ex_tanggal = val_tanggal.split(" - ");

    $('.dateRange').daterangepicker({
        opens: 'right', // or 'left', 'center'
        startDate: searched =="1" ? ex_tanggal[0] : moment().subtract(29, 'days'),
        endDate: searched =="1" ? ex_tanggal[1] : moment(),
        minDate: '01/01/2015',
        maxDate: '12/31/2025',
        locale: {
            format: 'YYYY/MM/DD',
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, function(start, end, label) {
        // Callback function when dates are selected
        $('#selectedRange').html('You selected: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
</script>
@endsection