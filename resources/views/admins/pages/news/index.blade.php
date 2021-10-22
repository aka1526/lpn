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
                                    <i class="fas fa-book-medical"></i> News Page
                                </h4>
                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">
                                        <a class="btn btn-indigo  btn-block btn-new"
                                              href="{{ route('news.new')}}"><i class="fas fa-book-medical"></i>
                                            New Page</a>
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
                                            <th>image</th>
                                            <th>Catalog</th>
                                            <th>Toppic</th>
                                           
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Even-Time</th>
                                            
                                            <th class="text-center">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $key => $row)
                                            <tr>
                                                <th class="text-center" scope="row"> {{ $news->firstItem() + $key }}
                                                </th>
                                                <td><img src="{{ '/images/news/'.$row->news_url.'/thumbnails/'. $row->news_img }}" width="110px" alt=""></td>
                                                <td>{{ $row->news_group }}</td>
                                                <td>{{ $row->news_toppic }}</td>
                                               
                                                <td>{!! $row->news_desc !!}</td>
                                                <td>{{ $row->news_location }}</td>
                                                <td>{{  \Carbon\Carbon::parse($row->news_datetime)->diffForHumans() }}</td>
                                                 
                                              
                                                <td class="text-center">
                                                    <h5 class="text-warning">
                                                <span class="badge {{ $row->news_status=='Y' ? 'badge-primary' :'badge-secondary' }} ">
                                                    {{ $row->news_status=='Y' ? 'Enable' :'Disable' }}</span>  
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        <button
                                                            class="btn    btn-icon btn-sm btn-disable 
                                                            {{ $row->news_status == 'Y' ? 'bg-secondary' : 'bg-success' }} "
                                                            data-uid="{{ $row->news_uid }}"
                                                            data-status="{{ $row->news_status == 'Y' ? 'N' : 'Y' }}"
                                                            data-toggle="tooltip" title="Status"> <i
                                                                class="fa fa-ban"></i></button>
                                                                
                                                        <a href="/pageadmin/news/edit/{{ $row->news_uid }}" 
                                                            class="btn btn-indigo btn-icon btn-sm" data-toggle="tooltip"                                                           
                                                            title="Edit"> <i class="fa fa-edit"></i></a>

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
                                    {{ $news->links('pagination.default', ['paginator' => $news, 'link_limit' => $news->perPage()]) }}
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
    <script src="{{ asset('adminpage/assets/js/admins/news.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
