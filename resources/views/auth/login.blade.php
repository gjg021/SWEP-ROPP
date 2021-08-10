<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sugar Regulatory Administration</title>

	@include('layouts.css-plugins')
</head>
<body>
<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
			<div class="row w-100">
				<div class="col-lg-4 mx-auto">
					<div class="auto-form-wrapper">
                        <div style="text-align: center;">
                            <img src="{{asset('images/SRA_DA_logo.png')}}" width="100">
                        </div>
                        <h4>Welcome!</h4>
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

@include('layouts.js-plugins')
</body>
</html>