@extends('layout.main')

@section('title', 'Uniqlo - Shop Page')

@section('newclass', 'header--3 bg__white')

@section('container')
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{asset('templates/template1/images/bg/7.png')}}) no-repeat scroll center center / cover ;">

            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Shop Page</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="/">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">Shop Page</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area --> 
        <!-- Start Our Product Area -->
        <section class="htc__product__area shop__page ptb--130 bg__white">
            <div class="container">
                <div class="htc__product__container">
                    <!-- Start Product MEnu -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filter__menu__container">
                                <div class="product__menu">
                                <button data-filter="*"  class="is-checked">Semua</button>
                                @foreach($kategori as $k)
                                <button data-filter=".cat--{{$k->id}}" class="pilihKategori">{{$k->categories}}</button>
                                @endforeach
                                </div>
                                <div class="filter__box">
                                    <a class="filter__menu" href="#">filter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Filter Menu -->
                    <div class="filter__wrap">
                        <div class="filter__cart">
                            <div class="filter__cart__inner">
                                <div class="filter__menu__close__btn">
                                    <a href="#"><i class="zmdi zmdi-close" id="tutup"></i></a>
                                </div>
                                <div class="filter__content">
                                    <!-- Start Single Content -->
                                    <div class="fiter__content__inner">
                                        <div class="single__filter">
                                            <h2>Sort By</h2>
                                            <ul class="filter__list ">
                                                <select class="form-control form-control-ml" id="filterkategori">
                                                  @foreach($kategori as $k)
                                                  <option value="{{$k->id}}">{{$k->categories}}</option>
                                                  @endforeach
                                                </select>
                                            </ul>
                                        </div>
                                         <div class="single__filter">
                                            <h2>Price</h2>
                                            <ul class="filter__list">
                                                <select class="form-control form-control-ml" id="filterharga">
                                                  <option value="0-10000">IDR 0-10.000</option>
                                                  <option value="10000-100000">IDR 10.000 - 100.000</option>
                                                  <option value="100000-1000000">IDR 100.000 - 1.000.000</option>
                                                  <option value="1000000-10000000">IDR 1.000.000 - 10.000.000</option>
                                            
                                                </select>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="filter__content mt-4">
                                    <button id="btnfilter" class="btn btn-dark">Submit</button>
                                    </div>
                                    <!-- End Single Content -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Filter Menu -->
                    <!-- End Product MEnu -->
                    <div id="tampilkan-data">

                       </div> 
                    <div class="row product__list" id="asli">
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
                    </div>
                    
                    <!-- Start Load More BTn -->
                    <div class="row mt--60">
                        <div class="col-md-12">
                            <div class="htc__loadmore__btn calonhapus">
                                <a href="#">load more</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Load More BTn -->
                </div>

            </div>
        </section>
        <!-- End Our Product Area -->
@endsection

@section('endindex')
    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start product images -->
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="big images" src="{{asset('templates/template1/images/product/big-img/1.jpg')}}">
                                </div>
                            </div>
                            <!-- end product images -->
                            <div class="product-info">
                                <h1>Simple Fabric Bags</h1>
                                <div class="rating__and__review">
                                    <ul class="rating">
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#">4 customer reviews</a>
                                    </div>
                                </div>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span class="new-price">$17.20</span>
                                        <span class="old-price">$45.00</span>
                                    </div>
                                </div>
                                <div class="quick-desc">
                                    Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                                </div>
                                <div class="select__color">
                                    <h2>Select color</h2>
                                    <ul class="color__list">
                                        <li class="red"><a title="Red" href="#">Red</a></li>
                                        <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    </ul>
                                </div>
                                <div class="select__size">
                                    <h2>Select size</h2>
                                    <ul class="color__list">
                                        <li class="l__size"><a title="L" href="#">L</a></li>
                                        <li class="m__size"><a title="M" href="#">M</a></li>
                                        <li class="s__size"><a title="S" href="#">S</a></li>
                                        <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                        <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                    </ul>
                                </div>
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                            <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                            <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="addtocart-btn">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div><!-- .product-info -->
                        </div><!-- .modal-product -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>
    <!-- END QUICKVIEW PRODUCT -->
    <script>
         $(document).ready(function() {
            $('.addtocart', this).on('submit', function(e) {
                e.preventDefault();
                
                $.post('/cart/addtocart', $(this).serialize(), function(result) {
                    var data = jQuery.parseJSON(JSON.stringify(result));

                    if (data.status == 1)
                    {
                        alert(data.message);
                    }
                    else
                    {
                        alert('error');
                    }
                });
            });
            $('#btnfilter').click(function(){
                var kategori = $('#filterkategori').val();
                var price = $('#filterharga').val();
                $('#asli').hide();
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    data:  'catId='+kategori+'&price='+price,
                    url: '{{url("/shop/kategori/")}}'+'/'+kategori,
                    success : function(data){
                        $('#tampilkan-data').html(data);
                    }
                });
            });

            
        });
    </script>
@endsection