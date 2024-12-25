@extends('dashboard.index')

@section("content")
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="height-100-p mb-20" style="padding: 15px;">
                <div class="row align-items-center">
                    <div class="col-md-8" style="padding:0!important; margin:0!important;">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            <div class="weight-600 font-30">Daftar Unit Usaha</div>
                        </h4>
                        <p class="font-18 max-width-600"> Atur dan lihat daftar unit usaha pada tabel dibawah </p>
                    </div>
                    <div class="col-md-4" style="padding:0!important; margin:0!important;">
                        <a href="#" onClick="" class="btn-block" data-toggle="modal" data-target="#bd-addUnit-modal-lg" type=" button">
                            <button class="btn btn-primary" style="float: right;">
                                Tambah Unit Usaha
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            @include("dashboard.pages.profiles.component.sub.modals.addDetail")

            <!-- Simple Datatable start -->
            {{-- @include("dashboard.pages.users.components.modalUser")
            @include("dashboard.pages.users.components.modalPassword")
            @include("dashboard.pages.users.components.modalEdit") 
            --}}

            <div class="card-box mb-20">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div> <label> Cari Nama :</label> </div>
                            <div>
                                <input type="text" class="form-control" placeholder="Cari Nama" name="cari_nama" />
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div> <label> Tipe Pengguna :</label> </div>
                            <div>
                                <select class="form-control" name="tipe_pengguna">
                                    <option value=""> - Tipe Pengguna - </option>
                                    <option value="manager">Manager</option>
                                    <option value="sekretaris">Sektretaris</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <div style="clear: both; height: 10px;"></div>
                    <table class="table stripe hover nowrap">
                        <thead style="background: #F5F5F5; height: 60px;">
                            <tr>
                                <th> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></th>
                                <th class="table-plus datatable-nosort">Role / Peran</th>
                                <th>Status</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $an = 0;
                            @endphp
                            @foreach($position as $row)
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
                                    <div class="label-aktif">
                                        Aktif
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="{{route('detailUsaha',['index'=> $row->id])}}">
                                                <i class="dw dw-eye"></i> Detail
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end; margin-bottom: 20px;">
                    <div> @php echo $position->links('pagination::bootstrap-4'); @endphp </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
