<!DOCTYPE html>
<html lang="en">
	<head>
        @include('admins.includes.header')
	</head>
    		<!---Skinmodes css-->
		<link href="{{ asset('adminpage/assets/css/skin-modes.css')}}" rel="stylesheet" />
	<body class="main-body">

		  <!-- Loader -->
          <div id="global-loader">
            <img src="{{ asset('adminpage/assets/img/loader.svg')}}" class="loader-img" alt="Loader">
        </div>

		<!-- Page -->
		<div class="page">

			  <!-- main-menu_nav opened -->
              @include('admins.includes.menu_nav')
              <!-- menu_nav closed -->

			<!-- main-content opened -->
			<div class="main-content horizontal-content">

				<!-- container opened -->
				<div class="container">

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
							<div>
							  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi {{  $userAdmin }}, welcome back!  </h2>
							  <p class="mg-b-0">Members monitoring dashboard.</p>
							</div>
						</div>
						<div class="main-dashboard-header-right">
							<div>
								<label class="tx-13">Total Members</label>
								<h5>{{ number_format($totalMember,0)}}</h5>
							</div>
							<div>
								<label class="tx-13">Active Members</label>
								<h5>{{ number_format($totalMemberActive,0)}}</h5>
							</div>
							<div>
								<label class="tx-13">Expire Members</label>
								<h5 class="text-danger">{{ number_format($totalMemberExp,0)}}</h5>
							</div>
						</div>
					</div>
					<!-- /breadcrumb -->

					<!-- row -->
					<div class="row row-sm">
						<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card bg-primary-gradient">
								<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
									<div class="">
										<h6 class="mb-3 tx-12 text-white">TOTAL REGISTER</h6>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format($totalMember,0) }}</h4>
												<p class="mb-0 tx-12 text-white op-7">Total Member of register</p>
											</div>
											{{-- <span class="float-right my-auto ml-auto">
												<i class="fas fa-arrow-circle-up text-white"></i>
												<span class="text-white op-7"> +427</span>
											</span> --}}
										</div>
									</div>
								</div>
								<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card bg-danger-gradient">
								<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
									<div class="">
										<h6 class="mb-3 tx-12 text-white">TOTAL MEMBERS</h6>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format($user_member,0)}}</h4>
												<p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
											</div>
											{{-- <span class="float-right my-auto ml-auto">
												<i class="fas fa-arrow-circle-down text-white"></i>
												<span class="text-white op-7"> -23.09%</span>
											</span> --}}
										</div>
									</div>
								</div>
								<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card bg-success-gradient">
								<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
									<div class="">
										<h6 class="mb-3 tx-12 text-white">TOTAL  STUDENTS</h6>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format($user_students,0) }}</h4>
												<p class="mb-0 tx-12 text-white op-7">Total Students of register</p>
											</div>
											{{-- <span class="float-right my-auto ml-auto">
												<i class="fas fa-arrow-circle-up text-white"></i>
												<span class="text-white op-7"> 52.09%</span>
											</span> --}}
										</div>
									</div>
								</div>
								<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card bg-warning-gradient">
								<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
									<div class="">
										<h6 class="mb-3 tx-12 text-white">TOTAL TEACHERS</h6>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ number_format($user_teachers,0)}}</h4>
												<p class="mb-0 tx-12 text-white op-7">Total Teachers of register</p>
											</div>
											{{-- <span class="float-right my-auto ml-auto">
												<i class="fas fa-arrow-circle-down text-white"></i>
												<span class="text-white op-7"> -152.3</span>
											</span> --}}
										</div>
									</div>
								</div>
								<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
							</div>
						</div>
					</div>
					<!-- row closed -->

					<!-- row opened -->
					{{-- <div class="row row-sm">
						<div class="col-md-12 col-lg-12 col-xl-7">
							<div class="card">
								<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mb-0">Order status</h4>
										<i class="mdi mdi-dots-horizontal text-gray"></i>
									</div>
									<p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.</p>
								</div>
								<div class="card-body">
									<div class="total-revenue">
										<div>
										  <h4>120,750</h4>
										  <label><span class="bg-primary"></span>success</label>
										</div>
										<div>
										  <h4>56,108</h4>
										  <label><span class="bg-danger"></span>Pending</label>
										</div>
										<div>
										  <h4>32,895</h4>
										  <label><span class="bg-warning"></span>Failed</label>
										</div>
									  </div>
									<div id="bar" class="sales-bar mt-4"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-xl-5">
							<div class="card card-dashboard-map-one">
								<label class="main-content-label">Sales Revenue by Customers in USA</label>
								<span class="d-block mg-b-20 text-muted tx-12">Sales Performance of all states in the United States</span>
								<div class="">
									<div class="vmap-wrapper ht-180" id="vmap2"></div>
								</div>
							</div>
						</div>
					</div> --}}
					<!-- row closed -->

					{{-- <!-- row opened -->
					<div class="row row-sm">
						<div class="col-xl-4 col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Recent Customers</h3>
									<p class="tx-12 mb-0 text-muted">A customer is an individual or business that purchases the goods service has evolved to include real-time</p>
								</div>
								<div class="card-body p-0 customers mt-1">
									<div class="list-group list-lg-group list-group-flush">
										<div class="list-group-item list-group-item-action" href="#">
											<div class="media mt-0">
												<img class="avatar-lg rounded-circle mr-3 my-auto" src="{{ asset('adminpage/assets/img/faces/3.jpg')}}" alt="Image description">
												<div class="media-body">
													<div class="d-flex align-items-center">
														<div class="mt-0">
															<h5 class="mb-1 tx-15">Samantha Melon</h5>
															<p class="mb-0 tx-13 text-muted">User ID: #1234 <span class="text-success ml-2">Paid</span></p>
														</div>
														<span class="ml-auto wd-45p fs-16 mt-2">
															<div id="spark1" class="wd-100p"></div>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="list-group-item list-group-item-action" href="#">
											<div class="media mt-0">
												<img class="avatar-lg rounded-circle mr-3 my-auto" src="{{ asset('adminpage/assets/img/faces/11.jpg')}}" alt="Image description">
												<div class="media-body">
													<div class="d-flex align-items-center">
														<div class="mt-1">
															<h5 class="mb-1 tx-15">Jimmy Changa</h5>
															<p class="mb-0 tx-13 text-muted">User ID: #1234 <span class="text-danger ml-2">Pending</span></p>
														</div>
														<span class="ml-auto wd-45p fs-16 mt-2">
															<div id="spark2" class="wd-100p"></div>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="list-group-item list-group-item-action" href="#">
											<div class="media mt-0">
												<img class="avatar-lg rounded-circle mr-3 my-auto" src="{{ asset('adminpage/assets/img/faces/17.jpg')}}" alt="Image description">
												<div class="media-body">
													<div class="d-flex align-items-center">
														<div class="mt-1">
															<h5 class="mb-1 tx-15">Gabe Lackmen</h5>
															<p class="mb-0 tx-13 text-muted">User ID: #1234<span class="text-danger ml-2">Pending</span></p>
														</div>
														<span class="ml-auto wd-45p fs-16 mt-2">
															<div id="spark3" class="wd-100p"></div>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="list-group-item list-group-item-action" href="#">
											<div class="media mt-0">
												<img class="avatar-lg rounded-circle mr-3 my-auto" src="{{ asset('adminpage/assets/img/faces/15.jpg')}}" alt="Image description">
												<div class="media-body">
													<div class="d-flex align-items-center">
														<div class="mt-1">
															<h5 class="mb-1 tx-15">Manuel Labor</h5>
															<p class="mb-0 tx-13 text-muted">User ID: #1234<span class="text-success ml-2">Paid</span></p>
														</div>
														<span class="ml-auto wd-45p fs-16 mt-2">
															<div id="spark4" class="wd-100p"></div>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="list-group-item list-group-item-action br-br-7 br-bl-7" href="#">
											<div class="media mt-0">
												<img class="avatar-lg rounded-circle mr-3 my-auto" src="{{ asset('adminpage/assets/img/faces/6.jpg')}}" alt="Image description">
												<div class="media-body">
													<div class="d-flex align-items-center">
														<div class="mt-1">
															<h5 class="mb-1 tx-15">Sharon Needles</h5>
															<p class="b-0 tx-13 text-muted mb-0">User ID: #1234<span class="text-success ml-2">Paid</span></p>
														</div>
														<span class="ml-auto wd-45p fs-16 mt-2">
															<div id="spark5" class="wd-100p"></div>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Sales Activity</h3>
									<p class="tx-12 mb-0 text-muted">Sales activities are the tactics that salespeople use to achieve their goals and objective</p>
								</div>
								<div class="product-timeline card-body pt-2 mt-1">
									<ul class="timeline-1 mb-0">
										<li class="mt-0"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Total Products</span> <a href="#" class="float-right tx-11 text-muted">3 days ago</a>
											<p class="mb-0 text-muted tx-12">1.3k New Products</p>
										</li>
										<li class="mt-0"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Total Sales</span> <a href="#" class="float-right tx-11 text-muted">35 mins ago</a>
											<p class="mb-0 text-muted tx-12">1k New Sales</p>
										</li>
										<li class="mt-0"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Toatal Revenue</span> <a href="#" class="float-right tx-11 text-muted">50 mins ago</a>
											<p class="mb-0 text-muted tx-12">23.5K New Revenue</p>
										</li>
										<li class="mt-0"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Toatal Profit</span> <a href="#" class="float-right tx-11 text-muted">1 hour ago</a>
											<p class="mb-0 text-muted tx-12">3k New profit</p>
										</li>
										<li class="mt-0"> <i class="si si-eye bg-purple-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Customer Visits</span> <a href="#" class="float-right tx-11 text-muted">1 day ago</a>
											<p class="mb-0 text-muted tx-12">15% increased</p>
										</li>
										<li class="mt-0 mb-0"> <i class="icon-note icons bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Customer Reviews</span> <a href="#" class="float-right tx-11 text-muted">1 day ago</a>
											<p class="mb-0 text-muted tx-12">1.5k reviews</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-md-12 col-lg-6">
							<div class="card">
								<div class="card-header pb-0">
									<h3 class="card-title mb-2">Recent Orders</h3>
									<p class="tx-12 mb-0 text-muted">An order is an investor's instructions to a broker or brokerage firm to purchase or sell</p>
								</div>
								<div class="card-body sales-info ot-0 pt-0 pb-0">
									<div id="chart" class="ht-150"></div>
									<div class="row sales-infomation pb-0 mb-0 mx-auto wd-100p">
										<div class="col-md-6 col">
											<p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>Delivered</p>
											<h3 class="mb-1">5238</h3>
											<div class="d-flex">
												<p class="text-muted ">Last 6 months</p>
											</div>
										</div>
										<div class="col-md-6 col">
											<p class="mb-0 d-flex"><span class="legend bg-info brround"></span>Cancelled</p>
												<h3 class="mb-1">3467</h3>
											<div class="d-flex">
												<p class="text-muted">Last 6 months</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card ">
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="d-flex align-items-center pb-2">
												<p class="mb-0">Total Sales</p>
											</div>
											<h4 class="font-weight-bold mb-2">$7,590</h4>
											<div class="progress progress-style progress-sm">
												<div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
											</div>
										</div>
										<div class="col-md-6 mt-4 mt-md-0">
											<div class="d-flex align-items-center pb-2">
												<p class="mb-0">Active Users</p>
											</div>
											<h4 class="font-weight-bold mb-2">$5,460</h4>
											<div class="progress progress-style progress-sm">
												<div class="progress-bar bg-danger-gradient wd-75" role="progressbar"  aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- row close --> --}}

					<!-- row opened -->
					<div class="row row-sm row-deck">
						<div class="col-md-3">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card card-dashboard-eight pb-2">
									<h6 class="card-title">Members Top 10 Countries</h6>
									<span class="d-block mg-b-10 text-muted tx-12">Member based by country</span>
									<div class="list-group">
										@foreach ($user_countries as $item)
										<div class="list-group-item border-top-0">
											<i class="flag-icon flag-icon-{{ $item->country_code}} flag-icon-squared"></i>
											<p>{{ $item->country_name }}</p><span> {{ $item->user_count}}</span>
										</div>
										@endforeach
										
										 
									</div>
								</div>
							</div>
							
						</div>

						<div class="col-md-4">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card card-table-two">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mb-1">TOTAL STUDENTS BY KHAN</h4>
										<i class="mdi mdi-dots-horizontal text-gray"></i>
									</div>
									<span class="tx-12 tx-muted mb-3 ">This is students by Khan.</span>
									<div class="table-responsive country-table">
										<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
											<thead>
											 
												<tr>
													<th class="wd-lg-25p">NO</th>
													<th class="wd-lg-25p tx-left">KHAN</th>
													<th class="wd-lg-25p tx-right">TOTAL</th>
												 
												</tr>
											 
												
											</thead>
											<tbody>
												@foreach ($khan_students as $item)
												<tr>
													<td>{{ $item->khan_index}}</td>
													<td class="tx-left tx-medium tx-inverse">{{ $item->khan_name}}</td>
													<td class="tx-right tx-medium tx-inverse">{{ $item->user_count> 0 ? $item->user_count : 0}}</td>
													 
												</tr>
												@endforeach
												
												 
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							
						<div class="col-md-12 col-lg-12 col-xl-12">
							<div class="card card-table-two">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-1">TOTAL TEACHERS BY KHAN</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<span class="tx-12 tx-muted mb-3 ">This is teachers by Khan.</span>
								<div class="table-responsive country-table">
									<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
										<thead>
											<tr>
												<th class="wd-lg-25p">NO</th>
												<th class="wd-lg-25p tx-left">KHAN</th>
												<th class="wd-lg-25p tx-right">TOTAL</th>
												 
											</tr>
										</thead>
										<tbody>
											@foreach ($khan_teachers as $item)
											<tr>
												<td>{{ $item->khan_index}}</td>
												<td class="tx-left tx-medium tx-inverse">{{ $item->khan_name}}</td>
												<td class="tx-right tx-medium tx-inverse">{{ $item->user_count> 0 ? $item->user_count : 0}}</td>
												 
											</tr>
											@endforeach
											
											<tr>
												<td>- </td>
												<td class="tx-left tx-medium tx-inverse"> -</td>
												<td class="tx-right tx-medium tx-inverse">- </td>
												 
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						</div>	

					
					
					</div>
					<!-- /row -->
				</div>
			</div>
			<!-- Container closed -->

			  <!-- Sidebar-right-->
              @include('admins.includes.sidebar')
              <!--/Sidebar-right-->

			 
			 <!-- Footer opened -->
             <div class="main-footer ht-40">
                <div class="container-fluid pd-t-0-f ht-100p">
                    <span>Copyright ?? 2021 <a href="#">
                        Lumpinee Academy Muaythai</a> 
                        All rights reserved.</span>
                </div>
            </div>
            <!-- Footer closed -->

		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

		<!-- JQuery min js -->
		<script src="{{ asset('adminpage/assets/plugins/jquery/jquery.min.js')}}"></script>

		<!-- Bootstrap Bundle js -->
		<script src="{{ asset('adminpage/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

		<!-- Ionicons js -->
		<script src="{{ asset('adminpage/assets/plugins/ionicons/ionicons.js')}}"></script>

		<!-- Moment js -->
		<script src="{{ asset('adminpage/assets/plugins/moment/moment.js')}}"></script>

		<!--Internal Sparkline js -->
		<script src="{{ asset('adminpage/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

		<!-- Moment js -->
		<script src="{{ asset('adminpage/assets/plugins/raphael/raphael.min.js')}}"></script>

		<!-- Internal Piety js -->
		<script src="{{ asset('adminpage/assets/plugins/peity/jquery.peity.min.js')}}"></script>

		<!-- Rating js-->
		<script src="{{ asset('adminpage/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
		<script src="{{ asset('adminpage/assets/plugins/rating/jquery.barrating.js')}}"></script>
 
		<!-- Eva-icons js -->
		<script src="{{ asset('adminpage/assets/js/eva-icons.min.js')}}"></script>

		<!--Internal Apexchart js-->
		<script src="{{ asset('adminpage/assets/js/apexcharts.js')}}"></script>

		<!-- Horizontalmenu js-->
		<script src="{{ asset('adminpage/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js')}}"></script>

		<!-- Sticky js -->
		<script src="{{ asset('adminpage/assets/js/sticky.js')}}"></script>

		<!-- Internal Map -->
		<script src="{{ asset('adminpage/assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
		<script src="{{ asset('adminpage/assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

		<!-- Internal Chart js -->
		<script src="{{ asset('adminpage/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

		<!--Internal  index js -->
		<script src="{{ asset('adminpage/assets/js/index.js')}}"></script>
		<script src="{{ asset('adminpage/assets/js/jquery.vmap.sampledata.js')}}"></script>

		<!-- custom js -->
		<script src="{{ asset('adminpage/assets/js/custom.js')}}"></script>
		<script src="{{ asset('adminpage/assets/js/jquery.vmap.sampledata.js')}}"></script>

	</body>
</html>