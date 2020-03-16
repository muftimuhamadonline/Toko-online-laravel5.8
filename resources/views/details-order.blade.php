@extends('layout.main')

@section('title', 'Uniqlo - Order Page')

@section('newclass', 'header--3 bg__white')

@section('container')
<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{asset('templates/template1/images/bg/7.png')}}) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Order Details</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="/">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">Order Details</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- order-area start -->
        <div class="wishlist-area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <div>
                                <div>
                                    <p>Order ID : {{$details->id}}</p>
                                    <p>User ID : {{$details->user_id}}</p>
                                    <p>Email : {{$details->user->email}}</p>
                                    <p>Recipient : {{$details->recipient}}</p>
                                    <p>Address : {{$details->address}}</p>
                                    <p>Telephone : {{$details->telephone}}</p>
                                    @if($details->payment == 'waiting')
                                    <p style="color: red;">
                                        <i>Anda belum melakukan pembayaran, silahkan kirimkan bukti pembayaran anda!</i>
                                        <form action="uploadpayment" method="post" id="uploadpayment">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$details->id}}" />
                                            <input type="file" name="payment" class="form-control-file @error('picture') is-invalid invalid @enderror" id="payment">
                                            @error('picture')
                                             <span class="invalid"><i>{{$message}}</i></span>
                                            @enderror
                                            <button type="submit" class="btn btn-primary" style="display: none; margin-top: 10px;" id="button">Kirim bukti pembayaran</button>
                                        </form>
                                    </p>
                                    @endif
                                    @if($details->payment != 'confirmed')
                                    <span>Payment : &nbsp;</span><p class="badge badge-warning">Menunggu Konfirmasi Pembayaran</p>
                                    @endif
                                </div>
                                <div class="panel-body">
                                    <table class="table table-hover text-center table-details" style="font-size: 16px; margin-top: 20px;">
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
                                        <p>Subtotal : IDR {{number_format($subtotal,0,'','.')}}</p>
                                        <p>Shipping : IDR {{number_format($details->shipping,0,'','.')}}</p>
                                        <p>TOTAL : IDR {{number_format($details->total,0,'','.')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 6%;">
                    <div class="col-md-4">
                        <div class="buttons-cart">
                            <a href="/shop">Back to the list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- orders-area end -->

<script>
    $(document).ready(function() {
        $('#payment').on('change', function() {
            $('#button').css('display', 'inline-block');
        });
    });
</script>
@endsection