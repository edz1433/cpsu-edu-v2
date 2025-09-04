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
						<h3 class="card-title">
							<i class="fas fa-user-plus"></i> 
							{{ isset($editUser) ? 'Edit User' : 'Create User' }}
						</h3>
					</div>
					<div class="card-body">
						<form action="{{ isset($editUser) ? route('userUpdate') : route('userCreate') }}" method="post">
							@csrf
							@if(isset($editUser))
								<input type="hidden" name="id" value="{{ $editUser->id }}">
							@endif

							@if(session('error'))
								<div class="alert alert-danger" style="font-size: 12pt;">
									<i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
								</div>
							@endif

							@if(session('success'))
								<div class="alert alert-success" style="font-size: 10pt;">
									<i class="fas fa-check"></i> {{ session('success') }}
								</div>
							@endif

							<div class="input-group mb-3">
								<input type="text" class="form-control" name="fname" placeholder="First Name" value="{{ old('fname', $editUser->fname ?? '') }}" required>
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
							<span class="form-text text-danger small">@error('fname') {{ $message }} @enderror</span>

							<div class="input-group mb-3">
								<input type="text" class="form-control" name="mname" placeholder="Middle Name" value="{{ old('mname', $editUser->mname ?? '') }}">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
							<span class="form-text text-danger small">@error('mname') {{ $message }} @enderror</span>

							<div class="input-group mb-3">
								<input type="text" class="form-control" name="lname" placeholder="Last Name" value="{{ old('lname', $editUser->lname ?? '') }}" required>
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
							<span class="form-text text-danger small">@error('lname') {{ $message }} @enderror</span>

							<div class="input-group mb-3">
								<select class="form-control" name="role" required>
									<option value="">-- Select Role --</option>
									<option value="1" {{ old('role', $editUser->role ?? '') == 1 ? 'selected' : '' }}>Web Administrator</option>
									<option value="2" {{ old('role', $editUser->role ?? '') == 2 ? 'selected' : '' }}>Content Administrator</option>
								</select>
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user-shield"></span>
									</div>
								</div>
							</div>
							<span class="form-text text-danger small">@error('role') {{ $message }} @enderror</span>

							<div class="input-group mb-3">
								<input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username', $editUser->username ?? '') }}" required>
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-envelope"></span>
									</div>
								</div>
							</div>
							<span class="form-text text-danger small">@error('username') {{ $message }} @enderror</span>

							<div class="input-group mb-3">
								<input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" {{ isset($editUser) ? '' : 'required' }}>
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-lock"></span>
									</div>
								</div>
							</div>
							<span class="form-text text-danger small">@error('password') {{ $message }} @enderror</span>

							<div class="input-group mb-3">
								<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" {{ isset($editUser) ? '' : 'required' }}>
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-lock"></span>
									</div>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-8">
									<div class="icheck-primary">
										<input type="checkbox" id="showPassword" onclick="togglePassword()">
										<label for="showPassword">Show Password</label>
									</div>
								</div>
								<div class="col-4">
									<button type="submit" class="btn btn-success btn-block">
										<i class="fas fa-save"></i> {{ isset($editUser) ? 'Update' : 'Save' }}
									</button>
								</div>
							</div>
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
												<a href="{{ route('userEdit', $us->id) }}" class="btn btn-sm btn-info">
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

<script>
function togglePassword() {
	const password = document.getElementById("passwordInput");
	password.type = password.type === "password" ? "text" : "password";
}
</script>
@endsection
