<!DOCTYPE html>
<html>

@include("dashboard.global.header")

<body>
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
    @yield("footer_modals_pengguna")
    @yield("footer_modals_pembayaran")
    @yield("footer_endMenu_section")
    @yield("footer_modals_holding")
    @yield("footer_modals_unit")

    <!-- Pengadaan -->
    @yield("footer_add_pengadaan")
    @yield("footer_add_pengaturan")
    @yield("footer_add_profiles")
</body>
</html>
