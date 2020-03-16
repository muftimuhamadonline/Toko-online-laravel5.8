@extends('layout.main')

@section('title', 'Login or Register')

@section('newclass', 'header--3 bg__white')

@section('container')

		<!-- Start Login Register Area -->
        <div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url({{asset('templates/template1/images/bg/7.png')}}) no-repeat scroll center center / cover ;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <ul class="login__register__menu nav justify-contend-center" role="tablist">
                            <li role="presentation" class="login active"><a class="active" href="#login" role="tab" data-toggle="tab">Login</a></li>
                            <li role="presentation" class="register"><a href="#register" role="tab" data-toggle="tab">Register</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Start Login Register Content -->
                <div class="row tab-content">
                    <div class="col-md-6  ml-auto mr-auto">
                        <div class="htc__login__register__wrap">
                            <!-- Start Single Content -->
                            <div id="login" role="tabpanel" class="single__tabs__panel tab-pane active">
                                <form class="login" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <input type="email" placeholder="Email*" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" />

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input type="password" placeholder="Password*" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="tabs__checkbox">
                                        

                                        @if (Route::has('password.request'))
                                        <span class="forget"><a href="{{ route('password.request') }}">Forget Pasword?</a></span>
                                        @endif
                                    </div>
                                    <div class="htc__login__btn mt--30">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                    <div class="htc__social__connect">
                                        <h2>Or Login With</h2>
                                        <ul class="htc__soaial__list">
                                            <li><a class="bg--twitter" href="https://twitter.com/devitemsllc" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>

                                            <li><a class="bg--instagram" href="https://www.instagram.com/devitems/" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>

                                            <li><a class="bg--facebook" href="https://www.facebook.com/devitems/?ref=bookmarks" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>

                                            <li><a class="bg--googleplus" href="https://plus.google.com/" target="_blank"><i class="zmdi zmdi-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </form>
                               
                                
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div id="register" role="tabpanel" class="single__tabs__panel tab-pane">
                                <form class="login" method="post" action="{{ route('register') }}">
                                    @csrf
                                    
                                    <input type="text" placeholder="Name*" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                   
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input type="email" placeholder="Email*" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input type="password" placeholder="Password*" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <input type="password" placeholder="Confirm Password*" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                    <div class="htc__login__btn">
                                        <button type="submit" class="btn btn-primary">Register</a>
                                    </div>
                                </form>
                                
                                <div class="htc__social__connect">
                                    <h2>Or Login With</h2>
                                    <ul class="htc__soaial__list">
                                        <li><a class="bg--twitter" href="https://twitter.com/devitemsllc" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a class="bg--instagram" href="https://www.instagram.com/devitems/" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
                                        <li><a class="bg--facebook" href="https://www.facebook.com/devitems/?ref=bookmarks" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a class="bg--googleplus" href="https://plus.google.com/" target="_blank"><i class="zmdi zmdi-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
                <!-- End Login Register Content -->
            </div>
        </div>
        <!-- End Login Register Area -->

@endsection