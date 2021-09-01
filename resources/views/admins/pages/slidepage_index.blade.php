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
                                    <i class="fas fa-book-medical"></i> Slide Page
                                </h4>
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">

                                        <a class=" btn btn-indigo  btn-block  "  
                                         href="{{ route('slidepage.new')}}"><i class="fas fa-book-medical"></i>
                                            New Slide</a>
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
                                            <th>Head line</th>
                                            <th>header</th>
                                            <th>Detail</th>
                                            <th>Link</th>
                                            <th>image</th>
                                            <th class="text-center">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slidepage as $key => $row)
                                            <tr>
                                                <th class="text-center" scope="row"> {{ $slidepage->firstItem() + $key }}
                                                </th>
                                                <th> {{ $row->slidepages_headline }} </th>
                                                <td>{{ $row->slidepages_header }}</td>
                                                <td> {!!  $row->slidepages_detail !!}</td>
                                                <td>{{ $row->slidepages_link }}</td>
                                                <td class="text-center">
                                                  <a href="#" class=" img-fluid img-responsive" >  <img data-img="{{ '/images/slidepage/'.$row->slidepages_img }}" class="img-sm mr-1 showimg" onerror="this.src='/images/no-image.png';" src="{{ '/images/slidepage/thumbnails/'.$row->slidepages_img }}" alt="thumb images" />
                                                  </a>
 
                                                        
                                                </td>
                                                <td class="text-center">
                                                    <h5 class="text-warning">
                                                <span class="badge {{ $row->slidepages_status=='Y' ? 'badge-primary' :'badge-secondary' }} ">{{ $row->slidepages_status=='Y' ? 'Enable' :'Disable' }}</span>  
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        <button
                                                            class="btn btn-icon btn-sm btn-disable 
                                                            {{ $row->slidepages_status == 'Y' ? 'bg-secondary' : 'bg-success' }} "
                                                            data-uid="{{ $row->slidepages_uid }}"
                                                            data-status="{{ $row->slidepages_status == 'Y' ? 'N' : 'Y' }}"
                                                            data-toggle="tooltip" title="Edit Slide"> <i
                                                                class="fa fa-ban"></i></button>
                                                                
                                                        <a href="/pageadmin/slidepage/edit/{{ $row->slidepages_uid }}" class="btn btn-indigo btn-icon btn-sm "
                                                            data-uid="{{ $row->slidepages_uid }}" data-toggle="tooltip"
                                                            title="Edit Slide"> <i class="fa fa-edit"></i></a>

                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->slidepages_uid }}" data-toggle="tooltip"
                                                            title="Delete Slide"><i class="far fa-trash-alt"></i></button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $slidepage->links('pagination.default', ['paginator' => $slidepage, 'link_limit' => $slidepage->perPage()]) }}
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
        <form id="frm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="course_uid" name="course_uid">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content modal-content ">
                    <div class="modal-header bg-primary ">
                        <h6 class="modal-title text-white"> Slide Page Data</h6><button aria-label="Close" class="close "
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
                                <select class="form-control select2-no-search" id="slidepages_status" name="slidepages_status">
                                    
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


{{-- 
    <div class="modal fade " id="imagemodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <img class="modal-content" src=""  style="width:100%"/>
            </div>
        </div>
    </div> --}}

    <div class="modal fade " id="imagemodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <img  src="" id="targetChange" style="width:100%" />
            </div>
        </div>
    </div>

@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/slidepage.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
