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
                                    <i class="fas fa-book-medical"></i> Mail Server Setup Page
                                </h4>
                                 
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">

                                        <a class="btn btn-indigo  btn-block btn-new"
                                          href="{{ route('mailsetup.new')}}"><i class="fas fa-book-medical"></i>
                                            New E-Mail</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <input type="text" id="search" name="search" class="form-control" 
                                        value="{{ Request::get('search') }}"
                                        placeholder="Searching.....">
                                        <span class="input-group-append">
                                            <button class="btn ripple btn-primary btn-search" type="button">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                           
                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                    <thead>

                                        <tr class="bg-info ">
                                            <th class="text-center"> NO</th>
                                            <th>Mail From</th>
                                            <th>Alia Name</th>
                                            <th class="text-center">E-mail</th>
                                            <th class="text-center">Host</th>
                                           
                                            <th class="text-center">Port</th>
                                           
                                         
                                            <th class="text-center">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Mailsetups as $key => $row)
                                            <tr>
                                                <th class="text-center" scope="row"> {{ $row->mail_index }}</th>
                                                <td>{{ $row->email_from }}</td>
                                                <td>{{ $row->email_from_alia }}</td>
                                                <td class="text-center">{{ $row->email_address }}</td>
                                                <td class="text-center">{{ $row->smtp_host }}</td>
                                                <td class="text-center">{{  $row->smtp_port }}</td>
                                                
                                                <td class="text-center">
                                                    <h5 class="text-warning">
                                                <span class="badge {{ $row->email_status=='Y' ? 'badge-primary' :'badge-secondary' }} ">
                                                    {{ $row->email_status=='Y' ? 'Enable' :'Disable' }}</span>  
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        <button
                                                            class="btn    btn-icon btn-sm btn-disable 
                                                            {{ $row->email_status != 'Y' ? 'bg-secondary' : 'bg-success' }} "
                                                            data-uid="{{ $row->mail_uid }}"
                                                            data-status="{{ $row->email_status == 'Y' ? 'N' : 'Y' }}"
                                                            data-toggle="tooltip" title="Status">  
                                                            <i class="{{ $row->email_status != 'Y' ? 'fas fa-eye-slash' : 'fas fa-eye' }}"></i> 
                                                        </button>
                                                                
                                                        <a href="/pageadmin/mailsetup/edit/{{ $row->mail_uid }}" 
                                                            class="btn btn-indigo btn-icon btn-sm" data-toggle="tooltip"                                                           
                                                            title="Edit"> <i class="fa fa-edit"></i></a>

                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->mail_uid }}" data-toggle="tooltip"
                                                            title="Delete"><i class="far fa-trash-alt"></i></button>

                                                            <button class="btn btn-primary btn-icon btn-sm btn-mail"
                                                            data-uid="{{ $row->mail_uid }}" data-toggle="tooltip"
                                                            title="Test Mail"><i class="fa fa-paper-plane"></i></button>

                                                            {{-- <a href="/pageadmin/mailsetup/mailtest/{{ $row->mail_uid }}" 
                                                                class="btn btn-indigo btn-icon btn-sm btn-mail" data-toggle="tooltip"                                                           
                                                                title="Test Mail"> <i class="fa fa-paper-plane"></i></a> --}}

                                                           
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $Mailsetups->links('pagination.default', ['paginator' => $Mailsetups, 'link_limit' => $Mailsetups->perPage()]) }}
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


@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/mailsetup.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
