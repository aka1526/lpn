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
 <form id="frm" action="/pageadmin/course/items/update"  method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden"  id="course_item_uid" name="course_item_uid"  value={{ $uid }}>

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
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">

                                        <a class=" btn btn-warning  btn-block " 
                                        href="/pageadmin/course/items/{{ $courseuid }}">
                                         <i class="fa fa-fast-backward"></i>
                                            back</a>
                                    </div>
                                    
                                </div>  
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
                                    value="{{ $courseItem->course_item_index }}"
                                        placeholder="No." >
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group ">
                                    <label for="course_item_name">Course Name <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control" id="course_item_name" name="course_item_name"
                                    value="{{ $courseItem->course_item_name}}"
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
                                        {!! $courseItem->course_details !!}
                                    </textarea>

                                </div>
                            </div>
                        </div>

                        {{-- End Row --}}
                        {{-- Start Row --}}
                        <div class="row row-sm">
                            <div class="col-md-2 col-sm-4 ">
                                <div class="form-group ">
                                    <label for="course_item_price">Course Price </label>
                                    <input type="number" class="form-control" id="course_item_price" name="course_item_price"
                                      min="0" max="50000" value="{{ $courseItem->course_item_price }}" placeholder="Enter Course  Price">
                                </div>
                            </div>
                            
                            <div class="col-md-2 col-sm-4 ">
                                <div class="form-group ">
                                    <label for="course_item_duration">Course Duration (Hr.) </label>
                                    <input type="number" class="form-control" id="course_item_duration" name="course_item_duration"
                                      min="0" max="100" value="{{ $courseItem->course_item_duration }}" placeholder="Enter Course  Duration">
                                </div>
                            </div>
                            
                            <div class="col-md-2 col-sm-4 ">
                                <div class="form-group ">
                                    <p class="mg-b-10">Certificate </p>
                                    <select class="form-control select2-no-search" id="course_item_certificate" name="course_item_certificate">
                                        
                                        <option value="Y" {{ $courseItem->course_item_certificate=='Y' ? 'selected' :'' }}>Certificate</option>
                                        <option value="N" {{ $courseItem->course_item_certificate=='N' ? 'selected' :'' }}>No Cer.</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-2 col-sm-4 ">
                                <div class="form-group ">
                                <p class="mg-b-10">Status  </p>
                                <select class="form-control select2-no-search" id="course_item_status" name="course_item_status">
                                    
                                    <option value="Y" {{ $courseItem->course_item_status=='Y' ? 'selected' :'' }}>Enable</option>
                                    <option value="N" {{ $courseItem->course_item_status=='N' ? 'selected' :'' }}>Disable</option>
                                </select>
                            </div>
                            </div>
                        </div>

                        {{-- End Row --}}
                       
                        <div class="row row-sm">
                            <div class="col-md-4 col-xl-4 col-xs-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="main-content-label mg-b-5">
                                            Imange Page Home
                                        </div>
                                        <p class="mg-b-20">Size 348x223 px</p>
                                        <div class="row row-sm">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="input-group file-browser">
                                                    <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-default">
                                                            Browse <input type="file" id="img_home" name="img_home" style="display: none;"  >
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="course-details-tab-area">
                                                <div class="course-details-main-img">
                                                   <img src="{{ '/images/course/'.$courseItem->course_item_url.'/'. $courseItem->course_item_home_img }}" alt="">
                                                </div>
                                          
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4 col-xs-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="main-content-label mg-b-5">
                                           Imange Page Herder
                                        </div>
                                        <p class="mg-b-20">Size 1932x445 px</p>
                                        <div class="row row-sm">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="input-group file-browser">
                                                    <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-default">
                                                            Browse <input type="file" id="img_herder" name="img_herder" style="display: none;"  >
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="course-details-tab-area">
                                                <div class="course-details-main-img">
                                                    <img src="{{ '/images/course/'.$courseItem->course_item_url.'/'. $courseItem->course_item_header_img }}" alt="">
                                                </div>
                                          
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4 col-xs-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="main-content-label mg-b-5">
                                            Imange Page Detail
                                        </div>
                                        <p class="mg-b-20">Size 868x293 px</p>
                                        <div class="row row-sm">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="input-group file-browser">
                                                    <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-default">
                                                            Browse <input type="file" id="img_detail" name="img_detail" style="display: none;"  >
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="course-details-tab-area">
                                                <div class="course-details-main-img">
                                                    <img src="{{ '/images/course/'.$courseItem->course_item_url.'/'. $courseItem->course_item_detail_img }}" alt="">
                                                </div>
                                          
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>

                        {{-- End Row --}}   

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-save" class="btn ripple btn-primary btn-update">Save changes</button>
                        {{-- <button type="button" id="btn-close"  class="btn ripple btn-secondary bt-close" data-dismiss="modal">Close</button> --}}
                        <a class="btn ripple btn-secondary bt-close" 
                            href="/pageadmin/course/items/{{ $courseuid }}"> Close</a>
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
