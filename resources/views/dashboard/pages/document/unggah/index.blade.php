@extends('dashboard.index')

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Document</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Document
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                January 2018
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple Datatable start -->
            @include("dashboard.pages.users.components.modalUser")

            <div>
                <h4 style="font-size: 18px;"> Semua Kategori </h4>
                <div class="card" onClick="document.getElementById('f_upload').click();" style="min-height: 200px; cursor: pointer; width: 100%; margin-top: 10px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; border-radius: 15px; border: 2px dashed #DDDDDD;">
                    <div>
                        <input type="file" name="f_upload" id="f_upload" style="width: 150px; display: none;" />
                        <div style="
                            padding:10px; 
                            border: 2px solid #DDDDDD; 
                            text-align: center; 
                            border-radius: 10px; 
                            font-size: 12px;
                            color: #999999;">
                            <span class="micon bi bi-upload" style="margin-right: 10px;"></span> Unggah Dokumen Anda
                        </div>
                        <div style="margin-top: 20px; text-align: center; font-size: 12px; color: #666666;">
                            Upload file dokumen di sini <br />
                            format file berupa <b>PDF</b> , <b>docx</b> dengan ukuran maksimal <b>25MB</b>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Semua</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Draft</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Perlu tandatangan</button>
                    </li>
                </ul>
            </div>

            <div class="card-box mb-30 mt-4">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-10">
                            <h4 class="text-blue h4">Tabel List User</h4>
                        </div>
                        <div class="col-2">
                            <div style="padding:0; width: 100%; clear: both;">
                                <a href="#" onClick="" class="btn-block" data-toggle="modal" data-target="#bd-example-modal-lg" type="button">
                                    <button class="btn btn-primary" style="float: right;">
                                        Tambah User
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="pb-20">
                            <div style="clear: both; height: 10px;"></div>
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Tanggal Daftar</th>
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
                    </div>
                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    </div>
                </div>

                <div style="width:100%; padding: 10px;">
                    <div style="width: 200px; margin: auto;"> @php echo $users->links('pagination::bootstrap-4'); @endphp </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
