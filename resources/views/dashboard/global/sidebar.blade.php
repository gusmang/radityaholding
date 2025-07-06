@php
$segment = Request::segment(2);
@endphp
<div class="left-side-bar">
    <div style="height: 100%; position: relative;">

        <div class="brand-logo">
            {{-- <a href="index.html">
            <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
            <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo" />
        </a> --}}
            <div style="display: flex; flex-direction: center; align-items: center; height: 70px;">
                <a href="javascript::void(0)" style="margin: auto;">
                    <img src="{{ asset('vendors/images/big_logo.png') }}" alt="logo-raditya" style="height: 40px;" />
                </a>
            </div>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll" style="position: relative;">

            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    @php
                    $positions = session('positions');
                    $menu1 = $positions == "-1" ? session('accessAll1') : session('access1');
                    $menu2 = $positions == "-1" ? session('accessAll2') : session('access2');
                    @endphp
                    @foreach($menu1 as $rows)
                    <li>
                        <a href="{{ route($rows->url,['index'=> '1']) }}"
                            class="dropdown-toggle no-arrow {{ $segment == $rows->url ? 'active' : '' }}">
                            <span class="{{ $rows->icon }}"></span><span class="mtext">{{ $rows->nama }}</span>
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <div class="sidebar-small-cap">Extra</div>
                    </li>
                    <li class="dropdown">
                        @foreach($menu2 as $rows)
                    <li>
                        <a href="{{ route($rows->url,['index'=> '1']) }}"
                            class="dropdown-toggle no-arrow {{ $segment == $rows->url ? 'active' : '' }}">
                            <span class="{{ $rows->icon }}"></span><span class="mtext">{{ $rows->nama }}</span>
                        </a>
                    </li>
                    @endforeach
                    </li>
                </ul>
            </div>

        </div>
        {{-- <div style="position: absolute; z-index: 1; bottom: 30px; width: 80%; left: 0; right: 0; margin: auto;">
            <div
                style="width: 100%; display: flex; box-shadow:0 0 1px 1px #EEEEEE; height: 60px; background: #FDFDFD; padding: 10px; border-radius: 10px;">
                <div class="col-12" style="margin:0; padding: 0;">
                    <div class="row">
                        <div class="col-2">
                            <div
                                style="width: 35px; height: 35px; border-radius: 50%; background: #DDDDDD; margin-right: 15px;">
                            </div>
                        </div>
                        <div class="col-8">
                            <div style="padding:0 5px;">
                                <div style="margin-top: -5px;">
                                    <b style="font-size: 12px;"> {{ substr(Auth::user()->name, 0 , 10).".." }} </b>
                                    <div style="font-size: 11px;"> {{ substr(Auth::user()->role, 0 , 10).".." }} </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-1"
                            style="text-align: left; display: flex; align-items:center; justify-content: center;">
                            <a href="{{ route('profile-edit')}}"> <i class="fa fa-edit" style="font-size: 18px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>