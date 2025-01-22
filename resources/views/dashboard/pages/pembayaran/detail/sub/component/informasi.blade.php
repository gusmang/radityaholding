<div class="row" style="margin-top: -80px;">
    <div class="col-md-8 col-12">
        <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
            <div class="pd-20">
                <div style="float:left; width: 50px; height: 50px;">
                    <div class="container-icon"></div>
                    <div style="clear: both;"></div>
                </div>
                <div style="float:left;">
                    <?php
                    $pos = -1;
                    $roles = "";
                    $disetujui = "";
                    $person = "";
                    $role_id = "";
                    foreach ($jabatan as $rowsJ) {

                        if ($pos === $pengadaan->position) {
                            $person = $rowsJ->name;
                            $roles = $rowsJ->role;
                            $role_id = $rowsJ->role_id;
                            break;
                        }
                        $disetujui .= '<h3 class="sub-title-text">' . $rowsJ->name . ' ( ' . $rowsJ->role . ' )</h3>';

                        $pos++;
                    }
                    ?>

                    <h5 style="color: #555555; font-weight: normal;"> Informasi dasar </h5>
                    <div style="clear: both;"></div>
                </div>
                <div style="clear: both;"></div>
                <div style="width: 100%; mt-4">
                    <?php
                    if (count($setuju) == 0) {
                    ?>
                        <div class="div-current mt-2 d-flex align-items-center justify-content-center"
                            style="padding: 20px;">
                            <div style="width:5%">
                                <div
                                    style="width:20px; height: 20px; border-radius: 50%; border:1px solid #FF6600; text-align: center;">
                                    <span style="color: #FF6600;"> ! </span>
                                </div>
                            </div>
                            <div style="width:95%;">
                                <h5 style="font-size: 16px; font-weight: 500;"> Surat keterangan belum dibuat. Surat
                                    keterangan akan dibuat sekretariat setelah berkas sudah diverifikasi dan disetujui.
                                </h5>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
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
                                         app('App\Helpers\Date')->tanggalIndo($setuju[0]->created_at);
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
                                            {{ $setuju[0]->tipe_surat }}
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
                                            {{ $setuju[0]->title }}

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
                                            app('App\Helpers\Str')->rupiah($setuju[0]->nominal_pengajuan);

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
                                            {{ strip_tags($setuju[0]->detail) }}

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php
                    }
                    ?>
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
                    <h5 style="color: #555555; font-weight: normal;"> Informasi lainnya </h5>
                    <div style="clear: both;"></div>
                </div>
                <div style="clear: both;"></div>
                <div style="width: 100%; margin-top: 10px;">
                    <div style="margin-top: -20px;">
                        <div class="d-flex" style="margin: 0; padding: 0; width: 100%">
                            <?php
                            if (Session::get('roleId') === $lastApprove) {
                            ?>
                                <div style="width: 50%; margin-top: 10px;">
                                    <div style="display: flex; margin-top: 5px;">
                                        <div>
                                            <button type="button" class="btn btn-primary form-control"
                                                onClick="showApprove2()" style="color: white; font-size: 14px;">
                                                <i class="fa fa-check-circle"></i>&nbsp; Verifikasi Berkas
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if (Session::get('roleId') === $lastApprove) {
                            ?>
                                <div style="width: 50%; margin-top: 10px;">
                                    <div style="display: flex; margin-top: 5px;">
                                        <div>
                                            <button type="button" class="btn btn-danger form-control"
                                                onClick="showApprove({{ $pengadaan->id}},'{{ $roles }}','{{ $person }}')"
                                                style="color: white; font-size: 14px;">
                                                <i class="fa fa-trash"></i>&nbsp; Tolak Berkas
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div
                        style="padding:5px; margin-top: 20px; border:1px solid #DDDDDD; border-radius: 10px; width: 100%; minHeight: 50px; display: flex; align-items: center;">
                        <div style="margin-right: 15px; margin-left: 10px; font-size: 21px; color: #FF0000;">
                            <i class="micon bi bi-file-pdf"></i>
                        </div>

                        <div style="font-weight: 600;">
                            Surat Permohonan {{ $pengadaan->no_surat }}.pdf <br />
                            <div style="font-size: 14px; font-weight: normal;">
                                Dibuat pada {{ app('App\Helpers\Date')->tanggalIndo($pengadaan->created_at) }}
                            </div>
                        </div>
                        <div style="font-size: 18px; margin-right: 10px;">
                            @php
                            $urlPdf = 'show-pengadaan-new-pdf';
                            @endphp
                            <a href="{{ route($urlPdf,['index'=> $pengadaan->id]) }}" target="_blank">
                                <i class="micon bi bi-download"></i>
                            </a>
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

                            <div style="font-weight: 600;">
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
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                    {{-- <h3 class="sub-title-text">{{ $pengadaan->no_surat }}</h3> --}}
                </div>

                <div style="width: 100%; margin-top: 30px;">
                    <h5 class="small-text">Status</h5>
                    <div style="display: flex; margin-top: 5px;">
                        <div class="label-waiting mr-2"> Waiting Approval </div>
                        <div class="label-current"> {{ $roles}} </div>
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
                        <h3 class="sub-title-text">{{ $pengadaan->diajukan }}</h3>
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