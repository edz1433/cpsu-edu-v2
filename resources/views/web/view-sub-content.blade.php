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

					// Load and clean HTML content
					$content = file_get_contents('Uploads/Submenu/content/' . $subcontent->content);
					// $content = preg_replace('/<img\b[^>]*>(?:<\/img>)?/i', '', $content);
				@endphp

				{{-- <div class="corses-singel-left" style="background-color: transparent !important;">
					<div class="image-slider-container">
						<i class="slider-arrow arrow-left fa fa-chevron-left" onclick="prevSlide()"></i>

						<div class="tab-content" id="pills-tabContent">
							@foreach ($allImages as $index => $image)
								@php
									$isDefault = $image === 'default-thumbnail.png';
									$imagePath = $isDefault
										? asset('Uploads/' . $image)
										: ($index === 0 && !$isDefault
											? asset('Uploads/Submenu/thumbnail/' . $image)
											: asset('Uploads/Submenu/images/' . $image));

									$tabId = 'pills-image-' . ($index + 1);
									$active = $index === 0 ? 'show active' : '';
								@endphp
								<div class="tab-pane fade {{ $active }}" id="{{ $tabId }}" role="tabpanel" aria-labelledby="{{ $tabId }}-tab">
									<div class="shop-image">
										<a href="{{ $imagePath }}" class="shop-items">
											<img src="{{ $imagePath }}" alt="Shop">
										</a>
									</div>
								</div>
							@endforeach
						</div>

						<i class="slider-arrow arrow-right fa fa-chevron-right" onclick="nextSlide()"></i>
					</div> --}}

					<p>{!! $content !!}</p>
				</div>
			</div>
			{{-- <div class="col-lg-4">
				<div class="row">
					<div class="col-lg-12 col-md-6">
						<div class="course-features" style="background-color: transparent !important;">
							<h4>RECENT NEWS</h4>

							@foreach ($articles->take(10) as $art)
								<p>
									<a href="{{ route('view-article', ['id' => $art->id]) }}" style="color: inherit; text-decoration: none;">
										{{ $art->title }}
									</a>
								</p><br>
							@endforeach

						</div> <!-- course features -->
					</div>
				</div>
			</div> --}}
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
