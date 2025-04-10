<div class="row">
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
                <div style="float:right;">
                    <div class="mt-2">
                        <button type="button" onClick="setValue()" class="btn btn-primary-outlined" href="#" data-toggle="modal" data-target="#bd-detail-modal-lg" style="width: 100%;">
                            <i class="fa fa-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>

                <div style="clear: both;"></div>
                <div style="margin-left: 52px; width: 95%;">
                    <div class="col-md-12" style="padding:20px 0 20px 0; margin: 0; border-bottom: 1px solid #DDDDDD;">
                        <div class="row">
                            <div class="col-md-4 font-500">
                                Nama
                            </div>
                            <div class="col-md-8" style="color: #444444;">
                                {{ $profiles->name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding:20px 0 20px 0; margin: 0; border-bottom: 1px solid #DDDDDD;">
                        <div class="row">
                            <div class="col-md-4 font-500">
                                Email
                            </div>
                            <div class="col-md-8" style="color: #444444;">
                                {{ $profiles->email }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding:20px 0 20px 0; margin: 0; border-bottom: 1px solid #DDDDDD;">
                        <div class="row">
                            <div class="col-md-4 font-500">
                                Role / Posisi
                            </div>
                            <div class="col-md-8" style="color: #444444;">
                                {{ $profiles->role }}
                            </div>
                        </div>
                    </div>

                </div>

                <div style="clear: both;"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="card-box mb-20" style="min-height: 500px; padding: 20px 20px 30px 10px;">
            <div class="pd-20">
                <div style="float:left; width: 50px; height: 50px;">
                    <div class="container-icon"></div>
                    <div style="clear: both;"></div>
                </div>
                <div style="float:left;">
                    <h5 style="color: #555555; font-weight: normal;"> Tanda Tangan </h5>
                    <div style="clear: both;"></div>
                </div>
                <div style="clear: both;"></div>
                <div style="width: 100%; margin-top: 10px;">
                    <img src="{{ asset('storage/'.Auth::user()->signature_url); }}" height="250" />
                </div>

                <div style="width: 100%; margin-top: 30px; border-bottom: 1px solid #DDDDDD;"></div>

                {{-- <div class="mt-4">
                    <div style="float:left; width: 50px; height: 50px;">
                        <div class="container-icon"></div>
                        <div style="clear: both;"></div>
                    </div>
                </div> --}}
                <div style="clear: both;"></div>
                <div class="mt-2">
                    <button type="button" class="btn btn-primary-outlined" href="#" data-toggle="modal" data-target="#bd-addSignature-modal-lg" style="width: 100%;">
                        <i class="fa fa-edit"></i> Edit Tanda Tangan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
