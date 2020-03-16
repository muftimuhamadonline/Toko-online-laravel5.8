@extends('layout.main')

@section('title', 'Checkout')

@section('newclass', 'header--3 bg__white')

@section('container')
<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{asset('templates/template1/images/bg/7.png')}}) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Checkout</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">Checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Checkout Area -->
        <section class="our-checkout-area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <div class="ckeckout-left-sidebar">
                            <!-- Start Checkbox Area -->
                            <div class="checkout-form">
                            <form action="/cart/checkout/purchase" method="post" id="formpurchase">
                                @csrf
                                <input type="hidden" name="total" id="kirimtotal" value="">
                                <input type="hidden" name="shipping" id="kirimshipping" value="">
                                 
                                <h2 class="section-title-3">Billing details</h2>
                                <div class="checkout-form-inner">
                                    <div class="single-checkout-box">
                                        <input type="text" placeholder="Your Name*" name="recipient" value="{{$user->name}}" class="form-control">
                                    </div>
                                    <div class="single-checkout-box">
                                        <input type="email" placeholder="E-mail*" value="{{$user->email}}" class="form-control">
                                    </div>
                                    <div class="single-checkout-box">
                                        <input type="text" placeholder="Phone*" name="telephone" class="form-control">
                                    </div>
                                    <div class="form-group" style="width: 350px; margin-bottom: 30px;">
                                       <select class="form-control" id="provinsi">
                                        <option>Pilih Provinsi</option>
                                        @foreach($provinces as $p)
                                        <option class="id_prov" provid="{{$p['province_id']}}">{{$p['province']}}</option> 
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="width: 350px; margin-bottom: 30px;">
                                       <select class="form-control" id="kota">
                                        <option id="pilihkota">Pilih Kota</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="width: 350px; margin-bottom: 30px;">
                                       <select class="form-control" id="ekspedisi">
                                        <option value="pilih">Pilih Ekspedisi</option>
                                        <option value="pos">POS INDONESIA</option>
                                        <option value="jne">JNE</option>
                                        <option value="tiki">TIKI</option>
                                        </select>
                                    </div>
                                    
                                    <div class="single-checkout-box">
                                        <textarea name="address" placeholder="Address*" name="address" class="form-control"></textarea>
                                    </div>

                                </div>
                            </div>
                            <!-- End Checkbox Area -->
                            <!-- Start Payment Box -->
                            <div class="payment-form">
                                <h2 class="section-title-3">payment details</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur kgjhyt</p>
                                <div class="payment-form-inner">
                                    <div class="single-checkout-box">
                                        <input type="text" placeholder="Name on Card*">
                                        <input type="text" placeholder="Card Number*">
                                    </div>
                                    <div class="single-checkout-box select-option">
                                        <select>
                                           
                                            <option>Date</option>
                                            <option>Date</option>
                                            <option>Date</option>
                                            <option>Date</option>
                                        </select>
                                        <input type="text" placeholder="Security Code*">
                                    </div>
                                </div>
                            </div>
                            </form>
                            <!-- End Payment Box -->
                            <!-- Start Payment Way -->
                            <div class="our-payment-sestem">
                                <h2 class="section-title-3">We  Accept :</h2>
                                <ul class="payment-menu">
                                    <li><a href="#"><img src="images/payment/1.jpg" alt="payment-img"></a></li>
                                    <li><a href="#"><img src="images/payment/2.jpg" alt="payment-img"></a></li>
                                    <li><a href="#"><img src="images/payment/3.jpg" alt="payment-img"></a></li>
                                    <li><a href="#"><img src="images/payment/4.jpg" alt="payment-img"></a></li>
                                    <li><a href="#"><img src="images/payment/5.jpg" alt="payment-img"></a></li>
                                </ul>
                                <div class="checkout-btn">
                                    <a class="ts-btn btn-light btn-large hover-theme" id="clickpurchase" href="#">CONFIRM & BUY NOW</a>
                                </div>    
                            </div>
                            <!-- End Payment Way -->
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="checkout-right-sidebar">
                            <div class="our-important-note">
                                <h2 class="section-title-3">Note :</h2>
                                @foreach ($items as $item)
                                <div class="shp__single__product">
                                    <div class="shp__pro__thumb">
                                        <a href="#">
                                            <img src="{{URL::asset('templates/template1/images/product/'.$item->product->picture)}}" alt="product images">
                                        </a>
                                    </div>
                                    <div class="shp__pro__details">
                                        <h2><a href="#">{{$item->product->name}}</a></h2>
                                        <span class="quantity">Qty : {{$item->quantity}}</span>
                                        <span class="shp__price">IDR {{number_format($item->subtotal,0,"",".")}}</span>
                                    </div>
                                    <div class="remove__btn">
                                        <a href="/cart/delete/{{$item->id}}" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="cart_totals">
                               
                                <h2>Cart Totals</h2>
                                <table>
                                    <tbody id="container-TotalCart">
                                        <tr class="order-total">
                                            <th>SUBTOTAL</th>
                                            <td>
                                                <strong class="amount">
                                                    <span class="amount" id="belum" harga="{{$price}}">
                                                    {{number_format($price,0, "", ".")}}
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
     
                                        <tr class="order-total">
                                            <th>SHIPPING</th>
                                            <td>
                                                <strong class="amount"> 
                                                    <span class="amount" id="shipping" style="font-size: 16px; color: red;">
                                                    select expedition
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr class="order-total" id="totalCheckout">
                                            <th>TOTAL</th>
                                            <td>
                                                <strong class="amount"> 
                                                    <span class="amount" id="final">
                                                    -
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>                                         
                                    </tbody>
                                </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Checkout Area -->
        <script>
            $(document).ready(function() 
            {
                var tampungEks; 
                var tampungkota;
                $('#clickpurchase').on('click', function(e) {
                    e.preventDefault();
                    $('#formpurchase').trigger('submit');
                });

                $('#provinsi').on('change', function()
                {
                var tampung = $("#provinsi option:selected").attr("provid");
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: '{{url("/cart/checkout/")}}'+'/'+tampung,
                    success : function(data)
                    {
                        $('.daftarkota').remove();
                        data.forEach(function (item)
                        {
                            $('<option>').val(item.city_id).text(item.city_name).addClass('daftarkota').insertAfter($('#pilihkota'));
                        });
                    }
                    });
                });
                $('#kota').on('change',function()
                {
                    //menampung id dari kota yang di pilih
                    tampungkota = $('#kota option:selected').val();
                    $('#ekspedisi').val('pilih');
                });
                $('#ekspedisi').on('change', function(){
                    tampungEks = $('#ekspedisi option:selected').val();
                    $.ajax({
                        type: 'get',
                        dataType: 'json',
                        data:  'tampungkota='+tampungkota+'&tampungEks='+tampungEks,
                        url: '{{url("/cart/checkout/ongkir")}}'+'/'+tampungkota,
                        success: function(data){
                          var shipping = jQuery.parseJSON(JSON.stringify(data));
                          
                          $('#shipping').text(shipping).val(shipping).css('color','black');
                          $('#kirimshipping').val(shipping);
                          console.log(shipping);

                          //untuk mendapatkan total
                          var ship = $('#shipping').val();
                          var belum = $('#belum').attr('harga');
                          var belumdiskon = $('#belumdiskon').attr('belumdiskon');
                          $.ajax({
                            type:'get',
                            dataType:'json',
                            data: 'ship='+ship+'&belum='+belum+'&belumdiskon='+belumdiskon,
                            url: '{{url("/cart/final")}}',
                            success:function(final){
                                var total = jQuery.parseJSON(JSON.stringify(final));
                                console.log(total);
                                $('#final').text(total).val(total).css('color','red');
                                $('#kirimtotal').val(total);

                            }
                          });
                        }
                    })
                });
            });
                
        </script>
@endsection