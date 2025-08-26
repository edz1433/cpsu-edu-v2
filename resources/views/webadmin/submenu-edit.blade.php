@extends('webadmin.layouts.mainlayout')

@section('body')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card shadow">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-edit"></i> Edit Submenu
						</h3>
						<div class="card-tools">
							<a href="{{ route('admin-dashboard') }}" class="btn btn-sm btn-secondary">
								<i class="fas fa-arrow-left"></i> Back
							</a>
						</div>
					</div>
					<div class="card-body">
					<form action="{{ route('admin-updateSubmenu', ['id' => $submenu->id]) }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="title"><i class="fas fa-heading"></i> Title</label>
								<input type="text" name="title" class="form-control" value="{{ $submenu->title }}" placeholder="Enter Title">
							</div>
							<div class="form-group col-md-6">
								<label for="category"><i class="fas fa-folder"></i> Category</label>
								<select class="form-control" name="category" id="category">
									@foreach ($category as $cat)
										<option value="{{ $cat->id }}" @if($submenu->category == $cat->id) selected @endif>
											{{ $cat->cat_name }}
										</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="subcategory"><i class="fas fa-list-alt"></i> Sub Category</label>
								<select class="form-control" name="subcategory" id="subcategory">
									@foreach ($subcategories as $sub)
										<option value="{{ $sub->id }}" @if($submenu->subcategory == $sub->id) selected @endif>
											{{ $sub->title }}
										</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-md-4">
								<label for="url"><i class="fas fa-link"></i> Url</label>
								<input type="text" name="url" class="form-control" value="{{ $submenu->url }}" placeholder="Enter Url">
							</div>

							<div class="form-group col-md-4">
								<label for="men_order"><i class="fas fa-sort-numeric-up"></i> Menu Order</label>
								<input type="number" name="men_order" class="form-control" value="{{ $submenu->menu_order }}" placeholder="Enter Order Number">
							</div>
						</div>

						<div class="form-group">
							<label for="content"><i class="fas fa-align-left"></i> Content</label>
							<div class="summernote">
								@php $content = file_get_contents('Uploads/Submenu/content/'.$submenu->content); @endphp
								{!! $content !!}
							</div>
							<textarea id="summernote-textarea" name="content" style="display:none;">{!! $content !!}</textarea>
						</div>

						<!-- Status -->
						<div class="form-row">
							<div class="form-group col-md-9">
								<label for="thumbnail"><i class="fas fa-image"></i> Thumbnail</label>
								<input type="file" name="thumbnail" class="form-control" accept="image/*">
								<div class="mt-2">
									<img src="{{ $submenu->thumbnail == '' ? asset('Uploads/default-thumbnail.png') : asset("Uploads/Submenu/thumbnail/{$submenu->thumbnail}") }}" 
										alt="Thumbnail" class="img-fluid rounded shadow-sm" style="max-width: 250px;">
								</div>
							</div>
							<div class="form-group col-md-3">
								<label for="thumbnail"><i class="fas fa-status"></i> Status</label>
								<select class="form-control" id="status" name="status">
									<option value="1" @if($submenu->status == 1) selected @endif>Active</option>
									<option value="2" @if($submenu->status == 2) selected @endif>Inactive</option>
								</select>
							</div>
						</div>

						<div class="form-group text-right">
							<button type="submit" class="btn btn-success">
								<i class="fas fa-save"></i> Save Changes
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
