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
                        <?php
                        $pos = -1;
                        $roles = "";
                        $disetujui = "";
                        $person = "";
                        $role_id = "";
                        $next_role = "";
                        foreach ($jabatan as $rowsJ) {

                            if ($pos === $pengadaan->position) {
                                $person = $rowsJ->name;
                                $roles = $rowsJ->role;
                                $role_id = $rowsJ->role_id;
                                $next_role = $jabatan[$pengadaan->position === 5 ? $pos + 1 : $pos + 2]->name;


                                break;
                            }
                            $disetujui .= '<h3 class="sub-title-text">' . $rowsJ->name . ' ( ' . $rowsJ->role . ' )</h3>';

                            $pos++;
                        }
                        ?>
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
                    <div style="width: 95%; margin-left: 50px; display: none;" id="div-informasi-persetujuan">
                        <div style="width: 95%;">
                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Nomor Surat </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div>
                                            <input type="text" class="form-control" name="teksNomorSurat"
                                                id="teksNomorSurat" placeholder="Ketik Nomor Surat ..." required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Tanggal </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div>
                                            <input type="date" class="form-control" name="cmbTglPengajuan"
                                                id="cmbTglPengajuan" placeholder="Pilih Tanggal ..." required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:15px 0 15px 0; margin: 0;">
                                <div class="row">
                                    <div class="col-md-12 font-500">
                                        <label class="required-label"> Tipe Pengadaan </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div>
                                            <select class="form-control" name="cmbTipeSurat" id="cmbTipeSurat" required>
                                                <option value="">- Pilih Tipe -</option>
                                                <option value="Pengadaan">Permohonan Pengadaan</option>
                                                <option value="Penghapusan Aset">Permohonan Penghapusan Aset</option>
                                                <option value="Lainnya">Permohonan Lainnya</option>
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
                                                placeholder="Input Perihal ..." required />
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
                                            <input type="number" class="form-control" name="nominalPengajuan"
                                                id="nominalPengajuan" placeholder="Nominal Pengajuan ..." required />
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
                                        {{-- <div>
                                            <textarea class="form-control" rows="6" name="detailIsiSurat" id="detailIsiSurat" placeholder="Detail Isi Surat ..." required></textarea>
                                        </div> --}}
                                        <div id="detailIsiSurat">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        app('App\Helpers\Date')->tanggalIndo($pengadaan->created_at);
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
                                        Pengadaan
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
                                        {{ strip_tags($pengadaan->detail) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div style="clear: both;"></div>
                </div>
            </div>

            <div class="col-md-12 col-12 mt-4" id="div-input-dokumen" style="margin:0; padding: 0; display: none;">

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
                                        <label class="required-label"> Dokumen ( Pdf , Jpg, Png ) </label>
                                    </div>
                                    <div class="col-md-12" style="color: #444444;">
                                        <div>
                                            <input type="file" multiple class="form-control" name="docFile[]"
                                                id="docFile" placeholder="Pilih Dokumen ..." />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">

                                <div class="row">

                                    <div class="col-md-6" style="margin: 0;">
                                        <div class="col-md-12 card" style="padding: 15px;">
                                            <div class="row">
                                                <div class="col-md-12 font-500">
                                                    <label> Arsip_Invoice.pdf </label>
                                                    <div style="margin-top: -10px; color: #666666;"> 500kb </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="margin: 0;">
                                        <div class="col-md-12 card" style="padding: 15px;">
                                            <div class="row">
                                                <div class="col-md-12 font-500">
                                                    <label> Arsip_Invoice.pdf </label>
                                                    <div style="margin-top: -10px; color: #666666;"> 200kb </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div style="width: 100%; margin-top: 30px;">
                        <div style="width: 100%;">
                            <a href="{{ route('addPengadaan') }}" type="button" style="float: right;">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-plus"></i>&nbsp; Simpan
                                </button>
                            </a>

                            <a href="{{ route('addPengadaan') }}" class="mr-4" type="button" style="float: right;">
                                <button class="btn btn-primary-outlined">
                                    Batalkan
                                </button>
                            </a>
                        </div>
                    </div>
                    <br clear="all" />

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
                                                    <a href="{{ url('storage/uploads/'.$rowDoc->nama_dokumen)}}"
                                                        target="_blank">
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
                                            <?php
                                            if (strtolower(Auth::user()->role) == "sekretariat") {
                                            ?>
                                                <button type="button" class="btn btn-primary form-control"
                                                    onClick="showApprove2()" style="color: white; font-size: 14px;">
                                                    <i class="fa fa-check-circle"></i>&nbsp; Verifikasi Berkas
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-primary form-control"
                                                    onClick="showApprove({{ $pengadaan->id}},'{{ $roles }}','{{ $person }}','{{ $next_role }}')"
                                                    style="color: white; font-size: 14px;">

                                                    <i class="fa fa-check-circle"></i>&nbsp; Verifikasi Berkas
                                                </button>
                                            <?php
                                            }
                                            ?>
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
                                            <?php
                                            if (strtolower(Auth::user()->role) == "sekretariat") {
                                            ?>
                                                <button type="button" class="btn btn-danger form-control"
                                                    onClick="showTolakBerkas()" style="color: white; font-size: 14px;">
                                                    <i class="fa fa-trash"></i>&nbsp; Tolak Berkas
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-danger form-control"
                                                    onClick="showTolakBerkas({{ $pengadaan->id}},'{{ $roles }}','{{ $person }}');"
                                                    style="color: white; font-size: 14px;">
                                                    <i class="fa fa-trash"></i>&nbsp; Tolak Berkas
                                                </button>
                                            <?php
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
                    <div
                        style="padding:5px; margin-top: 20px; border:1px solid #DDDDDD; border-radius: 10px; width: 100%; minHeight: 50px; display: flex; align-items: center;">
                        <div style="margin-right: 15px; margin-left: 10px; font-size: 21px; color: #FF0000;">
                            <i class="micon bi bi-file-pdf"></i>
                        </div>

                        <div style="font-weight: 600; width: 90%;">
                            Surat Permohonan tes {{ $pengadaan->no_surat }}.pdf <br />
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
                </div>

            </div>
        </div>
    </div>

</div>