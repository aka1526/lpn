@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <link href="{{ asset('/adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <!-- Internal Select2 css -->
    <link href="{{ asset('/adminpage/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ asset('/adminpage/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}"
        rel="stylesheet">
    <link href="{{ asset('/adminpage/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ asset('/adminpage/assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/adminpage/assets/css/imgareaselect-default.css') }}" rel="stylesheet">

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
                action="{{ route('members.register.update') }}">
                @csrf
                <input type="hidden" id="member_uid" name="member_uid" value="{{ $member->member_uid }}">
                <input type="hidden" id="member_group" name="member_group" value="{{ $member->member_group }}">
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
                                        <div class="text-center img profile-user ">
                                            <img width="160px" height="200px" alt=""
                                                src="{{ $member->img_profile != '' ? '/images/members/' . $member->img_profile : '' }}"
                                                onerror="this.src='/images/no-image.png'" />
                                            <a class="mr-5 text-center fas fa-camera profile-edit"
                                                data-target="#modalProfile" data-toggle="modal"
                                                href="JavaScript:void(0);"></a>
                                        </div>
                                        <div class="d-flex justify-content-between mg-b-15 mg-t-15">
                                            <div>
                                                <h5 class="main-profile-name"> MEMBER NO:  <span class="text-danger">{{ $member->member_no }}</span></h5>
                                                {{-- <p class="main-profile-name-text"> {{ $member->member_no }}</p> --}}
                                            </div>
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
                                                        name="user_ig" placeholder="Instagram"
                                                        value="{{ $member->user_ig }}">
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
                                                        value="{{ $member->useuser_facebookr_ig }}">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="icon ion-ios-chatbubbles"></i>
												 
                                                </div>
                                                <div class="media-body">
                                                    <span>We Chat</span>
                                                    <input type="text" class="form-control form-control-sm" id="user_wechat"
                                                        name="user_wechat" placeholder="We Chat"
                                                        value="{{ $member->user_wechat }}">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="icon ion-md-globe"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Web site</span>
                                                    <input type="text" class="form-control form-control-sm" id="member_www"
                                                        name="member_www" placeholder="www"
                                                        value="{{ $member->member_www }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- main-profile-overview -->
                                </div>
                            </div>
                        </div>
                        @if ($member->user_type != 'MEMBERS')
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="pl-0">
                                                <div class="main-profile-overview ">
                                                    <div class="main-content-label tx-13 mg-b-20">
                                                        Member  Card
                                                    </div>
                                                    <div class="img-user profile-user">
                                                        <img alt=""
                                                            src="{{ $member->img_idcard != '' ? '/images/members/card/' . $member->img_idcard : '' }}"
                                                            onerror="this.src='/images/no-image.png'" />
                                                        {{-- <a class="text-center fas fa-camera profile-edit" data-target="#modalidcard"
															data-toggle="modal" href="JavaScript:void(0);"></a> --}}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else

                        @endif

                    </div>

                    <!-- Col -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4 main-content-label">
                                    <h4>PERSONAL INFORMATION </h4>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">First Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="first_name"
                                                        name="first_name" placeholder="First Name"
                                                        value="{{ $member->first_name }}" required>
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
                                                        id="last_name" name="last_name" value="{{ $member->last_name }}">
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

                                                        <option value="MALE"
                                                            {{ $member->gender == 'MALE' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value="FEMALE"
                                                            {{ $member->gender == 'FEMALE' ? 'selected' : '' }}>Female
                                                        </option>
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
                                                    <select class="form-control select2" id="country_uid" name="country_uid"
                                                        required>
                                                        @foreach ($country as $item)
                                                            <option value="{{ $item->country_uid }}"
                                                                {{ $member->country_uid == $item->country_uid ? 'selected' : '' }}>
                                                                {{ $item->country_name }}</option>
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
                                                        name="date_register" placeholder="Register Date"
                                                        value="{{ $member->date_register }}" required>
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
                                                        name="dateofbirth" placeholder="Date of Birth"
                                                        value="{{ $member->dateofbirth }}">
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
                                                        name="user_email " placeholder="email@email.com"
                                                        value="{{ $member->user_email }}">
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
                                                        placeholder="+245 354 654" value="{{ $member->user_tel }}">
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
                                                        rows="4" placeholder="San Francisco, CA">{{ trim($member->user_address) }}</textarea>
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
                                                    <select class="form-control select2" id="user_type" name="user_type">
                                                        <option value="MEMBERS"
                                                            {{ $member->user_type == 'MEMBERS' ? 'selected' : '' }}>
                                                            Members
                                                        </option>
                                                        <option value="TEACHERS"
                                                            {{ $member->user_type == 'TEACHERS' ? 'selected' : '' }}>
                                                            Teachers</option>
                                                        <option value="STUDENTS"
                                                            {{ $member->user_type == 'STUDENTS' ? 'selected' : '' }}>
                                                            Students</option>
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
                                                    @if ($member->khan_no > 0 && $member->user_type != 'MEMBERS')
                                                        <input type="hidden" id="khan_uid" name="khan_uid"
                                                            value="{{ $member->khan_uid }}">

                                                        <h4> {{ $member->khan_name }}</h4>
                                                    @else
                                                        @if ($member->user_type == 'MEMBERS')
                                                            <h4>None Khan</h4>
                                                            <input type="hidden" id="khan_uid" name="khan_uid" value="">

                                                        @else
                                                            <select class="form-control select2" id="khan_uid"
                                                                name="khan_uid">
                                                                @foreach ($khans as $item)
                                                                    <option value="{{ $item->khan_uid }}"
                                                                        {{ $member->khan_uid == $item->khan_uid ? 'selected' : '' }}>
                                                                        {{ $item->khan_name }}</option>
                                                                @endforeach

                                                            </select>
                                                        @endif
                                                    @endif

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
                                                            <option value="{{ $item->member_uid }}"
                                                                {{ $member->kru_uid == $item->member_uid ? 'selected' : '' }}>
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
                                                        name="club_name" placeholder="Club Name"
                                                        value="{{ $member->club_name }}">
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
                                                    <label class="form-label">Certificate No.</label>
                                                </div>
                                                <div class="col-md-9">
                                                    @if ($member->certificate_no != '')
                                                        <input type="hidden" id="certificate_no" name="certificate_no"
                                                            value="{{ $member->certificate_no }}">
                                                        <h4> {{ $member->certificate_no }} </h4>
                                                    @else
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="certificate_no" name="certificate_no"
                                                            placeholder="Certificate no." value="">
                                                    @endif


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
                                <a href="/pageadmin/members/prosonal" class="btn btn-danger waves-effect waves-light"><i class="fas fa-times"></i> Close</a>
                                <button type="button" data-img="{{ $member->img_idcard != '' ? '/images/members/card/' . $member->img_idcard : '' }}" 
                                    id="print_card" name="print_card" class="btn btn-primary "><i class="fa fa-credit-card"></i> Print Card</button>
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


    <!-- Basic modal -->
    <div class="modal" id="modalProfile">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content modal-content-demo">
                <div class="modal-header"> 
                    <h6 class="modal-title">Upload Image</h6>
                    <button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="frmprofile" name="frmprofile" class="form-horizontal" method="post" enctype="multipart/form-data"
                    action="{{ route('members.profileimg') }}">
                    <div class="modal-body">

                        @csrf
                        <div id="alert" name="alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none">
                            <strong>Opp!</strong> You should area in on some of image below.
                             
                          </div>
                        <input type="hidden" id="img_uid" name="img_uid" value="{{ $member->member_uid }}">
                        <input type="hidden" id="img_type" name="img_type" value="profile">
                        <div class="mt-3 row">

                            <div class="col-sm-10 col-md-10 col-lg-10">

                                <div class="input-group file-browser">

                                    <input type="text" class="form-control border-right-0 browse-file" placeholder="choose"
                                        readonly="">
                                    <label class="input-group-btn">
                                        <span class="btn btn-default">
                                            Browse <input type="file" class="image" id="fileupload"
                                                name="fileupload" style="display: none;" multiple="">
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn ripple btn-primary" type="submit">Save</button>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 test-center">

                                <div class="form-group">
                                    <input type="hidden" name="x1" id="x1" value="" />
                                    <input type="hidden" name="y1" id="y1" value="" />
                                    <input type="hidden" name="w"  id="w"value="" />
                                    <input type="hidden" name="h" id="h" value="" />
                                </div>


                                <p id="image_card">
                                    <img id="previewimage" style="display:none;position:relative;" /></p>
                                @if (session('path'))
                                    <img src="{{ session('path') }}" />
                                @endif
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        {{-- <button class="btn ripple btn-primary" type="submit">Save changes</button>
                        <button class="btn ripple btn-secondary btn-close" data-dismiss="modal" type="button">Close</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->




@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('/adminpage/assets/js/admins/certificates.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('/adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ asset('/adminpage/assets/plugins/select2/js/select2.min.js') }}"></script>

    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ asset('/adminpage/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ asset('/adminpage/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}">
    </script>

    <!-- Ionicons js -->
    <script src="{{ asset('/adminpage/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}">
    </script>
    <script src="{{ asset('/adminpage/assets/js/admins/jquery.imgareaselect.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var p = $("#previewimage");


            $("body").on("change", ".image", function() {
                var imageReader = new FileReader();
                imageReader.readAsDataURL(document.querySelector(".image").files[0]);

                imageReader.onload = function(oFREvent) {
                    p.attr('src', oFREvent.target.result).fadeIn();

                };
            });


            $('#previewimage').imgAreaSelect(

                {
                    parent: '#image_card',
                    onSelectEnd: function(img, selection) {
                        $('input[name="x1"]').val(selection.x1);
                        $('input[name="y1"]').val(selection.y1);
                        $('input[name="w"]').val(selection.width);
                        $('input[name="h"]').val(selection.height);
                    }

                });


        });

        $(document).on('click', '.ripple', function(e) {
            var y1 = $('#y1').val();
			 
            if (y1 == '' || y1 <=0 ) {
				e.preventDefault();
               // $("#alert").removeAttr("style").hide();
                $("#alert").show();
              //  $('#modalProfile').modal('hide');
                // Swal.fire({
                //     title: 'No Area Selected',
                //    text: "Choose a Area please!",
                //     icon: 'error',
                //     showCancelButton: false,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Close.'
                // }).then((result) => {
                //     if (result.isConfirmed) {
                //         location.reload();
                //     }
                // })
            } else {
                $("#alert").removeAttr("style").hide();
                $('#modalProfile').modal('hide');
                location.reload();
            }

        });
    </script>


@endsection
