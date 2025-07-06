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
                        <a href="#" onClick="" class="btn-block" data-toggle="modal" data-target="#bd-addUnit-modal-lg"
                            type=" button">
                            <button class="btn btn-primary" style="float: right;">
                               <i class="fa fa-plus"></i> Tambah Unit Usaha
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            @include("dashboard.pages.unitUsaha.component.sub.modals.addDetail")

            <form method="get">

                <div class="card-box mb-20">
                    <div class="pd-20">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div> <label> Nama Unit Usaha :</label> </div>
                                <div>
                                    <input type="text" class="form-control" placeholder="Cari Nama" name="cari_nama" id="cari_nama" />
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div> <label> Kategori Bisnis :</label> </div>
                                <div>
                                    <select class="form-control" name="kategori_bisnis" id="kategori_bisnis">
                                        <option value=""> - Semua  - </option>
                                        @php
                                        $bisnis = app('App\Helpers\Status')->getUnitType();

                                        $an = 0;
                                        @endphp

                                        <?php
                                        foreach($bisnis as $rows){
                                            $an++;
                                            ?>
                                                <option value="<?php echo $an; ?>"><?php echo $rows; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-2">
                                <div style="margin-top: 30px;">
                                    <button class="btn btn-primary form-control" name="btn-submit" id="btn-submit">
                                    <i class="fa fa-search"></i>&nbsp; Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-20">
                        <div style="clear: both; height: 10px;"></div>
                        <table class="table stripe hover nowrap">
                            <thead style="background: #F5F5F5; height: 60px;">
                                <tr>
                                    <th> <input type="checkbox" name="chk_name" id="chk_name"
                                            style="transform: scale(1.5);" /></th>
                                    <th class="table-plus datatable-nosort">Nama Unit Usaha</th>
                                    <th>Limit Petty Cash</th>
                                    <th>Jumlah Akun</th>
                                    <th>Unit Bisnis</th>
                                    <th>Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $an = 0;
                                $bisnis = app('App\Helpers\Status')->getUnitType();
                                @endphp
                                @foreach($unitUsaha as $row)
                                @php
                                $an++;
                                @endphp
                                <tr>
                                    <td> 
                                        <input type="checkbox" name="chk_name" id="chk_name"
                                            style="transform: scale(1.5);" />
                                    </td>
                                    <td class="table-plus">
                                        @php
                                        echo $row->name
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        echo "Rp. ".app('App\Helpers\Str')->rupiah($row->limit_petty_cash);
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        echo "<b>".$row->user_count."</b> Akun";
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        echo $row->id_unit_bisnis == "0" ? "-" : $bisnis[$row->id_unit_bisnis-1];
                                        @endphp
                                    </td>

                                    <td>
                                        <div class="label-aktif">
                                            Aktif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item"
                                                    href="{{route('detailUsaha',['index'=> $row->id])}}">
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

                    <div
                        style="width:100%; padding: 10px 10px 20px 10px; display:flex; justify-content: flex-end; align-items: flex-end; margin-bottom: 20px;">
                        <div> @php echo $unitUsaha->links('pagination::bootstrap-4'); @endphp </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection