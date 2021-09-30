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
            <form class="form-horizontal" method="post" enctype="multipart/form-data"
                action="{{ route('members.prosonal.renew.update') }}">
                @csrf
                <input type="hidden" id="member_uid" name="member_uid" value="">
                <input type="hidden" id="member_group" name="member_group" value="PERSON">
                @if ($errors->any())
                    <div class="card" id="solid-alert">
                        <div class="text-wrap">
                            <div class="example">
                                @foreach ($errors->all() as $error)

                                    <div class="alert alert-solid-danger mg-b-10" role="alert">
                                        <button aria-label="Close" class="close" data-dismiss="alert"
                                            type="button">
                                            <span aria-hidden="true">&times;</span></button>
                                        <strong>Oh snap!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row row-sm">
                    <!-- Col -->

                    <!-- Col -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4 main-content-label">Personal Information</div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <label class="form-label">Member <NOscript></NOscript></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="member_uid" name="member_uid"
                                                        required>
                                                        <option value=""></option>
                                                        @foreach ($members as $item)
                                                            <option value="{{ $item->member_uid }}">
                                                                {{ $item->full_name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">KHAN</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="hidden" id="khan_uid" name="khan_uid" value="">
                                                    
                                                    <select class="form-control select2 khan_uid" id="khan_name" name="khan_name" disabled>
                                                        @foreach ($khans as $item)
                                                            <option value="{{ $item->khan_uid }}">
                                                                {{ $item->khan_name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                  
                                    

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Date Exp</label>
                                                </div>
                                                <div class="col-md-6">
                                                    {{-- <h4>Certificate </h4> --}}
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="date_expiry" name="date_expiry"
                                                        placeholder="Date Exp" value="" readonly >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Renew Date</label>
                                                </div>
                                                <div class="col-md-6">
                                                    {{-- <h4>Certificate </h4> --}}
                                                    <input type="date" class="form-control form-control-sm"
                                                        id="renew_date" name="renew_date"
                                                        placeholder="Renew Date" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-5" >
                                    <div class="img" style="display: none">
                                        <img id="img" src="" width="400px" height="260px"> </sig>
                                    </div>

                                </div>
                                 
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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
    <script src="{{ asset('adminpage/assets/js/admins/memberrenews.js?v='). time() }}"></script>
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
                        
                        
                        $(".img").css("display","block")
                        $("#img").attr("src", course.img_idcard);
                        $("#khan_name").select2({
                            data : course.khan_uid
                        }).val(course.khan_uid).trigger("change");

                    }
                }
            });
        });
    </script>


@endsection
