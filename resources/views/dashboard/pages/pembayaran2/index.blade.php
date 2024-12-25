@extends('dashboard.index')

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header mb-30">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Pengajuan Pembayaran</h4>
                            <small>Atur dan lihat daftar pengajuan pembayaran pada tabel di bawah</small>
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
                            <a href="{{ route('addPengadaan') }}" class="btn-block" type="button">
                                <button class="btn btn-primary" style="float: right;">
                                    <i class="fa fa-plus"></i>&nbsp; Tambah Pengajuan Baru
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
                                        <input type="text" name="search_surat" placeholder="Cari Surat ..." class="form-control" />
                                    </div>
                                    <div class="col-3">
                                        <div><label> Status : </label></div>
                                        <select name="status_surat" placeholder="Status Surat ..." class="form-control">
                                            <option value="">- Pilih Status Surat -</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <div><label> Tanggal Pengajuan : </label></div>
                                        <input type="date" name="tanggal_surat" placeholder="Tanggal Pengajuan ..." class="form-control" />
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
                    @foreach($users as $row)
                    @php
                    $an++;
                    @endphp
                    <div class="col-md-4 col-6 mt-4">
                        <div class="col-md-12 col-12 card" style="min-height: 200px; border-radius: 15px;  overflow: hidden; margin: 0; padding:0;">
                            <table style="height: 80px; border-bottom: 1px solid #DDDDDD;">
                                <tbody>
                                    <td style="padding: 20px 10px 20px 30px;">
                                        <i class="fa fa-users"></i>
                                    </td>
                                    <td style="padding: 20px 20px 20px 0;">
                                        <div>
                                            <h5 style="font-size: 18px; font-weight: 400;"> Pengajuan #567918237897871 </h5>
                                        </div>

                                        <div class="mt-2">
                                            <h5 style="font-size: 14px; font-weight: normal; letter-spacing: 2px"> 28 Juni 2024 , 18:00 </h5>
                                        </div>
                                    </td>
                                </tbody>
                            </table>

                            <div style="padding: 10px 20px 20px 20px;">
                                <div class="mt-2">
                                    <h5 style="font-size: 12px; font-weight: normal; letter-spacing: 2px"> INV/9023/91-20323 </h5>
                                </div>

                                <div class="mt-4">
                                    <h5 style="font-size: 16px; font-weight: 500;"> Permohonan Pembelian 20 Unit Printer </h5>
                                </div>

                                <div class="mt-2">
                                    <h5 style="font-size: 12px; font-weight: normal; letter-spacing: 2px"> Dalam rangka meningkatkan kinerja di berbagai divisi, kami mengajukan permohonan pembuat... </h5>
                                </div>
                            </div>

                            <div style="border-top: 1px solid #DDDDDD; padding: 20px;">
                                <div class="col-md-12" style="margin:0; padding: 0 10px;">
                                    <div class="row">
                                        <div class="col-md-7" style="margin:0; padding: 0;">
                                            <div> Nominal Pengajuan </div>
                                            <div> Rp 500.000.000 </div>
                                        </div>
                                        <div class="col-md-5 d-flex justify-content-end" style="margin:0; padding: 0;">
                                            <a href="{{route('detailPengadaan',['index'=> $row->id])}}">
                                                <button class="btn btn-primary-outlined">
                                                    Lihat Detail
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="height: 50px; display: flex; border-radius: 0 0 15px 15px; font-size: 14px; justify-content: center; align-items: center; color: #ffffff; width: 100%; border-top: 1px solid #DDDDDD; background: green;">
                                <div style="margin-right: 10px;"> <i class="fa fa-check-circle" style="font-size: 18px;"></i> </div>
                                <div> Menunggu persetujuan dari manager of finance </div>
                            </div>
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