<table class="table stripe hover nowrap div_display_unit_sub" id="table_surat_reguler">
    <thead style="background: #F5F5F5; height: 60px;">
        <tr>
            <th>Prioritas</th>
            <th class="table-plus datatable-nosort">Role</th>
            <th>Unit Bisnis</th>
            <th>Nama Unit Bisnis</th>
            <th>Status</th>
            <th>Tanda Tangan</th>
            <th class="datatable-nosort"></th>
        </tr>
    </thead>
    <tbody>
        @php
        $an = 0;
        @endphp
        @foreach($users_pengadaan as $row)
        @php
        $an++;
        @endphp
        <tr>
            <td>
                <input type="hidden" id={{ "id_role_pengadaan_".$an }} name={{ "id_role_pengadaan_".$an }}
                    class="form-control" value="{{ $row->id }}" style="width: 70px!important;" />
                <input type="number" id={{ "role_pengadaan_".$an }} name={{ "role_pengadaan_".$an }}
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
                    <input type="checkbox" class="switch-input" value="1" checked id={{ "checked_role_pengadaan_".$an }}
                        name={{ "checked_role_pengadaan_".$an }}>
                    <?php
                    } else {
                    ?>
                    <input type="checkbox" class="switch-input" value="1" id={{ "checked_role_pengadaan_".$an }}
                        name={{ "checked_role_pengadaan_".$an }}>
                    <?php
                    }
                    ?>

                    <span class="switch-slider"></span>
                </label>
            </td>
            <td>
                <select name="" class="form-control">
                    <option> Ya </option>
                </select>
            </td>
            <td>
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
            </td>
        </tr>
        @endforeach
    </tbody>
</table>