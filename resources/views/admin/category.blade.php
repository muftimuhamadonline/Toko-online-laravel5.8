@extends('admin.template.main')

@section('title', 'Dashboard - Category')
<style>
.form-delete{
    display: inline-block;
}
.delete-btn{
    margin-left: 5px;
    background-color: #db6e6e;
    color:white;
}
.delete-btn:hover{
    background-color: #de4e4e;
    color: #fff;
}
.is-invalid{
    border: 1px solid red;
}
.invalid{
    display: block;
    color: red;
}

.loader {
  border: 10px solid #f3f3f3; /* Light grey */
  border-top: 10px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 80px;
  height: 80px;
  position: relative;
  left: 35%;
  margin-top: 250px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
@section('content')
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
											        		<input type="hidden" name="id_category" id="modalIdCategory">
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
											<a href="{{url('dashboard/category/delete/')}}/{{$category->id}}" class="btn btn-danger deleteButton" onclick="return confirm('Are you sure ?')">Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
								{{$categories->links()}}
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


		// AJAX pagination
		$('.page-link').on('click', function(e) {
			e.preventDefault();
			var link = $(this).attr('href');
			$('.main-content').html("<div class='loader'></div>").load(link, function(result) {
				$('#container-content').html(result);
			});
		});


		// Button add category on click then ajax request
		$('#addCategory').on('submit', function(e) {
			e.preventDefault();
			$('.close').trigger('click');
			$.post('/dashboard/category/add', $(this).serialize(), function(result) {
				var data = jQuery.parseJSON(JSON.stringify(result));

				if ( data.status == 1 )
				{
					alert(data.category + ' ' + data.message);
					loadDataCategory();
				}
				else
				{
					alert('error');
				}
			})
		});


		// Button edit category on click
		$('.editButton').on('click', function() {
			// Get name category and id category
			var category = $(this).parent().prev().text();
			var id_category = $(this).parent().prev().prev().text();

			// Set value input with name category and id category
			$('#modalIdCategory').val(id_category);
			$('#modalCategory').val(category);

			// Form edit on submit , request AJAX
			$('#formEdit').on('submit', function(e) {
				e.preventDefault();
				
				$('.close').trigger('click');

				$.post('/dashboard/category/edit/' + id_category, $(this).serialize(), function(result) {
					var data = jQuery.parseJSON(JSON.stringify(result));

					if ( data.status == 1)
					{
						alert(data.category + ' ' + data.message);
						loadDataCategory();
					}
					else
					{
						alert('error');
					}
				});
			});
		});


		// Delete button on click
		$('.deleteButton').on('click', function(e) {
			e.preventDefault();
			
			var link = $(this).attr('href');

			$.get(link, function(result) {
				var data = jQuery.parseJSON(JSON.stringify(result));
				
				if ( data.status == 1)
				{
					alert(data.category + ' ' + data.message);
					loadDataCategory();
				}
				else
				{
					alert('error');
				}
			
			});
		});


		// Function for load data category
		function loadDataCategory() {
			$('.main-content').html("<div class='loader'></div>").load('/dashboard/category', function(data) {
				$('#container-content').html(data);
			});
		}
		



		
	});
</script>
@endsection