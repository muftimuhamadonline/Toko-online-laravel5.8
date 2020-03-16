@extends('admin.template.main')

@section('title', 'Dashboard - Order List')

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row" style="margin-bottom:20px;">
				<div class="col-md-3 text-center box-filter">
					<a id="all" class="btn btn-primary btn-sort embed-responsive-item" style="margin-left:50px; display: inline-block; padding:9px 85px;" href="{{ route('filter',['status'=>'All']) }}">
							<div class="row">
								<i class="fas fa-sort-alpha-up fa-2x"></i>
							</div>
							All Orders
							<span class="badge badge-light">{{ $All }}</span>
						</a>
				</div>
				<div class="col-md-2 text-center">
					<a id="all" class="btn btn-danger btn-sort embed-responsive-item" style="margin-left:50px; display: inline-block; padding:15px 50px;"  href="{{ route('filter',['status'=>'ordered']) }}">
						<div class="row">
							<i class="fas fa-cart-arrow-down fa-2x"></i>
						</div>
						Ordered
						<span class="badge badge-light">{{ $ordered }}</span>
					</a>
				</div>
				<div  class="col-md-2 text-center">
					<a id="process" class="btn btn-warning btn-sort embed-responsive-item" style="margin-left:50px; display: inline-block; padding:15px 50px;" href="{{ route('filter',['status'=>'On Process']) }}">
						<div class="row">
							<i class="fas fa-caret-square-right fa-2x"></i>
						</div>
						On Process
						<span class="badge badge-light">{{ $Process }}</span>
					</a>
				</div>
				<div class="col-md-2 text-center">
					<a id="shipping" class="btn btn-info btn-sort embed-responsive-item" style="box-sizing:border-box; margin-left:50px; display: inline-block; padding:15px 50px;" href="{{ route('filter',['status'=>'On Shipping']) }}">
						<div class="row">
							<i class="fas fa-shipping-fast fa-2x"></i>	
						</div>		
						On Shipping
						<span class="badge badge-light">{{ $Shipping }}</span>
					</a>
				</div>
				<div class="col-md-2 text-center">
					<a id="shipped" class="btn btn-success btn-sort embed-responsive-item" style="margin-left:50px; display: inline-block; padding:15px 50px;" href="{{ route('filter',['status'=>'Shipped']) }}">
						<div class="row">
							<i class="fas fa-check fa-2x"></i>
						</div>	
						Shipped
						<span class="badge badge-light">{{ $Shipped }}</span>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Order List</h3>
						</div>
						<div class="panel-body">
							<table class="table table-hover text-center" style="font-size: 16px;">
								<thead style="font-weight: bolder;">
									<tr>
										<td>No</td>
										<td>Order Id</td>
										<td>User Email</td>
										<td>Recipient</td>
										<td>Telephone</td>
										<td>Payment</td>
										<td>Status</td>
										<td>Detail Order</td>
										<td class="update" style="display: none;">Update</td>
									</tr>
								</thead>
								<tbody>
									@foreach($orders as $order)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td class="order-id">{{$order->id}}</td>
										<td>{{$order->user->email}}</td>
										<td>{{$order->recipient}}</td>
										<td>{{$order->telephone}}</td>
										<td>{{$order->payment}}</td>
										<td class="statusparent">
											<form action="/dashboard/orders/update/{{$order->id}}" method="post" class="statusform">
												@csrf
												<select class="label 
													@if($order->status == 'On Process') label-warning @endif 
													@if($order->status == 'ordered') label-danger @endif 
													@if($order->status == 'On Shipping') label-info @endif 
													@if($order->status == 'Shipped') label-success @endif label-primary form-control-sm status" name="status" 
													@if($order->status == 'Shipped') disabled= "disabled" @endif>
														<option>{{$order->status}}</option>
														@if($order->status != 'On Process')<option>On Process</option>@endif
														@if($order->status != 'On Shipping')<option>On Shipping</option>@endif
														@if($order->status != 'Shipped')<option>Shipped</option>@endif
												</select>	
												<button type="submit" style="display: none;"></button>
											</form>
										</td>
										<td id="details-order">
											<a href="/dashboard/orders/details-order/{{$order->id}}" class="label label-success details-order">
												Details Order
											</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{$orders->links()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	//Sorting Orders ('All','On Process','Shipping','Shipped')
	$(document).ready(function(){
		$(".btn-sort").click(function(e){
			e.preventDefault();
			var linkAll = $(this).attr("href");
			
			$.get(linkAll,function(){
				window.history.pushState(null, null, linkAll);
				$("#container-content").load(linkAll);	
			});
		});
	});
</script>
<script>
	$(document).ready(function() {
		// Auto click the form update if status has change
		$('.status').on('change', function() {
			var getId = $(this).parents('.statusparent').siblings('.order-id').text();
			var status = $(this).val();
			var token = $(this).prev().val();
			var url = window.location.pathname;
			var check = confirm("Want to change to " + status + "?");
			// if confirm button oke
			if(check == true){
				$.post('/dashboard/orders/update/' + getId, {_token : token, status : status}, function(result) {
					var data = jQuery.parseJSON(JSON.stringify(result));
					if (data.status == 1) {
						alert(data.change + ' ' + data.message);
					}else{
						alert('error');
					}
					$.get(url,function(){
						window.history.pushState(null, null, url);
						$("#container-content").html("<div class='spinner'></div>").load(url);	
					});
				});
			// if confirm button Cancel
			}else{
				$.get(url,function(){
					window.history.pushState(null, null, url);
					$("#container-content").html("<div class='spinner'></div>").load(url);
						alert("Order Status Canceled");	
				});
			}
		});

		// Get the value of filter selected and set filter href
		var filter = $('#filter').val();
		$('#btnfilter').attr('href', '/dashboard/orders/filter/' + filter);
		$('#filter').on('change', function() {
			var filter = $('#filter').val();
			$('#btnfilter').attr('href', '/dashboard/orders/filter/' + filter);
		});

		// Detail button in click
        $('.details-order').on('click', function(e) {
            e.preventDefault();

           	// Get id value 
            var id_order = $(this).parent().parent().children('.order-id').text();
            document.title = 'Dashboard - Details Order';
            window.history.pushState('details', 'Details', '/dashboard/orders/' + id_order);

            $('#container-content').html("<div class='spinner'></div>").load('/dashboard/orders/details-order/' + id_order, function(data) {
        			$('#container-content').html(data);
        	});
        });

        // Function for load data details order


	});
</script>
@endsection