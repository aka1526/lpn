@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <link href="{{ asset('/adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    
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
                            <h4 class="card-title mb-1 text-white">New Page  </h4>
                            
                        </div>
                        <div class="card-body pt-10">
                            <form id="frm" action="{{ route('aboutus.add')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="aboutus_uid" name="aboutus_uid" > 
                                @csrf
                                <div class="">
                                    <div class="form-group">
                                        <label for="aboutus_name">Page Name</label>
                                        <input type="text" class="form-control" id="aboutus_name" name="aboutus_name" placeholder="Enter Page name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="aboutus_header">Header Text</label>
                                        <input type="text" class="form-control" id="aboutus_header" name="aboutus_header" placeholder="Enter Header Text">
                                    </div>
                                    {{-- <div class="row row-sm mg-t-20">
                                       
										<div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="aboutus_desc">body</label>
											<textarea class="form-control" id="aboutus_desc" name="aboutus_desc" placeholder="body" rows="25" required></textarea>
										</div>
										 
									</div> --}}
                                    <div class="row row-sm mg-t-20">
                                        {{-- <div class="col-lg-5 col-6 mg-t-5 mg-lg-t-0">
                                            <label for="aboutus_name">Url</label>
                                            <input type="text" class="form-control" id="aboutus_url" name="aboutus_url" value="" placeholder="Enter Url name" >
										</div> --}}
										<div class="col-sm-7 col-md-6 col-lg-4">
                                            <label for="fileupload">Image Header (size 1932x445px) </label>
											<div class="input-group file-browser">
                                                
												<input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
												<label class="input-group-btn">
													<span class="btn btn-default">
														Browse <input type="file" id="fileupload" name="fileupload" style="display: none;" multiple="">
													</span>
												</label>
											</div>
										</div>
									</div>
                                </div>
                                <a href="{{ route('aboutus.index')}}"   class="btn btn-warning mt-3 mb-0"><i class="fa fa-fast-backward"></i> Back</a>
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
    <script src="{{ asset('adminpage/assets/js/admins/aboutus.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/adapters/jquery.js') }}"></script> 
    <script type="text/javascript">
       /* CKEDITOR.replace('aboutus_desc', {
            filebrowserUploadUrl: "{{route('aboutus.uploadimg', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.add
        CKEDITOR.config.contentsCss = '/assets/css/style.css' ; 
        CKEDITOR.config.allowedContent = true;
  */
    </script>

@endsection
