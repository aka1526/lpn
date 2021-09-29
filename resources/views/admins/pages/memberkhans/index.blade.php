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
                                    <i class="fas fa-book-medical"></i> Member Khan Page
                                </h4>
                                 
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1 mb-xl-0">

                                        <a class="btn btn-indigo btn-block btn-new"
                                          href="{{ route('memberkhans.new')}}"><i class="fas fa-book-medical"></i>
                                            Member Up Khan</a>
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
                                            <th class="text-center">ISSUE DATE</th>
                                            <th>CERTIFICATE NO.</th>
                                            <th>Member NO.</th>
                                            <th class="text-center">Member NAME</th>
                                            <th class="text-center">KAHN NAME</th>
                                           
                                            <th class="text-center">Create by</th>
                                            <th class="text-center">date Time</th>
                                          
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($memberkhans as $key => $row)
                                            <tr>
                                                
                                                <th class="text-center" scope="row"> {{ $row->cer_date_issue }}</th>
                                                <th class="text-center" scope="row"> {{ $row->cer_no }}</th>
                                                <td>{{ $row->cer_member_no }}</td>
                                                <td>{{ $row->cer_member_fullname }}</td>
                                                <td class="text-center">{{ $row->khan_name }}</td>
                                              
                                                <td class="text-center">{{  $row->created_by }}</td>
                                                <td class="text-center">{{  $row->created_at }}</td>
                                                
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        
                                                         
                                                        {{-- <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->member_uid }}" data-toggle="tooltip"
                                                            title="Delete"><i class="far fa-trash-alt"></i></button> --}}

                                                            <button type="button" 
                                                                data-img="{{ $row->card_img != '' ? '/images/members/card/' . $row->card_img : '' }}" 
                                                                id="print_card" name="print_card" class="btn btn-primary ">
                                                                <i class="fa fa-credit-card"></i> ID Card</button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $memberkhans->links('pagination.default', ['paginator' => $memberkhans, 'link_limit' => $memberkhans->perPage()]) }}
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
    <script src="{{ asset('adminpage/assets/js/admins/memberkhans.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
