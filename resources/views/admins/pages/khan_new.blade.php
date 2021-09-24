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
                            <h4 class="card-title mb-1 text-white">New Khan Muay  </h4>
                            
                        </div>
                        <div class="card-body pt-10">
                            <form id="frm" action="{{ route('khans.add')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="khan_uid" name="khan_uid" > 
                                @csrf
                               
                                @if ($errors->any())
                                <div class="card custom-card" id="dismiss-alerts">
									<div class="card-body">
                                            @foreach ($errors->all() as $error)
                                                
                                            <div class="alert alert-solid-danger mg-b-0" role="alert">
                                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                <span aria-hidden="true">&times;</span></button>
                                                <strong>Oh snap!</strong> {{ $error }}
                                            </div>

                                             
                                                
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                
                             
                               
                                <div class="">
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="khan_index">KHAN NO.</label>
                                                <input type="number" class="form-control" id="khan_index" name="khan_index"
                                               max="30" min="1"  placeholder="Khan No">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                 
                                                        <label class="form-label">GROUP</label>
                                                        <select class="form-control select2" id="khan_group" name="khan_group">
                                                            <option value="STUDENTS">STUDENTS</option>
                                                            <option value="TEACHERS">TEACHERS</option>
                                                            
                                                        </select>
                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="khan_name">Khan Name EN</label>
                                                <input type="text" class="form-control" id="khan_name" name="khan_name" placeholder="Khan name" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                  
                                    
                                    <div class="row row-sm mg-t-20">
                                       
										<div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="khan_desc">Description</label>
											<textarea class="form-control" id="khan_desc" name="khan_desc" placeholder="body" rows="5" required></textarea>
										</div>
										 
									</div>
                                     
                                </div>
                                <a href="{{ route('khans.index')}}"   class="btn btn-warning mt-3 mb-0"><i class="fa fa-fast-backward"></i> Back</a>
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
    <script src="{{ asset('adminpage/assets/js/admins/khans.js?v='). time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/adapters/jquery.js') }}"></script> 
    <script type="text/javascript">
        CKEDITOR.replace('khan_desc'
       /* , {
            filebrowserUploadUrl: "{{route('aboutus.uploadimg', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        }*/
        );
        CKEDITOR.add
        CKEDITOR.config.contentsCss = '/assets/css/style.css' ; 
        CKEDITOR.config.allowedContent = true;
  
    </script>

@endsection
