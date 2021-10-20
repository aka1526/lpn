@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <link href="{{ asset('/adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    
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
            <div class="row ">
                <!--div-->
                <div class="col-xl-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-1 text-white">E-mail Setup Page </h4>
                            
                        </div>
                        <div class="card-body pt-10">
                            <form id="frm" action="{{ route('mailsetup.add')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="mail_uid" name="mail_uid" > 
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email_from">Mail From</label>
                                            <input type="email" class="form-control" id="email_from" name="email_from" 
                                            placeholder="abc@hotmail.com" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email_from_alia">From Name</label>
                                            <input type="text" class="form-control" id="email_from_alia" name="email_from_alia" placeholder="Enter Name" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email_address">E-mail Address</label>
                                            <input type="email" class="form-control" id="email_address" name="email_address" placeholder="efgh@hotmail.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email_password">E-mail Password</label>
                                            <input type="password" class="form-control" id="email_password" name="email_password" placeholder="Enter Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="smtp_host">Server Smtp</label>
                                            <input type="text" class="form-control" id="smtp_host" name="smtp_host" placeholder="smtp.hotmail.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="smtp_port">Smtp Port(25, 465 or 587)</label>
                                            <input type="text" class="form-control" id="smtp_port" name="smtp_port"  value="25" placeholder="Enter Port 25, 465 or 587" required>
                                        </div>
                                    </div>
                                    
                                    {{-- <div class="col-md-3">
                                       
                                        <div class="form-group">
                                            <label for="smtp_secure">Smtp Secure (ssl,tls)</label>
                                            <select class="form-control" id="smtp_secure" name="smtp_secure" >
                                                <option value="">none </option>
                                                <option value="ssl">ssl </option>
                                                <option value="tls">tls</option>
                                            </select>
                                          </div>

                                    </div> --}}

                                   

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                            <label for="smtp_auth">Smtp Auth</label>
                                            <select class="form-control" id="smtp_auth" name="smtp_auth" required>
                                              <option value="true">True</option>
                                              <option value="false">False</option>
                                              
                                            </select>
                                          </div>

                                    </div>

                                    

                                </div>
                                <a href="{{ route('mailsetup.index')}}"   class="btn btn-warning mt-3 mb-0"><i class="fa fa-fast-backward"></i> Back</a>
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

 






@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/mailsetup.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
 
     

@endsection
