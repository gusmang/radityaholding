<div class="col-md-12 col-12 div_display_unit" id="div_tab_detail2" style="padding:0 0 30px 0; margin: 0; overflow: hidden;">
    {{-- <div>
        <div style="float: right;">
            <select name="cmb-status-progress" id="cmb-status-progress" onchange="getStatusProgress(this)" style="width: 150px; padding: 10px;">
                <option value="1">Semua Status</option>
                <option value="2">On Approve</option>
            </select>
        </div>
    </div>
    <br clear="all" /> --}}
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
                                    <h5 style="font-size: 14px; font-weight: normal; letter-spacing: 1px;">
                                        {{ app('App\Helpers\Date')->hari_tanggal_waktu($row->created_at , true) }}
                                    </h5>
                                </div>

                                <div class="mt-4">
                                    <h5 style="font-size: 10px; font-weight: normal; letter-spacing: 1px; text-align: right;">
                                        Last Update : {{ app('App\Helpers\Date')->hari_tanggal_waktu($row->tanggal , true) }}
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
                                {{ substr(strip_tags(html_entity_decode($row->detail)),0,200)." ..." }}
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
                                    <a href="{{route('detailPengadaan',['index'=> $row->pid])}}">
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
                            <div style="text-align: center;">
                                Menunggu persetujuan <br />
                                <b style="font-size: 16px;"> ~ {{ $row->next_verifikator }} ~ </b>
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