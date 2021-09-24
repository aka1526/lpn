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

                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header bg-primary">
                            <h4 class="card-title mb-1">System info </h4>
                            {{-- <p class="mb-2">Title apllication.</p> --}}
                        </div>
                        <div class="card-body pt-10">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form id="frm" name="frm" action="{{ route('sysinfo.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sys_uid" id="sys_uid"
                                    value="{{ isset($sysinfo->sys_uid) ? $sysinfo->sys_uid : '' }}">



                                <div class="">
                                    <div class=" row row-sm mg-b-10">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sys_name"> Company Name</label>
                                            <input type="text" class="form-control" id="sys_name" name="sys_name"
                                                value="{{ isset($sysinfo->sys_name) ? $sysinfo->sys_name : '' }}"
                                                placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sys_name"> Company Name Thai</label>
                                            <input type="text" class="form-control" id="sys_name_th" name="sys_name_th"
                                                value="{{ isset($sysinfo->sys_name_th) ? $sysinfo->sys_name_th : '' }}"
                                                placeholder="Enter Company Name Thai">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm mg-b-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sys_address">Address</label>
                                            <textarea class="form-control" id="sys_address" name="sys_address"
                                                placeholder="Enter Address"
                                                rows="3">{{ isset($sysinfo->sys_address) ? $sysinfo->sys_address : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm mg-b-10">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sys_www"> website</label>
                                            <input type="url" class="form-control" id="sys_www" name="sys_www"
                                                value="{{ isset($sysinfo->sys_www) ? $sysinfo->sys_www : '' }}"
                                                placeholder="http://www.company.com">
                                        </div>
                                    </div>

                                </div>

                                <div class="row row-sm mg-b-10">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sys_country">Country</label>
                                            <input type="text" class="form-control" id="sys_country" name="sys_country"
                                                value="{{ isset($sysinfo->sys_country) ? $sysinfo->sys_country : '' }}"
                                                placeholder="Enter Country">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sys_email1">1.E-mail</label>
                                            <input type="text" class="form-control" id="sys_email1" name="sys_email1"
                                                value="{{ isset($sysinfo->sys_email1) ? $sysinfo->sys_email1 : '' }}"
                                                placeholder="Enter Title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sys_email2">2.E-mail</label>
                                            <input type="text" class="form-control" id="sys_email2" name="sys_email2"
                                                value="{{ isset($sysinfo->sys_email2) ? $sysinfo->sys_email2 : '' }}"
                                                placeholder="Enter Main">
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm mg-b-10">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_phone1"> 1. Phone</label>
                                            <input type="text" class="form-control" id="sys_phone1" name="sys_phone1"
                                                value="{{ isset($sysinfo->sys_phone1) ? $sysinfo->sys_phone1 : '' }}"
                                                placeholder="Enter Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_phone2"> 2.Phone</label>
                                            <input type="text" class="form-control" id="sys_phone2" name="sys_phone2"
                                                value="{{ isset($sysinfo->sys_phone2) ? $sysinfo->sys_phone2 : '' }}"
                                                placeholder="Enter Phone">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_openday">Open Day</label>
                                            <input type="text" class="form-control" id="sys_openday" name="sys_openday"
                                                value="{{ isset($sysinfo->sys_openday) ? $sysinfo->sys_openday : '' }}"
                                                placeholder="Enter Sun-Mon">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_openhour"> Open Hour</label>
                                            <input type="text" class="form-control" id="sys_openhour" name="sys_openhour"
                                                value="{{ isset($sysinfo->sys_openhour) ? $sysinfo->sys_openhour : '' }}"
                                                placeholder="Enter 08.00-20.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm mg-b-10">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_facebook"><i class="fab fa-facebook-square"></i>
                                                Facebook</label>
                                            <input type="text" class="form-control" id="sys_facebook" name="sys_facebook"
                                                value="{{ isset($sysinfo->sys_facebook) ? $sysinfo->sys_facebook : '' }}"
                                                placeholder="Enter facebook">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_twitter"><i class="fab fa-twitter"></i> Twitter</label>
                                            <input type="text" class="form-control" id="sys_twitter" name="sys_twitter"
                                                value="{{ isset($sysinfo->sys_twitter) ? $sysinfo->sys_twitter : '' }}"
                                                placeholder="Enter twitter">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_youtube"> <i class="fab fa-youtube"></i> Youtube</label>
                                            <input type="text" class="form-control" id="sys_youtube" name="sys_youtube"
                                                value="{{ isset($sysinfo->sys_youtube) ? $sysinfo->sys_youtube : '' }}"
                                                placeholder="Enter  youtube">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="intragram"><i class="typcn typcn-social-instagram"></i>
                                                Intragram</label>
                                            <input type="text" class="form-control" id="intragram" name="intragram"
                                                value="{{ isset($sysinfo->intragram) ? $sysinfo->intragram : '' }}"
                                                placeholder="Enter intragram">
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm mg-b-10">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_googlemap_lat"> <i class="fa fa-map-marker"></i>
                                                Googlemap-latitude</label>
                                            <input type="text" class="form-control" id="sys_googlemap_lat"
                                                name="	sys_googlemap_lat"
                                                value="{{ isset($sysinfo->sys_googlemap_lat) ? $sysinfo->sys_googlemap_lat : '' }}"
                                                placeholder="Enter latitude">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_googlemap_lon"><i class="fa fa-map-marker"></i>
                                                Googlemap-longitude</label>
                                            <input type="text" class="form-control" id="sys_googlemap_lon"
                                                name="sys_googlemap_lon"
                                                value="{{ isset($sysinfo->sys_googlemap_lon) ? $sysinfo->sys_googlemap_lon : '' }}"
                                                placeholder="Enter longitude">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_googlemap_zoom"><i class="fa fa-search-plus"></i>
                                                Map-Zoom</label>
                                            <input type="text" class="form-control" id="sys_googlemap_zoom"
                                                name="sys_googlemap_zoom"
                                                value="{{ isset($sysinfo->sys_googlemap_zoom) ? $sysinfo->sys_googlemap_zoom : '' }}"
                                                placeholder="Enter googlemap Zoom">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_googlemap_info"><i class="fa fa-podcast"></i> Map info</label>
                                            <input type="text" class="form-control" id="sys_googlemap_info"
                                                name="sys_googlemap_info"
                                                value="{{ isset($sysinfo->sys_googlemap_info) ? $sysinfo->sys_googlemap_info : '' }}"
                                                placeholder="Enter googlemap info">
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm mg-b-10">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sys_googlemap_marker">map icon marker</label>
                                            <input type="text" class="form-control" id="sys_googlemap_marker"
                                                name="sys_googlemap_marker"
                                                value="{{ isset($sysinfo->sys_googlemap_marker) ? $sysinfo->sys_googlemap_marker : 'assets/img/map-m.png' }}"
                                                placeholder="Enter icon marker">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="sys_slogan">slogan</label>
                                            <input type="text" class="form-control" id="sys_slogan" name="sys_slogan"
                                                value="{{ isset($sysinfo->sys_slogan) ? $sysinfo->sys_slogan : '' }}"
                                                placeholder="Enter slogan">
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-0">Save</button>
                        </form>
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
    <script src="{{ asset('adminpage/assets/js/admins/course.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
