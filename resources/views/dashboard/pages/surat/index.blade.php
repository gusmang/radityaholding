@extends('dashboard.index')

@php
$active_detail = (!isset($_GET['index']) || $_GET['index'] === '1') ? "active-tab" : "";
$active_pengadaan = (isset($_GET['index']) && $_GET['index'] === '2') ? "active-tab" : "";
$active_pembayaran = (isset($_GET['index']) && $_GET['index'] === '3') ? "active-tab" : "";

$display_detail = (isset($_GET['index']) && $_GET['index'] !== '') ? 'display: none;' : '';
$display_pengadaan = (!isset($_GET['index'])) ? "display: none;" : "";
$display_pembayaran = (!isset($_GET['index'])) ? "display: none;" : "";

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
}
@endphp

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header mb-30">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Semua Surat</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    List
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div style="padding:0; width: 100%; clear: both;">
                            <a href="#" onClick="" class="btn-block" data-toggle="modal"
                                data-target="#bd-example-modal-lg" type="button">
                                <button class="btn btn-primary" style="float: right;">
                                    Export Data
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple Datatable start -->
            @include("dashboard.pages.users.components.modalUser")

            <div class="card-box mb-30">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-10">
                            {{-- <h4 class="text-blue h4">Tabel List User</h4> --}}
                            <h4 class="font-20 weight-500 mb-10 text-capitalize">
                                <div class="weight-600 font-21">Semua Surat</div>
                            </h4>
                            <p class="font-16 max-width-600"> Lihat progress surat yang diajukan melalui tabel dibawah.
                            </p>
                        </div>
                        <div class="col-2">
                            <div class="dropdown" style="float: right;">
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-calendar-date"></i> &nbsp;Date Filter
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-search"></i> &nbsp;Search
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-filetype-xls"></i> &nbsp;Export List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-20" style="overflow: auto;">
                    <div class="mt-40">
                        <div style="display: flex; flex-direction: row; margin-top: 10px; padding:0 10px;">
                            <div style="padding:0 20px 20px 20px; color: #666666; cursor: pointer;"
                                class="tab-list {{ $active_detail }} " id="tab-one-detail"
                                onclick="active_tab(this.id , 1)">
                                Permohonan
                            </div>
                            <div style="padding:0 20px; color: #666666; cursor: pointer;"
                                class="tab-list {{ $active_pengadaan }} " id="tab-two-detail"
                                onclick="active_tab(this.id , 2)">
                                Pembayaran
                            </div>
                            <div style="padding:0 20px; color: #666666; cursor: pointer;"
                                class="tab-list {{ $active_pembayaran }} " id="tab-three-detail"
                                onclick="active_tab(this.id , 3)">
                                Petty Cash
                            </div>
                            <div style="padding:0 20px; color: #666666; cursor: pointer;"
                                class="tab-list {{ $active_pembayaran }} " id="tab-three-detail"
                                onclick="active_tab(this.id , 3)">
                                Urgent
                            </div>
                        </div>
                        <div
                            style="border-bottom: 1px solid #DDDDDD; margin-top: 0;  padding:0 10px; margin-left: 10px; margin-right: 10px;">
                            <div style="display: flex; flex-direction: row;">
                                <div style="padding:0 10px; width: 170px;"></div>
                                <div style="padding:0 10px; width: 170px;"></div>
                                <div style="padding:0 10px; width: 152px;"></div>
                                <div style="padding:0 10px; width: 140px;"></div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both; height: 30px;"></div>
                    @include("dashboard.pages.surat.components.permohonan")
                    @include("dashboard.pages.surat.components.pembayaran")
                    @include("dashboard.pages.surat.components.pettyCash")
                    @include("dashboard.pages.surat.components.urgent")
                </div>

                <div
                    style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end;">
                    <div> @php echo $pengadaan->links('pagination::bootstrap-4'); @endphp </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function active_tab(id, page) {
    $(".tab-list").removeClass("active-tab");
    $("#" + id).addClass("active-tab");

    if (page === 1) {
        $(".div_display_unit").hide();
        $("#suratPermohonanContainer").fadeIn("slow");
    } else if (page === 2) {
        $(".div_display_unit").hide();
        $("#suratPembayaranContainer").fadeIn("slow");
    } else if (page === 3) {
        $(".div_display_unit").hide();
        $("#suratPettyCashContainer").fadeIn("slow");
    } else if (page === 4) {
        $(".div_display_unit").hide();
        $("#suratUrgentContainer").fadeIn("slow");
    }
}
</script>

@endsection