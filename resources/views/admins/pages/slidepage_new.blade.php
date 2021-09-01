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
 <form id="frm" action="/pageadmin/slidepage/add" method="POST" enctype="multipart/form-data">
    @csrf
     

            <!-- row opened -->
            <div class="row row-sm">
                <!--div-->
                <div class="col-xl-12">
                    <div class="card mg-b-20">
                        <div class="card-header tx-medium bd-0 text-white bg-primary ">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0 text-white">
                                    <i class="fas fa-book-medical"></i> Slide Page
                                </h4>
                                 
                            </div>

                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- Start Row --}}
                        <div class="row row-sm">
                            <div class="col-3">
                                <div class="form-group mg-b-0">
                                    <label class="form-label">No. <span class="tx-danger">*</span></label>
                                    <input type="number" class="form-control" id="slidepages_index" name="slidepages_index"
                                      min="1"  placeholder="No." disabled>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group ">
                                    <label for="slidepages_headline">Top Header <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control" id="slidepages_headline" name="slidepages_headline"
                                        placeholder="Enter Top Header ">
                                </div>
                            </div>

                        </div>

                        {{-- End Row --}}
                         {{-- Start Row --}}
                         <div class="row row-sm">
                            
                            <div class="col-12">
                                <div class="form-group ">
                                    <label for="slidepages_header">Header Text<span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control" id="slidepages_header" name="slidepages_header"
                                        placeholder="Enter Header Text ">
                                </div>
                            </div>

                        </div>

                        {{-- End Row --}}

                        {{-- Start Row --}}
                        <div class="row row-sm">
                            <div class="col-12">
                                <div class="form-group  ">
                                    <label  >Detail Decription</label>
                                    <textarea id="slidepages_detail" name="slidepages_detail" class="form-control"
                                        placeholder="Text Detail" rows="3">
                                    </textarea>

                                </div>
                            </div>
                        </div>

                        {{-- End Row --}}
                        {{-- Start Row --}}
                        <div class="row row-sm">
                            
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label for="slidepages_link">Link  url  </label>
                                    <input type="text" class="form-control" id="slidepages_link" name="slidepages_link"
                                       value="" placeholder="Enter Link  url">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <label for="fileupload">Browse File image. </label>
                                <div class="input-group file-browser">
                                  
                                    <input type="text" class="form-control border-right-0 browse-file"   placeholder="choose" readonly>
                                    <label class="input-group-btn">
                                        <span class="btn btn-default">
                                            Browse <input type="file" id="fileupload" name="fileupload"  style="display: none;" >
                                        </span>
                                    </label>
                                </div>
                            </div>
   
                            <div class="col-md-2 col-sm-4">
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
                        <button type="submit" id="btn-save" class="btn ripple btn-primary btn-save">Save changes</button>
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
    <script src="{{ asset('adminpage/assets/js/admins/slidepage.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
 	<script src="{{ asset('assets/plugins/ckeditor/adapters/jquery.js') }}"></script> 

     <script type="text/javascript">
        CKEDITOR.replace('slidepages_detail', {
          //  filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            //filebrowserUploadMethod: 'form'
        });
  
    </script>
   
@endsection
