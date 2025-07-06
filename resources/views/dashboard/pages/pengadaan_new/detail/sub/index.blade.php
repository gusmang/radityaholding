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
    @include("dashboard.pages.pengadaan_new.detail.sub.component.modals.modalVerifikasi")
    @include("dashboard.pages.pengadaan_new.detail.sub.component.modals.modalPersetujuan")
    @include("dashboard.pages.pengadaan_new.detail.sub.component.modals.modalTolak")
    @include("dashboard.pages.pengadaan_new.detail.sub.component.modals.modalDownload")
    {{-- @include("dashboard.pages.pengadaan_new.detail.sub.component.modals.modalRevisi") --}}

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="mb-20" style="padding: 15px;">
                <div class="row align-items-center">
                    <div class="col-md-12"
                        style="padding:0!important; margin:0!important; display: flex; align-items: center;">
                        <div>
                            <a href="{{ route('pengadaan') }}">
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
                                    <div> <small>{{$pengadaan->no_surat}}</small> </div>
                                </div>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-40 riwayat-approval">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card-box mb-20" style="padding: 20px 20px 30px 10px; overflow: auto;">
                            <div class="pd-20" style="margin-top: -10px;">
                                <div style="float:left; width: 50px; height: 50px;">
                                    <div class="container-icon"></div>
                                    <div style="clear: both;"></div>
                                </div>
                                <div style="float:left;">
                                    <h5 style="color: #555555; font-weight: normal;"> Riwayat Persetujuan</h5>
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                            <div
                                style="min-height: 120px; display: flex; align-items: center; justify-content: flex-start; margin-top: 40px; padding:0 0 0 30px; overflow: auto;">
                                @php $pos = -1; $inc = 1; @endphp
                                @foreach($jabatan as $rowsJ)
                                <?php
                                if ($pos < 0) {
                                ?>
                                    <div style="min-width: 15%; position: relative;">
                                        <div
                                            style="width: 100%; z-index: 20px; top: 20px; background: #416351; height: 4px;">
                                        </div>
                                        <div
                                        class="green-circle">
                                            <div
                                                style="width: 26px; height: 26px; border-radius: 50%; background: #FFFFFF; display: flex; align-items: center; justify-content: center;">
                                                <i class="fa fa-check" style="font-size: 16px; color: #416351;"></i>
                                            </div>
                                        </div>
                                        <p></p>
                                        <div style="margin-top: 25px;">
                                            <h5 style="font-size: 16px; font-weight: 500; width: 150px; "> {{ strlen($rowsJ->name) > 15 ? substr($rowsJ->name , 0 , 15).".." : $rowsJ->name }}
                                            </h5>
                                            <div style="padding:2px;">
                                                <small style="font-size: 10px; color: #666666;"> {{ $rowsJ->updated_at }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    if (($lastApprove === $rowsJ->id_jabatan && $rowsJ->status === 0)) {
                                    ?>
                                        <div style="min-width: 15%; position: relative;">
                                            <div
                                                style="width: 100%; z-index: 20px; top: 20px; background: #DDDDDD; height: 4px;">
                                            </div>
                                            <div
                                                class="waiting-circle">
                                                <div
                                                    style="width: 26px; height: 26px; border-radius: 50%; background: brown; color: white; display: flex; align-items: center; justify-content: center;">
                                                    {{ $inc }}
                                                </div>
                                            </div>
                                            <p></p>
                                            <div style="margin-top: 25px;">
                                                <h5 style="font-size: 16px; font-weight: 500; width: 150px; "> {{ strlen($rowsJ->name) > 15 ? substr($rowsJ->name , 0 , 15).".." : $rowsJ->name }}
                                                </h5>
                                                <div style="padding:2px;">
                                                    <small style="font-size: 10px; color: #666666;"> {{ $rowsJ->updated_at }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else if ($rowsJ->status === 1) {
                                    ?>
                                        <div style="min-width: 15%; position: relative;">
                                            <div
                                                style="width: 100%; z-index: 20px; top: 20px; background: #416351; height: 4px;">
                                            </div>
                                            <div
                                                class="green-circle">
                                                <div
                                                    style="width: 26px; height: 26px; border-radius: 50%; background: #FFFFFF; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa fa-check" style="font-size: 16px; color: #416351;"></i>
                                                </div>
                                            </div>
                                            <p></p>
                                            <div style="margin-top: 25px;">
                                                <h5 style="font-size: 16px; font-weight: 500; width: 150px; "> {{ strlen($rowsJ->name) > 15 ? substr($rowsJ->name , 0 , 15).".." : $rowsJ->name }}
                                                </h5>
                                                <div style="padding:2px;">
                                                    <small style="font-size: 10px; color: #666666;"> {{ $rowsJ->updated_at }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div style="min-width: 15%; position: relative;">
                                            <div
                                                style="width: 100%; z-index: 20px; top: 20px; background: #DDDDDD; height: 4px;">
                                            </div>
                                            <div
                                                class="disabled-circle">
                                                <div
                                                    style="width: 26px; height: 26px; border-radius: 50%; background: #DDDDDD; color: white; display: flex; align-items: center; justify-content: center;">
                                                    {{ $inc }}
                                                </div>
                                            </div>
                                            <p></p>
                                            <div style="margin-top: 25px;">
                                                <h5 style="font-size: 16px; font-weight: 500; width: 150px; "> {{ strlen($rowsJ->name) > 15 ? substr($rowsJ->name , 0 , 15).".." : $rowsJ->name }}
                                                </h5>
                                                <div style="padding:2px;">
                                                    <small style="font-size: 10px; color: #666666;"> {{ $rowsJ->updated_at }}</small>
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

                            {{-- <div class="col-md-12 col-12 d-flex" style="padding: 20px 0 0 30px;">
                                @foreach($jabatan as $rows)
                                <div style="width: <?php //echo count($jabatan) > 9 ? '11.2%' : '15.2%' ?>; text-align: 'left'; background: #FFFFFF;">
                                    <h5 style="font-size: 16px; font-weight: 500; width: 150px; "> {{ count($jabatan) > 9 ? substr($rows->name , 0 , 6).".." : $rows->name }}
                                    </h5>
                                    <div style="padding:2px;">
                                        <small style="font-size: 10px; color: #666666;"> {{ $rows->updated_at }}</small>
                                    </div>
                                </div>
                                @endforeach
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-40">
                <div class="is_desktop">
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
                </div>
                <div class="is_mobile">
                    <div style="display: flex; flex-direction: row; margin-top: 60px;">
                        <div style="padding:0 20px 20px 20px; color: #666666; cursor: pointer; font-size: 13px;"
                            class="tab-list {{ $active_detail }}" id="tab-one-detail" onclick="active_tab(this.id , 1)">
                            Surat Permohonan
                        </div>
                        <div style="padding:0 20px; color: #666666; cursor: pointer; font-size: 13px;"
                            class="tab-list {{ $active_pengadaan }}" id="tab-two-detail" onclick="active_tab(this.id , 2)">
                            Surat Persetujuan
                        </div>
                        <div style="padding:0 20px; color: #666666; cursor: pointer; font-size: 13px;"
                            class="tab-list {{ $active_pembayaran }}" id="tab-three-detail"
                            onclick="active_tab(this.id , 3)">
                            Detail Riwayat Approval
                        </div>
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

            <?php
            $pos = -1;
            $roles = "";
            $disetujui = "";
            $person = "";
            $role_id = "";
            $next_role = "";
            foreach ($hasApproved as $rowsJ) {
                $disetujui .= '<h3 class="sub-title-text"><b>' . $rowsJ->name . '</b> ( ' . $rowsJ->title . ' )</h3>';

                $pos++;
            }
            ?>

            <div style="margin-top: 120px; {{ $display_detail }}" id="div_tab_detail" class="div_display_unit">
                @include("dashboard.pages.pengadaan_new.detail.sub.component.detail")
            </div>

            <div style="margin-top: 120px; {{ $display_pengadaan }}" id="div_tab_pengadaan" class="div_display_unit">
                @include("dashboard.pages.pengadaan_new.detail.sub.component.informasi")
                {{-- @include("dashboard.pages.unitUsaha.component.sub.alurPengadaan") --}}
            </div>

            <div style="margin-top: 120px; {{ $display_pembayaran }}" id="div_tab_pembayaran" class="div_display_unit">
                <div class="is_desktop">
                    @include("dashboard.pages.pengadaan_new.detail.sub.component.history")
                </div>

                <div class="is_mobile">
                    @include("dashboard.pages.pengadaan_new.detail.sub.component.mobile.history")
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

@section("footer_modals_pettyCashEdit")
<script type="text/javascript">
    let quill = null;
    $(document).ready(function(){
        quill = new Quill('#detailIsiSuratNew', {
            theme: 'snow'
        });
    });

    CKEDITOR.replace('editor1', {
        // Disable all notifications
        disableNotifications: true,
        
        // Remove "Powered by CKEditor" from the bottom
        removePlugins: 'about,notification',
        
        // Disable upgrade notifications
        startupMode: 'wysiwyg',
        
        // Hide the "This document was saved from an older version" warning
        ignoreEmptyParagraph: true,
        
        // Disable deprecated API warnings
        on: {
            instanceReady: function(ev) {
                ev.editor.on('notificationShow', function(event) {
                    event.cancel();
                });
            }
        }
    });

    function showDownload(url){
        $("#url_download_page").val(url);
        $("#bs-download-modal").modal("show")
    }
    
    function downloadFile(){
        let downloadUrl = $("#url_download_page").val() + "?page-break="+$("#pagebreak").val()
        window.open(downloadUrl)
    }
    
    let tempFiles = [];

    function addTemplate(){
        const file = document.getElementById("docFile").files[0];

        if (file) {
            // Get the file size in bytes
            const fileSizeInBytes = file.size;

            // Convert the file size to a readable format (e.g., KB, MB)
            let fileSizeReadable = fileSizeInBytes;
            let unit = 'bytes';

            if (fileSizeInBytes >= 1024) {
                fileSizeReadable = (fileSizeInBytes / 1024).toFixed(2);
                unit = 'KB';
            }

            if (fileSizeInBytes >= 1024 * 1024) {
                fileSizeReadable = (fileSizeInBytes / (1024 * 1024)).toFixed(2);
                unit = 'MB';
            }

            let templateAdded = '<div class="col-md-6" style="margin: 10px 0 0 0;">'+
            '<div class="col-md-12 card" style="padding: 15px;">'+'<div class="row">'+
            '<div><div class="col-md-12 font-500">'+
            '<label> '+file.name+' </label>'+
            '<div style="margin-top: -10px; color: #666666;"> '+fileSizeReadable + ' ' + unit+' </div>'+
            '</div></div></div></div>';

            document.getElementById("docFile").value = "";
            tempFiles.push(file);

            $("#uploaded-div").append(templateAdded);
            document.getElementById("docFile").value = "";
        } else {
            alert("Tidak ada file dipilih.");
        }
    }

    $('#form-tolak-pengadaan-add').on('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        if(document.getElementById('file_upload_tolak').files[0] !== null){
            formData.append("files", document.getElementById('file_upload_tolak').files[0]);
        }

        const urlPengadaan = "{{ route('tolakPengadaan') }}";

        $.ajax({
            url: urlPengadaan, // Laravel route
            method: 'POST',
            data: formData,
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function(response) {
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
    });

    $('#form-verifikasi-pengadaan-add-new').on('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        if(document.getElementById('file_upload_ver').files[0] !== null){
            formData.append("files", document.getElementById('file_upload_ver').files[0]);
        }

        const urlPengadaan = "{{ route('approval-pengadaan') }}";

        $.ajax({
            url: urlPengadaan, // Laravel route
            method: 'POST',
            data: formData,
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            dataType: "json",
            success: function(response) {
                if(response.status === 200){
                    Swal.fire({
                        icon: "success",
                        title: "Success !",
                        text: response.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "{{ route('pengadaan') }}";
                        }
                    });
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Error !",
                        text: response.message
                    })
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
            },

        })
    });

    function tolakBerkas(id){
        Swal.fire({
            title: "Tolak Berkas",
            text: "Apakah anda yakin tolak berkas ini ?",
            icon: "question",
            confirmButtonText: "Tolak Berkas",
            cancelButtonText: "Batal",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                //Swal.fire("Saved!", "", "success");
            } else if (result.isDenied) {
               // Swal.fire("Changes are not saved", "", "info");
            }
        });
    }
    
    function addPengadaan(form){
        event.preventDefault();

        const formData = new FormData(form);
        formData.append("_token" , "<?php echo csrf_token(); ?>")
        //formData.append("detailIsiSurat", quill.root.innerHTML);
        let editor = CKEDITOR.instances.editor1;

        let htmlContent = editor.getData();
        formData.append("detailIsiSurat", htmlContent);
        for(var ans = 0; ans < tempFiles.length; ans++){
            formData.append("files"+ans, tempFiles[ans]);
        }
        formData.append("fileLength" , tempFiles.length);

        const urlPengadaan = "{{ route('postPersetujuanNew') }}";

        $.ajax({
            url: urlPengadaan, // Laravel route
            method: 'POST',
            data: formData,
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function(response) {
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
    }

    $('#formAddPengadaan').on('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        let editor = CKEDITOR.instances.editor1;

        let htmlContent = editor.getData();
        formData.append("detailIsiSurat", htmlContent);
        for(var ans = 0; ans < tempFiles.length; ans++){
            formData.append("files"+ans, tempFiles[ans]);
        }
        formData.append("fileLength" , tempFiles.length);

        const urlPengadaan = "{{ route('postPersetujuanNew') }}";

        $.ajax({
            url: urlPengadaan, // Laravel route
            method: 'POST',
            data: formData,
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function(response) {
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

    function showApprovePt(id, role, person, next) {
        $(".formInputNew").hide();
        $("#teruskan_person").html(next);
        $("#teks_dokumen_pengadaan").val(id);
        $("#teks_branch_approval").val(role);
        $("#teks_person_approval").val(person);

        $("#bs-verifikasi-modal-pengadaan").modal("show");
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
                $("#teks_branch_approval_sc").val(role);
            } else {
            }
        })
    }

    function showTolakBerkas(id){
        $("#bs-tolak-modal").modal("show");
    }

    function showApprovePmb(id, role, person) {
        Swal.fire({
            title: 'Approve Document ?',
            text: "Apakah Anda Yakin Akan Verifikasi",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Setujui'
        }).then((result) => {
            if (result.isConfirmed) {
                let urlDoc = "";
                $(".formInputNew").hide();
                $("#formAddPembayaranNew").show();
                $("#div-informasi-dasar").hide();
                $("#div-input-dokumen").show();
                $("#div-pendukung-dokumen").hide();
                $("#teks_branch_approval_sc").val(role);
            } else {
            }
        })
    }
</script>
@endsection
