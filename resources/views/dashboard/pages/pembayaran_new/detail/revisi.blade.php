@extends('dashboard.index')

@section("content")
<div class="main-container">
    
    <form method="post" id="formAddPengadaan" name="formAddPengadaan" enctype="multipart/form-data">
        @csrf
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="mb-20" style="padding: 15px;">
                    <div class="row align-items-center">
                        <div class="col-md-8"
                            style="padding:0!important; margin:0!important; display: flex; align-items: center;">
                            <div>
                                <a href="{{ route('pembayaran') }}">
                                    <div
                                        style="padding: 5px; display: flex; justify-content: center; align-items: center; height: 50px; width: 50px; border: 1px solid #DDDDDD; background: #FFFFFF;">
                                        <i class="fa fa-arrow-left" style="font-size: 18px;"></i>
                                    </div>
                                </a>
                            </div>
                            <div style="margin-left: 20px;">
                                <h4 class="font-20 weight-500 text-capitalize">
                                    <div class="weight-600 font-24">
                                        <div> Pengajuan Permohonan Pembayaran </div>
                                        <div> <small> Lengkapi formulir dibawah untuk mengajukan dokumen </small> </div>
                                    </div>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4"
                            style="display: flex; flex-direction: row; justify-content: flex-end; align-items: flex-end;">

                            <a href="{{ route('addPengadaan') }}" class="mr-4" type="button">
                                <button class="btn btn-primary-outlined">
                                    Batalkan
                                </button>
                            </a>

                            <a href="{{ route('addPengadaan') }}" type="button">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-plus"></i>&nbsp; Simpan
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: -80px;">
            <div class="col-md-8 col-12">
                <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
                    <div class="pd-20">
                        <div style="float:left; width: 50px; height: 50px;">
                            <div class="container-icon"></div>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="float:left;">
                            <h5 style="color: #555555; font-weight: normal;"> Informasi dasar </h5>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="alert alert-danger">
                            <b>Alasan Penolakan :</b> <br />
                            {{ $hisLast->note }}
                        </div>
                        <div style="clear: both;"></div>
                        <div style="width: 95%;">
                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Tanggal </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div>
                                            <input type="date" class="form-control" name="cmbTglPengajuan"
                                                id="cmbTglPengajuan" placeholder="Pilih Tanggal ..." value="<?php echo date('Y-m-d'); ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0; display: none;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Tipe Surat </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div>
                                            <select class="form-control" name="cmbTipeSurat" id="cmbTipeSurat" required>
                                                <option value="">- Pilih Tipe -</option>
                                                <option value="0" selected="selected">Pembayaran</option>
                                                <option value="1">Pengadaan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Perihal </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div>
                                            <input type="text" class="form-control" name="inp_perihal" id="inp_perihal"
                                                placeholder="Input Perihal ..." value="{{ $pembayaran->perihal }}" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Nominal Pengajuan </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div>
                                            <input name="hid_uuid_text" id="hid_uuid_text" type="hidden" value="{{ $pembayaran->uuid }}" />
                                            <input type="text" class="form-control rupiahInput" name="nominalPengajuan"
                                                id="nominalPengajuan" value="{{ $pembayaran->nominal_pengajuan }}" placeholder="Nominal Pengajuan ..." required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Detail Isi Surat </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <textarea name="editor1" id="editor1" rows="10" cols="80">{{ $pembayaran->detail }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
                    <div class="pd-20">
                        <div style="float:left; width: 50px; height: 50px;">
                            <div class="container-icon"></div>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="float:left;">
                            <h5 style="color: #555555; font-weight: normal;"> Informasi lainnya </h5>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="clear: both;"></div>
                        <div style="width: 100%; margin-top: 10px;">
                            <h5 class="small-text">Diajukan Oleh</h5>
                            <h3 class="sub-title-text"><?php echo Auth::user()->name; ?></h3>
                            <input type="hidden" class="form-control mt-2" name="inp_diajukan" id="inp_diajukan"
                                placeholder="Input Diajukan ..." required />
                        </div>

                        <div style="width: 100%; margin-top: 30px;">
                            <h5 class="small-text">Unit Usaha</h5>
                            <div class="mt-2">
                                {{ app('App\Helpers\Str')->getUserLog()->name }}
                                <input type="hidden" name="cmbUnitUsaha" id="cmbUnitUsaha"
                                    value={{ app('App\Helpers\Str')->getUserLog()->id }} />
                                <input type="hidden" name="cmbUnitUsahaName" id="cmbUnitUsahaName"
                                    value="{{ app('App\Helpers\Str')->getUserLog()->name }}" />
                            </div>
                        </div>

                        <div style="width: 100%; margin-top: 30px;">
                            <h5 class="small-text">Nomor Surat</h5>
                            <div class="row">
                                <div class="col-4" style="display: none;">
                                    <input type="text" class="form-control mt-2" name="inp_invoice_no" id="inp_invoice_no"
                                    placeholder="Input No. Surat ..." required disabled="disabled" value="{{ $codeLast }}" />
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control mt-2" name="inp_invoice" id="inp_invoice"
                                        placeholder="Input No. Surat ..." required value="{{ $codeSub }}" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8 col-12">
                <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
                    <div class="pd-20">
                        <div style="float:left; width: 50px; height: 50px;">
                            <div class="container-icon"></div>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="float:left;">
                            <h5 style="color: #555555; font-weight: normal;"> Dokumen Pendukung </h5>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="clear: both;"></div>
                        <div style="width: 95%;">
                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Dokumen ( Pdf ) </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="file"  class="form-control" name="docFile[]"
                                                    id="docFile" placeholder="Pilih Dokumen ..." accept=".jpg,.png,.pdf,.docx,.jpeg,.xlsx" />
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-primary" id="button-plus" onClick="addTemplate()" type="button"> + </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">

                                <div class="row" id="uploaded-div">

                                    @foreach($dokumen as $rowDoc)

                                        <div class="col-md-6" style="margin: 10px 0 0 0;" id="file_doc_{{ $rowDoc->id }}">
                                            <div class="col-md-12 card" style="padding: 15px;">
                                                <div class="row">
                                                    <div class="col-md-9 font-500">
                                                        <label> {{ substr($rowDoc->nama_dokumen , 0 , 20) }} ... </label>
                                                        <div style="margin-top: -10px; color: #666666;"> 500kb </div>
                                                    </div>
                                                    <div class="col-md-3 font-500">
                                                        <div style="font-size: 18px; color: #666666;">
                                                            <a href="{{ asset('storage/uploads/'.$rowDoc->nama_dokumen) }}" target="_blank">
                                                                <i class="fa fa-download"></i>
                                                            </a>

                                                            <a href="javascript:void(0)" onclick="deleteDoc({{ $rowDoc->id }})" style="margin-left: 5px; color: #FF0000;">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                        
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@section("footer_add_pengadaan")
<script type="text/javascript">
    let tempFiles = [];

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

    function deleteDoc(index){
        let conn = confirm("Yakin hapus file ini ?");

        if(conn === true){
            $.ajax({
                type: "POST",
                data: "id="+index+"&_token={{ csrf_token() }}",
                url: "{{ route('hapusDocPembayaran'); }}",
                dataType: "json",
                success:function(data){
                    if(data.status === 200){
                        Swal.fire({
                            icon: "success",
                            title: "Success !",
                            text: data.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#file_doc_'+data.id).fadeOut('slow');
                            }
                        });
                    }
                    else{
                        Swal.fire({
                            icon: "error",
                            title: "Gagal !",
                            text: data.message
                        })
                    }
                }
            });
        }
    }

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

    $(document).ready(function() {
        const defaultTemplate = templates();

        const customTemplate = templates(
        '20 Oktober 2024', 
        '215/RDT/GYR/X/2024', 
        'I Wayan Sudarma', 
        'Marketing Officer', 
        '15 Januari 2015',
        'Ni Luh Suastini',
        '18 Oktober 2024',
        '648/Holding/HRD/VI/2023',
        '750.000',
        'Tujuh Ratus Lima Puluh Ribu Rupiah'
        );

        let editors = CKEDITOR.instances.editor1;

        editors.setData(customTemplate);

        // Attach event listener for form submission
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

            const urlPengadaan = "{{ route('postRevisiPembayaran') }}";

            // Send AJAX request
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
                        if(result.isDuplicate){
                            dialogError(response.message);
                        }
                        else{
                            if (result.isConfirmed) {
                                window.location = "{{ route('pembayaran') }}";
                            }
                        }
                    });

                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                },

            })
        })
    });

</script>
@endsection