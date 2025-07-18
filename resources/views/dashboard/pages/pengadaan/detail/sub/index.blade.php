@extends('dashboard.index')
@php
$active_detail = (!isset($_GET['tab'])) ? "active-tab" : "";
$active_pengadaan = (isset($_GET['tab']) && $_GET['tab'] === 'pengadaan') ? "active-tab" : "";
$active_pembayaran = (isset($_GET['tab']) && $_GET['tab'] === 'pembayaran') ? "active-tab" : "";
$active_pengguna = (isset($_GET['tab']) && $_GET['tab'] === 'users') ? "active-tab" : "";

$display_detail = (isset($_GET['tab']) && $_GET['tab'] !== '') ? 'display: none;' : '';
$display_pengadaan = (!isset($_GET['tab'])) ? "display: none;" : "";
$display_pembayaran = (!isset($_GET['tab'])) ? "display: none;" : "";
$display_pengguna = (!isset($_GET['tab'])) ? "display: none;" : "";

if(isset($_GET['tab'])){
if($_GET['tab'] !== 'pengadaan'){
$display_pengadaan = 'display: none;';
}
if($_GET['tab'] !== 'pembayaran'){
$display_pembayaran = 'display: none;';
}
if($_GET['tab'] !== 'users'){
$display_pengguna = 'display: none;';
}
}
@endphp
@section("content")
<div class="main-container">
    @include("dashboard.pages.pengadaan.detail.sub.component.modals.modalVerifikasi")
    @include("dashboard.pages.pengadaan.detail.sub.component.modals.modalPersetujuan")

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
                                    Detail Permohonan Pengadaan
                                    <div> <small>{{ }}</small> </div>
                                </div>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-40 riwayat-approval">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
                            <div class="pd-20" style="margin-top: -10px;">
                                <div style="float:left; width: 50px; height: 50px;">
                                    <div class="container-icon"></div>
                                    <div style="clear: both;"></div>
                                </div>
                                <div style="float:left;">
                                    <h5 style="color: #555555; font-weight: normal;"> Riwayat Persetujuan </h5>
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                            <div
                                style="height: 60px; display: flex; align-items: center; justify-content: flex-start; margin-top: 40px; padding:0 0 0 30px;">
                                @php $pos = -1; $inc = 1; @endphp
                                @foreach($jabatan as $rowsJ)
                                <?php
                                if ($pos < 0) {
                                ?>
                                    <div style="width: 17%; position: relative;">
                                        <div
                                            style="width: 100%; z-index: 20px; top: 20px; background: #416351; height: 4px;">
                                        </div>
                                        <div
                                            style="width: 40px; height: 40px; padding: 7px; border-radius: 50%; background: #416351; position: absolute; z-index: 50; top: -20px;">
                                            <div
                                                style="width: 26px; height: 26px; border-radius: 50%; background: #FFFFFF; display: flex; align-items: center; justify-content: center;">
                                                <i class="fa fa-check" style="font-size: 16px; color: #416351;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    if ($pos === $pengadaan->position) {
                                    ?>
                                        <div style="width: 15%; position: relative;">
                                            <div
                                                style="width: 100%; z-index: 20px; top: 20px; background: #DDDDDD; height: 4px;">
                                            </div>
                                            <div
                                                style="width: 40px; height: 40px; padding: 7px; border-radius: 50%; background: brown; position: absolute; z-index: 50; top: -20px;">
                                                <div
                                                    style="width: 26px; height: 26px; border-radius: 50%; background: brown; color: white; display: flex; align-items: center; justify-content: center;">
                                                    {{ $inc }}
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($pos < $pengadaan->position) {
                                    ?>
                                        <div style="width: 17%; position: relative;">
                                            <div
                                                style="width: 100%; z-index: 20px; top: 20px; background: #416351; height: 4px;">
                                            </div>
                                            <div
                                                style="width: 40px; height: 40px; padding: 7px; border-radius: 50%; background: #416351; position: absolute; z-index: 50; top: -20px;">
                                                <div
                                                    style="width: 26px; height: 26px; border-radius: 50%; background: #FFFFFF; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa fa-check" style="font-size: 16px; color: #416351;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div style="width: 17%; position: relative;">
                                            <div
                                                style="width: 100%; z-index: 20px; top: 20px; background: #DDDDDD; height: 4px;">
                                            </div>
                                            <div
                                                style="width: 40px; height: 40px; padding: 7px; border-radius: 50%; background: #DDDDDD; position: absolute; z-index: 50; top: -20px;">
                                                <div
                                                    style="width: 26px; height: 26px; border-radius: 50%; background: #DDDDDD; color: white; display: flex; align-items: center; justify-content: center;">
                                                    {{ $inc }}
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                $inc++;
                                $pos++;
                                ?>
                                @endforeach
                            </div>

                            <div class="col-md-12 col-12 d-flex" style="padding: 20px 0 0 30px;">
                                @foreach($jabatan as $rows)
                                <div style="width: 12.5%; text-align: left; background: #FFFFFF;">
                                    <h5 style="font-size: 16px; font-weight: 500; width: 150px; "> {{ $rows->role }}
                                    </h5>
                                    <div style="padding:2px;">
                                        <small style="font-size: 12px; color: #666666;"> 24 Aug 2024 , 04:00</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-40">
                <div style="display: flex; flex-direction: row; margin-top: 60px;">
                    <div style="padding:0 20px 20px 20px; color: #666666; cursor: pointer;"
                        class="tab-list {{ $active_detail }}" id="tab-one-detail" onclick="active_tab(this.id , 1)">
                        Surat Permohonan
                    </div>
                    <div style="padding:0 20px; color: #666666; cursor: pointer;"
                        class="tab-list {{ $active_pengadaan }}" id="tab-two-detail" onclick="active_tab(this.id , 2)">
                        Surat Persetujuan
                    </div>
                    <div style="padding:0 20px; color: #666666; cursor: pointer;"
                        class="tab-list {{ $active_pembayaran }}" id="tab-three-detail"
                        onclick="active_tab(this.id , 3)">
                        Detail Riwayat Approval
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

            <div style="margin-top: 120px; {{ $display_detail }}" id="div_tab_detail" class="div_display_unit">
                @include("dashboard.pages.pengadaan.detail.sub.component.detail")
            </div>

            <div style="margin-top: 120px; {{ $display_pengadaan }}" id="div_tab_pengadaan" class="div_display_unit">
                @include("dashboard.pages.pengadaan.detail.sub.component.informasi")
                {{-- @include("dashboard.pages.unitUsaha.component.sub.alurPengadaan") --}}
            </div>

            <div style="margin-top: 120px; {{ $display_pembayaran }}" id="div_tab_pembayaran" class="div_display_unit">
                @include("dashboard.pages.pengadaan.detail.sub.component.history")
                {{-- @include("dashboard.pages.unitUsaha.component.sub.alurPembayaran") --}}
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
        }
    }
</script>
@endsection

@section("footer_modals_pengguna")
<script type="text/javascript">
    const quill = new Quill('#detailIsiSurat', {
        theme: 'snow'
    });

    $('#formAddPengadaan').on('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        formData.append("detailIsiSurat", quill.root.innerHTML);

        const urlPengadaan = "{{ route('postPersetujuanNew') }}";

        $.ajax({
            url: urlPengadaan, // Laravel route
            method: 'POST',
            data: formData,
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function(response) {
                //console.log('Success:', response);
                Swal.fire({
                    icon: "success",
                    title: "Success !",
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "{{ route('pengadaan') }}";
                    }
                });

            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
            },

        })
    })

    function showTolakBerkas(){
        $("#bs-tolak-modal").modal("show");
    }

    function showApprove(id, role, person, next) {
        $("#teruskan_person").html(next);
        $("#teks_dokumen_pengadaan").val(id);
        $("#teks_branch_approval").val(role);
        $("#teks_person_approval").val(person);

        $("#bs-verifikasi-modal").modal("show");
    }


    function showApprove2(id, role, person) {
        Swal.fire({
            title: 'Approve Document ?',
            text: "Apakah Anda Yakin Akan Verifikasi",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Setujui'
        }).then((result) => {
            if (result.isConfirmed) {
                let urlDoc = "";
                $("#div-informasi-persetujuan").show();
                $("#div-informasi-dasar").hide();
                $("#div-input-dokumen").show();
                $("#div-pendukung-dokumen").hide();
            } else {
                //console.log('clicked cancel');
            }
        })
        //$("#bs-persetujuan-modal").modal("show");
    }

    $('#form-verifikasi-pengadaan-add').on('submit', function(event) {
        event.preventDefault();

        let urlDoc = "{{ route('approval-pengadaan') }}";

        $.ajax({
            type: "POST",
            url: urlDoc,
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                if (data.status === 200) {
                    Swal.fire(
                        'Confirmed!', 'Document Approved Successfull', 'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location = data.redirectUrl;
                        }
                    });
                }
            }
        });

    });
</script>
@endsection