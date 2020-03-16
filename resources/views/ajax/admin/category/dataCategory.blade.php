@section('title', 'Dashboard - Category')

<div class="main">
	<div class="main-content">
		<div class="container-fluid" id="dataCategory">
			<div class="row" style="margin-bottom: 20px;">
				<div class="col-md-3" id="btnCategory">
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcategory">
					  Add New Category
					</button>

					<!-- Modal -->
					<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="addcategory" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h4 class="modal-title" id="addcategory" style="display: inline-block;">Add New Category</h4>
					        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <form action="{{url('dashboard/category/add')}}" method="post" autocomplete="off" id="addCategory">
								@csrf
								<input type="text" class="form-control @error('category') invalid is-invalid @enderror" name="category" placeholder="Category" value="{{old('category')}}" id="category">
								@error('category')
								<span class="invalid"><i>{{$message}}</i></span>
								@enderror
								<button type="submit" class="btn btn-primary" style="margin-top: 20px;">Add Category</button>
							</form>
					      </div>
					    </div>
					  </div>
					</div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-md-10">
					<div class="panel">
						<div class="panel-heading">
							@if( Session::has("success"))
			                <div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> {{Session::get('success')}}
							</div>
			                @endif
			                @if (Session::has("delete"))
			                <div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-times-circle"></i>{{Session::get('delete')}}
							</div>
			                @endif
							<h3 class="panel-title">Categories</h3>
						</div>
						<div class="panel-body">
							<table class="table table-hover" style="font-size: 18px;">
								<thead style="font-weight: bolder;" class="text-center">
									<tr>
										<td>No</td>
										<td>ID Category</td>
										<td>Name</td>
										<td>Action</td>
									</tr>
								</thead>
								<tbody>
									@foreach ($categories as $category)
									<tr>
										<td class="text-center">{{$loop->iteration}}</td>
										<td class="text-center">{{$category->id}}</td>
										<td>{{$category->categories}}</td>
										<td>
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary editButton" data-toggle="modal" data-target="#editModal">
											  Edit
											</button>

											<!-- Modal -->
											<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editCenter" aria-hidden="true">
											  <div class="modal-dialog modal-dialog-centered" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h4 class="modal-title" id="editCenter" style="display: inline-block;">Edit Category</h4>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body">
											        <form action="/dashboard/category/edit/" method="post" id="formEdit">
											        	@csrf
											        	<div class="form-group">
											        		<input type="text" name="category" class="form-control @error('category') is-invalid invalid @enderror" id="modalCategory" placeholder="Category">
											        	</div>
														@error('category')
														<span class="invalid"><i>{{$message}}</i></span>
														@enderror
											        	<button type="submit" class="btn btn-primary">Edit Category</button>
											        </form>
											      </div>
											    </div>
											  </div>
											</div>
											<form action='{{url("dashboard/category/$category->id")}}' method="POST" class="form-delete deleteCategory">
                                            	@method("DELETE")
                                            	@csrf
                                            	<button type="submit" class="btn btn-dangere delete-btn" onclick="return confirm('Are you sure ?')">Delete</button>
                                        	</form>
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
</div>
<script>
	$(document).ready(function() {

		// // First Display data category when page is already load
		// loadDataCategory();

		// Load data category
		function loadDataCategory() {
			$('#container-data').load('/dashboard/category/loadcategory', function(data) {
				$('#container-data').html(data);
			});
		}

		// Button add category on click
		

		
		
	});
</script>