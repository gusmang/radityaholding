<div class="row" style="margin-top: -80px;">
    <div class="col-md-8 col-12">
        <div class="card-box mb-20" style="padding: 20px 20px 30px 10px;">
            <div class="pd-20">
                <?php
                $pos = -1;
                $roles = "";
                $person = "";
                $role_id = "";

                ?>

                <div style="float:left; width: 50px; height: auto;">
                    <div class="container-semi-lg-icon"></div>
                    <div style="clear: both;"></div>

                    <div style="height:50px; width: 7px; background: #EEEEEE; margin-left: 18px;">

                    </div>
                    @foreach($hasApproved as $appr)
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
                    @foreach($historyPettyCash as $appr)
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
                                        {{ app('App\Helpers\Date')->tanggal_waktu($appr->updated_at , true) }}
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
                            <div class="row">
                                @if($appr->file !== "-")
                                <div class="col-md-9">
                                    <h5
                                        style="font-weight: normal; font-size: 14px; margin-top: 10px; color: #555555; font-weight: normal; width: 70%;  line-height: 20px;">
                                        {{ $appr->note ? $appr->note : "-" }}
                                    </h5>
                                </div>
                                <div class="col-md-3" style="font-size: 12px; text-align: right;">
                                   <a href="{{ asset('storage/'.$appr->file)}}" target="_blank"> <i class="fa fa-file"></i>&nbsp; Attachment </a>
                                </div>
                                @else
                                <h5
                                    style="font-weight: normal; font-size: 14px; margin-top: 10px; color: #555555; font-weight: normal; width: 70%;  line-height: 20px;">
                                    {{ $appr->note ? $appr->note : "-" }}
                                </h5>
                                @endif
                            </div>
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
                            $urlPdf = 'show-pettycash-pdf';
                            @endphp
                            <a href="{{ route($urlPdf,['index'=> $pengadaan->id]) }}" target="_blank">
                                <i class="micon bi bi-download"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div style="width: 100%; margin-top: 30px;">
                    <h5 class="small-text">Status</h5>
                    <div style="display: flex; margin-top: 5px;">
                        <div class="label-waiting mr-2"> Waiting Approval </div>
                        <div class="label-current"> {{ $approvalNext }} </div>
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