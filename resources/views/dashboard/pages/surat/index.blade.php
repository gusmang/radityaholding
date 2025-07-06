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
                                onclick="active_tab(this.id , 2);">
                                Pembayaran
                            </div>
                            <div style="padding:0 20px; color: #666666; cursor: pointer;"
                                class="tab-list {{ $active_pembayaran }} " id="tab-three-detail"
                                onclick="active_tab(this.id , 3)">
                                Petty Cash
                            </div>
                        </div>
                        <div
                            style="border-bottom: 1px solid #DDDDDD; margin-top: 0;  padding:0 10px; margin-left: 10px; margin-right: 10px;">
                            <div style="display: flex; flex-direction: row;">
                                <div style="padding:0 10px; width: 170px;"></div>
                                <div style="padding:0 10px; width: 170px;"></div>
                                <div style="padding:0 10px; width: 152px;"></div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both; height: 30px;"></div>
                    @include("dashboard.pages.surat.components.permohonan")
                    @include("dashboard.pages.surat.components.pembayaran")
                    @include("dashboard.pages.surat.components.pettyCash")
                </div>

                <div
                    style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end;">
                    {{-- <div> @php echo $pengadaan->links('pagination::bootstrap-4'); @endphp </div> --}}
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

@section("footers_suratList")
    <script type="text/javascript">

    let activeTabs = "{{ $_GET['index'] }}";

    if(activeTabs == "1"){
        $(".div_display_unit").hide();
        $("#suratPermohonanContainer").show();
    }
    else if(activeTabs == "2"){
        $(".div_display_unit").hide();
        $("#suratPembayaranContainer").show();
    }
    else if(activeTabs == "3"){
        $(".div_display_unit").hide();
        $("#suratPettyCashContainer").show();
    }

    function getDataLaporan(){
            let urlPost = "{{ route('get-pencarian-laporan') }}";

            $.ajax({
                type: "GET",
                data: "val="+$("#cmb-laporan-periode").val(),
                url: urlPost,
                dataType: "json",
                success:function(data){
                    //console.log("consoled" , data);
                }
            })
        }

        getDataLaporan();
        
        function fetchDataPermohonan(index , submit){
            let urlNew = "{{ route('getDataAll') }}"
            let searchUrl = "";
            if(submit === true){
                searchUrl = "&search_surat="+$("#search_surat").val()+
                "&status_surat="+$("#status_surat").val()+
                "&tanggal_surat="+$("#tanggal_surat").val()
                +"&btn-submit-new=submit"
            }
            $.ajax({
                type: "GET",
                url: urlNew+ "?page="+index+searchUrl,
                data: "",
                dataType: "json",
                success:function(response){
                    $("#paginglink1").addClass("active");
                    $("#tb-surat-permohonan").html(response?.data);
                }
            })
        }

        function fetchPaginator(url){
            let urlNew = "{{ route('getDataAll') }}";

            const urlx = new URL(url);
            const page = urlx.searchParams.get('page');

            $(".page-item").removeClass("active");

            $.ajax({
                type: "GET",
                url: urlNew+ "?page="+page,
                data: "",
                dataType: "json",
                success:function(response){
                    $("#paginglink"+page).addClass("active");
                    $("#tb-surat-permohonan").html(response?.data);
                }
            })
        }

        function fetchDataPembayaran(index){
            let urlNew = "{{ route('getDataAllPmb') }}"
            $.ajax({
                type: "GET",
                url: urlNew+ "?page="+index,
                data: "",
                dataType: "json",
                success:function(response){
                    $("#paginglinkpmb1").addClass("active");
                    $("#tb-surat-pembayaran").html(response?.data);
                }
            })
        }

        function fetchPaginatorPmb(url){
            let urlNew = "{{ route('getDataAllPmb') }}";

            const urlx = new URL(url);
            const page = urlx.searchParams.get('page');

            $(".page-item").removeClass("active");

            $.ajax({
                type: "GET",
                url: urlNew+ "?page="+page,
                data: "",
                dataType: "json",
                success:function(response){
                    $("#paginglinkpmb"+page).addClass("active");
                    $("#tb-surat-permohonan").html(response?.data);
                }
            })
        }

        $(document).ready(function(){
          //  fetchDataPermohonan(1 , false);
        });
    </script>
@endsection