@extends('dashboard.index')

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header mb-30">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Permohonan Petty Cash</h4>
                            <small>Atur dan lihat daftar petty cash pada tabel di bawah</small>
                        </div>
                        {{-- <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    List
                                </li>
                            </ol>
                        </nav> --}}
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div style="padding:0; width: 100%; clear: both;">
                            <a href="{{ route('addPettyCash') }}" class="btn-block" type="button">
                                <button class="btn btn-primary" style="float: right;">
                                    <i class="fa fa-plus"></i>&nbsp; Tambah Permohonan Baru
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-box mb-10">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="row">
                                    <div class="col-3">
                                        <div><label> Cari Surat : </label></div>
                                        <input type="text" name="search_surat" placeholder="Cari Surat ..."
                                            class="form-control" />
                                    </div>
                                    <div class="col-3">
                                        <div><label> Status : </label></div>
                                        <select name="status_surat" placeholder="Status Surat ..." class="form-control">
                                            <option value="">- Pilih Status Surat -</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <div><label> Tanggal Pengajuan : </label></div>
                                        <input type="date" name="tanggal_surat" placeholder="Tanggal Pengajuan ..."
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-12" style="padding:0 0 30px 0; margin: 0; overflow: hidden;">
                <div class="row">
                    @php
                    $an = 0;
                    @endphp
                    @foreach($pengadaan as $row)
                    @php
                    $an++;
                    @endphp
                    <div class="col-md-4 col-6 mt-4">
                        <div class="col-md-12 col-12 card"
                            style="min-height: 200px; border-radius: 15px;  overflow: hidden; margin: 0; padding:0;">
                            <table style="height: 80px; border-bottom: 1px solid #DDDDDD;">
                                <tbody>
                                    <td style="padding: 20px 10px 20px 30px;">
                                        <i class="fa fa-users"></i>
                                    </td>
                                    <td style="padding: 20px 20px 20px 0;">
                                        <div>
                                            <h5 style="font-size: 18px; font-weight: 400;"> Pengajuan
                                                {{ $row->no_surat }}
                                            </h5>
                                        </div>

                                        <div class="mt-2">
                                            <h5 style="font-size: 14px; font-weight: normal; letter-spacing: 2px">
                                                {{ $row->created_at }}
                                            </h5>
                                        </div>
                                    </td>
                                </tbody>
                            </table>

                            <div style="padding: 10px 20px 20px 20px;">
                                <div class="mt-2">
                                    <h5 style="font-size: 12px; font-weight: normal; letter-spacing: 2px">
                                        {{ $row->no_surat }}
                                    </h5>
                                </div>

                                <div class="mt-4">
                                    <h5 style="font-size: 16px; font-weight: 500;"> {{ $row->title }} </h5>
                                </div>

                                <div class="mt-2" style="height: 100px;">
                                    <h5
                                        style="font-size: 12px; font-weight: normal; line-height: 21px; letter-spacing: 2px">
                                        {{ substr(strip_tags($row->detail),0,200)." ..." }}
                                    </h5>
                                </div>
                            </div>

                            <div style="border-top: 1px solid #DDDDDD; padding: 20px;">
                                <div class="col-md-12" style="margin:0; padding: 0 10px;">
                                    <div class="row">
                                        <div class="col-md-7" style="margin:0; padding: 0;">
                                            <div> Nominal Pengajuan </div>
                                            <div> Rp {{ app('App\Helpers\Str')->rupiah($row->nominal_pengajuan) }}
                                            </div>
                                        </div>
                                        <div class="col-md-5 d-flex justify-content-end" style="margin:0; padding: 0;">
                                            <a href="{{route('detailPettyCash',['index'=> $row->id])}}">
                                                <button class="btn btn-primary-outlined">
                                                    Lihat Detail
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if ($row->position == "0") {
                            ?>
                                <div
                                    style="height: 50px; display: flex; border-radius: 0 0 15px 15px; font-size: 14px; justify-content: center; align-items: center; color: #ffffff; width: 100%; border-top: 1px solid #DDDDDD; background: brown;">
                                    <div style="margin-right: 10px;"> <i class="fa fa-clock-o" style="font-size: 18px;"></i>
                                    </div>
                                    <div>
                                        Menunggu persetujuan
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div
                                    style="height: 50px; display: flex; border-radius: 0 0 15px 15px; font-size: 14px; justify-content: center; align-items: center; color: #ffffff; width: 100%; border-top: 1px solid #DDDDDD; background: green;">
                                    <div style="margin-right: 10px;"> <i class="fa fa-check-circle"
                                            style="font-size: 18px;"></i> </div>
                                    <div>
                                        Dokumen berhasil terverifikasi
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Simple Datatable start -->
            @include("dashboard.pages.users.components.modalUser")


        </div>
    </div>
</div>
@endsection

@section("footer_pengadaan_tab")
<script type="text/javascript">
    let searched = "<?php echo isset($_GET['btn-submit-new']) ? 1 : 0; ?>";
    let val_tanggal = "<?php echo isset($_GET['tanggal_surat']) ? $_GET['tanggal_surat'] : ''; ?>"

    let ex_tanggal = val_tanggal.split(" - ");

    $('.dateRange').daterangepicker({
        opens: 'right', // or 'left', 'center'
        startDate: searched =="1" ? ex_tanggal[0] : moment().subtract(29, 'days'),
        endDate: searched =="1" ? ex_tanggal[1] : moment(),
        minDate: '01/01/2015',
        maxDate: '12/31/2025',
        locale: {
            format: 'YYYY/MM/DD',
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, function(start, end, label) {
        // Callback function when dates are selected
        $('#selectedRange').html('You selected: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
</script>
@endsection