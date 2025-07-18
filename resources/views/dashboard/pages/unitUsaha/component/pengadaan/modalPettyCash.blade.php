<div class="modal fade bs-example-modal-lg" id="bd-role-pettycash-modal-lg" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form method="post" id="formRolePettyCashNew" name="formRolePettyCashNew" class="formRolePettyCashNew">
        @csrf
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tambah Role Petty Cash
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-12 mt-2">
                                <label class="required-label"> Organisasi </label>
                                <div>
                                    <select class="form-control" name="pid_role_unit_usaha" id="pid_role_unit_usaha_ptc"
                                        required>
                                        <option value="1">Unit Usaha</option>
                                        <option value="0">Holding</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Nama Role </label>
                                <div>
                                    <input type="hidden" name="role_status" id="role_status" value="3" />
                                    <input type="hidden" class="form-control" value="{{ $unitUsaha->id }}"
                                        name="pt_id_usaha" id="pt_id_usaha" placeholder="Input Index ..." required />
                                    <!-- <select class="select-field" style="width: 100%;" name="pt_id_role" id="pt_id_role">
                                        <option value="">- Pilih Posisi -</option>
                                    </select> -->
                                    <select class="form-control" style="width: 100%;" name="pt_id_role" id="pt_id_rol_ptc">
                                        <?php
                                        foreach ($roleList as $rows) {
                                        ?>
                                            <option value="<?php echo $rows->role_id; ?>"><?php echo $rows->role; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Prioritas </label>
                                <div>
                                    <input type="number" id="cmb-pty-prioritas" name="cmb-pty-prioritas" class="form-control" value="{{ !isset($lastNumPengadaan->urutan) ? 1 : $lastNumPengadaan->urutan+1 }}" />
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Tanda Tangan </label>
                                <div>
                                    <select class="form-control" name="pty_ttd_unit_usaha" id="pid_ttd_unit_usaha"
                                        required>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Tolak Berkas </label>
                                <div>
                                    <select class="form-control" name="pty_tolak_unit_usaha" id="pid_tolak_unit_usaha"
                                        required>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="required-label"> Tugas </label>
                                <div>
                                    <select class="form-control" name="pty_menyetujui_unit_usaha" id="pid_menyetujui_unit_usaha"
                                        required>
                                        <option value="0">Mengajukan</option>
                                        <option value="1">Menyetujui</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="1"
                                        name="pd_chk_aktif" id="pd_chk_aktif">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"> Aktif </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outlined" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>