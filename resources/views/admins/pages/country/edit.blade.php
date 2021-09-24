@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <link href="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
     
    @endsection

@section('content')

    <!-- main-content opened -->
    <div class="main-content horizontal-content  ">

        <div class="container">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        {{-- <h4 class="content-title mb-0 my-auto">Tables</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Basic Tables</span> --}}
                    </div>
                </div>

            </div>
            <!-- breadcrumb -->
            <!-- container opened -->

            <!-- row opened -->
            <div class="row ">
                <!--div-->
                <div class="col-xl-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-1 text-white">Page :: {{ $country->country_name }} </h4>
                            
                        </div>
                        <div class="card-body pt-10">
                            <form id="frm" action="{{ route('country.update')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="country_uid" name="country_uid" value="{{ $country->country_uid}}"> 
                                @csrf
                                @if ($errors->any())
                                <div class="card custom-card" id="dismiss-alerts">
									<div class="card-body">
                                            @foreach ($errors->all() as $error)
                                                
                                            <div class="alert alert-solid-danger mg-b-0" role="alert">
                                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                <span aria-hidden="true">&times;</span></button>
                                                <strong>Oh snap!</strong> {{ $error }}
                                            </div>

                                             
                                                
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                <div class="">
                                    <div class="row row-sm">
                                        <div class="col-md-2 col-sm-2 mg-t-10 mg-lg-t-0">
                                            <label for="aboutus_name">Country Code</label>
											<input type="text" class="form-control" id="country_code" name="country_code" value="{{ $country->country_code}}"  placeholder="Enter code 3 d" >
										</div>
                                        <div class="col-md-2 col-sm-2 mg-t-10 mg-lg-t-0">
                                            <label for="aboutus_name">Country Code 3d</label>
											<input type="text" class="form-control" id="country_code3" name="country_code3" value="{{ $country->country_code3}}"  placeholder="Enter code 2d" >
										</div>

                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="aboutus_name">Country Name</label>
                                            <input type="text" class="form-control" id="country_name" name="country_name" value="{{ $country->country_name}}" placeholder="Enter country name" required>
										</div>
                                    </div>
                                    
                                    
                                    <div class="row row-sm mg-t-20">
 

										<div class="col-sm-6 col-md-6 col-lg-4">
                                            <label for="fileupload">Image  </label>
											<div class="input-group file-browser">
                                                
												<input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
												<label class="input-group-btn">
													<span class="btn btn-default">
														Browse <input type="file" id="fileupload" name="fileupload" style="display: none;" multiple="">
													</span>
												</label>
											</div>
										</div>
                                        <div class="col-lg-6">
                                            <div class="course-details-tab-area">
                                                <label for="fileupload">  flag  </label>
                                               <div class="course-details-main-img">
                                                  <img src="{{ '/images/country/'.$country->country_flag }}" alt="" width="120px" height="60px">
                                               </div>
                                                
                                            </div>
                                         </div>
									</div>
                                </div>
                                <a href="{{ route('country.index')}}"   class="btn btn-warning mt-3 mb-0"><i class="fa fa-fast-backward"></i> Back</a>
                                <button type="submit" class="btn btn-primary mt-3 mb-0">Save</button>
                            </form>
                        </div>
                    </div>   


                </div>
            </div>
            <!--/div-->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->

 






@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/country.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/adapters/jquery.js') }}"></script> 
    

@endsection
