<!DOCTYPE html>
<html>

@include("dashboard.global.header")

<body>
    {{-- <a href="https://wa.me/6282146335793?text=Halo%20Marcel,%20saya%20membutuhkan%20bantuan%20mengenai" target="_blank">
        <div class="call-to-action-wa">
            <div> <i class="fab fa-whatsapp" style="font-size: 24px; color: #FFFFFF;"></i>  </div>
                <div style="color: #FFFFFF; margin-left: 10px;"> Bantuan </div>
        </div>
    </a> --}}
    @if(session()->has('errors') && session('errors')->has('419'))
        <div class="alert alert-danger">
            Your session has expired. Please refresh the page and try again.
        </div>
    @endif
    <a href="https://wa.me/6282146335793" target="_blank">
        <div class="call-to-action-wa">
            <div> <i class="fab fa-whatsapp" style="font-size: 24px; color: #FFFFFF;"></i>  </div>
                <div style="color: #FFFFFF; margin-left: 10px;"> Bantuan </div>
        </div>
    </a>
    @include("dashboard.global.top")

    @include("dashboard.global.sidebar")
    <div class="mobile-menu-overlay"></div>

    @yield("content")
    <!-- welcome modal start -->
    @include("dashboard.global.welcomeModal")
    @include("dashboard.global.footerScript")
    <!-- welcome modal end -->
    @yield("footer_scripts")
    @yield("footer_modals")
    @yield("footer_modals_rs_password_ptc")
    @yield("footer_modals_pengguna")
    @yield("footer_modals_pembayaran")
    @yield("footer_modals_pettyCash")
    @yield('footer_modals_pettyCashEdit')
    @yield("footer_endMenu_section")
    @yield("footer_modals_holding")
    @yield("footer_modals_unit")
    @yield("footers_suratList")
    @yield("footer_laporan")
    @yield("footer_dashboard")
    @yield("footer_pengadaan_tab")

    <!-- Pengadaan -->
    @yield("footer_add_pengadaan")
    @yield("footer_add_pettycash")
    @yield("footer_add_pengaturan")
    @yield("footer_add_profiles")
    @yield("footer_modals_users_edit")
</body>

</html>