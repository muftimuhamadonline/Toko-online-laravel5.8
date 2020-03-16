@extends('admin.template.main')

@section('title', 'User List')

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row" style="margin-bottom: 20px;">
				<div class="col-sm-3">
					<a href="{{ url('dashboard/users/adduser') }}" class="btn btn-primary">Add New User</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							@if(Session::has('success'))
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> {{Session::get('success')}}
							</div>
							@endif
							<h3 class="panel-title">User list</h3>
						</div>
						<div class="panel-body">
							<table class="table table-hover" style="font-size: 18px;">
							  <thead style="font-weight: bolder;">
							    <tr>
							      <td scope="col" class="text-center">No</td>
							      <td scope="col" class="text-center">ID User</td>
							      <td scope="col">Name</td>
							      <td scope="col">E-mail</td>
							      <td scope="col">E-mail verified at</td>
							      <td scope="col">Level</td>
							    </tr>
							  </thead>
							  <tbody>
							  	@foreach ( $users as $user)
							    <tr>
							      <td class="text-center">{{ $loop->iteration }}</td>
							      <td class="text-center">{{ $user->id }}</td>
							      <td>{{ $user->name }}</td>
							      <td>{{ $user->email }}</td>
							      <td>{{ $user->email_verified_at }}</td>
							      <td>{{ $user->level }}</td>
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
</div>

@endsection