@section('header')
<!--====== HEADER PART START ======-->
<header id="header-part">        
    {{-- <div class="navigation {{ request()->is('/') ? 'navigation-2 navigation-3' : '' }}"> --}}
        <div class="navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-md-11 col-sm-9 col-8">
                    <nav class="navbar navbar-expand-lg navigation">
                        <a class="navbar-brand" href="{{ url('/') }}" style="width: 100px; padding-right: 15px;">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="wrap-submenu">
                                <ul class="navbar-nav mr-auto">

                                    <!-- About -->
                                    <li class="nav-item">
                                        <a class="" href="#">About <i class="fa fa-chevron-right fa-xs submenu-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li>
                                                <strong>University Info</strong>
                                                <ul>
                                                    <!-- <li><a href="{{ route('view-sub-content', 5) }}">The Story of CPSU</a></li> -->
                                                    <li><a href="{{ route('vgmo') }}">Vision, Mission, and Goals</a></li>
                                                    <!-- <li><a href="#">Quality Policy</a></li> -->
                                                    <!-- <li><a href="#">Awards and Citations</a></li> -->
                                                    <li><a href="{{ route('view-sub-content', 43) }}">Calendar of Activities</a></li>
                                                    <li><a href="{{ route('history') }}">History</a></li>
                                                    <li><a href="{{ route('view-sub-content', 39) }}">Mandate</a></li>
                                                    <li><a href="{{ route('view-sub-content', 37) }}">Profile</a></li>
                                                </ul>
                                            </li>

                                            <li>
                                                <strong>Leadership & Governance</strong>
                                                <ul>
                                                    <li><a href="{{ route('view-sublink-content', 79) }}">Transparency Seal</a></li>
                                                    <li><a href="{{ route('view-sub-content', 41) }}">Board of Regents</a></li>                                                    
                                                    <!-- <li><a href="#">Career Opportunities</a></li> -->
                                                    <!-- <li><a href="#">Campus Map</a></li> -->
                                                    <li><a href="{{ route('view-sub-content', 38) }}">Key Officials</a></li>
                                                    <li><a href="#">News & Events</a></li>
                                                    <!-- <li><a href="#">Privacy Policy</a></li> -->
                                                </ul>
                                            </li>

                                            <li>
                                                <strong>Academic</strong>
                                                <ul>
                                                    <li><a href="{{ route('view-sub-content', 16) }}">Academic Council</a></li>
                                                    <li><a href="{{ route('view-sub-content', 10) }}">Academic Updates</a></li>
                                                    <li><a href="{{ route('view-sub-content', 26) }}">Faculty Manual</a></li>
                                                    <li><a href="{{ route('view-sub-content', 21) }}">Graduate School</a></li>
                                                    <li><a href="{{ route('view-sub-content', 23) }}">Guidance Office</a></li>
                                                    <li><a href="{{ route('view-sub-content', 20) }}">Library</a></li>
                                                    <li><a href="{{ route('view-sub-content', 27) }}">Medical-Dental Clinic</a></li>
                                                    <li><a href="{{ route('view-sub-content', 22) }}">Office of the Vice President for Academic Affairs</a></li>
                                                    <li><a href="{{ route('view-sub-content', 18) }}">Program Offerings</a></li>
                                                    <li><a href="{{ route('view-sub-content', 19) }}">Scholarship</a></li>
                                                    <li><a href="{{ route('view-sub-content', 25) }}">Supreme Student Government (SSG) Activities</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Admissions -->
                                    <li class="nav-item">
                                        <a class="" href="#">Admissions <i class="fa fa-chevron-right fa-xs submenu-icon"></i></a>
                                        <ul class="sub-menu has-grid">
                                            <li>
                                                <strong>Start Your CPSU Journey!</strong>
                                                <ul>
                                                    <li><a target="_blank" href="https://ciss.cpsu.edu.ph/portal">Apply</a></li>
                                                    <li><a href="#">Enrollment FAQs</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <strong>Quick Info</strong>
                                                <ul>
                                                    <li><a href="#">Offerings</a></li>
                                                    <li><a href="#">Undergraduate Programs</a></li>
                                                    <li><a href="#">Graduate Programs</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <strong>Cost and Aid</strong>
                                                <ul>
                                                    <li><a href="#">Scholarship Grants</a></li>
                                                    <li><a href="#">Financial Assistance Partnerships</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Campuses -->
                                    <li class="nav-item has-grid">
                                        <a href="#">Campuses <i class="fa fa-chevron-right fa-xs submenu-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li>
                                                <ul>
                                                    <li><a href="#">Hinoba-an Campus</a></li>
                                                    <li><a href="#">Sipalay Campus</a></li>
                                                    <li><a href="#">Cauayan Campus</a></li>
                                                    <li><a href="#">Victorias Campus</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li><a href="#">Candoni Campus</a></li>
                                                    <li><a href="#">Ilog Campus</a></li>
                                                    <li><a href="#">Hinigaran Campus</a></li>
                                                    <li><a href="#">Murcia Campus</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li><a href="#">Moises Padilla Campus</a></li>
                                                    <li><a href="#">Valladolid Campus</a></li>
                                                    <li><a href="#">San Carlos Campus</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Administration -->
                                    <li class="nav-item">
                                        <a class="" href="#">Administration <i class="fa fa-chevron-right fa-xs submenu-icon"></i></a>
                                        <ul class="sub-menu has-grid">
                                            <li>
                                                <ul>
                                                    <li><a href="{{ route('view-sub-content', 8) }}">Administrative Council</a></li>
                                                    <li><a href="{{ route('view-sub-content', 6) }}">Office of the President</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li><a href="{{ route('view-sub-content', 7) }}">Citizen’s Charter</a></li>
                                                    <li><a href="{{ route('view-sub-content', 61) }}">Publication of Vacant Position</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li><a href="{{ route('view-sub-content', 9) }}">Organizational Structure</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- International Affairs -->
                                    <li class="nav-item">
                                        <a href="#">International Affairs <i class="fa fa-chevron-right fa-xs submenu-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li>
                                                <ul>
                                                    <li><a href="{{ route('view-sub-content', 30) }}">Linkages and Partners</a></li>
                                                    <!-- <li><a href="#">Activities</a></li> -->
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li><a href="#">Awards and Distinctions</a></li>
                                                    <li><a href="#">Functional Organizational Structure</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Research and Extension -->
                                    <li class="nav-item">
                                        <a href="#">Research and Extension <i class="fa fa-chevron-right fa-xs submenu-icon"></i></a>
                                        <ul class="sub-menu">
                                            <li>
                                                <ul>
                                                    <li><a href="{{ route('view-sub-content', 34) }}">Extension Services</a></li>
                                                    <li><a href="#">Extension Services Organizational Structure</a></li>
                                                    <!-- <li><a href="{{ route('view-sub-content', 32) }}">Research & Development</a></li> -->
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li><a href="{{ route('view-sub-content', 33) }}">Research Activities</a></li>
                                                    <li><a href="#">Research Organizational Structure</a></li> 
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li><a href="{{ route('view-sub-content', 44) }}">SGD Reports </a></li>
                                                                                                       
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-3">
                    <div class="right-icon text-right">
                        <ul>
                            <li><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--====== HEADER PART ENDS ======-->

<!--====== SEARCH BOX PART START ======-->
<div class="search-box">
    <div class="serach-form">
        <div class="closebtn">
            <span></span>
            <span></span>
        </div>
        <form action="#">
            <input type="text" placeholder="Search by keyword">
            <button><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<!--====== SEARCH BOX PART ENDS ======-->
@endsection
