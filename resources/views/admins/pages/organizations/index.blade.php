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
                                    <i class="fas fa-book-medical"></i> Organizations Members Page
                                </h4>

                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1  mb-xl-0">

                                        <a class="btn btn-indigo  btn-block btn-new" href="{{ route('org.new') }}"><i
                                                class="fas fa-book-medical"></i>
                                            New Organization</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <input type="text" id="search" name="search" class="form-control"
                                            value="{{ Request::get('search') }}" placeholder="Searching.....">
                                        <span class="input-group-append">
                                            <button class="btn ripple btn-primary btn-search" type="button">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0 text-md-nowrap">
                                    <thead>

                                        <tr class="bg-info ">
                                            <th class="text-center">Logo</th>
                                            <th>Organizations Name</th>
                                            <th>Kru Name</th>
                                            <th class="text-center">country</th>

                                            <th class="text-center">Www</th>
                                            <th class="text-center">Certificate</th>
                                            <th class="text-center">Date Exp.</th>
                                            <th class="text-center">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organizations as $key => $row)
                                            <tr>

                                                <td class="text-center">
                                                    <img src="{{ $row->org_logo != '' ? '/images/logo/thumbnails/' . $row->org_logo : '' }}"
                                                        onerror="this.src='/assets/img/no-logo.png'" width="120px"
                                                        height="70px" />
                                                </td>
                                                <td>{{ $row->org_name }}</td>
                                                <td class="text-center">{{ $row->org_name_teachers }}</td>
                                                <td class="text-center">{{ $row->org_country_name }}</td>
                                                <td class="text-center">{{ $row->org_www }}</td>
                                                <td class="text-center">{{ $row->org_certificate_no }}</td>
                                                <td class="text-center">{{ $row->org_date_exp }}</td>

                                                <td class="text-center">
                                                    <h5 class="text-warning">
                                                        <span
                                                            class="badge {{ $row->org_status == 'Y' ? 'badge-primary' : 'badge-secondary' }} ">
                                                            {{ $row->org_status == 'Y' ? 'Enable' : 'Disable' }}</span>
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-icon-list">

                                                        <button
                                                            class="btn    btn-icon btn-sm btn-disable 
                                                            {{ $row->org_status == 'Y' ? 'bg-secondary' : 'bg-success' }} "
                                                            data-uid="{{ $row->org_uid }}"
                                                            data-status="{{ $row->org_status == 'Y' ? 'N' : 'Y' }}"
                                                            data-toggle="tooltip" title="Status">
                                                            <i
                                                                class="{{ $row->org_status == 'Y' ? 'fas fa-eye-slash' : 'fas fa-eye' }}"></i>
                                                        </button>

                                                        <a href="/pageadmin/members/organizations/edit/{{ $row->org_uid }}"
                                                            class="btn btn-indigo btn-icon btn-sm" data-toggle="tooltip"
                                                            title="Edit"> <i class="fa fa-edit"></i></a>

                                                        <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                            data-uid="{{ $row->org_uid }}" data-toggle="tooltip"
                                                            title="Delete"><i class="far fa-trash-alt"></i></button>

                                                        <button type="button" data-uid="{{ $row->org_uid }}" id="renew"
                                                            name="renew" class="btn btn-primary  ">
                                                            <i class="far fa-clock"></i> RENEW</button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="pt-2">
                                    {{ $organizations->links('pagination.default', ['paginator' => $organizations, 'link_limit' => $organizations->perPage()]) }}
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


    <div class="modal" id="renewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Renew Member</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form  id="frm" name="frm" class="form-horizontal" method="post" enctype="multipart/form-data"
                        action="">
                        @csrf
                        <input type="hidden" id="org_uid" name="org_uid" value="">
                        <input type="hidden" id="org_date_validate" name="org_date_validate" value="">
                        <div class="row">
                                    
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Organizations </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="org_name"
                                                name="org_name"  value="" readonly>
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
                                            <label class="form-label">Date Exp </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" id="org_date_exp"  value="" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Date Renew</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" id="date_renew" name="date_renew"
                                                 value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-success btn-renew" type="submit" name="submit" value="Submit">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>




@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/organizations.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>


@endsection
