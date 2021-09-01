@extends('admins.layout.login_main')
@section('title')
    Admin Page
@endsection

@section('css')
<link href="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">
@endsection

@section('content')
 		<!-- Page -->
         <div class="page">

			<div class="container-fluid">
				<div class="row no-gutter">
					<!-- The image half -->
					<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
						<div class="row wd-100p mx-auto text-center">
							<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
								<img src="{{ asset('/assets/img/logo/logo_lpn3.jpg')}}" class="my-auto ht-xl-50p wd-md-100p wd-xl-55p mx-auto" alt="logo">
							</div>
						</div>
					</div>
					<!-- The content half -->
					<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
						<div class="login d-flex align-items-center py-2">
							<!-- Demo content-->
							<div class="container p-0">
								<div class="row">
									<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
										<div class="card-sigin">
											<div class="mb-5 d-flex"> 
           
                                                
                                                <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">
                                                    Lumpinee  <span>Academy </span>Muaythai</h1></div>
											<div class="card-sigin">
												<div class="main-signup-header">
													<h2>Welcome to Admin Page</h2>
													<h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
													<form action="{{ route('admin.login')}}" method="post" id="frmadminlogin" name="frmadminlogin">
														@csrf
														<div class="form-group">
															<label>Email</label> 
															<input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" >
														</div>
														<div class="form-group">
															<label>Password</label> 
															<input type="password" id="password" name="password"  class="form-control" placeholder="Enter your password" >
														</div><button class="btn btn-main-primary btn-block">Sign In</button>
														<div class="row row-xs">
															<div class="col-sm-12">
																<button type="submit" class="btn btn-block bg-danger"><i class="fa fa-key"></i> Forget Password</button>
															</div>
														 
														</div>
													</form>
													 
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End -->
						</div>
					</div><!-- End -->
				</div>
			</div>

		</div>
		<!-- End Page -->
@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/user.js?v=').time() }}"></script>
    <!--Internal  Sweet-Alert js-->
		<script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>

	
@endsection
