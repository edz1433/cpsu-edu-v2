@extends('webadmin.layouts.mainlayout')
@include('webadmin.layouts.header')

@section('body')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card shadow">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-stream"></i> Submenu List</h3>
						<div class="card-tools">
							<a href="{{ route('admin-createSubmenu') }}" class="btn btn-success btn-sm">
								<i class="fas fa-plus"></i> Add Submenu
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-hover">
								<thead class="thead-light">
									<tr>
										<th style="width: 50px;">#</th>
										<th>Title</th>
										<th class="text-center" style="width: 120px;">Content</th>
										<th class="text-center" style="width: 120px;">Thumbnail</th>
										<th>Category</th>
										<th class="text-center" style="width: 100px;">Status</th>
										<th class="text-center" style="width: 130px;">Action</th>
									</tr>
								</thead>
								<tbody>
									@php $no = 1; @endphp
									@foreach ($submenu as $sub)
										<tr>
											<td class="text-center">{{ $no++ }}</td>
											<td>{{ $sub->title }}</td>
											<td class="text-center">
												<a href="{{ route('admin-subContent', ['id' => $sub->id]) }}" 
												   class="btn btn-sm btn-info" target="_blank">
													<i class="fas fa-eye"></i> View
												</a>
											</td>
											<td class="text-center">
												<a href="{{ asset('Uploads/Submenu/thumbnail/' . $sub->thumbnail) }}" 
												   class="btn btn-sm btn-warning" target="_blank" rel="noopener noreferrer">
													<i class="fas fa-image"></i> View
												</a>
											</td>
											<td>{{ $sub->category_name }}</td>
											<td class="text-center">
												<span class="badge badge-{{ $sub->status == 1 ? 'success' : 'danger' }}">
													{{ $sub->status == 1 ? 'Active' : 'Inactive' }}
												</span>
											</td>
											<td class="text-center">
												<a href="{{ route('admin-editSubmenu', ['id' => $sub->id]) }}" 
												   class="btn btn-sm btn-info" title="Edit">
													<i class="fas fa-edit"></i>
												</a>
												<button id="{{ $sub->id }}" 
														onclick="deletethis(this.id, 'Submenu')" 
														class="btn btn-sm btn-danger" title="Delete">
													<i class="fas fa-trash-alt"></i>
												</button>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
</main>
@endsection
