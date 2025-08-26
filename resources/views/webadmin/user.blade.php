@extends('webadmin.layouts.mainlayout')
@include('webadmin.layouts.header')

@section('body')
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="row">
			<!-- User Form -->
			<div class="col-lg-4 mb-4">
				<div class="card shadow">
					<div class="card-header bg-success1">
						<h3 class="card-title"><i class="fas fa-user-plus"></i> Create User</h3>
					</div>
					<div class="card-body">
						<form action="{{ route('admin-userCreate') }}" method="post">
							@csrf
							@if($errors->any())
								<div class="alert alert-danger">
									<ul class="mb-0">
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif

							@if(session('success'))
								<div class="alert alert-success">
									{{ session('success') }}
								</div>
							@endif

							<div class="form-group">
								<input type="text" class="form-control" name="fname" placeholder="First Name">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="mname" placeholder="Middle Name">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="lname" placeholder="Last Name">
							</div>
							<div class="form-group">
								<select class="form-control" name="role">
									<option value="1">Web Administrator</option>
									<option value="2">Content Administrator</option>
								</select>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="Username">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Password">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
							</div>
							<button type="submit" class="btn btn-success btn-block">
								<i class="fas fa-save"></i> Save
							</button>
						</form>
					</div>
				</div>
			</div>

			<!-- User Table -->
			<div class="col-lg-8 mb-4">
				<div class="card card-outline shadow">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-users"></i> User List</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-hover">
								<thead class="thead-light">
									<tr>
										<th style="width: 50px;">#</th>
										<th>Full Name</th>
										<th>Username</th>
										<th>Role</th>
										<th style="width: 120px;">Action</th>
									</tr>
								</thead>
								<tbody>
									@php $no = 1; @endphp
									@foreach ($user as $us)
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $us->fname }} {{ $us->mname }} {{ $us->lname }}</td>
											<td>{{ $us->username }}</td>
											<td>
												<span class="badge badge-{{ $us->role == 1 ? 'success' : 'info' }}">
													{{ $us->role == 1 ? 'Web Administrator' : 'Content Administrator' }}
												</span>
											</td>
											<td class="text-center">
												<a href="#" class="btn btn-sm btn-info">
													<i class="fas fa-edit"></i>
												</a>
												<a href="#" class="btn btn-sm btn-danger">
													<i class="fas fa-trash"></i>
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
