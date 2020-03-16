@extends('layout.main')

@section('title', 'My Profile')

@section('newclass', 'header--3 bg__white')

@section('container')
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(201, 201, 201, 1) url({{asset('templates/template1/images/bg/7.png')}}) no-repeat scroll center center / cover ;">

    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Profile</h2>
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb-item active">Profile</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Our Store Area -->
<section class="htc__profile__area ptb--120 bg__white">
    <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('failed') }}
                </div>
            @endif
        <div class="row">
            <div class="col-md-3" id="loadImage">
                {{-- Load Image dude! --}}
            </div>
            <div class="col-md-9">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ubah Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="address-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Daftar Alamat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="password-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ubah Password</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="container-fluid mt-4 container-load">
                            {{-- JUST LOAD EVERYTHING YOU NEED --}}
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
{{-- LOAD --}}
<script>
    // load profile first when the document is ready
    $(document).ready(function(){
        $(".container-load").load("{{ url('profile/loadProfile') }}")
        $("#loadImage").load("{{ url('profile/loadImage') }}")
    });
</script>
<script>
    // load profile
    $(document).ready(function(){
        $("#home-tab").click(function(){
            $(".container-load").load("{{ url('profile/loadProfile') }}")
        });
    });
    // load Address
    $(document).ready(function(){
        $("#address-tab").click(function(){
            $(".container-load").load("{{ url('profile/address') }}")
        });
    });
    //load Change Password
    $(document).ready(function(){
        $("#password-tab").click(function(){
            $(".container-load").html('<div class="spinner"></div>').load("{{ url('profile/loadPassword') }}")
        });
    });
</script>




{{-- CRUD --}}






@endsection
    {{-- <div class="section__title section__title--2 text-center">
        <div class="testimonial__thumb">
            <img src="{{asset('templates/template1/images/test/client/1.jpg')}}" alt="testimonial images">
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore gna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
    </div> --}}