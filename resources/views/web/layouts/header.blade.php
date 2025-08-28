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
                                    @foreach($categories as $cat)
                                        <li class="nav-item text-success {{ $cat->hasgrid ? 'has-grid' : '' }}">
                                            <a href="#" class="">{{ $cat->cat_name }} <i class="fa fa-chevron-right fa-xs submenu-icon"></i></a>
                                            <ul class="sub-menu">
                                                @if($cat->hasgrid == 2)
                                                    {{-- Category has subcategories --}}
                                                    @foreach($subcategories as $subcat)
                                                        @if($subcat->categories_id == $cat->id)
                                                            <li>
                                                                <strong>{{ $subcat->title }}</strong>
                                                                <ul>
                                                                    @foreach($submenu as $submen)
                                                                        @if($submen->subcategory == $subcat->id)
                                                                            <li>
                                                                                <a href="{{ $submen->url ?? route('view-sub-content', $submen->id) }}">
                                                                                    {{ $submen->title }}
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    {{-- Category has direct submenu --}}
                                                        @php $count = 0; @endphp
                                                        @foreach($submenu as $submen)
                                                            @if($submen->category == $cat->id)
                                                                @if($count % 2 == 0)
                                                                    <li><ul>
                                                                @endif

                                                                <li>
                                                                    <a href="{{ $submen->url ?? route('view-sub-content', $submen->id) }}">
                                                                        {{ $submen->title }}
                                                                    </a>
                                                                </li>

                                                                @php $count++; @endphp

                                                                @if($count % 2 == 0)
                                                                    </ul></li>
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                        {{-- Close last group if not multiple of 4 --}}
                                                        @if($count % 2 != 0)
                                                            </ul></li>
                                                        @endif

                                                @endif
                                            </ul>
                                        </li>
                                    @endforeach
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
