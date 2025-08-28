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
					<h2>{{ $sublink->title  }}</h2>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">{{ $sublink->title  }}</a></li>
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
			<div class="col-lg-1"></div>
			<div class="col-lg-10">
					<p>
						@php
							$content = file_get_contents('Uploads/Sublink/content/' . $sublink->content);

							// Replace both 'view-content' and 'view-sublink-content' with 'sublink'
							$content = str_replace(
								[url('view-content'), url('view-sublink-content')],
								url('/sublink'),
								$content
							);
						@endphp

						{!! $content !!}
					</p>
				</div>
			</div>
			<div class="col-lg-1"></div>
		</div> 
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
