@extends('dashboard.index')

@section("content")
<div class="main-container">
    <div class="pd-ltr-20">
        <div class="height-100-p mb-30" style="padding: 15px;">
            <div class="row align-items-center">
                <div class="col-md-8" style="padding:0!important; margin:0!important;">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        <div class="weight-600 font-30">Monitoring Surat</div>
                    </h4>
                    <p class="font-18 max-width-600"> Lihat progress semua surat yang diajukan oleh perusahaan </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 mb-30" style="margin-top: -20px;">
                <div class="card-box height-100-p widget-style1">
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2">Total Surat Pengadaan</div>
                                <div class="mt-4">
                                    <div class="h4 mb-0">200</div>
                                    <div class="mt-2 font-14">
                                        +40% dibanding minggu lalu
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-2">
                                <div style="width: 35px; height: 35px; background: green; border-radius: 5px;"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div style="border-top: 1px solid #DDDDDD;"></div>
                    </div>
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2 primary-color">Lihat Detail</div>
                            </div>
                            <div class="col-md-2 col-2 text-right">
                                <div class="weight-300 font-18 mt-2">
                                    <i class="fa fa-chevron-right primary-color"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb-30" style="margin-top: -20px;">
                <div class="card-box height-100-p widget-style1">
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2">Total Surat Pengadaan</div>
                                <div class="mt-4">
                                    <div class="h4 mb-0">200</div>
                                    <div class="mt-2 font-14">
                                        +40% dibanding minggu lalu
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-2">
                                <div style="width: 35px; height: 35px; background: green; border-radius: 5px;"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div style="border-top: 1px solid #DDDDDD;"></div>
                    </div>
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2 primary-color">Lihat Detail</div>
                            </div>
                            <div class="col-md-2 col-2 text-right">
                                <div class="weight-300 font-18 mt-2">
                                    <i class="fa fa-chevron-right primary-color"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb-30" style="margin-top: -20px;">
                <div class="card-box height-100-p widget-style1">
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2">Total Surat Pengadaan</div>
                                <div class="mt-4">
                                    <div class="h4 mb-0">200</div>
                                    <div class="mt-2 font-14">
                                        +40% dibanding minggu lalu
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-2">
                                <div style="width: 35px; height: 35px; background: green; border-radius: 5px;"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div style="border-top: 1px solid #DDDDDD;"></div>
                    </div>
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2 primary-color">Lihat Detail</div>
                            </div>
                            <div class="col-md-2 col-2 text-right">
                                <div class="weight-300 font-18 mt-2">
                                    <i class="fa fa-chevron-right primary-color"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Statistik Jumlah Surat</h2>
                    <div id="chart5"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2">Total Dana Diajukan</div>
                                <div class="mt-4">
                                    <div class="h2 mb-0">Rp 200.000.000</div>
                                    <div class="mt-2 font-14">
                                        +40% dibanding minggu lalu
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-2 d-flex justify-content-end">
                                <div style="width: 35px; height: 35px; background: green; border-radius: 5px;"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div style="border-top: 1px solid #DDDDDD;"></div>
                    </div>
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2 primary-color">Lihat Detail</div>
                            </div>
                            <div class="col-md-2 col-2 text-right d-flex justify-content-end">
                                <div class="weight-300 font-18 mt-2">
                                    <i class="fa fa-chevron-right primary-color"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2">Total Dana Cair</div>
                                <div class="mt-4">
                                    <div class="h2 mb-0">Rp 400.000.000</div>
                                    <div class="mt-2 font-14">
                                        +40% dibanding minggu lalu
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-2 d-flex justify-content-end">
                                <div style="width: 35px; height: 35px; background: green; border-radius: 5px;"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div style="border-top: 1px solid #DDDDDD;"></div>
                    </div>
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <div class="weight-500 font-18 mt-2 primary-color">Lihat Detail</div>
                            </div>
                            <div class="col-md-2 col-2 text-right">
                                <div class="weight-300 font-18 mt-2">
                                    <i class="fa fa-chevron-right primary-color"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Statistik Jumlah Surat</h2>
                    <div id="chart7"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
