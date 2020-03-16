@extends('admin.template.main')

@section('title', 'Add Category')

@section('style')
.invalid{
	display:block;
	color:red;
}
.is-invalid{
	color:grey;
	border:1px solid red;
}

@endsection

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<!-- INPUTS -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Add Category</h3>
						</div>
						<div class="panel-body">
							<form action="{{url('dashboard/addcategory')" method="post">
								@csrf
								<input type="text" class="form-control @error('category') invalid is-invalid @enderror" name="category" placeholder="Category" value="{{old('category')}}">
								@error('category')
								<span class="invalid"><i>{{$message}}</i></span>
								@enderror
								<button type="submit" class="btn btn-primary" style="margin-top: 20px;">Add Category</button>
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
