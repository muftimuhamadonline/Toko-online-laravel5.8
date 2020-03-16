@extends('layout.main')

@section('title', 'Uniqlo - Order History Page')

@section('newclass', 'header--3 bg__white')
<style>
    .arrow{
        display: inline-block;
        width: 9px;
        height: 9px;
        border-right: 2px solid white;
        border-bottom: 2px solid white;
        transform: rotate(-45deg);
        animation: spin 1s linear;
    }
    .box-status{
        padding: 50px;
        background-color: #f2f2f2;
        cursor: pointer;
    }

    .claim-button a{
        display: inline-block;
        padding: 10px 35px;
        background-color: black;
        color: white;
        font-weight: bolder;
        text-transform: capitalize;
    }

    .claim-button a:hover{
        background:#ff4136;
        color:#fff !important;
    }
    
</style>

@section('container')
<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{asset('templates/template1/images/bg/7.png')}}) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Order Page</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="/">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <a class="breadcrumb-item" href="/orders">Order</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">History</span>
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
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col">
                        <div class="buttons-cart">
                        <a href="{{url('/orders')}}" id="historyOrders" style="font-size: 18px;"> Back to list order </a>
                        </div>
                    </div>     
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">Order ID</span></th>
                                                <th class="product-thumbnail">Date</th>
                                                <th class="product-name"><span class="nobr">Recipient</span></th>
                                                <th class="product-price"><span class="nobr"> Address </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment </span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Details Order</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($numRow == 0)
                                            <tr>
                                                <td colspan="6" style="color:red;">There's nothing in here.. want to <a href="/shop"><u>shop</u>?</a></td>
                                            </tr>
                                            @else
                                            @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->created_at}}</td>
                                                <td>{{$order->recipient}}</td>
                                                <td>{{$order->address}}</td>
                                                <td>
                                                    @if($order->payment == 'waiting')
                                                    <span style="color: red;">You haven't made a payment yet</span>
                                                    <p><a href="#" class="linkInstruction"><u>see instruction</u></a></p>
                                                    <div class="modal fade" id="instructionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">How to payment ?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td class="product-add-to-cart">
                                                    <span  id="statusOrder" style="display: none;">{{$order->status}}</span>
                                                    <a href="#" class="details-order"> Details Order<i class="arrow"></i></a>
                                                </td>
                                            </tr>
                                            <tr class="showDetails" style="display: none;">
                                                <td colspan="6">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h2>Order Details</h2>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            @foreach($order->orderdetail as $product)
                                                            <div class="col-md-3" style="text-align: left;">
                                                                <div class="shp__single__product">
                                                                    <div class="shp__pro__thumb">
                                                                        <a href="#">
                                                                            <img src="{{URL::asset('templates/template1/images/product/'.$product->product->picture)}}" alt="product images">
                                                                        </a>
                                                                    </div>
                                                                    <div class="shp__pro__details">
                                                                        <h2><a href="#">{{$product->product->name}}</a></h2>
                                                                        <span class="quantity">Quantity : {{$product->quantity}}</span>
                                                                        <span class="shp__price">IDR {{number_format($product->subtotal,0,"",".")}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="row mt-2" style="text-align: right;">
                                                            <div class="col">
                                                                <p><b>Subtotal : IDR {{number_format(10000,0,'','.')}}</b></p>
                                                                <p><b>Shipping : IDR {{number_format($order->shipping,0,'','.')}}</b></p>
                                                                <p><b>TOTAL : IDR {{number_format($order->total,0,'','.')}}</b></p>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-4" style="text-align: left;">
                                                            <div class="col-md-10">
                                                                <h3 style="font-size: 20px;">Status : 
                                                                    <span class="badge badge-danger">
                                                                        {{$order->status}}
                                                                    </span>
                                                                    @if($order->status == 'Ordered')
                                                                    <span style="font-size: 15px; color: red;">(*Please complete the payment! our admin will checking your ordered soon...)</span>
                                                                    @endif
                                                                </h3>
                                                            </div> 
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col text-left">
                                                                <h3 style="font-size: 18px; color: grey;">Details Shipping :</h3>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col text-left">
                                                                <h3 style="font-size: 16px; color: grey;">Recipient : {{$order->recipient}}</h3>
                                                                <h3 style="font-size: 16px; color: grey;">Destination Address : {{$order->address}}</h3>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5" style="text-align: right;">
                                                            <div class="col">
                                                                <div class="claim-button">
                                                                    <a href="#">Claim Order</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="wishlist-share">
                                                        <h4 class="wishlist-share-title">Share on:</h4>
                                                        <div class="social-icon">
                                                            <ul>
                                                                <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li>
                                                                <li><a href="#"><i class="zmdi zmdi-vimeo"></i></a></li>
                                                                <li><a href="#"><i class="zmdi zmdi-tumblr"></i></a></li>
                                                                <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                                                                <li><a href="#"><i class="zmdi zmdi-linkedin"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- orders-area end -->
<script>
    $(document).ready(function() {
        $('.showDetails').slideUp();
        // Details on click show details product
        $('.details-order').on('click', function(e) {
            e.preventDefault();

            $(this).parent().parent().next().slideToggle('slow');
        });
        
        // Show the instruction modal when link on click
        $('.linkInstruction', this).on('click', function(e) {
            e.preventDefault(e);

            $('#instructionModal').modal('show');
        });

    });
</script>
@endsection

