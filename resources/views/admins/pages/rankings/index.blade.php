@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <link href="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">

@endsection

@section('content')

    <!-- main-content opened -->
    <div class="main-content horizontal-content ">

        <div class="container">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        {{-- <h4 class="my-auto mb-0 content-title">Tables</h4><span class="mt-1 mb-0 ml-2 text-muted tx-13">/ Basic Tables</span> --}}
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
                        <div class="text-white card-header tx-medium bd-0 bg-primary ">
                            <div class="d-flex justify-content-between">
                                <h4 class="text-white card-title mg-b-0">
                                    <i class="fas fa-book-medical"></i>
                                    Renew Membership Page
                                </h4>

                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1 mb-xl-0">

                                        <a class="btn btn-indigo btn-block btn-new"
                                            href="{{ route('rankings.new') }}"><i
                                                class="fas fa-book-medical"></i>
                                            NEW</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
 

                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                    <thead>

                                        <tr class="bg-info ">
                                            <th class="text-center">No.</th>
                                            
                                            <th class="text-center">Gander</th>
                                            <th>image</th>
                                            <th class="text-center">Weight Class</th>
                                            <th class="text-center"> Weight Desc</th>
                                            <th class="text-center"> WORLD CHAMPION</th>
                                            
                                            <th class="text-center">INTER. CHAMPION</th>
                                            <th class="text-center">Contenders</th>
                                             
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rankings as $key => $row)
                                            <tr>
                                                
                                                <th class="text-center" scope="row"> {{ $row->rank_index }}</th>
                                                <th class="text-center" scope="row"> {{ $row->rank_gander }}</th>
                                             
                                                <th class="text-center" scope="row">
                                                    <img width="60px" height="60px" alt="" src="{{ $row->rank_img !='' ? '/images/rankings/'.$row->rank_img : '/images/rankings/nopic.jpg' }} " 
                                                    onerror="this.src='/images/no-image.png'">
                                                     </th>
                                                <th class="text-center" scope="row"> {{ $row->rankings_weight }}</th>

                                                <td>{{ $row->rankings_weight_desc }}</td>
                                                <td class="text-center">{{ $row->world_vacant }}</td>
                                                
                                                <td class="text-center">{{ $row->international_vacant }}</td>
                                                 
                                                <td class="text-center"> 
                                                    <a href="/pageadmin/rankings/list/{{ $row->rank_uid }}" 
                                                        class="btn btn-primary " data-toggle="tooltip"                                                           
                                                        title="Add Contenders"><i class="fa fa-plus"></i> Add</a>

                                                    </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">
                                                         
                                                        
                                                        <a href="/pageadmin/rankings/edit/{{ $row->rank_uid }}" 
                                                            class="btn btn-indigo btn-icon btn-sm" data-toggle="tooltip"                                                           
                                                            title="Edit"> <i class="fa fa-edit"></i></a>

                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->rank_uid }}" data-toggle="tooltip"
                                                            title="Delete"><i class="far fa-trash-alt"></i></button>

                                                            

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $rankings->links('pagination.default', ['paginator' => $rankings, 'link_limit' => $rankings->perPage()]) }}
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
 <div class="modal " id="modalcourse">
    <form id="frm" action="/pageadmin/course/add" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="course_uid" name="course_uid">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <div class="modal-content ">
                <div class="modal-header bg-primary ">
                    <h6 class="text-white modal-title">Course Data</h6><button aria-label="Close" class="close "
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
                            <div class="form-group ">
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
                            <div class="form-group ">
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
                    <div class="row row-sm">
                        <div class="col-md-6 col-xl-6 col-xs-6 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="main-content-label mg-b-5">
                                        Imange Page Home
                                    </div>
                                    <p class="mg-b-20">Size 1932x445 px</p>
                                    <div class="row row-sm">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="input-group file-browser">
                                                <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-default">
                                                        Browse <input type="file" id="fileupload" name="fileupload" style="display: none;"  >
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="course-details-tab-area">
                                            <div class="course-details-main-img">
                                               {{-- <img src="{{ $courseItem->course_item_home_img }}" alt=""> --}}
                                            </div>
                                      
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-save" class="btn ripple btn-primary btn-save">Save changes</button>
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
    <script src="{{ asset('adminpage/assets/js/admins/rankings.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
