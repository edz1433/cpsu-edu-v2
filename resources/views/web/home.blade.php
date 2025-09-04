@extends('web.layouts.mainlayout')
@section('content')
@php
    $current_route = request()->route()->getName();
@endphp
<!--====== SLIDER PART START ======-->
<!--====== SLIDER PART START ======-->
<!--====== SLIDER PART START ======-->
<section id="slider-part" class="slider-active">

    <!-- Video Slide -->
    <div class="single-slider fixed-slider">
        <video autoplay muted loop playsinline class="video-background">
            <source src="{{ asset('Uploads/Videos/banner_video.webm') }}" type="video/webm">
        </video>
        <div class="slider-cont">

        </div>
    </div>

    <!-- Image Slides -->
    @foreach(range(1,5) as $i)
    <div class="single-slider">
        <img src="{{ asset('Uploads/page-banner/banner-'.$i.'.jpg') }}" alt="Banner {{$i}}" class="slider-image">
        <div class="slider-cont">

        </div>
    </div>
    @endforeach

</section>


<section id="course-part" class="pt-115 pb-120 gray-bg">
    {{-- Responsive container: fluid on mobile, normal on larger screens --}}
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
                    $title  = strip_tags($art->title);
                    $artid  = $art->id;

                    // Normalize title
                    if (class_exists('Normalizer')) {
                        $title = Normalizer::normalize($title, Normalizer::FORM_KC);
                    } elseif (function_exists('transliterator_transliterate')) {
                        $title = transliterator_transliterate('NFKC', $title);
                    }
                    $title = preg_replace('/\p{Cf}/u', '', $title);

                    // Thumbnail
                    $image = !empty($art->thumbnail) 
                        ? asset("Uploads/News/thumbnail/{$art->thumbnail}") 
                        : asset("Uploads/default-thumbnail.png");

                    $contentFilePath = public_path("Uploads/News/content/{$art->content}");
                    $maxWords = 25;
                    $excerpt  = 'Content not available';

                    if (!empty($art->content) && file_exists($contentFilePath)) {
                        $text = strip_tags(file_get_contents($contentFilePath));

                        // Normalize content (same as title)
                        if (class_exists('Normalizer')) {
                            $text = Normalizer::normalize($text, Normalizer::FORM_KC);
                        } elseif (function_exists('transliterator_transliterate')) {
                            $text = transliterator_transliterate('NFKC', $text);
                        }
                        $text = preg_replace('/\p{Cf}/u', '', $text);

                        $words = preg_split('/\s+/', $text);

                        if (count($words) > $maxWords) {
                            $excerpt = implode(' ', array_slice($words, 0, $maxWords)) . '...';
                            $excerpt .= ' <a href="' . route('view-article', ['id' => $artid]) . '" style="color: #14532D; text-decoration: none;">Read More</a>';
                        } else {
                            $excerpt = $text;
                        }
                    }
                @endphp

                <!-- Responsive column -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="singel-course mt-30">
                        <div class="thum">
                            <div class="image">
                                <img src="{{ $image }}" alt="Article Thumbnail" class="img-fluid">
                            </div>
                        </div>
                        <div class="cont">
                            <small><i class="fa fa-calendar"></i> {{ $date }}</small>
                            <a href="{{ route('view-article', ['id' => $artid]) }}">
                                <p class="text-success1 mt-2"><b>{{ $title }}</b></p>
                            </a>
                            <p class="mt-2" style="text-align: justify;">{!! $excerpt !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-3">
            <div class="col-12 text-center">
                <button id="load-more" class="btn btn-outline-success">
                    <i class="fa fa-refresh"></i> More News
                </button>
            </div>
        </div>
    </div> 
</section>


<section id="about-page" class="pt-70 pb-110 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-7">
                <div class="about-image mt-50 hover-effect">
                    <a href="{{ route('academic-calendar') }}">
                        <img src="{{ asset('images/academic calendar.jpg') }}" alt="calendar" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-6 col-lg-5">
                <div class="about-image hover-effect">
                    <a href="{{ route('jobList') }}">
                        <img src="{{ asset('images/hiring logo.png') }}" alt="hiring" class="img-fluid">
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
            <div class="hex planning  hive-white"><div><h4></h4><span></span></div></div>
            <div class="hex qs"><div><h4></h4><span></span></div></div>
            <div class="hex audit"><div><h4></h4><span></span></div></div>
        </div>
        <div class="row-hive offset">
            <div class="hex admin"><div><h4></h4><span></span></div></div>
            <div class="hex the"><div><h4></h4><span></span></div></div>
            <div class="hex uigreen"><div><h4></h4><span></span></div></div>
            <div class="hex rnd">
                <div><h3>CPSU SECURES 105TH SPOT IN THE WURI RANKING 2025</h3><span></span></div>
            </div>
        </div>
        <div class="row-hive row3">
            <div class="hex" style="background-image: url('https://cpsu.edu.ph/images/cpsu-iso.png');">
                <div><h4></h4><span></span></div>
            </div>
            <div class="hex it"><div><h4></h4><span></span></div></div>
            <div class="hex wuri"><div><h4></h4><span></span></div></div>
        </div>
    </div>
</div>
</section>

@php
    $partners = [
        1 => '#',
        2 => '#',
        3 => '#',
        4 => '#',
        5 => 'https://cpsu.edu.ph/content/86',
        6 => '#',
        7 => '#',
    ];
@endphp

<div id="patnar-logo" class="pt-40 pb-80 gray-bg">
    <div class="container">
        <div class="row patnar-slied justify-content-center">
            @foreach ($partners as $i => $link)
                <div class="col-auto logo-col">
                    <div class="singel-patnar text-center">
                        @if($link != '#')<a href="{{ $link }}" target="_blank" rel="noopener">@endif
                            <img src="{{ asset('images/patnar-logo/' . $i . '.png') }}" alt="Logo {{ $i }}" class="patnar-img small-logo">
                        @if($link != '#')</a>@endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
(function () {
  const containers = document.querySelectorAll('.hive-container');

  containers.forEach(container => {
    // 1) Wrap existing children into an inner wrapper (no HTML changes needed)
    let inner = container.querySelector('.hive-inner');
    if (!inner) {
      inner = document.createElement('div');
      inner.className = 'hive-inner';
      while (container.firstChild) inner.appendChild(container.firstChild);
      container.appendChild(inner);
    }

    // 2) Scale function: fit to container (no overflow), never upscale above 1
    const scaleToFit = () => {
      // Temporarily clear container height to measure natural inner size
      const prevHeight = container.style.height;
      container.style.height = 'auto';

      const naturalW = inner.scrollWidth;
      const naturalH = inner.scrollHeight;
      const maxW = container.clientWidth;

      // If container has an explicit height, respect it; otherwise ignore height bound
      const computed = getComputedStyle(container);
      const hasExplicitH = computed.height !== 'auto' && computed.height !== '0px';
      const maxH = hasExplicitH ? container.clientHeight : Number.POSITIVE_INFINITY;

      const scaleW = maxW / naturalW;
      const scaleH = maxH / naturalH;
      const scale = Math.min(1, scaleW, scaleH); // only shrink, never grow

      inner.style.transform = `scale(${isFinite(scale) ? scale : 1})`;
      // Set container height to the scaled inner height so layout stays correct
      container.style.height = `${naturalH * (isFinite(scale) ? scale : 1)}px`;
    };

    // 3) Recalculate on size changes
    const ro = new ResizeObserver(scaleToFit);
    ro.observe(container);
    ro.observe(inner);
    window.addEventListener('resize', scaleToFit, { passive: true });

    // 4) Initial fit
    scaleToFit();
  });
})();
</script>

@endsection

