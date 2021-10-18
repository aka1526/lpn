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
                                    <i class="fas fa-book-medical"></i> News Catalog Page
                                </h4>
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">
                                        <a class="btn btn-indigo  btn-block btn-new"
                                        data-uid=""
                                        {{-- data-toggle="modal" href="#myModal" --}}
                                              href=""><i class="fas fa-book-medical"></i>
                                            New Catalog</a>
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
                                            <th>Name</th>
                                            <th>Create By</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($catalog as $key => $row)
                                            <tr>
                                                <th class="text-center" scope="row">
                                                    {{ $row->catalog_index }}
                                                     {{-- {{ $catalog->firstItem() + $key }} --}}
                                                </th>
                                                  
                                                <td>{{ $row->catalog_name }}</td>

                                                <td>{!! $row->updated_by !!}</td>
                                                
                                                <td class="text-center">
                                                    <h5 class="text-warning">
                                                <span class="badge {{ $row->catalog_status=='Y' ? 'badge-primary' :'badge-secondary' }} ">
                                                    {{ $row->catalog_status=='Y' ? 'Enable' :'Disable' }}</span>  
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        <button
                                                            class="btn    btn-icon btn-sm btn-disable 
                                                            {{ $row->catalog_status == 'Y' ? 'bg-secondary' : 'bg-success' }} "
                                                            data-uid="{{ $row->catalog_uid }}"
                                                            data-status="{{ $row->catalog_status == 'Y' ? 'N' : 'Y' }}"
                                                            data-toggle="tooltip" title="Status"> <i
                                                                class="fa fa-ban"></i></button>
                                                                
                                                        <a href="#" 
                                                        data-uid="{{ $row->catalog_uid }}"
                                                            class="btn btn-indigo btn-icon btn-sm btn-edit" data-toggle="tooltip"                                                           
                                                            title="Edit"> <i class="fa fa-edit"></i></a>

                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->catalog_uid }}" data-toggle="tooltip"
                                                            title="Delete"><i class="far fa-trash-alt"></i></button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $catalog->links('pagination.default', ['paginator' => $catalog, 'link_limit' => $catalog->perPage()]) }}
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


    <div class="modal" id="formModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add New Catalog </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" >
                     
                    <div class="row row-sm">
						<div class="col-12">
						
								 
								<div class="card-body pt-0" id="formdata" >
									
								</div>
							 
						</div>
						 
					</div>
                </div>
                
            </div>
        </div>
    </div>

    



@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/newscatalog.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
