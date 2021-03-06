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
                                <h4 class="card-title mg-b-0 text-white"> 
                                    <i class="fa fa-users fa-2x"></i> Staff Table</h4>
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">
                                        
                                        <a class="modal-effect btn btn-indigo  btn-block" data-effect="effect-scale"
                                            data-toggle="modal" href="#modaluser"><i class="fa fa-user-plus"></i> 
                                            New Staff</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                    <thead>
                                        
                                        <tr class="bg-danger ">
                                            <th class="text-center">NO</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th class="text-center">Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $key => $row)
                                        <tr>
                                            <th class="text-center" scope="row"> {{ $user->firstItem() + $key }}</th>
                                            <td>{{ $row->name}}</td>
                                            <td>{{ $row->email}}</td>
                                            <td class="text-center">
                                                <h3  class="text-warning"> 
                                                    <span class="badge badge-primary">{{ $row->is_admin}}</span></h3>
                                            </td>
                                            <td class="text-center"> 
                                                <div class="btn-icon-list">
                                                    
                                                    <button class="btn {{  $row->user_status =='Y' ? 'bg-success ' :'bg-secondary ' }} btn-icon btn-sm btn-disable" data-uid="{{ $row->uid}}" data-status="{{  $row->user_status =='Y' ? 'N' :'Y' }}" data-toggle="tooltip" title="Disable User"> <i class="{{  $row->user_status =='Y' ? 'fa fa-check' :'fa fa-ban' }}"></i></button>
                                                    <button class="btn btn-indigo btn-icon btn-sm btn-edit" data-uid="{{ $row->uid}}" data-toggle="tooltip" title="Edit User"> <i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-icon btn-sm btn-delete" data-uid="{{ $row->uid}}" data-toggle="tooltip" title="Delete User"><i class="far fa-trash-alt"></i></button>
                                                    <button class="btn btn-primary btn-icon btn-sm btn-pwd" data-uid="{{ $row->uid}}" data-toggle="tooltip" title="Change password User"><i class="fa fa-key"></i></button>
                                                </div>
                                            </td>
                                        </tr>  
                                        @endforeach
                                     
                                    </tbody>
                                </table>
                               <div class="pt-2">
                                {{ $user->links('pagination.default',['paginator' => $user,'link_limit' => $user->perPage()]) }}
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
			<div class="modal " id="modaluser">
                <form id="frmuser" action="{{ route('admin.register')}}" method="POST" enctype="multipart/form-data">
                    @csrf
				<div class="modal-dialog modal-dialog-centered" role="document">
                    
					<div class="modal-content modal-content ">
						<div class="modal-header bg-primary ">
							<h6 class="modal-title text-white">User Data</h6><button aria-label="Close" class="close " data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
                           
                           <div id="errors"></div>

                                <div class="">
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter user name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                     
                               
                                </div>
                                
                            
						</div>
						<div class="modal-footer">
							<button type="button" class="btn ripple btn-primary btn-save" >Save changes</button>
							<button type="button" class="btn ripple btn-secondary bt-close" data-dismiss="modal" >Close</button>
						</div>
                    </form>
					</div>
				</div>
			</div>
			<!-- End Modal effects-->

             <!-- Modal effects -->
			<div class="modal " id="modalusershow">
                <form id="frmusershow" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  id="_uid"  name="_uid"  >
				<div class="modal-dialog modal-dialog-centered" role="document">
                    
					<div class="modal-content modal-content ">
						<div class="modal-header bg-primary ">
							<h6 class="modal-title text-white">User Data</h6><button aria-label="Close" class="close " data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
                           
                           <div id="errors"></div>

                                <div class="">
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" class="form-control" id="_name" name="_name" placeholder="Enter user name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="_email" name="_email" placeholder="Enter email">
                                    </div>
                                    
                               
                                </div>
                                
                            
						</div>
						<div class="modal-footer">
							<button type="button" class="btn ripple btn-primary btn-update" >Save changes</button>
							<button type="button" class="btn ripple btn-secondary bt-close" data-dismiss="modal" >Close</button>
						</div>
                    </form>
					</div>
				</div>
			</div>
			<!-- End Modal effects-->

              <!-- Modal effects -->
			<div class="modal " id="modaluserpwd">
                <form id="frmuserpwd" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  id="pwd_uid"  name="pwd_uid"  >
				<div class="modal-dialog modal-dialog-centered" role="document">
                    
					<div class="modal-content modal-content ">
						<div class="modal-header bg-primary ">
							<h6 class="modal-title text-white">Staff Data</h6><button aria-label="Close" class="close " data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
                           
                           <div id="pwderrors"></div>

                                <div class="">
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" class="form-control" id="pwd_name" name="pwd_name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">New Password</label>
                                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter New Password">
                                    </div>
                                    
                               
                                </div>
                                
                            
						</div>
						<div class="modal-footer">
							<button type="button" class="btn ripple btn-primary btn-editpwd" >Save changes</button>
							<button type="button" class="btn ripple btn-secondary bt-close" data-dismiss="modal" >Close</button>
						</div>
                    </form>
					</div>
				</div>
			</div>
			<!-- End Modal effects-->
@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/user.js?v=').time() }}"></script>
    <!--Internal  Sweet-Alert js-->
		<script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>

	
@endsection
