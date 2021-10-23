@extends('admins.layout.index_main')
@section('title')
    Admin Page
@endsection

@section('css')
    <!-- Icons css -->
    <link href="/adminpage/assets/css/icons.css" rel="stylesheet">
    <link href="/adminpage/assets/plugins/gallery/gallery.css" rel="stylesheet">
    <!-- Internal Select2 css -->
    <link href="/adminpage/assets/plugins/select2/css/select2.min.css" rel="stylesheet">

    <link href="{{ asset('/adminpage/assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="/adminpage/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
    <link href="/adminpage/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
    <link href="/adminpage/assets/plugins/pickerjs/picker.min.css" rel="stylesheet">
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
            <form id="frm" action="{{ route('news.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="news_uid" name="news_uid" value="{{ $news->news_uid }}">
                <input type="hidden" id="news_url" name="news_url" value="{{ $news->news_url }}">

                <!-- row opened -->
                <div class="row row-sm">
                    <!--div-->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header tx-medium bd-0 text-white bg-primary ">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0 text-white">
                                        <i class="fas fa-book-medical"></i> News Add Page
                                    </h4>
                                    <a href="/pageadmin/news/index" class="btn ripple btn-warning "><i
                                        class="fa fa-fast-backward"></i> Back </a>
                                </div>

                            </div>
                            <div class="card-body">
                                <div id="errors"></div>
                                {{-- Start Row --}}
                                <div class="row row-sm">


                                    <div class="col-3">
                                        <p class="mg-b-10">Catalog Select</p>
                                        <select class="form-control select2-no-search" id="news_group" name="news_group">
                                            <option label="Choose one"></option>
                                            @foreach ($NewsCatalog as $item)
                                                <option value="{{ $item->catalog_name }}"
                                                    {{ $item->catalog_name == $news->news_group ? 'selected' : '' }}>
                                                    {{ $item->catalog_name }}</option>
                                            @endforeach



                                        </select>
                                    </div>

                                    <div class="col-9">
                                        <div class="form-group ">
                                            <label for="news_toppic">Toppic <span class="tx-danger">*</span></label>
                                            <input type="text" class="form-control" id="news_toppic" name="news_toppic"
                                                value="{{ $news->news_toppic }}" placeholder="Enter Toppic">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group ">
                                            <label for="news_location">Location <span class="tx-danger">*</span></label>
                                            <input type="text" class="form-control" id="news_location" name="news_location"
                                            value="{{ $news->news_location }}" 
                                                placeholder="Enter Location">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 mg-t-20">
                                        <label for="course_item_duration">Image Show (Size 868x480 px)</label>
                                        <div class="input-group file-browser">
                                            <input type="text" class="form-control border-right-0 browse-file"
                                                placeholder="choose" readonly="">
                                            <label class="input-group-btn">
                                                <span class="btn btn-default">
                                                    Browse <input type="file" id="fileupload" name="fileupload"
                                                    accept=".jpg, .png, image/jpeg, image/png"  style="display: none;">
                                                </span>
                                            </label>
                                        </div>
                                        <div class="course-details-tab-area">
                                            <div class="course-details-main-img">
                                                <img src="{{ '/images/news/' . $news->news_url . '/thumbnails/' . $news->news_img }}"
                                                    alt="">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- End Row --}}

                                {{-- Start Row --}}
                                <div class="row row-sm">
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label>Description</label>
                                            <textarea id="news_desc" name="news_desc" class="form-control"
                                                placeholder="course Description" rows="3">
                                                {!! $news->news_desc !!}
                                            </textarea>

                                        </div>
                                    </div>
                                </div>

                                {{-- End Row --}}


                                {{-- End Row --}}
                                <div class="row row-sm">
                                    <div class="col-sm-8 col-md-8 col-lg-8 mg-t-10">
                                        <label for="course_item_duration">Even Date Time.</label>

                                        <div class="input-group col-md-4">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                                </div>
                                            </div>
                                            <input class="form-control" id="news_datetime" name="news_datetime"
                                                type="text" value="{{ Carbon\Carbon::now() }}">
                                        </div>

                                    </div>



                                </div>
                                <div class="row row-sm">
                                    <div class="col-sm-12 col-md-12 col-lg-12 mg-t-20">
                                        <label for="course_item_duration">Image Gallery (Size 868x480 px)</label>
                                        <div class="input-group file-browser">
                                            <input type="text" class="form-control border-right-0 browse-file"
                                                placeholder="choose" readonly="">
                                            <label class="input-group-btn">
                                                <span class="btn btn-default">
                                                    Browse <input type="file" id="fileuploads" name="fileuploads[]"
                                                    accept=".jpg, .png, image/jpeg, image/png"  style="display: none;" multiple>
                                                </span>
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="/pageadmin/news/index" class="btn ripple btn-warning "><i
                                        class="fa fa-fast-backward"></i> Back </a>
                                <button type="submit" id="btn-save" class="btn ripple btn-primary btn-save">Save
                                    changes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="card mg-b-20">
                <div class="card-header tx-medium bd-0 text-white bg-secondary  ">
                    <div class=" ">
                        <h4 class="card-title mg-b-0 text-white text-center">
                            News Gallery
                        </h4>

                    </div>

                </div>
                <div class="card-body">

                <!-- Gallery -->
					<div class="row demo-gallery">
						{{-- <ul id="lightgallery" class="list-unstyled row row-sm"> --}}
                            @foreach (  $NewsGallery as $img)
                            {{-- <li class="col-sm-3 col-md-3 col-lg-3" data-responsive="{{ '/images/news/'.$img->gallery_url.'/gallery/'.$img->gallery_filename }}" data-src="{{ '/images/news/'.$img->gallery_url.'/gallery/'.$img->gallery_filename }}" data-sub-html="<h4>{{ $img->gallery_filename }}</h4>" >
								<a href="">
									<img class="img-responsive" src="{{ '/images/news/'.$img->gallery_url.'/gallery/'.$img->gallery_filename }}" alt="Thumb-1">
                                    
                                </a>
                                 
							</li>  --}}

                            <div class="col-xl-4 col-lg-4 col-md-12">
                                <div class="card text-center">
                                    <img class="img-responsive" src="{{ '/images/news/'.$img->gallery_url.'/gallery/'.$img->gallery_filename }}" alt="Thumb-1">
                                    <div class="card-body">
                                       
                                        <a class="btn btn-danger btn-block btn-delete-img" data-uid="{{$img->gallery_uid }}" href="">Delete</a>
                                    </div>
                                 </div>
                            </div>
                            @endforeach
							
						 
						{{-- </ul> --}}
						<!-- /Gallery -->
 
					</div>
					<!-- row closed -->
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
    <!--Internal  Datepicker js -->

    <!-- Internal Modal js-->
    <script src="{{ asset('/adminpage/assets/js/admins/news.js?v=') . time() }}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{ asset('/adminpage/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/adminpage/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>

    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="/adminpage/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>

    <!-- Ionicons js -->
    <script src="/adminpage/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js"></script>

    <!--Internal  pickerjs js -->
    <script src="/adminpage/assets/plugins/pickerjs/picker.min.js"></script>

    <!-- Internal Gallery js -->
		<script src="/adminpage/assets/plugins/gallery/lightgallery-all.min.js"></script>
		<script src="/adminpage/assets/plugins/gallery/jquery.mousewheel.min.js"></script>
        <script src="/adminpage/assets/js/gallery.js"></script>


    <script src="{{ asset('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/assets/plugins/ckeditor/adapters/jquery.js') }}"></script>
    <script src="/adminpage/assets/js/eva-icons.min.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('news_desc', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>

@endsection
