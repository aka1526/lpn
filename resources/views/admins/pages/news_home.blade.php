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
            <div class="row row-sm">
                 
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header">
                            <h4 class="card-title mb-1">news  Title</h4>
                            {{-- <p class="mb-2">Title apllication.</p> --}}
                        </div>
                        <div class="card-body pt-0">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form id="frm" name="frm" action="{{ route('news.header')}}" method="POST" >
                                @csrf
                                <input type="hidden" name="pageheader_uid" id="pageheader_uid"  value="{{ isset($news->pageheader_uid) ? $news->pageheader_uid :''}}" >
 
                                

                                <div class="">
                                    <div class="form-group">
                                        <label for="pageheader_title"> Title</label>
                                        <input type="text" class="form-control" id="pageheader_title" name="pageheader_title" value="{{ isset($news->pageheader_title) ? $news->pageheader_title :''}}" placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="pageheader_header">  Main</label>
                                        <input type="text" class="form-control" id="pageheader_header" name="pageheader_header" value="{{ isset($news->pageheader_header) ? $news->pageheader_header :''}}"  placeholder="Enter Main">
                                    </div>
                                    <div class="form-group">
                                        <label for="pageheader_detail">Detail</label>
                                        <textarea class="form-control" id="pageheader_detail"  name="pageheader_detail" placeholder="Enter Detail" rows="3">{{ isset($news->pageheader_detail) ? $news->pageheader_detail :''}}</textarea>
                                    </div>
                                     
                                </div>
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


    <!-- Modal effects -->
    <div class="modal " id="modalcourse">
        <form id="frm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="course_uid" name="course_uid">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content modal-content ">
                    <div class="modal-header bg-primary ">
                        <h6 class="modal-title text-white">Course Data</h6><button aria-label="Close" class="close "
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="errors"></div>
                        {{-- Start Row --}}
                        <div class="row row-sm">
                            <div class="col-3">
                                <div class="form-group mg-b-0">
                                    <label class="form-label">No. <span class="tx-danger">*</span></label>
                                    <input type="number" class="form-control" id="course_index" name="course_index"
                                        placeholder="No.">
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group ">
                                    <label for="course_name">Course Name <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control" id="course_name" name="course_name"
                                        placeholder="Enter Course  Name">
                                </div>
                            </div>

                        </div>

                        {{-- End Row --}}

                        {{-- Start Row --}}
                        <div class="row row-sm">
                            <div class="col-12">
                                <div class="form-group  ">
                                    <label for="course_description">Description</label>
                                    <textarea id="course_description" name="course_description" class="form-control"
                                        placeholder="course description" rows="3"></textarea>

                                </div>
                            </div>
                        </div>

                        {{-- End Row --}}
                        {{-- Start Row --}}
                        <div class="row row-sm">
                          
                            <div class="col-8">
                                <div class="form-group  ">
                                    <label for="course_icon">icon</label>
                                    <input type="text" class="form-control" id="course_icon" name="course_icon"
                                        placeholder="Enter icon">
                                </div>
                            </div>
                            <div class="col-4 ">
                                <div class="form-group ">
                                <p class="mg-b-10">Status <span class="tx-danger">*</span></p>
                                <select class="form-control select2-no-search" id="course_status" name="course_status">
                                    
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
        </form>
    </div>
    <!-- End Modal effects-->






@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/course.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
