@extends('webadmin.layouts.mainlayout')

@section('body')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card shadow">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-plus-circle"></i> Create Sub Link
						</h3>
						<div class="card-tools">
							<a href="{{ route('admin-dashboard') }}" class="btn btn-sm btn-secondary">
								<i class="fas fa-arrow-left"></i> Back
							</a>
						</div>
					</div>
					<div class="card-body">
						<form action="{{ route('admin-storeSubLink') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="title"><i class="fas fa-heading"></i> Title</label>
								<input type="text" name="title" class="form-control" placeholder="Enter Title">
							</div>

							<div class="form-group">
								<label for="content"><i class="fas fa-align-left"></i> Content</label>
								<div class="summernote"></div>
								<textarea id="summernote-textarea" name="content" style="display:none;"></textarea>
							</div>

							<div class="form-group">
								<label for="thumbnail"><i class="fas fa-image"></i> Thumbnail</label>
								<input type="file" name="thumbnail" class="form-control" accept="image/*">
							</div>

							<div class="form-group text-right">
								<button type="submit" class="btn btn-success">
									<i class="fas fa-save"></i> Save
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
