@extends('webadmin.layouts.mainlayout')

@section('body')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card card-outline card-primary shadow">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-edit"></i> New Article Form</h3>
					</div>
					<div class="card-body">
						<form action="{{ route('admin-storeArticle') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="title"><i class="fas fa-heading"></i> Title</label>
								<input class="form-control" name="title" type="text" placeholder="Enter article title" required>
							</div>

							<div class="form-group">
								<label for="content"><i class="fas fa-align-left"></i> Content</label>
								<div class="summernote"></div>
								<textarea id="summernote-textarea" name="content" style="display: none;"></textarea>
							</div>

							<div class="form-group">
								<label for="thumbnail"><i class="fas fa-image"></i> Thumbnail</label>
								<input class="form-control" type="file" name="thumbnail" accept="image/*" required>
							</div>

							<div class="form-group">
								<label for="images"><i class="fas fa-images"></i> Additional Images</label>
								<input class="form-control" type="file" name="images[]" accept="image/*" multiple>
							</div>

							<div class="form-group text-right">
								<button type="submit" class="btn btn-success btn-lg">
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
