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
                        <div class="card-header tx-medium bd-0 text-white bg-danger ">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0 text-white"> <i class="fa fa-users fa-2x"></i>   User Table</h4>
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">
                                        
                                        <a class="modal-effect btn btn-indigo  btn-block" data-effect="effect-scale"
                                            data-toggle="modal" href="#modaluser"><i class="typcn typcn-plus"></i> New
                                            User</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                    <thead>
                                        
                                        <tr class="bg-danger ">
                                            <th class="text-center">ID</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Position</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $key => $row)
                                        <tr>
                                            <th class="text-center" scope="row"> {{ $user->firstItem() + $key }}</th>
                                            <td>{{ $row->name}}</td>
                                            <td>{{ $row->email}}</td>
                                            <td>{{ $row->is_admin}}</td>
                                            <td> 
                                                <div class="btn-icon-list">
                                                    <button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
                                                    <button class="btn btn-primary btn-icon"><i class="typcn typcn-calendar-outline"></i></button>
                                                   
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
@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/user.js?v=').time() }}"></script>
    <!--Internal  Sweet-Alert js-->
		<script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>

	
@endsection
