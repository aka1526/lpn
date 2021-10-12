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
                                    <i class="fas fa-book-medical"></i> Subscribe Page
                                </h4>

                                {{-- <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">

                                        <a class="btn btn-indigo  btn-block btn-new" href="{{ route('org.new') }}"><i
                                                class="fas fa-book-medical"></i>
                                            New Organization</a>
                                    </div>
                                </div> --}}
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <input type="text" id="search" name="search" class="form-control"
                                            value="{{ Request::get('search') }}" placeholder="Searching.....">
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
                                            <th class="text-center">No</th>
                                            <th class="text-center">Type</th>
                                            
                                            <th class="text-center">SUBSCRIBE Date</th>
                                            <th>SUBSCRIBE E-mail</th>
                                            <th class="text-center">Last Send</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Newsletters as $key => $row)
                                            <tr>

                                               
                                                <th class="text-center"> {{ $Newsletters->firstItem() + $key }}</th>
                                                <td class="text-center" > <div class="btn btn-primary">{{ $row->news_type }}</div></td>
                                                <td class="text-center">{{ $row->news_date }}</td>
                                                <td  >{{ $row->news_email }}</td>
                                                 
                                                <td class="text-center">
                                                    {{ $row->msg_send_at }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $row->msg_send_status }}
                                                </td>
                                                
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        

                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->news_uid }}" data-toggle="tooltip"
                                                            title="Delete"><i class="far fa-trash-alt"></i></button>

                                                         

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $Newsletters ->links('pagination.default', ['paginator' => $Newsletters, 'link_limit' => $Newsletters->perPage()]) }}
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
    <script src="{{ asset('adminpage/assets/js/admins/subscribe.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
