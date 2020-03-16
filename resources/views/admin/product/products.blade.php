@extends('admin.template.main')

@section('title', 'Products List')

<style type="text/css">
.edit-btn{
	display: inline-block;
	position: relative;
	left: -10px;
	padding: 10px 20px;
}
.del-btn{
	display: inline-block;
	padding: 10px 20px;
}
.none{
	display: none;
}

</style>

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row" style="margin-bottom: 20px;">
				<div class="col-md-2">
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary"data-toggle="modal" data-target="#modalNewProduct">
					  <span id="btnadd">Add New Product</span><p>{{ $a }}</p>
					</button>

					<!-- Modal -->
					<div class="modal fade" id="modalNewProduct" tabindex="-1" role="dialog" aria-labelledby="modalCenter" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h4 class="modal-title" id="modalCenter" style="display: inline-block;">Add New Product</h4>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <form action="{{url('dashboard/products/add')}}" method="POST" autocomplete="off" id="addProduct">
								@csrf
								<div class="form-group">
									<input type="text" name="name" id="name" class="form-control @error('name') is-invalid invalid @enderror" placeholder="Name" value="{{old('name')}}">
									@error('name')
									 <span class="invalid"><i>{{$message}}</i></span>
									@enderror
								</div>							
								<div class="form-group">
									<input type="text" name="price" id="price" class="form-control @error('price') is-invalid invalid @enderror" placeholder="Price" value="{{old('price')}}">
									@error('price')
									 <span class="invalid"><i>{{$message}}</i></span>
									@enderror
								</div>			
								<div class="form-group">
									<input type="text" name="stock" id="stock" class="form-control @error('stock') is-invalid invalid @enderror" placeholder="Stock" value="{{old('stock')}}">
									@error('stock')
									 <span class="invalid"><i>{{$message}}</i></span>
									@enderror
								</div>
								<div class="form-group">
									<label for="picture">Picture</label>
								    <input type="file" name="picture" id="picture" class="form-control-file @error('picture') is-invalid invalid @enderror" id="picture" value="{{old('picture')}}">
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
				<div class="col-md-3 offset-md-4">
					<div class="container" style="margin-top: 7px; font-size: 16px;">
						<span>Sort &nbsp;</span>
						<select name="sort" id="sort">
							@if(Request::ajax())
							<option>{{$sortData}}</option>
							@endif
							<option class="@if($sortData == 5) none @endif">5</option>
							<option class="@if($sortData == 10) none @endif">10</option>
							<option class="@if($sortData == 20) none @endif">20</option>
							<option class="@if($sortData == 50) none @endif">50</option>
							<option class="@if($sortData == 100) none @endif">100</option>
						</select>
						<span>&nbsp;Data</span>
					</div>
				</div>			
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel" id="dataProduct">
						<div class="panel-heading">
							@if( Session::has("success"))
				            <div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> {{Session::get('success')}}
							</div>
							@endif
							@if( Session::has("delete"))
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> {{Session::get('delete')}}
							</div>
							@endif
							<h3 class="panel-title">Products List</h3>
						</div>
						<div class="panel-body">
							<table class="table table-hover" style="font-size: 18px;">
								<thead style="font-weight: bolder;">
									<tr>
										<td class="text-center">No</td>
										<td class="text-center">ID</td>
										<td>Name</td>
										<td>Price</td>
										<td>Stock</td>
										<td>Picture</td>
										<td class="text-center">Action</td>
									</tr>
								</thead>
								<tbody>
									@foreach ($products as $product)
									<tr>
										<td class="text-center">{{$loop->iteration}}</td>
										<td class="text-center">{{$product->id}}</td>
										<td>{{$product->name}}</td>
										<td>{{$product->price}}</td>
										<td>{{$product->stock}}</td>
										<td>{{$product->picture}}</td>
										<td>
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editProduct">
											  Edit
											</button>

											<!-- Modal -->
											<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="editModalCenter" aria-hidden="true">
											  <div class="modal-dialog modal-dialog-centered" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h4 class="modal-title" id="editModalCenter" style="display: inline-block;">Edit Product</h4>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body">
											        <form action="/dashboard/products/edit/{{$product->id}}" method="POST" autocomplete="off" id="editForm" style="font-size: 16px;">
														@csrf
														<div class="form-group">
															<input type="text" name="name" id="nameModal" class="form-control" placeholder="Name" value="@if(old('name')) {{old('name')}} @endif">
														</div>
														<div class="form-group">
															<input type="text" name="price" id="priceModal" class="form-control" placeholder="Price" value="@if(old('price')) {{old('price')}} @endif">
														</div>
														<div class="form-group">
															<input type="text" name="stock" id="stockModal" class="form-control" placeholder="Stock" value="@if(old('stock')) {{old('stock')}} @endif">
														</div>
														<div class="form-group">
															<input type="text" name="picture" id="pictureModal" class="form-control" placeholder="Picture" value="@if(old('picture')) {{old('picture')}} @endif">
														</div>

														<button type="submit" class="btn btn-primary mt-5">Edit Product</button>
													</form>
											      </div>
											    </div>
											  </div>
											</div>
											<a href="{{url('/dashboard/products/delete/')}}/{{$product->id}}" class="btn btn-danger del-btn deleteProduct" onclick="return confirm('Are you sure ?')">Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{ $products->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		
		// Pagination with ajax
		$('.page-link').on('click', function(e) {
			e.preventDefault();

			// Get link button click
			var link = $(this).attr('href');
			
			//load data page with ajax
			$('#container-content').html("<div class='spinner'></div>").load(link, function(data) {
				$('#container-content').html(data);
			});
		});

		// Sort data by request AJAX
		$('#sort').on('change', function() {
			// Get value sort data
			var sortData = $(this).val();

			$('#container-content').html("<div class='spinner'></div>").load('/dashboard/products/' + sortData, function(data) {
				$('#container-content').html(data);
			});

		});


		// Add new product on submit 
		$('#addProduct').on('submit', function(e) {
			e.preventDefault();

			// Get value on form submit
			var token = $(this).find("[name='_token']").val();
			var name = $(this).find('#name').val();
			var price = $(this).find('#price').val();
			var stock = $(this).find('#stock').val();
			var path = $(this).find('#picture').val();
			var picture = path.split('\\').pop();

			//close modal
			$('.close').trigger('click');


			$.post('/dashboard/products/add', {_token : token, name : name, price : price, stock : stock, picture : picture}, function(result) {
				var data = jQuery.parseJSON(JSON.stringify(result));

				if ( data.status == 1)
				{
					alert(data.product + ' ' + data.message);
					loadDataProducts();
				}
				else
				{
					alert('error');
				}
			});
		});


		// Edit button on click
		$('.edit-btn').on('click', function() {

			// Get value product for form edit
			var id_product = $(this).parent().prev().prev().prev().prev().prev().text();
			var nameModal = $(this).parent().prev().prev().prev().prev().text();
			var priceModal = $(this).parent().prev().prev().prev().text();
			var stockModal = $(this).parent().prev().prev().text();
			var pictureModal = $(this).parent().prev().text();


			// Set the value of modal form based product choose
			$('#nameModal').val(nameModal);
			$('#priceModal').val(priceModal);
			$('#stockModal').val(stockModal);
			$('#pictureModal').val(pictureModal);

			$('#editForm').on('submit', function(e) {
				e.preventDefault();

				$('.close').trigger('click');

				// Update data product with request AJAX
				$.post('/dashboard/products/edit/' + id_product, $(this).serialize(), function(data) {
					var data = jQuery.parseJSON(JSON.stringify(data));

					if ( data.status == 1)
					{
						alert(data.product + ' ' + data.message);
						loadDataProducts();
					}
					else
					{
						alert('error');
					}
				});
			});
			
		});

		// Delete product on click, request AJAX
		$('.deleteProduct').on('click', function(e) {
			e.preventDefault();

			var link = $(this).attr('href');

			$.get(link, function(data) {
				var data = jQuery.parseJSON(JSON.stringify(data));

				if ( data.status == 1)
				{
					alert(data.product + ' ' + data.message);
					loadDataProducts();
				}
				else
				{
					alert('error');				
				}
			});
		});

		function loadDataProducts() {
			$('#container-content').html("<div class='spinner'></div>").load('/dashboard/products', function(data) {
				$('#container-content').html(data);
			});
		}



	});

</script>
@endsection