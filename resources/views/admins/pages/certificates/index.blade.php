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
                                    <i class="fas fa-book-medical"></i> Certificate Page
                                </h4>
                                 
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1 mb-xl-0">

                                        <a class="btn btn-indigo btn-block btn-new"
                                          href="{{ route('certificates.new')}}"><i class="fas fa-book-medical"></i>
                                            Certificate New </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            
                            <div class="row">
                               
                                <div class="col-md-12">
                                    <div class="mb-2 input-group">
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
                                            <th class="text-center">MEMBER NO</th>
                                            <th>Image</th>
                                            <th>Member Name</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">country</th>
                                           
                                            <th class="text-center">Khan</th>
                                            <th class="text-center">Date Exp.</th>
                                            <th class="text-center">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($certificates as $key => $row)
                                            <tr>
                                                <th class="text-center" scope="row"> {{ $row->member_no }}
                                                </th>
                                                <td class="text-center">
                                                    <img src="{{$row->img_profile !='' ? '/images/members/'.$row->img_profile :''  }}" onerror="this.src='/images/no-image.png'" width="60px" height="70px"/>
                                                   </td>
                                                <td>{{ $row->full_name }}</td>
                                                <td class="text-center">{{ $row->user_type }}</td>
                                                <td class="text-center">{{ $row->country_name }}</td>
                                                <td class="text-center">{{  $row->khan_name }}</td>
                                                <td class="text-center">{{  $row->date_expiry }}</td>
                                                
                                                <td class="text-center">
                                                    <h5 class="text-warning">
                                                <span class="badge {{ $row->member_status=='Y' ? 'badge-primary' :'badge-secondary' }} ">
                                                    {{ $row->member_status=='Y' ? 'Enable' :'Disable' }}</span>  
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        
                                                                
                                                        <a href="/pageadmin/members/prosonal/edit/{{ $row->member_uid }}" 
                                                            class="btn btn-indigo btn-icon btn-sm" data-toggle="tooltip"                                                           
                                                            title="Edit"> <i class="fa fa-edit"></i></a>

                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->member_uid }}" data-toggle="tooltip"
                                                            title="Delete"><i class="far fa-trash-alt"></i></button>

                                                            <button type="button" 
                                                                data-img="{{ $row->img_idcard != '' ? '/images/members/card/' . $row->img_idcard : '' }}" 
                                                                id="print_card" name="print_card" class="btn btn-primary ">
                                                                <i class="fa fa-credit-card"></i> ID Card</button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $certificates->links('pagination.default', ['paginator' => $certificates, 'link_limit' => $certificates->perPage()]) }}
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
    <script src="{{ asset('adminpage/assets/js/admins/members.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
