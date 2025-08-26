@extends('webadmin.layouts.mainlayout')
@include('webadmin.layouts.header')

@section('content')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Articles</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="{{ route('admin-dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>
				<li><a href="{{ route('admin-articles') }}">Articles</a></li>
				<li>View</li>
			</ul>
		</div>	
		<div class="row">
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wrapper">
						<div class="container pt-4">
							<h4 class="text-center">{{ $article->title }}</h4>
							<div id="file-content">
								<p>
									@php $content = file_get_contents('Uploads/News/content/'.$article->content); @endphp
									{!! $content !!}
								</p>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
</main>
@endsection
