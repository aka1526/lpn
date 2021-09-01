@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
<link href="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">
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
                        <div class="card-header tx-medium bd-0 text-white bg-gray-800 ">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0 text-white"> <i class="fa fa-users fa-2x"></i> System Menu</h4>
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">
                                        
                                        <a class="modal-effect btn btn-indigo  btn-block btn-new" data-effect="effect-scale"
                                            data-toggle="modal" href="#modalmenu">
                                            <i class="fa fa-user-plus "></i> New menu</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                    <thead>
                                        
                                        <tr class="bg-danger ">
                                            <th class="text-center">index</th>
                                            <th>Menu Name</th>
                                            <th>Link Url</th>
                                            <th>Route Name</th>
                                            <th>icon</th>
                                            <th>Class</th>
                                            
                                          
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mainmenu as $key => $row)
                                        <tr>
                                            {{-- <th class="text-center" scope="row"> {{ $mainmenu->firstItem() + $key }}</th> --}}
                                            <td>{{ $row->menu_index}}</td>
                                            <td>{{ $row->menu_name}}</td>
                                            <td>{{ $row->menu_url}}</td>
                                            <td>{{ $row->menu_route}}</td>
                                            <td>{{ $row->menu_icon}}</td>
                                            <td>{{ $row->menu_class}}</td>
                                            
                                             
                                            <td class="text-center"> 
                                                <div class="btn-icon-list">
                                                        
                                                    <button class="btn btn-indigo btn-icon btn-sm btn-edit"   data-uid="{{ $row->menu_uid}}" data-toggle="tooltip" title="Edit Menu"> <i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-icon btn-sm btn-delete" data-uid="{{ $row->menu_uid}}" data-toggle="tooltip" title="Delete Menu"><i class="far fa-trash-alt"></i></button>
    
                                                </div>
                                            </td>
                                            {{-- <td class="text-center"> 
                                                <div class="btn-icon-list">
                                                    
                                                    <button class="btn {{  $row->user_status =='Y' ? 'bg-success ' :'bg-secondary ' }} btn-icon btn-sm btn-disable" data-uid="{{ $row->uid}}" data-status="{{  $row->user_status =='Y' ? 'N' :'Y' }}" data-toggle="tooltip" title="Disable User"> <i class="{{  $row->user_status =='Y' ? 'fa fa-check' :'fa fa-ban' }}"></i></button>
                                                    <button class="btn btn-indigo btn-icon btn-sm btn-edit" data-uid="{{ $row->uid}}" data-toggle="tooltip" title="Edit User"> <i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-icon btn-sm btn-delete" data-uid="{{ $row->uid}}" data-toggle="tooltip" title="Delete User"><i class="far fa-trash-alt"></i></button>
                                                    <button class="btn btn-primary btn-icon btn-sm btn-pwd" data-uid="{{ $row->uid}}" data-toggle="tooltip" title="Change password User"><i class="fa fa-key"></i></button>
                                                </div>
                                            </td> --}}
                                        </tr>  
                                        @endforeach
                                     
                                    </tbody>
                                </table>
                               <div class="pt-2">
                                {{ $mainmenu->links('pagination.default',['paginator' => $mainmenu,'link_limit' => $mainmenu->perPage()]) }}
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
			<div class="modal " id="modalmenu">
                <form id="frmmenu" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  id="menu_uid" name="menu_uid" >
                    
                    
				<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    
					<div class="modal-content modal-content ">
						<div class="modal-header bg-primary ">
							<h6 class="modal-title text-white">Main Menu Data</h6><button aria-label="Close" class="close " data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
                           
                           <div id="errors"></div>

                                <div class="">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                                <label for="menu_name">Menu Name *</label>
                                                <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Enter data" required>
                                        
                                            </div>
                                            <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                                
                                                    <label for="menu_name_th">Menu Thai</label>
                                                    <input type="text" class="form-control" id="menu_name_th" name="menu_name_th" placeholder="Enter data">
                                                
                                            </div>
                                         
                                          </div>
                                        </div>      
                                   
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                                <label for="menu_route">Menu Route   *</label>
                                                <input type="text" class="form-control" id="menu_route" name="menu_route" placeholder="Enter data">
                                            </div>
                                            <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                                <label for="menu_icon">Menu icon</label>
                                        <input type="text" class="form-control" id="menu_icon" name="menu_icon" placeholder="Enter data">
                                            </div>
                                        </div>    
                                       
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                                <label for="menu_class">Css Class *</label>
                                                <input type="text" class="form-control" id="menu_class" name="menu_class" placeholder="Enter data">
                                           
                                            </div>
                                            <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                                <label for="menu_url">Menu Url (*) </label>
                                                <input type="text" class="form-control" id="menu_url" name="menu_url" placeholder="Enter data">
                                           
                                            </div>
                                        </div>    
                                       </div>
                                    
                                    <div class="form-group">
                                        <div class="form-group has-danger">
                                            <div class="row row-sm">
                                                
                                                <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                                    <label for="menu_index">Menu Index (*)</label>
                                                    <input type="number" class="form-control" id="menu_index" name="menu_index" placeholder="Enter data">
                                                    
                                                </div> 
                                                <div class="col-sm-6 mg-t-20 mg-sm-t-0 ">
                                                     <div class="col-lg-6">
                                                        <p class="mg-b-10">Menu Status (*)</p>
                                                        <select class="form-control select2-no-search" id="menu_status" name="menu_status"  >
                                                            <option label="Choose one"></option>
                                                            <option value="Y">Enable</option>
                                                            <option value="N">Disable</option>                                                          
                                                        </select>
                                                    </div> 
                                                </div>    
                                            </div>    
                                        </div>        
                                         </div>
                                </div>
                                
                            
						</div>
						<div class="modal-footer">
                            <button type="button" id="btn-save" class="btn ripple btn-primary btn-save  " >Save changes</button>
							<button type="button" id="btn-update" class="btn ripple btn-primary btn-update d-none" >Update changes</button>
							<button type="button" id="btn-close" class="btn ripple btn-secondary bt-close" data-dismiss="modal" >Close</button>
						</div>
                    </form>
					</div>
				</div>
			</div>
			<!-- End Modal effects-->

            
@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/adminmenu.js?v=').time() }}"></script>
    <!--Internal  Sweet-Alert js-->
		<script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>

	
@endsection
