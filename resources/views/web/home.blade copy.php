
@extends('web.layouts.mainlayout')
@include('web.layouts.sidebar')
@section('content')
@php
    $current_route=request()->route()->getName();
@endphp
<div class="page-content bg-white">
	<div class="content-block">
		<video autoplay muted loop>
			<source src="assets/video/AWARD SDE.mp4" type="video/mp4">
		</video>

		<div class="section-area content-inner service-info-bx" style="margin-top: 90px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="service-bx" style="background-color: #04401f">
							<div class="action-box-3">
								<a href="https://cpsu.edu.ph/view-sublink-content/79" target="_blank"><img src="assets/images/ts.png" alt=""></a>
							</div>
							<div class="info-bx text-center text-light">
								<h4 class="text-light">Transparency Seal</h4>
								<p class="pt-1">To enhance transparency and enforce accountability, all national government agencies shall maintain a transparency seal on their official websites.</p><br>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="service-bx" style="background-color: #333">
							<div class="action-box-3">
								<a href="https://www.foi.gov.ph/" target="_blank"><img src="assets/images/foi.png" alt=""></a>
							</div>
							<div class="info-bx text-center text-light">
								<h4 class="text-light">Freedom of Information</h4>
								<p>Government units and the requesting public are reminded to observe and be guided by the provisions of the Data Privacy Act of 2012 when using the eFOI Portal.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="service-bx" style="background-color: #f5ff00">
							<div class="action-box-3">
								<a href="https://cpsujournals.com/" target="_blank"><img src="assets/images/ojs.png" alt=""></a>
							</div>
							<div class="info-bx text-center text-dark">
								<h4 class="text-dark">Online Journal</h4>
								<p>The PSDRM Journal publishes articles about resource management and conservation, biodiversity, and social and technological development in the Philippines.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Our Services END -->

		<!-- Popular Courses -->
		<div class="section-area section-sp2 popular-courses-bx latest-updates">
			<div class="container">
				<div class="row">
					<div class="col-md-12 heading-bx left">
						<h2 class="title-head">Latest <span>Updates</span></h2>
						<p>Check the latest updates, important reminders, and other activities</p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 col-xl-8 col-md-7">
						<div id="masonry" class="ttr-blog-grid-3 row">
							@foreach($article as $art)
								@php $date = date("M d Y", strtotime($art->created_at)); @endphp 
								<div class="post action-card col-xl-6 col-lg-6 col-md-12 col-xs-12 m-b40">
									<div class="recent-news">
										<img src="{{ $art->thumbnail == '' ? asset('Uploads/default-thumbnail.png') : asset("Uploads/News/thumbnail/{$art->thumbnail}") }}" alt="">
										<div class="info-bx">
											<ul class="media-post">
												<li><a href="#"><i class="fa fa-calendar"></i>{{ $date }}</a></li>
												<li><a href="#"><i class="fa fa-user"></i>By J.A. Emoy,</a></li>
											</ul>
											@php $artid = $art->id; @endphp
											<h6 style="height: 65px; font-size: 20px; overflow-y: hidden;">
												<a href="{{ route('view-article', ['id' => $artid]) }}" class="madapak">
													{{ $art->title }}
												</a>
											</h6>
											{{-- Removed post content --}}
										</div>
									</div>
								</div>
							@endforeach
						</div>

						<!-- blog grid END -->

						<!-- Pagination -->
						{{-- <div class="pagination-bx rounded-sm gray clearfix">
							<ul class="pagination">
								<li class="previous"><a href="#"><i class="ti-arrow-left"></i> Prev</a></li>
								<li class="active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">...</a></li>
								<li class="next"><a href="#">Next <i class="ti-arrow-right"></i></a></li>
							</ul>
						</div> --}}
						<div class="pagination-bx rounded-sm gray clearfix">
							{{ $article->links('vendor.pagination.bootstrap-5') }}
						</div>
						<!-- Pagination END -->
					</div>
					<!-- left part END -->

					<!-- Side bar start -->
					@yield('sidebar')
					<!-- Side bar END -->
				</div>
			</div>
		</div>

		<!-- Count -->
		<div class="section-area section-sp1 bg-fix ovbl-dark text-white" style="background-image:url({{ asset('Uploads/Files/images/img1.jpg') }});">
			<div class="container">
				<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
							<div class="counter-style-1 text-center">
								<div class="text-white">
									<span class="counter">30</span><span>+</span>
								</div>
								<span class="counter-text">PROGRAMS OFFERED</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
							<div class="counter-style-1 text-center">
								<div class="text-white">
									<span class="counter">9</span><span>+</span>
								</div>
								<span class="counter-text">EXTERNAL CAMPUSES</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
							<div class="counter-style-1 text-center">
								<div class="text-white">
									<span class="counter">8</span><span>+</span>
								</div>
								<span class="counter-text">COLLEGES & GRAD. SCHOOL</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30">
							<div class="counter-style-1 text-center">
								<div class="text-white">
									<span class="counter">4,653.7</span><span>+</span>
								</div>
								<span class="counter-text">LAND RESERVATION (HA.)</span>
							</div>
						</div>
					</div>
			</div>
		</div>
		<!-- Count END -->

		<!-- Our Story ==== -->
		<div class="section-area section-sp1 our-story">
			<div class="container">
				<div class="row align-items-center d-flex ">
					<div class="col-lg-5 col-md-12 heading-bx left">
						<h2 class="title-head">Our <span>Facilities</span></h2>
						<p class="text-justify">
						    Central Philippines State University (CPSU) stands as a testament to educational innovation and community empowerment in Negros Occidental, proudly encompassing 10 campuses and Extension classes, all ISO-accredited. This sprawling network not only signifies a commitment to excellence but also serves as a transformative bridge, connecting local communities to the tangible realization of their aspirations. CPSU's dedication to providing quality and advanced higher education reflects a profound understanding of the unique needs of its neighboring areas. Firmly rooted in its mission, CPSU is on an inspiring journey to evolve into a technology-driven multi-disciplinary university by 2023. In the vibrant tapestry of Negros Occidental, CPSU emerges as a catalyst for societal progress, fostering dreams and paving the way for a future where education becomes the cornerstone of community development.
						</p>
						<!--<a href="#" class="btn text-light" style="background-color: #04401f;">Read More</a>-->
					</div>
					<div class="col-lg-7 col-md-12 heading-bx p-lr">
						<div class="video-bx">
							<img src="{{ asset('Uploads/Files/images/img1.jpg') }}" alt=""/>
							<a href="https://www.youtube.com/watch?v=sgppKGeA3Kk" class="popup-youtube video"><i class="fa fa-play"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Our Story END ==== -->

		<!-- VM ==== -->
		<div class="section-area bg-gray section-sp2">
				<div class="row col-12 ml-1">
					<div class="col-lg-3">
						<div class="item">
							<img src="{{ asset('Uploads/Files/images/vision.jpg') }}" class="img-responsive">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="item">
							<img src="{{ asset('Uploads/Files/images/mission.jpg') }}" class="img-responsive">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="item">
							<img src="{{ asset('Uploads/Files/images/strategic-goals.jpg') }}" class="img-responsive">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="item">
							<img src="{{ asset('Uploads/Files/images/objectives.jpg') }}" class="img-responsive">
						</div>
					</div>
				</div>
		</div>

		<div class="section-area section-sp1 ovbl-dark bg-fix online-cours" style="background-image:url(assets/images/count/cpsubg.png);">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center text-white">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4043.5980337884957!2d122.88798265606688!3d9.851078830258214!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33ac6d5da0e13cf7%3A0xa8d43186b79bc612!2sCentral%20Philippines%20State%20University!5e1!3m2!1sen!2sus!4v1695975626334!5m2!1sen!2sus" width="100%" height="450" style="border:2;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- contact area END -->
</div>
@endsection