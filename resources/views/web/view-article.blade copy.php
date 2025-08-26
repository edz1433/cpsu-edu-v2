
@extends('web.layouts.mainlayout')
@section('content')
<div class="page-content bg-white">
	<div class="page-banner ovbl-dark" style="background-image:url({{ $article->thumbnail == '' ? asset('Uploads/default-thumbnail.png') : asset("Uploads/News/thumbnail/{$article->thumbnail}") }}); margin-top: 10%;">
		<div class="container">
			<div class="page-banner-entry">
				{{-- <h1 class="text-white">{{$article->title}}</h1> --}}
			 </div>
		</div>
	</div>
	<div class="content-block">

		<!-- Popular Courses -->
		<div class="section-area section-sp2 popular-courses-bx" style="margin-top: -60px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-7 col-sm-12">
						<div class="courses-post">
							<div class="ttr-post-info">
								<div class="ttr-post-title ">
									<h3 class="post-title">{{$article->title}}</h3>
								</div>
								<div class="ttr-post-text text-justify article-content">
									<p>
										@php $content = file_get_contents('Uploads/News/content/'.$article->content); @endphp
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