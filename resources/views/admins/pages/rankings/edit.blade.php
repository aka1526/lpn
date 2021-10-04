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
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('rankings.update') }}">
                @csrf

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
                                    {{-- <div class="col-md-4">
                                        <img
                                            src="{{ $rankings->rank_img !='' ? '/images/rankings/'. $rankings->rank_img :  '/images/rankings/nopic.jpg' }}"></img>
                                    </div> --}}
                                    <div class="col-md-8">
                                        <div class="row">
                                            
                                            <div class="col-md-2">
                                                <div class="form-group ">
                                                    <label for="rank_index">No.</label>
                                                    <input type="number" class="form-control" id="rank_index"
                                                        name="rank_index" min="1" value="{{ $rankings->rank_index }}" placeholder=" NO." required>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group ">
                                                    <label class="form-label">Gender</label>
                                                    <div class="row">
                                                   
                                                        <div class="col">
                                                            <select class="form-control " id="rank_gander" name="rank_gander" required>
        
                                                                <option value="MALE" {{ $rankings->rank_gander =='MALE' ? 'selected' :'' }} >Male</option>
                                                                <option value="FEMALE" {{ $rankings->rank_gander =='FEMALE' ? 'selected' :'' }}>Female</option>
                                                            </select>
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
                                                        placeholder="(200 lbs, 90.719 kg)">
                                                </div>
                                            </div>

                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-md-8 col-sm-8 col-lg-8">
                                                <label for="fileupload">Browse File image. </label>
                                                <div class="input-group file-browser">
                                                  
                                                    <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-default">
                                                            Browse <input type="file" id="fileupload" name="fileupload" style="display: none;">
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3 main-content-label">WORLD CHAMPION</div>
                                        <div class="row">


                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="world_vacant">Vacant</label>
                                                    <input type="text" class="form-control" id="world_vacant"
                                                        name="world_vacant" value="{{ $rankings->world_vacant }}" placeholder="Enter name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="world_won_title">Won Title</label>
                                                    <input type="text" class="form-control" id="world_won_title"
                                                        name="world_won_title" value="{{ $rankings->world_won_title }}" placeholder="July 24, 2021">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="world_last_defense">Last Defense</label>
                                                    <input type="text" class="form-control" id="world_last_defense"
                                                        name="world_last_defense" value="{{ $rankings->world_last_defense }}" placeholder="Enter name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3 mt-4 main-content-label">INTERNATIONAL CHAMPION</div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="international_vacant">Vacant</label>
                                                    <input type="text" class="form-control" id="international_vacant"
                                                        name="international_vacant" value="{{ $rankings->international_vacant }}" placeholder="July 24, 2021">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="international_won_title">Won Title</label>
                                                    <input type="text" class="form-control" id="international_won_title"
                                                        name="international_won_title" value="{{ $rankings->international_won_title }}" placeholder="July 24, 2021">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="international_last_defense">Last Defense</label>
                                                    <input type="text" class="form-control"
                                                        id="international_last_defense" name="international_last_defense"
                                                        value="{{ $rankings->international_last_defense }}" placeholder="July 24, 2021">
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="">
                                            <a href="/pageadmin/rankings" class="btn btn-danger waves-effect waves-light"><i class="fas fa-times"></i> Close</a>
                                            <button type=" submit"
                                            class="btn btn-primary waves-effect waves-light">Save</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /Col -->
                </div>

            </form>
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
