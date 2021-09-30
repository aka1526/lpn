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
                action="{{ route('members.register.add') }}">
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

                    <div class="col-lg-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="pl-0">
                                    <div class="main-profile-overview ">
                                        <div class="text-center main-img-user profile-user">
                                            <img alt="" src="/images/no-image.png" />
                                            {{-- <a class="text-center fas fa-camera profile-edit"
                                                href="JavaScript:void(0);"></a> --}}
                                        </div>


                                        <hr class="mg-y-10">
                                        <label class="main-content-label tx-13 mg-b-20">Social</label>
                                        <div class="main-profile-social-list">
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="fab fa-instagram"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Instagram</span>
                                                    <input type="text" class="form-control form-control-sm" id="user_ig"
                                                        name="user_ig" placeholder="Instagram" value="">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="icon ion-logo-facebook"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Facebook</span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="user_facebook" name="user_facebook" placeholder="facebook"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="icon ion-ios-chatbubbles"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>We Chat</span>
                                                    <input type="text" class="form-control form-control-sm" id="user_wechat"
                                                        name="user_wechat" placeholder="We Chat" value="">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="icon ion-md-globe"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Website</span>
                                                    <input type="text" class="form-control form-control-sm" id="member_www"
                                                        name="member_www" placeholder="www" value="">
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- main-profile-overview -->
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="pl-0">
                                            <div class="main-profile-overview ">
                                                <div class="main-content-label tx-13 mg-b-25">
                                                    Membership ID Card
                                                </div>
                                                <div class="img-user profile-user">
                                                    <img alt="" src="/images/idcard/15989513232wzkpwy1veftntk.png">
                                                    <a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <!-- Col -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4 main-content-label">Personal Information</div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">First Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="first_name"
                                                        name="first_name" placeholder="First Name" value="" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Last Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Last Name"
                                                        id="last_name" name="last_name" value="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Gender</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="gender" name="gender" required>
                                                        <option value=""></option>
                                                        <option value="MALE">Male</option>
                                                        <option value="FEMALE">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Country</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="country_uid" name="country_uid" required>
                                                        <option value=""></option>
                                                        @foreach ($country as $item)
                                                            <option value="{{ $item->country_uid }}">{{ $item->country_name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Register Date</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="date" class="form-control" id="date_register"
                                                        name="date_register" placeholder="Register Date"  required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Date of Birth</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="date" class="form-control" id="dateofbirth"
                                                        name="dateofbirth" placeholder="Date of Birth" value="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="mb-4 main-content-label">Contact INFORMATION</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Email </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" id="user_email"
                                                        name="user_email " placeholder="email@email.com" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Phone</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="user_tel" name="user_tel"
                                                        placeholder="+245 354 654" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Address</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea class="form-control" id="user_address" name="user_address"
                                                        rows="4" placeholder="San Francisco, CA"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 main-content-label">Muay INFORMATION</div>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Type</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="user_type" name="user_type" required>
                                                        <option value=""> </option>
                                                        <option value="MEMBERS">Members</option>
                                                        <option value="TEACHERS">Teachers</option>
                                                        <option value="STUDENTS">Students</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">


                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Khan</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="khan_uid" name="khan_uid">
                                                        <option value=""></option>
                                                        @foreach ($khans as $item)
                                                            <option value="{{ $item->khan_uid }}">{{ $item->khan_name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Under Kru</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="kru_uid" name="kru_uid">
                                                        <option value="">---</option>
                                                        @foreach ($krus as $item)
                                                            <option value="{{ $item->member_uid }}">
                                                                {{ $item->full_name }}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Club Name</label>
                                                </div>
                                                <div class="col-md-9">


                                                    <input type="text" class="form-control form-control-sm" id="club_name"
                                                        name="club_name" placeholder="Club Name" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Certificate</label>
                                                </div>
                                                <div class="col-md-9">
                                                    {{-- <h4>Certificate </h4> --}}
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="certificate_no" name="certificate_no"
                                                        placeholder="Certificate no." value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Club Name</label>
                                                </div>
                                                <div class="col-md-9">


                                                    <input type="text" class="form-control form-control-sm" id="club_name"
                                                        name="club_name" placeholder="Club Name" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
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
    <script src="{{ asset('adminpage/assets/js/admins/members.js?v=') . time() }}"></script>
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



@endsection
