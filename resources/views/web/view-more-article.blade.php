@extends('web.layouts.mainlayout')

@section('content')
<section id="courses-part" class="pt-50 pb-120 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Top Search and View Tabs -->
                <div class="courses-top-search">
                    <ul class="nav float-left" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="active" id="courses-grid-tab" data-toggle="tab" href="#courses-grid" role="tab" aria-controls="courses-grid" aria-selected="true">
                                <i class="fa fa-th-large"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="courses-list-tab" data-toggle="tab" href="#courses-list" role="tab" aria-controls="courses-list" aria-selected="false">
                                <i class="fa fa-th-list"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            Showing {{ $articles->firstItem() }} - {{ $articles->lastItem() }} of {{ $articles->total() }} Results
                        </li>
                    </ul> 

                    <div class="courses-search float-right">
						<form action="{{ route('viewMoreArticle') }}" method="GET">
							<input type="text" name="search" value="{{ request('search') }}" placeholder="Search">
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
                    </div> 
                </div>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            <!-- GRID VIEW -->
            <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                <div class="row">
                    @foreach($articles as $art)
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="singel-course mt-30">
                                <div class="thum">
                                    <img src="{{ $art->image }}" alt="News Thumbnail" class="img-fluid" loading="lazy">
                                </div>
                                <div class="cont">
                                    <small><i class="fa fa-calendar"></i> {{ $art->date }}</small>
                                    <a href="{{ route('view-article', $art->id) }}">
                                        <p class="text-success1 mt-2"><b>{{ $art->safe_title }}</b></p>
                                    </a>
                                    <p class="mt-2" style="text-align: justify;">{!! $art->excerpt !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <nav class="courses-pagination mt-50">
                            {{ $articles->links() }}
                        </nav>
                    </div>
                </div>
            </div>

			<!-- LIST VIEW -->
			<div class="tab-pane fade" id="courses-list" role="tabpanel" aria-labelledby="courses-list-tab">
				<div class="row">
					@foreach($articles as $art)
						<div class="col-lg-12">
							<div class="singel-course mt-30">
								<div class="row no-gutters">
									<div class="col-md-4">
										<div class="thum">
											<img src="{{ $art->image }}" alt="News Thumbnail" class="img-fluid" loading="lazy">
										</div>
									</div>
									<div class="col-md-8">
										<div class="cont p-4">
											<small><i class="fa fa-calendar"></i> {{ $art->date }}</small>
											<a href="{{ route('view-article', $art->id) }}">
												<h4 class="mt-2 text-success1">{{ $art->safe_title }}</h4>
											</a>
											<p class="mt-2" style="text-align: justify;">{!! $art->excerpt !!}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>

				<!-- Centered Pagination -->
				<div class="row mt-4">
					<div class="col-lg-12 d-flex justify-content-center">
						{{ $articles->links('vendor.pagination.bootstrap-4') }}
					</div>
				</div>
			</div>
        </div>
    </div>
</section>
@endsection
