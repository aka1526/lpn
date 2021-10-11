@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection

@section('css')
    <link href="/assets/plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <style>
        .yl-popular-course-section {
            padding: 5px 0px 50px;
            background-color: #f7f7f7;
        }

    </style>
@endsection
@section('content')



    <section id="yl-popular-course" class="yl-popular-course-section">
        <div class="container">
            <div class="yl-popular-course-content">
                <div class="row">
                    @foreach ($Organizations as $item)
                    <div class="owl-item " style="width: 370px; margin-right: 30px;">
                        <div class="yl-blog-img-text">
                            <div class=" text-center">
                                <img width="230px" class="flag" src="{{ '/assets/plugins/flag-icon-css/flags/4x3/'.$item->org_country_code.'.svg'}}"
                                    alt="Angola Flag">
                            </div>
                            <div class="yl-blog-text yl-headline pera-content">

                                <div class="yl-blog-title">
                                    <h3><a class="btn btn-primary btn-block" href="#">{{ $item->org_country_name }}</a></h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    
                </div>

            </div>
        </div>
    </section>
    <!-- End of Popular course section
                 ============================================= -->
@endsection
@section('js')

    <!-- Internal Map -->
    {{-- <script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}

    {{-- <!--Internal  index js -->
		<script src="../../assets/js/index.js"></script>
		<script src="../../assets/js/jquery.vmap.sampledata.js"></script>

		<!-- custom js -->
		<script src="../../assets/js/custom.js"></script>
		<script src="../../assets/js/jquery.vmap.sampledata.js"></script> --}}
@endsection
