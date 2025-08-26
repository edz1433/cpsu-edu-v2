@extends('webadmin.layouts.mainlayout')
@include('webadmin.layouts.header')

@section('body')
<div class="container pt-3">
	<div class="row">
		<div class="col-lg-12">
			<!-- Card -->
			<div class="card shadow-sm">
				<div class="card-header bg-success text-white">
					<h3 class="card-title text-center w-100">{{ $submenu->title }}</h3>
				</div>
				<div class="card-body">
					<div id="file-content">
						@php 
							$content = file_get_contents('Uploads/Submenu/content/'.$submenu->content); 
						@endphp
						{!! $content !!}
					</div>
				</div>
			</div>
			<!-- End Card -->
		</div>
	</div>
</div>
@endsection
