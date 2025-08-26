@section('sidebar')
@php
    $current_route=request()->route()->getName();
@endphp
<div class="col-lg-4 col-xl-4 col-md-5 sticky-top">
    <aside class="side-bar sticky-top">
        <div class="widget">
            <h6 class="widget-title">Search</h6>
            <div class="search-bx style-1">
                <form role="search" action="{{ route('search-article') }}">
                    <div class="input-group">
                        <input name="s" class="form-control" placeholder="Enter your keywords..." type="text" autocomplete="off">
                        <span class="input-group-btn">
                            <button type="submit" class="fa fa-search text-primary"></button>
                        </span> 
                    </div>
                </form>
            </div>
        </div>
        @if ($current_route != "web-home")
        <div class="widget recent-posts-entry">
            <h6 class="widget-title">Recent Posts</h6>
            <div class="widget-post-bx">
                @foreach ($articles as $art)
                @php $date = date("M d Y", strtotime($art->created_at)); @endphp 
                <div class="widget-post clearfix">
                    <div class="ttr-post-media"> <img src="{{ $art->thumbnail == '' ? asset('Uploads/default-thumbnail.png') : asset("Uploads/News/thumbnail/{$art->thumbnail}") }}"  alt=""> </div>
                    <div class="ttr-post-info">
                        <ul class="media-post">
                            <li><a href="#"><i class="fa fa-calendar"></i>{{ $date }}</a></li>
                        </ul>
                        <div class="ttr-post-header">
                            <h6 class="post-title"><a href="{{ route('view-article', ['id' => $art->id]) }}">{{ $art->title }}</a></h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>            
        @endif
        <div class="widget recent-posts-entry course-detail-bx">
            <h4 class="widget-title">Quick Links</h4>
            <div class="widget widget_archive">
                <ul class="course-features">
                    @php $iconarray = ['fa fa-graduation-cap', 'fa fa-book pr-1', 'fa fa-laptop', 'fa fa-building pr-1']; @endphp

                    @foreach ($submenu as $sub)
                        @if($sub->category == 7)
                            <li>
                                <a href="{{ route('view-content', ['id' => $sub->id]) }}">
                                    @php
                                        $icon = isset($iconarray[0]) ? $iconarray[0] : 'fa fa-list';
                                        // Remove the selected icon from the array to get the next one next time
                                        array_shift($iconarray);
                                    @endphp
                                    <i class="{{ $icon }} madapak mr-2"></i>{{ $sub->title }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                        <li><a href="https://mail.google.com/" target="_blank"><i class="fa fa-envelope madapak"></i>Webmail Access</a></li>
                    
                </ul>
            </div>
            <div class="widget widget_gallery gallery-grid-4">
                <h4 class="widget-title text-dark">Our Gallery</h4>
                <ul class="magnific-image">
                    @foreach ($file as $f)
                        @if ($f->category == "Gallery" && $f->status == 1)
                            <li><a href="{{ asset('Uploads/Files/'.$f->storage.'/'.$f->file_name) }}" class="magnific-anchor"><img src="{{ asset('Uploads/Files/'.$f->storage.'/'.$f->file_name) }}" style="height: 80px; width: 80px;" alt=""></a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @if(isset($sublink->id) && $sublink->id == 84)
            <img src="https://cpsu.edu.ph/files/privacy-seal.png" width="100%" height="350">
            @endif
        </div>
    </aside>
</div>
@endsection