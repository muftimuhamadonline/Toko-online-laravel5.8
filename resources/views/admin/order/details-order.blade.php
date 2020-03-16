@extends('admin.template.main')

@section('title', 'Dashboard | Details Order')

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row" style="margin-bottom: 20px;">
				<div class="col-sm-4">
					<a href="/dashboard/orders" class="btn btn-primary" id="back-to-orders"><i class="fa fa-refresh"></i> Back to the list</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Order Details</h3>
							<p class="panel-subtitle">Order ID : {{$details->id}}</p>
							<p class="panel-subtitle">User ID : {{$details->user_id}}</p>
							<p class="panel-subtitle">Email : {{$details->user->email}}</p>
							<p class="panel-subtitle">Recipient : {{$details->recipient}}</p>
							<p class="panel-subtitle">Address : {{$details->address}}</p>
							<p class="panel-subtitle">Telephone : {{$details->telephone}}</p>
							<p class="panel-subtitle">Payment : {{$details->payment}}</p>
							@if($details->payment != 'confirmed' AND $details->payment == 'waiting')
							<span>Payment : &nbsp;</span><p class="panel-subtitle label label-warning" style="color:black;">Menunggu Pembayaran</p>
							@endif
						</div>
						<div class="panel-body">
							<table class="table table-hover text-center table-details" style="font-size: 16px;">
								<thead>
									<tr>
										<td>Picture</td>
										<td>Product</td>
										<td>Price</td>
										<td>Quantity</td>
									</tr>
								</thead>
								<tbody>
									@foreach($details->orderdetail as $product)
									<tr>
										<td>
											<img src="{{URL::asset('templates/template1/images/product/'.$product->product->picture)}}" width="60" height="60" />
										</td>
										<td>{{$product->product->name}}</td>
										<td>
											IDR {{number_format($product->product->price,0,'','.')}}
										</td>
										<td>{{$product->quantity}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="total">
								<h4>Subtotal : IDR {{number_format($subtotal,0,'','.')}}</h4>
								<h4>Shipping : IDR {{number_format($details->shipping,0,'','.')}}</h4>
								<h3>TOTAL : IDR {{number_format($details->total,0,'','.')}}</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection