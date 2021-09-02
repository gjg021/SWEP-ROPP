<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

	<title>Sugar Regulatory Administration</title>
	@include('layouts.css-plugins')
	<!-- For Modal -->
	<link rel="stylesheet" href="{{asset('modal/fonts/icomoon/style.css')}}">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('modal/css/bootstrap.min.css')}}">
	<!-- Style -->
	<link rel="stylesheet" href="{{asset('modal/css/style.css')}}">
	<!-- For Modal -->
</head>
<body>
<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
			<div class="row w-100">
				<div class="col-sm-4 mx-auto">
					<div class="auto-form-wrapper">
                        <div style="text-align: center;">
                            <img src="{{asset('images/SRA_DA_logo.png')}}" width="100">
                        </div>
						@if(Session::has('VERIFIED_EMAIL'))
							<div class="alert alert-fill-success" role="alert">
								<i class="fa fa-check"></i> Well done! You successfully verified your email address.
							</div>
						@endif
						<form  method="POST" action="{{ route('auth.login') }}">
							@csrf
							<div class="form-group">
								<label class="label">Email</label>
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Email Address" name="email">
									<div class="input-group-append">
										<span class="input-group-text">
										  <i class="mdi mdi-check-circle-outline"></i>
										</span>
									</div>
								</div>
								@if ($errors->has('email'))
								<label class="error text-danger">{{$errors->first('email')}}</label>
								@endif
							</div>
							<div class="form-group">
								<label class="label">Password</label>
								<div class="input-group">
									<input type="password" name="password" class="form-control" placeholder="*********">
									<div class="input-group-append">
										<span class="input-group-text">
										  <i class="mdi mdi-check-circle-outline"></i>
										</span>
									</div>
								</div>
								@if ($errors->has('password'))
									<label class="error text-danger">{{$errors->first('password')}}</label>
								@endif
							</div>
							<div class="form-group">
								<button class="btn btn-primary submit-btn btn-block" type="submit">Login</button>
							</div>
							<div class="form-group d-flex justify-content-between">
								<div class="form-check form-check-flat mt-0">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
								</div>
								<a href="#" class="text-small forgot-password text-black">Forgot Password</a>
							</div>
							<div class="form-group">
								<button type="button" class="btn btn-outline-primary submit-btn btn-block" data-toggle="modal" data-target="#verifyTransactionModal">
									<span class="fa fa-check-square-o"></span>Verify a Transaction</button>
							</div>
							<div class="text-block text-center my-3">
								<span class="text-small font-weight-semibold">Don't have an account?</span>
								<a href="register.html" class="text-black text-small">Create new account</a>
							</div>
						</form>
					</div>
					<ul class="auth-footer">
						<li>
							<a href="#">Conditions</a>
						</li>
						<li>
							<a href="#">Help</a>
						</li>
						<li>
							<a href="#">Terms</a>
						</li>
					</ul>
					<p class="footer-text text-center">Sugar Regulatory Administration | MIS. All rights reserved.</p>
				</div>
			</div>
		</div>
		<!-- content-wrapper ends -->
	</div>
	<!-- page-body-wrapper ends -->
</div>
<!-- Modal -->
<div class="modal fade" id="verifyTransactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content rounded-2">
			<div class="modal-body p-4 px-5">
				<div class="main-content text-center">
					<a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><span class="icon-close2"></span></span>
					</a>
					<div class="warp-icon mb-4">
						<span class="fa fa-check"></span>
					</div>
					<form action="{{route('verifyTransaction')}}" method="GET" target="_blank">
						@csrf
						<label for="">Online Verification</label>
						<p class="mb-4">Please provide the Transaction ID that you want to verify.</p>
						<div class="form-group mb-4">
							<input name="transactionID" id="transactionID" type="text" class="form-control text-center" placeholder="Enter Transaction ID">
						</div>
						<div class="d-flex">
							<div class="mx-auto">
								<button id="searchTransaction" name="searchTransaction" type="submit" class="btn btn-success">Search</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript">
		{{--function yeah(){
			$.ajax({
				url : "{{route('verifyTransaction')}}",
				data: {
					transactionID : $("#transactionID").val()
				},
				method: 'GET',
				dataType: 'JSON',
				success: function (res) {
					window.open("http://localhost:8001/verification", '_blank').focus();
				},
				error: function (res) {

				}
			})
		}--}}
	</script>
@include('layouts.js-plugins')
<script src="{{asset('modal/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('modal/js/popper.min.js')}}"></script>
<script src="{{asset('modal/js/bootstrap.min.js')}}"></script>
<script src="{{asset('modal/js/main.js')}}"></script>
</body>
</html>