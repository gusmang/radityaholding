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
                                    <div class="h4 mb-0">{{ $jmlPengadaan }}</div>
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
                                <div class="weight-500 font-18 mt-2 primary-color">
                                    <a href="{{ url('dashboard/pengadaan?index=1') }}"> Lihat Detail </a>
                                </div>
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
                                <div class="weight-500 font-18 mt-2">Total Surat Pembayaran</div>
                                <div class="mt-4">
                                    <div class="h4 mb-0">{{ $jmlPengadaanPmb }}</div>
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
                                <div class="weight-500 font-18 mt-2 primary-color">
                                    <a href="{{ url('dashboard/pembayaran?index=1') }}"> Lihat Detail</a>
                                </div>
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
                                <div class="weight-500 font-18 mt-2">Total Surat PettyCash</div>
                                <div class="mt-4">
                                    <div class="h4 mb-0">{{ $jmlPengadaanPty }}</div>
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
                                <div class="weight-500 font-18 mt-2 primary-color">
                                    <a href="{{ url('dashboard/petty_cash?index=1') }}"> Lihat Detail</a>
                                </div>
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
                                    <div class="h2 mb-0">Rp {{ app("App\Helpers\Str")->rupiah($pengadaan) }}</div>
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
                                <div class="weight-500 font-18 mt-2 primary-color">
                                    <a href="{{ url('dashboard/pengadaan?index=1&search_surat=&btn-submit-new=submit&status_surat=2') }}"> Lihat Detail </a>
                                </div>
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
                                    <div class="h2 mb-0">Rp {{ app("App\Helpers\Str")->rupiah($pengadaan2) }}</div>
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
                                <div class="weight-500 font-18 mt-2 primary-color">
                                    <a href="{{ url('dashboard/pengadaan?index=1&search_surat=&btn-submit-new=submit&status_surat=1') }}">Lihat Detail</a>
                                </div>
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
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("footer_dashboard")
<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total Pencairan Dana {{ date("Y") }}'
    },
    subtitle: {
        text:
            ''
    },
    xAxis: {
        categories: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni' , 'Juli', 'Agustus','September','Oktober','November','Desember'],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Dana Rupiah'
        }
    },
    tooltip: {
        valueSuffix: ' Rp'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Dana Diajukan',
            data: [<?php echo $valArr[0] ?>, <?php echo $valArr[1] ?>, <?php echo $valArr[2] ?>, <?php echo $valArr[3] ?>, <?php echo $valArr[4] ?>, <?php echo $valArr[5] ?>,<?php echo $valArr[6] ?>, <?php echo $valArr[7] ?>, <?php echo $valArr[8] ?>, <?php echo $valArr[9] ?>, <?php echo $valArr[10] ?>, <?php echo $valArr[11] ?>]
        },
        {
            name: 'Dana Cair',
            data: [<?php echo $valArr2[0] ?>, <?php echo $valArr2[1] ?>, <?php echo $valArr2[2] ?>, <?php echo $valArr2[3] ?>, <?php echo $valArr2[4] ?>, <?php echo $valArr2[5] ?>,<?php echo $valArr2[6] ?>, <?php echo $valArr2[7] ?>, <?php echo $valArr2[8] ?>, <?php echo $valArr2[9] ?>, <?php echo $valArr2[10] ?>, <?php echo $valArr2[11] ?>]
        }
    ]
});

</script>
@endsection