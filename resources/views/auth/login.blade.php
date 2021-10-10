<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>SRA | Online Payment</title>
	<link href="{{asset('template/inspinia/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('template/inspinia/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
	<link href="{{asset('template/inspinia/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('template/inspinia/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('template/inspinia/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('template/inspinia/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
	<style>
		.landing-page .header-back.one {
			background: url('{{asset('template/inspinia/img/landing/header_two_1.png')}}') 50% 0 no-repeat;
		}
		.landing-page .header-back.two {
			background: url('{{asset('template/inspinia/img/landing/header_two_1.png')}}') 50% 0 no-repeat;
		}
	</style>
</head>
<body id="page-top" class="landing-page no-skin-config">
<div class="navbar-wrapper">
	<nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="index.html">ONLINE PAYMENT</a>
			<div class="navbar-header page-scroll">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
					<i class="fa fa-bars"></i>
				</button>
			</div>
			<div class="collapse navbar-collapse justify-content-end" id="navbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a class="nav-link page-scroll" href="#page-top">Home</a></li>
					<li><a data-toggle="modal" data-target="#verifyTransactionModal">Verify</a></li>
					<li><a class="nav-link page-scroll" href="#contact">Contact</a></li>
					<li><a data-toggle="modal" href="#modal-form-pre">Pre-Registration</a></li>
					<li><a data-toggle="modal" href="#modal-form-login">Login</a></li>
				</ul>
			</div>
		</div>
	</nav>
</div>

{{-- Add Modal --}}
<div id="modal-form-pre" class="modal fade" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<form id="pre_registration_form">
			<!-- Modal content-->
			<div class="modal-content">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Pre Registration
							</div>
							<div class="panel-body">
								<div class="row">
										{!! __form::a_textbox( 4,'Last Name','lastName', 'text', 'Last Name','', '')!!}
										{!! __form::a_textbox( 4,'First Name','firstName', 'text', 'First Name','', '')!!}
										{!! __form::a_textbox( 4,'Middle Name','middleName', 'text', 'Middle Name','', '')!!}
										{!! __form::a_textbox( 4,'Phone Number','phoneNumber', 'text', 'Phone Number','', '')!!}
										{!! __form::a_textbox( 4,'Email Address','email', 'text', 'Email Address','', '')!!}
										{!! __form::a_textbox( 4,'Birthday','birthday', 'date', 'Birthday','', '')!!}
									<div class="col-sm-12 m-t-lg">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Address
											</div>
											<div class="panel-body">
												<div class="row">
													{!! __form::a_textbox( 4,'Street No./Lot No./Subd./Bldg.','street', 'text', 'Street','', '')!!}
													{!! __form::a_textbox( 4,'Barangay','barangay', 'text', 'Barangay','', '')!!}
													{!! __form::a_textbox( 4,'Municipality/City','city', 'text', 'Municipality/City','', '')!!}
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-12 m-t-lg">
										<div class="panel panel-primary">
											<div class="panel-heading">
												Business Information
											</div>
											<div class="panel-body">
												<div class="row">
													{!! __form::a_textbox( 12,'Business Name','businessName', 'text', 'Business Name','', '')!!}
													{!! __form::a_textbox( 4,'TIN','businessTin', 'text', 'TIN','', '')!!}
													{!! __form::a_textbox( 4,'Business Contact','businessPhone', 'text', 'Business Contact','', '')!!}
													{!! __form::a_textbox( 4,'Position','position', 'text', 'Position','', '')!!}
													{!! __form::a_textbox( 4,'Street No./Lot No./Subd./Bldg.','businessStreet', 'text', 'Street','', '')!!}
													{!! __form::a_textbox( 4,'Barangay','businessBarangay', 'text', 'Barangay','', '')!!}
													{!! __form::a_textbox( 4,'Municipality/City','businessCity', 'text', 'Municipality/City','', '')!!}
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i> Save
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!--LOGIN MODAL-->
<div id="modal-form-login" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6 b-r">
						<h3 class="m-t-none m-b">Sign in</h3>
						<p>SRA | ONLINE PAYMENT</p>
						<form class="m-t" method="POST" action="{{ route('auth.login') }}">
							@csrf
							<div class="form-group">
								<label>User Name</label>
								<input type="text" name="email" class="form-control" placeholder="Username" required="">
								@if ($errors->has('email'))
									<label class="error text-danger">{{$errors->first('email')}}</label>
								@endif
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control" placeholder="Password" required="">
								@if ($errors->has('password'))
									<label class="error text-danger">{{$errors->first('password')}}</label>
								@endif
							</div>
							<div class="col-sm-12 no-padding" style="overflow:auto;">
								<button class="btn btn-sm btn-primary pull-right m-t-sm">
									<strong>Log in</strong>
								</button>
							</div>
						</form>
					</div>
					<div class="col-sm-6">
						<h4>Not a member?</h4>
						<p><a class="navy-link" href="#" role="button">Create an account</a></p>
						<div class="col-sm-12" align="center" style="padding:20px 10px 20px 25px">
							<img style="width:100%" src="{{asset('images/SRA_DA_logo.png')}}" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--LOGIN MODAL-->

<div id="inSlider" class="carousel slide" data-ride="carousel" >
	<ol class="carousel-indicators">
		<li data-target="#inSlider" data-slide-to="0" class="active"></li>
		<li data-target="#inSlider" data-slide-to="1"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="carousel-item active">
			<div class="container">
				<div class="carousel-caption">
					<h1>Integrity<br/>
						Innovativeness<br/>
						Competence<br/>
						Professionalism</br>
						Accountability</h1>
				</div>
				<div class="carousel-image wow zoomIn">
					<img src="{{asset('template/inspinia/img/landing/laptop_1.png')}}" alt="laptop"/>
				</div>
			</div>
			<!-- Set background for slide in css -->
			<div class="header-back one"></div>

		</div>
		<div class="carousel-item">
			<div class="container">
				<div class="carousel-caption blank">
					<h1>Sugar Regulatory Administration<br/> Online Payment</h1>
					<p>Specifically design for all of the transaction.</p>
				</div>
			</div>
			<!-- Set background for slide in css -->
			<div class="header-back two"></div>
		</div>
	</div>
	<a class="carousel-control-prev" href="#inSlider" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#inSlider" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<section id="features" class="container services">
	<div class="row">
		<div class="col-sm-3">
			<h2>Mandate</h2>
			<p>The legal mandate of SRA is embodied in Executive Order No. 18 dated May 28, 1986 creating the Sugar Regulatory Administration. It states .....</p>
			<p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
		</div>
		<div class="col-sm-3">
			<h2>Vision</h2>
			<p>"By 2040, the Philippines shall have a globally competitive sugarcane insdustry that supports the food, power, and other related industries ...."</p>
			<p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
		</div>
		<div class="col-sm-3">
			<h2>Mission</h2>
			<p>"SRA is a Government Owned and Controlled Corporation which formulate responsiveness development and regulatory policies, and provides RD & E services ....."</p>
			<p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
		</div>
		<div class="col-sm-3">
			<h2>Quality Policy</h2>
			<p>"SRA is committed to promote the advancement and competitiveness of the sugarcane industry amidst global challenges. It shall continue to improve the way ......"</p>
			<p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
		</div>
	</div>
</section>

<section id="contact" class="gray-section contact">
	<div class="container">
		<div class="row m-b-lg">
			<div class="col-lg-12 text-center">
				<div class="navy-line"></div>
				<h1>Contact Us</h1>
				<p>Please contact us or come to our office. Don't forget to bring pizza ^_^</p>
			</div>
		</div>
		<div class="row m-b-lg justify-content-center">
			<div class="col-lg-3 ">
				<address>
					<strong><span class="navy">Sugar Regulatory Administration</span></strong><br/>
					Sugar Center Bldg.,<br/>
					North Avenue, Quezon City<br/>
				</address>
			</div>
			<div class="col-lg-4">
				<p class="text-color">
					Sugar Regulatory Administration message or something good to put here,
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<a href="mailto:test@email.com" class="btn btn-primary">Send us mail</a>
				<p class="m-t-sm">
					Or follow us on social platform
				</p>
				<ul class="list-inline social-icon">
					<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
					</li>
					<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
					</li>
					<li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center m-t-lg m-b-lg">
				<p><strong>&copy; 2021 Sugar Regulatory Administration</strong></div>
		</div>
	</div>
</section>

<!--MODAL-->
<div class="modal inmodal" id="verifyTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-laptop modal-icon"></i>
				<h4 class="modal-title">ONLINE VERIFICATION</h4>
				<small class="font-bold">Please provide the transaction id that you want to verify.</small>
			</div>
			<div class="modal-body">
				<form action="{{route('verifyTransaction')}}" method="GET" target="_blank">
					@csrf
					<div class="form-group mb-4">
						<input name="transactionID" id="transactionID" type="text" class="form-control text-center" placeholder="Enter Transaction ID">
					</div>

					<button id="searchTransaction" name="searchTransaction" type="submit" class="btn btn-info btn-rounded btn-block btn-outline"><i class="fa fa-search"></i> Search</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('template/inspinia/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('template/inspinia/js/popper.min.js')}}"></script>
<script src="{{asset('template/inspinia/js/bootstrap.js')}}"></script>
<script src="{{asset('template/inspinia/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('template/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('template/inspinia/js/inspinia.js')}}"></script>
<script src="{{asset('template/inspinia/js/plugins/pace/pace.min.js')}}"></script>
<script src="{{asset('template/inspinia/js/plugins/wow/wow.min.js')}}"></script>
<script src="{{ asset('template/inspinia/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script>

	$(document).ready(function () {

		$('body').scrollspy({
			target: '#navbar',
			offset: 80
		});

		// Page scrolling feature
		$('a.page-scroll').bind('click', function(event) {
			var link = $(this);
			$('html, body').stop().animate({
				scrollTop: $(link.attr('href')).offset().top - 50
			}, 500);
			event.preventDefault();
			$("#navbar").collapse('hide');
		});
	});

	var cbpAnimatedHeader = (function() {
		var docElem = document.documentElement,
				header = document.querySelector( '.navbar-default' ),
				didScroll = false,
				changeHeaderOn = 200;
		function init() {
			window.addEventListener( 'scroll', function( event ) {
				if( !didScroll ) {
					didScroll = true;
					setTimeout( scrollPage, 250 );
				}
			}, false );
		}
		function scrollPage() {
			var sy = scrollY();
			if ( sy >= changeHeaderOn ) {
				$(header).addClass('navbar-scroll')
			}
			else {
				$(header).removeClass('navbar-scroll')
			}
			didScroll = false;
		}
		function scrollY() {
			return window.pageYOffset || docElem.scrollTop;
		}
		init();

	})();

	$("#pre_registration_form").submit(function(e){
		e.preventDefault();
		form = $(this);
		formdata = form.serialize();
		$.ajax({
			url : "{{route('preRegistration')}}",
			data: formdata,
			type: 'POST',
			success: function(response){
				swal({
					title: "Success!",
					text: "Successfully Registered.",
					type: "success"
				});
			},
			error: function(response){
				errored(form,response);

			}
		})
	});

	// Activate WOW.js plugin for animation on scrol
	new WOW().init();

</script>

</body>
</html>

