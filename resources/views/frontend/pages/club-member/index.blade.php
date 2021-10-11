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
                                                
                                                <th class="wd-lg-25p">No.</th>
                                                <th class="wd-lg-25p">Logo</th>
												<th class="wd-lg-25p">Club Name</th>
                                                <th class="wd-lg-25p">Teachers</th>
                                                <th class="wd-lg-25p">Website</th> 
                                                <th class="wd-lg-25p">E-mail</th> 
                                                <th class="wd-lg-25p">Date Exp</th> 
                                                <th class="wd-lg-25p">Status</th> 
											</tr>
										</thead>
										<tbody>
                                            @foreach ($organizations as $key => $item)
                                            <tr>
                                                <th class="text-center">{{ $organizations->firstItem() + $key }}</th>
                                                <td class="text-center"><img src="{{ $item->org_logo !='' ? '/images/logo/thumbnails/'.$item->org_logo : '' }}" onerror="this.src='/assets/img/no-logo.png'" width="120px" height="70px"></td>
												<td>{{ $item->org_name}}</td>
                                                <td>{{ $item->org_name_teachers}}</td>
												<td>{{ $item->org_www}}</td>
                                                <td>{{ $item->org_email}}</td>
                                                <td>{{ $item->org_date_exp}}</td>
                                                <td> <a class="btn btn-primary">Is Verify </div></td>
											</tr> 
                                            @endforeach
											
                                             
										</tbody>
									</table>
                                    <div class="pt-2">
                                        {{ $organizations->links('pagination.default', ['paginator' => $organizations, 'link_limit' => $organizations->perPage()]) }}
                                    </div>
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
