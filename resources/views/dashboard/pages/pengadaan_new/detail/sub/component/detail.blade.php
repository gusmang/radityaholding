<div class="row" style="margin-top: -80px;">
    <div class="col-md-8 col-12">
        <form method="post" id="formAddPengadaan" name="formAddPengadaan" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idPermohonan" id="idPermohonan" value="{{ Request::segment(3) }}" />

            <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
                <div class="pd-20">
                    <div style="float:left; width: 50px; height: 50px;">
                        <div class="container-icon"></div>
                        <div style="clear: both;"></div>
                    </div>
                    <div style="float:left;">
                        <h5 style="color: #555555; font-weight: normal;"> Informasi dasar </h5>
                        <div style="clear: both;"></div>

                        <input type="hidden" name="cmbUnitUsaha" id="cmbUnitUsaha"
                            value={{ app('App\Helpers\Str')->getUserLog()->id }} />
                        <input type="hidden" name="cmbUnitUsahaName" id="cmbUnitUsahaName"
                            value="{{ app('App\Helpers\Str')->getUserLog()->name }}" />

                        <input type="hidden" id="teks_branch_approval" name="teks_branch_approval"
                            value="{{ $roles }}" />
                        <input type="hidden" id="teks_person_approval" name="teks_person_approval"
                            value="{{ $person }}" />
                    </div>
                    <div style="clear: both;"></div>
                    <div style="width: 95%; margin-left: 50px;" id="div-informasi-dasar">
                        <div class="col-md-12"
                            style="padding:15px 0 15px 0; margin: 0; border-bottom: 1px solid #DDDDDD;">
                            <div class="row">
                                <div class="col-md-5 font-500">
                                    <label> Tanggal Pengajuan </label>
                                </div>
                                <div class="col-md-7" style="color: #444444;">
                                    <div>
                                        {{
                                            app('App\Helpers\Date')->tanggalIndo($pengadaan->tanggal);
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"
                            style="padding:15px 0 15px 0; margin: 5px 0 0 0; border-bottom: 1px solid #DDDDDD;">
                            <div class="row">
                                <div class="col-md-5 font-500">
                                    <label> Tipe Surat </label>
                                </div>
                                <div class="col-md-7" style="color: #444444;">
                                    <div>
                                        <?php
                                        //echo $pengadaan->tipe_surat." ";
                                            if($pengadaan->tipe_surat == "1"){
                                                echo "Pengadaan Aset";
                                            }
                                            else if($pengadaan->tipe_surat == "3"){
                                                echo "Penghapusan Aset";
                                            }
                                            else{
                                                echo "Pengadaan Lainnya";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"
                            style="padding:15px 0 15px 0; margin: 0; border-bottom: 1px solid #DDDDDD;">
                            <div class="row">
                                <div class="col-md-5 font-500">
                                    <label> Perihal </label>
                                </div>
                                <div class="col-md-7" style="color: #444444;">
                                    <div>
                                        {{ $pengadaan->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"
                            style="padding:15px 0 15px 0; margin: 0; border-bottom: 1px solid #DDDDDD;">
                            <div class="row">
                                <div class="col-md-5 font-500">
                                    <label> Nominal Pengajuan </label>
                                </div>
                                <div class="col-md-7" style="color: #444444;">
                                    <div>
                                        Rp {{
                                        app('App\Helpers\Str')->rupiah($pengadaan->nominal_pengajuan);
                                    }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"
                            style="padding:15px 0 15px 0; margin: 0; border-bottom: 1px solid #DDDDDD;">
                            <div class="row">
                                <div class="col-md-5 font-500">
                                    <label> Detail Isi Surat </label>
                                </div>
                                <div class="col-md-7" style="color: #444444;">
                                    <div>
                                        {{ strip_tags(html_entity_decode(($pengadaan->detail))) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div style="clear: both;"></div>
                </div>
            </div>

        </form>

        <div class="col-md-12 col-12 mt-4" id="div-pendukung-dokumen" style="margin:0; padding: 0;">
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
                    <div style="width: 95%; margin-left: 50px;">
                        <div class="col-md-12" style="margin:0; padding: 0;">

                            <div class="row">

                                @foreach($dokumen as $rowDoc)

                                <div class="col-md-6" style="margin: 0;">
                                    <div class="col-md-12 card" style="padding: 15px;">
                                        <div class="row">
                                            <div class="col-md-10 font-500">
                                                <label> {{ substr($rowDoc->nama_dokumen , 0 , 20) }} ... </label>
                                                <div style="margin-top: -10px; color: #666666;"> 500kb </div>
                                            </div>
                                            <div class="col-md-2 font-500">
                                                <div style="color: #666666; font-size: 21px;">
                                                    <a href="{{ asset('storage/uploads/'.$rowDoc->nama_dokumen) }}" target="_blank">
                                                        <i class="fa fa-download"></i>
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

    <div class="col-md-4 col-12">
        <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
            <div class="pd-20">
                <div style="float:left; width: 50px; height: 50px;">
                    <div class="container-icon"></div>
                    <div style="clear: both;"></div>
                </div>
                <div style="float:left;">
                    <h5 style="color: #555555; font-weight: normal;"> Informasi lainnya</h5>
                    <div style="clear: both;"></div>
                </div>
                <div style="clear: both;"></div>
                <div style="width: 100%; margin-top: 10px;">
                    <div style="margin-top: 10px;">
                        <div style="margin: 0; padding: 0; width: 100%">
                            <?php
                            if (Session::get('roleId') === $lastApprove && $jabatanApproval->status === 0) {
                                if (app('App\Helpers\Status')->isSekretariat(Auth::user()->role)) {
                            ?>
                                <?php
                                } else {
                                ?>
                                    <button type="button" class="btn btn-primary"
                                        onClick="showApprovePt({{ $pengadaan->id}},'{{ $roles }}','{{ $person }}','{{ $next_role }}')"
                                        style="color: white; font-size: 14px;  float: left; margin-right: 10px;">
                                        <i class="fa fa-check-circle"></i>&nbsp; Verifikasi
                                    </button>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            if (Session::get('roleId') === $lastApprove && $jabatanApproval->status === 0) {
                            ?>
                                <div style="float: left;">
                                    <div>
                                        <div>
                                            <?php
                                            if (app('App\Helpers\Status')->isSekretariat(Auth::user()->role)) {
                                            ?>
                                            <?php
                                            } 
                                            else {
                                                // echo "<br />".Auth::user()->id_positions;
                                                // if(Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0"){
                                                    ?>
                                                        <button type="button" class="btn btn-danger"
                                                            onClick="showTolakBerkas('{{ $pengadaan->id}}');"
                                                            style="color: white; font-size: 14px;">
                                                            <i class="fa fa-trash"></i>&nbsp; Tolak
                                                        </button>
                                                    <?php
                                              //   }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div style="clear: both;"></div>

                    <div
                        style="padding:5px; margin-top: 20px; border:1px solid #DDDDDD; border-radius: 10px; width: 100%; minHeight: 50px; display: flex; align-items: center;">
                        <div style="margin-right: 15px; margin-left: 10px; font-size: 21px; color: #FF0000;">
                            <i class="micon bi bi-file-pdf"></i>
                        </div>

                        <div style="font-weight: 600; width: 90%;">
                            Surat Permohonan {{ $pengadaan->no_surat }}.pdf <br />
                            <div style="font-size: 14px; font-weight: normal;">
                                Dibuat pada {{ app('App\Helpers\Date')->tanggalIndo($pengadaan->created_at) }}
                            </div>
                        </div>
                        <div style="font-size: 18px; margin-right: 10px;">
                            @php
                            $urlPdf = 'show-pengadaan-new-pdf';
                            @endphp
                            <a href="{{ route($urlPdf,['index'=> Request::segment(3)]) }}" target="_blank">
                                <i class="micon bi bi-download"></i>
                            </a>
                            {{-- <a href="javascript:void(0)" onclick="showDownload('{{ route($urlPdf,['index'=> Request::segment(3)]) }}');">
                                <i class="micon bi bi-download"></i>
                            </a> --}}
                        </div>
                    </div>

                    <?php
                    if (count($setuju) > 0) {
                    ?>
                        <div
                            style="padding:5px; margin-top: 20px; border:1px solid #DDDDDD; border-radius: 10px; width: 100%; minHeight: 50px; display: flex; align-items: center;">
                            <div style="margin-right: 15px; margin-left: 10px; font-size: 21px; color: #FF0000;">
                                <i class="micon bi bi-file-pdf"></i>
                            </div>

                            <div style="font-weight: 600; width: 90%;">
                                Surat Persetujuan {{ $setuju[0]->no_surat }}.pdf <br />
                                <div style="font-size: 14px; font-weight: normal;">
                                    Dibuat pada {{ app('App\Helpers\Date')->tanggalIndo($setuju[0]->created_at) }}
                                </div>
                            </div>
                            <div style="font-size: 18px; margin-right: 10px;">
                                @php
                                $urlPdf = 'show-persetujuan-pdf';
                                @endphp
                                <a href="{{ route($urlPdf,['index'=> $setuju[0]->id]) }}" target="_blank">
                                    <i class="micon bi bi-download"></i>
                                </a>
                                {{-- <a href="javascript:void(0)" onclick="showDownload('{{ route($urlPdf,['index'=> $setuju[0]->id]) }}');">
                                    <i class="micon bi bi-download"></i>
                                </a> --}}
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div style="width: 100%; margin-top: 30px;">
                    <h5 class="small-text">Status</h5>
                    <div style="display: flex; margin-top: 5px;">
                        <?php
                        if (Session::get('roleId') === $lastApprove && $jabatanApproval->status === 1) {
                        ?>
                            <div class="label-success mr-2"> Approved </div>
                        <?php
                        } else {
                        ?>
                            <div class="label-waiting mr-2"> Waiting Approval </div>
                            <div class="label-current"> {{ $approvalNext }} </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div style="width: 100%; margin-top: 30px;">
                    <h5 class="small-text">Unit Usaha</h5>
                    <div>
                        <h3 class="sub-title-text">{{ $pengadaan->unit_usaha }}</h3>
                    </div>
                </div>

                <div style="width: 100%; margin-top: 30px;">
                    <h5 class="small-text">Diajukan Oleh</h5>
                    <div>
                        <h3 class="sub-title-text">{{ $diajukan }}</h3>
                    </div>
                </div>

                <div style="width: 100%; margin-top: 30px;">
                    <h5 class="small-text">Disetujui Oleh</h5>
                    <div>
                        {!! $disetujui !!}
                    </div>
                    {{-- <div>
                        <h3 class="sub-title-text">General Purwanto ( General Manager )</h3>
                    </div>
                    <div>
                        <h3 class="sub-title-text">PIC Purwanto ( PIC Unit )</h3>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>

</div>
