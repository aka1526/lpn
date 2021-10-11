@extends('frontend.layout.index_main')
@section('title')
    หน้าหลัก
@endsection
@section('content')
    <style>
        .event-area-section {
            padding: 20px 0px;
            background-color: #f2f2f4;
        }

    </style>
    <!-- Start of breadcrumb section
                 ============================================= -->
    {{-- <section id="yl-breadcrumb" class="yl-breadcrumb-section position-relative" data-background="/assets/img/ct-bg.jpg">
        <span class="breadcrumb-overlay position-absolute"></span>

    </section> --}}
    <!-- End of breadcrumb section
                 ============================================= -->

    <!-- Start of event content section
                 ============================================= -->
    <section id="event-area" class="event-area-section">

        <div class="container">

            <div class="instructor-details-content position-relative">
                <div class="row">
                    <div class="text-center col-12">
                        <div class="yl-banner-img">
                            <img src=" {{ '/images/halloffame/' . $halloffame->hof_img }}" alt="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center yl-about-text-area-content wow fadeInRight animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInRight;">
                           <div class="yl-section-title yl-headline">
                              
                              <h2>{{ $halloffame->hof_title}}</h2>
                               
                               
                              
                           </div>
                            
                        </div>
                        {!! $halloffame->hof_content !!} 
                     </div>
                     
                </div>
                {{-- <div class="text-center yl-event-btn">
                    <a href="#">Load More</a>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- End of of event content section
                 ============================================= -->

@endsection
