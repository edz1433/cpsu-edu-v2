@extends('web.layouts.mainlayout')=
@section('content')
@php
$current_route = request()->route()->getName();

// Normalize and extract significant keywords from title
$keywords = collect(explode(' ', strtolower($article->title)))
    ->filter(fn($word) => strlen($word) > 3)
    ->values();

$relatedArticles = $articles
    ->filter(function ($art) use ($keywords, $article) {
        if ($art->id === $article->id) return false;

        // Count how many keywords appear in the title (case-insensitive)
        $titleLower = strtolower($art->title);
        $matchCount = $keywords->filter(fn($keyword) => str_contains($titleLower, $keyword))->count();

        return $matchCount > 0;
    })
    // Rank by number of keyword matches
    ->sortByDesc(function ($art) use ($keywords) {
        $titleLower = strtolower($art->title);
        return $keywords->filter(fn($keyword) => str_contains($titleLower, $keyword))->count();
    })
    ->take(3);
@endphp
<section id="corses-singel" class="pt-40 pb-120" style="background-image: url('{{ asset('images/bg-article.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 30px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				@php
					// Thumbnail URL using storage path (fallback if missing)
					$thumbnail = !empty($article->thumbnail) && file_exists(storage_path("app/public/Uploads/News/thumbnail/{$article->thumbnail}"))
						? asset("storage/Uploads/News/thumbnail/{$article->thumbnail}")
						: asset("storage/Uploads/default-thumbnail.png");

					// Load and clean content
					$contentFilePath = storage_path("app/public/Uploads/News/content/{$article->content}");
					$content = 'Content not available';
					if (!empty($article->content) && file_exists($contentFilePath)) {
						$content = file_get_contents($contentFilePath);
						// Remove all <img> tags
						$content = preg_replace('/<img\b[^>]*>(?:<\/img>)?/i', '', $content);
					}

					// Images
					$images = !empty($article->images) ? explode(',', $article->images) : [];
					$allImages = array_merge([$article->thumbnail], $images);
				@endphp

				<div class="corses-singel-left" style="background-color: transparent !important;">
					<div class="image-slider-container">
						<i class="slider-arrow arrow-left fa fa-chevron-left" onclick="prevSlide()"></i>

						<div class="tab-content" id="pills-tabContent">
							@foreach ($allImages as $index => $image)
								@php
									if ($index === 0) {
										$imagePath = !empty($image) && file_exists(storage_path("app/public/Uploads/News/thumbnail/{$image}"))
											? asset("storage/Uploads/News/thumbnail/{$image}")
											: asset("storage/Uploads/default-thumbnail.png");
									} else {
										$imagePath = !empty($image) && file_exists(storage_path("app/public/Uploads/News/images/{$image}"))
											? asset("storage/Uploads/News/images/{$image}")
											: asset("storage/Uploads/default-thumbnail.png");
									}

									$tabId = 'pills-image-' . ($index + 1);
									$active = $index === 0 ? 'show active' : '';
								@endphp

								<div class="tab-pane fade {{ $active }}" id="{{ $tabId }}" role="tabpanel" aria-labelledby="{{ $tabId }}-tab">
									<div class="shop-image">
										<a href="{{ $imagePath }}" class="shop-items"><img src="{{ $imagePath }}" alt="Shop"></a>
									</div>
								</div>
							@endforeach
						</div>

						<i class="slider-arrow arrow-right fa fa-chevron-right" onclick="nextSlide()"></i>
					</div>

					<div class="title pt-2">
						<h5>{{ $article->title }}</h5>
					</div> 
					<p>{!! $content !!}</p>
				</div>
			</div>

			<div class="col-lg-4">
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
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8">
				<div class="releted-courses pt-95">
					<div class="row d-flex align-items-stretch">
						<div class="col-12">
							<h5>RELATED ARTICLE</h5>
						</div>

						@foreach ($relatedArticles as $related)
							@php
								// Use storage link with fallback if file missing
								$thumbnail = !empty($related->thumbnail) && file_exists(storage_path("app/public/Uploads/News/thumbnail/{$related->thumbnail}"))
									? asset("storage/Uploads/News/thumbnail/{$related->thumbnail}")
									: asset("storage/Uploads/default-thumbnail.png");
							@endphp

							<div class="col-md-6 d-flex">
								<div class="singel-course mt-30 w-100 d-flex flex-column">
									<div class="thum">
										<div class="image">
											<a href="{{ route('view-article', ['id' => $related->id]) }}">
												<img src="{{ $thumbnail }}" alt="Related Article" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
											</a>
										</div>
									</div>
									<div class="cont p-3 d-flex flex-column justify-content-between" style="flex-grow: 1;">
										<a href="{{ route('view-article', ['id' => $related->id]) }}">
											<h6 style="font-size: 16px; line-height: 1.4; margin: 0;">
												{{ $related->title }}
											</h6>
										</a>
									</div>
								</div> <!-- singel course -->
							</div>
						@endforeach

					</div> <!-- row -->
				</div> <!-- releted courses -->
			</div>
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
