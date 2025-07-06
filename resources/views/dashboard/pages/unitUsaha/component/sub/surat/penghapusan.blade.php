<div class="div_display_unit_sub" id="table_surat_penghapusan" style="display: none;">
    <table class="table stripe hover nowrap">
        <thead style="background: #F5F5F5; height: 60px;">
            <tr>
                <th>Prioritas</th>
                <th class="table-plus datatable-nosort">Role</th>
                <th>Unit Bisnis</th>
                <th>Aktif</th>
                <th>Tugas</th>
                <th>Tolak</th>
                <th>Tanda Tangan</th>
                <th class="datatable-nosort"></th>
            </tr>
        </thead>
        <tbody>
            @php
            $an = 0;
            @endphp
            @foreach($users_pengadaan_penghapusan as $row)
            @php
            $an++;
            @endphp
            <tr>
                <td>
                    <input type="hidden" id={{ "id_role_pengadaan_penghapusan_".$an }} name={{ "id_role_pengadaan_penghapusan_".$an }}
                        class="form-control" value="{{ $row->id }}" style="width: 70px!important;" />
                    <input type="number" id={{ "role_pengadaan_penghapusan_".$an }} name={{ "role_pengadaan_penghapusan_".$an }}
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
                                id={{ "checked_role_penghapusan_".$an }} name={{ "checked_role_penghapusan_".$an }}>
                        <?php
                        } else {
                        ?>
                            <input type="checkbox" class="switch-input" value="1" id={{ "checked_role_penghapusan_".$an }}
                                name={{ "checked_role_penghapusan_".$an }}>
                        <?php
                        }
                        ?>

                        <span class="switch-slider"></span>
                    </label>
                </td>
                <td>
                    <select class="form-control" id={{ "scpenghapusan_role_pengadaan_penghapusan_".$an }}
                        name={{ "scpenghapusan_role_pengadaan_penghapusan_".$an }}>
                        <option value="0"> Mengajukan </option>
                        <option value="1" {{ $row->menyetujui === 1 ? "selected" : "" }}> Menyetujui </option>
                    </select>
                </td>
                <td>
                    <label class="switch">
                        <?php
                        if ($row->rj == "1") {
                        ?>
                            <input type="checkbox" class="switch-input" value="1" checked
                                id={{ "checked_role_rj_pengadaan_".$an }} name={{ "checked_role_rj_pengadaan_".$an }}>
                        <?php
                        } else {
                        ?>
                            <input type="checkbox" class="switch-input" value="1" id={{ "checked_role_rj_pengadaan_".$an }}
                                name={{ "checked_role_rj_pengadaan_".$an }}>
                        <?php
                        }
                        ?>

                        <span class="switch-slider"></span>
                    </label>
                </td>
                <td>
                    <label class="switch">
                        <?php
                        if ($row->is_menyetujui == "1") {
                        ?>
                            <input type="checkbox" class="switch-input" value="1" checked
                                id={{ "checked_role_is_mt_pengadaan_".$an }} name={{ "checked_role_is_mt_pengadaan_".$an }}>
                        <?php
                        } else {
                        ?>
                            <input type="checkbox" class="switch-input" value="1" id={{ "checked_role_is_mt_pengadaan_".$an }}
                                name={{ "checked_role_is_mt_pengadaan_".$an }}>
                        <?php
                        }
                        ?>

                        <span class="switch-slider"></span>
                    </label>
                </td>
                <td>
                    <button class="btn btn-danger" type="button" onclick="deleteRole({{ $row->id }}, 'pengadaan')"><i class="fa fa-trash"></i></button>
                </td>
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