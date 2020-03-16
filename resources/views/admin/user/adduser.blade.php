@extends('admin.template.main')

@section('title', 'Add New User')

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<!-- INPUTS -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Add New User</h3>
						</div>
						<div class="panel-body">
							<form action="{{url('dashboard/users/add')}}" method="post" autocomplete="off">
								@csrf
								<div class="form-row">
									<div class="form-group">
										<input type="text" name="name" class="form-control @error('name') invalid is-invalid @enderror" placeholder="Name">
										@error('name')
										<span class="invalid">{{$message}}</span>
										@enderror
									</div>
									<div class="form-group">
										<input type="email" name="email" class="form-control @error('email') invalid is-invalid @enderror" placeholder="E-mail">
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control @error('password') invalid is-invalid @enderror" placeholder="Password">
									</div>
									<div class="form-group">
										<label class="fancy-radio">
											<input name="level" value="customer" type="radio">
											<span><i></i>Customer</span>
										</label>
										<label class="fancy-radio">
											<input name="level" value="admin" type="radio">
											<span><i></i>Admin</span>
										</label>
									</div>

									<button type="submit" class="btn btn-primary" style="margin-top: 20px;">Add User</button>
								</div>
							</form>
						</div>
					</div>
					<!-- END INPUTS -->
				</div>
			</div>
		</div>
	</div>
</div>


@endsection