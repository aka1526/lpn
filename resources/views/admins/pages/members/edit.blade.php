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
                                        <div class="img profile-user text-center  ">
                                            <img width="180px" alt=""
                                                src="{{ $member->img_profile != '' ? '/images/members/' . $member->img_profile : '' }}"
                                                onerror="this.src='/images/no-image.png'" />
                                            <a class="fas fa-camera profile-edit text-center mr-5" data-target="#modalProfile"
                                                data-toggle="modal" href="JavaScript:void(0);"></a>
                                        </div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">Membership ID</h5>
												<p class="main-profile-name-text"> {{ $member->member_no }}</p>
											</div>
										</div>

                                        <hr class="mg-y-10">
                                        <label class="main-content-label tx-13 mg-b-20">Social</label>
                                        <div class="main-profile-social-list">
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="icon ion-logo-github"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Instagram</span>
                                                    <input type="text" class="form-control form-control-sm" id="user_ig"
                                                        name="user_ig" placeholder="Instagram"
                                                        value="{{ $member->user_ig }}">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-icon bg-success-transparent text-success">
                                                    <i class="icon ion-logo-twitter"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Facebook</span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="user_facebook" name="user_facebook" placeholder="facebook"
                                                        value="{{ $member->useuser_facebookr_ig }}">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-icon bg-info-transparent text-info">
                                                    <i class="icon ion-logo-linkedin"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>We Chat</span>
                                                    <input type="text" class="form-control form-control-sm" id="user_wechat"
                                                        name="user_wechat" placeholder="We Chat"
                                                        value="{{ $member->user_wechat }}">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-icon bg-info-transparent text-info">
                                                    <i class="icon ion-logo-linkedin"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Website</span>
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
                                                        Membership ID Card
                                                    </div>
                                                    <div class="img-user profile-user">
														<img alt=""
														src="{{ $member->img_idcard != '' ? '/images/members/card/' . $member->img_idcard : '' }}"
														onerror="this.src='/images/no-image.png'" />
															<a class="fas fa-camera profile-edit text-center" data-target="#modalidcard"
															data-toggle="modal" href="JavaScript:void(0);"></a>
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
                                    <h4>PERSONAL INFORMATION  </h4>
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
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="user_address" name="user_address" rows="4"
                                                placeholder="San Francisco, CA">{{ trim($member->user_address) }}</textarea>
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
                                <a href="/pageadmin/members/prosonal" class="btn btn-warning waves-effect waves-light"><i
                                        class="fa fa-step-backward"></i> Back</a>
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
        <div class="modal-dialog" role="document">

            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Upload Image</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="frmprofile" name="frmprofile" class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('members.profileimg')}}">
                    <div class="modal-body">

                        @csrf
                        <input type="hidden" id="img_uid" name="img_uid" value="{{ $member->member_uid }}">
                        <input type="hidden" id="img_type" name="img_type" value="profile">
						<div class="row ">
							<div class="col-md-2">
								<label class="form-label">Image </label>
							</div>

							<div class="col-sm-10 col-md-10 col-lg-10">

								<div class="input-group file-browser">

									<input type="text" class="form-control border-right-0 browse-file"
										placeholder="choose" readonly="">
									<label class="input-group-btn">
										<span class="btn btn-default">
											Browse <input type="file" id="fileupload" name="fileupload"
												style="display: none;" multiple="">
										</span>
									</label>
								</div>
							</div>
						</div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">Save changes</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->

<!-- Basic modal -->
<div class="modal" id="modalidcard">
	<div class="modal-dialog" role="document">

		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title">Upload Image</h6><button aria-label="Close" class="close"
					data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<form id="frmidcard" name="frmidcard" class="form-horizontal" method="post" enctype="multipart/form-data" 
				action="{{ route('members.idcardimg')}}">
				<div class="modal-body">

					@csrf
					<input type="hidden" id="card_uid" name="img_uid" value="{{ $member->member_uid }}">
					<input type="hidden" id="idcard_type" name="idcard_type" value="idcard">
					<div class="row ">
						<div class="col-md-4">
							<label class="form-label">Image </label>
						</div>

						<div class="col-sm-10 col-md-10 col-lg-10">

							<div class="input-group file-browser">

								<input type="text" class="form-control border-right-0 browse-file"
									placeholder="choose" readonly="">
								<label class="input-group-btn">
									<span class="btn btn-default">
										Browse <input type="file" id="fileupload" name="fileupload"
											style="display: none;" multiple="">
									</span>
								</label>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button class="btn ripple btn-primary" type="submit">Save</button>
					<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Basic modal -->



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
