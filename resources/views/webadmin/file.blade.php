@extends('webadmin.layouts.mainlayout')
@include('webadmin.layouts.header')

@section('body')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card shadow">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-folder-open"></i> File List</h3>
						<div class="card-tools">
							<a href="{{ route('admin-createFile') }}" class="btn btn-success btn-sm">
								<i class="fas fa-plus"></i> Add File
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-hover">
								<thead class="thead-light">
									<tr>
										<th style="width: 50px;">#</th>
										<th width="300">Title</th>
										<th>File Name</th>
										<th>Category</th>
										<th style="width: 120px;">Action</th>
									</tr>
								</thead>
								<tbody>
									@php $no = 1; @endphp
									@foreach ($file as $f)
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $f->title }}</td>
											<td>
												<a href="{{ asset('Uploads/Files/'. $f->storage .'/' . $f->file_name) }}" 
												   class="text-primary font-weight-bold" 
												   target="_blank" rel="noopener noreferrer">
												   <i class="fas fa-file-alt"></i> {{ $f->file_name }}
												</a>
											</td>
											<td>
												<span class="badge badge-info">{{ $f->category }}</span>
											</td>
											<td class="text-center">
												<a href="{{ route('admin-editSublink', ['id' => $f->id]) }}" 
												   class="btn btn-sm btn-info" title="Edit">
													<i class="fas fa-edit"></i>
												</a>
												<a href="#" class="btn btn-sm btn-danger" title="Delete">
													<i class="fas fa-trash-alt"></i>
												</a>
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
