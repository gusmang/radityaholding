@extends('dashboard.index')
@php
$active_detail = (!isset($_GET['tab'])) ? "active-tab" : "";
$active_pengadaan = (isset($_GET['tab']) && $_GET['tab'] === 'pengadaan') ? "active-tab" : "";
$active_pembayaran = (isset($_GET['tab']) && $_GET['tab'] === 'pembayaran') ? "active-tab" : "";
$active_cash = (isset($_GET['tab']) && $_GET['tab'] === 'pettycash') ? "active-tab" : "";
$active_pengguna = (isset($_GET['tab']) && $_GET['tab'] === 'users') ? "active-tab" : "";

$display_detail = (isset($_GET['tab']) && $_GET['tab'] !== '') ? 'display: none;' : '';
$display_pengadaan = (!isset($_GET['tab'])) ? "display: none;" : "";
$display_pembayaran = (!isset($_GET['tab'])) ? "display: none;" : "";
$display_cash = (!isset($_GET['tab'])) ? "display: none;" : "";
$display_pengguna = (!isset($_GET['tab'])) ? "display: none;" : "";

if(isset($_GET['tab'])){
if($_GET['tab'] !== 'pengadaan'){
$display_pengadaan = 'display: none;';
}
if($_GET['tab'] !== 'pembayaran'){
$display_pembayaran = 'display: none;';
}
if($_GET['tab'] !== 'pettycash'){
$display_cash = 'display: none;';
}
if($_GET['tab'] !== 'users'){
$display_pengguna = 'display: none;';
}
}
@endphp
@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="mb-20" style="padding: 15px;">
                <div class="row align-items-center">
                    <div class="col-md-12"
                        style="padding:0!important; margin:0!important; display: flex; align-items: center;">
                        <div>
                            <a href="{{ route('unit-usaha') }}">
                                <div
                                    style="padding: 5px; display: flex; justify-content: center; align-items: center; height: 50px; width: 50px; border: 1px solid #DDDDDD; background: #FFFFFF;">
                                    <i class="fa fa-arrow-left" style="font-size: 18px;"></i>
                                </div>
                            </a>
                        </div>
                        <div style="margin-left: 20px;">
                            <h4 class="font-20 weight-500 text-capitalize">
                                <div class="weight-600 font-24">
                                    {{ $unitUsaha->name }}
                                </div>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-40">
                <div style="display: flex; flex-direction: row; margin-top: 60px;">
                    <div style="padding:0 20px 20px 20px; color: #666666; cursor: pointer;"
                        class="tab-list {{ $active_detail }}" id="tab-one-detail" onclick="active_tab(this.id , 1)">
                        Detail Unit Usaha
                    </div>
                    <div style="padding:0 20px; color: #666666; cursor: pointer;"
                        class="tab-list {{ $active_pengadaan }}" id="tab-two-detail" onclick="active_tab(this.id , 2)">
                        Alur Pengadaan
                    </div>
                    <div style="padding:0 20px; color: #666666; cursor: pointer;"
                        class="tab-list {{ $active_pembayaran }}" id="tab-three-detail"
                        onclick="active_tab(this.id , 3)">
                        Alur Pembayaran
                    </div>
                    <div style="padding:0 20px; color: #666666; cursor: pointer;" class="tab-list {{ $active_cash }}"
                        id="tab-five-detail" onclick="active_tab(this.id , 5)">
                        Alur Petty Cash
                    </div>
                    <div style="padding:0 20px; color: #666666; cursor: pointer;"
                        class="tab-list {{ $active_pengguna }}" id="tab-four-detail" onclick="active_tab(this.id , 4)">
                        Akun Pengguna
                    </div>
                </div>
                <div style="border-bottom: 1px solid #DDDDDD; margin-top: 0;">
                    <div style="display: flex; flex-direction: row;">
                        <div style="padding:0 10px; width: 170px;"></div>
                        <div style="padding:0 10px; width: 170px;"></div>
                        <div style="padding:0 10px; width: 152px;"></div>
                        <div style="padding:0 10px; width: 140px;"></div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 40px; {{ $display_detail }}" id="div_tab_detail" class="div_display_unit">
                @include("dashboard.pages.unitUsaha.component.sub.infoDetail")
            </div>

            <div style="margin-top: 40px; {{ $display_pengadaan }}" id="div_tab_pengadaan" class="div_display_unit">
                @include("dashboard.pages.unitUsaha.component.sub.alurPengadaan")
            </div>

            <div style="margin-top: 40px; {{ $display_pembayaran }}" id="div_tab_pembayaran" class="div_display_unit">
                @include("dashboard.pages.unitUsaha.component.sub.alurPembayaran")
            </div>

            <div style="margin-top: 40px; {{ $display_cash }}" id="div_tab_cash" class="div_display_unit">
                @include("dashboard.pages.unitUsaha.component.sub.alurPcash")
            </div>

            <div style="margin-top: 40px; {{ $display_pengguna }}" id="div_tab_user" class="div_display_unit">
                @include("dashboard.pages.unitUsaha.component.sub.akunPengguna")
            </div>

            @include("dashboard.pages.unitUsaha.component.sub.modals.editDetail")

            @include("dashboard.pages.unitUsaha.component.users.modalUser")
            @include("dashboard.pages.unitUsaha.component.users.modalPassword")
            @include("dashboard.pages.unitUsaha.component.users.modalEdit")
            @include("dashboard.pages.unitUsaha.component.users.modalSignature")
            @include("dashboard.pages.unitUsaha.component.users.modalViewSignature")
            @include("dashboard.pages.unitUsaha.component.users.modalMenu")

            @include("dashboard.pages.unitUsaha.component.pengadaan.modalPengadaan")
            @include("dashboard.pages.unitUsaha.component.pengadaan.modalPembayaran")
            @include("dashboard.pages.unitUsaha.component.pengadaan.modalPettyCash")
        </div>
    </div>
</div>

<script type="text/javascript">
    let selectedSurat = 1;
    let segmentId = "{{ Request::segment(3) }}";

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
            $("#div_tab_user").fadeIn("slow");
        } else if (page === 5) {
            $(".div_display_unit").hide();
            $("#div_tab_cash").fadeIn("slow");
        }
    }

    function active_tab_surat(id, page) {
        $(".tab-list-sub").removeClass("active-tab");
        $("#" + id).addClass("active-tab");

        $("#selected_surat_tipe").val(page - 1);
        if (page === 1) {
            $(".div_display_unit_sub").hide();
            $("#table_surat_reguler").fadeIn("slow");
            $("#table_surat_lainnya").hide();
        } else if (page === 2) {
            $(".div_display_unit_sub").hide();
            $("#table_surat_lainnya").fadeIn("slow");
            $("#table_surat_reguler").hide();
        }
        else if (page === 3) {
            $(".div_display_unit_sub").hide();
            $("#table_surat_penghapusan").fadeIn("slow");
            $("#table_surat_reguler").hide();
        }
        else if (page === 4) {
            $(".div_display_unit_sub").hide();
            $("#table_surat_maintenance").fadeIn("slow");
            $("#table_surat_reguler").hide();
        }
    }

    function showModalHapus(){
        Swal.fire({
            icon: "question",
            title: "Hapus Unit Usaha",
            text: "Yakin Hapus Unit Usaha ini?",
            showCancelButton: true, // Show Cancel button
            confirmButtonText: "Ya, Hapus!", // Text for OK button
            cancelButtonText: "Batal", // Text for Cancel button
            reverseButtons: true // Places "Cancel" on the left (optional)
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{ url('dashboard/delete/unit-usaha') }}" + "/" + segmentId;
            }
        });
    }

    function deleteRole(index , module){
        Swal.fire({
            icon: "question",
            title: "Hapus Role ini",
            text: "Yakin Hapus Role ini?",
            showCancelButton: true, // Show Cancel button
            confirmButtonText: "Ya, Hapus!", // Text for OK button
            cancelButtonText: "Batal", // Text for Cancel button
            reverseButtons: true // Places "Cancel" on the left (optional)
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{ url('dashboard/rolepengadaan/delete') }}" + "/" + index+"/"+segmentId+"/"+module;
            }
        });
    }
</script>
@endsection