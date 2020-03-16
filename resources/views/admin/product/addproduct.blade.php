@extends('admin.template.main')

@section('title', 'Add New Product')

<style type="text/css">
.invalid{
	color: red;
}
</style>

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-heading">
							<div>
								<h3 class="panel-title">New Product</h3>
							</div>
						</div>
						<div class="panel-body">
							<form action="{{url('dashboard/addproduct')}}" method="POST" autocomplete="off" id="form-input">
								@csrf
								<div class="form-group">
									<input type="text" name="name" class="form-control @error('name') is-invalid invalid @enderror" placeholder="Name" value="{{old('name')}}">
									@error('name')
									 <span class="invalid"><i>{{$message}}</i></span>
									@enderror
								</div>							
								<div class="form-group">
									<input type="text" name="price" class="form-control @error('price') is-invalid invalid @enderror" placeholder="Price" value="{{old('price')}}">
									@error('price')
									 <span class="invalid"><i>{{$message}}</i></span>
									@enderror
								</div>			
								<div class="form-group">
									<input type="text" name="stock" class="form-control @error('stock') is-invalid invalid @enderror" placeholder="Stock" value="{{old('stock')}}">
									@error('stock')
									 <span class="invalid"><i>{{$message}}</i></span>
									@enderror
								</div>
								<div class="form-group">
									<label for="picture">Picture</label>
								    <input type="file" name="picture" class="form-control-file @error('picture') is-invalid invalid @enderror" id="picture" value="{{old('picture')}}">
								    @error('picture')
									 <span class="invalid"><i>{{$message}}</i></span>
									@enderror
								</div>
								<button type="submit" class="btn btn-primary" style="margin-top: 10px;">Add New Product</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>
@endsection