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
          
         <div class="yl-course-content-3">
            <div class="row">
                    @foreach ($halloffames as $item)
                   
                           <div class="col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                              <div class="yl-popular-course-img-text" style="padding: 5px;">
                                 <div class="text-center yl-popular-course-img">
                                    <img class="card-img-top w-100 " 
                                    onerror="this.onerror=null;this.src='/images/halloffame/nopic.png';" 
                                    src="{{ '/images/halloffame/thumbnails/'.$item->hof_img}}" alt="" >
                                 </div>
                                 <div class="yl-popular-course-text">
                                    <div class="clearfix popular-course-fee">
                                       
                                       <div class="course-fee-amount">
                                          
                                       </div>
                                    </div> 
                                    <div class=" yl-top-title-text yl-headline">
                                       <h3> <a href="/champions/hall-of-fame/{{$item->hof_slug}}">{{$item->hof_title}}</a>
                                        </h3>
                                        
                                    </div>
                                    
                                 </div>
                              </div>
                           </div>
                            
                    @endforeach
                   
             
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


