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
                action="{{ route('halloffame.add') }}">
                @csrf
                
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
                                <div class="text-white card-header tx-medium bd-0 bg-primary ">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="text-white card-title mg-b-0">
                                            <i class="fas fa-book-medical"></i>
                                            HALL OF FAME
                                        </h4>
        
                                        
                                    </div>
        
                                </div>
                                <div class="mt-3 row row-3">
                            
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="news_toppic">Title <span class="tx-danger">*</span></label>
                                            <input type="text" class="form-control" id="hof_title" name="hof_title" value="" placeholder="Enter Title">
                                        </div>
                                    </div>
        
                                </div>
                                <div class="mt-3 row">
                                     
                                        <div class="col">
                                            <label class="form-label">File Browser Image <span class="tx-danger">*</span> </label>
                                        
                                        <div class="row row-sm">
                                            <div class="col-sm-7 col-md-6 col-lg-4">
                                                <div class="input-group file-browser">
                                                    <input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly="">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-default">
                                                            Browse <input type="file" id="fileupload" name="fileupload" style="display: none;" required>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>       
                                <div class="row row-sm mg-t-20">
                                    <div class="col-lg">
                                        <textarea id="hof_content" name="hof_content" class="form-control" placeholder="Textarea" rows="10" required></textarea>
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
    <script src="{{ asset('adminpage/assets/js/admins/halloffame.js?v='). time() }}"></script>
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

     <!--Internal  pickerjs js -->
     <script src="/adminpage/assets/plugins/pickerjs/picker.min.js"></script>

     <script src="{{ asset('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
      <script src="{{ asset('/assets/plugins/ckeditor/adapters/jquery.js') }}"></script> 
      <script src="/adminpage/assets/js/eva-icons.min.js"></script>
      
 <script type="text/javascript">
    CKEDITOR.replace('hof_content', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

</script>

@endsection
