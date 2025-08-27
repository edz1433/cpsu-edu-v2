@extends('web.layouts.mainlayout')
@section('content')
@php
$current_route = request()->route()->getName();
@endphp
<!--====== PAGE BANNER PART START ======-->
<section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="7" style="background-image: url({{ asset('Uploads/default-thumbnail.png') }})">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-banner-cont">
					<h2>{{ $subcontent->title  }}</h2>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">{{ $subcontent->title  }}</a></li>
						</ol>
					</nav>
				</div>  <!-- page banner cont -->
			</div>
		</div> <!-- row -->
	</div> <!-- container -->
</section>
<section id="corses-singel" class="pt-40 pb-120" style="background-image: url('{{ asset('images/bg-article.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 30px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				@php
					// Use default if no thumbnail
					$thumbnail = $subcontent->thumbnail 
						? $subcontent->thumbnail 
						: 'default-thumbnail.png';

					// Explode images if present
					$images = $subcontent->images 
						? explode(',', $subcontent->images) 
						: [];

					// Only include thumbnail if it's not the default
					$allImages = $subcontent->thumbnail && $subcontent->thumbnail !== 'default-thumbnail.png'
						? array_merge([$subcontent->thumbnail], $images)
						: $images;

					// If no images at all, add default image
					if (empty($allImages)) {
						$allImages[] = 'default-thumbnail.png';
					}

					// Load HTML content using Laravel Storage
					use Illuminate\Support\Facades\Storage;

					$content = '';
					if ($subcontent->content && Storage::disk('public')->exists('Uploads/Submenu/content/' . $subcontent->content)) {
						$content = Storage::disk('public')->get('Uploads/Submenu/content/' . $subcontent->content);
					} else {
						$content = '<p>Content not available.</p>';
					}
				@endphp

				<p>{!! $content !!}</p>
			</div>
		</div> <!-- row -->
	</div>
</section>
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.tab-pane');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('show', 'active');
            if (i === index) {
                slide.classList.add('show', 'active');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }
</script>
@endsection
