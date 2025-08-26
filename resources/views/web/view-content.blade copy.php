
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
	@if($submen->id != 31)
		<div class="page-banner ovbl-dark" style="background-image:url({{ $submen->thumbnail == '' ? asset('Uploads/default-thumbnail.png') : asset("Uploads/Submenu/thumbnail/{$submen->thumbnail}") }}); margin-top: 10%;">
			<div class="container">
				<div class="page-banner-entry">
					<h1 class="text-white">{{$submen->title}}</h1>
				</div>
			</div>
		</div>
	@else
		<div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 50%; overflow: hidden;">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="{{ asset('Uploads/page-banner/8.jpg') }}" class="d-block w-100 img-responsive" alt="First Slide" style="object-fit: cover; width: 100%; height: 100%;">
				</div>
				<div class="carousel-item">
					<img src="{{ asset('Uploads/page-banner/6.png') }}" class="d-block w-100 img-responsive" alt="Second Slide" style="object-fit: cover; width: 100%; height: 100%;">
				</div>
				<div class="carousel-item">
					<img src="{{ asset('Uploads/default-thumbnail.png') }}" class="d-block w-100 img-responsive" alt="Third Slide" style="object-fit: cover; width: 100%; height: 100%;">
				</div>
			</div>
			<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	@endif
	
	<div class="breadcrumb-row">
		<div class="container-custom">
			<ul class="list-inline">
				<li><a href="#">Home</a></li>
				<li>{{ $submen->cat_name }}</li>
			</ul>
		</div>
	</div>
	<div class="content-block">

		<!-- Popular Courses -->
		<div class="section-area section-sp2 popular-courses-bx" style="margin-top: -60px;">
			<div class="container-custom">
				<div class="row">
					<div class="col-lg-8 col-md-7 col-sm-12">
						<div class="courses-post">
							<div class="ttr-post-info">
								<div class="ttr-post-title text-center">
									<h3 class="post-title" style="font-size: 25px">{{$submen->title}}</h3>
								</div>
								<div class="ttr-post-text text-justify article-content">
									<p>
										@php $content = file_get_contents('Uploads/Submenu/content/'.$submen->content); @endphp
										{!! $content !!}
									</p>
								</div>
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