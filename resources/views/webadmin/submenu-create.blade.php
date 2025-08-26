@extends('webadmin.layouts.mainlayout')

@section('body')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card shadow">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-plus-circle"></i> Create Sub Menu
						</h3>
						<div class="card-tools">
							<a href="{{ route('admin-dashboard') }}" class="btn btn-sm btn-secondary">
								<i class="fas fa-arrow-left"></i> Back
							</a>
						</div>
					</div>
					<div class="card-body">
						<form action="{{ route('admin-storeSubmenu') }}" method="post" enctype="multipart/form-data">
							@csrf
							
							<!-- Title -->
							<div class="form-group">
								<label for="title"><i class="fas fa-heading"></i> Title</label>
								<input type="text" name="title" class="form-control" placeholder="Enter Title">
							</div>

							<!-- Category & Subcategory -->
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="category"><i class="fas fa-list"></i> Category</label>
									<select class="form-control" id="category" name="category">
										<option value="">-- Select Category --</option>
										@foreach ($category as $cat)
											<option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="subcategory"><i class="fas fa-list-alt"></i> Sub Category</label>
									<select class="form-control" id="subcategory" name="subcategory">
										<option value="">-- Select Sub Category --</option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="order"><i class="fas fa-list-alt"></i>Url</label>
									<input type="text" name="url" class="form-control" placeholder="url">
								</div>
								<div class="form-group col-md-3">
									<label for="order"><i class="fas fa-list-alt"></i> Menu Order</label>
									<input type="number" name="men_order" class="form-control" placeholder="Enter Order Number">
								</div>
							</div>

							<!-- Content -->
							<div class="form-group">
								<label for="content"><i class="fas fa-align-left"></i> Content</label>
								<div class="summernote"></div>
								<textarea id="summernote-textarea" name="content" style="display:none;"></textarea>
							</div>

							<!-- Status -->
							<div class="form-row">
								<div class="form-group col-md-9">
									<label for="thumbnail"><i class="fas fa-image"></i> Thumbnail</label>
									<input type="file" name="thumbnail" class="form-control" accept="image/*">
								</div>
								<div class="form-group col-md-3">
									<label for="thumbnail"><i class="fas fa-status"></i> Status</label>
									<select class="form-control" id="status" name="status">
										<option value="1">Active</option>
										<option value="2">Inactive</option>
									</select>
								</div>
							</div>

							<!-- Submit -->
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
