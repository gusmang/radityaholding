@extends('dashboard.index')

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header mb-30">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Semua Surat</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    List
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div style="padding:0; width: 100%; clear: both;">
                            <a href="#" onClick="" class="btn-block" data-toggle="modal" data-target="#bd-example-modal-lg" type="button">
                                <button class="btn btn-primary" style="float: right;">
                                    Export Data
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple Datatable start -->
            @include("dashboard.pages.users.components.modalUser")

            <div class="card-box mb-30">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-10">
                            {{-- <h4 class="text-blue h4">Tabel List User</h4> --}}
                            <h4 class="font-20 weight-500 mb-10 text-capitalize">
                                <div class="weight-600 font-21">Semua Surat</div>
                            </h4>
                            <p class="font-16 max-width-600"> Lihat progress surat yang diajukan melalui tabel dibawah. </p>
                        </div>
                        <div class="col-2">
                            <div class="dropdown" style="float: right;">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    Action
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-calendar-date"></i> &nbsp;Date Filter
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-search"></i> &nbsp;Search
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-filetype-xls"></i> &nbsp;Export List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-20" style="overflow: auto;">
                    <div style="clear: both; height: 10px;"></div>
                    <div style="padding: 0 15px 20px 15px;">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" name="search_surat" placeholder="Cari Surat ..." class="form-control" />
                            </div>
                            <div class="col-3">
                                <select name="status_surat" placeholder="Status Surat ..." class="form-control">
                                    <option value="">- Pilih Status Surat -</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="date" name="tanggal_surat" placeholder="Tanggal Pengajuan ..." class="form-control" />
                            </div>
                        </div>
                    </div>
                    <table class="table stripe hover nowrap">
                        <thead style="background: #F5F5F5; height: 60px;">
                            <tr>
                                <th> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></th>
                                <th class="table-plus datatable-nosort">No. Surat</th>
                                <th>Perihal</th>
                                <th>Nominal Pengajuan</th>
                                <th>Status Surat</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $an = 0;
                            @endphp
                            @foreach($users as $row)
                            @php
                            $an++;
                            @endphp
                            <tr>
                                <td> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></td>
                                <td class="table-plus">
                                    @php
                                    echo $row->name
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo $row->email
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo $row->role
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo $row->created_at
                                    @endphp
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end;">
                    <div> @php echo $users->links('pagination::bootstrap-4'); @endphp </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection