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

                                        <a class=" btn btn-warning  btn-block  "  
                                         href="/pageadmin/course">
                                         <i class="fa fa-fast-backward"></i>
                                            back</a>
                                    </div>
                                    <div class="pr-1  mb-xl-0">

                                        <a class=" btn btn-indigo  btn-block  "  
                                         href="/pageadmin/course/items/add/{{ $course_uid }}">
                                         <i class="fas fa-book-medical"></i>
                                            New Item</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                    <thead>

                                        <tr class="bg-info ">
                                            <th class="text-center">NO</th>
                                            <th>Course Name</th>
                                            <th width="120px" class="text-center">Course Price</th>
                                            <th class="text-center">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courseitem as $key => $row)
                                            <tr>
                                                <th class="text-center" scope="row"> {{ $courseitem->firstItem() + $key }}
                                                </th>
                                                <td>{{ $row->course_item_name }}</td>
                                                <td class="text-center">{{ number_format($row->course_item_price,0) }}</td>
                                                
                                                <td class="text-center">
                                                    <h5 class="text-warning">
                                                <span class="badge {{ $row->course_item_status=='Y' ? 'badge-primary' :'badge-secondary' }} ">{{ $row->course_item_status=='Y' ? 'Enable' :'Disable' }}</span>  
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        <button
                                                            class="btn  {{ $row->course_item_status == 'Y' ? 'bg-secondary' : 'bg-success' }}   btn-icon btn-sm btn-disable "
                                                            data-uid="{{ $row->course_item_uid }}"
                                                            data-status="{{ $row->course_item_status == 'Y' ? 'N' : 'Y' }}"
                                                            data-toggle="tooltip" title="Update Status"> <i
                                                                class="fa fa-ban"></i></button>
                                                        <a href="/pageadmin/course/items/edit/{{ $row->course_item_uid }}" class="btn btn-indigo btn-icon btn-sm  "
                                                            data-uid="{{ $row->course_item_uid }}" data-toggle="tooltip"
                                                            title="Edit Course Item"> <i class="fa fa-edit"></i></a>
                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->course_item_uid }}" data-toggle="tooltip"
                                                            title="Delete Course"><i class="far fa-trash-alt"></i></button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $courseitem->links('pagination.default', ['paginator' => $courseitem, 'link_limit' => $courseitem->perPage()]) }}
                                </div>
                            </div>
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
    <div class="modal " id="modalcourseitem">
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
                                    <textarea id="course_description " name="course_description" class="form-control ckeditor"
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
    <script src="{{ asset('adminpage/assets/js/admins/courseitem.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>

   
@endsection
