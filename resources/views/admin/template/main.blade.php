@if(!Request::ajax())
<!doctype html>
<html lang="en">

<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	{{-- FONTAWESOME --}}
	<link rel="stylesheet" href="{{ asset('awesome/css/all.css') }}">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('templates/dashboard/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('templates/dashboard/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('templates/dashboard/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('templates/dashboard/vendor/chartist/css/chartist-custom.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('templates/dashboard/css/main.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('templates/dashboard/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('templates/dashboard/img/favicon.png')}}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style type="text/css">
		.spinner {
		  border: 10px solid #f3f3f3; /* Light grey */
		  border-top: 10px solid #3498db; /* Blue */
		  border-radius: 50%;
		  width: 80px;
		  height: 80px;
		  position: absolute;
		  top: 50%;
		  left: 53%;
		  transform: translate(-50%, 50% );
		  animation: spin 2s linear infinite;
		}

		@keyframes spin {
		  0% { transform: rotate(0deg); }
		  100% { transform: rotate(360deg); }
		}
	</style>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="/"><img src="{{asset('templates/template1/images/logo/uniqlo.png')}}" alt="Uniqlo Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Basic Use</a></li>
								<li><a href="#">Working With Data</a></li>
								<li><a href="#">Security</a></li>
								<li><a href="#">Troubleshooting</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('templates/dashboard/img/user.png')}}" class="img-circle" alt="Avatar">
							@auth
								<span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
										<i class="lnr lnr-exit"></i><span>Logout</span>
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    	@csrf
                                	</form>
								</li>
							</ul>
							@endauth
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
					</ul>
					<ul class="nav">
						<li><a href="/dashboard/category" class="active" id="category"><i class="lnr lnr-bookmark"></i> <span>Categories</span></a></li>
					</ul>
					<ul class="nav">
						<li><a href="/dashboard/products" class="active" id="products"><i class="lnr lnr-cart"></i> <span>Product List</span></a></li>
					</ul>
					<ul class="nav">
						<li><a href="/dashboard/users" class="active"><i class="lnr lnr-user"></i> <span>User List</span></a></li>
					</ul>
					<ul class="nav">
						<li><a href="/dashboard/orders" class="active" id="orders"><i class="lnr lnr-location"></i> <span>Order List</span> <span class="badge"></span></a></li>
					</ul>
					<ul class="nav">
						<li><a href="/dashboard/changetemplate" class="active"><i class="lnr lnr-cog"></i> <span>Change Template</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN CONTENT -->
		<div id="container-content">
			@yield('content')
		</div>
		<!-- END MAIN CONTENT -->
	</div>
	<!-- END MAIN -->
	<div class="clearfix"></div>
	<footer>
		<div class="container-fluid">
			<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
		</div>
	</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{asset('templates/dashboard/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('templates/dashboard/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('templates/dashboard/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('templates/dashboard/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	{{-- <script src="{{asset('templates/dashboard/vendor/chartist/js/chartist.min.js')}}"></script> --}}
	<script src="{{ asset('templates/dashboard/scripts/klorofil-common.js')}}"></script>
	{{-- <script>
	$(function() {
		var data, options;

		// headline charts
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[23, 29, 24, 40, 25, 24, 35],
				[14, 25, 18, 34, 29, 38, 44],
			]
		};

		options = {
			height: 300,
			showArea: true,
			showLine: false,
			showPoint: false,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart', data, options);


		// visits trend charts
		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			}, {
				name: 'series-projection',
				data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
			}]
		};

		options = {
			fullWidth: true,
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showArea: true,
					showPoint: false,
					showLine: false
				},
			},
			axisX: {
				showGrid: false,

			},
			axisY: {
				showGrid: false,
				onlyInteger: true,
				offset: 0,
			},
			chartPadding: {
				left: 20,
				right: 20
			}
		};

		new Chartist.Line('#visits-trends-chart', data, options);


		// visits chart
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[6384, 6342, 5437, 2764, 3958, 5068, 7654]
			]
		};

		options = {
			height: 300,
			axisX: {
				showGrid: false
			},
		};

		new Chartist.Bar('#visits-chart', data, options);


		// real-time pie chart
		var sysLoad = $('#system-load').easyPieChart({
			size: 130,
			barColor: function(percent) {
				return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
			},
			trackColor: 'rgba(245, 245, 245, 0.8)',
			scaleColor: false,
			lineWidth: 5,
			lineCap: "square",
			animate: 800
		});

		var updateInterval = 3000; // in milliseconds

		setInterval(function() {
			var randomVal;
			randomVal = getRandomInt(0, 100);

			sysLoad.data('easyPieChart').update(randomVal);
			sysLoad.find('.percent').text(randomVal);
		}, updateInterval);

		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

	});
	</script> --}}

	<script>

	$(document).ready(function() {

		function loadDataCategory() {
			$('#container-content').html("<div class='spinner'></div>").load('/dashboard/category', function(data) {
				$('#container-content').html(data);
			});
		};

		// Function for load data products
		function loadDataProducts(){
			$('#container-content').html("<div class='spinner'></div>").load('/dashboard/products', function(data) {
				$('#container-content').html(data);
			});
		};

		// Function for load data Orders
		function loadDataOrders() {
			$('#container-content').html("<div class='spinner'></div>").load('/dashboard/orders', function(data) {
				$('#container-content').html(data);
			});
		};	


		// Side menu category on click , request data AJAX
		$('#category').on('click', function(e) {
			e.preventDefault();
			document.title = 'Dashboard - Category';
			window.history.pushState('category', 'Category', '/dashboard/category');
			loadDataCategory();
		});

	

		// Side menu products on click, request data AJAX
		$('#products').on('click', function(e) {
			e.preventDefault();
			document.title = 'Dashboard - Products';
			window.history.pushState('products', 'Products', '/dashboard/products');
			loadDataProducts();
		});



		// Side menu orders on click, request data ajax
		$('#orders').on('click', function(e) {
			e.preventDefault();
			document.title = 'Dashboard - Orders';
			window.history.pushState('orders', 'Orders', '/dashboard/orders');
			loadDataOrders();
		});
	});
	</script>
</body>

</html>
@else
@yield('content')
@endif