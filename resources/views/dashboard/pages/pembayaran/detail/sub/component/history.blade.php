<div class="row" style="margin-top: -80px;">
    <div class="col-md-8 col-12">
        <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
            <div class="pd-20">
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

                <div style="float:left; width: 50px; height: auto;">
                    <div class="container-semi-lg-icon"></div>
                    <div style="clear: both;"></div>

                    <div style="height:50px; width: 7px; background: #EEEEEE; margin-left: 18px;">

                    </div>
                    @foreach($approvalDoc as $appr)
                    <div style="height:130px; width: 7px; background: #EEEEEE; margin-left: 18px;">
                        <div
                            style="width:25px; height: 25px; background: #416351; border-radius: 50%; margin-left: -8px; border: 4px solid #cfe6d9;">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div style="float:left; width: 90%;">
                    <div class="col-md-12" style="margin-bottom: 50px;">
                        <h5 style="color: #555555; font-weight: normal; margin-top: 10px;">Riwayat Approval </h5>
                    </div>
                    @foreach($approvalDoc as $appr)
                    <div class="col-md-12" style="height: 130px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8" style="margin:0; padding: 0;">
                                    <h5
                                        style="font-weight: normal; font-size: 15px; margin-top: 10px; color: #416351; font-weight: 500;">
                                        {{ $appr->title }}
                                    </h5>
                                </div>
                                <div class="col-md-4" style="margin:0; padding: 0; text-align: right;">
                                    <h5
                                        style="font-weight: normal; font-size: 14px; margin-top: 10px; color: #555555; font-weight: normal; letter-spacing: 1px;">
                                        {{ app('App\Helpers\Date')->tanggal_waktu($appr->created_at , true) }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5
                                style="color: #000000; font-weight: 500; margin-top: 10px; font-size: 16px; width: 50%; letter-spacing: 1px;">
                                <?php echo $appr->nama; ?></h5>
                        </div>
                        <div>
                            {{-- <label style="font-size: 11px; margin-top: 10px;">Catatan : </label> --}}
                            <h5
                                style="font-weight: normal; font-size: 14px; margin-top: 10px; color: #555555; font-weight: normal; width: 70%;  line-height: 20px;">
                                {{ $appr->note ? $appr->note : "-" }}
                            </h5>

                        </div>
                    </div>
                    @endforeach
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