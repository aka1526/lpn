@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <link href="{{ asset('/adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

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
            <div class="row ">
                <!--div-->
                <div class="col-xl-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-1 text-white">Mail Subscribe Setup </h4>

                        </div>
                        <div class="card-body pt-10">
                            <form id="frm" action="{{ route('mailsetup.subscribe.add') }}" method="POST"
                                enctype="multipart/form-data">
                                <input type="hidden" id="email_uid" name="email_uid" value="{{ isset($msgsubscribe ) ?  $msgsubscribe->email_uid : '' }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
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
                            </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="mail_subject">Subject <span class="tx-danger">*</span></label>
                                            <input type="text" class="form-control" id="mail_subject" name="mail_subject"
                                            value="{{ $msgsubscribe  ? $msgsubscribe->email_subject  : ''   }}"
                                                placeholder="Enter Subject">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group  ">
                                            <label>Description</label>
                                            <textarea id="msg_subscribe" name="msg_subscribe" class="form-control"
                                                placeholder="course Description" rows="2">
                                                {!! isset($msgsubscribe )  !='' ? $msgsubscribe->email_body : '' !!}
                                                            </textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="smtp_secure">Start Date</label>
                                            <input type="date" class="form-control " id="start_date" name="start_date"
                                                placeholder="Start Date" value="{{ isset($msgsubscribe )  ? $msgsubscribe->email_date_start : ''  }}">
                                        </div>

                                    </div>


                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <label for="smtp_secure">Test Send Mail</label>
                                        <div class="input-group">

                                            <input class="form-control" id="emailtest" name="emailtest"
                                                placeholder="Enter E-mail..." type="text">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary sendmail-subscribe" type="button">
                                                    <span class="input-group-btn"><i class="fa fa-paper-plane"></i> Test
                                                        Mail</span>
                                                </button>
                                            </span>
                                        </div><!-- input-group -->
                                    </div>


                                </div>
                                <a href="/pageadmin/mailsubscribe" 
                                    class="btn btn-danger mt-3 mb-0">  New Mail </a>
                                <button type="submit" class="btn btn-primary mt-3 mb-0">Message Save</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
            <!--/div-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card  box-shadow-0">
                        <div class="card-body pt-10">
                            <table class="table table-bordered mg-b-0 text-md-nowrap">
                                <thead>

                                    <tr class="bg-info ">
                                        <th class="text-center">Start Date</th>
                                        <th>Mail Subject</th>
                                        
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Send Total</th>
                                        <th class="text-center">Diff</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Edit Date</th>
                                        <th class="text-center">Edit By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Mailsubscribe as $key => $row)
                                <tr>
                                    
                                    <td class="text-center">{{ $row->email_date_start }}</td>
                                    <td>{{ $row->email_subject }}</td>
                                    
                                    <td class="text-center">{{  $row->email_total }}</td>
                                    <td class="text-center">{{  $row->email_send_total }}</td>
                                    <td class="text-center">{{ $row->email_tota- $row->email_send_total }}</td>
                                    <td class="text-center">{{  $row->email_status }}</td>
                                    <td class="text-center">{{ $row->updated_at }}</td>
                                    <td class="text-center">{{ $row->updated_by }}</td>
                                    <td class="text-center">
                                        <div class="btn-icon-list">

                                            <button
                                                class="btn    btn-icon btn-sm btn-disable 
                                                {{ $row->member_status == 'Y' ? 'bg-secondary' : 'bg-success' }} "
                                                data-uid="{{ $row->	email_uid  }}"
                                                data-status="{{ $row->member_status == 'Y' ? 'N' : 'Y' }}"
                                                data-toggle="tooltip" title="Status">  
                                                <i class="{{ $row->member_status == 'Y' ? 'fas fa-eye-slash' : 'fas fa-eye' }}"></i> 
                                            </button>
                                                    
                                            <a href="/pageadmin/mailsubscribe?search={{ $row->	email_uid }}" 
                                                class="btn btn-indigo btn-icon btn-sm" data-toggle="tooltip"                                                           
                                                title="Edit"> <i class="fa fa-edit"></i></a>

                                            <button class="btn btn-danger btn-icon btn-sm btn-delete"
                                                data-uid="{{ $row->	email_uid  }}" data-toggle="tooltip"
                                                title="Delete"><i class="far fa-trash-alt"></i></button>

                                   
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                                </tbody>
                            </table>
                            <div class="pt-2">
                        {{ $Mailsubscribe->links('pagination.default', ['paginator' => $Mailsubscribe, 'link_limit' => $Mailsubscribe->perPage()]) }}
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->








@endsection
@section('adminjs')
    <!-- Internal Modal js-->
    <script src="{{ asset('adminpage/assets/js/admins/mailsetup.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
    <script src="{{ asset('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/assets/plugins/ckeditor/adapters/jquery.js') }}"></script>
    <script src="/adminpage/assets/js/eva-icons.min.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('msg_subscribe', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>


@endsection
