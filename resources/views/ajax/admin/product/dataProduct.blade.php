						<div class="panel-heading">
							@if( Session::has("success"))
				            <div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> {{Session::get('success')}}
							</div>
							@endif
							@if( Session::has("delete"))
							<div class="alert alert-success alert-dismissible" role="alert">
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
										<td>{{$product->name}}</</td>
										<td>{{$product->price}}</</td>
										<td>{{$product->stock}}</</td>
										<td>{{$product->picture}}</td>
										<td class="text-center">
											<a href="{{url('/dashboard/products/edit/')}}/{{$product->id}}" class="btn btn-primary edit-btn">Edit</a>
											<a href="{{url('/dashboard/products/delete/')}}/{{$product->id}}" class="btn btn-danger del-btn" onclick="return confirm('Are you sure ?')">Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{ $products->links() }}
						</div>