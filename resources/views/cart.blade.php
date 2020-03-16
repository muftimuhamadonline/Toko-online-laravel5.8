@extends('layout.main')

@section('title', 'Cart')

@section('newclass', 'header--3 bg__white')

@section('container')
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{asset('templates/template1/images/bg/7.png')}}) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Cart</h2>
                        <nav class="bradcaump-inner">
                          <a class="breadcrumb-item" href="/">Home</a>
                          <span class="brd-separetor">/</span>
                          <span class="breadcrumb-item active">Cart</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="cart-main-area ptb--120 bg__white">
    <div class="container">
    	<div class="row">
    		<div class="col">
    			@if( Session::has("success"))
		            <div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<i class="fa fa-check-circle"></i> {{Session::get('success')}}
					</div>
				@endif
				@if (Session::has("error"))
	                <div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<i class="fa fa-times-circle"></i>{{Session::get('error')}}
					</div>
	                @endif
    		</div>
    	</div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
            @if($countCart == 0)
                <div class="row">
                    <div class="col" style="min-height: 500px;">
                        <h2>Item in cart is empty...</h2><
                    </div>
                </div>
            @else                 
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="container-cart">
                        	@foreach($items as $item)
                            <tr>
                                @if($item->coupon_id != NULL)
                                <input type="hidden" name="id" value="{{$item->coupon->id}}" id="discountId">
                                <input type="hidden" name="code" value="{{$item->coupon->code}}" id="discountCode">
                                <input type="hidden" name="discount" value="{{$item->coupon->discount}}" id="discountItem" />
                                @endif
                 				<td class="product-thumbnail"><a href="{{url('/shop/product-details/')}}/{{$item->product->id}}"><img src="{{URL::asset('templates/template1/images/product/'.$item->product->picture)}}" alt="product img" /></a></td>
                                <td class="product-name"><a href="{{url('/shop/product-details')}}/{{$item->product->id}}">{{$item->product->name}}</a></td>
                                <td class="product-price"><span class="amount">{{number_format($item->product->price,0,"",".")}}</span></td>
                                <td class="product-quantity">
                                    <a href="#" class="minusButton" style="font-size: 18px;">-</a>
                                    <form action="" method="POST" class="formQuantity" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" id="idCart" value="{{$item->id}}" />
                                        <input type="text" name="quantity" class="text-center quantityCart" value="{{$item->quantity}}" autocomplete="off" />
                                        <button type="submit" style="display:none;">Kirim</button>
                                    </form> 
                                    <a href="#" class="plusButton" style="font-size: 18px;">+</a>
                                </td>
                                <td class="product-subtotal">{{number_format($item->subtotal,0,"",".")}}</td>
                                <td class="product-remove"><a href="/cart/delete/{{$item->id}}">X</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="buttons-cart">
                            <input type="submit" value="Update Cart" />
                            <a href="/shop">Continue Shopping</a>
                        </div>
                        <div class="coupon">
                            <h3>Coupon</h3>
                            <p id="messageCoupon">Enter your coupon code if you have one.</p>
                            <form action="" method="POST" id="formCoupon">
                                @csrf
                                <input type="hidden" name="idForm" value="">
                                <input type="text" id="codeCoupon" name="coupon" placeholder="Coupon code" required="required" />
                                <input type="submit" value="Apply Coupon" id="applyButton" />
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 ">
                        <div class="cart_totals">
                            <h2>Cart Totals</h2>
                            <table>
                                <tbody id="container-TotalCart">
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <strong class="amount">ID
                                                <span class="amount" id="totalCart">
                                            	{{number_format($price,0, "", ".")}}
                                                </span>
                                            </strong>
                                        </td>
                                    </tr>                                           
                                </tbody>
                            </table>
                            <div class="wc-proceed-to-checkout">
                                <a href="/cart/checkout" id="proceedCheckout">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->
<script>
    $(document).ready(function() {
       // Session if cart use coupon discount
        var discount = $('#discountItem').val();
        var code = $('#discountCode').val();
        var id = $('#discountId').val();

        if(code != undefined)
        {
            // Remove apply coupon
            $.get('/cart/delete/coupon/' + id, function(data) {
                alert(data);
            });
            $('#messageCoupon').text('Coupon successfully applied!').css({'color' : 'green','font-weight' : 'bolder'});
            $('#codeCoupon').val(code).css('border','2px solid green');
        } 
    });
</script>
<script>
    $(document).ready(function() {

        // Disabled enter button for input quantity
        $(document).keypress(
          function(event){
            if (event.which == '13') {
              event.preventDefault();
            }
        });


        // Allow only numeric in input quantity
        $(".quantityCart").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });


        // Quantity cart on keyup
        $('.quantityCart').on('keyup', function() {
            // Get the value
            var qty = $(this).val();
    
            if (qty != '')
            {
                var form = $(this).parent();
                var id = $(this).prev().val();
                var price = $(this).parent().parent().next();

                $.post('/cart/update/' + id, form.serialize(), function(result) {
                    var data = jQuery.parseJSON(JSON.stringify(result));

                    if ( data.status == 'success'){
                        
                        price.text(formatNumber(data.subtotal));
                        
                        // Load data total cart with ajax
                        $('#container-TotalCart').load('/cart/total/000');
                    }
                });

            }
        });


        // Change the cursor when quantity value is 1
        $('.minusButton').on('mouseenter', function() {
            var qty = $(this).next().children('.quantityCart').val();
            if ( qty == 1){

                $(this).css('cursor','not-allowed');
               
            }
            
        })


        // Plus Button on click
        $('.plusButton').on('click', function(e) {
            e.preventDefault();

            // Get value coupon if not empty
            var code = $('#formCoupon').children('#codeCoupon').val();

            if (code != '')
            {
                var qty = parseInt($(this).prev().children('.quantityCart').val());

                // Change the value
                var newQty = $(this).prev().children('.quantityCart').val(qty + 1);

                // Update data quantity with form use ajax
                var form = $(this).prev();
                var id = $(this).prev().children('#idCart').val();
                var price = $(this).parent().next();
                $.post('/cart/update/' + id, form.serialize(), function(result) {
                    var data = jQuery.parseJSON(JSON.stringify(result));

                    if ( data.status == 'success'){
                        
                        price.text(formatNumber(data.subtotal));
                        
                        // Submit form with code coupon
                        $('#formCoupon').trigger('submit');
                    }
                });
        
            }
            else
            {
                // Get the value quantity
                var qty = parseInt($(this).prev().children('.quantityCart').val());

                // Change the value
                var newQty = $(this).prev().children('.quantityCart').val(qty + 1);

                // Update data quantity with form use ajax
                var form = $(this).prev();
                var id = $(this).prev().children('#idCart').val();
                var price = $(this).parent().next();
                $.post('/cart/update/' + id, form.serialize(), function(result) {
                    var data = jQuery.parseJSON(JSON.stringify(result));

                    if ( data.status == 'success'){
                        
                        price.text(formatNumber(data.subtotal));

                        // Load total cart with ajax
                        $('#container-TotalCart').load('/cart/total/000');
                        
                    }
                });
            }

            
        });

        // Minus Button on click
        $('.minusButton').on('click', function(e) {
            e.preventDefault();

            var code = $('#formCoupon').children('#codeCoupon').val();

            // Cek if coupon code is not empty
            if (code != '')
            {
                // Get the value of quantity
                var qty = parseInt($(this).next().children('.quantityCart').val());

                if (qty != 1)
                {
                   var newQty = $(this).next().children('.quantityCart').val(qty - 1); 
                }

                // Update data quantity with ajax
                var form = $(this).next();
                var id = $(this).next().children('#idCart').val();
                //get the price element
                var price = $(this).parent().next();
                $.post('/cart/update/' + id, form.serialize(), function(result) {
                    var data = jQuery.parseJSON(JSON.stringify(result));

                    if ( data.status == 'success'){

                        // Change price 
                        price.text(formatNumber(data.subtotal));
                        
                        // Load total cart with ajax
                        $('#formCoupon').trigger('submit');
                        
                    }
                });
            }
            else
            {
                // Get the value of quantity
                var qty = parseInt($(this).next().children('.quantityCart').val());

                if (qty != 1)
                {
                   var newQty = $(this).next().children('.quantityCart').val(qty - 1); 
                }

                // Update data quantity with ajax
                var form = $(this).next();
                var id = $(this).next().children('#idCart').val();
                //get the price element
                var price = $(this).parent().next();
                $.post('/cart/update/' + id, form.serialize(), function(result) {
                    var data = jQuery.parseJSON(JSON.stringify(result));

                    if ( data.status == 'success'){

                        // Change price 
                        price.text(formatNumber(data.subtotal));
                        
                        // Load total cart with ajax
                        $('#container-TotalCart').load('/cart/total/000');
                        
                    }
                });
            }
            
            
            
        });



        // Form Coupon on submit
        $('#formCoupon').on('submit', function(e) {
            e.preventDefault();
            

            var code = $(this).children('#codeCoupon').val();

            $.post('/cart/coupon', $(this).serialize(), function(result) {
                var data = jQuery.parseJSON(JSON.stringify(result));

                if ( data.status == 'success')
                {
                    // Change the text succes applied coupon
                    $('#messageCoupon').text(data.message).css('color', 'green');
                    $('#codeCoupon').css('border','2px solid green');
                    $('#applyButton').val('Remove Coupon');

                    // Load data total cart with ajax
                    $('#container-TotalCart').load('/cart/total/' + data.id_coupon);
                    
                }

                if ( data.status == 'error')                
                {
                    // Change the text invalid
                    $('#messageCoupon').text(data.message).css('color', 'red');
                    $('#codeCoupon').css('border','2px solid red');
                    $('#formCoupon').children('#codeCoupon').val('');

                    // Load data total cart with ajax
                    $('#container-TotalCart').load('/cart/total/000');
                }
            });

            
        });




        // Function for format number in JS
        function formatNumber(num) {
          return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }

    });
</script>
@endsection
