@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <link href="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <!-- Internal Select2 css -->
    <link href="{{ asset('adminpage/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ asset('adminpage/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}"
        rel="stylesheet">
    <link href="{{ asset('adminpage/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ asset('adminpage/assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">

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

            <!-- row -->
           

                <input type="hidden" id="rank_uid" name="rank_uid" value="{{ $rankings->rank_uid }}">
                <div class="row row-sm">
                    <!-- Col -->

                    <!-- Col -->
                    <div class="col-lg-12">
                        <div class="mb-20 card">
                            <div class="text-white card-header tx-medium bd-0 bg-primary">
                                <div class="d-flex justify-content-between">
                                    <h4 class="text-white card-title mg-b-0">
                                        <i class="fas fa-book-medical"></i> WORLD RANKINGS Information
                                    </h4>
                                    <div class="d-flex my-xl-auto right-content">
                                        <div class="pr-1 mb-xl-0">
                                            <a href="/pageadmin/rankings" class="btn btn-danger waves-effect waves-light"><i class="fas fa-times"></i> Close</a>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="card" id="solid-alert">
                                        <div class="text-wrap">
                                            <div class="example">
                                                @foreach ($errors->all() as $error)

                                                    <div class="alert alert-solid-danger mg-b-10" role="alert">
                                                        <button aria-label="Close" class="close"
                                                            data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <strong>Oh snap!</strong> {{ $error }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    
                                            <div class="col-md-2">
                                                <div class="form-group ">
                                                    <label for="rank_index">No.</label>
                                                    <input type="number" class="form-control" id="rank_index"
                                                        name="rank_index" min="1" value="{{ $rankings->rank_index }}" placeholder=" NO." readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group ">
                                                    <label class="form-label">Gender</label>
                                                    <div class="row">
                                                   
                                                        <div class="col">
                                                            <input type="text" class="form-control" id="rank_gander"
                                                        name="rank_gander" value="{{ $rankings->rank_gander }}" placeholder="gander" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label for="rankings_weight">Weight Class</label>
                                                    <input type="text" class="form-control" id="rankings_weight"
                                                        name="rankings_weight" value="{{ $rankings->rankings_weight }}" placeholder="Cruiserweight" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label for="rankings_weight_desc"> Weight Desc</label>
                                                    <input type="text" class="form-control" id="rankings_weight_desc"
                                                        name="rankings_weight_desc" value="{{ $rankings->rankings_weight_desc }}"
                                                        placeholder="(200 lbs, 90.719 kg)" readonly>
                                                </div>
                                            </div>

                                        </div>
                                        

                                        <div class="mt-3 main-content-label">Contenders </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-inline" method="post" enctype="multipart/form-data" action="{{ route('rankings.add.list') }}">
                                                    @csrf
                                                    <input type="hidden"  id="rank_uid" name="rank_uid"  value="{{ $rankings->rank_uid}}">
                                                     
                                                    <div class="mb-2 form-group col-md-8">
                                                      <label for="contenders" class="sr-only"> contenders</label>
                                                       
                                                        <input type="text" class="form-control col-md-12" id="contenders" name="contenders" placeholder="contenders">
                                                     
                                                    </div>

                                                     
                                                    <button type="submit" class="mb-2 btn btn-primary">Add Contenders</button>
                                                    
                                                  </form>
                                            </div>
                                             
                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3 main-content-label"> List :</div>
                                                <ol>
                                                 @foreach ($rankingslist as $item)
                                                    <li><h4>{{ $item->contenders }}</h4></li>
                                                     
                                                 @endforeach
                                                 <ol>
                                            </div>
                                        </div>
                                       
                                    
                                </div>
                            

                        </div>
                    </div>
                    <!-- /Col -->
                </div>

             
            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->







@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/rankings.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ asset('adminpage/assets/plugins/select2/js/select2.min.js') }}"></script>

    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ asset('adminpage/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ asset('adminpage/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}">
    </script>

    <!-- Ionicons js -->
    <script src="{{ asset('adminpage/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}">
    </script>
    <script type="text/javascript">
        $(document).on('change', '#member_uid', function() {
            let uid = $(this).val();
            var url = "/pageadmin/members/memberrenew/get";
            $.ajax({
                type: "get",
                url: url,
                data: {
                    uid: uid,
                    "_token": $('meta[name=_token]').attr('content')
                },
                success: function(data) {

                    if (data.success) {

                        var course = data.data;
                        $("#khan_uid").val(course.khan_uid);
                        $("#date_expiry").val(course.date_expiry);


                        $(".img").css("display", "block")
                        $("#img").attr("src", course.img_idcard);
                        $("#khan_name").select2({
                            data: course.khan_uid
                        }).val(course.khan_uid).trigger("change");

                    }
                }
            });
        });
    </script>


@endsection
