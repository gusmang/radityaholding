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
                    <div class="col-md-12" style="padding:0!important; margin:0!important; display: flex; align-items: center;">
                        <div>
                            <a href="{{ route('unit-usaha') }}">
                                <div style="padding: 5px; display: flex; justify-content: center; align-items: center; height: 50px; width: 50px; border: 1px solid #DDDDDD; background: #FFFFFF;">
                                    <i class="fa fa-arrow-left" style="font-size: 18px;"></i>
                                </div>
                            </a>
                        </div>
                        <div style="margin-left: 20px;">
                            <h4 class="font-20 weight-500 text-capitalize">
                                <div class="weight-600 font-24">
                                    Pengaturan
                                </div>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-40">
                <div style="display: flex; flex-direction: row; margin-top: 60px;">
                    <div style="padding:0 20px 20px 20px; color: #666666; cursor: pointer;" class="tab-list {{ $active_detail }}" id="tab-one-detail" onclick="active_tab(this.id , 1)">
                        Informasi Umum
                    </div>
                    <div style="padding:0 20px; color: #666666; cursor: pointer;" class="tab-list {{ $active_pengguna }}" id="tab-four-detail" onclick="active_tab(this.id , 4)">
                        Daftar Role
                    </div>
                </div>
                <div style="border-bottom: 1px solid #DDDDDD; margin-top: 0;">
                    <div style="display: flex; flex-direction: row;">
                        <div style="padding:0 10px; width: 170px;"></div>
                        <div style="padding:0 10px; width: 140px;"></div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 40px; {{ $display_detail }}" id="div_tab_detail" class="div_display_unit">
                @include("dashboard.pages.pengaturan.component.sub.infoDetail")

            </div>

            <div style="margin-top: 40px; {{ $display_pengguna }}" id="div_tab_user" class="div_display_unit">
                @include("dashboard.pages.pengaturan.component.sub.akunPengguna")

            </div>

            @include("dashboard.pages.pengaturan.component.sub.modals.editDetail")


            @include("dashboard.pages.pengaturan.component.role.modalAdd")
            @include("dashboard.pages.pengaturan.component.role.modalEdit")
            @include("dashboard.pages.pengaturan.component.role.modalMenu")


        </div>
    </div>
</div>
@endsection

@section("footer_add_profiles")
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

    $(document).ready(function() {
        $('#form-settings-edit').on('submit', function(event) {
            event.preventDefault();

            const formData = $(this).serialize();
            const urlEdit = "{{ route('settingsEditJabatan') }}";

            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'PUT'
                , data: formData
                , dataType: "json"
                , success: function(response) {
                    // Display server response
                    if (response.status === 200) {
                        Swal.fire({
                            icon: "success"
                            , title: "Success"
                            , text: response.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = response.redirectUrl;
                            } else if (result.isDenied) {
                                Swal.fire("Changes are not saved", "", "info");
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error"
                            , title: "Error"
                            , text: "Something Wrong"
                        })
                    }
                }
                , error: function(xhr, status, error) {
                    $('#response').text('An error occurred: ' + error);
                }
            });

        });

        $('#form-settings-add').on('submit', function(event) {
            event.preventDefault();

            const formData = $(this).serialize();
            const urlEdit = "{{ route('settingsAddJabatan') }}";

            $.ajax({
                url: urlEdit, // URL to handle the form data
                type: 'POST'
                , data: formData
                , dataType: "json"
                , success: function(response) {
                    // Display server response
                    if (response.status === 200) {
                        Swal.fire({
                            icon: "success"
                            , title: "Success"
                            , text: response.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = response.redirectUrl;
                            } else if (result.isDenied) {
                                Swal.fire("Changes are not saved", "", "info");
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error"
                            , title: "Error"
                            , text: "Something Wrong"
                        })
                    }
                }
                , error: function(xhr, status, error) {
                    $('#response').text('An error occurred: ' + error);
                }
            });
        });

    })

</script>
@endsection
