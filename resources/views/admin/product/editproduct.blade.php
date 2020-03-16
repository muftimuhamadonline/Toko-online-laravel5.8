@extends('admin.template.main')

@section('title', 'Edit Product')

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid panel">
			<div class="row panel-heading">
				<div class="col-md-3">
					<div>
						<h3 class="panel-title">New Product</h3>
					</div>
				</div>
			</div>
			<div class="row panel-body">
				<div class="col-md-4">
					<form action="/dashboard/products/edit/{{$product->id}}" method="POST" autocomplete="off">
						@csrf
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Name" value="@if(old('name')) {{old('name')}} @else {{$product->name}} @endif">
						</div>
						<div class="form-group">
							<input type="text" name="price" class="form-control" placeholder="Price" value="@if(old('price')) {{old('price')}} @else {{$product->price}} @endif">
						</div>
						<div class="form-group">
							<input type="text" name="stock" class="form-control" placeholder="Stock" value="@if(old('stock')) {{old('stock')}} @else {{$product->stock}} @endif">
						</div>
						<div class="form-group">
							<input type="text" name="picture" class="form-control" placeholder="Picture" value="@if(old('picture')) {{old('picture')}} @else {{$product->picture}} @endif">
						</div>

						<button type="submit" class="btn btn-primary mt-5">Edit New Product</button>
					</form>
				</div>
			</div>		
		</div>
	</div>
</div>
@endsection