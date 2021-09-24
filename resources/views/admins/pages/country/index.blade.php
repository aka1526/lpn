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
                                    <i class="fas fa-book-medical"></i> Country Page
                                </h4>
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">

                                        <a class="btn btn-indigo  btn-block btn-new"
                                          
                                              href="{{ route('country.new')}}"><i class="fas fa-book-medical"></i>
                                            New </a>
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
                                            <th>Country Name</th>
                                            <th>Country Code</th>
                                            <th>Country Code 3 d</th>
                                            <th class="text-center">Flag</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($country as $key => $row)
                                            <tr>
                                                <th class="text-center" scope="row"> {{ $country->firstItem() + $key }}
                                                </th>
                                                <td>{{ $row->country_name }}</td>
                                                <td class="text-center">{{ $row->country_code }}</td>
                                                <td class="text-center">{{ $row->country_code3 }}</td>
                                                <td class="text-center"> 
                                                <img src="{{ '/images/country/'.$row->country_flag }}" alt="" width="100px" height="40px">
                                            </td>
                                                <td class="text-center">
                                                    <h5 class="text-warning">
                                                <span class="badge {{ $row->country_status=='Y' ? 'badge-primary' :'badge-secondary' }} ">
                                                    {{ $row->country_status=='Y' ? 'Enable' :'Disable' }}</span>  
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        <button
                                                            class="btn    btn-icon btn-sm btn-disable 
                                                            {{ $row->country_status == 'Y' ? 'bg-secondary' : 'bg-success' }} "
                                                            data-uid="{{ $row->country_uid }}"
                                                            data-status="{{ $row->country_status == 'Y' ? 'N' : 'Y' }}"
                                                            data-toggle="tooltip" title="Status">
                                                            <i class="{{ $row->country_status == 'Y' ? 'fas fa-eye-slash' : 'fas fa-eye' }}"></i> 
                                                             </button>
                                                                
                                                        <a href="/pageadmin/country/edit/{{ $row->country_uid }}" 
                                                            class="btn btn-indigo btn-icon btn-sm" data-toggle="tooltip"                                                           
                                                            title="Edit"> <i class="fa fa-edit"></i></a>

                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->country_uid }}" data-toggle="tooltip"
                                                            title="Delete"><i class="far fa-trash-alt"></i></button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $country->links('pagination.default', ['paginator' => $country, 'link_limit' => $country->perPage()]) }}
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
    <script src="{{ asset('adminpage/assets/js/admins/country.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
