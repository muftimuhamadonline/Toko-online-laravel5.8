@if(!Request::ajax())
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('templates/template1/images/favicon.ico')}}">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    
    <!-- Bootstrap Fremwork Main Css -->
    <link rel="stylesheet" href="{{asset('templates/template1/css/bootstrap.min.css')}}">
    <!-- All Plugins css -->
    <link rel="stylesheet" href="{{asset('templates/template1/css/plugins.css')}}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{asset('templates/template1/css/shortcode/shortcodes.css')}}">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{asset('templates/template1/style.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('templates/template1/css/responsive.css')}}">
    <!-- User style -->
    <link rel="stylesheet" href="{{asset('templates/template1/css/custom.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <style type="text/css">
        .lds-ellipsis {
          display: inline-block;
          position: relative;
          width: 64px;
          height: 64px;
        }
        .lds-ellipsis div {
          position: absolute;
          top: 27px;
          width: 11px;
          height: 11px;
          border-radius: 50%;
          background: #000;
          animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }
        .lds-ellipsis div:nth-child(1) {
          left: 6px;
          animation: lds-ellipsis1 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(2) {
          left: 6px;
          animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(3) {
          left: 26px;
          animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(4) {
          left: 45px;
          animation: lds-ellipsis3 0.6s infinite;
        }
        @keyframes lds-ellipsis1 {
          0% {
            transform: scale(0);
          }
          100% {
            transform: scale(1);
          }
        }
        @keyframes lds-ellipsis3 {
          0% {
            transform: scale(1);
          }
          100% {
            transform: scale(0);
          }
        }
        @keyframes lds-ellipsis2 {
          0% {
            transform: translate(0, 0);
          }
          100% {
            transform: translate(19px, 0);
          }
        }

    </style>
    
    <!-- Modernizr JS -->
    <script src="{{asset('templates/template1/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer">
        <!-- Start Header Style -->
        <header id="header" class="htc-header @yield('newclass')">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-6">
                            <div class="logo">
                                <a href="/">
                                    <img src="{{asset('templates/template1/images/logo/uniqlo.png')}}" alt="logo">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-8 col-lg-8 d-none d-md-block">
                            <nav class="mainmenu__nav  d-none d-lg-block">
                                <ul class="main__menu">
                                    <li class="drop"><a href="/">Home</a>
                                    </li>
                                    <li><a href="/about">About</a></li>
                                    <li class="drop"><a href="blog.html">Blog</a>
                                        <ul class="dropdown">
                                            <li><a href="blog.html">blog</a></li>
                                            <li><a href="blog-details.html">blog details</a></li>
                                        </ul>
                                    </li>
                                    <li class="drop"><a href="/shop">Shop</a>
                                    </li>
                                    <li><a href="contact.html">contact</a></li>
                                </ul>
                            </nav>
                            
                            <div class="mobile-menu clearfix d-block d-lg-none">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li><a href="/">Home</a></li>
                                        <li><a href="/about">About</a></li>
                                        <li><a href="blog.html">blog</a>
                                            <ul>
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="blog-details.html">blog details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">contact</a></li>
                                    </ul>
                                </nav>
                            </div>  
                        </div>
                        <!-- End MAinmenu Ares -->
                        <div class="col-md-2 col-lg-2 col-6">  
                            <ul class="menu-extra">
                                <li class="search search__open d-none d-sm-block"><span class="ti-search"></span></li>
                                <li class="cart__menu" id="cartbtn"><span class="ti-shopping-cart"></span></li>           
                                <li class="toggle__menu d-none d-md-block"><span class="ti-menu"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Style --> 

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="/shop/" method="GET">
                                    <input placeholder="Search" name="cari" id="pencarian" type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                    {{csrf_field()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Offset MEnu -->
            <div class="offsetmenu">
                <div class="offsetmenu__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a href="/">
                                <img src="{{asset('templates/template1/images/logo/uniqlo.png')}}" alt="logo">
                            </a>
                        </div>
                        @auth
                        <h4 class="offset__title mt-4">Welcome, {{ Auth::user()->name }}</h4>
                        <h4 class="offset__title">
                            <a href="/profile">Profile</a>
                        </h4>
                        <h4 class="offset__title">
                            <a href="/orders">Orders</a>
                        </h4>
                        <h4 class="offset__title">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </h4>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @else
                        <h4 class="offset__title mt-4 mb-5">
                            <a href="/login-register">Login or Register</a>
                        </h4>  
                        @endauth
                    </div>
                    <div class="offset__widget mt-5">
                        <div class="offset__single">
                            <h4 class="offset__title">Language</h4>
                            <ul>
                                <li><a href="#"> Engish </a></li>
                                <li><a href="#"> French </a></li>
                                <li><a href="#"> German </a></li>
                            </ul>
                        </div>
                        <div class="offset__single">
                            <h4 class="offset__title">Currencies</h4>
                            <ul>
                                <li><a href="#"> USD : Dollar </a></li>
                                <li><a href="#"> EUR : Euro </a></li>
                                <li><a href="#"> POU : Pound </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="offset__sosial__share">
                        <h4 class="offset__title">Follow Us On Social</h4>
                        <ul class="off__soaial__link">
                            <li><a class="bg--twitter" href="https://twitter.com/devitemsllc" target="_blank" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                            
                            <li><a class="bg--instagram" href="https://www.instagram.com/devitems/" target="_blank" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>

                            <li><a class="bg--facebook" href="https://www.facebook.com/devitems/?ref=bookmarks" target="_blank" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>

                            <li><a class="bg--googleplus" href="https://plus.google.com/" target="_blank" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>

                            <li><a class="bg--google" href="#" target="_blank" title="Google"><i class="zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Offset MEnu -->
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="container-cart text-center">
                        <a><div class='lds-ellipsis' style='margin-top:60%;'><div></div><div></div><div></div><div></div></div></a>
                    </div>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
        <div id="container-content">
        @yield('container')
        </div>

        <!-- Start Footer Area -->
        <footer class="htc__foooter__area" style="background: rgba(0, 0, 0, 0) url({{asset('templates/template1/images/bg/7.png')}}) no-repeat scroll center center / cover ;">
            <div class="container">
                <div class="row footer__container clearfix">
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-6 col-lg-3 col-sm-6">
                        <div class="ft__widget">
                            <div class="ft__logo">
                                <a href="/">
                                    <img src="{{asset('templates/template1/images/logo/uniqlo.png')}}" alt="footer logo">
                                </a>
                            </div>
                            <div class="footer__details">
                                <p>Get 10% discount with notified about the latest news and updates.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-6 col-lg-3 col-sm-6 smb-30 xmt-30">
                        <div class="ft__widget">
                            <h2 class="ft__title">Newsletter</h2>
                            <div class="newsletter__form">
                                <div class="input__box">
                                    <div id="mc_embed_signup">
                                        <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
                                            <div id="mc_embed_signup_scroll" class="htc__news__inner">
                                                <div class="news__input">
                                                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
                                                </div>
                                                <div class="clearfix subscribe__btn"><input type="submit" value="Send" name="subscribe" id="mc-embedded-subscribe" class="bst__btn btn--white__color">

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-6 col-lg-3 col-sm-6 smt-30 xmt-30">
                        <div class="ft__widget contact__us">
                            <h2 class="ft__title">Contact Us</h2>
                            <div class="footer__inner">
                                <p> 319 Clematis St. <br> Suite 100 WPB, FL 33401 </p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-6 col-lg-2 lg-offset-1 col-sm-6 smt-30 xmt-30">
                        <div class="ft__widget">
                            <h2 class="ft__title">Follow Us</h2>
                            <ul class="social__icon">
                                <li><a href="https://twitter.com/devitemsllc" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/devitems/" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="https://www.facebook.com/devitems/?ref=bookmarks" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/" target="_blank"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                </div>
                <!-- Start Copyright Area -->
                <div class="htc__copyright__area">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="copyright__inner">
                                <div class="copyright">
                                    <p>© 2018 <a href="https://freethemescloud.com/" target="_blank">Free themes Cloud</a>
                                    All Right Reserved.</p>
                                </div>
                                <ul class="footer__menu">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="/shop">Product</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Copyright Area -->
            </div>
        </footer>

        <!-- End Footer Area -->
    </div>
    @yield('endindex')
    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="{{asset('templates/template1/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Bootstrap Framework js -->
    <script src="{{asset('templates/template1/js/popper.min.js')}}"></script>
    <script src="{{asset('templates/template1/js/bootstrap.min.js')}}"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{asset('templates/template1/js/plugins.js')}}"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="{{asset('templates/template1/js/main.js')}}"></script>
    <script>
        $(document).ready(function() 
        {
            var status = "{{Auth::check()}}";
            if (status == 1)
            {
                $('#cartbtn').on('click', function() {
                    $('.empty-cart').remove();
                    $.get('getcart', function(data) {
                        $('.container-cart').html("<div class='lds-ellipsis text-center' style='margin-top: 60%;'><div></div><div></div><div></div><div></div></div>").load('getcart', function(result) {
                            $('.container-cart').html(result);
                        });
                    });
                })
            }
            else
            {
                $('#cartbtn').on('click', function() {
                    alert('Please login first!');
                    $('.shopping__cart').remove();
                    window.location.href = "http://localhost:8000/login-register";
                });
            }
            
        });
    </script>

</body>

</html>
@else
@yield('container')
@endif