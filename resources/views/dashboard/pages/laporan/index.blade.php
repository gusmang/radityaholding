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

@extends('dashboard.index')

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header mb-30">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Laporan Surat</h4>
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
                    {{-- <div class="col-md-6 col-sm-12 text-right">
                        <div style="padding:0; width: 100%; clear: both;">
                            <a href="#" onClick="" class="btn-block" data-toggle="modal" data-target="#bd-example-modal-lg" type="button">
                                <button class="btn btn-primary" style="float: right;">
                                    Export Data
                                </button>
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="mt-4" style="margin-top: 20px;">

                <div class="row">
                    <div class="col-xl-4 mb-30">
                        <div class="card-box height-100-p widget-style1">
                            <div style="padding: 15px;">
                                <div class="row">
                                    <div class="col-md-10 col-10">
                                        <div class="weight-500 font-18 mt-2">Total Pengadaan Selesai</div>
                                        <div class="mt-4">
                                            <div class="h4 mb-0">{{ $pengadaanJml }}</div>
                                            <div class="mt-2 font-14">
                                                Total Surat TerVerifikasi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-2">
                                        <div class="badge-icons">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div style="border-top: 1px solid #DDDDDD;"></div>
                            </div>
                            <div style="padding: 15px;">
                                <div class="row">
                                    <div class="col-md-10 col-10">
                                        <div class="weight-500 font-18 mt-2 primary-color">Lihat Detail</div>
                                    </div>
                                    <div class="col-md-2 col-2 text-right">
                                        <div class="weight-300 font-18 mt-2">
                                            <i class="fa fa-chevron-right primary-color"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 mb-30">
                        <div class="card-box height-100-p widget-style1">
                            <div style="padding: 15px;">
                                <div class="row">
                                    <div class="col-md-10 col-10">
                                        <div class="weight-500 font-18 mt-2">Total Pembayaran Selesai</div>
                                        <div class="mt-4">
                                            <div class="h4 mb-0">{{ $pembayaranJml }}</div>
                                            <div class="mt-2 font-14">
                                                Total Surat TerVerifikasi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-2">
                                        <div class="badge-icons">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div style="border-top: 1px solid #DDDDDD;"></div>
                            </div>
                            <div style="padding: 15px;">
                                <div class="row">
                                    <div class="col-md-10 col-10">
                                        <div class="weight-500 font-18 mt-2 primary-color">Lihat Detail</div>
                                    </div>
                                    <div class="col-md-2 col-2 text-right">
                                        <div class="weight-300 font-18 mt-2">
                                            <i class="fa fa-chevron-right primary-color"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 mb-30">
                        <div class="card-box height-100-p widget-style1">
                            <div style="padding: 15px;">
                                <div class="row">
                                    <div class="col-md-10 col-10">
                                        <div class="weight-500 font-18 mt-2">Total PettyCash Selesai</div>
                                        <div class="mt-4">
                                            <div class="h4 mb-0">{{ $suratJml }}</div>
                                            <div class="mt-2 font-14">
                                                Total Surat TerVerifikasi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-2">
                                        <div class="badge-icons">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div style="border-top: 1px solid #DDDDDD;"></div>
                            </div>
                            <div style="padding: 15px;">
                                <div class="row">
                                    <div class="col-md-10 col-10">
                                        <div class="weight-500 font-18 mt-2 primary-color">Lihat Detail</div>
                                    </div>
                                    <div class="col-md-2 col-2 text-right">
                                        <div class="weight-300 font-18 mt-2">
                                            <i class="fa fa-chevron-right primary-color"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <div class="weight-600 font-21">Tabel Laporan <span id="sp_tabs_title">Pengadaan</span></div>
                            </h4>
                            <p class="font-16 max-width-600"> Lihat dan export data surat yang sudah diajukan oleh unit usaha. </p>
                            <p></p>
                            <form method="get" id="frm-pencarian-laporan-new">
                                <input type="hidden" name="index" id="index" value="<?php echo $_GET['index']; ?>" />
                                <div class="col-md-12">
                                    <div class="row">
                                            <div class="col-md-6" style="padding: 0; margin: 0;">
                                                <select class="form-control" name="cmb-laporan-periode" id="cmb-laporan-periode">
                                                    <?php
                                                        $arr = array("0","1","2","3","4");
                                                        $valBulans = array("- Pilih Periode -","Sebulan Terakhir","3 Bulan Terakhir","6 Bulan Terakhir","Setahun Terakhir");

                                                        $ans = 0;
                                                        foreach($arr as $bln){
                                                            $selected = "";
                                                            if(isset($_GET['cmb-laporan-periode'] )){
                                                                if($_GET['cmb-laporan-periode'] == $bln){
                                                                    $selected = "selected";
                                                                }
                                                            }
                                                        ?>
                                                            <option value="<?php echo $bln; ?>" <?php echo $selected; ?>><?php echo $valBulans[$ans]; ?></option>
                                                        <?php
                                                        $ans++;
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary form-control text-center text-white" type="submit">
                                                    <i class="fa fa-search"></i>&nbsp; Cari Data 
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <div class="col-md-12 col-sm-12 text-right">
                                <div style="padding:0; width: 100%; clear: both;">
                                       <button class="btn btn-primary" style="float: right;" onclick="exportFile()">
                                            Export Data
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-40">
                    <div style="display: flex; flex-direction: row; margin-top: 10px; padding:0 10px;">
                        <div style="padding:0 20px 20px 20px; color: #666666; cursor: pointer;"
                            class="tab-list {{ $active_detail }} " id="tab-one-detail"
                            onclick="active_tab(this.id , 1)">
                            Pengadaan
                        </div>
                        <div style="padding:0 20px; color: #666666; cursor: pointer;"
                            class="tab-list {{ $active_pengadaan }} " id="tab-two-detail"
                            onclick="active_tab(this.id , 2);">
                            Pembayaran
                        </div>
                        <div style="padding:0 20px; color: #666666; cursor: pointer;"
                            class="tab-list" id="tab-three-detail"
                            onclick="active_tab(this.id , 3)">
                            Petty Cash
                        </div>
                        {{-- <div style="padding:0 20px; color: #666666; cursor: pointer;"
                            class="tab-list" id="tab-three-detail"
                            onclick="active_tab(this.id , 3)">
                            Urgent
                        </div> --}}
                    </div>
                    <div
                        style="border-bottom: 1px solid #DDDDDD; margin-top: 0;  padding:0 10px; margin-left: 10px; margin-right: 10px;">
                        <div style="display: flex; flex-direction: row;">
                            <div style="padding:0 10px; width: 170px;"></div>
                            <div style="padding:0 10px; width: 170px;"></div>
                            <div style="padding:0 10px; width: 152px;"></div>
                            {{-- <div style="padding:0 10px; width: 140px;"></div> --}}
                        </div>
                    </div>
                </div>
                <div style="clear: both; height: 30px;"></div>
                @include("dashboard.pages.laporan.components.pengadaan")
                @include("dashboard.pages.laporan.components.pettycash")
                @include("dashboard.pages.laporan.components.pembayaran")
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let index = "<?php echo $_GET['index']; ?>";
        let activePosi = 1

        if(index == "1"){
            $(".div_display_unit").hide();
            $("#div-lap-pengadaan").show();
            document.getElementById("sp_tabs_title").innerHTML = "Pengadaan";
        }
        else if(index == "2"){
            $(".div_display_unit").hide();
            $("#div-lap-pettycash").show();
            $("#sp_tabs_title").html("Pembayaran");
            document.getElementById("sp_tabs_title").innerHTML = "Pembayaran";
        }
        else if(index == "3"){
            $(".div_display_unit").hide();
            $("#div-lap-pembayaran").show();
            $("#sp_tabs_title").html("Petty Cash");
            document.getElementById("sp_tabs_title").innerHTML = "Petty Cash";
        }

        function exportFile(){
            window.open("<?php echo url('dashboard/export-files'); ?>"+'/'+activePosi+'/'+document.getElementById('cmb-laporan-periode').selectedIndex);
        }

        function active_tab(id, page) {
            $(".tab-list").removeClass("active-tab");
            $("#" + id).addClass("active-tab");
            
            $("#index").val(page);

            activePosi = page;

            if (page === 1) {
                $(".div_display_unit").hide();
                $("#div-lap-pengadaan").fadeIn("slow");
                document.getElementById("sp_tabs_title").innerHTML = "Pengadaan";
            } else if (page === 2) {
                $(".div_display_unit").hide();
                $("#div-lap-pettycash").fadeIn("slow");
                document.getElementById("sp_tabs_title").innerHTML = "Pembayaran";
            } else if (page === 3) {
                $(".div_display_unit").hide();
                $("#div-lap-pembayaran").fadeIn("slow");
                document.getElementById("sp_tabs_title").innerHTML = "Petty Cash";
            } 
        }
        </script>

</div>
@endsection
