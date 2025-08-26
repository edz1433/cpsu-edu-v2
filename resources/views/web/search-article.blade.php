
@extends('web.layouts.mainlayout')
@include('web.layouts.sidebar')
@section('content')
<style>
    .article-content img {
        max-width: 100%;
        display: block; 
        margin: 10px;
    }
</style>
<div class="page-content bg-white">
	<div class="page-banner ovbl-dark" style="background-image:url({{ asset("Uploads/Submenu/thumbnail/default-thumbnail.png") }}); top: -10px;">
		<div class="container">
			<div class="page-banner-entry">
				<h1 class="text-white">Search Result For : {{ request()->input('s') }}</h1>
			 </div>
		</div>
	</div>
	<div class="breadcrumb-row">
		<div class="container-custom">
			<ul class="list-inline">
				<li><a href="#">Home</a></li>
				<li>Search Article</li>
			</ul>
		</div>
	</div>
	<div class="content-block">

		<!-- Popular Courses -->
		<div class="section-area section-sp2 popular-courses-bx" style="margin-top: -60px;">
			<div class="container-custom">
				<div class="row">
					<div class="col-lg-8 col-md-7 col-sm-12">
						<div class="widget recent-posts-entry">
							<h6 class="widget-title">Search Result</h6>
							<div class="widget-post-bx">
								@foreach ($article as $art)
								@php $date = date("M d Y", strtotime($art->created_at)); @endphp 
								<div class="widget-post clearfix">
									<div class="ttr-post-info mb-0">
										<ul class="media-post ">
											<li><a href="#"><i class="fa fa-calendar"></i>{{ $date }}</a></li>
										</ul>
										<div class="ttr-post-header mb-0">
											<h6 class="post-title"><a href="{{ route('view-article', ['id' => $art->id]) }}">{{ $art->title }}</a></h6>
										</div>
										<div style="height: 100px; overflow-y: hidden;">
											@php
											$contentFilePath = 'Uploads/News/content/'.$art->content; 
											$maxWords = 30;
											$artid = $art->id;
											
											if (file_exists($contentFilePath)) {
												$content = file_get_contents($contentFilePath);
												
												if ($content !== false) {
													$words = explode(' ', $content);
											
													if (count($words) > $maxWords) {
														echo implode(' ', array_slice($words, 0, $maxWords)) . '... <a href="'. route('view-article', ['id' => $artid]) . '" class="pt-btn text-success">Read More</a>';
													} else {
														echo $content;
													}
												} else {
													echo "Error reading the file: $contentFilePath";
												}
											} else {
												echo "File not found: $contentFilePath";
											}
											@endphp
											
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>   
					</div>
					<!-- sideabr -->
					@yield('sidebar')
					<!-- sidebar end -->
				</div>
			</div>
		</div>
	</div>
@endsection