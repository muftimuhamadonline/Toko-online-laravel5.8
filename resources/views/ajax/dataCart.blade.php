@if($numRow == 0)
	<div class="empty-cart text-center" style="margin-top: 50%;">
		<i class="fas fa-shopping-cart fa-5x"></i>
		<p style="color: red; font-size: 18px; margin-top: 15px;">Your shopping cart is empty</p>
		<p style="font-size: 18px; margin-top: 20px;"><a href="/shop">GO TO SHOP</a></p>
	</div>
@else
	<div class="shp__cart__wrap">
		@foreach($carts as $cart)
        <div class="shp__single__product">
			<div class="shp__pro__thumb">
			    <a href="#">
			        <img src="{{URL::asset('templates/template1/images/product/'.$cart->product->picture)}}" alt="product images">
			    </a>
			</div>
			<div class="shp__pro__details text-left" id="item-cart">
				<span style="display: none;" id="id-cart">{{$cart->id}}</span>
			    <h2><a href="product-details.html">{{$cart->product->name}}</a></h2>
			    <span class="quantity">QTY: {{$cart->quantity}}</span>
			    <span class="shp__price">IDR &nbsp;{{number_format($cart->product->price,0,'','.')}}</span>
			</div>
			<div class="remove__btn">
			    <a href="/cart/delete/{{$cart->id}}" class="remove-cart" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
			</div>
        </div>
        @endforeach
    </div>
    <ul class="shoping__total">
        <li class="subtotal">Subtotal:</li>
        <li class="total__price">IDR &nbsp;{{number_format($subtotal,0,'','.')}}</li>
    </ul>
    <ul class="shopping__btn" style="margin-top: 20px;">
        <li><a href="/cart">View Cart</a></li>
        @if($numRow != 0)
        <li class="shp__checkout"><a href="/cart/checkout">Checkout</a></li>
        @endif
    </ul>
@endif
<script>
	$(document).ready(function() {
		$('.remove-cart').on('click', function(e) {
			e.preventDefault();
			var id = $(this).parent().siblings('#item-cart').children('#id-cart').text();
			
			$.get('/cart/delete/' + id, function(result) {
                $('.container-cart').html("<a><div class='lds-ellipsis' style='margin-top:60%;'><div></div><div></div><div></div><div></div></div></a>").load('getcart', function(data) {
                	$('.container-cart').html(data);
                });
			});
		});
	});
</script>