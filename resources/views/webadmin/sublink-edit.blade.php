@extends('webadmin.layouts.mainlayout')

@section('body')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card shadow">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-edit"></i> Edit Sub Link
						</h3>
						<div class="card-tools">
							<a href="{{ route('admin-dashboard') }}" class="btn btn-sm btn-secondary">
								<i class="fas fa-arrow-left"></i> Back
							</a>
						</div>
					</div>
					<div class="card-body">
						<form action="{{ route('admin-updateSublink', ['id' => $sublink->id]) }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="title"><i class="fas fa-heading"></i> Title</label>
								<input type="text" name="title" value="{{ $sublink->title }}" class="form-control" placeholder="Enter Title">
							</div>

							<div class="form-group">
								<label for="content"><i class="fas fa-align-left"></i> Content</label>
								<div class="summernote">
									@php $content = file_get_contents('Uploads/Sublink/content/'.$sublink->content); @endphp
									{!! $content !!}
								</div>
								<textarea id="summernote-textarea" name="content" style="display:none;">{!! $content !!}</textarea>
							</div>

							<div class="form-group">
								<label for="thumbnail"><i class="fas fa-image"></i> Thumbnail</label>
								<input type="file" name="thumbnail" class="form-control" accept="image/*">
								<div class="mt-2">
									<img src="{{ $sublink->thumbnail == '' ? asset('Uploads/default-thumbnail.png') : asset("Uploads/Sublink/thumbnail/{$sublink->thumbnail}") }}" 
									     alt="Thumbnail" class="img-fluid rounded border" style="max-width: 250px;">
								</div>
							</div>

							<div class="form-group text-right">
								<button type="submit" class="btn btn-success">
									<i class="fas fa-save"></i> Update
								</button>
							</div>
						</form>
					</div>
				</div> 
			</div>
		</div>
	</div>
</main>
@endsection
