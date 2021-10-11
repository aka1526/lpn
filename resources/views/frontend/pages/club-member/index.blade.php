@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection

@section('css')
<link href="/assets/plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
@endsection
@section('content')
    
    <!-- Start of breadcrumb section
                 ============================================= -->
    {{-- <section id="yl-breadcrumb" class="yl-breadcrumb-section position-relative" data-background="/assets/img/ct-bg.jpg">
        <span class="breadcrumb-overlay position-absolute"></span>

    </section> --}}
    <!-- End of breadcrumb section
                 ============================================= -->

    <!-- Start of event content section
                 ============================================= -->
    <section id="event-countries" class="event-countries-section">
        <div class="main-content horizontal-content ">
            <div class="container">
                <div class="row ">

                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4 main-content-label">
                                    <h4 style="color: #0A0A0A;"> Members' Club</h4>
                                </div>

                             <div class="row">
                                 <div class="col-12">
                                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
										<thead>
											<tr>
                                                
                                                <th class="wd-lg-25p">Countries</th>
                                                <th class="wd-lg-25p">Logo</th>
												<th class="wd-lg-25p">Club Name</th>
                                                <th class="wd-lg-25p">Website</th> 
											</tr>
										</thead>
										<tbody>
											<tr>
                                                <td><i class="flag-icon flag-icon-th flag-icon-squared"></i> Thailand</td>
												<td>-</td>
                                                <td>Muay Club</td>
												<td>https://lpn.satangapp.in/</td> 
											</tr>
                                            <tr>
                                                <td><i class="flag-icon flag-icon-us flag-icon-squared"></i> Us </td>
												<td>-</td>
                                                <td>Us Muay Club</td>
												<td>https://lpn.satangapp.in/</td> 
											</tr>
                                            <tr>
                                                <td><i class="flag-icon flag-icon-cn flag-icon-squared"></i> China</td>
												<td>-</td>
                                                <td>China Muay Club</td>
												<td>https://lpn.satangapp.in/</td> 
											</tr>
										</tbody>
									</table>
                                 </div>
                             </div>


    
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of of event content section
                 ============================================= -->

@endsection
@section('js')

    <!-- Internal Map -->
    <script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    {{-- <!--Internal  index js -->
		<script src="../../assets/js/index.js"></script>
		<script src="../../assets/js/jquery.vmap.sampledata.js"></script>

		<!-- custom js -->
		<script src="../../assets/js/custom.js"></script>
		<script src="../../assets/js/jquery.vmap.sampledata.js"></script> --}}
@endsection
