@extends('web.layouts.mainlayout')
@section('content')
@php
    $current_route = request()->route()->getName();
@endphp
<style>
	.fixed-slider {
    min-height: 100vh;
    max-height: 100vh;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    overflow: hidden;
}
#slider-part,
.single-slider {
    width: 100%;
    height: 100vh;
    position: relative;
    overflow: hidden;
}

/* Make the video cover the entire container */
.video-background {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    transform: translate(-50%, -50%);
    object-fit: cover;
    z-index: -1; /* Keeps it behind content if any */
}

</style>
<!--====== SLIDER PART START ======-->
<section id="slider-part" class="slider-active">
    <!-- Welcome Slide with video -->
    <div class="single-slider bg_cover d-flex align-items-start fixed-slider position-relative slider-intro">
        <video autoplay muted loop playsinline class="video-background">
            <source src="{{ asset('Uploads/Videos/banner_video.mp4') }}" type="video/mp4">
            {{-- Your browser does not support the video tag. --}}
        </video>
    </div>

	<div class="single-slider bg_cover d-flex align-items-start fixed-slider position-relative" style="background-image: url('{{ asset('Uploads/page-banner/banner-1.jpg') }}');" >
		<div class="container">
			<div class="row">
				<div class="col-xl-7 col-lg-9">
					<div class="slider-cont">
						<!-- Optional article content -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="single-slider bg_cover d-flex align-items-start fixed-slider position-relative" style="background-image: url('{{ asset('Uploads/page-banner/banner-2.jpg') }}');" >
		<div class="container">
			<div class="row">
				<div class="col-xl-7 col-lg-9">
					<div class="slider-cont">
						<!-- Optional article content -->
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="single-slider bg_cover d-flex align-items-start fixed-slider position-relative" style="background-image: url('{{ asset('Uploads/page-banner/banner-3.jpg') }}');" >
		<div class="container">
			<div class="row">
				<div class="col-xl-7 col-lg-9">
					<div class="slider-cont">
						<!-- Optional article content -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="single-slider bg_cover d-flex align-items-start fixed-slider position-relative" style="background-image: url('{{ asset('Uploads/page-banner/banner-4.jpg') }}');" >
		<div class="container">
			<div class="row">
				<div class="col-xl-7 col-lg-9">
					<div class="slider-cont">
						<!-- Optional article content -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="single-slider bg_cover d-flex align-items-start fixed-slider position-relative" style="background-image: url('{{ asset('Uploads/page-banner/banner-5.jpg') }}');" >
		<div class="container">
			<div class="row">
				<div class="col-xl-7 col-lg-9">
					<div class="slider-cont">
						<!-- Optional article content -->
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

<section id="course-part" class="pt-115 pb-120 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title pb-45">
                    <h5>Our News</h5>
                    <h2>Featured News</h2>
                </div>
            </div>
        </div>
         
		<div class="row course-slied mt-10">
			@foreach($article as $art)
				@php
					$date   = date("M d, Y", strtotime($art->created_at));
					$title  = strip_tags($art->title); // ✅ Strip tags first
					$artid  = $art->id;

					// ✅ Normalize title
					if (class_exists('Normalizer')) {
						$title = Normalizer::normalize($title, Normalizer::FORM_KC);
					} elseif (function_exists('transliterator_transliterate')) {
						$title = transliterator_transliterate('NFKC', $title);
					}
					$title = preg_replace('/\p{Cf}/u', '', $title);

					// ✅ Thumbnail (fallback if missing)
					$image = !empty($art->thumbnail) 
						? asset("Uploads/News/thumbnail/{$art->thumbnail}") 
						: asset("Uploads/default-thumbnail.png");

					// ✅ Content file path in public folder
					$contentFilePath = public_path("Uploads/News/content/{$art->content}");
					$maxWords = 25;
					$excerpt  = 'Content not available';

					if (!empty($art->content) && file_exists($contentFilePath)) {
						$text = strip_tags(file_get_contents($contentFilePath));
						$words = preg_split('/\s+/', $text);

						if (count($words) > $maxWords) {
							$excerpt = implode(' ', array_slice($words, 0, $maxWords)) . '...';
							$excerpt .= ' <a href="' . route('view-article', ['id' => $artid]) . '" style="color: #28a745; text-decoration: none;">Read More</a>';
						} else {
							$excerpt = $text;
						}
					}
				@endphp

				<div class="col-lg-4">
					<div class="singel-course mt-30">
						<div class="thum">
							<div class="image">
								<img src="{{ $image }}" alt="Article Thumbnail">
							</div>
						</div>
						<div class="cont">
							<hr>
							<small><i class="fa fa-calendar"></i> {{ $date }}</small>
							<a href="{{ route('view-article', ['id' => $artid]) }}">
								<h4>{{ $title }}</h4>
							</a>
							<p style="text-align: justify;">{!! $excerpt !!}</p>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		<div class="row mt-3">
            <div class="col-12 text-center">
                <button id="load-more" class="btn btn-outline-success px-4 py-2">
                    <i class="fa fa-refresh"></i> More News
                </button>
            </div>
        </div>
    </div> 
</section>

<section id="about-page" class="pt-70 pb-110 bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="about-image mt-50 hover-effect">
					<a href="{{ route('academic-calendar') }}">
						<img src="{{ asset('images/academic calendar.jpg') }}" alt="About">
					</a>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="about-image hover-effect">
					<a href="{{ route('jobList') }}">
						<img src="{{ asset('images/hiring logo.png') }}" alt="About">
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="testimonial" class="pt-115 pb-115" style="background: url('{{ asset('images/s-12.jpg') }}') no-repeat center center; background-size: cover;">
    <div class="container">
        <div class="hive-container">
            <div class="row-hive row1">
                <div class="hex planning transparent"><div><h4></h4><span></span></div></div>
                <div class="hex qs"><div><h4></h4><span></span></div></div>
                <div class="hex audit transparent"><div><h4></h4><span></span></div></div>
            </div>
            <div class="row-hive offset">
                <div class="hex admin transparent"><div><h4></h4><span></span></div></div>
                <div class="hex the"><div><h4></h4><span></span></div></div>
                <div class="hex uigreen"><div><h4></h4><span></span></div></div>
                <div class="hex rnd transparent"><div><h3>CPSU SECURES 105TH SPOT IN THE WURI RANKING 2025</h3><span></span></div></div>
            </div>
            <div class="row-hive row3">
                <div class="hex" style="background-image: url('https://development.cpsu.edu.ph/images/cpsu-iso.png');">
					<div><h4></h4><span></span></div>
				</div>
                <div class="hex it transparent"><div><h4></h4><span></span></div></div>
                <div class="hex wuri"><div><h4></h4><span></span></div></div>
            </div>
        </div>
    </div>
</section>

<div id="patnar-logo" class="pt-40 pb-80 gray-bg">
    <div class="container">
        <div class="row patnar-slied justify-content-center">
            @for ($i = 1; $i <= 7; $i++)
                <div class="col-auto logo-col">
                    <div class="singel-patnar text-center">
                        <img src="{{ asset('images/patnar-logo/' . $i . '.png') }}" alt="Logo" class="patnar-img small-logo	">
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

@endsection
