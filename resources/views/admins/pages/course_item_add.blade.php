@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <link href="{{ asset('/adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">

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
 <form id="frm" action="" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden"  id="courseref_uid" name="courseref_uid"  value={{ $courseuid }}>

            <!-- row opened -->
            <div class="row row-sm">
                <!--div-->
                <div class="col-xl-12">
                    <div class="card mg-b-20">
                        <div class="card-header tx-medium bd-0 text-white bg-primary ">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0 text-white">
                                    <i class="fas fa-book-medical"></i> Courses Item Table
                                </h4>
                                 
                            </div>

                        </div>
                        <div class="card-body">
                            <div id="errors"></div>
                        {{-- Start Row --}}
                        <div class="row row-sm">
                            <div class="col-3">
                                <div class="form-group mg-b-0">
                                    <label class="form-label">No. <span class="tx-danger">*</span></label>
                                    <input type="number" class="form-control" id="course_item_index" name="course_item_index"
                                      min="1"  placeholder="No." disabled>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group ">
                                    <label for="course_item_name">Course Name <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control" id="course_item_name" name="course_item_name"
                                        placeholder="Enter Course  Name">
                                </div>
                            </div>

                        </div>

                        {{-- End Row --}}

                        {{-- Start Row --}}
                        <div class="row row-sm">
                            <div class="col-12">
                                <div class="form-group  ">
                                    <label  >Description</label>
                                    <textarea id="course_details" name="course_details" class="form-control"
                                        placeholder="course Detail" rows="3">
                                    </textarea>

                                </div>
                            </div>
                        </div>

                        {{-- End Row --}}
                        {{-- Start Row --}}
                        <div class="row row-sm">
                            
                            <div class="col-2 ">
                                <div class="form-group ">
                                    <label for="course_item_price">Course Price  </label>
                                    <input type="number" class="form-control" id="course_item_price" name="course_item_price"
                                      min="0" max="50000" value="0" placeholder="Enter Course  Price">
                                </div>
                            </div>
                            
                            <div class="col-2 ">
                                <div class="form-group ">
                                    <label for="course_item_duration">Course Duration (Hr.) </label>
                                    <input type="number" class="form-control" id="course_item_duration" name="course_item_duration"
                                      min="1" max="100" value="0" placeholder="Enter Course  Duration">
                                </div>
                            </div>
                            
                            <div class="col-2 ">
                                <div class="form-group ">
                                    <p class="mg-b-10">Certificate  </p>
                                    <select class="form-control select2-no-search" id="course_item_certificate" name="course_item_certificate">
                                        
                                        <option value="Y">Certificate</option>
                                        <option value="N">No Cer.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 ">
                                <div class="form-group ">
                                    <p class="mg-b-10">Status  </p>
                                    <select class="form-control select2-no-search" id="course_item_status" name="course_item_status">
                                        
                                        <option value="Y">Enable</option>
                                        <option value="N">Disable</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- End Row --}}
                       

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-save" class="btn ripple btn-primary btn-save">Save changes</button>
                        <button type="button" id="btn-close"  class="btn ripple btn-secondary bt-close" data-dismiss="modal">Close</button>
                    </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <!--/div-->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->

 



@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/courseitem.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
 	<script src="{{ asset('assets/plugins/ckeditor/adapters/jquery.js') }}"></script> 

     <script type="text/javascript">
        CKEDITOR.replace('course_details', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
  
    </script>
   
@endsection
