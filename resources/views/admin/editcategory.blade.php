@extends('admin.template.main')

@section('title', 'Edit Category')

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
							<h3 class="panel-title">Edit Category</h3>
						</div>
						<div class="panel-body">
							<form action="/dashboard/category/{{$category->id}}" method="POST">
								@csrf 
								@method("PUT")
								<input type="text" class="form-control @error('category') invalid is-invalid @enderror" name="category" placeholder="Category" value="@if(old('category')) {{old('category')}} @else {{$category->categories}} @endif">
								@error('category')
								<span class="invalid"><i>{{$message}}</i></span>
								@enderror
								<button type="submit" class="btn btn-primary" style="margin-top: 20px;">Edit Category</button>
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
