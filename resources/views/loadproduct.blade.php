@if($hitung==0)
<div class="mt-5 d-flex justify-content-center"">
<h1 class="text-align-center">Maaf Product tidak ditemukan</h1>
@else
</div>
<div class="row product__list">
                        @foreach ($products as $product)
                        <!-- Start Single Product -->
                        <div class="col-md-3 single__pro col-lg-3 col-md-4 cat--{{$product->categories_id}} col-sm-12">
                            <div class="product foo">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="#">
                                            <img src="{{URL::asset('templates/template1/images/product/'.$product->picture) }}" alt="product images">
                                        </a>
                                    </div>
                                    <div class="product__hover__info">
                                        <!-- <ul class="product__action"> -->
                                           <!--  <li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                            <li> -->
                                                <form action="/cart/addtocart" method="post" class="addtocart">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product->id}}" id="id_product"/>
                                                <input type="hidden" name="quantity" value="1" id="qty" />
                                                <input type="hidden" name="subtotal" value="{{$product->price * 1}}" id="subtotal">
                                                <button type="submit" class="btn btn-dark">Tambah Keranjang</button>
                                                </form>
                                                
                                            <!-- </li> -->
                                        <!-- </ul> -->
                                    </div>
                                    <div class="add__to__wishlist">
                                        <a data-toggle="tooltip" title="Add To Wishlist" class="add-to-cart" href="wishlist.html"><span class="ti-heart"></span></a>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <input type="hidden" name="categories_id" id="categoId" value="{{$product->categories_id}}">
                                    <h2><a href="/shop/{{$product->id}}">{{$product->name}}</a></h2>
                                    <ul class="product__price">
                                        <li class="old__price">$16.00</li>
                                        <li class="new__price">IDR {{number_format($product->price, 0, "", ".")}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                        @endforeach
                        @endif
                    </div>