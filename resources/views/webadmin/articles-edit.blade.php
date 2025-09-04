@extends('webadmin.layouts.mainlayout')

@section('body')

<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card card-outline card-primary shadow">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-edit"></i> Edit Article Form</h3>
					</div>
					<!-- Your Profile Views Chart -->
					<div class="col-lg-12 m-b30">
						<div class="widget-box">
							<div class="email-wrapper">
								<div class="mail-list-container">
									<form class="mail-compose" action="{{ route('admin-updateArticles', ['id' => $article->id]) }}" method="post" enctype="multipart/form-data">
										@csrf
										<div class="form-group row">
											<div class="col-6 col-md-6">
												<label for="title">Title</label>
												<input class="form-control" name="title" value="{{ $article->title }}" type="text" placeholder="Title">
											</div>
											<div class="col-6 col-md-6">
												<label for="date">Date</label>
												<input 
													type="date" 
													class="form-control" 
													name="created_at" 
													value="{{ old('created_at', $article->created_at ? $article->created_at->format('Y-m-d') : '') }}">
											</div>
										</div>
										<div class="form-group row">
											<div class="form-group col-12">
												<label for="content">Content</label>
												<div class="summernote">
													<p>
														@php
															// Build relative path under public/
															$relativePath = 'Uploads/News/content/' . $article->content;

															// Get full path from public/
															$fullPath = public_path($relativePath);

															// Load file if it exists
															$content = file_exists($fullPath) ? file_get_contents($fullPath) : '';
														@endphp

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
														width="50%" 
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
																	style="width: 50%; height: auto; object-fit: cover; border: 1px solid #ddd;">
																{{-- Optional: Add checkbox to delete --}}
																{{-- <input type="checkbox" name="delete_images[]" value="{{ trim($img) }}"> Delete --}}
															</div>
														@endforeach
													</div>
												</div>
											</div>
										@endif

										<div class="form-group col-12">
											<button type="submit" class="btn btn-lg bg-success text-light">
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
		</div>
	</div>
</main>
@endsection