@extends('webadmin.layouts.mainlayout')

@section('content')

<main class="ttr-wrapper">

	<div class="floating-div" id="myDiv">
		<table>
			
		</table>
		<div class="resize-handle" id="resizeHandle">
        
		</div>
    </div>
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Aricles</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Dashboard</a></li>
				<li>Edit</li>
			</ul>
		</div>	
		<div class="row">
			
			<div style="margin-left: 97%">
				<i class="fa fa-eye fa-lg" id="toggleButton"></i>
			</div>
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="email-wrapper">
						<div class="mail-list-container">
							<form class="mail-compose" action="{{ route('admin-updateArticles', ['id' => $article->id]) }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="form-group row">
								  <div class="col-12 col-md-12">
									<label for="title">Title</label>
									<input class="form-control" name="title" value="{{  $article->title }}" type="text" placeholder="Title">
								  </div>
								</div>
								<div class="form-group row">
								  <div class="form-group col-12">
									<label for="content">Content</label>
									<div class="summernote">
										<p>
											@php $content = file_get_contents('Uploads/News/content/'.$article->content); @endphp
											{!! $content !!}
										</p>
									</div>
									<textarea id="summernote-textarea" name="content" style="display: none;">{!! $content !!}</textarea>
								  </div>
								</div>
								<div class="form-group row">
									<div class="form-group col-12">
										<label for="thumbnail">Thumbnail</label>
										<input class="form-control" type="file" name="thumbnail" accept="image/*">
										<div class="row">
											<div class="col-lg-4">
												<img 
												src="{{ $article->thumbnail == '' ? asset('Uploads/default-thumbnail.png') : asset("Uploads/News/thumbnail/{$article->thumbnail}") }}" 
												alt="Thumbnail Preview" 
												width="100%" 
												class="mt-2">
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<div class="form-group col-12">
										<label for="images">Upload New Images</label>
										<input class="form-control" type="file" name="images[]" accept="image/*" multiple>
									</div>
								</div>

								@if ($article->images)
									<div class="form-group row">
										<div class="form-group col-12">
											<div class="row">
												@foreach (explode(',', $article->images) as $img)
													<div class="col-md-3 mb-2">
														<img 
															src="{{ asset('Uploads/News/images/' . trim($img)) }}" 
															alt="Article Image" 
															style="width: 100%; height: auto; object-fit: cover; border: 1px solid #ddd;">
														{{-- Optional: Add checkbox to delete --}}
														{{-- <input type="checkbox" name="delete_images[]" value="{{ trim($img) }}"> Delete --}}
													</div>
												@endforeach
											</div>
										</div>
									</div>
								@endif

								<div class="form-group col-12">
									<button type="submit" class="btn btn-lg bg-success text-light float-right">
										<li class="fa fa-save"></li> Save
									</button>
								</div>
							</form>							
						</div>
					</div>
				</div> 
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>
@endsection