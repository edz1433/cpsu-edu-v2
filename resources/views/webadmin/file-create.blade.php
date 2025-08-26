@extends('webadmin.layouts.mainlayout')

@section('body')

<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card card-outline card-success shadow">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-plus-circle"></i> Add New File</h3>
					</div>
					<div class="card-body">
						<form action="{{ route('admin-storeFile') }}" method="post" enctype="multipart/form-data">
							@csrf

							<!-- Title -->
							<div class="form-group">
								<label for="title">Title</label>
								<input class="form-control" name="title" type="text" placeholder="Enter file title">
							</div>

							<div class="form-row">
								<!-- Storage -->
								<div class="form-group col-md-6">
									<label for="storage">Storage</label>
									<select class="form-control" name="storage">
										<option value="images">Images</option>
										<option value="pdf">PDF</option>
										<option value="videos">Videos</option>
										<option value="others">Others</option>
									</select>
								</div>

								<!-- Category -->
								<div class="form-group col-md-6">
									<label for="category">Category</label>
									<select class="form-control" name="category">
										<option value="Article">Article</option>
										<option value="Sub menu">Sub Menu</option>
										<option value="Sub link">Sub Link</option>
										<option value="Gallery">Gallery</option>
									</select>
								</div>
							</div>

							<!-- File Upload -->
							<div class="form-group">
								<label for="file">File</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" name="file" id="file">
										<label class="custom-file-label" for="file">Choose file</label>
									</div>
								</div>
							</div>

							<!-- Submit -->
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
