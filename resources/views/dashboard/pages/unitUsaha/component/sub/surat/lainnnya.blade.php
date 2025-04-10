<div class="div_display_unit_sub" id="table_surat_lainnya" style="display: none;">
    <table class="table stripe hover nowrap">
        <thead style="background: #F5F5F5; height: 60px;">
            <tr>
                <th>Prioritas</th>
                <th class="table-plus datatable-nosort">Role</th>
                <th>Unit Bisnis</th>
                <th>Aktif</th>
                <th>Tugas</th>
                <th class="datatable-nosort"></th>
            </tr>
        </thead>
        <tbody>
            @php
            $an = 0;
            @endphp
            @foreach($users_pengadaan_lainnya as $row)
            @php
            $an++;
            @endphp
            <tr>
                <td>
                    <input type="hidden" id={{ "id_role_pengadaan_lainnya_".$an }} name={{ "id_role_pengadaan_lainnya_".$an }}
                        class="form-control" value="{{ $row->id }}" style="width: 70px!important;" />
                    <input type="number" id={{ "role_pengadaan_lainnya_".$an }} name={{ "role_pengadaan_lainnya_".$an }}
                        class="form-control" value="{{ $row->urutan }}" style="width: 70px!important;" />
                </td>
                <td class="table-plus">
                    @php
                    echo $row->name
                    @endphp
                </td>
                <td>
                    <?php echo $unitUsaha->name; ?>
                </td>
                <td>
                    <label class="switch">
                        <?php
                        if ($row->aktif == "1") {
                        ?>
                            <input type="checkbox" class="switch-input" value="1" checked
                                id={{ "checked_role_lainnya_".$an }} name={{ "checked_role_lainnya_".$an }}>
                        <?php
                        } else {
                        ?>
                            <input type="checkbox" class="switch-input" value="1" id={{ "checked_role_lainnya_".$an }}
                                name={{ "checked_role_lainnya_".$an }}>
                        <?php
                        }
                        ?>

                        <span class="switch-slider"></span>
                    </label>
                </td>
                <td>
                    <select class="form-control" id={{ "scLainnya_role_pengadaan_lainnya_".$an }}
                        name={{ "scLainnya_role_pengadaan_lainnya_".$an }}>
                        <option value="0"> Mengajukan </option>
                        <option value="1" {{ $row->menyetujui === 1 ? "selected" : "" }}> Menyetujui </option>
                    </select>
                </td>
                <!-- <td>
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown">
                        <i class="dw dw-more"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bd-password-modal-lg">
                            <i class="dw dw-lock"></i> Ganti Password
                        </a>
                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                    </div>
                </div>
            </td> -->
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="disabled-button">
        <button class="btn btn-primary disabled-btn" type="submit" style="margin-left: 20px; margin-top: 20px;">
            <i class="fas fa-spinner fa-spin"></i>&nbsp; Please Wait ...
        </button>
    </div>

    <div class="shows-button">
        <button class="btn btn-primary" type="submit" style="margin-left: 20px; margin-top: 20px;">
            <i class="fa fa-edit"></i>&nbsp; Update Role
        </button>
    </div>
</div>