@section('header')
<header class="ttr-header custom-header">
    <div class="ttr-header-wrapper">
        <!--sidebar menu toggler start -->
        <div class="ttr-toggle-sidebar ttr-material-button">
            <i class="ti-close ttr-open-icon"></i>
            <i class="ti-menu ttr-close-icon"></i>
        </div>
        <!--sidebar menu toggler end -->
        <!--logo start -->
        <div class="ttr-logo-box">
            <div>
                <a href="index.html" class="ttr-logo">
                    <img class="ttr-logo-mobile" alt="" src="{{ asset('assets-admin/images/logo-header.png') }}" width="230" height="30">
                    <img class="ttr-logo-desktop" alt="" src="{{ asset('assets-admin/images/logo-header.png') }}" width="430" height="50">
                </a>
            </div>
        </div>
        <div class="ttr-header-right ttr-with-seperator">
            <!-- header right menu start -->
            <ul class="ttr-header-navigation">
                <li>
                    <a href="#" class="ttr-material-button ttr-submenu-toggle"><span class="ttr-user-avatar"><img alt="" src="{{ asset('assets/images/CPSU_L.png') }}" width="32" height="32"></span></a>
                    <div class="ttr-header-submenu">
                        <ul>
                            <li><a href="user-profile.html">My profile</a></li>
                            <li><a href="{{ route('admin-logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!-- header right menu end -->
        </div>
        <!--header search panel start -->
        <div class="ttr-search-bar">
            <form class="ttr-search-form">
                <div class="ttr-search-input-wrapper">
                    <input type="text" name="qq" placeholder="search something..." class="ttr-search-input">
                    <button type="submit" name="search" class="ttr-search-submit"><i class="ti-arrow-right"></i></button>
                </div>
                <span class="ttr-search-close ttr-search-toggle">
                    <i class="ti-close"></i>
                </span>
            </form>
        </div>
        <!--header search panel end -->
    </div>
</header>
@endsection