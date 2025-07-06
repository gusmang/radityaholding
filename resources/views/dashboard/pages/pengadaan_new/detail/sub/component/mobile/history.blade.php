<div class="row" style="margin-top: -80px;">
    <div class="col-md-8 col-12">
        <div class="card-box mb-20" style="padding: 10px;">
            
            <div class="timeliner">
                <div class="container">
                    <div class="wrapper">
                        <div style="float:left; width: 50px; height: 50px;">
                            <div class="container-icon"></div>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="float:left;">
                            <h5 style="color: #555555; font-weight: normal;"> Approval History </h5>
                            <div style="clear: both;"></div>
                        </div>
                    <div style="clear: both;"></div>
                    <ul class="sessions">
                        @foreach($historyPengadaan as $appr)
                        <li>
                        <div class="time">{{ app('App\Helpers\Date')->tanggal_waktu($appr->updated_at , true) }}</div>
                        <p><b>{{ $appr->title }}</b></p>
                        <p style="font-size: 12px;">{{ $appr->note ? $appr->note : "-" }}</p>
                        </li>
                        @endforeach
                    </ul>
                    </div>
                </div> 
            </div>

        </div>
    </div>
</div>