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
                                    <i class="fas fa-book-medical"></i>
                                    HALL OF FAME
                                </h4>

                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1 mb-xl-0">

                                        <a class="btn btn-indigo btn-block btn-new"
                                            href="{{ route('halloffame.new') }}"><i class="fas fa-book-medical"></i>
                                            RENEW</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-2 input-group">
                                        <input type="text" id="search" name="search" class="form-control"
                                            value="{{ Request::get('search') }}" placeholder="Searching.....">
                                        <span class="input-group-append">
                                            <button class="btn ripple btn-primary btn-search" type="button">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 row row-sm">
                                @foreach ($halloffames as $key => $row)
                                    <div class="col-xl-4 col-lg-4 col-md-12">
                                        <div class="text-center card">
                                            <img class="card-img-top w-100 " onerror="this.onerror=null;this.src='/images/halloffame/nopic.png';" src="{{ '/images/halloffame/thumbnails/'.$row->hof_img}}" alt="" height="230px" width="160px">
                                            <div class="card-body">
                                                <h4 class="mb-3 card-title"> <a   href="/pageadmin/halloffame/edit/{{ $row->hof_uid}}">{{ $row->hof_title}}</a> </h4>
                                                
                                                <a class="btn btn-danger" href="/pageadmin/halloffame/delete/{{ $row->hof_uid}}">Delete</a>
                                                <a class="btn btn-primary" href="/pageadmin/halloffame/edit/{{ $row->hof_uid}}">Update</a>
                                             
                                            </div>
                                        </div>
                                    </div>



                                @endforeach
                            </div>

                            <div class="pt-2">
                                {{ $halloffames->links('pagination.default', ['paginator' => $halloffames, 'link_limit' => $halloffames->perPage()]) }}
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
    <script src="{{ asset('adminpage/assets/js/admins/halloffame.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
